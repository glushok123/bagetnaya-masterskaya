<?
ini_set('max_execution_time', '600'); //600 seconds = 10 minutes
require_once('../../analiz_colors_img/model/ColorImg.php');
require_once '../../base/connect.php';

$stm = $dbh->prepare("SELECT * FROM catalog_baget");
$stm->execute();
$data = $stm->fetchAll();

foreach ($data as $item) {
    $src = $item['type'] == 'pasp' ? 'pi' : 'bi';
    $imgPatch = '/' . $src . '/' . $item['imgconst'];

    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imgPatch)) continue;

    $colorImg = new ColorImg($_SERVER['DOCUMENT_ROOT'] . $imgPatch);
    $color_m1 = (string) $colorImg->getMainColorMetod1x1px();
    $color_m2 = (string) $colorImg->getMainColorMetodMedium();
    $color_m3 = (array) $colorImg->getMainColorMetodColorExtractor();

    $stm = $dbh->prepare("
        UPDATE catalog_baget 
        SET
        color_m1 = '" . $color_m1 . "',
        color_m2 = '" . $color_m2 . "',
        color_m3_1 = '" . $color_m3[0] . "',
        color_m3_2 = '" . $color_m3[1] . "',
        color_m3_3 = '" . $color_m3[2] . "'
        where id = '" . $item['id'] . "'");

    $stm->execute();

    echo('<img src="' . $imgPatch . '"> <br>');

    echo(
        '<div style="margin:30px; border:3px solid red;">
            Метод #1 – 1x1px (основной цвет) -> ' . 
            $color_m1 . 
            '<div style="height:100px; width:100px; background: ' . $color_m1 . '"></div>
        </div>
    ');

    echo(
        '<div style="margin:30px; border:3px solid red;">
            Метод #2 – вычисление среднего цвета (основной цвет) -> ' . 
            $color_m2 . 
            '<div style="height:100px; width:100px; background: ' . $color_m2 . '"></div>
        </div>
    ');

    foreach($color_m3 as $color) {
        echo(
            '<div style="margin:30px; border:3px solid red;">
                Метод #3 –> ' . 
                $color . 
                '<div style="height:100px; width:100px; background: ' . $color . '"></div>
            </div>
        ');
    }
}

echo("<br> !!! STOP !!!");