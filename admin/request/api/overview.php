<?php
/*
    Сводка для главной страницы админки.
*/
require __DIR__ . '/_bootstrap.php';

$catalog = $dbh->query(
    "SELECT type,
            COUNT(*) AS total,
            SUM(price = 0) AS no_price,
            SUM(storage > 0) AS in_stock,
            SUM(storage <= 0) AS out_of_stock,
            ROUND(AVG(NULLIF(price, 0))) AS avg_price
     FROM catalog_baget
     GROUP BY type"
)->fetchAll();

$suppliers = $dbh->query(
    "SELECT COALESCE(NULLIF(company, ''), 'manual') AS company, COUNT(*) AS total, MAX(date_update) AS updated_at
     FROM catalog_baget
     GROUP BY COALESCE(NULLIF(company, ''), 'manual')"
)->fetchAll();

$leads = $dbh->query(
    "SELECT SUM(status = 'Активна' OR status IS NULL) AS new_count,
            SUM(created_at >= CURDATE()) AS today,
            SUM(created_at >= CURDATE() - INTERVAL 6 DAY) AS week,
            COUNT(*) AS total
     FROM feed_back"
)->fetch();

// Заявки по дням за последние 14 дней — для мини-графика
$daily = $dbh->query(
    "SELECT DATE(created_at) AS day, COUNT(*) AS total
     FROM feed_back
     WHERE created_at >= CURDATE() - INTERVAL 13 DAY
     GROUP BY DATE(created_at)"
)->fetchAll(PDO::FETCH_KEY_PAIR);

$days = [];

for ($i = 13; $i >= 0; $i--) {
    $day = date('Y-m-d', strtotime("-{$i} days"));
    $days[] = ['day' => $day, 'total' => (int)($daily[$day] ?? 0)];
}

$latest = $dbh->query('SELECT id, name, phone, email AS channel, comment, created_at, status FROM feed_back ORDER BY id DESC LIMIT 6')->fetchAll();

$orders = $dbh->query("SELECT COUNT(*) AS total, SUM(status = 'Активна' OR status IS NULL) AS new_count FROM orders_paintings")->fetch();

$promo = $dbh->query(
    "SELECT SUM(active = '1' AND date_end >= NOW()) AS working, COUNT(*) AS total FROM promo_kods"
)->fetch();

$paintings = $dbh->query("SELECT COUNT(*) AS total, SUM(active = '1') AS active FROM paintings")->fetch();
$works = $dbh->query('SELECT (SELECT COUNT(*) FROM gallery_work_images) AS works, (SELECT COUNT(*) FROM category_gallery_works) AS categories')->fetch();

json_ok([
    'catalog' => array_map(fn($row) => array_map(fn($value) => is_numeric($value) ? (int)$value : $value, $row), $catalog),
    'suppliers' => $suppliers,
    'leads' => array_map('intval', $leads) + ['days' => $days],
    'latest' => array_map(fn($row) => $row + ['is_new' => in_array($row['status'], ['Активна', null], true)], $latest),
    'orders' => array_map('intval', $orders),
    'promo' => array_map('intval', $promo),
    'paintings' => array_map('intval', $paintings),
    'works' => array_map('intval', $works),
]);
