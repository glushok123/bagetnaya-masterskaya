<?
require_once '../../../base/connect.php';


$stm = $dbh->prepare("SELECT * FROM gallery_work_images");
$stm->execute();
$galleryWorkImages = $stm->fetchAll();

$stm = $dbh->prepare("SELECT * FROM category_gallery_works");
$stm->execute();
$categoryGalleryWorkImages = $stm->fetchAll();

$category = [];
$data = [];

foreach ($categoryGalleryWorkImages as $item) {
    $category[$item['id']] = $item['name'];
}

foreach ($galleryWorkImages as $item) {
    if (!empty($_POST['categoryId']) && $item['category'] != $_POST['categoryId']) {
        continue;
    }
    $data[] = [
        '<img src=".' . $item['url_image'] . '" class="rounded mx-auto d-block castom-image " width="70px"  height="70px"alt="...">',
        $category[$item['category']],
        '
            <div class="mb-3">
                <textarea class="form-control edit-description-gallery-works" rows="6" data-id-works=' . $item['id'] . '>' . $item['description'] . '</textarea>
            </div>
            '
    ];
}


echo (json_encode($data, JSON_THROW_ON_ERROR));
