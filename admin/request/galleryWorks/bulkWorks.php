<?php
require __DIR__ . '/_auth.php';
require_once '../../../base/connect.php';

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function jsonResponse(array $payload): void
{
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

$action = $_POST['action'] ?? '';
$ids = array_values(array_unique(array_filter(
    array_map('intval', (array)($_POST['ids'] ?? [])),
    static fn(int $id): bool => $id > 0
)));

if (!$ids || !in_array($action, ['move', 'delete'], true)) {
    jsonResponse(['status' => 'error', 'message' => 'Некорректные параметры запроса.']);
}

$placeholders = implode(',', array_fill(0, count($ids), '?'));

if ($action === 'move') {
    $categoryId = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;

    $categoryStmt = $dbh->prepare('SELECT id FROM category_gallery_works WHERE id = ?');
    $categoryStmt->execute([$categoryId]);

    if ($categoryId <= 0 || !$categoryStmt->fetchColumn()) {
        jsonResponse(['status' => 'error', 'message' => 'Категория для переноса не найдена.']);
    }

    $moveStmt = $dbh->prepare("UPDATE gallery_work_images SET category = ? WHERE id IN ($placeholders)");
    $moveStmt->execute(array_merge([$categoryId], $ids));

    jsonResponse(['status' => 'success', 'count' => count($ids)]);
}

$filesStmt = $dbh->prepare("SELECT url_image FROM gallery_work_images WHERE id IN ($placeholders)");
$filesStmt->execute($ids);
$files = $filesStmt->fetchAll(PDO::FETCH_COLUMN);

try {
    $dbh->beginTransaction();
    $deleteStmt = $dbh->prepare("DELETE FROM gallery_work_images WHERE id IN ($placeholders)");
    $deleteStmt->execute($ids);
    $dbh->commit();
} catch (Throwable $exception) {
    if ($dbh->inTransaction()) {
        $dbh->rollBack();
    }

    jsonResponse(['status' => 'error', 'message' => 'Не удалось удалить работы: ' . $exception->getMessage()]);
}

// Файлы удаляем только после успешного удаления записей
foreach ($files as $path) {
    if (empty($path) || preg_match('/^https?:/i', $path)) {
        continue;
    }

    $filePath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($path, './');

    if (is_file($filePath)) {
        @unlink($filePath);
    }
}

jsonResponse(['status' => 'success', 'count' => count($ids)]);
