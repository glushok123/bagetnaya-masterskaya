<!-- Модальное окно -->
<div class="modal fade" id="ModalAddPainting" tabindex="-1" aria-labelledby="ModalAddCatalog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавление в каталог</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <form id='addPaintingInCatalog'>
                        <div class="mb-3">
                            <label for="painting_name" class="form-label">Название:</label>
                            <input type="text" class="form-control" id="painting_name" name="painting_name">
                        </div>
                        <div class="mb-3">
                            <label for="painting_avtor" class="form-label">Автор:</label>
                            <input type="text" class="form-control" id="painting_avtor" name="painting_avtor">
                        </div>
                        <div class="mb-3">
                            <label for="painting_size" class="form-label">Размер:</label>
                            <input type="text" class="form-control" id="painting_size" name="painting_size">
                        </div>
                        <div class="mb-3">
                            <label for="painting_price" class="form-label">Цена:</label>
                            <input type="number" class="form-control" id="painting_price" name="painting_price">
                        </div>

                        <div class="mb-3">
                            <label for="painting_img_1" class="form-label">Фото 1: </label>
                            <input class="form-control" type="file" id="painting_img_1" name="painting_img_1" accept=".jpg,.jpeg">
                        </div>
                        <div class="mb-3">
                            <label for="painting_img_2" class="form-label">Фото 2: </label>
                            <input class="form-control" type="file" id="painting_img_2" name="painting_img_2" accept=".jpg,.jpeg">
                        </div>
                        <div class="mb-3">
                            <label for="painting_img_3" class="form-label">Фото 3: </label>
                            <input class="form-control" type="file" id="painting_img_3" name="painting_img_3" accept=".jpg,.jpeg">
                        </div>
                        <div class="mb-3">
                            <label for="painting_img_4" class="form-label">Фото 4: </label>
                            <input class="form-control" type="file" id="painting_img_4" name="painting_img_4" accept=".jpg,.jpeg">
                        </div>
                        <div class="mb-3">
                            <label for="painting_img_5" class="form-label">Фото 5: </label>
                            <input class="form-control" type="file" id="painting_img_5" name="painting_img_5" accept=".jpg,.jpeg">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id='add-painting-save'>Сохранить</button>
            </div>
        </div>
    </div>
</div>