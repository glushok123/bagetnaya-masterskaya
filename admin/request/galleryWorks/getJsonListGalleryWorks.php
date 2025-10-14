<?php
require_once '../../../base/connect.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $categoriesStatement = $dbh->prepare('SELECT id, name FROM category_gallery_works ORDER BY sort_order, id');
    $categoriesStatement->execute();
    $categories = $categoriesStatement->fetchAll(PDO::FETCH_ASSOC);

    $categoryOptions = [];
    foreach ($categories as $category) {
        $categoryOptions[] = [
            'id' => (int) $category['id'],
            'name' => $category['name'],
        ];
    }

    $rows = [];
    $categoryIdFilter = null;
    if (isset($_POST['categoryId']) && $_POST['categoryId'] !== '') {
        $categoryIdFilter = (int) $_POST['categoryId'];
    }

    $query = 'SELECT id, category, url_image, description FROM gallery_work_images';
    if ($categoryIdFilter !== null) {
        $query .= ' WHERE category = :categoryId';
    }
    $query .= ' ORDER BY id DESC';

    $statement = $dbh->prepare($query);
    if ($categoryIdFilter !== null) {
        $statement->bindValue(':categoryId', $categoryIdFilter, PDO::PARAM_INT);
    }
    $statement->execute();
    $galleryWorkImages = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($galleryWorkImages as $item) {
        $workId = (int) $item['id'];
        $workCategoryId = (int) $item['category'];
        $imagePath = $item['url_image'] ?? '';
        if ($imagePath !== '' && strpos($imagePath, './') === 0) {
            $imagePath = substr($imagePath, 1);
        }
        $imageUrl = htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($item['description'] ?? '', ENT_QUOTES, 'UTF-8');

        $optionsHtml = '';
        foreach ($categoryOptions as $option) {
            $optionName = htmlspecialchars($option['name'], ENT_QUOTES, 'UTF-8');
            $selected = $option['id'] === $workCategoryId ? ' selected' : '';
            $optionsHtml .= '<option value="' . $option['id'] . '"' . $selected . '>' . $optionName . '</option>';
        }

        $imageHtml = '<div class="text-center"><a href="' . $imageUrl . '" target="_blank" rel="noopener"><img src="' . $imageUrl . '" class="rounded mx-auto d-block castom-image" style="max-width: 120px;" alt="' . $description . '"></a></div>';
        $selectHtml = '<select class="form-select form-select-sm change-gallery-work-category" data-id="' . $workId . '" data-previous-value="' . $workCategoryId . '">' . $optionsHtml . '</select>';
        $descriptionHtml = '<div class="mb-3"><textarea class="form-control edit-description-gallery-works" rows="4" data-id-works="' . $workId . '">' . $description . '</textarea></div>';
        $actionsHtml = '<div class="d-flex gap-2"><button type="button" class="btn btn-outline-danger btn-sm delete-gallery-work" data-id="' . $workId . '">Удалить</button></div>';

        $rows[] = [
            $imageHtml,
            $selectHtml,
            $descriptionHtml,
            $actionsHtml,
        ];
    }

    echo json_encode(['rows' => $rows], JSON_UNESCAPED_UNICODE);
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode([
        'rows' => [],
        'message' => 'Не удалось получить список работ',
        'error' => $exception->getMessage(),
    ], JSON_UNESCAPED_UNICODE);
}
