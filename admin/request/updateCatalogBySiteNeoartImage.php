<?
/*
    Здесь только обновление с neoart
*/
require_once '../../base/connect.php';

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 6000);

//$xmlwood = simplexml_load_file("https://www.neoart.ru/api.php?login=Copymaster&pass=Bagetnaya20130713!!&action=xml&catalog=91");
//$xmlplast = simplexml_load_file("https://www.neoart.ru/api.php?login=Copymaster&pass=Bagetnaya20130713!!&action=xml&catalog=92");
//$xmlalum = simplexml_load_file("https://www.neoart.ru/api.php?login=Copymaster&pass=Bagetnaya20130713!!&action=xml&catalog=93");
//$xmlpasp = simplexml_load_file("https://www.neoart.ru/api.php?login=Copymaster&pass=Bagetnaya20130713!!&action=xml&catalog=104");
$urlImage = 'http://www.neoart.ru/api.php?login=Copymaster&pass=Bagetnaya20130713!!&action=image&catalog=104&art=';

$json = file_get_contents("https://www.neoart.ru/api.php?login=Copymaster&pass=Bagetnaya20130713!!&action=json&catalog=104");
$json = json_decode($json, true);

$sectionList = [
    763, 939, 765, 1033
];

$elementList = [];

$company = 'neoart';
$date_update = date('Y-m-d H:i:s');
$type = 'pasp';
$widthPasp = 0;
$widthwithout = 0;
$publicvendor = 12000;

echo ('<pre>');

foreach ($json[104]['ELEMENTS'] as $guid => $element) {
    if(in_array($element['IBLOCK_SECTION_ID'], $sectionList)){
        $elementList[] = $element;


        //$element['ARTICLE'] = '905.QP';


        $stm = $dbh->prepare("SELECT * FROM catalog_baget where vendor=?");
        $stm->bindParam(1, $element['ARTICLE']);
        $stm->execute();
        $data = $stm->fetchAll();

        if ((is_countable($data) ? count($data) : 0) > 0) {
            $price = round($element['PRICES']['BASE'] * 5);
            $count = isset($element['QUANTITY']['COUNT_SE']) ? round($element['QUANTITY']['COUNT_SE']) : 0;

            $stmt = $dbh->prepare("UPDATE catalog_baget SET price=?,storage=?,date_update=?,company=? WHERE vendor=?");
            $stmt->bindParam(1, $price);
            $stmt->bindParam(2, $count);
            $stmt->bindParam(3, $date_update);
            $stmt->bindParam(4, $company);
            $stmt->bindParam(5, $element['ARTICLE']);
            $stmt->execute();
            echo "обновление паспарту -> " . $element['ARTICLE'] . "<br>";
        }else{

          /*  $content = file_get_contents($urlImage . $element['ARTICLE']);
            file_put_contents('./imagePasp/' . $element['ARTICLE'] . '.jpg', $content);

            //echo($element['IBLOCK_SECTION_ID']);
            if($element['IBLOCK_SECTION_ID'] == 1033){
                $w = 200;
                $h = 200;

                $x = '80%';
                $y = '10%';
            }else{
                $w = 200;
                $h = 200;

                $x = '50%';
                $y = '50%';
            }

            $filename = './imagePasp/' . $element['ARTICLE'] . '.jpg';

            $info   = getimagesize($filename);
            print_r($info);
            $width  = $info[0];
            $height = $info[1];
            $type   = $info[2];

            switch ($type) {
                case 1:
                    $img = imageCreateFromGif($filename);
                    imageSaveAlpha($img, true);
                    break;
                case 2:
                    $img = imageCreateFromJpeg($filename);
                    break;
                case 3:
                    $img = imageCreateFromPng($filename);
                    imageSaveAlpha($img, true);
                    break;
            }

            if (strpos($x, '%') !== false) {
                $x = intval($x);
                $x = ceil(($width * $x / 100) - ($w / 100 * $x));
            }
            if (strpos($y, '%') !== false) {
                $y = intval($y);
                $y = ceil(($height * $y / 100) - ($h / 100 * $y));
            }

            $tmp = imageCreateTrueColor($w, $h);
            if ($type == 1 || $type == 3) {
                imagealphablending($tmp, true);
                imageSaveAlpha($tmp, true);
                $transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
                imagefill($tmp, 0, 0, $transparent);
                imagecolortransparent($tmp, $transparent);
            }

            imageCopyResampled($tmp, $img, 0, 0, $x, $y, $width, $height, $width, $height);
            $img = $tmp;
            imageJpeg($img, './imagePasp/' . $element['ARTICLE'] . '.jpg', 100);*/

            $price = round($element['PRICES']['BASE'] * 5);
            $count = isset($element['QUANTITY']['COUNT_SE']) ? round($element['QUANTITY']['COUNT_SE']) : 0;
            $img = $element['ARTICLE'] . '.jpg';
            $stmt = $dbh->prepare("INSERT INTO catalog_baget(type,publicvendor,vendor,width,widthwithout,price,storage,listimg,imgconst) values (?,?,?,?,?,?,?,?,?)");
            $publicvendor = $publicvendor + 1;
            $vendor = $element['ARTICLE'];
            $type = 'pasp';
            $stmt->bindParam(1, $type);
            $stmt->bindParam(2, $publicvendor);
            $stmt->bindParam(3, $vendor);
            $stmt->bindParam(4, $widthPasp);
            $stmt->bindParam(5, $widthwithout);
            $stmt->bindParam(6, $price);
            $stmt->bindParam(7, $count);
            $stmt->bindParam(8, $img);
            $stmt->bindParam(9, $img);

            $stmt->execute();

            echo "Добавление паспарту -> " . $element['ARTICLE'] . "<br>";
        }

        //die();
    }
}
//print_r($elementList);
echo ('</pre>');
die();

echo "######################################### <br>";
$countInDbPasp = 0;
// новое обновление цен паспарту
foreach ($xmlpasp->category->item as $item) {
    $s = strval($item->article);
    if (!isset($item->price->chop)) {
        $priceW[$s] = $item->price->base;
    } else {
        $priceW[$s] = $item->price->chop;
    }

    $countW[$s] = (int)$item->quantity->countse;
    $price = round($priceW[$s] * 5);
    $count = round($countW[$s]);


    $stm = $dbh->prepare("SELECT * FROM catalog_baget where vendor=?");
    $stm->bindParam(1, $s);
    $stm->execute();
    $data = $stm->fetchAll();
    $date_update = $date = date('Y-m-d H:i:s');
    $company = 'neoart';

    if ((is_countable($data) ? count($data) : 0) > 0) {
        $countInDbPasp = $countInDbPasp + 1;
        $stmt = $dbh->prepare("UPDATE catalog_baget SET price=?,storage=?,date_update=?,company=? WHERE vendor=?");
        $stmt->bindParam(1, $price);
        $stmt->bindParam(2, $count);
        $stmt->bindParam(3, $date_update);
        $stmt->bindParam(4, $company);
        $stmt->bindParam(5, $s);
        $stmt->execute();
        echo "обновление паспарту -> " . $s . "<br>";
    }
}

echo "######################################### <br>";
echo "обновлено паспарту -> " . $countInDbPasp . "<br>";
echo "обновлено аллюминия -> " . $countInDbAlum . "<br>";
echo "обновлено пластик -> " . $countInDbPlast . "<br>";
echo "обновлено дерево -> " . $countInDbWood . "<br>";
