<?
$files = scandir("bgchkout/");
$mousum = 0;
$curm2 = 0;
for ($i = 2; $i < (is_countable($files) ? count($files) : 0); $i++) {
    $dat = date("Y-m-d H:i:s", $files[$i]);

    $curm = date("m", $files[$i]);
    if (($curm != $curm2) && ($curm2 != 0)) {
        echo "<h2 style='background:#333; color:#fff;line-height:40px;'>За " . $curm2 . " месяц: " . $mousum . "р</h2><br>";
        $mousum = 0;
    }
    $curm2 = $curm;

    $chekcont = file('bgchkout/' . $files[$i]);
    $sum = 0;
    for ($j = 0; $j < (is_countable($chekcont) ? count($chekcont) : 0); $j++) {
        $ident = rtrim($chekcont[$j]);
        $z = explode('l', $ident);
        $sum = $sum + $z[13];
        $result = implode("l", array_pad($z, 22, 0));
        echo "<a target=\"_blank\" href=\"http://bagetnaya-masterskaya.com/baget_online?id=" . $result . "\">" . $result . "</a><br>";
    }
    $mousum = $mousum + $sum;
    echo "<br>Дата: <b>" . $dat . "</b> Сумма: <b>" . $sum . "</b><hr>";
}
