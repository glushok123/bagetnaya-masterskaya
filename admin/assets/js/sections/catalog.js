/* Каталог багета и паспарту: таблица с правкой прямо в строке, фильтры, сортировка, добавление, удаление. */
(function () {
    'use strict';

    var UI = window.AdminUI;
    var API = '/admin/request/api/catalog.php';
    var PAGE = 60;

    var TYPES = [
        {key: 'wood', label: 'Дерево'},
        {key: 'plast', label: 'Пластик'},
        {key: 'alum', label: 'Алюминий'},
        {key: 'pasp', label: 'Паспарту'}
    ];
    var TYPE_LABEL = {wood: 'Дерево', plast: 'Пластик', alum: 'Алюминий', pasp: 'Паспарту'};
    var SUPPLIERS = {neoart: 'Neoart', interquadrum: 'Interquadrum', lion: 'Lion', '': 'Вручную'};

    var FILTERS = [
        {key: 'all', label: 'Все'},
        {key: 'stock', label: 'В наличии', test: function (item) { return item.storage > 0; }},
        {key: 'out', label: 'Нет в наличии', test: function (item) { return item.storage <= 0; }},
        {key: 'noprice', label: 'Без цены', test: function (item) { return item.price <= 0; }},
        {key: 'fixed', label: 'Фикс. цена', test: function (item) { return item.fixed_price; }}
    ];

    var state = {
        type: 'wood',
        cache: {},
        counts: {},
        search: '',
        filter: 'all',
        supplier: 'any',
        sort: {key: 'id', dir: -1},
        limit: PAGE,
        selected: new Set(),
        editingId: null,
        loading: false,
        highlightId: null
    };

    var view;
    var el = {};
    var requestToken = 0;

    function items() {
        return state.cache[state.type] || [];
    }

    function isPasp() {
        return state.type === 'pasp';
    }

    function findItem(id) {
        return items().find(function (item) {
            return String(item.id) === String(id);
        }) || null;
    }

    function filtered() {
        var query = state.search.trim().toLowerCase();
        var filter = FILTERS.find(function (entry) {
            return entry.key === state.filter;
        });

        var list = items().filter(function (item) {
            if (filter && filter.test && !filter.test(item)) {
                return false;
            }
            if (state.supplier !== 'any' && item.company !== state.supplier) {
                return false;
            }
            if (!query) {
                return true;
            }

            return (item.publicvendor + ' ' + item.vendor + ' ' + item.color + ' ' + item.name).toLowerCase().indexOf(query) !== -1;
        });

        var key = state.sort.key;
        var dir = state.sort.dir;

        return list.sort(function (a, b) {
            var x = a[key];
            var y = b[key];

            if (key === 'publicvendor' || key === 'id') {
                x = parseInt(x, 10) || 0;
                y = parseInt(y, 10) || 0;
            }

            if (x === y) {
                return 0;
            }
            if (x === null || x === undefined || x === '') {
                return 1;
            }
            if (y === null || y === undefined || y === '') {
                return -1;
            }

            return (x > y ? 1 : -1) * dir;
        });
    }

    // ---------- Разметка ----------

    function mount(section) {
        view = section;
        view.innerHTML = UI.pageHead({
            eyebrow: 'Каталог',
            title: 'Багет и паспарту',
            sub: 'Позиции конструктора на сайте. Цены и остатки поставщиков обновляются автоматически.',
            subId: 'catSub',
            actions: '<button type="button" class="ga-btn ga-btn--ink" data-role="add">' + UI.icon('plus') + 'Добавить позицию</button>'
        }) +
            '<div class="cat-types"><div class="ga-seg" data-role="types"></div></div>' +
            '<div class="ga-toolbar">' +
            '<div class="ga-toolbar-left">' +
            '<div class="ga-chips" data-role="filters"></div>' +
            '<select class="ga-select cat-supplier" data-role="supplier" aria-label="Поставщик"></select>' +
            '</div>' +
            '<label class="ga-search">' + UI.icon('search') +
            '<input type="search" data-role="search" placeholder="Артикул, артикул поставщика, цвет" aria-label="Поиск по каталогу"></label>' +
            '</div>' +
            '<div class="ga-panel"><div class="ga-table-wrap"><table class="ga-table ga-table--cards cat-table">' +
            '<thead data-role="head"></thead><tbody data-role="rows"></tbody></table></div>' +
            '<div class="ga-table-foot" data-role="more" hidden></div></div>' +
            '<div class="ga-selbar" data-role="selbar" hidden>' +
            '<span class="ga-selbar-count"><b data-role="selcount">0</b> выбрано</span>' +
            '<button type="button" class="ga-btn ga-btn--danger-dark ga-btn--sm" data-bulk="delete">Удалить</button>' +
            '<button type="button" class="ga-icon-btn ga-icon-btn--dark" data-bulk="clear" title="Снять выделение" aria-label="Снять выделение">' + UI.icon('x') + '</button>' +
            '</div>';

        ['types', 'filters', 'supplier', 'search', 'head', 'rows', 'more', 'selbar', 'selcount'].forEach(function (role) {
            el[role] = view.querySelector('[data-role="' + role + '"]');
        });

        bind();
    }

    function renderTypes() {
        el.types.innerHTML = TYPES.map(function (type) {
            var count = state.counts[type.key];

            return '<button type="button" class="ga-seg-btn' + (state.type === type.key ? ' is-active' : '') + '" data-type="' + type.key + '">' +
                type.label + (count !== undefined ? ' <span class="ga-seg-count">' + count + '</span>' : '') + '</button>';
        }).join('');

        var total = Object.keys(state.counts).reduce(function (sum, key) {
            return sum + state.counts[key];
        }, 0);
        var sub = document.getElementById('catSub');

        if (sub && total) {
            sub.textContent = total.toLocaleString('ru-RU') + ' ' + UI.plural(total, 'позиция', 'позиции', 'позиций') +
                ' в конструкторе. Цены и остатки поставщиков обновляются автоматически.';
        }
    }

    function renderFilters() {
        var list = items();

        el.filters.innerHTML = FILTERS.map(function (filter) {
            var count = filter.test ? list.filter(filter.test).length : list.length;

            return '<button type="button" class="ga-chip-btn' + (state.filter === filter.key ? ' is-active' : '') + '" data-filter="' + filter.key + '">' +
                filter.label + ' <span class="ga-seg-count">' + count + '</span></button>';
        }).join('');

        var companies = {};

        list.forEach(function (item) {
            companies[item.company] = (companies[item.company] || 0) + 1;
        });

        if (state.supplier !== 'any' && !companies[state.supplier]) {
            state.supplier = 'any';
        }

        el.supplier.innerHTML = '<option value="any">Все поставщики</option>' + Object.keys(companies).sort().map(function (company) {
            return '<option value="' + UI.esc(company) + '"' + (state.supplier === company ? ' selected' : '') + '>' +
                UI.esc(SUPPLIERS[company] || company) + ' · ' + companies[company] + '</option>';
        }).join('');
    }

    function sortHead(key, label, numeric) {
        var active = state.sort.key === key;

        return '<th class="is-sortable' + (numeric ? ' t-num' : '') + '" data-sort="' + key + '">' + label +
            (active ? '<span class="ga-sort">' + (state.sort.dir > 0 ? '↑' : '↓') + '</span>' : '') + '</th>';
    }

    function renderHead() {
        el.head.innerHTML = '<tr>' +
            '<th class="t-check"><input type="checkbox" class="ga-checkbox" data-role="all" aria-label="Выбрать все"></th>' +
            '<th>Фото</th>' +
            sortHead('publicvendor', 'Артикул') +
            sortHead('date_update', 'Поставщик') +
            (isPasp() ? '' : sortHead('width', 'Ширина', true) + sortHead('widthwithout', 'Без четв.', true)) +
            sortHead('price', 'Цена', true) +
            sortHead('storage', 'Остаток', true) +
            '<th>Цвет</th>' +
            '<th class="t-actions"></th>' +
            '</tr>';

        el.all = el.head.querySelector('[data-role="all"]');
    }

    function swatches(item) {
        return item.colors.length ? '<span class="cat-swatches">' + item.colors.map(function (color) {
            return '<span style="background:' + UI.esc(color) + '"></span>';
        }).join('') + '</span>' : '';
    }

    function viewRow(item) {
        var id = String(item.id);
        var classes = [];

        if (state.selected.has(id)) {
            classes.push('is-selected');
        }
        if (state.highlightId === id) {
            classes.push('is-fresh');
        }

        return '<tr data-id="' + id + '"' + (classes.length ? ' class="' + classes.join(' ') + '"' : '') + '>' +
            '<td class="t-check"><input type="checkbox" class="ga-checkbox" data-role="pick"' + (state.selected.has(id) ? ' checked' : '') + ' aria-label="Выбрать"></td>' +
            '<td class="cat-photo-cell"><button type="button" class="cat-photo" data-role="preview" title="Посмотреть картинки">' +
            (item.listimg ? '<img src="' + UI.esc(item.listimg) + '" alt="" loading="lazy" onerror="this.remove()">' : '') + '</button></td>' +
            '<td data-label="Артикул"><div class="ga-strong ga-num">' + UI.esc(item.publicvendor) + '</div>' +
            '<div class="ga-muted cat-vendor">' + UI.esc(item.vendor || '—') + '</div></td>' +
            '<td data-label="Поставщик"><div>' + UI.esc(SUPPLIERS[item.company] || item.company) + '</div>' +
            (item.date_update ? '<div class="ga-muted">обн. ' + UI.esc(UI.date(item.date_update, false)) + '</div>' : '') + '</td>' +
            (isPasp() ? '' :
                '<td class="t-num" data-label="Ширина">' + item.width + ' <span class="ga-muted">мм</span></td>' +
                '<td class="t-num" data-label="Без четверти">' + item.widthwithout + ' <span class="ga-muted">мм</span></td>') +
            '<td class="t-num" data-label="Цена"><span class="ga-strong' + (item.price <= 0 ? ' cat-bad' : '') + '">' + (item.price > 0 ? UI.money(item.price) : 'нет цены') + '</span>' +
            (item.fixed_price ? '<div><span class="cat-fixed" title="Цена не меняется при обновлении от поставщика">фикс.</span></div>' : '') + '</td>' +
            '<td class="t-num" data-label="Остаток">' + (item.storage > 0 ? item.storage : '<span class="cat-bad">нет</span>') + '</td>' +
            '<td data-label="Цвет"><div class="cat-color">' + swatches(item) + '<span>' + UI.esc(item.color || '—') + '</span></div></td>' +
            '<td class="t-actions"><div class="ga-row-actions">' +
            '<button type="button" class="ga-icon-btn" data-role="edit" title="Изменить" aria-label="Изменить">' + UI.icon('edit') + '</button>' +
            '<button type="button" class="ga-icon-btn ga-icon-btn--danger" data-role="delete" title="Удалить" aria-label="Удалить">' + UI.icon('trash') + '</button>' +
            '</div></td>' +
            '</tr>';
    }

    function numberInput(name, value, label) {
        return '<input type="number" min="0" step="1" class="ga-input ga-input--sm cat-edit-num" name="' + name + '" value="' + UI.esc(value) + '" aria-label="' + label + '">';
    }

    function editRow(item) {
        return '<tr data-id="' + item.id + '" class="is-editing">' +
            '<td class="t-check"></td>' +
            '<td class="cat-photo-cell"><span class="cat-photo">' + (item.listimg ? '<img src="' + UI.esc(item.listimg) + '" alt="">' : '') + '</span></td>' +
            '<td data-label="Артикул"><div class="ga-strong ga-num">' + UI.esc(item.publicvendor) + '</div><div class="ga-muted cat-vendor">' + UI.esc(item.vendor || '—') + '</div></td>' +
            '<td data-label="Поставщик">' + UI.esc(SUPPLIERS[item.company] || item.company) + '</td>' +
            (isPasp() ? '' :
                '<td class="t-num" data-label="Ширина">' + numberInput('width', item.width, 'Ширина, мм') + '</td>' +
                '<td class="t-num" data-label="Без четверти">' + numberInput('widthwithout', item.widthwithout, 'Без четверти, мм') + '</td>') +
            '<td class="t-num" data-label="Цена">' + numberInput('price', item.price, 'Цена, ₽') +
            '<label class="ga-switch ga-switch--sm cat-edit-fixed" title="Фиксированная цена — не меняется при обновлении от поставщика">' +
            '<input type="checkbox" name="fixed_price"' + (item.fixed_price ? ' checked' : '') + '><span class="ga-switch-track"></span><span class="ga-switch-label">фикс.</span></label></td>' +
            '<td class="t-num" data-label="Остаток">' + numberInput('storage', item.storage, 'Остаток') + '</td>' +
            '<td data-label="Цвет"><input type="text" class="ga-input ga-input--sm" name="color" value="' + UI.esc(item.color) + '" placeholder="Цвет" aria-label="Цвет"></td>' +
            '<td class="t-actions"><div class="ga-row-actions">' +
            '<button type="button" class="ga-btn ga-btn--ink ga-btn--sm" data-role="save">Сохранить</button>' +
            '<button type="button" class="ga-icon-btn" data-role="cancel" title="Отменить (Esc)" aria-label="Отменить">' + UI.icon('x') + '</button>' +
            '</div></td>' +
            '</tr>';
    }

    function renderRows() {
        var columns = isPasp() ? 8 : 10;

        if (state.loading && !items().length) {
            el.rows.innerHTML = UI.skeletonRows(columns, 10);
            el.more.hidden = true;
            return;
        }

        var list = filtered();

        if (!list.length) {
            el.rows.innerHTML = '<tr class="ld-empty"><td colspan="' + columns + '">' + (items().length
                ? UI.emptyState('Ничего не найдено', 'Измените поиск или фильтр')
                : UI.emptyState('Здесь пока пусто', 'Добавьте первую позицию кнопкой «Добавить позицию»')) + '</td></tr>';
            el.more.hidden = true;
        } else {
            // Строка в правке остаётся видимой, даже если «уехала» за лимит
            var shown = list.slice(0, state.limit);

            el.rows.innerHTML = shown.map(function (item) {
                return String(item.id) === state.editingId ? editRow(item) : viewRow(item);
            }).join('');

            var rest = list.length - shown.length;
            el.more.hidden = rest <= 0;
            el.more.innerHTML = rest > 0
                ? '<button type="button" class="ga-btn ga-btn--ghost" data-role="more-btn">Показать ещё ' + Math.min(rest, PAGE) + ' <span class="ga-muted">из ' + rest + '</span></button>'
                : '';
        }

        renderSelection();
    }

    function renderSelection() {
        var visible = filtered().slice(0, state.limit).map(function (item) {
            return String(item.id);
        });
        var picked = visible.filter(function (id) {
            return state.selected.has(id);
        }).length;

        el.selbar.hidden = state.selected.size === 0;
        el.selcount.textContent = state.selected.size;

        if (el.all) {
            el.all.checked = visible.length > 0 && picked === visible.length;
            el.all.indeterminate = picked > 0 && picked < visible.length;
            el.all.disabled = visible.length === 0;
        }

        el.rows.querySelectorAll('tr[data-id]:not(.is-editing)').forEach(function (tr) {
            var selected = state.selected.has(tr.dataset.id);
            var pick = tr.querySelector('[data-role="pick"]');

            tr.classList.toggle('is-selected', selected);

            if (pick) {
                pick.checked = selected;
            }
        });
    }

    function render() {
        renderTypes();
        renderFilters();
        renderHead();
        renderRows();
    }

    // ---------- Данные ----------

    function load(type, force) {
        var token = ++requestToken;

        if (state.cache[type] && !force) {
            render();
        } else {
            state.loading = true;
            render();
        }

        return UI.api(API, {action: 'list', type: type}).then(function (json) {
            if (token !== requestToken) {
                return;
            }

            state.cache[type] = json.data || [];
            state.counts = json.counts || state.counts;
            state.loading = false;

            // Не перерисовываем под руками, если в этот момент правят строку
            if (!state.editingId) {
                render();
            } else {
                renderTypes();
            }
        }).catch(function (error) {
            state.loading = false;
            render();
            UI.showError(error);
        });
    }

    function selectType(type) {
        if (type === state.type) {
            return;
        }

        state.type = type;
        state.selected.clear();
        state.editingId = null;
        state.filter = 'all';
        state.supplier = 'any';
        state.limit = PAGE;
        UI.setParams([type]);
        load(type);
    }

    // ---------- Правка в строке ----------

    function startEdit(id) {
        if (state.editingId && state.editingId !== String(id)) {
            cancelEdit();
        }

        state.editingId = String(id);
        renderRows();

        var input = el.rows.querySelector('tr.is-editing input[name="price"]');

        if (input) {
            input.focus();
            input.select();
        }
    }

    function cancelEdit() {
        state.editingId = null;
        renderRows();
    }

    function saveEdit() {
        var tr = el.rows.querySelector('tr.is-editing');
        var item = tr && findItem(tr.dataset.id);

        if (!item) {
            return;
        }

        var field = function (name) {
            var input = tr.querySelector('[name="' + name + '"]');
            return input ? input.value.trim() : '';
        };

        var payload = {
            action: 'save',
            id: item.id,
            price: field('price'),
            width: isPasp() ? item.width : field('width'),
            widthwithout: isPasp() ? item.widthwithout : field('widthwithout'),
            storage: field('storage'),
            color: field('color'),
            fixed_price: tr.querySelector('[name="fixed_price"]').checked ? 1 : 0
        };

        var bad = ['price', 'width', 'widthwithout', 'storage'].filter(function (key) {
            return !/^\d+$/.test(String(payload[key]));
        });

        tr.querySelectorAll('.is-invalid').forEach(function (input) {
            input.classList.remove('is-invalid');
        });

        if (bad.length) {
            bad.forEach(function (key) {
                var input = tr.querySelector('[name="' + key + '"]');

                if (input) {
                    input.classList.add('is-invalid');
                }
            });
            UI.notify('warning', 'Числа — целые, не меньше нуля');
            return;
        }

        var button = tr.querySelector('[data-role="save"]');
        button.disabled = true;

        UI.api(API, payload).then(function (json) {
            Object.assign(item, json.data);
            state.editingId = null;
            state.highlightId = String(item.id);
            renderFilters();
            renderRows();
            UI.notify('success', 'Сохранено: артикул ' + item.publicvendor);
        }).catch(function (error) {
            button.disabled = false;
            UI.showError(error);
        });
    }

    // ---------- Удаление ----------

    function remove(ids) {
        var single = ids.length === 1;
        var item = single ? findItem(ids[0]) : null;

        UI.confirm({
            title: single ? 'Удалить позицию?' : 'Удалить ' + ids.length + ' ' + UI.plural(ids.length, 'позицию', 'позиции', 'позиций') + '?',
            html: single && item
                ? 'Артикул <b>' + UI.esc(item.publicvendor) + '</b> пропадёт из конструктора на сайте, картинки будут удалены <b>безвозвратно</b>.'
                : 'Позиции пропадут из конструктора на сайте, их картинки будут удалены <b>безвозвратно</b>.',
            ok: single ? 'Удалить позицию' : 'Удалить ' + ids.length
        }).then(function (ok) {
            if (!ok) {
                return;
            }

            UI.api(API, {action: 'delete', ids: ids.join(',')}).then(function (json) {
                var set = new Set(ids.map(String));

                state.cache[state.type] = items().filter(function (entry) {
                    return !set.has(String(entry.id));
                });
                state.counts[state.type] = Math.max(0, (state.counts[state.type] || 0) - (json.deleted || ids.length));
                set.forEach(function (id) {
                    state.selected.delete(id);
                });

                if (set.has(state.editingId)) {
                    state.editingId = null;
                }

                render();
                UI.notify('success', single ? 'Позиция удалена' : 'Удалено позиций: ' + (json.deleted || ids.length));
            }).catch(UI.showError);
        });
    }

    // ---------- Просмотр картинок ----------

    function preview(item) {
        var dialog = UI.dialog({
            size: 'form',
            html: '<div class="ga-eyebrow">' + UI.esc(TYPE_LABEL[item.type]) + ' · ' + UI.esc(SUPPLIERS[item.company] || item.company) + '</div>' +
                '<h3 class="ga-modal-title">Артикул ' + UI.esc(item.publicvendor) + '</h3>' +
                '<div class="ga-muted">Артикул поставщика: ' + UI.esc(item.vendor || '—') + '</div>' +
                '<div class="cat-preview">' +
                '<figure><div class="cat-preview-img">' + (item.listimg ? '<img src="' + UI.esc(item.listimg) + '" alt="">' : '') + '</div><figcaption>В каталоге</figcaption></figure>' +
                '<figure><div class="cat-preview-strip"' + (item.imgconst ? ' style="background-image:url(\'' + UI.esc(item.imgconst) + '\')"' : '') + '></div><figcaption>Профиль для конструктора</figcaption></figure>' +
                '</div>' +
                '<dl class="cat-facts">' +
                (isPasp() ? '' : '<div><dt>Ширина</dt><dd>' + item.width + ' мм</dd></div><div><dt>Без четверти</dt><dd>' + item.widthwithout + ' мм</dd></div>') +
                '<div><dt>Цена</dt><dd>' + (item.price > 0 ? UI.money(item.price) : 'нет') + (item.fixed_price ? ' · фикс.' : '') + '</dd></div>' +
                '<div><dt>Остаток</dt><dd>' + item.storage + '</dd></div>' +
                '<div><dt>Цвет</dt><dd>' + UI.esc(item.color || '—') + '</dd></div>' +
                '</dl>' +
                '<div class="ga-modal-actions ga-modal-actions--split">' +
                '<button type="button" class="ga-btn ga-btn--danger-ghost" data-role="p-delete">' + UI.icon('trash') + 'Удалить</button>' +
                '<div class="ga-modal-actions-group"><button type="button" class="ga-btn ga-btn--ghost" data-ga-close>Закрыть</button>' +
                '<button type="button" class="ga-btn ga-btn--ink" data-role="p-edit">' + UI.icon('edit') + 'Изменить</button></div>' +
                '</div>'
        });

        dialog.card.querySelector('[data-role="p-edit"]').addEventListener('click', function () {
            dialog.close();
            startEdit(item.id);
        });
        dialog.card.querySelector('[data-role="p-delete"]').addEventListener('click', function () {
            dialog.close();
            remove([String(item.id)]);
        });
    }

    // ---------- Добавление ----------

    function openCreate() {
        var type = state.type;
        var dialog = UI.dialog({
            size: 'form',
            focus: '[name="vendor"]',
            html: '<div class="ga-eyebrow">Каталог</div>' +
                '<h3 class="ga-modal-title">Новая позиция</h3>' +
                '<p class="ga-modal-text">Появится в конструкторе на сайте сразу после сохранения. Публичный артикул присвоится автоматически.</p>' +
                '<form class="ga-modal-body" data-role="form" novalidate>' +
                '<div class="ga-form-grid">' +
                '<div class="ga-field ga-span-all"><span class="ga-field-label">Тип</span><div class="ga-seg" data-role="c-type">' +
                TYPES.map(function (entry) {
                    return '<button type="button" class="ga-seg-btn' + (entry.key === type ? ' is-active' : '') + '" data-type="' + entry.key + '">' + entry.label + '</button>';
                }).join('') + '</div></div>' +
                '<label class="ga-field"><span class="ga-field-label">Артикул поставщика</span><input class="ga-input" name="vendor" placeholder="Необязательно"></label>' +
                '<label class="ga-field"><span class="ga-field-label">Цвет</span><input class="ga-input" name="color" placeholder="Например: золото"></label>' +
                '<label class="ga-field" data-role="c-width"><span class="ga-field-label">Ширина</span><span class="ga-input-group"><input class="ga-input" type="number" min="0" name="width"><span class="ga-input-suffix">мм</span></span></label>' +
                '<label class="ga-field" data-role="c-widthwithout"><span class="ga-field-label">Без четверти</span><span class="ga-input-group"><input class="ga-input" type="number" min="0" name="widthwithout"><span class="ga-input-suffix">мм</span></span></label>' +
                '<label class="ga-field"><span class="ga-field-label">Цена</span><span class="ga-input-group"><input class="ga-input" type="number" min="0" name="price"><span class="ga-input-suffix">₽</span></span></label>' +
                '<label class="ga-field"><span class="ga-field-label">Остаток</span><input class="ga-input" type="number" min="0" name="storage" value="30"></label>' +
                '<label class="ga-switch ga-span-all"><input type="checkbox" name="fixed_price" value="1"><span class="ga-switch-track"></span>' +
                '<span class="ga-switch-label">Фиксированная цена — не менять при обновлении от поставщика</span></label>' +
                '<label class="ga-drop-file"><input type="file" name="listimg" accept=".jpg,.jpeg,image/jpeg">' + UI.icon('picture') +
                '<span class="ga-drop-file-text">Картинка для каталога (JPG)</span></label>' +
                '<label class="ga-drop-file"><input type="file" name="imgconst" accept=".jpg,.jpeg,image/jpeg">' + UI.icon('frame') +
                '<span class="ga-drop-file-text">Профиль для конструктора (JPG)</span></label>' +
                '</div>' +
                '<div class="ga-modal-actions"><button type="button" class="ga-btn ga-btn--ghost" data-ga-close>Отмена</button>' +
                '<button type="submit" class="ga-btn ga-btn--ink" data-role="c-save">Добавить в каталог</button></div>' +
                '</form>'
        });

        var form = dialog.card.querySelector('[data-role="form"]');
        var typeSeg = dialog.card.querySelector('[data-role="c-type"]');

        function syncType() {
            var pasp = type === 'pasp';
            dialog.card.querySelector('[data-role="c-width"]').hidden = pasp;
            dialog.card.querySelector('[data-role="c-widthwithout"]').hidden = pasp;
        }

        typeSeg.addEventListener('click', function (event) {
            var button = event.target.closest('[data-type]');

            if (button) {
                type = button.dataset.type;
                typeSeg.querySelectorAll('[data-type]').forEach(function (entry) {
                    entry.classList.toggle('is-active', entry === button);
                });
                syncType();
            }
        });

        form.querySelectorAll('.ga-drop-file').forEach(UI.bindFilePreview);
        syncType();

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            var data = new FormData(form);
            var required = ['price'].concat(type === 'pasp' ? [] : ['width', 'widthwithout']);
            var missing = required.filter(function (name) {
                return !/^\d+$/.test(String(data.get(name) || '').trim());
            });

            form.querySelectorAll('.is-invalid').forEach(function (input) {
                input.classList.remove('is-invalid');
            });
            missing.forEach(function (name) {
                form.querySelector('[name="' + name + '"]').classList.add('is-invalid');
            });

            if (missing.length) {
                UI.notify('warning', 'Заполните размеры и цену');
                return;
            }

            if (!form.listimg.files.length || !form.imgconst.files.length) {
                UI.notify('warning', 'Нужны обе картинки: для каталога и для конструктора');
                return;
            }

            data.append('action', 'create');
            data.append('type', type);

            var button = dialog.card.querySelector('[data-role="c-save"]');
            button.disabled = true;

            UI.api(API, data).then(function (json) {
                var item = json.data;

                dialog.close();
                UI.notify('success', 'Добавлено: артикул ' + item.publicvendor);
                state.highlightId = String(item.id);
                state.counts[item.type] = (state.counts[item.type] || 0) + 1;

                if (state.cache[item.type]) {
                    state.cache[item.type].unshift(item);
                }

                if (item.type !== state.type) {
                    state.type = item.type;
                    UI.setParams([item.type]);
                }

                state.filter = 'all';
                state.search = '';
                el.search.value = '';
                state.sort = {key: 'id', dir: -1};
                load(item.type);
            }).catch(function (error) {
                button.disabled = false;
                UI.showError(error);
            });
        });
    }

    // ---------- События ----------

    function bind() {
        view.querySelector('[data-role="add"]').addEventListener('click', openCreate);

        el.types.addEventListener('click', function (event) {
            var button = event.target.closest('[data-type]');

            if (button) {
                selectType(button.dataset.type);
            }
        });

        el.filters.addEventListener('click', function (event) {
            var chip = event.target.closest('[data-filter]');

            if (chip) {
                state.filter = chip.dataset.filter;
                state.limit = PAGE;
                renderFilters();
                renderRows();
            }
        });

        el.supplier.addEventListener('change', function () {
            state.supplier = el.supplier.value;
            state.limit = PAGE;
            renderRows();
        });

        el.search.addEventListener('input', UI.debounce(function () {
            state.search = el.search.value;
            state.limit = PAGE;
            renderRows();
        }, 120));

        el.head.addEventListener('click', function (event) {
            var th = event.target.closest('[data-sort]');

            if (th) {
                var key = th.dataset.sort;

                state.sort = state.sort.key === key
                    ? {key: key, dir: -state.sort.dir}
                    : {key: key, dir: key === 'date_update' || key === 'publicvendor' ? -1 : 1};
                renderHead();
                renderRows();
            }
        });

        el.head.addEventListener('change', function (event) {
            if (event.target.closest('[data-role="all"]')) {
                var checked = event.target.checked;

                filtered().slice(0, state.limit).forEach(function (item) {
                    if (checked) {
                        state.selected.add(String(item.id));
                    } else {
                        state.selected.delete(String(item.id));
                    }
                });
                renderSelection();
            }
        });

        el.more.addEventListener('click', function (event) {
            if (event.target.closest('[data-role="more-btn"]')) {
                state.limit += PAGE;
                renderRows();
            }
        });

        el.rows.addEventListener('change', function (event) {
            var pick = event.target.closest('[data-role="pick"]');

            if (pick) {
                var id = pick.closest('tr').dataset.id;

                if (pick.checked) {
                    state.selected.add(id);
                } else {
                    state.selected.delete(id);
                }
                renderSelection();
            }
        });

        el.rows.addEventListener('click', function (event) {
            var tr = event.target.closest('tr[data-id]');

            if (!tr) {
                return;
            }

            var id = tr.dataset.id;

            if (event.target.closest('[data-role="edit"]')) {
                startEdit(id);
            } else if (event.target.closest('[data-role="delete"]')) {
                remove([id]);
            } else if (event.target.closest('[data-role="save"]')) {
                saveEdit();
            } else if (event.target.closest('[data-role="cancel"]')) {
                cancelEdit();
            } else if (event.target.closest('[data-role="preview"]')) {
                var item = findItem(id);

                if (item) {
                    preview(item);
                }
            }
        });

        el.rows.addEventListener('dblclick', function (event) {
            var tr = event.target.closest('tr[data-id]:not(.is-editing)');

            if (tr && !event.target.closest('button, input, a')) {
                startEdit(tr.dataset.id);
            }
        });

        el.rows.addEventListener('keydown', function (event) {
            if (!event.target.closest('tr.is-editing')) {
                return;
            }

            if (event.key === 'Enter') {
                event.preventDefault();
                saveEdit();
            } else if (event.key === 'Escape') {
                event.preventDefault();
                cancelEdit();
            }
        });

        el.selbar.addEventListener('click', function (event) {
            var button = event.target.closest('[data-bulk]');

            if (!button) {
                return;
            }

            if (button.dataset.bulk === 'clear') {
                state.selected.clear();
                renderSelection();
            } else {
                remove(Array.from(state.selected));
            }
        });

        document.addEventListener('keydown', function (event) {
            if (view.hidden || UI.hasOpenModal() || event.target.closest('input, textarea, select')) {
                return;
            }

            if (event.key === 'Escape' && state.selected.size) {
                state.selected.clear();
                renderSelection();
            } else if (event.key === 'Delete' && state.selected.size) {
                remove(Array.from(state.selected));
            }
        });
    }

    UI.route('catalog', {
        title: 'Багет и паспарту',
        init: mount,
        show: function (section, params) {
            var type = params[0];

            if (TYPES.some(function (entry) { return entry.key === type; })) {
                state.type = type;
            }

            state.selected.clear();
            state.editingId = null;
            load(state.type, true);
        }
    });
})();
