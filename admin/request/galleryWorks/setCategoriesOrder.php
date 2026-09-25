<?php
require __DIR__ . '/_auth.php';
require_once '../../../base/connect.php';

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$ids = array_values(array_filter(
    array_map('intval', (array)($_POST['ids'] ?? [])),
    static fn(int $id): bool => $id > 0
));

if (!$ids) {
    echo json_encode(['status' => 'error', 'message' => 'Не передан порядок категорий.'], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

try {
    $dbh->beginTransaction();

    $stmt = $dbh->prepare('UPDATE category_gallery_works SET position = :position WHERE id = :id');

    foreach ($ids as $index => $id) {
        $stmt->execute([':position' => $index + 1, ':id' => $id]);
    }

    $dbh->commit();
} catch (Throwable $exception) {
    if ($dbh->inTransaction()) {
        $dbh->rollBack();
    }

    echo json_encode(['status' => 'error', 'message' => 'Не удалось сохранить порядок.'], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

echo json_encode(['status' => 'success'], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
