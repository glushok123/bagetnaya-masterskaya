<?php
require_once '../../../base/connect.php';

header('Content-Type: application/json; charset=utf-8');

$allowExtensions = ['jpg', 'jpeg'];
$categoryId = isset($_POST['categoryIdGalleryWorks']) ? (int) $_POST['categoryIdGalleryWorks'] : 0;
$description = isset($_POST['descGalleryWorks']) ? trim((string) $_POST['descGalleryWorks']) : '';

if ($categoryId <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Не выбрана категория']);
    return;
}

if (empty($_FILES['imgGalleryWorks']) || empty($_FILES['imgGalleryWorks']['tmp_name'])) {
    echo json_encode(['status' => 'error', 'message' => 'Не выбрано изображение']);
    return;
}

$file = $_FILES['imgGalleryWorks'];
if (!empty($file['error']) || !is_uploaded_file($file['tmp_name'])) {
    echo json_encode(['status' => 'error', 'message' => 'Не удалось загрузить файл']);
    return;
}

$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if (!in_array($extension, $allowExtensions, true)) {
    echo json_encode(['status' => 'error', 'message' => 'Недопустимый тип файла']);
    return;
}

$imageInfo = @getimagesize($file['tmp_name']);
if (!$imageInfo || !in_array($imageInfo[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF], true)) {
    echo json_encode(['status' => 'error', 'message' => 'Недопустимый тип файла']);
    return;
}

$relativePath = '/img/багетная - фотобанк работ/';
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

try {
    $statement = $dbh->prepare('INSERT INTO gallery_work_images (category, url_image, description) VALUES (:category, :url, :description)');
    $statement->bindValue(':category', $categoryId, PDO::PARAM_INT);
    $statement->bindValue(':url', $fileUrl, PDO::PARAM_STR);
    $statement->bindValue(':description', $description, PDO::PARAM_STR);
    $statement->execute();

    echo json_encode(['status' => 'success']);
} catch (PDOException $exception) {
    @unlink($targetPath);
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Не удалось сохранить работу',
        'error' => $exception->getMessage(),
    ]);
}
