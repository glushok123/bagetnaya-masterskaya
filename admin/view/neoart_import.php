<div id="neoartImportApp">
    <div class="ga-panel ga-panel-pad neoart-toolbar">
        <div class="neoart-steps">
            <label class="ga-field neoart-catalog">
                <span class="ga-field-label">Каталог</span>
                <select class="ga-select" id="neoartCatalog">
                    <option value="wood">Дерево</option>
                    <option value="plast">Пластик</option>
                    <option value="alum">Алюминий</option>
                </select>
            </label>
            <button type="button" class="ga-btn ga-btn--ink" id="neoartRunDownload"><span class="neoart-step-num">1</span>Скачать базу</button>
            <button type="button" class="ga-btn ga-btn--ghost" id="neoartRunCut"><span class="neoart-step-num">2</span>Нарезать картинки</button>
            <button type="button" class="ga-btn ga-btn--soft" id="neoartRefreshGrid">
                <svg class="ga-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 11a8 8 0 0 0-14.6-4.5L4 8"/><path d="M4 4v4h4"/><path d="M4 13a8 8 0 0 0 14.6 4.5L20 16"/><path d="M20 20v-4h-4"/></svg>
                Обновить список
            </button>
        </div>
        <div class="neoart-progress" id="neoartDlWrap" hidden>
            <div class="ga-muted" id="neoartDlLabel">Скачивание: —</div>
            <div class="ga-progress"><span id="neoartDlBar"></span></div>
        </div>
        <div class="neoart-progress" id="neoartCutWrap" hidden>
            <div class="ga-muted" id="neoartCutLabel">Нарезка: —</div>
            <div class="ga-progress"><span id="neoartCutBar"></span></div>
        </div>
    </div>

    <div class="ga-panel neoart-errors" id="neoartErrorsCard" hidden>
        <div class="ga-panel-head">
            <span class="ga-panel-title">Ошибки</span>
            <span class="ga-badge ga-badge--expired" id="neoartErrorsCount">0</span>
        </div>
        <div class="neoart-errors-list" id="neoartErrors"></div>
    </div>

    <div class="ga-toolbar" id="neoartFilters">
        <div class="ga-toolbar-left">
            <div class="ga-chips">
                <button type="button" class="ga-chip-btn is-active" data-filter="all">Все</button>
                <button type="button" class="ga-chip-btn" data-filter="flagged">Требуют правки</button>
                <button type="button" class="ga-chip-btn" data-filter="ready">Готовы</button>
                <button type="button" class="ga-chip-btn" data-filter="in_catalog">Уже в каталоге</button>
            </div>
        </div>
        <div class="ga-toolbar-right">
            <label class="ga-search">
                <svg class="ga-ico" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="6.5"/><path d="M20 20l-4-4"/></svg>
                <input type="search" id="neoartSearch" placeholder="Поиск по артикулу" aria-label="Поиск по артикулу">
            </label>
            <button type="button" class="ga-btn ga-btn--gold" id="neoartApproveSelected">Опубликовать выбранные</button>
        </div>
    </div>

    <div id="neoartGrid"></div>
</div>

<div class="ga-modal" id="neoartEditModal" hidden role="dialog" aria-modal="true" aria-labelledby="neoartEditTitle">
    <div class="ga-modal-backdrop" data-ga-close></div>
    <div class="ga-modal-card ga-modal-card--xl neoart-editor">
        <button type="button" class="ga-icon-btn ga-modal-close" data-ga-close aria-label="Закрыть">
            <svg class="ga-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
        <div class="ga-eyebrow">Импорт Neoart</div>
        <h3 class="ga-modal-title" id="neoartEditTitle">Товар <span id="neoartEditVendor"></span></h3>

        <div class="neoart-editor-grid">
            <div>
                <div class="neoart-editor-bar">
                    <div class="ga-seg">
                        <button type="button" class="ga-seg-btn is-active" id="neoartModeList">Для каталога</button>
                        <button type="button" class="ga-seg-btn" id="neoartModeConst">Для конструктора</button>
                    </div>
                    <div class="neoart-rotate">
                        <button type="button" class="ga-btn ga-btn--ghost ga-btn--sm" id="neoartRotL" title="Повернуть влево">⟲ −90°</button>
                        <button type="button" class="ga-btn ga-btn--ghost ga-btn--sm" id="neoartRotR" title="Повернуть вправо">⟳ +90°</button>
                    </div>
                </div>
                <div class="neoart-crop-wrap"><img id="neoartCropImg" alt=""></div>
                <div class="neoart-editor-actions">
                    <button type="button" class="ga-btn ga-btn--ink ga-btn--sm" id="neoartCropSave">Сохранить обрезку</button>
                    <label class="ga-btn ga-btn--soft ga-btn--sm">Своя картинка каталога<input type="file" hidden id="neoartUpList" accept=".jpg,.jpeg"></label>
                    <label class="ga-btn ga-btn--soft ga-btn--sm">Своя для конструктора<input type="file" hidden id="neoartUpConst" accept=".jpg,.jpeg"></label>
                    <label class="ga-btn ga-btn--soft ga-btn--sm">Заменить исходное фото<input type="file" hidden id="neoartUpRaw" accept=".jpg,.jpeg"></label>
                    <button type="button" class="ga-btn ga-btn--ghost ga-btn--sm" id="neoartResetCut">Пересобрать автоматически</button>
                </div>
            </div>
            <div class="neoart-editor-side">
                <div class="neoart-side">
                    <div class="ga-field-label" id="neoartPrevTitle">Как будет в каталоге</div>
                    <div id="neoartPrevCatalog">
                        <div class="neoart-cat-mock"><img id="neoartPrevList" alt=""><div class="cm-body"><div class="ga-strong" id="neoartPrevArt">Арт. —</div><div class="ga-muted" id="neoartPrevPrice">—</div></div></div>
                    </div>
                    <div id="neoartPrevConstruct" hidden>
                        <div class="neoart-frame-preview" id="neoartFramePrev">
                            <div class="nf nf-top"></div><div class="nf nf-bottom"></div><div class="nf nf-left"></div><div class="nf nf-right"></div><div class="nf-center"></div>
                        </div>
                    </div>
                </div>
                <div class="neoart-side">
                    <div class="ga-field-label">Параметры</div>
                    <div class="ga-form-grid neoart-fields">
                        <label class="ga-field"><span class="ga-field-hint">Ширина, мм</span><input type="number" min="0" class="ga-input ga-input--sm" id="neoartFWidth"></label>
                        <label class="ga-field"><span class="ga-field-hint">Без четверти, мм</span><input type="number" min="0" class="ga-input ga-input--sm" id="neoartFWidthWo"></label>
                        <label class="ga-field"><span class="ga-field-hint">Цена, ₽</span><input type="number" min="0" class="ga-input ga-input--sm" id="neoartFPrice"></label>
                        <label class="ga-field"><span class="ga-field-hint">Остаток</span><input type="number" min="0" class="ga-input ga-input--sm" id="neoartFStorage"></label>
                        <label class="ga-field ga-span-all"><span class="ga-field-hint">Секция</span><input type="text" class="ga-input ga-input--sm" id="neoartFSection"></label>
                        <div class="ga-span-all ga-muted">Флаги: <span id="neoartFFlags">—</span></div>
                    </div>
                    <button type="button" class="ga-btn ga-btn--ink ga-btn--block" id="neoartSaveFields">Сохранить параметры</button>
                </div>
            </div>
        </div>
    </div>
</div>
