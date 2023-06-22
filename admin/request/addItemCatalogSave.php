<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once '../../base/connect.php';

$info = $_POST;
$allow = ['jpg', 'jpeg'];

if (!isset($_FILES)) {
    exit;
}

// URL до временной директории.
$url_path = $info['type_catalog'] == 'pasp' ? '/pi/' : '/bi/';

// Полный путь до временной директории.
$tmp_path = $_SERVER['DOCUMENT_ROOT'] . $url_path;

if (!is_dir($tmp_path)) {
    mkdir($tmp_path, 0777, true);
}

$_FILES['listImg']['typeImg'] = 'listImg';
$_FILES['imgConst']['typeImg'] = 'imgConst';

foreach ($_FILES as $file) {
    $error = '';
    $ext = mb_strtolower(mb_substr(mb_strrchr((string) @$file['name'], '.'), 1));

    if (!empty($file['error']) || empty($file['tmp_name']) || $file['tmp_name'] == 'none') {
        $error = 'Не удалось загрузить файл.';
    } elseif (empty($file['name']) || !is_uploaded_file($file['tmp_name'])) {
        $error = 'Не удалось загрузить файл.';
    } elseif (empty($ext) || !in_array($ext, $allow)) {
        $error = 'Недопустимый тип файла';
    } else {
        $img = @getimagesize($file['tmp_name']);
        if (empty($img[0]) || empty($img[1]) || !in_array($img[2], [1, 2, 3])) {
            $error = 'Недопустимый тип файла';
        } else {
            // Перемещаем файл в директорию с новым именем.
            $name  = time() . '-' . random_int(1, 9_999_999_999);
            $src   = $tmp_path . $name . '.' . $ext;
            $thumb = $tmp_path . $name . '-thumb.' . $ext;

            move_uploaded_file($file['tmp_name'], $src);


            if ($file['typeImg'] == 'listImg') {
                $info['NamelistImg'] = $name . '.' . $ext;
            }

            if ($file['typeImg'] == 'imgConst') {
                $info['NameimgConst'] = $name . '.' . $ext;
            }
        }
    }
}

$lastid = $dbh->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'catalog_baget'");
$lastid->execute();
$lastid = $lastid->fetchAll();

$type = $info["type_catalog"];
$publicvendor = intval($lastid[0]['AUTO_INCREMENT']) + 6000;
$vendor = $info["article_supplier"];
$width = $info["width"];
$widthwithout = $info['quarter'];
$price = $info["price"];
$color = $info["color"];

$storage = 30;

try {
    $stmt = $dbh->prepare("INSERT INTO catalog_baget(type, publicvendor, vendor, width, widthwithout, price, storage, listimg, imgconst, color) values (?,?,?,?,?,?,?,?,?,?)");

    $stmt->bindParam(1, $type);
    $stmt->bindParam(2, $publicvendor);
    $stmt->bindParam(3, $vendor);
    $stmt->bindParam(4, $width);
    $stmt->bindParam(5, $widthwithout);
    $stmt->bindParam(6, $price);
    $stmt->bindParam(7, $storage);
    $stmt->bindParam(8, $info["NamelistImg"]);
    $stmt->bindParam(9, $info["NameimgConst"]);
    $stmt->bindParam(10, $color);

    $stmt->execute();

    echo "success";
} catch (PDOExecption $e) {
    $dbh->rollback();
    print "Error!: " . $e->getMessage() . "</br>";
}
