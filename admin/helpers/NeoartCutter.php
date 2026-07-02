<?php
/**
 * PHP+GD порт experiment/neoart-parser/cut.py.
 * Детекция белого «окна» рамы на уменьшенной копии (быстро), кроп — из оригинала.
 */
class NeoartCutter
{
    public int $listW = 150;
    public int $listH = 100;
    private int $white;
    private float $rowFrac;
    private float $colFrac;
    private int $analyzeMax = 500;

    public function __construct(int $white = 250, float $rowFrac = 0.12, float $colFrac = 0.12)
    {
        $this->white = $white; $this->rowFrac = $rowFrac; $this->colFrac = $colFrac;
    }

    public function cut(string $rawPath, string $listOut, string $constOut): array
    {
        $src = @imagecreatefromjpeg($rawPath);
        if (!$src) return ['status' => 'error', 'flags' => ['load']];
        $W = imagesx($src); $H = imagesy($src);

        $det = $this->detect($src, $W, $H);
        if ($det === null) { imagedestroy($src); return ['status' => 'error', 'flags' => ['no-window']]; }

        [$cx0, $cy0, $cx1, $cy1] = $det['const'];
        $this->writeCrop($src, (int)$cx0, (int)$cy0, (int)($cx1 - $cx0), (int)($cy1 - $cy0), $constOut, 0, 0);

        [$lx0, $ly0, $lx1, $ly1] = $det['list'];
        $this->writeCover($src, (int)$lx0, (int)$ly0, (int)($lx1 - $lx0), (int)($ly1 - $ly0), $listOut);

        imagedestroy($src);
        $flags = $det['flags'];
        return ['status' => $flags ? 'auto_flagged' : 'auto_ok', 'flags' => $flags];
    }

    /** Детекция на уменьшенной копии. Возвращает прямоугольники в координатах ОРИГИНАЛА. */
    private function detect($src, int $W, int $H): ?array
    {
        $scale = min(1.0, $this->analyzeMax / max($W, $H));
        $aw = max(1, (int)round($W * $scale));
        $ah = max(1, (int)round($H * $scale));
        $an = imagecreatetruecolor($aw, $ah);
        imagecopyresampled($an, $src, 0, 0, 0, 0, $aw, $ah, $W, $H);

        // белая маска аналитической копии
        $white = [];               // $white[$y][$x] = 0/1
        $rowWhite = array_fill(0, $ah, 0);
        $colWhite = array_fill(0, $aw, 0);
        $rowNon   = array_fill(0, $ah, 0);
        $colNon   = array_fill(0, $aw, 0);
        $thr = $this->white;
        for ($y = 0; $y < $ah; $y++) {
            $row = [];
            for ($x = 0; $x < $aw; $x++) {
                $rgb = imagecolorat($an, $x, $y);
                $r = ($rgb >> 16) & 0xFF; $g = ($rgb >> 8) & 0xFF; $b = $rgb & 0xFF;
                $isW = ($r > $thr && $g > $thr && $b > $thr) ? 1 : 0;
                $row[$x] = $isW;
                if ($isW) { $rowWhite[$y]++; $colWhite[$x]++; }
                else { $rowNon[$y]++; $colNon[$x]++; }
            }
            $white[$y] = $row;
        }
        imagedestroy($an);

        // content bbox: строки/столбцы, где доля не-белого > 0.03
        $rows = []; for ($y = 0; $y < $ah; $y++) if ($rowNon[$y] / $aw > 0.03) $rows[] = $y;
        $cols = []; for ($x = 0; $x < $aw; $x++) if ($colNon[$x] / $ah > 0.03) $cols[] = $x;
        if (!$rows || !$cols) return null;
        $bx0 = $cols[0]; $bx1 = end($cols) + 1; $by0 = $rows[0]; $by1 = end($rows) + 1;

        // окно: самый длинный непрерывный блок белых строк внутри bbox
        $subW = $bx1 - $bx0;
        $rowFracArr = [];
        for ($y = $by0; $y < $by1; $y++) {
            $c = 0; for ($x = $bx0; $x < $bx1; $x++) $c += $white[$y][$x];
            $rowFracArr[$y] = $subW ? $c / $subW : 0;
        }
        [$r0, $r1] = $this->longestRun($rowFracArr, $by0, $by1, $this->rowFrac);
        if ($r0 === null) return null;
        $wy0 = $r0;                                  // верх окна = внутр. край верх. планки

        // право окна: самый длинный блок белых столбцов в строках окна
        $subH = $r1 - $r0;
        $colFracArr = [];
        for ($x = $bx0; $x < $bx1; $x++) {
            $c = 0; for ($y = $r0; $y < $r1; $y++) $c += $white[$y][$x];
            $colFracArr[$x] = $subH ? $c / $subH : 0;
        }
        [$c0, $c1] = $this->longestRun($colFracArr, $bx0, $bx1, $this->colFrac);
        if ($c0 === null) return null;
        $wx1 = $c1;                                  // право окна = внутр. край прав. планки

        $barTop = $wy0 - $by0;
        $barRight = $bx1 - $wx1;
        $cw = $bx1 - $bx0; $ch = $by1 - $by0;

        $flags = [];
        if ($barTop < 4 || $barTop < 0.03 * $ch) $flags[] = 'top=' . $barTop;
        if ($barTop > 0.72 * $ch) $flags[] = 'topBig';
        if ($barRight < 4 || $barRight < 0.035 * $cw) $flags[] = 'right=' . $barRight;
        if ($cw < 0.35 * $ch) $flags[] = 'narrow';
        // окно должно быть преимущественно белым
        $winW = 0; $winCnt = 0;
        for ($y = $wy0; $y < $by1; $y++) for ($x = $bx0; $x < $wx1; $x++) { $winCnt++; $winW += $white[$y][$x]; }
        if ($winCnt && $winW / $winCnt < 0.35) $flags[] = 'notwhite';

        // imgconst: верхняя планка над окном; срезаем края, пока крайняя линия преимущественно белая
        $cx0 = $bx0; $cy0 = $by0; $cx1 = $wx1; $cy1 = $wy0;
        $TRIM = 0.30;
        for ($i = 0; $i < 400; $i++) {
            if ($cx1 - $cx0 <= 6 || $cy1 - $cy0 <= 4) break;
            $changed = false;
            if ($this->colMean($white, $cx0, $cy0, $cy1) > $TRIM) { $cx0++; $changed = true; }
            if ($this->colMean($white, $cx1 - 1, $cy0, $cy1) > $TRIM) { $cx1--; $changed = true; }
            if ($this->rowMean($white, $cy0, $cx0, $cx1) > $TRIM) { $cy0++; $changed = true; }
            if ($this->rowMean($white, $cy1 - 1, $cx0, $cx1) > $TRIM) { $cy1--; $changed = true; }
            if (!$changed) break;
        }
        if ($cx1 - $cx0 < 10 || $cy1 - $cy0 < 4) {
            $flags[] = 'tiny';
            $cx0 = $bx0; $cy0 = $by0; $cx1 = max($bx0 + 10, $wx1); $cy1 = max($by0 + 4, $wy0);
        }

        // listimg: угол top-right + захват окна шириной с планки
        $lx0 = max($bx0, min($wx1 - $barRight, $bx1 - 6));
        $ly1 = min($by1, max($wy0 + $barTop, $by0 + 6));

        $inv = $scale > 0 ? 1.0 / $scale : 1.0;
        $toFull = fn($v, $max) => max(0, min($max, (int)round($v * $inv)));
        return [
            'flags' => $flags,
            'const' => [$toFull($cx0, $W), $toFull($cy0, $H), $toFull($cx1, $W), $toFull($cy1, $H)],
            'list'  => [$toFull($lx0, $W), $toFull($by0, $H), $toFull($bx1, $W), $toFull($ly1, $H)],
        ];
    }

    /** (start,end) самого длинного блока индексов [lo,hi), где $arr[i] > $thr. Индексы абсолютные. */
    private function longestRun(array $arr, int $lo, int $hi, float $thr): array
    {
        $bestLen = 0; $best = [null, null]; $i = $lo;
        while ($i < $hi) {
            if (($arr[$i] ?? 0) > $thr) {
                $j = $i; while ($j < $hi && ($arr[$j] ?? 0) > $thr) $j++;
                if ($j - $i > $bestLen) { $bestLen = $j - $i; $best = [$i, $j]; }
                $i = $j;
            } else $i++;
        }
        return $best;
    }

    private function colMean(array $white, int $x, int $y0, int $y1): float
    {
        if ($y1 <= $y0) return 0; $s = 0;
        for ($y = $y0; $y < $y1; $y++) $s += $white[$y][$x] ?? 0;
        return $s / ($y1 - $y0);
    }

    private function rowMean(array $white, int $y, int $x0, int $x1): float
    {
        if ($x1 <= $x0) return 0; $s = 0; $r = $white[$y] ?? [];
        for ($x = $x0; $x < $x1; $x++) $s += $r[$x] ?? 0;
        return $s / ($x1 - $x0);
    }

    private function writeCrop($src, int $x, int $y, int $w, int $h, string $out, int $tw, int $th): bool
    {
        $w = max(1, $w); $h = max(1, $h);
        $dst = imagecreatetruecolor($w, $h);
        imagecopy($dst, $src, 0, 0, $x, $y, $w, $h);
        $ok = imagejpeg($dst, $out, 90);
        imagedestroy($dst);
        return $ok;
    }

    /** cover: вписать по большей стороне + центр-кроп до listW×listH. */
    private function writeCover($src, int $x, int $y, int $w, int $h, string $out): bool
    {
        $w = max(1, $w); $h = max(1, $h);
        $crop = imagecreatetruecolor($w, $h);
        imagecopy($crop, $src, 0, 0, $x, $y, $w, $h);
        $scale = max($this->listW / $w, $this->listH / $h);
        $nw = max($this->listW, (int)round($w * $scale));
        $nh = max($this->listH, (int)round($h * $scale));
        $res = imagecreatetruecolor($nw, $nh);
        imagecopyresampled($res, $crop, 0, 0, 0, 0, $nw, $nh, $w, $h);
        $left = (int)(($nw - $this->listW) / 2);
        $top = (int)(($nh - $this->listH) / 2);
        $final = imagecreatetruecolor($this->listW, $this->listH);
        imagecopy($final, $res, 0, 0, $left, $top, $this->listW, $this->listH);
        $ok = imagejpeg($final, $out, 90);
        imagedestroy($crop); imagedestroy($res); imagedestroy($final);
        return $ok;
    }

    public function cropListimg(string $rawPath, array $rect, string $out): bool
    {
        $src = @imagecreatefromjpeg($rawPath); if (!$src) return false;
        $ok = $this->writeCover($src, (int)$rect['x'], (int)$rect['y'], (int)$rect['w'], (int)$rect['h'], $out);
        imagedestroy($src); return $ok;
    }

    public function cropImgconst(string $rawPath, array $rect, string $out): bool
    {
        $src = @imagecreatefromjpeg($rawPath); if (!$src) return false;
        $ok = $this->writeCrop($src, (int)$rect['x'], (int)$rect['y'], (int)$rect['w'], (int)$rect['h'], $out, 0, 0);
        imagedestroy($src); return $ok;
    }
}
