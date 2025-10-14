<!-- Модальное окно добавления категории -->
<div class="modal fade" id="ModalAddGalleryWorksCategory" tabindex="-1" aria-labelledby="ModalAddGalleryWorksCategoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalAddGalleryWorksCategoryLabel">Новая категория</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
        <form id="addGalleryWorksCategoryForm">
          <div class="mb-3">
            <label for="galleryCategoryName" class="form-label">Название категории</label>
            <input type="text" class="form-control" id="galleryCategoryName" name="galleryCategoryName" placeholder="Например, Оформление живописи" required>
          </div>
          <div class="mb-3">
            <label for="galleryCategoryImage" class="form-label">Главное изображение</label>
            <input class="form-control" type="file" id="galleryCategoryImage" name="galleryCategoryImage" accept=".jpg,.jpeg,.png">
            <div class="form-text">Допустимые форматы: JPG, JPEG, PNG. Необязательное поле.</div>
          </div>
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="galleryCategoryIsHidden" name="galleryCategoryIsHidden">
            <label class="form-check-label" for="galleryCategoryIsHidden">Скрыть категорию после создания</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" id="add-gallery-works-category-save">Сохранить</button>
      </div>
    </div>
  </div>
</div>
