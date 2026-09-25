<?php
/*
    Готовые картины (paintings + paintings_images).
    action: list | save | delete
*/
require __DIR__ . '/_bootstrap.php';

const PAINTINGS_DIR = '/фото_картин/';

function painting_get_all(PDO $dbh, ?int $onlyId = null): array
{
    $sql = 'SELECT id, name, avtor, sizes, price_one, active FROM paintings' . ($onlyId ? ' WHERE id = ?' : '') . ' ORDER BY id DESC';
    $stm = $dbh->prepare($sql);
    $stm->execute($onlyId ? [$onlyId] : []);
    $paintings = $stm->fetchAll();

    $images = [];
    $imgStm = $dbh->query('SELECT id, paintings_id, image FROM paintings_images ORDER BY id ASC');

    foreach ($imgStm->fetchAll() as $image) {
        $images[(string)$image['paintings_id']][] = ['id' => (int)$image['id'], 'url' => PAINTINGS_DIR . $image['image']];
    }

    return array_map(fn(array $row) => [
        'id' => (int)$row['id'],
        'name' => (string)$row['name'],
        'author' => (string)$row['avtor'],
        'size' => (string)$row['sizes'],
        'price' => (string)$row['price_one'],
        'active' => (string)$row['active'] === '1' ? 1 : 0,
        'images' => $images[(string)$row['id']] ?? [],
    ], $paintings);
}

/** $_FILES['images'] (multiple) → список отдельных файлов */
function uploaded_list(string $field): array
{
    if (empty($_FILES[$field]['name']) || !is_array($_FILES[$field]['name'])) {
        return [];
    }

    $files = [];

    foreach ($_FILES[$field]['name'] as $index => $name) {
        if ($_FILES[$field]['tmp_name'][$index] === '') {
            continue;
        }

        $files[] = [
            'name' => $name,
            'tmp_name' => $_FILES[$field]['tmp_name'][$index],
            'error' => $_FILES[$field]['error'][$index],
        ];
    }

    return $files;
}

$action = post_str('action', 'list');

if ($action === 'list') {
    json_ok(['data' => painting_get_all($dbh)]);
}

if ($action === 'save') {
    $id = post_int('id');
    $name = post_str('name');
    $author = post_str('author');
    $size = post_str('size');
    $price = post_str('price');
    $active = post_int('active') ? '1' : '0';

    if ($name === '' || $author === '' || $size === '' || $price === '') {
        json_fail('Заполните название, автора, размер и цену.');
    }

    if (!preg_match('/^\d+$/', $price)) {
        json_fail('Цена — целое число в рублях.');
    }

    if ($id && !painting_get_all($dbh, $id)) {
        json_fail('Картина не найдена.');
    }

    $saved = [];

    foreach (uploaded_list('images') as $file) {
        $saved[] = save_uploaded_image('images', PAINTINGS_DIR, [IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png'], $file);
    }

    try {
        $dbh->beginTransaction();

        if ($id) {
            $dbh->prepare('UPDATE paintings SET name = ?, avtor = ?, sizes = ?, price_one = ?, active = ? WHERE id = ?')
                ->execute([$name, $author, $size, $price, $active, $id]);
        } else {
            $dbh->prepare('INSERT INTO paintings (name, avtor, sizes, price_one, active) VALUES (?,?,?,?,?)')
                ->execute([$name, $author, $size, $price, $active]);
            $id = (int)$dbh->lastInsertId();
        }

        $insert = $dbh->prepare('INSERT INTO paintings_images (paintings_id, image) VALUES (?, ?)');

        foreach ($saved as $file) {
            $insert->execute([(string)$id, $file]);
        }

        $removeIds = post_ids('remove_images');
        $removedFiles = [];

        if ($removeIds) {
            $params = array_merge([(string)$id], $removeIds);
            $stm = $dbh->prepare('SELECT image FROM paintings_images WHERE paintings_id = ? AND id IN (' . placeholders($removeIds) . ')');
            $stm->execute($params);
            $removedFiles = $stm->fetchAll(PDO::FETCH_COLUMN);
            $dbh->prepare('DELETE FROM paintings_images WHERE paintings_id = ? AND id IN (' . placeholders($removeIds) . ')')->execute($params);
        }

        $dbh->commit();
    } catch (Throwable $exception) {
        if ($dbh->inTransaction()) {
            $dbh->rollBack();
        }

        foreach ($saved as $file) {
            remove_site_file(PAINTINGS_DIR, $file);
        }

        throw $exception;
    }

    foreach ($removedFiles as $file) {
        remove_site_file(PAINTINGS_DIR, $file);
    }

    json_ok(['data' => painting_get_all($dbh, $id)[0] ?? null]);
}

if ($action === 'delete') {
    $id = post_int('id');

    $stm = $dbh->prepare('SELECT image FROM paintings_images WHERE paintings_id = ?');
    $stm->execute([(string)$id]);
    $files = $stm->fetchAll(PDO::FETCH_COLUMN);

    $dbh->beginTransaction();
    $dbh->prepare('DELETE FROM paintings_images WHERE paintings_id = ?')->execute([(string)$id]);
    $deleted = $dbh->prepare('DELETE FROM paintings WHERE id = ?');
    $deleted->execute([$id]);
    $dbh->commit();

    foreach ($files as $file) {
        remove_site_file(PAINTINGS_DIR, $file);
    }

    json_ok(['deleted' => $deleted->rowCount()]);
}

json_fail('Неизвестное действие.');
