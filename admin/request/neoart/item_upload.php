<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
header('Content-Type: application/json; charset=utf-8');

$id = (int)($_POST['id'] ?? 0);
$which = $_POST['which'] ?? '';
if (!in_array($which, ['raw', 'listimg', 'imgconst'], true) || empty($_FILES['file'])) {
    http_response_code(400); echo json_encode(['error' => 'bad params'], JSON_UNESCAPED_UNICODE); exit;
}
$stmt = $dbh->prepare("SELECT * FROM neoart_item WHERE id=?"); $stmt->execute([$id]);
$it = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$it) { http_response_code(404); echo json_encode(['error' => 'not found'], JSON_UNESCAPED_UNICODE); exit; }

$info = @getimagesize($_FILES['file']['tmp_name']);
if (!$info || $info[2] !== IMAGETYPE_JPEG) { http_response_code(400); echo json_encode(['error' => 'нужен JPEG'], JSON_UNESCAPED_UNICODE); exit; }

$p = neoart_paths($it['catalog']);
$base = neoart_safe_name($it['vendor']) . '.jpg';
$dest = "{$p[$which]}/$base";
if (!move_uploaded_file($_FILES['file']['tmp_name'], $dest)) { http_response_code(500); echo json_encode(['error' => 'save failed'], JSON_UNESCAPED_UNICODE); exit; }

$now = date('Y-m-d H:i:s');
if ($which === 'raw') {
    $dbh->prepare("UPDATE neoart_item SET raw_img=?, updated_at=? WHERE id=?")->execute([$base, $now, $id]);
} else {
    // $which ∈ {listimg,imgconst} (whitelisted) → имя колонки безопасно
    $cropCol = $which . '_crop';
    $crop = isset($_POST['crop']) ? substr((string)$_POST['crop'], 0, 2000) : null;
    $dbh->prepare("UPDATE neoart_item SET $which=?, cut_status='manual', $cropCol=?, updated_at=? WHERE id=?")
        ->execute([$base, $crop, $now, $id]);
}
echo json_encode(['ok' => 1, 'url' => $p[$which . '_url'] . '/' . $base . '?t=' . time()], JSON_UNESCAPED_UNICODE);
