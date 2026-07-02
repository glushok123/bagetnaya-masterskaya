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
    </div>

    <div class="row g-3" id="neoartGrid"></div>
</div>
