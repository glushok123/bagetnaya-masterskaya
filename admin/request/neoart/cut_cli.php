<?php
/**
 * CLI: прогоняет NeoartCutter по выборке raw-фото эксперимента и собирает
 * два монтажа (imgconst / listimg) для визуального сравнения с cut.py.
 *   php admin/request/neoart/cut_cli.php <srcDir> <outDir> [limit]
 */
require_once __DIR__ . '/../../helpers/NeoartCutter.php';
$src = $argv[1] ?? (__DIR__ . '/../../../experiment/neoart-parser/images/raw');
if ($src === '') $src = __DIR__ . '/../../../experiment/neoart-parser/images/raw';
$out = $argv[2] ?? (__DIR__ . '/../../../experiment/neoart-parser/cut_test_php');
if ($out === '') $out = __DIR__ . '/../../../experiment/neoart-parser/cut_test_php';
$limit = (int)($argv[3] ?? 120);
@mkdir("$out/imgconst", 0775, true); @mkdir("$out/listimg", 0775, true);

$files = glob("$src/*.jpg");
sort($files);
if ($limit && count($files) > $limit) {
    $step = count($files) / $limit;
    $files = array_map(fn($i) => $files[(int)($i * $step)], range(0, $limit - 1));
}
$cutter = new NeoartCutter();
$ok = 0; $flag = 0; $err = 0; $flagged = [];
foreach ($files as $f) {
    $stem = pathinfo($f, PATHINFO_FILENAME);
    $r = $cutter->cut($f, "$out/listimg/$stem.jpg", "$out/imgconst/$stem.jpg");
    if ($r['status'] === 'auto_ok') $ok++;
    elseif ($r['status'] === 'auto_flagged') { $flag++; $flagged[] = "$stem\t" . implode(',', $r['flags']); }
    else { $err++; $flagged[] = "$stem\tERR:" . implode(',', $r['flags']); }
}
file_put_contents("$out/flagged.txt", implode("\n", $flagged));
echo "Обработано: " . count($files) . " | ok=$ok flagged=$flag err=$err\n";
echo "Результат: $out\n";

// монтажи
foreach ([['imgconst', 240, 120, 6], ['listimg', 150, 100, 8]] as [$sub, $cw, $chh, $cols]) {
    $imgs = glob("$out/$sub/*.jpg"); sort($imgs);
    if (count($imgs) > 54) { $st = count($imgs) / 54; $imgs = array_map(fn($i) => $imgs[(int)($i * $st)], range(0, 53)); }
    if (!$imgs) continue;
    $rows = (int)ceil(count($imgs) / $cols); $pad = 6;
    $cW = $cols * ($cw + $pad) + $pad; $cH = $rows * ($chh + $pad) + $pad;
    $canvas = imagecreatetruecolor($cW, $cH);
    imagefill($canvas, 0, 0, imagecolorallocate($canvas, 245, 245, 245));
    foreach ($imgs as $i => $p) {
        $im = @imagecreatefromjpeg($p); if (!$im) continue;
        $iw = imagesx($im); $ih = imagesy($im);
        $s = min($cw / $iw, $chh / $ih); $nw = (int)($iw * $s); $nh = (int)($ih * $s);
        $c = $i % $cols; $rrow = intdiv($i, $cols);
        $x = $pad + $c * ($cw + $pad) + (int)(($cw - $nw) / 2);
        $y = $pad + $rrow * ($chh + $pad) + (int)(($chh - $nh) / 2);
        imagecopyresampled($canvas, $im, $x, $y, 0, 0, $nw, $nh, $iw, $ih);
        imagedestroy($im);
    }
    imagejpeg($canvas, "$out/review_$sub.jpg", 88);
    imagedestroy($canvas);
    echo "review_$sub.jpg\n";
}
