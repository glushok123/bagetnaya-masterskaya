<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require $_SERVER['DOCUMENT_ROOT'] .'/analiz_colors_img/model/ColorImg.php';

$colors = [];
$distance = [];
$bagetIds = [];

//$imgPatch = '/bi/1011t.jpg';
//$imgPatch = '/analiz_colors_img/test_img/imgonline-com-ua-Resize-GdwCDPvSVGUk9.jpg';
//$imgPatch = '/analiz_colors_img/test_img/photo_2023-08-02_14-58-06.jpg';

$imgPatch = '/pics/' . $_POST['image'] . '.jpg';//'/analiz_colors_img/test_img/photo_2023-08-02_14-57-36.jpg';
$colorImg = new ColorImg($_SERVER['DOCUMENT_ROOT'] . $imgPatch);

$color_m1 = (string) $colorImg->getMainColorMetod1x1px();
$color_m2 = (string) $colorImg->getMainColorMetodMedium();
$color_m3 = (array) $colorImg->getMainColorMetodColorExtractor();

$stm = $dbh->prepare('
SELECT `id`, `color_m1` 
FROM catalog_baget 
where 
    `storage` > 9 and 
    `price` > 0 and 
    `type` IN ("wood")'
); /* "plast", "alum" */
$stm->execute();
$data = $stm->fetchAll();

$color_m1_rgb = sscanf($color_m1, "#%02x%02x%02x");

foreach($data as $item) {
    $distance[] = [
        'id' => $item['id'],
        'distance' => getDistanceFromColor(
            $color_m1_rgb, sscanf(
                (string) $item['color_m1'], 
                "#%02x%02x%02x"
            )
        ),
        'hex' => $item['color_m1']
    ];
}

$distance = (array) array_sort($distance, 'distance', SORT_ASC);

$count = 0;

foreach($distance as $item) {
    $count = $count + 1;
    $bagetIds[] = $item['id'];

    if ($count == 10) {
        break;
    }
}
$data = [
    'id' => $bagetIds,
    'color' => [
        $color_m1,
        $color_m2,
        $color_m3
    ]
];



$query = "SELECT * FROM catalog_baget WHERE `id` IN (" . implode(',', $bagetIds) . ")";
$stmt = $dbh->prepare($query);
$stmt->execute();
$dataQ = $stmt->fetchAll();

$text = '';

foreach($dataQ as $baget) { 
        $type = $baget['type'];
		$class = '';
		if ($baget['storage'] > 30) {
			$class = 'bg-nal2';
		} else{
			$class = 'bg-nal1';
		}

        if ($type == 'pasp') { 
            $t1 = "
                z[12]=0; 
                z[3]=" .$baget['publicvendor'] . "; 
                z[4]=" .$baget['price'] . ";
            ";
            $t2 = "/pi/";
            $t3 = "<br>Цвет: " . $baget['color'];
        } else { 
            $t1 = "
                z[12]=0; 
                z[0]=" .$baget['publicvendor'] . "; 
                z[1]=" .$baget['price'] . "; 
                z[2]=" .$baget['width'] . "; 
                z[22]=" .$baget['widthwithout'] . "; 
            ";
            $t2 = "/bi/";
            $t3 = "
                <h5 class='text-nowrap text-start catalog-info'>Ширина: ". $baget['width'] . " мм</h5>
				<h5 class='text-nowrap text-start catalog-info'>Без четверти: ". $baget['widthwithout'] . " мм</h5>
            ";
        }

    $text = $text . "
        <div class='my-2 mx-2 col-5 col-xl-2 text-start " . $class . "'>
            <a class=' catalog-item  del" .$baget['id'] ."'
                onclick='
                    " . $t1 . "
                    changePage (); 
                    getitem(" .$baget['publicvendor'] . "); 
                    countprice ();
                '
                name=" . $baget['publicvendor'] . "
            >
            <div class='maskimg'>
                <img src="
                    . $t2 . 
                    $baget['listimg'] . "
                    align='center' 
                    class='bmenuimg'
                >
			</div>
            <div class='catalog-block-info my-2'>
                <h5 class='text-nowrap text-start catalog-art'>Арт. " . $baget['publicvendor'] . "</h5>
                " . $t3 . "
            </div>

            <div class='row text-center my-2'>
                <span class='catalog-price text-nowrap'>" . $baget['price'] . " ₽</span> 
            </div>
            
    ";



    if ($type !== "pasp") { 
        if ($baget['storage'] > 30) { 
            $text = $text . '<div class="nalich2">В наличии</div>';
        } else { 
            $text = $text . '<div class="nalich1">Огранич. кол-во</div>';
        }
    }
    
    $text = $text . '</a></div>';

}

echo($text);