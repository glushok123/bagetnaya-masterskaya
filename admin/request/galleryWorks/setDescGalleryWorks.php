<?php
require __DIR__ . '/_auth.php';
require_once '../../../base/connect.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$description = isset($_POST['description']) ? (string)$_POST['description'] : '';

if ($id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Некорректный идентификатор работы.'], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

$stmt = $dbh->prepare('UPDATE gallery_work_images SET description = :description WHERE id = :id');
$stmt->execute([':description' => $description, ':id' => $id]);

echo json_encode(['status' => 'success'], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
