/* Промокоды: статус на сайте (действует / истёк / выключен), срок действия, создание и правка, удаление. */
(function () {
    'use strict';

    var UI = window.AdminUI;
    var API = '/admin/request/api/promo.php';
    var PAGE = 60;

    var STATES = {
        on: {label: 'Действует', badge: 'ga-badge--on'},
        expired: {label: 'Истёк', badge: 'ga-badge--expired'},
        off: {label: 'Выключен', badge: 'ga-badge--off'}
    };

    var state = {items: [], loaded: false, show: 'on', search: '', limit: PAGE, selected: new Set()};
    var view;
    var el = {};

    function findItem(code) {
        return state.items.find(function (item) {
            return item.code === code;
        }) || null;
    }

    function discount(item) {
        return item.kind === 'percent' ? item.value + ' %' : UI.money(item.value);
    }

    function isoDate(date) {
        return date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
    }

    function addDays(days) {
        var date = new Date();
        date.setDate(date.getDate() + days);
        return isoDate(date);
    }

    function randomCode() {
        var alphabet = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        var code = '';

        for (var i = 0; i < 6; i++) {
            code += alphabet.charAt(Math.floor(Math.random() * alphabet.length));
        }

        return findItem(code) ? randomCode() : code;
    }

    function filtered() {
        var query = state.search.trim().toLowerCase();

        return state.items.filter(function (item) {
            return (state.show === 'all' || item.state === state.show) && (!query || item.code.toLowerCase().indexOf(query) !== -1);
        });
    }

    function mount(section) {
        view = section;
        view.innerHTML = UI.pageHead({
            eyebrow: 'Сайт',
            title: 'Промокоды',
            sub: 'Скидки в онлайн-конструкторе багета.',
            subId: 'prSub',
            actions: '<button type="button" class="ga-btn ga-btn--ink" data-role="add">' + UI.icon('plus') + 'Новый промокод</button>'
        }) +
            '<div class="ga-toolbar">' +
            '<div class="ga-toolbar-left"><div class="ga-chips" data-role="show"></div></div>' +
            '<label class="ga-search">' + UI.icon('search') + '<input type="search" data-role="search" placeholder="Найти код" aria-label="Поиск промокода"></label>' +
            '</div>' +
            '<div class="ga-panel"><div class="ga-table-wrap"><table class="ga-table ga-table--cards pr-table">' +
            '<thead><tr>' +
            '<th class="t-check"><input type="checkbox" class="ga-checkbox" data-role="all" aria-label="Выбрать все"></th>' +
            '<th>Код</th><th class="t-num">Скидка</th><th>Действует до</th><th>На сайте</th><th>Включён</th><th class="t-actions"></th>' +
            '</tr></thead><tbody data-role="rows">' + UI.skeletonRows(7) + '</tbody></table></div>' +
            '<div class="ga-table-foot" data-role="more" hidden></div></div>' +
            '<div class="ga-selbar" data-role="selbar" hidden>' +
            '<span class="ga-selbar-count"><b data-role="selcount">0</b> выбрано</span>' +
            '<button type="button" class="ga-btn ga-btn--danger-dark ga-btn--sm" data-bulk="delete">Удалить</button>' +
            '<button type="button" class="ga-icon-btn ga-icon-btn--dark" data-bulk="clear" title="Снять выделение" aria-label="Снять выделение">' + UI.icon('x') + '</button>' +
            '</div>';

        ['show', 'search', 'rows', 'more', 'all', 'selbar', 'selcount'].forEach(function (role) {
            el[role] = view.querySelector('[data-role="' + role + '"]');
        });

        bind();
    }

    function row(item) {
        var st = STATES[item.state];
        var selected = state.selected.has(item.code);

        return '<tr data-code="' + UI.esc(item.code) + '"' + (selected ? ' class="is-selected"' : '') + '>' +
            '<td class="t-check"><input type="checkbox" class="ga-checkbox" data-role="pick"' + (selected ? ' checked' : '') + ' aria-label="Выбрать"></td>' +
            '<td data-label="Код"><span class="pr-code">' + UI.esc(item.code) + '</span>' +
            '<button type="button" class="ga-icon-btn pr-copy" data-role="copy" title="Скопировать код" aria-label="Скопировать код">' + UI.icon('copy') + '</button></td>' +
            '<td class="t-num" data-label="Скидка"><span class="ga-strong">' + discount(item) + '</span></td>' +
            '<td data-label="Действует до">' + (item.date_end ? UI.esc(UI.date(item.date_end, false)) : '<span class="ga-muted">не задано</span>') + '</td>' +
            '<td data-label="На сайте"><span class="ga-badge ' + st.badge + '">' + st.label + '</span></td>' +
            '<td data-label="Включён"><label class="ga-switch ga-switch--sm"><input type="checkbox" data-role="active"' + (item.active ? ' checked' : '') + ' aria-label="Включён"><span class="ga-switch-track"></span></label></td>' +
            '<td class="t-actions"><div class="ga-row-actions">' +
            '<button type="button" class="ga-icon-btn" data-role="edit" title="Изменить" aria-label="Изменить">' + UI.icon('edit') + '</button>' +
            '<button type="button" class="ga-icon-btn ga-icon-btn--danger" data-role="delete" title="Удалить" aria-label="Удалить">' + UI.icon('trash') + '</button>' +
            '</div></td>' +
            '</tr>';
    }

    function render() {
        var counts = {all: state.items.length, on: 0, expired: 0, off: 0};

        state.items.forEach(function (item) {
            counts[item.state]++;
        });

        el.show.innerHTML = [['on', 'Действуют'], ['expired', 'Истекли'], ['off', 'Выключены'], ['all', 'Все']].map(function (chip) {
            return '<button type="button" class="ga-chip-btn' + (state.show === chip[0] ? ' is-active' : '') + '" data-show="' + chip[0] + '">' +
                chip[1] + ' <span class="ga-seg-count">' + counts[chip[0]] + '</span></button>';
        }).join('');

        var sub = document.getElementById('prSub');

        if (sub && state.loaded) {
            sub.textContent = counts.all + ' ' + UI.plural(counts.all, 'код', 'кода', 'кодов') + ' · действуют сейчас ' + counts.on +
                '. Код работает, пока он включён и не истёк срок.';
        }

        renderRows();
    }

    function renderRows() {
        if (!state.loaded) {
            return;
        }

        var list = filtered();

        if (!list.length) {
            el.rows.innerHTML = '<tr class="ld-empty"><td colspan="7">' + (state.items.length
                ? UI.emptyState('Здесь пусто', state.search ? 'По запросу ничего не найдено' : 'В этом статусе кодов нет')
                : UI.emptyState('Промокодов пока нет', 'Создайте первый кнопкой «Новый промокод»')) + '</td></tr>';
            el.more.hidden = true;
        } else {
            el.rows.innerHTML = list.slice(0, state.limit).map(row).join('');

            var rest = list.length - state.limit;
            el.more.hidden = rest <= 0;
            el.more.innerHTML = rest > 0 ? '<button type="button" class="ga-btn ga-btn--ghost" data-role="more-btn">Показать ещё ' + Math.min(rest, PAGE) + ' из ' + rest + '</button>' : '';
        }

        renderSelection();
    }

    function renderSelection() {
        var visible = filtered().slice(0, state.limit).map(function (item) {
            return item.code;
        });
        var picked = visible.filter(function (code) {
            return state.selected.has(code);
        }).length;

        el.selbar.hidden = state.selected.size === 0;
        el.selcount.textContent = state.selected.size;
        el.all.checked = visible.length > 0 && picked === visible.length;
        el.all.indeterminate = picked > 0 && picked < visible.length;
        el.all.disabled = visible.length === 0;

        el.rows.querySelectorAll('tr[data-code]').forEach(function (tr) {
            var selected = state.selected.has(tr.dataset.code);
            tr.classList.toggle('is-selected', selected);
            tr.querySelector('[data-role="pick"]').checked = selected;
        });
    }

    function load() {
        return UI.api(API, {action: 'list'}).then(function (json) {
            var firstLoad = !state.loaded;

            state.items = json.data || [];
            state.loaded = true;

            // Действующих нет — сразу показываем все коды
            if (firstLoad && state.show === 'on' && !state.items.some(function (item) { return item.state === 'on'; })) {
                state.show = 'all';
            }

            render();
        }).catch(function (error) {
            state.loaded = true;
            render();
            UI.showError(error);
        });
    }

    function upsert(original, saved) {
        var index = state.items.findIndex(function (item) {
            return item.code === original;
        });

        if (index === -1) {
            state.items.unshift(saved);
        } else {
            state.items[index] = saved;
        }

        if (original && original !== saved.code && state.selected.has(original)) {
            state.selected.delete(original);
        }
    }

    function save(original, fields) {
        return UI.api(API, Object.assign({action: 'save', original: original || ''}, fields)).then(function (json) {
            upsert(original, json.data);
            render();
            return json.data;
        });
    }

    function toggleActive(item, toggle) {
        if (!item.date_end) {
            toggle.checked = !toggle.checked;
            UI.notify('warning', 'У кода не задан срок — укажите дату');
            openEditor(item);
            return;
        }

        save(item.code, {code: item.code, kind: item.kind, value: item.value, date_end: item.date_end, active: toggle.checked ? 1 : 0}).then(function (saved) {
            UI.notify('success', saved.active ? 'Код ' + saved.code + ' включён' : 'Код ' + saved.code + ' выключен');
        }).catch(function (error) {
            toggle.checked = !toggle.checked;
            UI.showError(error);
        });
    }

    function remove(codes) {
        var single = codes.length === 1;

        UI.confirm({
            title: single ? 'Удалить промокод?' : 'Удалить ' + codes.length + ' ' + UI.plural(codes.length, 'промокод', 'промокода', 'промокодов') + '?',
            html: single
                ? 'Код <b>' + UI.esc(codes[0]) + '</b> перестанет работать на сайте и будет удалён <b>безвозвратно</b>. Чтобы временно отключить — выключите его.'
                : 'Коды перестанут работать на сайте и будут удалены <b>безвозвратно</b>.',
            ok: single ? 'Удалить код' : 'Удалить ' + codes.length
        }).then(function (ok) {
            if (!ok) {
                return;
            }

            UI.api(API, {action: 'delete', codes: codes}).then(function () {
                var set = new Set(codes);

                state.items = state.items.filter(function (item) {
                    return !set.has(item.code);
                });
                codes.forEach(function (code) {
                    state.selected.delete(code);
                });
                render();
                UI.notify('success', single ? 'Промокод удалён' : 'Удалено кодов: ' + codes.length);
            }).catch(UI.showError);
        });
    }

    // ---------- Редактор ----------

    function openEditor(item) {
        var isNew = !item;
        var kind = item ? item.kind : 'percent';

        var dialog = UI.dialog({
            size: 'form',
            focus: '[name="value"]',
            html: '<div class="ga-eyebrow">Промокод</div>' +
                '<h3 class="ga-modal-title">' + (isNew ? 'Новый промокод' : 'Код ' + UI.esc(item.code)) + '</h3>' +
                '<form class="ga-modal-body" data-role="form" novalidate>' +
                '<div class="ga-form-grid">' +
                '<label class="ga-field ga-span-all"><span class="ga-field-label">Код</span>' +
                '<span class="pr-code-field"><input class="ga-input pr-code-input" name="code" autocomplete="off" value="' + UI.esc(item ? item.code : randomCode()) + '">' +
                '<button type="button" class="ga-btn ga-btn--soft" data-role="generate" title="Придумать новый код">' + UI.icon('spark') + 'Другой</button></span></label>' +
                '<div class="ga-field"><span class="ga-field-label">Скидка</span><div class="ga-seg" data-role="kind">' +
                '<button type="button" class="ga-seg-btn' + (kind === 'percent' ? ' is-active' : '') + '" data-kind="percent">Процент</button>' +
                '<button type="button" class="ga-seg-btn' + (kind === 'rub' ? ' is-active' : '') + '" data-kind="rub">Рубли</button>' +
                '</div></div>' +
                '<label class="ga-field"><span class="ga-field-label">Размер</span><span class="ga-input-group">' +
                '<input class="ga-input" type="number" min="1" name="value" value="' + UI.esc(item ? item.value : 10) + '"><span class="ga-input-suffix" data-role="suffix">' + (kind === 'percent' ? '%' : '₽') + '</span></span></label>' +
                '<label class="ga-field"><span class="ga-field-label">Действует до</span><input class="ga-input" type="date" name="date_end" value="' + UI.esc(item && item.date_end ? item.date_end : addDays(30)) + '"></label>' +
                '<div class="ga-field"><span class="ga-field-label">Быстро</span><div class="ga-chips" data-role="quick">' +
                '<button type="button" class="ga-chip-btn" data-days="7">+7 дней</button>' +
                '<button type="button" class="ga-chip-btn" data-days="30">+30 дней</button>' +
                '<button type="button" class="ga-chip-btn" data-days="90">+3 месяца</button>' +
                '</div></div>' +
                '<label class="ga-switch ga-span-all"><input type="checkbox" name="active"' + (!item || item.active ? ' checked' : '') + '><span class="ga-switch-track"></span>' +
                '<span class="ga-switch-label">Код включён</span></label>' +
                '</div>' +
                '<div class="ga-modal-actions' + (isNew ? '' : ' ga-modal-actions--split') + '">' +
                (isNew ? '' : '<button type="button" class="ga-btn ga-btn--danger-ghost" data-role="delete">' + UI.icon('trash') + 'Удалить</button>') +
                '<div class="ga-modal-actions-group"><button type="button" class="ga-btn ga-btn--ghost" data-ga-close>Отмена</button>' +
                '<button type="submit" class="ga-btn ga-btn--ink" data-role="save">' + (isNew ? 'Создать код' : 'Сохранить') + '</button></div>' +
                '</div>' +
                '</form>'
        });

        var form = dialog.card.querySelector('[data-role="form"]');

        dialog.card.querySelector('[data-role="generate"]').addEventListener('click', function () {
            form.code.value = randomCode();
        });

        dialog.card.querySelector('[data-role="kind"]').addEventListener('click', function (event) {
            var button = event.target.closest('[data-kind]');

            if (button) {
                kind = button.dataset.kind;
                this.querySelectorAll('[data-kind]').forEach(function (entry) {
                    entry.classList.toggle('is-active', entry === button);
                });
                dialog.card.querySelector('[data-role="suffix"]').textContent = kind === 'percent' ? '%' : '₽';
            }
        });

        dialog.card.querySelector('[data-role="quick"]').addEventListener('click', function (event) {
            var button = event.target.closest('[data-days]');

            if (button) {
                form.date_end.value = addDays(parseInt(button.dataset.days, 10));
            }
        });

        var deleteButton = dialog.card.querySelector('[data-role="delete"]');

        if (deleteButton) {
            deleteButton.addEventListener('click', function () {
                dialog.close();
                remove([item.code]);
            });
        }

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            var submit = dialog.card.querySelector('[data-role="save"]');
            submit.disabled = true;

            save(item ? item.code : '', {
                code: isNew ? form.code.value.trim().toUpperCase() : form.code.value.trim(),
                kind: kind,
                value: form.value.value,
                date_end: form.date_end.value,
                active: form.active.checked ? 1 : 0
            }).then(function (saved) {
                dialog.close();
                UI.notify('success', isNew ? 'Промокод ' + saved.code + ' создан' : 'Промокод ' + saved.code + ' сохранён');

                if (isNew && state.show !== 'all' && state.show !== saved.state) {
                    state.show = saved.state;
                    render();
                }
            }).catch(function (error) {
                submit.disabled = false;
                UI.showError(error);
            });
        });
    }

    // ---------- События ----------

    function bind() {
        view.querySelector('[data-role="add"]').addEventListener('click', function () {
            openEditor(null);
        });

        el.show.addEventListener('click', function (event) {
            var chip = event.target.closest('[data-show]');

            if (chip) {
                state.show = chip.dataset.show;
                state.limit = PAGE;
                render();
            }
        });

        el.search.addEventListener('input', UI.debounce(function () {
            state.search = el.search.value;
            state.limit = PAGE;
            renderRows();
        }, 120));

        el.more.addEventListener('click', function (event) {
            if (event.target.closest('[data-role="more-btn"]')) {
                state.limit += PAGE;
                renderRows();
            }
        });

        el.all.addEventListener('change', function () {
            filtered().slice(0, state.limit).forEach(function (item) {
                if (el.all.checked) {
                    state.selected.add(item.code);
                } else {
                    state.selected.delete(item.code);
                }
            });
            renderSelection();
        });

        el.rows.addEventListener('change', function (event) {
            var tr = event.target.closest('tr[data-code]');

            if (!tr) {
                return;
            }

            var code = tr.dataset.code;

            if (event.target.closest('[data-role="pick"]')) {
                if (event.target.checked) {
                    state.selected.add(code);
                } else {
                    state.selected.delete(code);
                }
                renderSelection();
            } else if (event.target.closest('[data-role="active"]')) {
                toggleActive(findItem(code), event.target);
            }
        });

        el.rows.addEventListener('click', function (event) {
            var tr = event.target.closest('tr[data-code]');

            if (!tr) {
                return;
            }

            var item = findItem(tr.dataset.code);

            if (event.target.closest('[data-role="edit"]')) {
                openEditor(item);
            } else if (event.target.closest('[data-role="delete"]')) {
                remove([item.code]);
            } else if (event.target.closest('[data-role="copy"]')) {
                navigator.clipboard.writeText(item.code).then(function () {
                    UI.notify('success', 'Код ' + item.code + ' скопирован');
                }).catch(function () {
                    UI.notify('warning', 'Не удалось скопировать');
                });
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
    }

    UI.route('promo', {
        title: 'Промокоды',
        init: mount,
        show: function () {
            load();
        }
    });
})();
