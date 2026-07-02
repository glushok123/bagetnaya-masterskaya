<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
header('Content-Type: application/json; charset=utf-8');

$id = (int)($_POST['id'] ?? 0);
$stmt = $dbh->prepare("SELECT * FROM neoart_item WHERE id=?");
$stmt->execute([$id]);
$r = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$r) { http_response_code(404); echo json_encode(['error' => 'not found'], JSON_UNESCAPED_UNICODE); exit; }
$p = neoart_paths($r['catalog']);
$u = fn($sub, $f) => $f ? ($p[$sub . '_url'] . '/' . $f) : null;
$r['raw_url']      = $u('raw', $r['raw_img']);
$r['listimg_url']  = $u('listimg', $r['listimg']);
$r['imgconst_url'] = $u('imgconst', $r['imgconst']);
echo json_encode(['item' => $r], JSON_UNESCAPED_UNICODE);
