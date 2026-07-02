<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/NeoartCutter.php';
header('Content-Type: application/json; charset=utf-8');

$id = (int)($_POST['id'] ?? 0);
$stmt = $dbh->prepare("SELECT * FROM neoart_item WHERE id=?"); $stmt->execute([$id]);
$it = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$it || !$it['raw_img']) { http_response_code(404); echo json_encode(['error' => 'no raw'], JSON_UNESCAPED_UNICODE); exit; }

$p = neoart_paths($it['catalog']);
$base = neoart_safe_name($it['vendor']) . '.jpg';
$cutter = new NeoartCutter();
$res = $cutter->cut("{$p['raw']}/{$it['raw_img']}", "{$p['listimg']}/$base", "{$p['imgconst']}/$base");
$listimg = $res['status'] === 'error' ? null : $base;
$dbh->prepare("UPDATE neoart_item SET listimg=?, imgconst=?, cut_status=?, cut_flags=?, updated_at=? WHERE id=?")
    ->execute([$listimg, $listimg, $res['status'], implode(',', $res['flags']) ?: null, date('Y-m-d H:i:s'), $id]);
echo json_encode(['ok' => 1, 'cut_status' => $res['status'], 'cut_flags' => implode(',', $res['flags'])], JSON_UNESCAPED_UNICODE);
