<?php


require_once('../../analiz_colors_img/model/ColorImg.php');

$colorImg = new ColorImg($_SERVER['DOCUMENT_ROOT'] . '/bi/1017t.jpg');

echo('<img src="/bi/1017t.jpg"> <br>');

echo(
    '<div style="margin:30px; border:3px solid red;">
        Метод #1 – 1x1px (основной цвет) -> ' . 
        $colorImg->getMainColorMetod1x1px() . 
        '<div style="height:100px; width:100px; background: ' . $colorImg->getMainColorMetod1x1px() . '"></div>
    </div>
');

echo(
    '<div style="margin:30px; border:3px solid red;">
        Метод #2 – вычисление среднего цвета (основной цвет) -> ' . 
        $colorImg->getMainColorMetodMedium() . 
        '<div style="height:100px; width:100px; background: ' . $colorImg->getMainColorMetodMedium() . '"></div>
    </div>
');

$colors = $colorImg->getMainColorMetodColorExtractor();

foreach($colors as $color) {
    echo(
        '<div style="margin:30px; border:3px solid red;">
            Метод #3 –> ' . 
            $color . 
            '<div style="height:100px; width:100px; background: ' . $color . '"></div>
        </div>
    ');
}

echo('<br> !!! stop !!!');