<?php
require_once '../../../base/connect.php';

header('Content-Type: application/json; charset=utf-8');

$workId = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$categoryId = isset($_POST['categoryId']) ? (int) $_POST['categoryId'] : 0;

if ($workId <= 0 || $categoryId <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Некорректные данные']);
    return;
}

try {
    $categoryStatement = $dbh->prepare('SELECT id FROM category_gallery_works WHERE id = :id');
    $categoryStatement->bindValue(':id', $categoryId, PDO::PARAM_INT);
    $categoryStatement->execute();
    if (!$categoryStatement->fetchColumn()) {
        echo json_encode(['status' => 'error', 'message' => 'Категория не найдена']);
        return;
    }

    $statement = $dbh->prepare('UPDATE gallery_work_images SET category = :category WHERE id = :id');
    $statement->bindValue(':category', $categoryId, PDO::PARAM_INT);
    $statement->bindValue(':id', $workId, PDO::PARAM_INT);
    $statement->execute();

    echo json_encode(['status' => 'success']);
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Не удалось обновить категорию работы',
        'error' => $exception->getMessage(),
    ]);
}
