<?
/*
    z[0] id багета, 
    z[1] цена багета, 
    z[2] ширина багета, 
    z[3] id паспарту, 
    z[4] цена паспарту,
    z[5] ширина паспарту, 
    z[6] опция1,
    z[7] опция2,
    z[8] имя картинки, 
    z[9] ширина картинки, 
    z[10] высота картинки, 
    z[11] картинка фона, 
    z[12] меню, z[13] цена, 
    z[14] тип сорировки, 
    z[15] номер заказа, 
    z[16] номер чека, 
    z[17] допы, 
    z[18] расстояние доставки, 
    z[19] marw, 
    z[20] marh, 
    z[21] mash, 
    z[22] ширина багета без четверти
*/


if (isset($_COOKIE['Skid'])) {
    $skidka = $_COOKIE['Skid'];
} else {
    $skidka = 0;
}

$z = ["7233", "840", "38", "0", "0", "0", "0", "0", "0", "300", "200", "0", "0", "0", "1", "0", "0", "0", "0", "0", "0", "0", "32"];

if (!empty($_GET['id'])) {
    $ident = $_GET['id'];
    $ident = str_replace(",", "", (string) $ident);
    $ident = str_replace(".", "", $ident);
    $ident = str_replace(" ", "", $ident);
    if (preg_match("/^[\dl]+$/", $ident)) {
        $z = explode('l', $ident);
        if (count($z) != 23) {
            exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online_new">');
        }
    } else {
        exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online_new">');
    }
}

$stmt = $dbh->prepare("SELECT price FROM catalog_baget WHERE publicvendor=?");
$stmt->bindParam(1, $z[0]);
$stmt->execute();
$data = $stmt->fetchAll();

if ($z[1] != $data[0]['price']) {
    $z[1] = $data[0]['price'];
}

if ($z[8] == '0') {
    $picname = 'pi/0.jpg';
} else {
    if (file_exists('pics/' . $z[8] . '.jpg')) {
        $picname = 'pics/' . $z[8] . '.jpg';
    } else {
        $picname = 'pi/0.jpg';
        $z[8] = '0';
    }
}

if ($z[11] != '0' && !(file_exists('pics/' . $z[11] . '.jpg'))) {
    $z[11] = '0';
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/auth/authCheck.php';

$mainw = round(($z[9] + $z[5] + $z[2] + $z[5] + $z[2]) * $z[21] / 1000);
$mainh = round(($z[10] + $z[5] + $z[2] + $z[5] + $z[2]) * $z[21] / 1000);


?>