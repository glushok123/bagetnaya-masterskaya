<?php
/*$raddr=$_SERVER["REMOTE_ADDR"];
    if ($raddr!="127.0.0.1") {
        $rhost= gethostbyaddr($raddr);
        $uagent=$_SERVER["HTTP_USER_AGENT"];
        if ($refer=$_SERVER["HTTP_REFERER"]) {
            $refer='<a href="'.$refer.'">Ref</a>';
        }
        else {
            $refer='NoRef';
        }
        $query=$_SERVER["REQUEST_URI"];
        $towrite='<tr><td>'.$refer.'</td><td title="'.$uagent.'" style="background:#999;"> </td><td>'.date("j.m.Y G:i").'</td><td><a href="http://2whois.ru/?t=whois&data='.$raddr.'" target="_blank">'.$raddr.'</a></td><td>'.$rhost.'</td><td>'.$query.'</td></tr>';

        $fp = fopen('log404.html', 'a');
        fwrite($fp, $towrite);
        fclose($fp);
    }
*/
$keyw = "";
$titl = "Ошибка 404 - Багетная мастерская №1";
$desc = "Ошибка 404. Такой страницы не существует";
include "header.php"
?>
<div id="crops"><a href="/">Главная</a> » Ошибка 404</div>
<h1>Ошибка 404</h1>
<div id="main">
    <p style="text-align:center;"><img src="/img/404.png">
    </p>
</div>
<div id="side">
    <h3>Смотрите также</h3>
    <a href="/bagety_dlya_kartin/oformit_kartinu_v_baget.html" class="fast2">Оформление картин и репродукций в багетные рамки</a>
    <a href="/ramki_dlya_vyshivki/oformlenie_vyshivki.html" class="fast1">Оформление вышивок в багет</a>
    <a href="/bagetnye_ramki/bagetnye_ramki_dlya_foto.html" class="fast1">Рамки для фотографий и постеров</a>
    <a href="/bagetnye_ramki/bagetnye_ramki_dlya_ikon.html" class="fast1">Багетные рамки для икон</a>

    <? include "bot.php" ?>