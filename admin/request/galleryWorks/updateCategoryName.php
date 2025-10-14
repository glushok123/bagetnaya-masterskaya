<?php
require_once '../../../base/connect.php';

header('Content-Type: application/json; charset=utf-8');

$categoryId = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$name = isset($_POST['name']) ? trim((string) $_POST['name']) : '';

if ($categoryId <= 0 || $name === '') {
    echo json_encode(['status' => 'error', 'message' => 'Некорректные данные категории']);
    return;
}

try {
    $statement = $dbh->prepare('UPDATE category_gallery_works SET name = :name WHERE id = :id');
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    $statement->bindValue(':id', $categoryId, PDO::PARAM_INT);
    $statement->execute();

    echo json_encode(['status' => 'success']);
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Не удалось обновить категорию',
        'error' => $exception->getMessage(),
    ]);
}
