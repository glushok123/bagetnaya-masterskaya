<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
header('Content-Type: application/json; charset=utf-8');

$id = (int)($_POST['id'] ?? 0);
if (!$id) { http_response_code(400); echo json_encode(['error' => 'no id'], JSON_UNESCAPED_UNICODE); exit; }

$width        = max(0, (int)($_POST['width_mm'] ?? 0));
$widthwithout = max(0, (int)($_POST['widthwithout_mm'] ?? 0));
$price        = max(0, (int)($_POST['price_final'] ?? 0));
$storage      = max(0, (int)($_POST['storage'] ?? 0));
$section      = mb_substr(trim((string)($_POST['section_name'] ?? '')), 0, 255);

try {
    $stmt = $dbh->prepare(
        "UPDATE neoart_item SET width_mm=?, widthwithout_mm=?, price_final=?, storage=?, section_name=?, updated_at=? WHERE id=?"
    );
    $stmt->execute([$width, $widthwithout, $price, $storage, $section, date('Y-m-d H:i:s'), $id]);
    echo json_encode(['ok' => 1], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
