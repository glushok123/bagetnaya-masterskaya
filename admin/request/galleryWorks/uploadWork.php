<?php
require __DIR__ . '/_auth.php';
require_once '../../../base/connect.php';

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function jsonResponse(array $payload): void
{
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

$categoryId = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;

$categoryStmt = $dbh->prepare('SELECT id FROM category_gallery_works WHERE id = :id');
$categoryStmt->execute([':id' => $categoryId]);

if ($categoryId <= 0 || !$categoryStmt->fetchColumn()) {
    jsonResponse(['status' => 'error', 'message' => 'Категория не найдена.']);
}

$file = $_FILES['image'] ?? null;

if (!$file || !empty($file['error']) || empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
    $tooBig = $file && in_array((int)$file['error'], [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE], true);
    jsonResponse(['status' => 'error', 'message' => $tooBig ? 'Файл слишком большой.' : 'Файл не получен.']);
}

$imageInfo = @getimagesize($file['tmp_name']);
$extensions = [IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png'];

if (empty($imageInfo) || !isset($extensions[$imageInfo[2]])) {
    jsonResponse(['status' => 'error', 'message' => 'Нужен файл JPG или PNG.']);
}

$urlDir = '/img/багетная - фотобанк работ/';
$absoluteDir = $_SERVER['DOCUMENT_ROOT'] . $urlDir;

if (!is_dir($absoluteDir)) {
    mkdir($absoluteDir, 0777, true);
}

$fileName = time() . '-' . random_int(1, 9_999_999_999) . '.' . $extensions[$imageInfo[2]];

if (!move_uploaded_file($file['tmp_name'], $absoluteDir . $fileName)) {
    jsonResponse(['status' => 'error', 'message' => 'Не удалось сохранить файл.']);
}

$urlImage = $urlDir . $fileName;
$description = isset($_POST['description']) ? trim((string)$_POST['description']) : '';

try {
    $insertStmt = $dbh->prepare('INSERT INTO gallery_work_images (category, url_image, description) VALUES (:category, :url_image, :description)');
    $insertStmt->execute([
        ':category' => $categoryId,
        ':url_image' => $urlImage,
        ':description' => $description,
    ]);
} catch (Throwable $exception) {
    @unlink($absoluteDir . $fileName);
    jsonResponse(['status' => 'error', 'message' => 'Не удалось сохранить работу: ' . $exception->getMessage()]);
}

jsonResponse([
    'status' => 'success',
    'data' => [
        'id' => (int)$dbh->lastInsertId(),
        'category' => $categoryId,
        'url_image' => $urlImage,
        'description' => $description,
    ],
]);
