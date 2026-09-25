<?php
/*
    Промокоды (promo_kods). Код действует на сайте, если active = 1 и date_end ещё не наступила.
    action: list | save | delete
*/
require __DIR__ . '/_bootstrap.php';

function promo_row(array $row): array
{
    $percent = (int)($row['sale_procent'] ?? 0);
    $rub = (int)($row['sale_count'] ?? 0);
    $active = (string)$row['active'] === '1';
    $dateEnd = $row['date_end'] ? substr((string)$row['date_end'], 0, 10) : '';
    $expired = !$dateEnd || strtotime((string)$row['date_end']) < time();

    return [
        'code' => (string)$row['series_id'],
        'kind' => $percent > 0 ? 'percent' : 'rub',
        'value' => $percent > 0 ? $percent : $rub,
        'active' => $active ? 1 : 0,
        'date_end' => $dateEnd,
        // Как код ведёт себя на сайте прямо сейчас
        'state' => !$active ? 'off' : ($expired ? 'expired' : 'on'),
    ];
}

function promo_get(PDO $dbh, string $code): ?array
{
    $stm = $dbh->prepare('SELECT series_id, sale_procent, sale_count, active, date_end FROM promo_kods WHERE series_id = ? LIMIT 1');
    $stm->execute([$code]);
    $row = $stm->fetch();

    return $row ? promo_row($row) : null;
}

$action = post_str('action', 'list');

if ($action === 'list') {
    $rows = $dbh->query('SELECT series_id, sale_procent, sale_count, active, date_end FROM promo_kods ORDER BY date_end DESC, series_id ASC')->fetchAll();

    json_ok(['data' => array_map('promo_row', $rows)]);
}

if ($action === 'save') {
    $original = post_str('original');
    $code = post_str('code');
    $kind = post_str('kind') === 'rub' ? 'rub' : 'percent';
    $value = post_int('value');
    $active = post_int('active') ? '1' : '0';
    $dateEnd = post_str('date_end');

    if ($code === '' || mb_strlen($code) > 100) {
        json_fail('Укажите код (до 100 символов).');
    }

    if (preg_match('/\s/u', $code)) {
        json_fail('В коде не должно быть пробелов.');
    }

    if ($value <= 0 || ($kind === 'percent' && $value > 100)) {
        json_fail($kind === 'percent' ? 'Скидка — от 1 до 100 %.' : 'Скидка в рублях — больше нуля.');
    }

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateEnd) || !strtotime($dateEnd)) {
        json_fail('Укажите дату, до которой действует код.');
    }

    if ($code !== $original && promo_get($dbh, $code)) {
        json_fail('Код «' . $code . '» уже существует.');
    }

    $values = [
        $code,
        $kind === 'percent' ? (string)$value : null,
        $kind === 'rub' ? (string)$value : null,
        $active,
        $dateEnd . ' 23:59:59',
    ];

    if ($original !== '') {
        if (!promo_get($dbh, $original)) {
            json_fail('Промокод не найден.');
        }

        $stm = $dbh->prepare('UPDATE promo_kods SET series_id = ?, sale_procent = ?, sale_count = ?, active = ?, date_end = ? WHERE series_id = ?');
        $stm->execute(array_merge($values, [$original]));
    } else {
        $stm = $dbh->prepare('INSERT INTO promo_kods (series_id, sale_procent, sale_count, active, date_end) VALUES (?,?,?,?,?)');
        $stm->execute($values);
    }

    json_ok(['data' => promo_get($dbh, $code)]);
}

if ($action === 'delete') {
    $codes = isset($_POST['codes']) && is_array($_POST['codes']) ? array_values(array_filter(array_map('strval', $_POST['codes']))) : [];

    if (!$codes) {
        json_fail('Не выбраны промокоды.');
    }

    $stm = $dbh->prepare('DELETE FROM promo_kods WHERE series_id IN (' . placeholders($codes) . ')');
    $stm->execute($codes);

    json_ok(['deleted' => $stm->rowCount()]);
}

json_fail('Неизвестное действие.');
