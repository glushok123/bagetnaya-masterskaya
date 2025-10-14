<?php
require_once '../../../base/connect.php';

header('Content-Type: application/json; charset=utf-8');

$workId = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$description = isset($_POST['description']) ? trim((string) $_POST['description']) : '';

if ($workId <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Не найдена работа для обновления']);
    return;
}

try {
    $statement = $dbh->prepare('UPDATE gallery_work_images SET description = :description WHERE id = :id');
    $statement->bindValue(':description', $description, PDO::PARAM_STR);
    $statement->bindValue(':id', $workId, PDO::PARAM_INT);
    $statement->execute();

    echo json_encode(['status' => 'success']);
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Не удалось обновить описание',
        'error' => $exception->getMessage(),
    ]);
}
