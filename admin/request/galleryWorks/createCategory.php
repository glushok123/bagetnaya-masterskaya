<?php
require_once '../../../base/connect.php';

header('Content-Type: application/json; charset=utf-8');

$name = isset($_POST['galleryCategoryName']) ? trim((string) $_POST['galleryCategoryName']) : '';
$isHidden = isset($_POST['galleryCategoryIsHidden']) ? 1 : 0;

if ($name === '') {
    echo json_encode(['status' => 'error', 'message' => 'Укажите название категории']);
    return;
}

$mainImagePath = null;
$targetPath = null;
$relativePath = '/img/багетная - фотобанк работ/category-main/';
$absolutePath = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . $relativePath;

if (!empty($_FILES['galleryCategoryImage']['tmp_name'])) {
    $file = $_FILES['galleryCategoryImage'];
    if (!empty($file['error']) || !is_uploaded_file($file['tmp_name'])) {
        echo json_encode(['status' => 'error', 'message' => 'Не удалось загрузить файл']);
        return;
    }

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png'];
    if (!in_array($extension, $allowed, true)) {
        echo json_encode(['status' => 'error', 'message' => 'Недопустимый тип файла']);
        return;
    }

    $imageInfo = @getimagesize($file['tmp_name']);
    if (!$imageInfo || !in_array($imageInfo[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
        echo json_encode(['status' => 'error', 'message' => 'Недопустимый тип файла']);
        return;
    }

    if (!is_dir($absolutePath) && !mkdir($absolutePath, 0777, true) && !is_dir($absolutePath)) {
        echo json_encode(['status' => 'error', 'message' => 'Не удалось создать директорию для загрузки']);
        return;
    }

    $fileName = time() . '-' . random_int(1, 9_999_999_999) . '.' . $extension;
    $targetPath = $absolutePath . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        echo json_encode(['status' => 'error', 'message' => 'Не удалось сохранить файл']);
        return;
    }

    $mainImagePath = '.' . $relativePath . $fileName;
}

try {
    $orderStatement = $dbh->prepare('SELECT COALESCE(MAX(sort_order), 0) + 1 AS next_order FROM category_gallery_works');
    $orderStatement->execute();
    $nextOrder = (int) $orderStatement->fetchColumn();

    $statement = $dbh->prepare('INSERT INTO category_gallery_works (name, sort_order, main_image, is_hidden) VALUES (:name, :sort_order, :main_image, :is_hidden)');
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->bindValue(':sort_order', $nextOrder, PDO::PARAM_INT);
    $statement->bindValue(':main_image', $mainImagePath, PDO::PARAM_STR);
    $statement->bindValue(':is_hidden', $isHidden, PDO::PARAM_INT);
    $statement->execute();

    echo json_encode(['status' => 'success']);
} catch (PDOException $exception) {
    if (!empty($targetPath) && file_exists($targetPath)) {
        @unlink($targetPath);
    }

    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Не удалось создать категорию',
        'error' => $exception->getMessage(),
    ]);
}
