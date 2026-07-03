<div class="container py-4" id="neoartImportApp">
    <div class="neoart-toolbar">
        <div class="row g-3 align-items-end">
            <div class="col-12 col-md-auto">
                <label class="form-label mb-1 small text-muted">Каталог</label>
                <select class="form-select" id="neoartCatalog">
                    <option value="wood">Дерево</option>
                    <option value="plast">Пластик</option>
                    <option value="alum">Алюминий</option>
                </select>
            </div>
            <div class="col-12 col-md-auto neoart-steps d-flex gap-2 flex-wrap">
                <button class="btn btn-primary" id="neoartRunDownload">1&nbsp;· Скачать базу</button>
                <button class="btn btn-outline-primary" id="neoartRunCut">2&nbsp;· Нарезать картинки</button>
                <button class="btn btn-outline-secondary" id="neoartRefreshGrid">Обновить список</button>
            </div>
        </div>
        <div class="mt-3 d-none" id="neoartDlWrap">
            <div class="small text-muted" id="neoartDlLabel">Скачивание: —</div>
            <div class="progress" style="height:18px"><div class="progress-bar" id="neoartDlBar" style="width:0%">0%</div></div>
        </div>
        <div class="mt-2 d-none" id="neoartCutWrap">
            <div class="small text-muted" id="neoartCutLabel">Нарезка: —</div>
            <div class="progress" style="height:18px"><div class="progress-bar bg-info" id="neoartCutBar" style="width:0%">0%</div></div>
        </div>
    </div>

    <div class="card mb-3 d-none" id="neoartErrorsCard">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Ошибки</span><span class="badge bg-danger" id="neoartErrorsCount">0</span>
        </div>
        <div class="card-body" style="max-height:180px;overflow:auto" id="neoartErrors"></div>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-3 align-items-center neoart-filters" id="neoartFilters">
        <button class="btn btn-sm btn-outline-dark active" data-filter="all">Все</button>
        <button class="btn btn-sm btn-outline-warning" data-filter="flagged">Требуют правки</button>
        <button class="btn btn-sm btn-outline-success" data-filter="ready">Готовы</button>
        <button class="btn btn-sm btn-outline-secondary" data-filter="in_catalog">Уже в каталоге</button>
        <input class="form-control form-control-sm neoart-search" id="neoartSearch" placeholder="Поиск по артикулу">
        <button class="btn btn-sm btn-success ms-auto" id="neoartApproveSelected">Одобрить выбранные</button>
    </div>

    <div id="neoartGrid"></div>
</div>

<div class="modal fade" id="neoartEditModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Товар: <span id="neoartEditVendor"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-lg-7">
            <div class="btn-group btn-group-sm mb-2 neoart-mode-tabs">
              <button class="btn btn-outline-primary active" id="neoartModeList">Картинка для каталога</button>
              <button class="btn btn-outline-primary" id="neoartModeConst">Картинка для конструктора</button>
            </div>
            <div class="neoart-crop-wrap"><img id="neoartCropImg" alt=""></div>
            <div class="mt-2 d-flex gap-2 flex-wrap">
              <button class="btn btn-success btn-sm" id="neoartCropSave">Сохранить обрезку</button>
              <label class="btn btn-outline-secondary btn-sm mb-0">Загрузить свою картинку каталога<input type="file" hidden id="neoartUpList" accept=".jpg,.jpeg"></label>
              <label class="btn btn-outline-secondary btn-sm mb-0">Загрузить свою для конструктора<input type="file" hidden id="neoartUpConst" accept=".jpg,.jpeg"></label>
              <label class="btn btn-outline-secondary btn-sm mb-0">Заменить исходное фото<input type="file" hidden id="neoartUpRaw" accept=".jpg,.jpeg"></label>
              <button class="btn btn-outline-warning btn-sm" id="neoartResetCut">Пересобрать автоматически</button>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="neoart-side mb-3">
              <h6 id="neoartPrevTitle">Как будет в каталоге</h6>
              <div id="neoartPrevCatalog">
                <div class="neoart-cat-mock"><img id="neoartPrevList" alt=""><div class="cm-body"><div class="small fw-semibold" id="neoartPrevArt">Арт. —</div><div class="small text-muted" id="neoartPrevPrice">—</div></div></div>
              </div>
              <div id="neoartPrevConstruct" class="d-none">
                <div class="neoart-frame-preview" id="neoartFramePrev">
                  <div class="nf nf-top"></div><div class="nf nf-bottom"></div><div class="nf nf-left"></div><div class="nf nf-right"></div><div class="nf-center"></div>
                </div>
              </div>
            </div>
            <div class="neoart-side">
              <h6>Параметры</h6>
              <div class="row g-2">
                <div class="col-6"><label class="form-label small mb-0">Ширина, мм</label><input type="number" min="0" class="form-control form-control-sm" id="neoartFWidth"></div>
                <div class="col-6"><label class="form-label small mb-0">Без четверти, мм</label><input type="number" min="0" class="form-control form-control-sm" id="neoartFWidthWo"></div>
                <div class="col-6"><label class="form-label small mb-0">Цена, ₽</label><input type="number" min="0" class="form-control form-control-sm" id="neoartFPrice"></div>
                <div class="col-6"><label class="form-label small mb-0">Остаток</label><input type="number" min="0" class="form-control form-control-sm" id="neoartFStorage"></div>
                <div class="col-12"><label class="form-label small mb-0">Секция</label><input type="text" class="form-control form-control-sm" id="neoartFSection"></div>
                <div class="col-12 small text-muted">Флаги: <span id="neoartFFlags">—</span></div>
              </div>
              <button class="btn btn-primary btn-sm mt-3 w-100" id="neoartSaveFields">Сохранить</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
