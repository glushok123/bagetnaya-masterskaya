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
        <div class="container py-4" id="galleryWorksAdmin">
            <div class="row gy-3 align-items-center">
                <div class="col-12 col-md-auto">
                    <button type="button" class="btn btn-info add" data-bs-toggle="modal"
                            data-bs-target="#ModalAddGalleryWorks">Добавить работу
                    </button>
                </div>
            </div>

            <div class="row g-4 align-items-start mt-1">
                <div class="col-12 col-xl-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header d-flex flex-wrap align-items-start justify-content-between gap-2">
                            <div>
                                <div class="fw-semibold">Категории галереи</div>
                                <div class="small text-muted" id="galleryCategoriesStats">Загрузка статистики...</div>
                            </div>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="refreshGalleryCategories">
                                Обновить список
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="border rounded p-3 bg-light mb-4">
                                <div class="fw-semibold mb-2">Новая категория</div>
                                <form id="gallery-category-create-form" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="newGalleryCategoryName" class="form-label">Название категории</label>
                                            <input type="text" class="form-control" id="newGalleryCategoryName" name="name" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="newGalleryCategoryImage" class="form-label">Главное изображение</label>
                                            <input type="file" class="form-control" id="newGalleryCategoryImage" name="main_image" accept=".jpg,.jpeg,.png">
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" value="1" id="newGalleryCategoryVisible" name="is_visible" checked>
                                                <label class="form-check-label" for="newGalleryCategoryVisible">
                                                    Отображать в каталоге
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-sm-end">
                                            <button type="button" class="btn btn-primary" id="createGalleryCategory">Добавить</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="list-group" id="gallery-categories-list" data-initial-categories="<?= $categoryGalleryJson ?>">
                                <div class="text-muted">Загрузка списка категорий...</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-8">
                    <div class="card shadow-sm h-100">
                        <div class="card-header">
                            <div class="d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between">
                                <div>
                                    <div class="fw-semibold">Работы</div>
                                    <div class="small text-muted" id="gallerySelectedCategoryInfo">Всего работ: 0</div>
                                </div>
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    <label for="selectCategoryGalleryWorks" class="form-label mb-0">Категория</label>
                                    <select class="form-select" aria-label="Выбор категории" id="selectCategoryGalleryWorks">
                                        <option value="">Все категории</option>
                                        <?
                                        foreach ($categoryGalleryWorks as $key => $value) {
                                            echo '<option value="' . $key . '">' . $value . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <span class="badge bg-primary" id="galleryWorksCountBadge">0</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="gallery-works-tables" class="table table-striped align-middle" style="width:100%">
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
        </div>
    </div>
</div>
