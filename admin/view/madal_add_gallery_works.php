<!-- Модальное окно -->
<div class="modal fade" id="ModalAddGalleryWorks" tabindex="-1" aria-labelledby="ModalAddGalleryWorks"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавление в каталог</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class='col'>
                        <form id='addItemGalleryWorks'>
                            <div class="mb-3">
                                <label for="type_catalog" class="form-label">Выберите категорию:</label>
                                <select id="categoryIdGalleryWorks" name="categoryIdGalleryWorks"
                                        class="form-select form-control">
                                    <option value='' selected>Выберите ...</option>
                                    <option value='1'>Акварели, пастели и гравюры</option>
                                    <option value='2'>Зеркала и тв-панели</option>
                                    <option value='3'>Иконы и вышивки</option>
                                    <option value='4'>Ордена и медали, купюры и монеты</option>
                                    <option value='5'>Оформление живописи</option>
                                    <option value='6'>Постеры, плакаты и репродукции</option>
                                    <option value='7'>Сложные работы</option>
                                    <option value='8'>Фотографии и графика</option>
                                    <option value='9'>объектное оформление</option>
                                    <option value='10'>Футболки и спортивные атрибуты</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="descGalleryWorks" class="form-label">Описание:</label>
                                <input type="text" class="form-control" id="descGalleryWorks" name="descGalleryWorks">
                                <div id="emailHelp" class="form-text">*не обязательно для заполнения</div>
                            </div>

                            <div class="mb-3">
                                <label for="imgGalleryWorks" class="form-label">Фото: </label>
                                <input class="form-control" type="file" id="imgGalleryWorks" name="imgGalleryWorks"
                                       accept=".jpg,.jpeg">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id='add-gallery-works-save'>Сохранить</button>
            </div>
        </div>
    </div>
</div>