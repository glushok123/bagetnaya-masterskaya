<?php
/*
    Каталог багета и паспарту (catalog_baget).
    action: list | save | create | delete
*/
require __DIR__ . '/_bootstrap.php';

const CATALOG_TYPES = ['plast', 'wood', 'alum', 'pasp'];
const CATALOG_FIELDS = 'id, type, publicvendor, vendor, name, company, date_update, price, width, widthwithout, storage, color, fixed_price, listimg, imgconst, color_m1, color_m2, color_m3_1';

function catalog_dir(string $type): string
{
    return $type === 'pasp' ? '/pi/' : '/bi/';
}

function catalog_row(array $row): array
{
    $dir = catalog_dir((string)$row['type']);

    return [
        'id' => (int)$row['id'],
        'type' => $row['type'],
        'publicvendor' => (string)$row['publicvendor'],
        'vendor' => (string)$row['vendor'],
        'name' => (string)($row['name'] ?? ''),
        'company' => (string)($row['company'] ?? ''),
        'date_update' => $row['date_update'],
        'price' => (int)$row['price'],
        'width' => (int)$row['width'],
        'widthwithout' => (int)$row['widthwithout'],
        'storage' => (int)$row['storage'],
        'color' => (string)($row['color'] ?? ''),
        'fixed_price' => (int)!empty($row['fixed_price']),
        'listimg' => $row['listimg'] ? $dir . $row['listimg'] : '',
        'imgconst' => $row['imgconst'] ? $dir . $row['imgconst'] : '',
        'colors' => array_values(array_filter([$row['color_m1'] ?? '', $row['color_m2'] ?? '', $row['color_m3_1'] ?? ''])),
    ];
}

function catalog_get(PDO $dbh, int $id): ?array
{
    $stm = $dbh->prepare('SELECT ' . CATALOG_FIELDS . ' FROM catalog_baget WHERE id = ?');
    $stm->execute([$id]);
    $row = $stm->fetch();

    return $row ? catalog_row($row) : null;
}

function non_negative(string $key, string $label): int
{
    $value = post_str($key);

    if ($value === '' || !preg_match('/^\d+$/', $value)) {
        json_fail('Поле «' . $label . '» — целое число не меньше нуля.');
    }

    return (int)$value;
}

$action = post_str('action', 'list');

if ($action === 'list') {
    $type = post_str('type');

    if (!in_array($type, CATALOG_TYPES, true)) {
        json_fail('Неизвестный тип каталога.');
    }

    $stm = $dbh->prepare('SELECT ' . CATALOG_FIELDS . ' FROM catalog_baget WHERE type = ? ORDER BY publicvendor DESC');
    $stm->execute([$type]);

    $counts = $dbh->query('SELECT type, COUNT(*) FROM catalog_baget GROUP BY type')->fetchAll(PDO::FETCH_KEY_PAIR);

    json_ok(['data' => array_map('catalog_row', $stm->fetchAll()), 'counts' => array_map('intval', $counts)]);
}

if ($action === 'save') {
    $id = post_int('id');
    $item = catalog_get($dbh, $id);

    if (!$item) {
        json_fail('Позиция не найдена.');
    }

    $stm = $dbh->prepare('UPDATE catalog_baget SET price = ?, width = ?, widthwithout = ?, storage = ?, color = ?, fixed_price = ? WHERE id = ?');
    $stm->execute([
        non_negative('price', 'Цена'),
        non_negative('width', 'Ширина'),
        non_negative('widthwithout', 'Без четверти'),
        non_negative('storage', 'Остаток'),
        post_str('color'),
        post_int('fixed_price') ? 1 : 0,
        $id,
    ]);

    json_ok(['data' => catalog_get($dbh, $id)]);
}

if ($action === 'create') {
    $type = post_str('type');

    if (!in_array($type, CATALOG_TYPES, true)) {
        json_fail('Выберите тип.');
    }

    $isPasp = $type === 'pasp';
    $price = non_negative('price', 'Цена');
    $width = $isPasp ? 0 : non_negative('width', 'Ширина');
    $widthwithout = $isPasp ? 0 : non_negative('widthwithout', 'Без четверти');
    $storage = post_str('storage') === '' ? 30 : non_negative('storage', 'Остаток');

    if (empty($_FILES['listimg']['tmp_name']) || empty($_FILES['imgconst']['tmp_name'])) {
        json_fail('Нужны обе картинки: для каталога и для конструктора.');
    }

    $jpegOnly = [IMAGETYPE_JPEG => 'jpg'];
    $listimg = save_uploaded_image('listimg', catalog_dir($type), $jpegOnly);
    $imgconst = save_uploaded_image('imgconst', catalog_dir($type), $jpegOnly);

    // Публичный артикул — как было: следующий id + 6000
    $next = $dbh->query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'catalog_baget'")->fetchColumn();
    $publicvendor = (int)$next + 6000;

    try {
        $stm = $dbh->prepare('INSERT INTO catalog_baget (type, publicvendor, vendor, width, widthwithout, price, storage, listimg, imgconst, color, fixed_price) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
        $stm->execute([
            $type,
            $publicvendor,
            post_str('vendor'),
            $width,
            $widthwithout,
            $price,
            $storage,
            $listimg,
            $imgconst,
            post_str('color') !== '' ? post_str('color') : 'Без названия',
            post_int('fixed_price') ? 1 : 0,
        ]);
    } catch (Throwable $exception) {
        remove_site_file(catalog_dir($type), $listimg);
        remove_site_file(catalog_dir($type), $imgconst);
        throw $exception;
    }

    json_ok(['data' => catalog_get($dbh, (int)$dbh->lastInsertId())]);
}

if ($action === 'delete') {
    $ids = post_ids();

    if (!$ids) {
        json_fail('Не выбраны позиции.');
    }

    $stm = $dbh->prepare('SELECT id, type, listimg, imgconst FROM catalog_baget WHERE id IN (' . placeholders($ids) . ')');
    $stm->execute($ids);
    $rows = $stm->fetchAll();

    $dbh->prepare('DELETE FROM catalog_baget WHERE id IN (' . placeholders($ids) . ')')->execute($ids);

    foreach ($rows as $row) {
        remove_site_file(catalog_dir($row['type']), $row['listimg']);
        remove_site_file(catalog_dir($row['type']), $row['imgconst']);
    }

    json_ok(['deleted' => count($rows)]);
}

json_fail('Неизвестное действие.');
