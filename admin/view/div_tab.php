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
    <div class="tab-pane fade row" id="gallery-works" role="tabpanel" aria-labelledby="contact-tab">
        <div class='container'>
            <div class='container'>
            <div class="row gy-3 align-items-center">
                <div class='col-sm-6 col-lg-3'>
                    <button type="button" class="btn btn-info add w-100" data-bs-toggle="modal"
                            data-bs-target="#ModalAddGalleryWorks">Добавить работу
                    </button>
                </div>
                <div class='col-sm-6 col-lg-4 ms-auto'>
                    <select class="form-select" aria-label="Выбор категории" id='selectCategoryGalleryWorks'>
                        <?
                        foreach ($categoryGalleryWorks as $key => $value) {
                            echo '<option value="' . $key . '">' . $value . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <span>Категории галереи</span>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="refreshGalleryCategories">
                            Обновить список
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="gallery-category-create-form" enctype="multipart/form-data">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="newGalleryCategoryName" class="form-label">Название категории</label>
                                <input type="text" class="form-control" id="newGalleryCategoryName" name="name" required>
                            </div>
                            <div class="col-md-4">
                                <label for="newGalleryCategoryImage" class="form-label">Главное изображение</label>
                                <input type="file" class="form-control" id="newGalleryCategoryImage" name="main_image" accept=".jpg,.jpeg,.png">
                            </div>
                            <div class="col-md-2">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" value="1" id="newGalleryCategoryVisible" name="is_visible" checked>
                                    <label class="form-check-label" for="newGalleryCategoryVisible">
                                        Отображать
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 text-md-end">
                                <button type="button" class="btn btn-primary w-100" id="createGalleryCategory">Добавить</button>
                            </div>
                        </div>
                    </form>
                    <div class="list-group mt-4" id="gallery-categories-list" data-initial-categories="<?= $categoryGalleryJson ?>">
                        <div class="text-muted">Загрузка списка категорий...</div>
                    </div>
                </div>
            </div>

            <div class="mt-4" style="width:100%">
                <table id="gallery-works-tables" class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Категория</th>
                        <th>Описание</th>
                        <th>Управление</th>
                    </tr>
                    </thead>
                    <tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>