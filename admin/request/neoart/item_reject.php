<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
header('Content-Type: application/json; charset=utf-8');
$id = (int)($_POST['id'] ?? 0);
$dbh->prepare("UPDATE neoart_item SET review_status='rejected', updated_at=? WHERE id=?")
    ->execute([date('Y-m-d H:i:s'), $id]);
echo json_encode(['ok' => 1], JSON_UNESCAPED_UNICODE);
