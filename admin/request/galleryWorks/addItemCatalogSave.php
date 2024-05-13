<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once '../../../base/connect.php';

$info = $_POST;
$allow = ['jpg', 'jpeg'];

if (!isset($_FILES)) {
    exit;
}

// URL до временной директории.
$url_path = '/img/багетная - фотобанк работ/';

// Полный путь до временной директории.
$tmp_path = $_SERVER['DOCUMENT_ROOT'] . $url_path;

if (!is_dir($tmp_path)) {
    mkdir($tmp_path, 0777, true);
}

foreach ($_FILES as $file) {
    $error = '';
    $ext = mb_strtolower(mb_substr(mb_strrchr((string)@$file['name'], '.'), 1));

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
            $name = time() . '-' . random_int(1, 9_999_999_999);
            $src = $tmp_path . $name . '.' . $ext;
            $thumb = $tmp_path . $name . '-thumb.' . $ext;

            move_uploaded_file($file['tmp_name'], $src);

            $info['NamelistImg'] = './img/багетная - фотобанк работ/' . $name . '.' . $ext;
        }
    }
}

$lastid = $dbh->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'gallery_work_images'");
$lastid->execute();
$lastid = $lastid->fetchAll();

$category = $info["categoryIdGalleryWorks"];
$url_image = $info['NamelistImg'];
$description = $info['descGalleryWorks'];

$typeUrl = 1;

try {
    $stmt = $dbh->prepare("INSERT INTO gallery_work_images(category, url_image, description) values (?,?,?)");

    $stmt->bindParam(1, $category);
    $stmt->bindParam(2, $url_image);
    $stmt->bindParam(3, $description);


    $stmt->execute();

    echo "success";
} catch (PDOExecption $e) {
    $dbh->rollback();
    print "Error!: " . $e->getMessage() . "</br>";
}
