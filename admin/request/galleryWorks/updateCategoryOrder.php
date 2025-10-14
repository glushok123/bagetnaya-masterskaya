<?php
require_once '../../../base/connect.php';

header('Content-Type: application/json; charset=utf-8');

$categoryId = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$direction = isset($_POST['direction']) ? trim((string) $_POST['direction']) : '';

if ($categoryId <= 0 || !in_array($direction, ['up', 'down'], true)) {
    echo json_encode(['status' => 'error', 'message' => 'Некорректные данные для сортировки']);
    return;
}

try {
    $currentStatement = $dbh->prepare('SELECT id, sort_order FROM category_gallery_works WHERE id = :id');
    $currentStatement->bindValue(':id', $categoryId, PDO::PARAM_INT);
    $currentStatement->execute();
    $current = $currentStatement->fetch(PDO::FETCH_ASSOC);

    if (!$current) {
        echo json_encode(['status' => 'error', 'message' => 'Категория не найдена']);
        return;
    }

    $sortOrder = (int) $current['sort_order'];

    if ($direction === 'up') {
        $neighborQuery = 'SELECT id, sort_order FROM category_gallery_works WHERE sort_order < :sort_order OR (sort_order = :sort_order AND id < :id) ORDER BY sort_order DESC, id DESC LIMIT 1';
    } else {
        $neighborQuery = 'SELECT id, sort_order FROM category_gallery_works WHERE sort_order > :sort_order OR (sort_order = :sort_order AND id > :id) ORDER BY sort_order ASC, id ASC LIMIT 1';
    }

    $neighborStatement = $dbh->prepare($neighborQuery);
    $neighborStatement->bindValue(':sort_order', $sortOrder, PDO::PARAM_INT);
    $neighborStatement->bindValue(':id', $categoryId, PDO::PARAM_INT);
    $neighborStatement->execute();
    $neighbor = $neighborStatement->fetch(PDO::FETCH_ASSOC);

    if (!$neighbor) {
        echo json_encode(['status' => 'success']);
        return;
    }

    $dbh->beginTransaction();

    $updateNeighbor = $dbh->prepare('UPDATE category_gallery_works SET sort_order = :sort_order WHERE id = :id');
    $updateNeighbor->bindValue(':sort_order', $sortOrder, PDO::PARAM_INT);
    $updateNeighbor->bindValue(':id', (int) $neighbor['id'], PDO::PARAM_INT);
    $updateNeighbor->execute();

    $updateCurrent = $dbh->prepare('UPDATE category_gallery_works SET sort_order = :sort_order WHERE id = :id');
    $updateCurrent->bindValue(':sort_order', (int) $neighbor['sort_order'], PDO::PARAM_INT);
    $updateCurrent->bindValue(':id', $categoryId, PDO::PARAM_INT);
    $updateCurrent->execute();

    $dbh->commit();

    echo json_encode(['status' => 'success']);
} catch (PDOException $exception) {
    if ($dbh->inTransaction()) {
        $dbh->rollBack();
    }

    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Не удалось изменить порядок категорий',
        'error' => $exception->getMessage(),
    ]);
}
