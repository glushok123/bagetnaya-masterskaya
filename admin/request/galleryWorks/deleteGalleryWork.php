<?php
require_once '../../../base/connect.php';

header('Content-Type: application/json; charset=utf-8');

$workId = isset($_POST['id']) ? (int) $_POST['id'] : 0;

if ($workId <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Некорректный идентификатор работы']);
    return;
}

try {
    $statement = $dbh->prepare('SELECT url_image FROM gallery_work_images WHERE id = :id');
    $statement->bindValue(':id', $workId, PDO::PARAM_INT);
    $statement->execute();
    $work = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$work) {
        echo json_encode(['status' => 'error', 'message' => 'Работа не найдена']);
        return;
    }

    $deleteStatement = $dbh->prepare('DELETE FROM gallery_work_images WHERE id = :id');
    $deleteStatement->bindValue(':id', $workId, PDO::PARAM_INT);
    $deleteStatement->execute();

    if (!empty($work['url_image'])) {
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($work['url_image'], './');
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }

    echo json_encode(['status' => 'success']);
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Не удалось удалить работу',
        'error' => $exception->getMessage(),
    ]);
}
