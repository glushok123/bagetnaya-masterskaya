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
                <div class="col-12 col-xl-12">
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
                            <div class="gc-create mb-4">
                                <div class="fw-semibold mb-2">Новая категория</div>
                                <form id="gallery-category-create-form" enctype="multipart/form-data">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-12 col-lg-5">
                                            <label for="newGalleryCategoryName" class="form-label small text-muted mb-1">Название</label>
                                            <input type="text" class="form-control" id="newGalleryCategoryName" name="name" placeholder="Например: Оформление вышивки" required>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <label for="newGalleryCategoryImage" class="form-label small text-muted mb-1">Главное изображение</label>
                                            <input type="file" class="form-control" id="newGalleryCategoryImage" name="main_image" accept=".jpg,.jpeg,.png">
                                        </div>
                                        <div class="col-7 col-lg-2">
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" value="1" id="newGalleryCategoryVisible" name="is_visible" checked>
                                                <label class="form-check-label" for="newGalleryCategoryVisible">Показывать</label>
                                            </div>
                                        </div>
                                        <div class="col-5 col-lg-1 text-end">
                                            <button type="button" class="btn btn-primary w-100" id="createGalleryCategory">Добавить</button>
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

                <div class="col-12 col-xl-12">
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

        <!-- Удаление категории -->
        <div class="modal fade" id="ModalDeleteGalleryCategory" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Удаление категории</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-3">Удалить категорию <strong id="deleteCategoryName"></strong>?</p>
                        <div id="deleteCategoryWorksBlock" class="d-none">
                            <div class="alert alert-warning py-2 small mb-3">
                                В категории работ: <strong id="deleteCategoryWorksCount">0</strong>. Что с ними сделать?
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="deleteCategoryMode" id="deleteModeMove" value="move" checked>
                                <label class="form-check-label" for="deleteModeMove">Перенести в категорию:</label>
                            </div>
                            <select class="form-select form-select-sm mb-3" id="deleteCategoryTarget"></select>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="deleteCategoryMode" id="deleteModeDelete" value="delete">
                                <label class="form-check-label text-danger" for="deleteModeDelete">Удалить вместе с работами (безвозвратно)</label>
                            </div>
                        </div>
                        <div class="small text-muted mt-3">Категория пропадёт из каталога работ на сайте.</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteGalleryCategory">Удалить категорию</button>
                    </div>
                </div>
            </div>
        </div>

        <style>
            #galleryWorksAdmin .gc-create { background: #f7f8fa; border: 1px solid #e5e7eb; border-radius: 12px; padding: 16px; }
            #gallery-categories-list { display: flex; flex-direction: column; gap: 10px; }
            #gallery-categories-list .gc-item {
                display: grid;
                grid-template-columns: 44px 92px minmax(0, 1fr) auto auto;
                align-items: center; gap: 16px;
                border: 1px solid #e5e7eb !important; border-radius: 12px !important;
                padding: 12px 16px; background: #fff; transition: box-shadow .15s, border-color .15s;
            }
            #gallery-categories-list .gc-item:hover { box-shadow: 0 4px 14px rgba(0,0,0,.06); border-color: #d6d9de !important; }
            #gallery-categories-list .gc-item.gc-hidden { background: #fafafa; }
            #gallery-categories-list .gc-item.gc-hidden .gc-thumb img { opacity: .45; filter: grayscale(1); }
            .gc-order { display: flex; flex-direction: column; align-items: center; gap: 2px; }
            .gc-pos { font-weight: 600; color: #6b7280; font-size: 14px; }
            .gc-arrow { border: 1px solid #e5e7eb; background: #fff; border-radius: 6px; width: 30px; height: 24px; font-size: 10px; line-height: 1; color: #4b5563; }
            .gc-arrow:hover:not(:disabled) { background: #eef2ff; border-color: #c7d2fe; color: #3730a3; }
            .gc-arrow:disabled { opacity: .3; cursor: default; }
            .gc-thumb { position: relative; width: 92px; height: 92px; border-radius: 10px; overflow: hidden; background: #f3f4f6; }
            .gc-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
            .gc-thumb-edit {
                position: absolute; inset: auto 0 0 0; margin: 0; padding: 4px 0; text-align: center;
                font-size: 11px; color: #fff; background: rgba(17,24,39,.65); cursor: pointer; opacity: 0; transition: opacity .15s;
            }
            .gc-thumb:hover .gc-thumb-edit, .gc-thumb-edit.btn-success { opacity: 1; }
            .gc-thumb-edit.btn-success { background: #198754; }
            .gc-main .category-name-input { font-weight: 500; }
            .gc-meta { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 6px; font-size: 13px; color: #6b7280; }
            .gc-count b { color: #111827; }
            .gc-slug { font-family: monospace; font-size: 12px; }
            .gc-status .form-check-label { font-size: 14px; white-space: nowrap; }
            .gc-actions { display: flex; gap: 8px; }
            @media (max-width: 991px) {
                #gallery-categories-list .gc-item { grid-template-columns: 44px 80px minmax(0, 1fr); }
                .gc-thumb { width: 80px; height: 80px; }
                .gc-status { grid-column: 2 / -1; }
                .gc-actions { grid-column: 1 / -1; justify-content: flex-end; }
            }
        </style>
    </div>
    <div class="tab-pane fade" id="neoart-import" role="tabpanel" aria-labelledby="neoart-import-tab">
        <? require_once 'view/neoart_import.php'; ?>
    </div>
</div>
