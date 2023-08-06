<?php

require $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require $_SERVER['DOCUMENT_ROOT'] .'/analiz_colors_img/model/ColorImg.php';

$colors = [];
$distance = [];
$bagetIds = [];

//$imgPatch = '/bi/1011t.jpg';
//$imgPatch = '/analiz_colors_img/test_img/imgonline-com-ua-Resize-GdwCDPvSVGUk9.jpg';
//$imgPatch = '/analiz_colors_img/test_img/photo_2023-08-02_14-58-06.jpg';
$imgPatch = '/analiz_colors_img/test_img/photo_2023-08-02_14-57-36.jpg';
$colorImg = new ColorImg($_SERVER['DOCUMENT_ROOT'] . $imgPatch);

echo('<img src="' . $imgPatch . '"> <br>');

$color_m1 = (string) $colorImg->getMainColorMetod1x1px();
$color_m2 = (string) $colorImg->getMainColorMetodMedium();
$color_m3 = (array) $colorImg->getMainColorMetodColorExtractor();

echo($color_m1);
$stm = $dbh->prepare("SELECT `id`, `color_m1` FROM catalog_baget where `storage` > 10");
$stm->execute();
$data = $stm->fetchAll();

$color_m1_rgb = sscanf($color_m1, "#%02x%02x%02x");

foreach($data as $item) {
    $distance[] = [
        'id' => $item['id'],
        'distance' => getDistanceFromColor(
            $color_m1_rgb, sscanf($item['color_m1'], 
            "#%02x%02x%02x")
        ),
        'hex' => $item['color_m1']
    ];
}

$distance = (array) array_sort($distance, 'distance', SORT_ASC);

echo(
    '<div style="margin:30px; border:3px solid red;">
        Метод #1 – 1x1px (основной цвет) -> ' . 
        $color_m1 . 
        '<div style="height:100px; width:100px; background: ' . $color_m1 . '"></div>
    </div>
');

$count = 0;

foreach($distance as $item) {
    $count = $count + 1;
    $bagetIds[] = $item['id'];

    echo(
        '<div style="margin:30px; border:3px solid red;">
            Метод #1 – 1x1px (основной цвет) -> ' . 
            $item['hex'] . 
            ' ID багета ->' . $item['id'] . 
            '<div style="height:100px; width:100px; background: ' . $item['hex'] . '"></div>
        </div>
    ');

    if ($count == 5) {
        break;
    }
}

echo('<br> !!! stop !!!');