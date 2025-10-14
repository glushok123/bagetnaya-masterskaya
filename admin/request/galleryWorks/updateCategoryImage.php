<?php
require_once '../../../base/connect.php';

header('Content-Type: application/json; charset=utf-8');

$categoryId = isset($_POST['categoryId']) ? (int) $_POST['categoryId'] : 0;

if ($categoryId <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Некорректный идентификатор категории']);
    return;
}

if (empty($_FILES['mainImage']['tmp_name'])) {
    echo json_encode(['status' => 'error', 'message' => 'Не выбрано изображение']);
    return;
}

$file = $_FILES['mainImage'];
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

try {
    $categoryStatement = $dbh->prepare('SELECT main_image FROM category_gallery_works WHERE id = :id');
    $categoryStatement->bindValue(':id', $categoryId, PDO::PARAM_INT);
    $categoryStatement->execute();
    $category = $categoryStatement->fetch(PDO::FETCH_ASSOC);

    if (!$category) {
        echo json_encode(['status' => 'error', 'message' => 'Категория не найдена']);
        return;
    }

    $relativePath = '/img/багетная - фотобанк работ/category-main/';
    $absolutePath = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . $relativePath;

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

    $fileUrl = '.' . $relativePath . $fileName;

    $updateStatement = $dbh->prepare('UPDATE category_gallery_works SET main_image = :main_image WHERE id = :id');
    $updateStatement->bindValue(':main_image', $fileUrl, PDO::PARAM_STR);
    $updateStatement->bindValue(':id', $categoryId, PDO::PARAM_INT);
    $updateStatement->execute();

    if (!empty($category['main_image'])) {
        $oldPath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($category['main_image'], './');
        if (file_exists($oldPath)) {
            @unlink($oldPath);
        }
    }

    echo json_encode(['status' => 'success']);
} catch (PDOException $exception) {
    if (isset($targetPath) && file_exists($targetPath)) {
        @unlink($targetPath);
    }

    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Не удалось обновить изображение категории',
        'error' => $exception->getMessage(),
    ]);
}
