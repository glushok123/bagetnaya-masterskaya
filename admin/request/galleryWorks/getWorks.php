<?php
require __DIR__ . '/_auth.php';
require_once '../../../base/connect.php';

$categoryId = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;

if ($categoryId > 0) {
    $stmt = $dbh->prepare('SELECT id, category, url_image, description FROM gallery_work_images WHERE category = :category ORDER BY id DESC');
    $stmt->execute([':category' => $categoryId]);
} else {
    $stmt = $dbh->prepare('SELECT id, category, url_image, description FROM gallery_work_images ORDER BY id DESC');
    $stmt->execute();
}

$works = [];

foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $url = (string)$row['url_image'];

    if ($url !== '' && !preg_match('/^https?:/i', $url)) {
        $url = '/' . ltrim($url, './');
    }

    $works[] = [
        'id' => (int)$row['id'],
        'category' => (int)$row['category'],
        'url_image' => $url,
        'description' => (string)($row['description'] ?? ''),
    ];
}

echo json_encode([
    'status' => 'success',
    'data' => $works,
], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
