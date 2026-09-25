/* Каталог работ: категории слева, работы выбранной категории справа. */
(function () {
    'use strict';

    var root = document.getElementById('ga');

    if (!root) {
        return;
    }

    var API = '/admin/request/galleryWorks/';
    var PLACEHOLDER = '/assets/img/gallery-category-placeholder.svg';
    var PUBLIC_CATEGORY_URL = '/сatalog-of-finished-works-by-category.php?category=';
    var RESIZE_MAX_SIDE = 2000;
    var RESIZE_FROM_BYTES = 1.5 * 1024 * 1024;
    var NEW_CAT_FILE_LABEL = 'Добавить обложку (можно позже)';

    var ICONS = {
        edit: '<path d="M4 20h4L19 9l-4-4L4 16v4z"/><path d="M13.5 6.5l4 4"/>',
        open: '<path d="M14 5h5v5"/><path d="M19 5l-8 8"/><path d="M18 14v5H5V6h5"/>',
        trash: '<path d="M4 7h16"/><path d="M9 7V4.5h6V7"/><path d="M6.5 7l1 13h9l1-13"/><path d="M10 11v5.5M14 11v5.5"/>',
        grid: '<rect x="4" y="4" width="7" height="7" rx="1.5"/><rect x="13" y="4" width="7" height="7" rx="1.5"/>' +
            '<rect x="4" y="13" width="7" height="7" rx="1.5"/><rect x="13" y="13" width="7" height="7" rx="1.5"/>'
    };

    var HANDLE = '<svg viewBox="0 0 8 14" aria-hidden="true"><circle cx="2" cy="2" r="1.2"/><circle cx="6" cy="2" r="1.2"/>' +
        '<circle cx="2" cy="7" r="1.2"/><circle cx="6" cy="7" r="1.2"/><circle cx="2" cy="12" r="1.2"/><circle cx="6" cy="12" r="1.2"/></svg>';

    var state = {
        categories: [],
        works: [],
        currentId: null, // null — «Все работы»
        selected: new Set(),
        search: '',
        loading: false,
        uploading: false
    };

    var worksRequestToken = 0;
    var lastToggledId = null;
    var draggingWorks = null;
    var fileDragDepth = 0;
    var uploadQueue = [];
    var uploadStats = {total: 0, done: 0, failed: 0};
    var sortable = null;
    var lastSortEndAt = 0;
    var editor = {work: null, file: null, previewUrl: null};

    var ui = {
        side: root.querySelector('.ga-side'),
        stats: byId('gaStats'),
        all: byId('gaAll'),
        catList: byId('gaCatList'),
        head: byId('gaHead'),
        grid: byId('gaGrid'),
        drop: byId('gaDrop'),
        dropOverlay: byId('gaDropOverlay'),
        search: byId('gaSearch'),
        uploadBtn: byId('gaUploadBtn'),
        fileInput: byId('gaFileInput'),
        selectAll: byId('gaSelectAll'),
        upload: byId('gaUpload'),
        uploadText: byId('gaUploadText'),
        uploadBar: byId('gaUploadBar'),
        selBar: byId('gaSelBar'),
        selCount: byId('gaSelCount'),
        selTarget: byId('gaSelTarget'),
        newCatToggle: byId('gaNewCatToggle'),
        newCatForm: byId('gaNewCatForm'),
        newCatName: byId('gaNewCatName'),
        newCatFile: byId('gaNewCatFile'),
        newCatFileLabel: byId('gaNewCatFileLabel'),
        newCatCancel: byId('gaNewCatCancel'),
        deleteModal: byId('gaDeleteModal'),
        workModal: byId('gaWorkModal'),
        workImg: byId('gaWorkImg'),
        workFile: byId('gaWorkFile'),
        workFileHint: byId('gaWorkFileHint'),
        workCategory: byId('gaWorkCategory'),
        workDesc: byId('gaWorkDesc'),
        workSave: byId('gaWorkSave')
    };

    // ---------- Утилиты ----------

    function byId(id) {
        return document.getElementById(id);
    }

    function icon(name) {
        return '<svg class="ga-ico" viewBox="0 0 24 24" aria-hidden="true">' + ICONS[name] + '</svg>';
    }

    function esc(value) {
        return String(value === null || value === undefined ? '' : value).replace(/[&<>"']/g, function (char) {
            return {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'}[char];
        });
    }

    function imageUrl(path) {
        if (!path) {
            return PLACEHOLDER;
        }

        if (/^(https?:|blob:)/i.test(path)) {
            return path;
        }

        return '/' + String(path).replace(/^[.\/]+/, '');
    }

    function plural(count, one, few, many) {
        var n = Math.abs(count) % 100;
        var n1 = n % 10;

        if (n > 10 && n < 20) {
            return many;
        }
        if (n1 > 1 && n1 < 5) {
            return few;
        }
        if (n1 === 1) {
            return one;
        }

        return many;
    }

    function worksLabel(count) {
        return count + ' ' + plural(count, 'работа', 'работы', 'работ');
    }

    var notify = AdminUI.notify;
    var showError = AdminUI.showError;
    var confirmDialog = AdminUI.confirm;

    function api(endpoint, data) {
        return AdminUI.api(API + endpoint, data);
    }

    function findCategory(id) {
        return state.categories.find(function (category) {
            return String(category.id) === String(id);
        }) || null;
    }

    function findWork(id) {
        return state.works.find(function (work) {
            return String(work.id) === String(id);
        }) || null;
    }

    function currentCategory() {
        return state.currentId === null ? null : findCategory(state.currentId);
    }

    function filteredWorks() {
        var query = state.search.trim().toLowerCase();

        if (!query) {
            return state.works;
        }

        return state.works.filter(function (work) {
            return (work.description || '').toLowerCase().indexOf(query) !== -1;
        });
    }

    function categoryOptions(excludeId, selectedId) {
        return state.categories.filter(function (category) {
            return excludeId === undefined || String(category.id) !== String(excludeId);
        }).map(function (category) {
            return '<option value="' + category.id + '"' + (String(category.id) === String(selectedId) ? ' selected' : '') + '>' +
                esc(category.name) + '</option>';
        }).join('');
    }

    function openModal(modal, focusEl) {
        AdminUI.openModal(modal, {
            focus: focusEl,
            onClose: modal === ui.workModal ? resetEditor : null
        });
    }

    var closeModal = AdminUI.closeModal;

    // ---------- Загрузка данных ----------

    function loadCategories() {
        return api('getCategories.php').then(function (json) {
            state.categories = json.data || [];

            if (state.currentId !== null && !currentCategory()) {
                state.currentId = null;
                loadWorks();
            }

            renderSidebar();
            renderHead();
            renderSelectTargets();
            renderToolbar();
        }).catch(showError);
    }

    function loadWorks() {
        var token = ++worksRequestToken;
        var payload = state.currentId === null ? {} : {category_id: state.currentId};

        state.loading = true;
        renderGrid();

        return api('getWorks.php', payload).then(function (json) {
            if (token !== worksRequestToken) {
                return;
            }

            state.works = json.data || [];
            state.loading = false;

            var ids = new Set(state.works.map(function (work) {
                return String(work.id);
            }));
            state.selected.forEach(function (id) {
                if (!ids.has(id)) {
                    state.selected.delete(id);
                }
            });

            renderGrid(true);
        }).catch(function (error) {
            if (token !== worksRequestToken) {
                return;
            }

            state.loading = false;
            state.works = [];
            renderGrid();
            showError(error);
        });
    }

    function refresh() {
        return Promise.all([loadCategories(), loadWorks()]);
    }

    function selectCategory(id) {
        var next = id === '' || id === null || id === undefined ? null : String(id);

        if (next === state.currentId) {
            return;
        }

        state.currentId = next;
        state.works = [];
        state.selected.clear();
        state.search = '';
        ui.search.value = '';
        lastToggledId = null;

        renderSidebar();
        renderHead();
        renderSelectTargets();
        renderToolbar();
        loadWorks();
    }

    // ---------- Отрисовка ----------

    function renderSidebar() {
        var totalWorks = state.categories.reduce(function (sum, category) {
            return sum + (parseInt(category.works_count, 10) || 0);
        }, 0);
        var hiddenCount = state.categories.filter(function (category) {
            return parseInt(category.is_visible, 10) !== 1;
        }).length;

        ui.stats.textContent = state.categories.length + ' ' +
            plural(state.categories.length, 'категория', 'категории', 'категорий') + ' · ' + worksLabel(totalWorks) +
            (hiddenCount ? ' · скрыто: ' + hiddenCount : '');

        ui.all.innerHTML =
            '<button type="button" class="ga-cat ga-cat-all' + (state.currentId === null ? ' is-active' : '') + '" data-id="">' +
            '<span class="ga-cat-icon">' + icon('grid') + '</span>' +
            '<span class="ga-cat-text"><span class="ga-cat-name">Все работы</span>' +
            '<span class="ga-cat-meta">' + worksLabel(totalWorks) + '</span></span>' +
            '</button>';

        ui.catList.innerHTML = state.categories.map(function (category) {
            var visible = parseInt(category.is_visible, 10) === 1;
            var count = parseInt(category.works_count, 10) || 0;
            var classes = 'ga-cat' +
                (String(category.id) === state.currentId ? ' is-active' : '') +
                (visible ? '' : ' is-hidden');

            return '<div class="' + classes + '" data-id="' + category.id + '" role="button" tabindex="0">' +
                '<span class="ga-handle" title="Перетащите, чтобы изменить порядок">' + HANDLE + '</span>' +
                '<img class="ga-cat-img" src="' + esc(imageUrl(category.main_image)) + '" alt="" loading="lazy">' +
                '<span class="ga-cat-text">' +
                '<span class="ga-cat-name">' + esc(category.name) + '</span>' +
                '<span class="ga-cat-meta">' + worksLabel(count) +
                (visible ? '' : ' · <span class="ga-tag-hidden">скрыта</span>') + '</span>' +
                '</span>' +
                '</div>';
        }).join('') || '<div class="ga-muted" style="padding:8px 10px">Категорий пока нет — создайте первую</div>';

        initSortable();
    }

    function renderHead() {
        // Не перерисовываем шапку, пока в ней редактируют название
        if (document.activeElement && document.activeElement.id === 'gaNameInput') {
            return;
        }

        var category = currentCategory();

        if (!category) {
            ui.head.className = 'ga-head';
            ui.head.innerHTML =
                '<div class="ga-head-body">' +
                '<div class="ga-eyebrow">Обзор</div>' +
                '<h2 class="ga-head-title">Все работы</h2>' +
                '<div class="ga-muted">Выберите категорию слева, чтобы загружать в неё работы, переименовать её, сменить обложку или удалить.</div>' +
                '</div>';
            return;
        }

        var visible = parseInt(category.is_visible, 10) === 1;
        var count = parseInt(category.works_count, 10) || 0;

        ui.head.className = 'ga-head' + (visible ? '' : ' is-hidden');
        ui.head.innerHTML =
            '<div class="ga-cover">' +
            '<img src="' + esc(imageUrl(category.main_image)) + '" alt="Обложка категории" id="gaCoverImg">' +
            '<label class="ga-cover-edit" for="gaCoverInput">Сменить обложку</label>' +
            '<input type="file" id="gaCoverInput" accept=".jpg,.jpeg,.png" hidden>' +
            '</div>' +
            '<div class="ga-head-body">' +
            '<div class="ga-eyebrow">Категория</div>' +
            '<div class="ga-name-row">' +
            '<input type="text" class="ga-name-input" id="gaNameInput" maxlength="150" value="' + esc(category.name) + '" ' +
            'aria-label="Название категории" title="Нажмите, чтобы переименовать">' +
            '<button type="button" class="ga-icon-btn" id="gaRename" title="Переименовать" aria-label="Переименовать">' + icon('edit') + '</button>' +
            '</div>' +
            '<div class="ga-head-meta">' +
            '<span class="ga-chip">' + worksLabel(count) + '</span>' +
            (category.slug ? '<a class="ga-link" href="' + esc(PUBLIC_CATEGORY_URL + encodeURIComponent(category.slug)) + '" target="_blank" rel="noopener">Открыть на сайте ' + icon('open') + '</a>' : '') +
            '</div>' +
            '</div>' +
            '<div class="ga-head-side">' +
            '<label class="ga-switch">' +
            '<input type="checkbox" id="gaVisible"' + (visible ? ' checked' : '') + '>' +
            '<span class="ga-switch-track" aria-hidden="true"></span>' +
            '<span class="ga-switch-label">' + (visible ? 'Показывается на сайте' : 'Скрыта на сайте') + '</span>' +
            '</label>' +
            '<button type="button" class="ga-btn ga-btn--danger-ghost ga-btn--sm" id="gaDeleteCat">' + icon('trash') + 'Удалить категорию</button>' +
            '</div>';
    }

    function renderSelectTargets() {
        ui.selTarget.innerHTML = '<option value="">Перенести в категорию…</option>' +
            categoryOptions(state.currentId === null ? undefined : state.currentId);
    }

    function renderToolbar() {
        var category = currentCategory();

        ui.uploadBtn.disabled = !category;
        ui.uploadBtn.title = category ? 'Можно выбрать сразу несколько фото' : 'Сначала выберите категорию слева';
        ui.drop.classList.toggle('no-category', !category);
        ui.dropOverlay.textContent = category
            ? 'Отпустите, чтобы загрузить в «' + category.name + '»'
            : 'Сначала выберите категорию слева';
    }

    function workCard(work, index) {
        var id = String(work.id);
        var url = esc(imageUrl(work.url_image));
        var categoryBadge = state.currentId === null
            ? '<span class="ga-work-cat">' + esc((findCategory(work.category) || {}).name || 'Без категории') + '</span>'
            : '';

        return '<div class="ga-work' + (state.selected.has(id) ? ' is-selected' : '') + '" data-id="' + id + '" style="--i:' + Math.min(index, 24) + '">' +
            '<div class="ga-work-img" draggable="true" title="Клик — открыть, кружок — выбрать, перетаскивание на категорию — перенести">' +
            '<img src="' + url + '" alt="" loading="lazy" draggable="false">' +
            '<span class="ga-work-check" role="checkbox" aria-label="Выбрать" title="Выбрать (Shift — диапазон)"></span>' +
            '<div class="ga-work-tools">' +
            '<button type="button" class="ga-tool" data-act="edit" title="Редактировать">' + icon('edit') + '</button>' +
            '<a class="ga-tool" href="' + url + '" target="_blank" rel="noopener" title="Открыть в полном размере">' + icon('open') + '</a>' +
            '<button type="button" class="ga-tool ga-tool--danger" data-act="delete" title="Удалить работу">' + icon('trash') + '</button>' +
            '</div>' +
            categoryBadge +
            '</div>' +
            '<textarea class="ga-desc" rows="2" placeholder="Добавить описание…">' + esc(work.description || '') + '</textarea>' +
            '</div>';
    }

    function emptyState(title, text) {
        return '<div class="ga-empty"><span class="ga-empty-frame" aria-hidden="true"></span>' +
            '<div class="ga-empty-title">' + title + '</div>' + (text ? '<div>' + text + '</div>' : '') + '</div>';
    }

    // animate — плавное появление карточек (только при смене категории / первой загрузке)
    function renderGrid(animate) {
        ui.grid.classList.toggle('is-static', !animate);

        if (state.loading && !state.works.length) {
            ui.grid.innerHTML = new Array(8).join('<div class="ga-work is-skeleton"><div class="ga-work-img"></div><div class="ga-skeleton-line"></div></div>');
            renderSelection();
            return;
        }

        var list = filteredWorks();

        if (list.length) {
            ui.grid.innerHTML = list.map(workCard).join('');
        } else if (state.search.trim()) {
            ui.grid.innerHTML = emptyState('Ничего не найдено', 'Попробуйте изменить запрос');
        } else if (currentCategory()) {
            ui.grid.innerHTML = emptyState('Рама ждёт работ', 'Перетащите фотографии сюда или нажмите «Загрузить работы»');
        } else {
            ui.grid.innerHTML = emptyState('Работ пока нет', 'Создайте категорию и загрузите в неё фотографии');
        }

        renderSelection();
    }

    function renderSelection() {
        ui.grid.querySelectorAll('.ga-work[data-id]').forEach(function (card) {
            var selected = state.selected.has(card.dataset.id);
            var check = card.querySelector('.ga-work-check');

            card.classList.toggle('is-selected', selected);

            if (check) {
                check.setAttribute('aria-checked', selected ? 'true' : 'false');
            }
        });

        var count = state.selected.size;
        var visibleIds = filteredWorks().map(function (work) {
            return String(work.id);
        });
        var selectedVisible = visibleIds.filter(function (id) {
            return state.selected.has(id);
        }).length;

        ui.grid.classList.toggle('has-selection', count > 0);
        ui.selBar.hidden = count === 0;
        ui.selCount.textContent = count;
        ui.selectAll.disabled = visibleIds.length === 0;
        ui.selectAll.checked = visibleIds.length > 0 && selectedVisible === visibleIds.length;
        ui.selectAll.indeterminate = selectedVisible > 0 && selectedVisible < visibleIds.length;
    }

    // ---------- Порядок категорий (перетаскивание) ----------

    function initSortable() {
        if (sortable || typeof window.Sortable === 'undefined') {
            return;
        }

        sortable = window.Sortable.create(ui.catList, {
            animation: 160,
            draggable: '.ga-cat',
            forceFallback: true, // мышиный режим — не мешает перетаскиванию работ на категории
            fallbackTolerance: 4,
            ghostClass: 'ga-cat-ghost',
            chosenClass: 'ga-cat-chosen',
            onEnd: function (event) {
                lastSortEndAt = Date.now();

                if (event.oldIndex !== event.newIndex) {
                    saveCategoriesOrder();
                }
            }
        });
    }

    function saveCategoriesOrder() {
        var ids = Array.prototype.map.call(ui.catList.querySelectorAll('.ga-cat[data-id]'), function (item) {
            return item.dataset.id;
        });

        state.categories = ids.map(findCategory).filter(Boolean);
        renderSelectTargets();

        api('setCategoriesOrder.php', {ids: ids}).then(function () {
            notify('success', 'Порядок категорий сохранён');
        }).catch(function (error) {
            showError(error);
            loadCategories();
        });
    }

    // ---------- Категории: создание, правка, удаление ----------

    // Название, которое сейчас в поле (могли переименовать и сразу нажать переключатель)
    function pendingName(category) {
        var input = byId('gaNameInput');
        var value = input && String(state.currentId) === String(category.id) ? input.value.trim() : '';

        return value || category.name;
    }

    function saveCategory(category, changes, file) {
        var form = new FormData();
        var visible = changes.is_visible !== undefined ? changes.is_visible : parseInt(category.is_visible, 10) === 1;

        form.append('id', category.id);
        form.append('name', changes.name !== undefined ? changes.name : pendingName(category));
        form.append('is_visible', visible ? '1' : '0');

        if (file) {
            form.append('main_image', file);
        }

        return api('saveCategory.php', form).then(loadCategories);
    }

    function commitName(input) {
        var category = currentCategory();

        if (!category) {
            return;
        }

        var name = input.value.trim();

        if (name === '' || name === category.name) {
            input.value = category.name;
            return;
        }

        saveCategory(category, {name: name}).then(function () {
            notify('success', 'Категория переименована');
        }).catch(function (error) {
            input.value = category.name;
            showError(error);
        });
    }

    function createCategory(event) {
        event.preventDefault();

        var name = ui.newCatName.value.trim();

        if (!name) {
            ui.newCatName.focus();
            return;
        }

        var form = new FormData();
        form.append('name', name);
        form.append('is_visible', '1');

        if (ui.newCatFile.files.length) {
            form.append('main_image', ui.newCatFile.files[0]);
        }

        api('saveCategory.php', form).then(function (json) {
            resetNewCategoryForm();
            notify('success', 'Категория «' + name + '» создана');
            return loadCategories().then(function () {
                if (json.id) {
                    selectCategory(json.id);
                }
            });
        }).catch(showError);
    }

    function resetNewCategoryForm() {
        ui.newCatForm.reset();
        ui.newCatFileLabel.textContent = NEW_CAT_FILE_LABEL;
        ui.newCatForm.hidden = true;
    }

    function openDeleteCategory() {
        var category = currentCategory();

        if (!category) {
            return;
        }

        var count = parseInt(category.works_count, 10) || 0;
        var options = categoryOptions(category.id);

        byId('gaDeleteName').textContent = '«' + category.name + '»';
        byId('gaDeleteCount').textContent = worksLabel(count);
        byId('gaDeleteWorks').hidden = count === 0;
        byId('gaDeleteTarget').innerHTML = options;
        byId('gaDeleteModeMove').disabled = !options;
        byId('gaDeleteModeMove').checked = !!options;
        byId('gaDeleteModeDelete').checked = !options;
        syncDeleteControls();
        openModal(ui.deleteModal, ui.deleteModal.querySelector('[data-ga-close].ga-btn'));
    }

    function syncDeleteControls() {
        var hasWorks = !byId('gaDeleteWorks').hidden;
        var deletingWorks = hasWorks && byId('gaDeleteModeDelete').checked;

        byId('gaDeleteTarget').disabled = deletingWorks || byId('gaDeleteModeMove').disabled;
        byId('gaDeleteConfirm').textContent = deletingWorks ? 'Удалить вместе с работами' : 'Удалить категорию';
    }

    function confirmDeleteCategory() {
        var category = currentCategory();

        if (!category) {
            return;
        }

        var hasWorks = !byId('gaDeleteWorks').hidden;
        var mode = hasWorks && byId('gaDeleteModeDelete').checked ? 'delete' : 'move';
        var ask = mode === 'delete'
            ? confirmDialog({
                title: 'Точно удалить всё?',
                html: 'Категория <b>«' + esc(category.name) + '»</b> и ' + worksLabel(parseInt(category.works_count, 10) || 0) +
                    ' в ней будут удалены безвозвратно вместе с фотографиями.',
                ok: 'Да, удалить всё'
            })
            : Promise.resolve(true);

        ask.then(function (ok) {
            if (!ok) {
                return;
            }

            var button = byId('gaDeleteConfirm');
            button.disabled = true;

            api('deleteCategory.php', {
                id: category.id,
                mode: mode,
                target_id: hasWorks && mode === 'move' ? byId('gaDeleteTarget').value : 0
            }).then(function (json) {
                var message = 'Категория «' + category.name + '» удалена';

                if (json.moved) {
                    message += ', перенесено: ' + worksLabel(json.moved);
                }
                if (json.deleted_works) {
                    message += ', удалено: ' + worksLabel(json.deleted_works);
                }

                closeModal(ui.deleteModal);
                notify('success', message);
                state.currentId = null;
                state.selected.clear();
                refresh();
            }).catch(showError).then(function () {
                button.disabled = false;
            });
        });
    }

    // ---------- Работы: выбор, перенос, удаление, описание ----------

    function toggleSelect(id, withRange) {
        var order = filteredWorks().map(function (work) {
            return String(work.id);
        });

        if (withRange && lastToggledId !== null && order.indexOf(lastToggledId) !== -1) {
            var from = Math.min(order.indexOf(lastToggledId), order.indexOf(id));
            var to = Math.max(order.indexOf(lastToggledId), order.indexOf(id));
            var select = state.selected.has(lastToggledId);

            for (var i = from; i <= to; i++) {
                if (select) {
                    state.selected.add(order[i]);
                } else {
                    state.selected.delete(order[i]);
                }
            }
        } else if (state.selected.has(id)) {
            state.selected.delete(id);
        } else {
            state.selected.add(id);
        }

        lastToggledId = id;
        renderSelection();
    }

    function forgetWorks(ids) {
        var removed = new Set(ids.map(String));

        state.works = state.works.filter(function (work) {
            return !removed.has(String(work.id));
        });
        removed.forEach(function (id) {
            state.selected.delete(id);
        });
    }

    function moveWorks(ids, categoryId) {
        var target = findCategory(categoryId);

        if (!target || !ids.length) {
            return;
        }

        api('bulkWorks.php', {action: 'move', ids: ids, category_id: target.id}).then(function () {
            if (state.currentId === null) {
                var moved = new Set(ids.map(String));
                state.works.forEach(function (work) {
                    if (moved.has(String(work.id))) {
                        work.category = parseInt(target.id, 10);
                    }
                });
                ids.forEach(function (id) {
                    state.selected.delete(String(id));
                });
            } else {
                forgetWorks(ids);
            }

            renderGrid();
            loadCategories();
            notify('success', 'Перенесено в «' + target.name + '»: ' + worksLabel(ids.length));
        }).catch(showError);
    }

    // Всегда спрашивает подтверждение; Promise<boolean> — удалено ли
    function deleteWorks(ids) {
        if (!ids.length) {
            return Promise.resolve(false);
        }

        var single = ids.length === 1;

        return confirmDialog({
            title: single ? 'Удалить работу?' : 'Удалить ' + worksLabel(ids.length) + '?',
            html: single
                ? 'Работа пропадёт с сайта, фотография будет удалена <b>безвозвратно</b>.'
                : 'Выбранные работы пропадут с сайта, фотографии будут удалены <b>безвозвратно</b>.',
            ok: single ? 'Удалить работу' : 'Удалить ' + worksLabel(ids.length)
        }).then(function (ok) {
            if (!ok) {
                return false;
            }

            return api('bulkWorks.php', {action: 'delete', ids: ids}).then(function () {
                forgetWorks(ids);
                renderGrid();
                loadCategories();
                notify('success', single ? 'Работа удалена' : 'Удалено: ' + worksLabel(ids.length));
                return true;
            });
        }).catch(function (error) {
            showError(error);
            return false;
        });
    }

    function saveDescription(textarea) {
        var card = textarea.closest('.ga-work');
        var work = card && findWork(card.dataset.id);

        if (!work || textarea.value === (work.description || '')) {
            return;
        }

        var value = textarea.value;

        api('setDescGalleryWorks.php', {id: work.id, description: value}).then(function () {
            work.description = value;
            card.classList.add('is-saved');
            setTimeout(function () {
                card.classList.remove('is-saved');
            }, 1200);
        }).catch(showError);
    }

    // ---------- Редактор работы ----------

    function openWorkEditor(id) {
        var work = findWork(id);

        if (!work) {
            return;
        }

        resetEditor();
        editor.work = work;
        ui.workImg.src = imageUrl(work.url_image);
        ui.workCategory.innerHTML = categoryOptions(undefined, work.category);
        ui.workDesc.value = work.description || '';
        openModal(ui.workModal, ui.workDesc);
    }

    function resetEditor() {
        if (editor.previewUrl) {
            URL.revokeObjectURL(editor.previewUrl);
        }

        editor = {work: null, file: null, previewUrl: null};
        ui.workFile.value = '';
        ui.workFileHint.textContent = '';
        ui.workSave.disabled = false;
    }

    function saveWorkEditor() {
        var work = editor.work;

        if (!work) {
            return;
        }

        var categoryId = ui.workCategory.value;
        var categoryChanged = String(categoryId) !== String(work.category);
        var form = new FormData();

        form.append('id', work.id);
        form.append('category_id', categoryId);
        form.append('description', ui.workDesc.value);

        if (editor.file) {
            form.append('image', editor.file, editor.file.name);
        }

        ui.workSave.disabled = true;

        api('saveWork.php', form).then(function (json) {
            var data = json.data || {};

            if (state.currentId !== null && String(data.category) !== state.currentId) {
                forgetWorks([work.id]);
            } else {
                work.category = data.category;
                work.url_image = data.url_image;
                work.description = data.description;
            }

            closeModal(ui.workModal);
            renderGrid();
            notify('success', categoryChanged
                ? 'Сохранено и перенесено в «' + ((findCategory(categoryId) || {}).name || '') + '»'
                : 'Работа сохранена');

            if (categoryChanged) {
                loadCategories();
            }
        }).catch(function (error) {
            ui.workSave.disabled = false;
            showError(error);
        });
    }

    ui.workFile.addEventListener('change', function () {
        var file = ui.workFile.files[0];

        if (!file || !editor.work) {
            return;
        }

        if (!isImageFile(file)) {
            notify('warning', 'Нужен файл JPG, PNG или HEIC');
            return;
        }

        ui.workFileHint.textContent = 'Подготовка фото…';
        ui.workSave.disabled = true;

        prepareImage(file).then(function (prepared) {
            if (editor.previewUrl) {
                URL.revokeObjectURL(editor.previewUrl);
            }

            editor.file = prepared;
            editor.previewUrl = URL.createObjectURL(prepared);
            ui.workImg.src = editor.previewUrl;
            ui.workFileHint.textContent = 'Новое фото заменит текущее после сохранения';
        }).catch(function (error) {
            ui.workFileHint.textContent = '';
            showError(error);
        }).then(function () {
            ui.workSave.disabled = false;
        });
    });

    ui.workSave.addEventListener('click', saveWorkEditor);

    ui.workDesc.addEventListener('keydown', function (event) {
        if (event.key === 'Enter' && (event.ctrlKey || event.metaKey)) {
            event.preventDefault();
            saveWorkEditor();
        }
    });

    byId('gaWorkDelete').addEventListener('click', function () {
        if (!editor.work) {
            return;
        }

        deleteWorks([String(editor.work.id)]).then(function (deleted) {
            if (deleted) {
                closeModal(ui.workModal);
            }
        });
    });

    // ---------- Загрузка фото ----------

    function isImageFile(file) {
        return /\.(jpe?g|png|heic|heif)$/i.test(file.name) || /^image\/(jpeg|png|heic|heif)$/i.test(file.type);
    }

    // Большие фото с телефона уменьшаем до 2000px по длинной стороне; HEIC переводим в JPG (если браузер его открывает).
    function prepareImage(file) {
        var isHeic = /\.(heic|heif)$/i.test(file.name) || /heic|heif/i.test(file.type);

        if (!isHeic && file.size < RESIZE_FROM_BYTES) {
            return Promise.resolve(file);
        }

        return new Promise(function (resolve, reject) {
            var url = URL.createObjectURL(file);
            var image = new Image();

            image.onload = function () {
                var scale = Math.min(1, RESIZE_MAX_SIDE / Math.max(image.naturalWidth, image.naturalHeight));
                var canvas = document.createElement('canvas');

                canvas.width = Math.round(image.naturalWidth * scale);
                canvas.height = Math.round(image.naturalHeight * scale);

                var context = canvas.getContext('2d');
                context.fillStyle = '#fff';
                context.fillRect(0, 0, canvas.width, canvas.height);
                context.drawImage(image, 0, 0, canvas.width, canvas.height);
                URL.revokeObjectURL(url);

                canvas.toBlob(function (blob) {
                    if (!blob) {
                        isHeic ? reject(new Error('не удалось преобразовать HEIC')) : resolve(file);
                        return;
                    }

                    var name = file.name.replace(/\.[^.]+$/, '') + '.jpg';
                    resolve(new File([blob], name, {type: 'image/jpeg'}));
                }, 'image/jpeg', 0.86);
            };

            image.onerror = function () {
                URL.revokeObjectURL(url);

                if (isHeic) {
                    reject(new Error('браузер не открывает HEIC — сохраните фото как JPG'));
                } else {
                    resolve(file);
                }
            };

            image.src = url;
        });
    }

    function uploadFiles(fileList) {
        var category = currentCategory();

        if (!category) {
            notify('warning', 'Сначала выберите категорию слева');
            return;
        }

        var files = Array.prototype.slice.call(fileList || []);
        var accepted = files.filter(isImageFile);

        if (accepted.length < files.length) {
            notify('warning', 'Пропущено файлов (нужны JPG, PNG или HEIC): ' + (files.length - accepted.length));
        }

        if (!accepted.length) {
            return;
        }

        accepted.forEach(function (file) {
            uploadQueue.push({file: file, categoryId: String(category.id)});
        });
        uploadStats.total += accepted.length;

        if (state.uploading) {
            renderUploadProgress();
        } else {
            runUploadQueue();
        }
    }

    function runUploadQueue() {
        var item = uploadQueue.shift();

        if (!item) {
            finishUploads();
            return;
        }

        state.uploading = true;
        renderUploadProgress(item.file.name);

        prepareImage(item.file).then(function (file) {
            var form = new FormData();
            form.append('category_id', item.categoryId);
            form.append('image', file, file.name);

            return api('uploadWork.php', form);
        }).then(function (json) {
            uploadStats.done++;

            if (json.data && (state.currentId === item.categoryId || state.currentId === null)) {
                state.works.unshift(json.data);
                renderGrid();
            }
        }).catch(function (error) {
            uploadStats.failed++;
            notify('error', item.file.name + ': ' + error.message);
        }).then(runUploadQueue);
    }

    function renderUploadProgress(fileName) {
        var processed = uploadStats.done + uploadStats.failed;

        ui.upload.hidden = false;
        ui.uploadText.textContent = 'Загрузка ' + Math.min(processed + 1, uploadStats.total) + ' из ' + uploadStats.total +
            (fileName ? ' — ' + fileName : '');
        ui.uploadBar.style.width = Math.round(processed / Math.max(uploadStats.total, 1) * 100) + '%';
    }

    function finishUploads() {
        state.uploading = false;
        ui.upload.hidden = true;

        if (uploadStats.done) {
            notify('success', 'Загружено: ' + worksLabel(uploadStats.done) +
                (uploadStats.failed ? ', с ошибкой: ' + uploadStats.failed : ''));
        }

        uploadStats = {total: 0, done: 0, failed: 0};
        loadCategories();
    }

    function isFileDrag(event) {
        var types = event.dataTransfer && event.dataTransfer.types;
        return !!types && Array.prototype.indexOf.call(types, 'Files') !== -1;
    }

    function clearDropTargets() {
        root.querySelectorAll('.ga-cat.is-drop-target').forEach(function (item) {
            item.classList.remove('is-drop-target');
        });
    }

    // ---------- События ----------

    // Выбор категории
    ui.side.addEventListener('click', function (event) {
        var item = event.target.closest('.ga-cat');

        // Клик, завершающий перетаскивание, — не выбор категории
        if (item && Date.now() - lastSortEndAt > 250) {
            selectCategory(item.dataset.id);
        }
    });

    ui.catList.addEventListener('keydown', function (event) {
        var item = event.target.closest('.ga-cat');

        if (item && (event.key === 'Enter' || event.key === ' ')) {
            event.preventDefault();
            selectCategory(item.dataset.id);
        }
    });

    // Новая категория
    ui.newCatToggle.addEventListener('click', function () {
        ui.newCatForm.hidden = !ui.newCatForm.hidden;

        if (!ui.newCatForm.hidden) {
            ui.newCatName.focus();
        }
    });
    ui.newCatCancel.addEventListener('click', resetNewCategoryForm);
    ui.newCatForm.addEventListener('submit', createCategory);
    ui.newCatFile.addEventListener('change', function () {
        ui.newCatFileLabel.textContent = ui.newCatFile.files.length ? ui.newCatFile.files[0].name : NEW_CAT_FILE_LABEL;
    });
    ui.newCatFileLabel.textContent = NEW_CAT_FILE_LABEL;

    // Шапка категории: название, обложка, видимость, удаление
    ui.head.addEventListener('keydown', function (event) {
        if (event.target.id !== 'gaNameInput') {
            return;
        }

        if (event.key === 'Enter') {
            event.preventDefault();
            event.target.blur();
        } else if (event.key === 'Escape') {
            var category = currentCategory();
            event.target.value = category ? category.name : event.target.value;
            event.target.blur();
        }
    });

    ui.head.addEventListener('focusout', function (event) {
        if (event.target.id === 'gaNameInput') {
            commitName(event.target);
        }
    });

    ui.head.addEventListener('change', function (event) {
        var category = currentCategory();

        if (!category) {
            return;
        }

        if (event.target.id === 'gaVisible') {
            var visible = event.target.checked;
            var label = ui.head.querySelector('.ga-switch-label');

            if (label) {
                label.textContent = visible ? 'Показывается на сайте' : 'Скрыта на сайте';
            }

            saveCategory(category, {is_visible: visible}).then(function () {
                notify('success', visible ? 'Категория показывается на сайте' : 'Категория скрыта на сайте');
            }).catch(function (error) {
                event.target.checked = !visible;
                showError(error);
            });
        }

        if (event.target.id === 'gaCoverInput' && event.target.files.length) {
            var file = event.target.files[0];
            var preview = byId('gaCoverImg');

            if (preview) {
                preview.src = URL.createObjectURL(file);
            }

            saveCategory(category, {}, file).then(function () {
                notify('success', 'Обложка обновлена');
            }).catch(showError);
        }
    });

    ui.head.addEventListener('click', function (event) {
        if (event.target.closest('#gaDeleteCat')) {
            openDeleteCategory();
        } else if (event.target.closest('#gaRename')) {
            var input = byId('gaNameInput');
            input.focus();
            input.select();
        }
    });

    ui.deleteModal.addEventListener('change', function (event) {
        if (event.target.name === 'gaDeleteMode') {
            syncDeleteControls();
        }
    });
    byId('gaDeleteConfirm').addEventListener('click', confirmDeleteCategory);

    // Работы: клик по фото — редактор, кружок (или клик в режиме выбора) — выделение
    ui.grid.addEventListener('click', function (event) {
        var card = event.target.closest('.ga-work[data-id]');

        if (!card) {
            return;
        }

        var action = event.target.closest('[data-act]');

        if (action) {
            if (action.dataset.act === 'delete') {
                deleteWorks([card.dataset.id]);
            } else if (action.dataset.act === 'edit') {
                openWorkEditor(card.dataset.id);
            }
            return;
        }

        if (event.target.closest('a, textarea')) {
            return;
        }

        if (event.target.closest('.ga-work-check') || state.selected.size || event.shiftKey || event.ctrlKey || event.metaKey) {
            toggleSelect(card.dataset.id, event.shiftKey);
        } else if (event.target.closest('.ga-work-img')) {
            openWorkEditor(card.dataset.id);
        }
    });

    ui.grid.addEventListener('focusout', function (event) {
        if (event.target.classList.contains('ga-desc')) {
            saveDescription(event.target);
        }
    });

    ui.selectAll.addEventListener('change', function () {
        filteredWorks().forEach(function (work) {
            if (ui.selectAll.checked) {
                state.selected.add(String(work.id));
            } else {
                state.selected.delete(String(work.id));
            }
        });
        renderSelection();
    });

    ui.search.addEventListener('input', function () {
        state.search = ui.search.value;
        renderGrid();
    });

    byId('gaSelMove').addEventListener('click', function () {
        if (!ui.selTarget.value) {
            ui.selTarget.focus();
            notify('warning', 'Выберите категорию, куда перенести');
            return;
        }

        moveWorks(Array.from(state.selected), ui.selTarget.value);
    });

    byId('gaSelDelete').addEventListener('click', function () {
        deleteWorks(Array.from(state.selected));
    });

    byId('gaSelClear').addEventListener('click', function () {
        state.selected.clear();
        renderSelection();
    });

    document.addEventListener('keydown', function (event) {
        var view = root.closest('[data-view]');

        if (AdminUI.hasOpenModal() || (view && view.hidden)) {
            return;
        }
        if (event.target.closest('input, textarea, select')) {
            return;
        }

        if (event.key === 'Escape' && state.selected.size) {
            state.selected.clear();
            renderSelection();
        } else if (event.key === 'Delete' && state.selected.size) {
            deleteWorks(Array.from(state.selected));
        }
    });

    // Перетаскивание работ на категорию слева
    ui.grid.addEventListener('dragstart', function (event) {
        var handle = event.target.closest && event.target.closest('.ga-work-img');
        var card = handle && handle.closest('.ga-work[data-id]');

        if (!card) {
            return;
        }

        var id = card.dataset.id;

        draggingWorks = state.selected.has(id) ? Array.from(state.selected) : [id];
        event.dataTransfer.effectAllowed = 'move';
        event.dataTransfer.setData('text/plain', worksLabel(draggingWorks.length));
        root.classList.add('is-dragging-works');
    });

    ui.grid.addEventListener('dragend', function () {
        draggingWorks = null;
        root.classList.remove('is-dragging-works');
        clearDropTargets();
    });

    ui.side.addEventListener('dragover', function (event) {
        if (!draggingWorks) {
            return;
        }

        var item = event.target.closest('.ga-cat[data-id]');
        clearDropTargets();

        if (!item || !item.dataset.id || item.dataset.id === state.currentId) {
            return;
        }

        event.preventDefault();
        event.dataTransfer.dropEffect = 'move';
        item.classList.add('is-drop-target');
    });

    ui.side.addEventListener('dragleave', function (event) {
        if (!ui.side.contains(event.relatedTarget)) {
            clearDropTargets();
        }
    });

    ui.side.addEventListener('drop', function (event) {
        var item = event.target.closest('.ga-cat[data-id]');

        if (!draggingWorks || !item || !item.dataset.id) {
            return;
        }

        event.preventDefault();
        var ids = draggingWorks;
        clearDropTargets();
        moveWorks(ids, item.dataset.id);
    });

    // Загрузка: кнопка и перетаскивание файлов в сетку
    ui.uploadBtn.addEventListener('click', function () {
        ui.fileInput.click();
    });

    ui.fileInput.addEventListener('change', function () {
        uploadFiles(ui.fileInput.files);
        ui.fileInput.value = '';
    });

    ui.drop.addEventListener('dragenter', function (event) {
        if (!isFileDrag(event)) {
            return;
        }

        event.preventDefault();
        fileDragDepth++;
        ui.drop.classList.add('is-over');
    });

    ui.drop.addEventListener('dragover', function (event) {
        if (!isFileDrag(event)) {
            return;
        }

        event.preventDefault();
        event.dataTransfer.dropEffect = currentCategory() ? 'copy' : 'none';
    });

    ui.drop.addEventListener('dragleave', function (event) {
        if (!isFileDrag(event)) {
            return;
        }

        fileDragDepth = Math.max(0, fileDragDepth - 1);

        if (!fileDragDepth) {
            ui.drop.classList.remove('is-over');
        }
    });

    ui.drop.addEventListener('drop', function (event) {
        if (!isFileDrag(event)) {
            return;
        }

        event.preventDefault();
        fileDragDepth = 0;
        ui.drop.classList.remove('is-over');
        uploadFiles(event.dataTransfer.files);
    });

    // Файл, брошенный мимо сетки, не должен открываться в браузере вместо админки
    root.addEventListener('dragover', function (event) {
        if (isFileDrag(event)) {
            event.preventDefault();
        }
    });
    root.addEventListener('drop', function (event) {
        if (isFileDrag(event)) {
            event.preventDefault();
        }
    });

    window.GalleryAdmin = {refresh: refresh};

    renderSidebar();
    renderHead();
    renderSelectTargets();
    renderToolbar();
})();
