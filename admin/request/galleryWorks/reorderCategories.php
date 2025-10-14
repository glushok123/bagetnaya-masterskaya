<?php
require_once '../../../base/connect.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$direction = $_POST['direction'] ?? '';

if ($id <= 0 || !in_array($direction, ['up', 'down'], true)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Некорректные параметры запроса.',
    ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

$stmt = $dbh->prepare('SELECT id, position FROM category_gallery_works WHERE id = :id');
$stmt->execute([':id' => $id]);
$currentCategory = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$currentCategory) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Категория не найдена.',
    ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

if ($direction === 'up') {
    $neighborStmt = $dbh->prepare(
        'SELECT id, position FROM category_gallery_works WHERE position < :position ORDER BY position DESC, id DESC LIMIT 1'
    );
    $neighborStmt->execute([':position' => $currentCategory['position']]);
} else {
    $neighborStmt = $dbh->prepare(
        'SELECT id, position FROM category_gallery_works WHERE position > :position ORDER BY position ASC, id ASC LIMIT 1'
    );
    $neighborStmt->execute([':position' => $currentCategory['position']]);
}

$neighbor = $neighborStmt->fetch(PDO::FETCH_ASSOC);

if (!$neighbor) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Изменений не требуется.',
    ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

try {
    $dbh->beginTransaction();

    $updateStmt = $dbh->prepare('UPDATE category_gallery_works SET position = :position WHERE id = :id');
    $updateStmt->execute([
        ':position' => $neighbor['position'],
        ':id' => $currentCategory['id'],
    ]);

    $updateStmt->execute([
        ':position' => $currentCategory['position'],
        ':id' => $neighbor['id'],
    ]);

    $dbh->commit();
} catch (Throwable $exception) {
    $dbh->rollBack();
    echo json_encode([
        'status' => 'error',
        'message' => 'Не удалось изменить порядок категорий.',
    ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

echo json_encode([
    'status' => 'success',
], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
