# Neoart Import UI Redesign — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax.

**Goal:** Modernize the "Импорт Neoart" admin page and rebuild the card editor — clickable cards, centered large modal, plain-Russian labels, editable fields, live "how it looks in the catalog / how the frame forms in the constructor" previews, and fix the Cropper duplication/overflow bugs.

**Architecture:** Pure additive changes to the existing feature files: a new `item_update.php` endpoint (save editable fields to `neoart_item`), a new `neoart_import.css` (modern styling), and rewrites of the grid card + editor modal in `neoart_import.php` / `neoart_import.js`. The live constructor preview reuses the site's own technique (`imgconst` tiled `repeat-x` around a rectangle, as in `constructor_baget/block_2_maket.php`) but fed live from Cropper's `getCroppedCanvas()`.

**Tech Stack:** PHP 8 + PDO/MySQL, GD (already), jQuery 3.5 + Bootstrap 5.1 + Cropper.js 1.6 (all already loaded via CDN). No new dependencies.

Spec: `docs/superpowers/specs/2026-07-03-neoart-import-ui-redesign-design.md`.

## Global Constraints

- Files UTF-8 + CRLF (git `core.autocrlf=true` normalizes; a "LF will be replaced by CRLF" warning is normal). New PHP files use `<?php`.
- Endpoints start with `require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';` → `$dbh` (PDO). No hardcoded creds. Response: `header('Content-Type: application/json; charset=utf-8')`, `json_encode($x, JSON_UNESCAPED_UNICODE)` on EVERY path incl. errors; errors via `http_response_code()` + `{"error":...}`.
- Prepared statements only.
- **Internal editor mode keys stay `'listimg'` / `'imgconst'`** (they equal the `which` param of `item_save_crop.php` / `item_upload.php` — those endpoints are NOT changed). Only visible labels become plain Russian.
- **XSS**: every feed-sourced value rendered into DOM (vendor, name, section_name, cut_flags, catalog_publicvendor) goes through the existing `NeoartUI.esc()` helper or jQuery `.text()` — never unescaped `.html()` concatenation.
- Card DOM contract preserved: `.neoart-card[data-id]`, `.neoart-approve`, `.neoart-reject`, `.neoart-select`.
- No auth guard added (consistent with existing `admin/request/*` convention; session gate is on `admin/index.php`).
- No project unit-test framework (per CLAUDE.md). Verify via: `php -l` / `node -c`, a PHP CLI simulation for endpoints, SQL checks, and **browser verification via claude-in-chrome** at `http://virtual-baget-curent/admin/` (the controller performs browser checks; implementers do the automatable parts and mark browser steps PENDING).
- Env binaries (Windows OSPanel; not on PATH): PHP `/e/OSPanel/modules/php/PHP_8.1/php.exe` (ignore pdo_oci warning); MySQL `/e/OSPanel/modules/database/MariaDB-10.8-Win10/bin/mysql.exe -u root -h 127.0.0.1` (DB `a0458868_bagetnaya`); JS lint `node -c`.
- Work on branch `dev`. Frequent commits.

---

## File Structure

**Create:**
- `admin/request/neoart/item_update.php` — save editable staging fields.
- `admin/assets/css/neoart_import.css` — modern page/card/modal/frame-preview styles.

**Modify:**
- `admin/view/neoart_import.php` — modern toolbar/filters/grid container + rebuilt editor modal (centered/xl/scrollable, mode tabs, single cropper, active-mode preview, editable fields, plain labels).
- `admin/assets/js/neoart_import.js` — clickable `cardHtml`; rewritten editor (`openEdit/setMode/saveCrop/upload/resetCut`), new `saveFields`, live previews, updated bindings.
- `admin/index.php` — add `neoart_import.css` link; bump asset versions.

---

## Task 1: `item_update.php` — save editable staging fields

**Files:**
- Create: `admin/request/neoart/item_update.php`

**Interfaces:**
- Produces: endpoint POST `id`, `width_mm`, `widthwithout_mm`, `price_final`, `storage`, `section_name` → JSON `{ok:1}`. Updates `neoart_item`. These fields already flow into `catalog_baget` on approve (item_approve reads width_mm/widthwithout_mm/price_final/storage); section_name stays staging-only.

- [ ] **Step 1: Create the endpoint**

Create `admin/request/neoart/item_update.php`:

```php
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
header('Content-Type: application/json; charset=utf-8');

$id = (int)($_POST['id'] ?? 0);
if (!$id) { http_response_code(400); echo json_encode(['error' => 'no id'], JSON_UNESCAPED_UNICODE); exit; }

$width        = max(0, (int)($_POST['width_mm'] ?? 0));
$widthwithout = max(0, (int)($_POST['widthwithout_mm'] ?? 0));
$price        = max(0, (int)($_POST['price_final'] ?? 0));
$storage      = max(0, (int)($_POST['storage'] ?? 0));
$section      = mb_substr(trim((string)($_POST['section_name'] ?? '')), 0, 255);

try {
    $stmt = $dbh->prepare(
        "UPDATE neoart_item SET width_mm=?, widthwithout_mm=?, price_final=?, storage=?, section_name=?, updated_at=? WHERE id=?"
    );
    $stmt->execute([$width, $widthwithout, $price, $storage, $section, date('Y-m-d H:i:s'), $id]);
    echo json_encode(['ok' => 1], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
```

- [ ] **Step 2: Verify (syntax + CLI round-trip + SQL)**

```bash
cd "E:/OSPanel/domains/virtual-baget-curent"
PHP="/e/OSPanel/modules/php/PHP_8.1/php.exe"; MYSQL="/e/OSPanel/modules/database/MariaDB-10.8-Win10/bin/mysql.exe -u root -h 127.0.0.1 a0458868_bagetnaya"
"$PHP" -l admin/request/neoart/item_update.php
ID=$($MYSQL -N -e "SELECT id FROM neoart_item WHERE catalog='wood' AND cut_status='auto_ok' LIMIT 1;")
echo "before:"; $MYSQL -e "SELECT id,width_mm,widthwithout_mm,price_final,storage,section_name FROM neoart_item WHERE id=$ID;"
"$PHP" -r '$_SERVER["DOCUMENT_ROOT"]=getcwd();$_SERVER["REQUEST_URI"]="/x";$_SERVER["HTTP_HOST"]="localhost";$_POST=["id"=>$argv[1],"width_mm"=>"55","widthwithout_mm"=>"40","price_final"=>"9999","storage"=>"12","section_name"=>"Тест секция"];require "admin/request/neoart/item_update.php";echo "\n";' "$ID"
echo "after:"; $MYSQL -e "SELECT id,width_mm,widthwithout_mm,price_final,storage,section_name FROM neoart_item WHERE id=$ID;"
```

Expected: `No syntax errors`; endpoint prints `{"ok":1}`; the "after" row shows `width_mm=55, widthwithout_mm=40, price_final=9999, storage=12, section_name=Тест секция` (raw Cyrillic).

- [ ] **Step 3: Commit**

```bash
git add admin/request/neoart/item_update.php
git commit -m "feat(neoart): эндпоинт item_update — редактируемые поля товара"
```

---

## Task 2: Modern page + clickable cards

**Files:**
- Create: `admin/assets/css/neoart_import.css`
- Modify: `admin/view/neoart_import.php` (toolbar/filters/grid section, lines 1–48 — everything BEFORE the `<div class="modal ...` at line 50; leave the modal for Task 3)
- Modify: `admin/assets/js/neoart_import.js` (the `cardHtml` function + add a `.neoart-card` open binding)
- Modify: `admin/index.php` (add CSS link, bump versions)

**Interfaces:**
- Consumes: `NeoartUI.esc`, `NeoartUI.openEdit` (exists), `NeoartUI.loadGrid`.
- Produces: `cardHtml(it)` returns a card whose whole body opens the editor on click; `.neoart-approve`/`.neoart-reject`/`.neoart-select` stop propagation. CSS classes `neoart-toolbar`, `neoart-card`, `neoart-thumb`, `neoart-frame-preview` (frame preview used in Task 4).

- [ ] **Step 1: Create the stylesheet**

Create `admin/assets/css/neoart_import.css`:

```css
/* Neoart Import Studio — современный вид */
#neoartImportApp { max-width: 1280px; }
.neoart-toolbar {
  background: #fff; border: 1px solid #e6e8ec; border-radius: 14px;
  padding: 16px 18px; box-shadow: 0 2px 10px rgba(20,30,50,.05); margin-bottom: 18px;
}
.neoart-toolbar .form-select, .neoart-toolbar .btn { border-radius: 10px; }
.neoart-steps .btn { font-weight: 600; }
.neoart-filters .btn { border-radius: 999px; padding: 5px 16px; }
.neoart-search { max-width: 240px; border-radius: 999px; }

/* Сетка карточек */
#neoartGrid { display: grid; grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap: 16px; }
.neoart-card {
  border: 1px solid #e6e8ec; border-radius: 14px; background: #fff; overflow: hidden;
  cursor: pointer; transition: transform .12s ease, box-shadow .12s ease; display: flex; flex-direction: column;
}
.neoart-card:hover { transform: translateY(-3px); box-shadow: 0 8px 22px rgba(20,30,50,.10); }
.neoart-card .nc-head { display: flex; justify-content: space-between; align-items: center; padding: 10px 12px 0; }
.neoart-card .nc-vendor { font-weight: 700; font-size: .9rem; color: #1f2733; }
.neoart-thumb { width: 100%; aspect-ratio: 3/2; object-fit: contain; background: #f6f7f9; margin-top: 8px; }
.neoart-card .nc-const { height: 26px; background-repeat: repeat-x; background-size: auto 100%; border-top: 1px solid #eee; }
.neoart-card .nc-params { padding: 8px 12px; font-size: .8rem; color: #566; }
.neoart-card .nc-actions { padding: 8px 12px 12px; display: flex; gap: 6px; align-items: center; }
.neoart-badge { font-size: .68rem; padding: 3px 8px; border-radius: 999px; font-weight: 600; }
.nb-ready { background: #e7f6ec; color: #1a7f3d; }
.nb-flag  { background: #fff4e0; color: #a86200; }
.nb-cat   { background: #eef0f3; color: #566; }
.nb-pub   { background: #e6efff; color: #1657c8; }

/* Модалка редактора */
#neoartEditModal .modal-body { background: #f7f8fa; }
.neoart-crop-wrap { max-height: 60vh; background: #fff; border: 1px solid #e6e8ec; border-radius: 12px; overflow: hidden; }
.neoart-crop-wrap img { display: block; max-width: 100%; }
.neoart-mode-tabs .btn { border-radius: 10px; font-weight: 600; }
.neoart-side { background: #fff; border: 1px solid #e6e8ec; border-radius: 12px; padding: 14px; }
.neoart-side h6 { font-size: .82rem; text-transform: uppercase; letter-spacing: .03em; color: #8a94a6; margin-bottom: 10px; }

/* Мок карточки каталога в превью */
.neoart-cat-mock { width: 170px; margin: auto; border: 1px solid #e6e8ec; border-radius: 12px; overflow: hidden; background:#fff; }
.neoart-cat-mock img { width: 100%; aspect-ratio: 3/2; object-fit: contain; background:#f6f7f9; display:block; }
.neoart-cat-mock .cm-body { padding: 8px 10px; text-align: center; }

/* Живая рамка конструктора: 4 полосы repeat-x, боковые повёрнуты */
.neoart-frame-preview { position: relative; width: 260px; height: 190px; margin: auto; background: #fff; box-shadow: inset 0 0 0 1px #eee; }
.neoart-frame-preview .nf { position: absolute; background-repeat: repeat-x; background-size: auto 100%; }
.neoart-frame-preview .nf-top    { top: 0; left: 0; width: 260px; height: var(--nf-t, 30px); }
.neoart-frame-preview .nf-bottom { bottom: 0; left: 0; width: 260px; height: var(--nf-t, 30px); transform: rotate(180deg); }
.neoart-frame-preview .nf-left   { top: 0; left: 0; width: 190px; height: var(--nf-t, 30px); transform-origin: top left; transform: translateX(var(--nf-t, 30px)) rotate(90deg); }
.neoart-frame-preview .nf-right  { top: 0; right: 0; width: 190px; height: var(--nf-t, 30px); transform-origin: top right; transform: translateX(calc(-1 * var(--nf-t, 30px))) rotate(-90deg); }
.neoart-frame-preview .nf-center { position:absolute; inset: var(--nf-t,30px); background:#fbfbfc; }
```

- [ ] **Step 2: Rebuild the toolbar/filters/grid markup**

In `admin/view/neoart_import.php`, replace everything from line 1 through the `</div>` that closes `#neoartImportApp` (i.e. the whole first block BEFORE `<div class="modal fade" id="neoartEditModal"`) with:

```php
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
```

Note: progress bars now live inside `#neoartDlWrap` / `#neoartCutWrap` (start hidden). Task 3 doesn't touch these; the JS in Step 4 below reveals them on start.

- [ ] **Step 3: Rewrite `cardHtml` (clickable card, modern classes) in neoart_import.js**

Replace the existing `cardHtml: function (it) { ... }` in `admin/assets/js/neoart_import.js` with:

```javascript
        cardHtml: function (it) {
            const esc = NeoartUI.esc;
            let badge;
            if (it.in_catalog == 1) badge = '<span class="neoart-badge nb-cat">в каталоге ' + esc(it.catalog_publicvendor || '') + '</span>';
            else if (it.review_status === 'published') badge = '<span class="neoart-badge nb-pub">опубликован</span>';
            else if (it.cut_status === 'auto_flagged' || it.cut_status === 'error') badge = '<span class="neoart-badge nb-flag">правка</span>';
            else badge = '<span class="neoart-badge nb-ready">готов</span>';
            const listUrl = it.listimg_url ? esc(it.listimg_url) : '';
            const constBg = it.imgconst_url ? 'background-image:url(' + esc(it.imgconst_url) + ')' : '';
            const canApprove = it.in_catalog != 1 && it.listimg_url && it.imgconst_url && it.review_status !== 'published';
            return '' +
              '<div class="neoart-card" data-id="' + esc(it.id) + '">' +
                '<div class="nc-head"><span class="nc-vendor">' + esc(it.vendor) + '</span>' + badge + '</div>' +
                (listUrl ? '<img class="neoart-thumb" src="' + listUrl + '" alt="">' : '<div class="neoart-thumb"></div>') +
                '<div class="nc-const" style="' + constBg + '"></div>' +
                '<div class="nc-params">Ш ' + esc(it.width_mm) + ' / без чт ' + esc(it.widthwithout_mm) + ' мм<br>' + esc(it.price_final) + ' ₽ · остаток ' + esc(it.storage) + '</div>' +
                '<div class="nc-actions">' +
                  '<div class="form-check me-1"><input class="form-check-input neoart-select" type="checkbox" ' + (canApprove ? '' : 'disabled') + '></div>' +
                  '<button class="btn btn-sm btn-success neoart-approve" ' + (canApprove ? '' : 'disabled') + '>Одобрить</button>' +
                  '<button class="btn btn-sm btn-outline-danger neoart-reject">✕</button>' +
                '</div>' +
              '</div>';
        },
```

- [ ] **Step 4: Update bindings — whole card opens editor; actions stop propagation; progress wrappers reveal**

In `admin/assets/js/neoart_import.js`, inside the `$(function () { ... })` block:

(a) Replace the existing `.neoart-edit` open binding (`$('#neoartGrid').on('click', '.neoart-edit', ...)`) with a whole-card open + stopPropagation on the action controls:

```javascript
        $('#neoartGrid').on('click', '.neoart-card', function (e) {
            if ($(e.target).closest('.neoart-approve, .neoart-reject, .neoart-select').length) return;
            NeoartUI.openEdit($(this).data('id'));
        });
        $('#neoartGrid').on('click', '.neoart-approve, .neoart-reject', function (e) { e.stopPropagation(); });
        $('#neoartGrid').on('click', '.neoart-select', function (e) { e.stopPropagation(); });
```

(b) In `startDownload`, reveal the download progress wrapper — add `$('#neoartDlWrap').removeClass('d-none');` as the first line of the function body. In `startCut`, add `$('#neoartCutWrap').removeClass('d-none');` as the first line.

- [ ] **Step 5: Link the CSS + bump versions in index.php**

In `admin/index.php`: in `<head>` after the cropper CSS line, add:

```html
    <link rel="stylesheet" href="admin/assets/css/neoart_import.css?v1">
```

Wait — `admin/index.php` runs from the `admin/` directory, so use a path relative to it: `assets/css/neoart_import.css?v1`. Add:

```html
    <link rel="stylesheet" href="assets/css/neoart_import.css?v1">
```

And bump the script tag `assets/js/neoart_import.js?v2` → `assets/js/neoart_import.js?v3`.

- [ ] **Step 6: Verify**

```bash
cd "E:/OSPanel/domains/virtual-baget-curent"
node -c admin/assets/js/neoart_import.js
"/e/OSPanel/modules/php/PHP_8.1/php.exe" -l admin/view/neoart_import.php
grep -c "neoart_import.css" admin/index.php
```
Expected: node clean; php -l clean; css link present. **Browser check (controller):** open the Импорт Neoart tab — toolbar in a card, pill filters, modern card grid; clicking a card body opens the editor; clicking Одобрить/✕/checkbox does NOT open the editor; download/cut progress bars appear only after pressing the step buttons.

- [ ] **Step 7: Commit**

```bash
git add admin/assets/css/neoart_import.css admin/view/neoart_import.php admin/assets/js/neoart_import.js admin/index.php
git commit -m "feat(neoart): современная страница импорта + кликабельные карточки"
```

---

## Task 3: Editor core — centered/large modal, single Cropper (fix duplication), plain labels, editable fields

**Files:**
- Modify: `admin/view/neoart_import.php` (the `#neoartEditModal` block, from `<div class="modal fade" id="neoartEditModal"` to its close)
- Modify: `admin/assets/js/neoart_import.js` (`openEdit`, `setMode`, `saveCrop`, `upload`, `resetCut`, add `saveFields`; bindings)

**Interfaces:**
- Consumes: `NeoartUI.esc`, endpoints `item_get.php`, `item_save_crop.php` (which=listimg|imgconst), `item_upload.php` (which=raw|listimg|imgconst), `item_reset.php`, `item_update.php` (Task 1).
- Produces: a working non-duplicating editor. `NeoartUI._edit = {id, item, cropper, mode}`. `setMode('listimg'|'imgconst')` keeps exactly one `.cropper-container`. `saveFields()` posts editable fields. Task 4 will add live-preview calls inside `setMode`'s crop handler and `updatePreview()` — leave a `NeoartUI.updatePreview` no-op stub here that Task 4 replaces.

- [ ] **Step 1: Rebuild the modal markup**

In `admin/view/neoart_import.php`, replace the entire `#neoartEditModal` block with:

```php
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
```

- [ ] **Step 2: Rewrite the editor JS (single Cropper, fields, plain wiring)**

In `admin/assets/js/neoart_import.js`, replace the editor block — the `_edit` property and the functions `openEdit`, `setMode`, `saveCrop`, `upload`, `resetCut` — with:

```javascript
        _edit: { id: null, item: null, cropper: null, mode: 'listimg' },

        openEdit: function (id) {
            $.post(R + 'item_get.php', { id: id }).done((res) => {
                const it = res.item; const esc = NeoartUI.esc;
                NeoartUI._edit.id = id; NeoartUI._edit.item = it;
                $('#neoartEditVendor').text(it.vendor);
                $('#neoartPrevArt').text('Арт. ' + (it.catalog_publicvendor || it.vendor));
                $('#neoartPrevPrice').text((it.price_final || 0) + ' ₽');
                $('#neoartFWidth').val(it.width_mm); $('#neoartFWidthWo').val(it.widthwithout_mm);
                $('#neoartFPrice').val(it.price_final); $('#neoartFStorage').val(it.storage);
                $('#neoartFSection').val(it.section_name || '');
                $('#neoartFFlags').text(it.cut_flags || '—');
                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('neoartEditModal'));
                modal.show();
                NeoartUI.setMode('listimg');
            });
        },

        // Один Cropper. destroy() перед пересозданием; обработчик load вешается один раз.
        setMode: function (mode) {
            NeoartUI._edit.mode = mode;
            $('#neoartModeList').toggleClass('active', mode === 'listimg');
            $('#neoartModeConst').toggleClass('active', mode === 'imgconst');
            $('#neoartPrevTitle').text(mode === 'listimg' ? 'Как будет в каталоге' : 'Как будет рамка в конструкторе');
            $('#neoartPrevCatalog').toggleClass('d-none', mode !== 'listimg');
            $('#neoartPrevConstruct').toggleClass('d-none', mode !== 'imgconst');

            if (NeoartUI._edit.cropper) { NeoartUI._edit.cropper.destroy(); NeoartUI._edit.cropper = null; }
            const img = document.getElementById('neoartCropImg');
            const src = NeoartUI._edit.item.raw_url + '?t=' + Date.now(); // t: заставить load даже из кэша
            const build = () => {
                if (NeoartUI._edit.cropper) return;           // страховка от повторной инициализации
                NeoartUI._edit.cropper = new Cropper(img, {
                    viewMode: 1, autoCropArea: 0.6, background: false,
                    aspectRatio: mode === 'listimg' ? 150 / 100 : NaN,
                    crop: function () { NeoartUI.updatePreview(); },
                });
            };
            img.onload = build;
            img.src = src;
        },

        saveCrop: function () {
            const c = NeoartUI._edit.cropper; if (!c) return;
            const d = c.getData(true);
            $.post(R + 'item_save_crop.php', { id: NeoartUI._edit.id, which: NeoartUI._edit.mode, x: d.x, y: d.y, w: d.width, h: d.height })
                .done((res) => {
                    if (res.error) { toastr.error(res.error); return; }
                    toastr.success('Обрезка сохранена');
                    NeoartUI.loadGrid();
                });
        },

        saveFields: function () {
            $.post(R + 'item_update.php', {
                id: NeoartUI._edit.id,
                width_mm: $('#neoartFWidth').val(), widthwithout_mm: $('#neoartFWidthWo').val(),
                price_final: $('#neoartFPrice').val(), storage: $('#neoartFStorage').val(),
                section_name: $('#neoartFSection').val(),
            }).done((res) => {
                if (res.error) { toastr.error(res.error); return; }
                toastr.success('Параметры сохранены');
                $('#neoartPrevPrice').text(($('#neoartFPrice').val() || 0) + ' ₽');
                NeoartUI.loadGrid();
            }).fail(() => toastr.error('Не удалось сохранить параметры'));
        },

        upload: function (which, fileInput) {
            if (!fileInput.files || !fileInput.files[0]) return;
            const fd = new FormData(); fd.append('id', NeoartUI._edit.id); fd.append('which', which); fd.append('file', fileInput.files[0]);
            $.ajax({ url: R + 'item_upload.php', method: 'POST', data: fd, processData: false, contentType: false })
                .done((res) => {
                    if (res.error) { toastr.error(res.error); return; }
                    toastr.success('Загружено');
                    if (which === 'raw') NeoartUI.setMode(NeoartUI._edit.mode);
                    NeoartUI.loadGrid();
                });
            fileInput.value = '';
        },

        resetCut: function () {
            $.post(R + 'item_reset.php', { id: NeoartUI._edit.id }).done((res) => {
                toastr.info('Пересобрано автоматически' + (res.cut_flags ? ' (флаги: ' + res.cut_flags + ')' : ''));
                $('#neoartFFlags').text(res.cut_flags || '—');
                NeoartUI.setMode(NeoartUI._edit.mode);
                NeoartUI.loadGrid();
            });
        },

        // Заглушка — Task 4 заменит на живой предпросмотр.
        updatePreview: function () {},
```

- [ ] **Step 3: Update the editor bindings**

In the `$(function () { ... })` block of `admin/assets/js/neoart_import.js`, ensure these bindings exist (replace the old editor bindings block):

```javascript
        $('#neoartModeList').on('click', () => NeoartUI.setMode('listimg'));
        $('#neoartModeConst').on('click', () => NeoartUI.setMode('imgconst'));
        $('#neoartCropSave').on('click', NeoartUI.saveCrop);
        $('#neoartResetCut').on('click', NeoartUI.resetCut);
        $('#neoartSaveFields').on('click', NeoartUI.saveFields);
        $('#neoartUpRaw').on('change', function () { NeoartUI.upload('raw', this); });
        $('#neoartUpList').on('change', function () { NeoartUI.upload('listimg', this); });
        $('#neoartUpConst').on('change', function () { NeoartUI.upload('imgconst', this); });
```

- [ ] **Step 4: Verify**

```bash
cd "E:/OSPanel/domains/virtual-baget-curent"
node -c admin/assets/js/neoart_import.js
"/e/OSPanel/modules/php/PHP_8.1/php.exe" -l admin/view/neoart_import.php
```
Expected: both clean. **Browser check (controller):** modal opens centered & large; image fits inside (no overflow); switching «Картинка для каталога» ↔ «Картинка для конструктора» keeps exactly ONE `.cropper-container` (no stacking/duplication after 10 toggles); editable fields populate and «Сохранить» persists them (reopen shows new values); labels are plain Russian.

- [ ] **Step 5: Commit**

```bash
git add admin/view/neoart_import.php admin/assets/js/neoart_import.js
git commit -m "feat(neoart): переработанный редактор — центр/крупная модалка, один Cropper (фикс дублирования), понятные подписи, редактируемые поля"
```

---

## Task 4: Live previews — catalog card + constructor frame

**Files:**
- Modify: `admin/assets/js/neoart_import.js` (replace the `updatePreview` stub with the real live preview; add a throttle helper)

**Interfaces:**
- Consumes: `NeoartUI._edit.cropper` (Cropper instance, `getCroppedCanvas()`), `NeoartUI._edit.mode`, the DOM ids `#neoartPrevList` (catalog mock img) and `#neoartFramePrev` (frame preview with `.nf-top/.nf-bottom/.nf-left/.nf-right`).
- Produces: `updatePreview()` renders the active mode's live preview from the current crop, throttled (~100ms). Catalog mode → sets `#neoartPrevList` src to a 150×100 cropped dataURL. Constructor mode → sets the 4 frame strips' `background-image` to the cropped strip dataURL (matching `block_2_maket.php`'s repeat-x tiling).

- [ ] **Step 1: Replace the `updatePreview` stub with the live implementation**

In `admin/assets/js/neoart_import.js`, replace `updatePreview: function () {},` with:

```javascript
        _previewTimer: null,
        updatePreview: function () {
            // троттлинг: Cropper шлёт crop часто
            if (NeoartUI._previewTimer) return;
            NeoartUI._previewTimer = setTimeout(function () {
                NeoartUI._previewTimer = null;
                NeoartUI._renderPreview();
            }, 100);
        },
        _renderPreview: function () {
            const c = NeoartUI._edit.cropper; if (!c) return;
            if (NeoartUI._edit.mode === 'listimg') {
                const canvas = c.getCroppedCanvas({ width: 150, height: 100, imageSmoothingQuality: 'high' });
                if (canvas) $('#neoartPrevList').attr('src', canvas.toDataURL('image/jpeg', 0.85));
            } else {
                const canvas = c.getCroppedCanvas({ imageSmoothingQuality: 'high' });
                if (!canvas) return;
                const url = canvas.toDataURL('image/jpeg', 0.85);
                // толщина рамки в превью пропорциональна высоте полосы (в разумных пределах)
                const bw = canvas.width || 1;
                const t = Math.max(18, Math.min(46, Math.round((canvas.height / bw) * 260)));
                const fp = document.getElementById('neoartFramePrev');
                fp.style.setProperty('--nf-t', t + 'px');
                ['nf-top', 'nf-bottom', 'nf-left', 'nf-right'].forEach(function (cls) {
                    const el = fp.querySelector('.' + cls);
                    if (el) el.style.backgroundImage = 'url(' + url + ')';
                });
            }
        },
```

- [ ] **Step 2: Verify**

```bash
cd "E:/OSPanel/domains/virtual-baget-curent"
node -c admin/assets/js/neoart_import.js
```
Expected: clean. **Browser check (controller):** open editor → in «Картинка для каталога», dragging the crop box updates the catalog mock image in real time; switch to «Картинка для конструктора», dragging the crop box updates the frame preview in real time — the 4 strips tile the profile around a rectangle (top/bottom horizontal, left/right vertical), visibly forming a baguette frame like the real constructor. If the two side strips don't align onto the left/right edges, adjust the `.nf-left`/`.nf-right` transforms in `neoart_import.css` (rotation/translate/flip) until they form a clean frame, and confirm again.

- [ ] **Step 3: Commit**

```bash
git add admin/assets/js/neoart_import.js
git commit -m "feat(neoart): живой предпросмотр — карточка каталога и сборка рамки конструктора в реальном времени"
```

---

## Self-Review (plan vs spec)

- Spec §3 modern page + clickable cards → Task 2 (CSS, toolbar/filters/grid, cardHtml click). ✓
- Spec §4 centered/xl/scrollable modal + no overflow → Task 3 Step 1 (modal classes) + `.neoart-crop-wrap max-height:60vh` (Task 2 CSS). ✓
- Spec §5 single Cropper fix / plain labels / active-mode-only preview / editable fields → Task 3. ✓
- Spec §5 live catalog + constructor previews → Task 4. ✓
- Spec §6 item_update endpoint → Task 1. ✓
- Spec §2 flags read-only → Task 3 (flags shown in `#neoartFFlags`, no input). ✓
- Spec §2 internal keys listimg/imgconst → used in setMode/saveCrop/upload (which). ✓
- Spec §7 files → item_update.php (T1), neoart_import.css (T2), neoart_import.php/js + index.php (T2/T3/T4). ✓
- XSS: cardHtml uses esc() on all fields; modal fields use .val()/.text(); previews use dataURL (safe). ✓
- Type/name consistency: `NeoartUI.updatePreview` stub (T3) → real (T4); `_edit` shape consistent; DOM ids (`#neoartPrevList`, `#neoartFramePrev`, `#neoartF*`) consistent between modal markup (T3) and JS (T3/T4). ✓
- No placeholders: all steps carry concrete code; the one "tune in browser" note (T4 Step 2) is legitimate visual-CSS calibration with a concrete starting implementation, not a code gap. ✓
