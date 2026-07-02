<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/NeoartFeed.php';
header('Content-Type: application/json; charset=utf-8');

$catalog = $_POST['catalog'] ?? '';
$cfg = neoart_config();
if (!isset($cfg['catalogs'][$catalog])) {
    http_response_code(400);
    echo json_encode(['error' => 'Неизвестный каталог'], JSON_UNESCAPED_UNICODE);
    exit;
}
$catCfg = $cfg['catalogs'][$catalog];
$now = date('Y-m-d H:i:s');

try {
    $elements = NeoartFeed::fetch($catalog);
    $sections = NeoartFeed::sections($catalog);

    // артикулы уже в живом каталоге
    $existing = [];
    foreach ($dbh->query("SELECT vendor, publicvendor FROM catalog_baget WHERE type = " . $dbh->quote($catalog)) as $r) {
        $existing[trim((string)$r['vendor'])] = $r['publicvendor'];
    }

    // создаём run
    $dbh->prepare("INSERT INTO neoart_import_run(catalog,status,started_at) VALUES(?, 'running', ?)")
        ->execute([$catalog, $now]);
    $runId = (int)$dbh->lastInsertId();

    $ins = $dbh->prepare(
        "INSERT INTO neoart_item
          (run_id,catalog,vendor,name,section_id,section_name,width_mm,widthwithout_mm,height_mm,
           price_base,price_chop,price_final,storage,in_catalog,catalog_publicvendor,created_at,updated_at)
         VALUES (:run,:cat,:vendor,:name,:sid,:sname,:w,:ww,:h,:pb,:pc,:pf,:st,:inc,:cpv,:now,:now)
         ON DUPLICATE KEY UPDATE
           run_id=:run, name=:name, section_id=:sid, section_name=:sname,
           width_mm=:w, widthwithout_mm=:ww, height_mm=:h,
           price_base=:pb, price_chop=:pc, price_final=:pf, storage=:st,
           in_catalog=:inc, catalog_publicvendor=:cpv, updated_at=:now"
    );

    $vendors = []; $new = 0; $have = 0;
    foreach ($elements as $e) {
        $rec = NeoartFeed::record($e, $sections, $catCfg);
        if ($rec === null) continue;
        $inCatalog = array_key_exists($rec['vendor'], $existing);
        $inCatalog ? $have++ : $new++;
        $ins->execute([
            ':run' => $runId, ':cat' => $catalog, ':vendor' => $rec['vendor'], ':name' => $rec['name'],
            ':sid' => $rec['section_id'], ':sname' => $rec['section_name'],
            ':w' => $rec['width_mm'], ':ww' => $rec['widthwithout_mm'], ':h' => $rec['height_mm'],
            ':pb' => $rec['price_base'], ':pc' => $rec['price_chop'], ':pf' => $rec['price_final'],
            ':st' => $rec['storage'], ':inc' => $inCatalog ? 1 : 0,
            ':cpv' => $inCatalog ? $existing[$rec['vendor']] : null, ':now' => $now,
        ]);
        $vendors[] = $rec['vendor'];
    }

    $dbh->prepare("UPDATE neoart_import_run SET total=? WHERE id=?")->execute([count($vendors), $runId]);
    echo json_encode(['run_id' => $runId, 'total' => count($vendors), 'new' => $new, 'existing' => $have, 'vendors' => $vendors], JSON_UNESCAPED_UNICODE);
} catch (Throwable $ex) {
    http_response_code(500);
    echo json_encode(['error' => $ex->getMessage()], JSON_UNESCAPED_UNICODE);
}
