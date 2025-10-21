<!-- Модальное окно редактирования -->
<div class="modal fade" id="ModalEditPainting" tabindex="-1" aria-labelledby="ModalEditPaintingLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalEditPaintingLabel">Редактирование картины</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form id="editPaintingForm">
                    <input type="hidden" id="edit_painting_id" name="painting_id">
                    <div class="mb-3">
                        <label for="edit_painting_name" class="form-label">Название:</label>
                        <input type="text" class="form-control" id="edit_painting_name" name="painting_name">
                    </div>
                    <div class="mb-3">
                        <label for="edit_painting_avtor" class="form-label">Автор:</label>
                        <input type="text" class="form-control" id="edit_painting_avtor" name="painting_avtor">
                    </div>
                    <div class="mb-3">
                        <label for="edit_painting_size" class="form-label">Размер:</label>
                        <input type="text" class="form-control" id="edit_painting_size" name="painting_size">
                    </div>
                    <div class="mb-3">
                        <label for="edit_painting_price" class="form-label">Цена:</label>
                        <input type="number" class="form-control" id="edit_painting_price" name="painting_price">
                    </div>
                    <div class="mb-3">
                        <label for="edit_painting_active" class="form-label">Активна:</label>
                        <select class="form-select" id="edit_painting_active" name="painting_active">
                            <option value="1">Да</option>
                            <option value="0">Нет</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="save-painting-changes">Сохранить</button>
            </div>
        </div>
    </div>
</div>
