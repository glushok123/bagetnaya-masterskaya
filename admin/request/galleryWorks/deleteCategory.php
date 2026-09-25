<?php
session_start();
require_once '../../../base/connect.php';

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function jsonResponse(array $payload): void
{
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

function removeUploadedFile(?string $path): void
{
    if (empty($path) || preg_match('/^https?:/i', $path)) {
        return;
    }

    $filePath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($path, './');

    if (is_file($filePath)) {
        @unlink($filePath);
    }
}

// Удаление необратимо — только для авторизованного администратора
if (!isset($_SESSION['user_logged_in'])) {
    http_response_code(403);
    jsonResponse([
        'status' => 'error',
        'message' => 'Нет доступа. Войдите в админку заново.',
    ]);
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$mode = $_POST['mode'] ?? 'move';
$targetId = isset($_POST['target_id']) ? (int)$_POST['target_id'] : 0;

if ($id <= 0 || !in_array($mode, ['move', 'delete'], true)) {
    jsonResponse([
        'status' => 'error',
        'message' => 'Некорректные параметры запроса.',
    ]);
}

$stmt = $dbh->prepare('SELECT id, name, main_image FROM category_gallery_works WHERE id = :id');
$stmt->execute([':id' => $id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    jsonResponse([
        'status' => 'error',
        'message' => 'Категория не найдена.',
    ]);
}

$countStmt = $dbh->prepare('SELECT COUNT(*) FROM gallery_work_images WHERE category = :id');
$countStmt->execute([':id' => $id]);
$worksCount = (int)$countStmt->fetchColumn();

if ($worksCount > 0 && $mode === 'move') {
    if ($targetId <= 0 || $targetId === $id) {
        jsonResponse([
            'status' => 'error',
            'message' => 'Выберите категорию, в которую перенести работы.',
        ]);
    }

    $targetStmt = $dbh->prepare('SELECT id FROM category_gallery_works WHERE id = :id');
    $targetStmt->execute([':id' => $targetId]);

    if (!$targetStmt->fetchColumn()) {
        jsonResponse([
            'status' => 'error',
            'message' => 'Категория для переноса не найдена.',
        ]);
    }
}

$filesToRemove = [];

try {
    $dbh->beginTransaction();

    if ($worksCount > 0) {
        if ($mode === 'move') {
            $moveStmt = $dbh->prepare('UPDATE gallery_work_images SET category = :target WHERE category = :id');
            $moveStmt->execute([':target' => $targetId, ':id' => $id]);
        } else {
            $imagesStmt = $dbh->prepare('SELECT url_image FROM gallery_work_images WHERE category = :id');
            $imagesStmt->execute([':id' => $id]);
            $filesToRemove = $imagesStmt->fetchAll(PDO::FETCH_COLUMN);

            $deleteWorksStmt = $dbh->prepare('DELETE FROM gallery_work_images WHERE category = :id');
            $deleteWorksStmt->execute([':id' => $id]);
        }
    }

    $deleteStmt = $dbh->prepare('DELETE FROM category_gallery_works WHERE id = :id');
    $deleteStmt->execute([':id' => $id]);

    $dbh->commit();
} catch (Throwable $exception) {
    if ($dbh->inTransaction()) {
        $dbh->rollBack();
    }

    jsonResponse([
        'status' => 'error',
        'message' => 'Не удалось удалить категорию: ' . $exception->getMessage(),
    ]);
}

// Файлы удаляем только после успешного коммита
removeUploadedFile($category['main_image']);

foreach ($filesToRemove as $filePath) {
    removeUploadedFile($filePath);
}

jsonResponse([
    'status' => 'success',
    'moved' => $mode === 'move' ? $worksCount : 0,
    'deleted_works' => $mode === 'delete' ? $worksCount : 0,
]);
