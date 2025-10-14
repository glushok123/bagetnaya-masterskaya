<?php
require_once '../../../base/connect.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id <= 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Некорректный идентификатор изображения.',
    ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

$stmt = $dbh->prepare('SELECT url_image FROM gallery_work_images WHERE id = :id');
$stmt->execute([':id' => $id]);
$image = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$image) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Изображение не найдено.',
    ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

$deleteStmt = $dbh->prepare('DELETE FROM gallery_work_images WHERE id = :id');
$deleteStmt->execute([':id' => $id]);

if (!empty($image['url_image']) && !preg_match('/^https?:/i', $image['url_image'])) {
    $filePath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($image['url_image'], './');
    if (is_file($filePath)) {
        @unlink($filePath);
    }
}

echo json_encode([
    'status' => 'success',
], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
