<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/NeoartCutter.php';
header('Content-Type: application/json; charset=utf-8');

$id = (int)($_POST['id'] ?? 0);
$which = $_POST['which'] ?? '';
if (!in_array($which, ['listimg', 'imgconst'], true)) { http_response_code(400); echo json_encode(['error' => 'bad which'], JSON_UNESCAPED_UNICODE); exit; }

$stmt = $dbh->prepare("SELECT * FROM neoart_item WHERE id=?"); $stmt->execute([$id]);
$it = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$it || !$it['raw_img']) { http_response_code(404); echo json_encode(['error' => 'no raw'], JSON_UNESCAPED_UNICODE); exit; }

$p = neoart_paths($it['catalog']);
$rawPath = "{$p['raw']}/{$it['raw_img']}";
$base = neoart_safe_name($it['vendor']) . '.jpg';
$rect = ['x' => (int)$_POST['x'], 'y' => (int)$_POST['y'], 'w' => (int)$_POST['w'], 'h' => (int)$_POST['h']];

$cutter = new NeoartCutter();
$out = "{$p[$which]}/$base";
$ok = $which === 'listimg' ? $cutter->cropListimg($rawPath, $rect, $out) : $cutter->cropImgconst($rawPath, $rect, $out);
if (!$ok) { http_response_code(500); echo json_encode(['error' => 'crop failed'], JSON_UNESCAPED_UNICODE); exit; }

$dbh->prepare("UPDATE neoart_item SET $which=?, cut_status='manual', updated_at=? WHERE id=?")
    ->execute([$base, date('Y-m-d H:i:s'), $id]);
echo json_encode(['ok' => 1, 'url' => $p[$which . '_url'] . '/' . $base . '?t=' . time()], JSON_UNESCAPED_UNICODE);
