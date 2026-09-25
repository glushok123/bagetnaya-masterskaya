<?php
require __DIR__ . '/_auth.php';
require_once '../../../base/connect.php';

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function jsonResponse(array $payload): void
{
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

$workStmt = $dbh->prepare('SELECT id, category, url_image, description FROM gallery_work_images WHERE id = :id');
$workStmt->execute([':id' => $id]);
$work = $workStmt->fetch(PDO::FETCH_ASSOC);

if ($id <= 0 || !$work) {
    jsonResponse(['status' => 'error', 'message' => 'Работа не найдена.']);
}

$categoryId = isset($_POST['category_id']) ? (int)$_POST['category_id'] : (int)$work['category'];

$categoryStmt = $dbh->prepare('SELECT id FROM category_gallery_works WHERE id = :id');
$categoryStmt->execute([':id' => $categoryId]);

if (!$categoryStmt->fetchColumn()) {
    jsonResponse(['status' => 'error', 'message' => 'Категория не найдена.']);
}

$description = isset($_POST['description']) ? (string)$_POST['description'] : (string)$work['description'];
$urlImage = (string)$work['url_image'];
$newFileAbsolute = null;

// Замена фото (необязательно)
if (!empty($_FILES['image']['tmp_name'])) {
    $file = $_FILES['image'];

    if (!empty($file['error']) || !is_uploaded_file($file['tmp_name'])) {
        $tooBig = in_array((int)$file['error'], [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE], true);
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
    $newFileAbsolute = $absoluteDir . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $newFileAbsolute)) {
        jsonResponse(['status' => 'error', 'message' => 'Не удалось сохранить файл.']);
    }

    $urlImage = $urlDir . $fileName;
}

try {
    $updateStmt = $dbh->prepare('UPDATE gallery_work_images SET category = :category, url_image = :url_image, description = :description WHERE id = :id');
    $updateStmt->execute([
        ':category' => $categoryId,
        ':url_image' => $urlImage,
        ':description' => $description,
        ':id' => $id,
    ]);
} catch (Throwable $exception) {
    if ($newFileAbsolute) {
        @unlink($newFileAbsolute);
    }

    jsonResponse(['status' => 'error', 'message' => 'Не удалось сохранить работу: ' . $exception->getMessage()]);
}

// Старое фото удаляем только после успешного сохранения новой записи
if ($newFileAbsolute && !empty($work['url_image']) && !preg_match('/^https?:/i', $work['url_image'])) {
    $oldPath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($work['url_image'], './');

    if (is_file($oldPath)) {
        @unlink($oldPath);
    }
}

jsonResponse([
    'status' => 'success',
    'data' => [
        'id' => $id,
        'category' => $categoryId,
        'url_image' => '/' . ltrim($urlImage, './'),
        'description' => $description,
    ],
]);
