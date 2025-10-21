<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once '../../base/connect.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id <= 0) {
    http_response_code(400);
    echo 'error';
    exit;
}

try {
    $dbh->beginTransaction();

    $stmtImages = $dbh->prepare('SELECT image FROM paintings_images WHERE paintings_id = ?');
    $stmtImages->bindParam(1, $id, PDO::PARAM_INT);
    $stmtImages->execute();
    $images = $stmtImages->fetchAll(PDO::FETCH_COLUMN);

    $stmtDeleteImages = $dbh->prepare('DELETE FROM paintings_images WHERE paintings_id = ?');
    $stmtDeleteImages->bindParam(1, $id, PDO::PARAM_INT);
    $stmtDeleteImages->execute();

    $stmtDeletePainting = $dbh->prepare('DELETE FROM paintings WHERE id = ?');
    $stmtDeletePainting->bindParam(1, $id, PDO::PARAM_INT);
    $stmtDeletePainting->execute();

    $dbh->commit();

    $imagesPath = $_SERVER['DOCUMENT_ROOT'] . '/фото_картин/';

    foreach ($images as $image) {
        $filePath = $imagesPath . $image;
        if (is_file($filePath)) {
            @unlink($filePath);
        }
    }

    echo 'success';
} catch (PDOException $e) {
    if ($dbh->inTransaction()) {
        $dbh->rollBack();
    }

    http_response_code(500);
    echo 'error';
}
