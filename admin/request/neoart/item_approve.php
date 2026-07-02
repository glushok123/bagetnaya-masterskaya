<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
header('Content-Type: application/json; charset=utf-8');

$raw = $_POST['ids'] ?? '';
$ids = is_array($raw) ? $raw : array_filter(array_map('intval', explode(',', (string)$raw)));
$ids = array_values(array_filter(array_map('intval', $ids)));
if (!$ids) { http_response_code(400); echo json_encode(['error' => 'no ids'], JSON_UNESCAPED_UNICODE); exit; }

$biDir = $_SERVER['DOCUMENT_ROOT'] . '/bi';
if (!is_dir($biDir)) @mkdir($biDir, 0775, true);
$now = date('Y-m-d H:i:s');
$results = [];

$sel = $dbh->prepare("SELECT * FROM neoart_item WHERE id=?");
$ins = $dbh->prepare("INSERT INTO catalog_baget(type,publicvendor,vendor,width,widthwithout,price,storage,listimg,imgconst)
                      VALUES(?,?,?,?,?,?,?,?,?)");
$log = $dbh->prepare("INSERT INTO neoart_import_log(vendor,stage,message,created_at) VALUES(?,'publish',?,?)");

foreach ($ids as $id) {
    $sel->execute([$id]); $it = $sel->fetch(PDO::FETCH_ASSOC);
    try {
        if (!$it) throw new RuntimeException('not found');
        if ($it['in_catalog'] == 1) throw new RuntimeException('уже в каталоге');
        if ($it['review_status'] === 'published') throw new RuntimeException('уже опубликован');
        if (!$it['listimg'] || !$it['imgconst']) throw new RuntimeException('нет обеих картинок');

        $p = neoart_paths($it['catalog']);
        $listSrc = "{$p['listimg']}/{$it['listimg']}";
        $constSrc = "{$p['imgconst']}/{$it['imgconst']}";
        if (!is_file($listSrc) || !is_file($constSrc)) throw new RuntimeException('файлы картинок не найдены');

        // publicvendor как в base/addnewbaget.php
        $ai = $dbh->query("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES
                           WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='catalog_baget'")->fetch(PDO::FETCH_ASSOC);
        $publicvendor = (int)$ai['AUTO_INCREMENT'] + 6000;

        $safe = neoart_safe_name($it['vendor']);
        $listName = $publicvendor . $safe . '.jpg';
        $constName = $publicvendor . 't' . $safe . '.jpg';
        if (!copy($listSrc, "$biDir/$listName")) throw new RuntimeException('копия listimg');
        if (!copy($constSrc, "$biDir/$constName")) throw new RuntimeException('копия imgconst');

        $dbh->beginTransaction();
        $ins->execute([$it['catalog'], $publicvendor, $it['vendor'], (int)$it['width_mm'], (int)$it['widthwithout_mm'],
                       (int)$it['price_final'], (int)$it['storage'], $listName, $constName]);
        $dbh->prepare("UPDATE neoart_item SET review_status='published', catalog_publicvendor=?, approved_at=?, updated_at=? WHERE id=?")
            ->execute([$publicvendor, $now, $now, $id]);
        $dbh->commit();
        $results[] = ['id' => $id, 'ok' => 1, 'publicvendor' => $publicvendor];
    } catch (Throwable $ex) {
        if ($dbh->inTransaction()) $dbh->rollBack();
        if ($it) $log->execute([$it['vendor'], $ex->getMessage(), $now]);
        $results[] = ['id' => $id, 'ok' => 0, 'error' => $ex->getMessage()];
    }
}
echo json_encode(['results' => $results], JSON_UNESCAPED_UNICODE);
