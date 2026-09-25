<?php
/*
    Заявки с сайта: обратная связь (feed_back) и заказы картин (orders_paintings).
    source: feedback | orders
    action: list | status | delete
*/
require __DIR__ . '/_bootstrap.php';

// Статус хранится текстом (varchar(10)); «Активна» — значение по умолчанию для новой заявки
const LEAD_STATUSES = ['new' => 'Активна', 'work' => 'В работе', 'done' => 'Закрыта'];

function lead_status_key(?string $status): string
{
    $key = array_search((string)$status, LEAD_STATUSES, true);

    return $key === false ? 'new' : $key;
}

$source = post_str('source') === 'orders' ? 'orders' : 'feedback';
$table = $source === 'orders' ? 'orders_paintings' : 'feed_back';
$action = post_str('action', 'list');

if ($action === 'list') {
    if ($source === 'orders') {
        $rows = $dbh->query(
            'SELECT o.id, o.name, o.email, o.phone, o.status, o.painting_id, o.type_dostavky, o.address, o.comment, o.created_at,
                    p.name AS painting_name, p.price_one AS painting_price,
                    (SELECT pi.image FROM paintings_images pi WHERE pi.paintings_id = o.painting_id ORDER BY pi.id LIMIT 1) AS painting_image
             FROM orders_paintings o
             LEFT JOIN paintings p ON p.id = o.painting_id
             ORDER BY o.id DESC'
        )->fetchAll();
    } else {
        $rows = $dbh->query('SELECT id, name, email, phone, status, comment, created_at FROM feed_back ORDER BY id DESC')->fetchAll();
    }

    $data = array_map(function (array $row) use ($source) {
        $item = [
            'id' => (int)$row['id'],
            'name' => (string)$row['name'],
            'phone' => (string)$row['phone'],
            'comment' => (string)($row['comment'] ?? ''),
            'created_at' => $row['created_at'],
            'status' => lead_status_key($row['status']),
        ];

        if ($source === 'orders') {
            $item += [
                'email' => (string)$row['email'],
                'painting_id' => (string)$row['painting_id'],
                'painting_name' => (string)($row['painting_name'] ?? ''),
                'painting_price' => (string)($row['painting_price'] ?? ''),
                'painting_image' => $row['painting_image'] ? '/фото_картин/' . $row['painting_image'] : '',
                'delivery' => (string)($row['type_dostavky'] ?? ''),
                'address' => (string)($row['address'] ?? ''),
            ];
        } else {
            // В feed_back поле email хранит способ связи: «Позвоните мне», «Напишите мне в whatsapp»…
            $item['channel'] = (string)$row['email'];
        }

        return $item;
    }, $rows);

    json_ok(['data' => $data]);
}

if ($action === 'status') {
    $ids = post_ids();
    $status = post_str('status');

    if (!$ids || !isset(LEAD_STATUSES[$status])) {
        json_fail('Не выбраны заявки или статус.');
    }

    $stm = $dbh->prepare("UPDATE {$table} SET status = ?, updated_at = NOW() WHERE id IN (" . placeholders($ids) . ')');
    $stm->execute(array_merge([LEAD_STATUSES[$status]], $ids));

    json_ok(['updated' => $stm->rowCount()]);
}

if ($action === 'delete') {
    $ids = post_ids();

    if (!$ids) {
        json_fail('Не выбраны заявки.');
    }

    $stm = $dbh->prepare("DELETE FROM {$table} WHERE id IN (" . placeholders($ids) . ')');
    $stm->execute($ids);

    json_ok(['deleted' => $stm->rowCount()]);
}

json_fail('Неизвестное действие.');
