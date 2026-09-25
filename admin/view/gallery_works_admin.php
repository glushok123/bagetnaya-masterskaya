<div id="ga" class="ga">
    <div class="ga-shell">
        <aside class="ga-side">
            <div class="ga-side-head">
                <div>
                    <div class="ga-title">Категории</div>
                    <div class="ga-sub" id="gaStats">Загрузка…</div>
                </div>
                <button type="button" class="ga-btn ga-btn--ink ga-btn--sm" id="gaNewCatToggle">
                    <svg class="ga-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
                    Категория
                </button>
            </div>

            <form class="ga-newcat" id="gaNewCatForm" hidden>
                <input type="text" class="ga-input" id="gaNewCatName" placeholder="Название категории" maxlength="150">
                <label class="ga-file">
                    <input type="file" id="gaNewCatFile" accept=".jpg,.jpeg,.png" hidden>
                    <span id="gaNewCatFileLabel">Добавить обложку</span>
                </label>
                <div class="ga-newcat-actions">
                    <button type="button" class="ga-btn ga-btn--ghost ga-btn--sm" id="gaNewCatCancel">Отмена</button>
                    <button type="submit" class="ga-btn ga-btn--ink ga-btn--sm">Создать</button>
                </div>
            </form>

            <div id="gaAll"></div>
            <div class="ga-cat-list" id="gaCatList"></div>
            <p class="ga-side-hint">
                Перетащите категорию, чтобы изменить порядок.
                Перетащите работы на категорию, чтобы перенести их.
            </p>
        </aside>

        <section class="ga-main">
            <header class="ga-head" id="gaHead"></header>

            <div class="ga-toolbar">
                <div class="ga-toolbar-left">
                    <button type="button" class="ga-btn ga-btn--ink" id="gaUploadBtn">
                        <svg class="ga-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 16V4M7 9l5-5 5 5M5 20h14"/></svg>
                        Загрузить работы
                    </button>
                    <input type="file" id="gaFileInput" accept=".jpg,.jpeg,.png,.heic,.heif,image/jpeg,image/png" multiple hidden>
                    <label class="ga-check-label">
                        <input type="checkbox" class="ga-checkbox" id="gaSelectAll">
                        <span>Выбрать все</span>
                    </label>
                </div>
                <label class="ga-search">
                    <svg class="ga-ico" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="6.5"/><path d="M20 20l-4-4"/></svg>
                    <input type="search" id="gaSearch" placeholder="Поиск по описанию" aria-label="Поиск по описанию">
                </label>
            </div>

            <div class="ga-upload" id="gaUpload" hidden>
                <div class="ga-upload-text" id="gaUploadText"></div>
                <div class="ga-progress"><span id="gaUploadBar"></span></div>
            </div>

            <div class="ga-drop" id="gaDrop">
                <div class="ga-grid" id="gaGrid"></div>
                <div class="ga-drop-overlay" id="gaDropOverlay"></div>
            </div>
        </section>
    </div>

    <div class="ga-selbar" id="gaSelBar" hidden>
        <span class="ga-selbar-count"><b id="gaSelCount">0</b> выбрано</span>
        <select class="ga-select ga-select--dark" id="gaSelTarget" aria-label="Категория для переноса"></select>
        <button type="button" class="ga-btn ga-btn--light ga-btn--sm" id="gaSelMove">Перенести</button>
        <button type="button" class="ga-btn ga-btn--danger-dark ga-btn--sm" id="gaSelDelete">Удалить</button>
        <button type="button" class="ga-icon-btn ga-icon-btn--dark" id="gaSelClear" title="Снять выделение" aria-label="Снять выделение">
            <svg class="ga-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
    </div>
</div>

<!-- Удаление категории -->
<div class="ga-modal" id="gaDeleteModal" hidden role="dialog" aria-modal="true" aria-labelledby="gaDeleteTitle">
    <div class="ga-modal-backdrop" data-ga-close></div>
    <div class="ga-modal-card">
        <h3 class="ga-modal-title" id="gaDeleteTitle">Удалить категорию?</h3>
        <p class="ga-modal-text">Категория <b id="gaDeleteName"></b> пропадёт из каталога работ на сайте.</p>
        <div class="ga-modal-choice" id="gaDeleteWorks" hidden>
            <p class="ga-modal-note">В ней <b id="gaDeleteCount"></b>. Что с ними сделать?</p>
            <label class="ga-radio">
                <input type="radio" name="gaDeleteMode" id="gaDeleteModeMove" value="move" checked>
                <span>Перенести в другую категорию</span>
            </label>
            <select class="ga-select ga-modal-select" id="gaDeleteTarget" aria-label="Категория для переноса"></select>
            <label class="ga-radio ga-radio--danger">
                <input type="radio" name="gaDeleteMode" id="gaDeleteModeDelete" value="delete">
                <span>Удалить вместе с работами — безвозвратно</span>
            </label>
        </div>
        <div class="ga-modal-actions">
            <button type="button" class="ga-btn ga-btn--ghost" data-ga-close>Отмена</button>
            <button type="button" class="ga-btn ga-btn--danger" id="gaDeleteConfirm">Удалить категорию</button>
        </div>
    </div>
</div>

<!-- Редактирование работы -->
<div class="ga-modal" id="gaWorkModal" hidden role="dialog" aria-modal="true" aria-labelledby="gaWorkTitle">
    <div class="ga-modal-backdrop" data-ga-close></div>
    <div class="ga-modal-card ga-modal-card--wide">
        <div class="ga-editor">
            <div class="ga-editor-media">
                <div class="ga-mat"><img id="gaWorkImg" alt="Фото работы"></div>
                <label class="ga-btn ga-btn--soft ga-btn--sm">
                    <input type="file" id="gaWorkFile" accept=".jpg,.jpeg,.png,.heic,.heif,image/jpeg,image/png" hidden>
                    Заменить фото
                </label>
                <span class="ga-editor-hint" id="gaWorkFileHint"></span>
            </div>
            <div class="ga-editor-form">
                <div class="ga-eyebrow">Работа</div>
                <h3 class="ga-modal-title" id="gaWorkTitle">Редактирование</h3>
                <label class="ga-field">
                    <span class="ga-field-label">Категория</span>
                    <select class="ga-select" id="gaWorkCategory"></select>
                </label>
                <label class="ga-field">
                    <span class="ga-field-label">Описание</span>
                    <textarea class="ga-input ga-textarea" id="gaWorkDesc" rows="5" placeholder="Например: икона в резном багете с золочением"></textarea>
                </label>
                <div class="ga-modal-actions ga-modal-actions--split">
                    <button type="button" class="ga-btn ga-btn--danger-ghost" id="gaWorkDelete">Удалить работу</button>
                    <div class="ga-modal-actions-group">
                        <button type="button" class="ga-btn ga-btn--ghost" data-ga-close>Отмена</button>
                        <button type="button" class="ga-btn ga-btn--ink" id="gaWorkSave">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

