<div class="container py-4" id="neoartImportApp">
    <div class="row g-3 align-items-end mb-3">
        <div class="col-auto">
            <label class="form-label mb-1">Каталог</label>
            <select class="form-select" id="neoartCatalog">
                <option value="wood">Дерево</option>
                <option value="plast">Пластик</option>
                <option value="alum">Алюминий</option>
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary" id="neoartRunDownload">1. Скачать базу</button>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-primary" id="neoartRunCut">2. Нарезать картинки</button>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-secondary" id="neoartRefreshGrid">Обновить список</button>
        </div>
    </div>

    <div class="mb-2">
        <div class="small text-muted" id="neoartDlLabel">Скачивание: —</div>
        <div class="progress" style="height:20px"><div class="progress-bar" id="neoartDlBar" style="width:0%">0%</div></div>
    </div>
    <div class="mb-3">
        <div class="small text-muted" id="neoartCutLabel">Нарезка: —</div>
        <div class="progress" style="height:20px"><div class="progress-bar bg-info" id="neoartCutBar" style="width:0%">0%</div></div>
    </div>

    <div class="card mb-3 d-none" id="neoartErrorsCard">
        <div class="card-header d-flex justify-content-between">
            <span>Ошибки</span><span class="badge bg-danger" id="neoartErrorsCount">0</span>
        </div>
        <div class="card-body" style="max-height:180px;overflow:auto" id="neoartErrors"></div>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-3" id="neoartFilters">
        <button class="btn btn-sm btn-outline-dark active" data-filter="all">Все</button>
        <button class="btn btn-sm btn-outline-warning" data-filter="flagged">Требуют правки</button>
        <button class="btn btn-sm btn-outline-success" data-filter="ready">Готовы</button>
        <button class="btn btn-sm btn-outline-secondary" data-filter="in_catalog">Уже в каталоге</button>
        <input class="form-control form-control-sm w-auto" id="neoartSearch" placeholder="поиск по артикулу">
        <button class="btn btn-sm btn-success ms-auto" id="neoartApproveSelected">Одобрить выбранные</button>
    </div>

    <div class="row g-3" id="neoartGrid"></div>
</div>

<div class="modal fade" id="neoartEditModal" tabindex="-1">
  <div class="modal-dialog modal-xl"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Редактор: <span id="neoartEditVendor"></span></h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">
      <div class="row g-3">
        <div class="col-lg-7">
          <div class="btn-group btn-group-sm mb-2">
            <button class="btn btn-outline-primary active" id="neoartModeList">Каталог (listimg)</button>
            <button class="btn btn-outline-primary" id="neoartModeConst">Конструктор (imgconst)</button>
          </div>
          <div style="max-height:60vh"><img id="neoartCropImg" style="max-width:100%"></div>
          <div class="mt-2 d-flex gap-2">
            <button class="btn btn-success btn-sm" id="neoartCropSave">Сохранить кроп</button>
            <label class="btn btn-outline-secondary btn-sm mb-0">Загрузить raw<input type="file" hidden id="neoartUpRaw" accept=".jpg,.jpeg"></label>
            <label class="btn btn-outline-secondary btn-sm mb-0">Загрузить listimg<input type="file" hidden id="neoartUpList" accept=".jpg,.jpeg"></label>
            <label class="btn btn-outline-secondary btn-sm mb-0">Загрузить imgconst<input type="file" hidden id="neoartUpConst" accept=".jpg,.jpeg"></label>
            <button class="btn btn-outline-warning btn-sm" id="neoartResetCut">Авто-нарезка заново</button>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="mb-2"><div class="small text-muted">Превью listimg (150×100)</div><img id="neoartPrevList" style="border:1px solid #ddd"></div>
          <div class="mb-2"><div class="small text-muted">Превью imgconst (repeat-x)</div><div id="neoartPrevConst" style="width:100%;height:80px;border:1px solid #ddd"></div></div>
          <div id="neoartEditInfo" class="small"></div>
        </div>
      </div>
    </div>
  </div></div>
</div>
