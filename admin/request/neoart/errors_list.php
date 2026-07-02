<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
header('Content-Type: application/json; charset=utf-8');
$catalog = $_POST['catalog'] ?? '';
$stmt = $dbh->prepare(
    "SELECT l.vendor,l.stage,l.message,l.created_at
     FROM neoart_import_log l
     LEFT JOIN neoart_item i ON i.vendor=l.vendor AND i.catalog=?
     WHERE (? = '' OR i.catalog=? OR l.vendor IS NULL)
     ORDER BY l.id DESC LIMIT 100"
);
$stmt->execute([$catalog, $catalog, $catalog]);
echo json_encode(['items' => $stmt->fetchAll(PDO::FETCH_ASSOC)], JSON_UNESCAPED_UNICODE);
