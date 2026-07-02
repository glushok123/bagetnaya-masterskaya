<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/NeoartCutter.php';
header('Content-Type: application/json; charset=utf-8');

$catalog = $_POST['catalog'] ?? '';
$offset  = max(0, (int)($_POST['offset'] ?? 0));
$size    = min(20, max(1, (int)($_POST['size'] ?? 8)));
$cfg = neoart_config();
if (!isset($cfg['catalogs'][$catalog])) { http_response_code(400); echo json_encode(['error' => 'bad catalog'], JSON_UNESCAPED_UNICODE); exit; }

$paths = neoart_paths($catalog);
$now = date('Y-m-d H:i:s');

$all = $dbh->prepare("SELECT id,vendor,raw_img FROM neoart_item
                      WHERE catalog=? AND raw_img IS NOT NULL AND cut_status IN('none','error')
                      ORDER BY id ASC");
$all->execute([$catalog]);
$rows = $all->fetchAll(PDO::FETCH_ASSOC);
$total = count($rows);
$batch = array_slice($rows, $offset, $size);

$cutter = new NeoartCutter();
$upd = $dbh->prepare("UPDATE neoart_item SET listimg=?, imgconst=?, cut_status=?, cut_flags=?, updated_at=? WHERE id=?");
$log = $dbh->prepare("INSERT INTO neoart_import_log(vendor,stage,message,created_at) VALUES(?,'cut',?,?)");

$ok = 0; $flagged = 0; $err = 0;
foreach ($batch as $r) {
    $base = neoart_safe_name($r['vendor']) . '.jpg';
    $rawPath = "{$paths['raw']}/{$r['raw_img']}";
    $listOut = "{$paths['listimg']}/$base";
    $constOut = "{$paths['imgconst']}/$base";
    $res = $cutter->cut($rawPath, $listOut, $constOut);
    if ($res['status'] === 'error') {
        $err++;
        $upd->execute([null, null, 'error', implode(',', $res['flags']), $now, $r['id']]);
        $log->execute([$r['vendor'], 'нарезка: ' . implode(',', $res['flags']), $now]);
    } else {
        $res['status'] === 'auto_flagged' ? $flagged++ : $ok++;
        $upd->execute([$base, $base, $res['status'], implode(',', $res['flags']) ?: null, $now, $r['id']]);
    }
}
$nextOffset = $offset + $size;
$done = min($nextOffset, $total);
echo json_encode(['done' => $done, 'total' => $total, 'ok' => $ok, 'flagged' => $flagged, 'err' => $err, 'next_offset' => $nextOffset], JSON_UNESCAPED_UNICODE);
