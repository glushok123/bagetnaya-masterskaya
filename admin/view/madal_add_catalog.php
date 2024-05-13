<!-- Модальное окно -->
<div class="modal fade" id="ModalAddCatalog" tabindex="-1" aria-labelledby="ModalAddCatalog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавление в каталог</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class='col'>
                        <form id='addItemInCatalog'>
                            <div class="mb-3">
                                <label for="type_catalog" class="form-label">Выберите тип:</label>
                                <select id="type_catalog" name="type_catalog" class="form-select form-control">
                                    <option value='' selected>Выберите ...</option>
                                    <option value='plast'>Пластик</option>
                                    <option value='wood'>Дерево</option>
                                    <option value='alum'>Алюминий</option>
                                    <option value='pasp'>Паспарту</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="article_supplier" class="form-label">Артикул поставщика:</label>
                                <input type="text" class="form-control" id="article_supplier" name="article_supplier">
                                <div id="emailHelp" class="form-text">*не обязательно для заполнения</div>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    <div class="mb-3">
                                        <label for="width" class="form-label">Ширина: </label>
                                        <input type="number" class="form-control" id="width" name="width">
                                    </div>
                                </div>
                                <div class='col'>
                                    <div class="mb-3">
                                        <label for="quarter" class="form-label">Без четверти: </label>
                                        <input type="number" class="form-control" id="quarter" name="quarter">
                                    </div>
                                </div>
                                <div class='col'>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Цена: </label>
                                        <input type="number" class="form-control" id="price" name="price">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="article_supplier" class="form-label">Цвет: </label>
                                <input type="text" class="form-control" id="color" name="color">
                            </div>
                            <div class="mb-3">
                                <label for="imgConst" class="form-label">Картинка для рамы: </label>
                                <input class="form-control" type="file" id="imgConst" name="imgConst"
                                       accept=".jpg,.jpeg">
                            </div>
                            <div class="mb-3">
                                <label for="listImg" class="form-label">Картинка для каталога: </label>
                                <input class="form-control" type="file" id="listImg" name="listImg" accept=".jpg,.jpeg">
                            </div>

                        </form>
                    </div>
                    <div class='col'>

                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id='add-catalog-save'>Сохранить</button>
            </div>
        </div>
    </div>
</div>