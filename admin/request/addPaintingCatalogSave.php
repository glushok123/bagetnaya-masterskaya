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
$url_path = '/фото_картин/';

// Полный путь до временной директории.
$tmp_path = $_SERVER['DOCUMENT_ROOT'] . $url_path;

if (!is_dir($tmp_path)) {
    mkdir($tmp_path, 0777, true);
}

$nameImage = [];

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

            $nameImage[] = $info['NamelistImg'] = $name . '.' . $ext;
        }
    }
}

$active = '1';

try {
    $stmt = $dbh->prepare("INSERT INTO paintings(name, avtor, price_one, sizes, active) values (?,?,?,?,?)");

    $stmt->bindParam(1, $_POST['painting_name']);
    $stmt->bindParam(2, $_POST['painting_avtor']);
    $stmt->bindParam(3, $_POST['painting_price']);
    $stmt->bindParam(4, $_POST['painting_size']);
    $stmt->bindParam(5, $active);

    $stmt->execute();

    $paintingId = $dbh->lastInsertId('id');

    foreach ($nameImage as $item) {
        $stmt = $dbh->prepare("INSERT INTO paintings_images(paintings_id, image) values (?,?)");

        $stmt->bindParam(1, $paintingId);
        $stmt->bindParam(2, $item);

        $stmt->execute();
    }

    echo "success";
} catch (PDOExecption $e) {
    $dbh->rollback();
    print "Error!: " . $e->getMessage() . "</br>";
}
