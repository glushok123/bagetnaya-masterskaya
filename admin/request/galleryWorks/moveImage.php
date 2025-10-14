<?php
require_once '../../../base/connect.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$categoryId = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;

if ($id <= 0 || $categoryId <= 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Некорректные параметры.',
    ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

$stmt = $dbh->prepare('SELECT id FROM gallery_work_images WHERE id = :id');
$stmt->execute([':id' => $id]);

if (!$stmt->fetchColumn()) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Изображение не найдено.',
    ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

$categoryStmt = $dbh->prepare('SELECT id FROM category_gallery_works WHERE id = :id');
$categoryStmt->execute([':id' => $categoryId]);

if (!$categoryStmt->fetchColumn()) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Категория не найдена.',
    ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

$updateStmt = $dbh->prepare('UPDATE gallery_work_images SET category = :category WHERE id = :id');
$updateStmt->execute([
    ':category' => $categoryId,
    ':id' => $id,
]);

echo json_encode([
    'status' => 'success',
], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
