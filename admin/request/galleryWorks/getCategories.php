<?php
require_once '../../../base/connect.php';

$stm = $dbh->prepare(
    "SELECT c.id,
            c.name,
            c.slug,
            c.main_image,
            c.is_visible,
            c.position,
            COUNT(i.id) AS works_count
     FROM category_gallery_works c
              LEFT JOIN gallery_work_images i ON i.category = c.id
     GROUP BY c.id, c.name, c.slug, c.main_image, c.is_visible, c.position
     ORDER BY c.position ASC, c.id ASC"
);
$stm->execute();
$categories = $stm->fetchAll(PDO::FETCH_ASSOC);

foreach ($categories as &$category) {
    $category['is_visible'] = (int)$category['is_visible'];
    $category['works_count'] = (int)$category['works_count'];

    if (!empty($category['main_image'])) {
        if (preg_match('/^https?:/i', $category['main_image'])) {
            continue;
        }

        $category['main_image'] = '/' . ltrim($category['main_image'], './');
    }
}
unset($category);

echo json_encode([
    'status' => 'success',
    'data' => $categories,
], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
