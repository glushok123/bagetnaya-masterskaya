<?php
require_once '../../../base/connect.php';

header('Content-Type: application/json; charset=utf-8');

$categoryId = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$isHidden = isset($_POST['isHidden']) ? (int) $_POST['isHidden'] : 0;
$isHidden = $isHidden === 1 ? 1 : 0;

if ($categoryId <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Некорректные данные категории']);
    return;
}

try {
    $statement = $dbh->prepare('UPDATE category_gallery_works SET is_hidden = :is_hidden WHERE id = :id');
    $statement->bindValue(':is_hidden', $isHidden, PDO::PARAM_INT);
    $statement->bindValue(':id', $categoryId, PDO::PARAM_INT);
    $statement->execute();

    echo json_encode(['status' => 'success']);
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Не удалось обновить видимость категории',
        'error' => $exception->getMessage(),
    ]);
}
