<?php
require_once '../../../base/connect.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $categoriesStatement = $dbh->prepare('SELECT id, name, main_image, is_hidden, sort_order FROM category_gallery_works ORDER BY sort_order, id');
    $categoriesStatement->execute();
    $categories = $categoriesStatement->fetchAll(PDO::FETCH_ASSOC);

    $imagesStatement = $dbh->prepare('SELECT category, url_image FROM gallery_work_images ORDER BY id ASC');
    $imagesStatement->execute();
    $images = $imagesStatement->fetchAll(PDO::FETCH_ASSOC);

    $firstImages = [];
    foreach ($images as $image) {
        $categoryId = (int) $image['category'];
        if (!isset($firstImages[$categoryId])) {
            $firstImages[$categoryId] = $image['url_image'];
        }
    }

    $fallbackSvg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500"><rect fill="%23f2f2f2" width="500" height="500"/><text x="50%25" y="50%25" dominant-baseline="middle" text-anchor="middle" fill="%23999" font-size="32">Нет изображения</text></svg>';
    $fallbackImage = 'data:image/svg+xml;charset=UTF-8,' . rawurlencode($fallbackSvg);

    $result = [];
    foreach ($categories as $category) {
        $categoryId = (int) $category['id'];
        $mainImage = $category['main_image'] ?? '';
        if ($mainImage !== '' && strpos($mainImage, './') === 0) {
            $mainImage = substr($mainImage, 1);
        }
        $displayImage = $mainImage !== '' ? $mainImage : ($firstImages[$categoryId] ?? $fallbackImage);
        if ($displayImage !== '' && strpos($displayImage, './') === 0) {
            $displayImage = substr($displayImage, 1);
        }

        $result[] = [
            'id' => $categoryId,
            'name' => $category['name'],
            'main_image' => $mainImage,
            'display_image' => $displayImage,
            'is_hidden' => (int) $category['is_hidden'],
            'sort_order' => (int) $category['sort_order'],
        ];
    }

    echo json_encode(['categories' => $result], JSON_UNESCAPED_UNICODE);
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode([
        'categories' => [],
        'message' => 'Не удалось получить категории',
        'error' => $exception->getMessage(),
    ], JSON_UNESCAPED_UNICODE);
}
