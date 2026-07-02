<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
header('Content-Type: application/json; charset=utf-8');

$catalog = $_POST['catalog'] ?? '';
$filter  = $_POST['filter'] ?? 'all';
$query   = trim((string)($_POST['query'] ?? ''));
if (!isset(neoart_config()['catalogs'][$catalog])) { http_response_code(400); echo json_encode(['error' => 'bad catalog'], JSON_UNESCAPED_UNICODE); exit; }

$where = ['catalog = ?']; $args = [$catalog];
if ($filter === 'flagged')    { $where[] = "cut_status IN('auto_flagged','error')"; }
elseif ($filter === 'ready')  { $where[] = "cut_status IN('auto_ok','manual') AND in_catalog=0 AND review_status='pending'"; }
elseif ($filter === 'in_catalog') { $where[] = "in_catalog=1"; }
if ($query !== '') { $where[] = "vendor LIKE ?"; $args[] = "%$query%"; }

$sql = "SELECT id,vendor,name,width_mm,widthwithout_mm,price_final,storage,cut_status,cut_flags,
               in_catalog,catalog_publicvendor,review_status,raw_img,listimg,imgconst
        FROM neoart_item WHERE " . implode(' AND ', $where) . " ORDER BY id ASC LIMIT 500";
$stmt = $dbh->prepare($sql); $stmt->execute($args);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$p = neoart_paths($catalog);
$u = fn($sub, $f) => $f ? ($p[$sub . '_url'] . '/' . $f) : null;
foreach ($rows as &$r) {
    $r['raw_url']      = $u('raw', $r['raw_img']);
    $r['listimg_url']  = $u('listimg', $r['listimg']);
    $r['imgconst_url'] = $u('imgconst', $r['imgconst']);
}
echo json_encode(['items' => $rows], JSON_UNESCAPED_UNICODE);
