<!-- Модальное окно -->
<div class="modal fade" id="ModalAddPromoKod" tabindex="-1" aria-labelledby="ModalAddPromoKod" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавление промокода</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
        <div class='row'>
          <div class='col'>
            <form id='addPromoKodForm'>
              <div class="mb-3">
                <label for="series_id" class="form-label">Промокод:</label>
                <input type="text" class="form-control" id="series_id" name="series_id">
              </div>
              <div class="mb-3">
                <label for="sale_procent" class="form-label">Скидка в процентах:</label>
                <input type="number" class="form-control" id="sale_procent" name="sale_procent">
              </div>
              <div class="mb-3">
                <label for="sale_count" class="form-label">Скидка в рублях:</label>
                <input type="number" class="form-control" id="sale_count" name="sale_count">
              </div>
              <div class="mb-3">
                <label for="sale_count" class="form-label">Активация:</label>
                <select class="form-select form-control active" name="active" id="active" aria-label="Default select example">
                  <option selected value="">не выбрано</option>
                  <option value="активный">активный</option>
                  <option value="не активный">не активный</option>
                </select>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" id='add-promokod-save'>Сохранить</button>
      </div>
    </div>
  </div>
</div>