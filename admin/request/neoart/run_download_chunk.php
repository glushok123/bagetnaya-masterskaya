<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
header('Content-Type: application/json; charset=utf-8');

$runId   = (int)($_POST['run_id'] ?? 0);
$catalog = $_POST['catalog'] ?? '';
$offset  = max(0, (int)($_POST['offset'] ?? 0));
$size    = min(30, max(1, (int)($_POST['size'] ?? 15)));
$cfg = neoart_config();
$cat = $cfg['catalogs'][$catalog] ?? null;
if (!$cat || !$runId) { http_response_code(400); echo json_encode(['error' => 'bad params'], JSON_UNESCAPED_UNICODE); exit; }

$paths = neoart_paths($catalog);
$imgUrlBase = "{$cfg['api_base']}?{$cfg['api_auth']}&action=image&catalog={$cat['id']}&art=";
$now = date('Y-m-d H:i:s');

// весь список артикулов run (id по возрастанию) — берём окно
$all = $dbh->prepare("SELECT id, vendor, download_error FROM neoart_item WHERE run_id=? AND catalog=? ORDER BY id ASC");
$all->execute([$runId, $catalog]);
$rows = $all->fetchAll(PDO::FETCH_ASSOC);
$total = count($rows);
$batch = array_slice($rows, $offset, $size);

$logStmt = $dbh->prepare("INSERT INTO neoart_import_log(run_id,vendor,stage,message,created_at) VALUES(?,?,'download',?,?)");
$updOk  = $dbh->prepare("UPDATE neoart_item SET raw_img=?, download_error=NULL, updated_at=? WHERE id=?");
$updErr = $dbh->prepare("UPDATE neoart_item SET download_error=?, updated_at=? WHERE id=?");

$ok = 0; $failed = 0;
$mh = curl_multi_init();
$handles = [];
foreach ($batch as $r) {
    $file = "{$paths['raw']}/" . neoart_safe_name($r['vendor']) . '.jpg';
    if (is_file($file) && filesize($file) > 1000) { $ok++; continue; } // возобновление
    $art = str_replace('%2F', '/', rawurlencode(str_replace('\\', '/', $r['vendor'])));
    $ch = curl_init($imgUrlBase . $art);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CONNECTTIMEOUT => 30, CURLOPT_TIMEOUT => 90,
        CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; NeoartImport/1.0)',
    ]);
    curl_multi_add_handle($mh, $ch);
    $handles[] = [$ch, $r, $file];
}
do { $st = curl_multi_exec($mh, $running); if ($running) curl_multi_select($mh, 1.0); } while ($running && $st === CURLM_OK);

foreach ($handles as [$ch, $r, $file]) {
    $body = curl_multi_getcontent($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($body !== false && strlen((string)$body) > 1000 && substr((string)$body, 0, 2) === "\xFF\xD8" && $code >= 200 && $code < 400) {
        file_put_contents($file, $body);
        $updOk->execute([basename($file), $now, $r['id']]);
        $ok++;
    } else {
        $msg = "HTTP $code";
        $updErr->execute([$msg, $now, $r['id']]);
        if (empty($r['download_error'])) {
            $logStmt->execute([$runId, $r['vendor'], $msg, $now]);
        }
        $failed++;
    }
    curl_multi_remove_handle($mh, $ch); curl_close($ch);
}
curl_multi_close($mh);

$nextOffset = $offset + $size;
$done = min($nextOffset, $total);
// счётчики run пересчитываем из состояния позиций (идемпотентно — устойчиво к повторным вызовам/возобновлению)
$dbh->prepare(
    "UPDATE neoart_import_run r SET
       downloaded=(SELECT COUNT(*) FROM neoart_item WHERE run_id=r.id AND raw_img IS NOT NULL),
       failed=(SELECT COUNT(*) FROM neoart_item WHERE run_id=r.id AND download_error IS NOT NULL AND raw_img IS NULL)
     WHERE r.id=?"
)->execute([$runId]);
if ($done >= $total) {
    $dbh->prepare("UPDATE neoart_import_run SET status='done', finished_at=? WHERE id=?")->execute([$now, $runId]);
}
echo json_encode(['done' => $done, 'total' => $total, 'ok' => $ok, 'failed' => $failed, 'next_offset' => $nextOffset], JSON_UNESCAPED_UNICODE);
