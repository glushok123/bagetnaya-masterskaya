<?php
require_once '../../../base/connect.php';

$categoryIdFilter = !empty($_POST['categoryId']) ? (int)$_POST['categoryId'] : null;

if ($categoryIdFilter) {
    $stm = $dbh->prepare('SELECT id, category, url_image, description FROM gallery_work_images WHERE category = :category ORDER BY id DESC');
    $stm->bindValue(':category', $categoryIdFilter, PDO::PARAM_INT);
} else {
    $stm = $dbh->prepare('SELECT id, category, url_image, description FROM gallery_work_images ORDER BY id DESC');
}

$stm->execute();
$galleryWorkImages = $stm->fetchAll(PDO::FETCH_ASSOC);

$stm = $dbh->prepare('SELECT id, name FROM category_gallery_works ORDER BY position ASC, id ASC');
$stm->execute();
$categoryGalleryWorkImages = $stm->fetchAll(PDO::FETCH_ASSOC);

$categoryNames = [];

foreach ($categoryGalleryWorkImages as $item) {
    $categoryNames[$item['id']] = $item['name'];
}

$data = [];

foreach ($galleryWorkImages as $item) {
    $imagePath = '/' . ltrim($item['url_image'], './');
    $description = htmlspecialchars($item['description'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

    $selectOptions = '<option value="">Выберите категорию</option>';
    foreach ($categoryGalleryWorkImages as $categoryItem) {
        $selected = ((int)$categoryItem['id'] === (int)$item['category']) ? ' selected' : '';
        $selectOptions .= '<option value="' . $categoryItem['id'] . '"' . $selected . '>' . htmlspecialchars($categoryItem['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</option>';
    }

    $actionsHtml = '
            <div class="gallery-work-actions d-flex flex-column gap-2" data-id="' . $item['id'] . '">
                <select class="form-select form-select-sm gallery-work-category-select" data-id="' . $item['id'] . '">' . $selectOptions . '</select>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-primary btn-sm gallery-work-move" data-id="' . $item['id'] . '">Перенести</button>
                    <button type="button" class="btn btn-outline-danger btn-sm gallery-work-delete" data-id="' . $item['id'] . '">Удалить</button>
                </div>
            </div>
        ';

    $data[] = [
        '<img src="' . $imagePath . '" class="rounded mx-auto d-block castom-image " width="70" height="70" alt="Изображение работы">',
        htmlspecialchars($categoryNames[$item['category']] ?? 'Без категории', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'),
        '
            <div class="mb-3">
                <textarea class="form-control edit-description-gallery-works" rows="6" data-id-works=' . $item['id'] . '>' . $description . '</textarea>
            </div>
            ',
        $actionsHtml
    ];
}

echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
