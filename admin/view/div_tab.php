<?
$stm = $dbh->prepare(
    "SELECT c.id, c.name, c.slug, c.main_image, c.is_visible, c.position, COUNT(i.id) AS works_count
     FROM category_gallery_works c
              LEFT JOIN gallery_work_images i ON i.category = c.id
     GROUP BY c.id, c.name, c.slug, c.main_image, c.is_visible, c.position
     ORDER BY c.position ASC, c.id ASC"
);
$stm->execute();
$categoryGalleryWorkImages = $stm->fetchAll(PDO::FETCH_ASSOC);

$categoryGalleryWorks = [];

foreach ($categoryGalleryWorkImages as $item) {
    $categoryGalleryWorks[$item['id']] = $item['name'];
}

$categoryGalleryJson = htmlspecialchars(json_encode($categoryGalleryWorkImages, JSON_UNESCAPED_UNICODE), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade row " id="plast" role="tabpanel" aria-labelledby="home-tab">

    </div>
    <div class="tab-pane fade row" id="wood" role="tabpanel" aria-labelledby="profile-tab">

    </div>
    <div class="tab-pane fade row" id="alum" role="tabpanel" aria-labelledby="contact-tab">

    </div>
    <div class="tab-pane fade row" id="pasp" role="tabpanel" aria-labelledby="contact-tab">

    </div>
    <div class="tab-pane fade row" id="promokod" role="tabpanel" aria-labelledby="contact-tab">
        <div class='container' id="promokod-container">

        </div>
    </div>
    <div class="tab-pane fade row" id="static" role="tabpanel" aria-labelledby="contact-tab">

    </div>
    <div class="tab-pane fade row" id="paintings" role="tabpanel" aria-labelledby="contact-tab">

    </div>
    <div class="tab-pane fade row" id="orders-paintings" role="tabpanel" aria-labelledby="contact-tab">

    </div>
    <div class="tab-pane fade row" id="feed-back" role="tabpanel" aria-labelledby="contact-tab">

    </div>
    <div class="tab-pane fade" id="gallery-works" role="tabpanel" aria-labelledby="contact-tab">
        <? require_once 'view/gallery_works_admin.php'; // Каталог работ: категории + работы ?>
    </div>
    <div class="tab-pane fade" id="neoart-import" role="tabpanel" aria-labelledby="neoart-import-tab">
        <? require_once 'view/neoart_import.php'; ?>
    </div>
</div>
