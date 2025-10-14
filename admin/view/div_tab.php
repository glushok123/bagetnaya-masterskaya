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
                <div class="row align-items-center gy-3">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#ModalAddGalleryWorks">Добавить работу</button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#ModalAddGalleryWorksCategory" id="open-add-gallery-category">Новая категория</button>
                    </div>
                    <div class="col-md-4 ms-auto">
                        <select class="form-select" id='selectCategoryGalleryWorks'>
                            <option value="">Все категории</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <h5>Категории</h5>
                        <div class="table-responsive">
                            <table class="table table-striped align-middle" id="gallery-works-category-table">
                                <thead>
                                    <tr>
                                        <th style="width:5%">#</th>
                                        <th>Название</th>
                                        <th style="width:20%">Главное изображение</th>
                                        <th style="width:15%">Порядок</th>
                                        <th style="width:12%">Видимость</th>
                                        <th style="width:18%">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Данные загружаются...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="row">
                    <div class="col-12">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>