/* Заявки: обратная связь и заказы картин. Статусы, быстрый звонок/WhatsApp, поиск, массовые действия. */
(function () {
    'use strict';

    var UI = window.AdminUI;
    var API = '/admin/request/api/leads.php';
    var PAGE = 50;

    var STATUSES = {
        new: {label: 'Новая', badge: 'ga-badge--new'},
        work: {label: 'В работе', badge: 'ga-badge--work'},
        done: {label: 'Закрыта', badge: 'ga-badge--done'}
    };

    var CHANNELS = [
        {key: 'call', label: 'Позвонить', test: /позвон/i},
        {key: 'whatsapp', label: 'WhatsApp', test: /whatsapp/i},
        {key: 'telegram', label: 'Telegram', test: /telegram/i},
        {key: 'max', label: 'MAX', test: /\bmax\b/i}
    ];

    function channelOf(text) {
        for (var i = 0; i < CHANNELS.length; i++) {
            if (CHANNELS[i].test.test(text || '')) {
                return CHANNELS[i];
            }
        }

        return null;
    }

    // 8 (999) 123-45-67 → 79991234567
    function phoneDigits(phone) {
        var digits = String(phone || '').replace(/\D/g, '');

        if (digits.length === 11 && digits.charAt(0) === '8') {
            digits = '7' + digits.slice(1);
        }
        if (digits.length === 10) {
            digits = '7' + digits;
        }

        return digits;
    }

    function create(options) {
        var source = options.source;
        var isOrders = source === 'orders';

        var state = {
            items: [],
            loaded: false,
            status: 'new',
            channel: '',
            search: '',
            limit: PAGE,
            selected: new Set()
        };

        var view;
        var el = {};

        function counts() {
            var result = {new: 0, work: 0, done: 0, all: state.items.length};

            state.items.forEach(function (item) {
                result[item.status]++;
            });

            return result;
        }

        function filtered() {
            var query = state.search.trim().toLowerCase();
            var queryDigits = query.replace(/\D/g, '');

            return state.items.filter(function (item) {
                if (state.status !== 'all' && item.status !== state.status) {
                    return false;
                }

                if (state.channel && (channelOf(item.channel) || {}).key !== state.channel) {
                    return false;
                }

                if (!query) {
                    return true;
                }

                var haystack = [item.name, item.comment, item.email, item.painting_name, item.address, String(item.id)].join(' ').toLowerCase();

                return haystack.indexOf(query) !== -1 ||
                    (queryDigits.length >= 3 && phoneDigits(item.phone).indexOf(queryDigits) !== -1);
            });
        }

        function mount(section) {
            view = section;
            view.innerHTML = UI.pageHead({
                eyebrow: 'Заявки',
                title: options.title,
                sub: 'Загрузка…',
                subId: source + 'Sub'
            }) +
                '<div class="ga-toolbar">' +
                '<div class="ga-toolbar-left">' +
                '<div class="ga-chips" data-role="status"></div>' +
                (isOrders ? '' : '<select class="ga-select ld-channel-select" data-role="channel" aria-label="Способ связи">' +
                    '<option value="">Любой способ связи</option>' +
                    CHANNELS.map(function (channel) {
                        return '<option value="' + channel.key + '">' + channel.label + '</option>';
                    }).join('') + '</select>') +
                '</div>' +
                '<label class="ga-search">' + UI.icon('search') +
                '<input type="search" data-role="search" placeholder="Имя, телефон, текст заявки" aria-label="Поиск по заявкам"></label>' +
                '</div>' +
                '<div class="ld-notice" data-role="notice" hidden></div>' +
                '<div class="ga-panel"><div class="ga-table-wrap"><table class="ga-table ga-table--cards ld-table">' +
                '<thead><tr>' +
                '<th class="t-check"><input type="checkbox" class="ga-checkbox" data-role="all" aria-label="Выбрать все"></th>' +
                '<th>Когда</th><th>Клиент</th>' + (isOrders ? '<th>Картина</th><th>Доставка</th>' : '<th>Связаться</th>') +
                '<th>Комментарий</th><th>Статус</th><th class="t-actions"></th>' +
                '</tr></thead><tbody data-role="rows">' + UI.skeletonRows(isOrders ? 7 : 6) + '</tbody></table></div>' +
                '<div class="ga-table-foot" data-role="more" hidden></div></div>' +
                '<div class="ga-selbar" data-role="selbar" hidden>' +
                '<span class="ga-selbar-count"><b data-role="selcount">0</b> выбрано</span>' +
                '<button type="button" class="ga-btn ga-btn--dark-ghost ga-btn--sm" data-bulk="work">В работу</button>' +
                '<button type="button" class="ga-btn ga-btn--light ga-btn--sm" data-bulk="done">' + UI.icon('check') + 'Закрыть</button>' +
                '<button type="button" class="ga-btn ga-btn--danger-dark ga-btn--sm" data-bulk="delete">Удалить</button>' +
                '<button type="button" class="ga-icon-btn ga-icon-btn--dark" data-bulk="clear" title="Снять выделение" aria-label="Снять выделение">' + UI.icon('x') + '</button>' +
                '</div>';

            ['status', 'channel', 'search', 'notice', 'rows', 'more', 'all', 'selbar', 'selcount'].forEach(function (role) {
                el[role] = view.querySelector('[data-role="' + role + '"]');
            });

            bind();
        }

        function renderChips() {
            var c = counts();

            el.status.innerHTML = [['new', 'Новые'], ['work', 'В работе'], ['done', 'Закрытые'], ['all', 'Все']].map(function (chip) {
                return '<button type="button" class="ga-chip-btn' + (state.status === chip[0] ? ' is-active' : '') + '" data-status="' + chip[0] + '">' +
                    chip[1] + ' <span class="ga-seg-count">' + c[chip[0]] + '</span></button>';
            }).join('');

            var sub = document.getElementById(source + 'Sub');

            if (sub) {
                sub.textContent = c.all
                    ? c.all + ' ' + UI.plural(c.all, 'заявка', 'заявки', 'заявок') + ' · новых ' + c.new + ' · в работе ' + c.work
                    : 'Заявок пока нет';
            }

            UI.setCount(source === 'orders' ? 'orders' : 'leads', c.new);
        }

        function contactCell(item) {
            var digits = phoneDigits(item.phone);
            var channel = channelOf(item.channel);
            var buttons = '';

            if (digits.length >= 10) {
                buttons += '<a class="ga-icon-btn ld-act" href="tel:+' + digits + '" title="Позвонить">' + UI.icon('phone') + '</a>';
                buttons += '<a class="ga-icon-btn ld-act ld-act--wa" href="https://wa.me/' + digits + '" target="_blank" rel="noopener" title="Написать в WhatsApp">' +
                    '<svg class="ga-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M4.5 19.5l1.2-4A8 8 0 1 1 9 18.6l-4.5.9z"/><path d="M9.5 8.5c0 3 2.5 6 6 6l1-1.5-2-1-1 .8a4 4 0 0 1-2.3-2.3l.8-1-1-2z"/></svg></a>';
                buttons += '<a class="ga-icon-btn ld-act ld-act--tg" href="https://t.me/+' + digits + '" target="_blank" rel="noopener" title="Написать в Telegram">' +
                    '<svg class="ga-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 5L3.5 11.5l5 1.8L18 7.5l-7.5 7v4.5l3-3.2 4 3.2L20 5z"/></svg></a>';
            }

            return '<td data-label="Связаться"><div class="ld-contact">' +
                (channel ? '<span class="ld-channel ld-channel--' + channel.key + '">' + channel.label + '</span>' : '<span class="ga-muted">' + UI.esc(item.channel) + '</span>') +
                '<span class="ld-acts">' + buttons + '</span>' +
                '</div></td>';
        }

        function orderCells(item) {
            var painting = item.painting_name
                ? '<a class="ld-painting" href="#/paintings/' + encodeURIComponent(item.painting_id) + '">' +
                (item.painting_image ? '<img src="' + UI.esc(item.painting_image) + '" alt="" loading="lazy">' : '') +
                '<span><b>' + UI.esc(item.painting_name) + '</b>' +
                (item.painting_price ? '<span class="ga-muted">' + UI.money(item.painting_price) + '</span>' : '') + '</span></a>'
                : '<span class="ga-muted">Картина №' + UI.esc(item.painting_id) + ' удалена</span>';

            return '<td data-label="Картина">' + painting + '</td>' +
                '<td data-label="Доставка"><div class="ga-strong">' + UI.esc(item.delivery || '—') + '</div>' +
                (item.address ? '<div class="ga-muted">' + UI.esc(item.address) + '</div>' : '') + '</td>';
        }

        function row(item) {
            var id = String(item.id);
            var status = STATUSES[item.status];
            var digits = phoneDigits(item.phone);

            return '<tr data-id="' + id + '"' + (state.selected.has(id) ? ' class="is-selected"' : '') + '>' +
                '<td class="t-check"><input type="checkbox" class="ga-checkbox" data-role="pick"' + (state.selected.has(id) ? ' checked' : '') + ' aria-label="Выбрать заявку"></td>' +
                '<td data-label="Когда" class="ld-when"><div class="ga-strong">' + UI.esc(UI.date(item.created_at)) + '</div><div class="ga-muted">№ ' + id + '</div></td>' +
                '<td data-label="Клиент"><div class="ga-strong">' + UI.esc(item.name || 'Без имени') + '</div>' +
                '<a class="ld-phone" href="' + (digits ? 'tel:+' + digits : '#') + '">' + UI.esc(item.phone) + '</a>' +
                (isOrders && item.email ? '<div class="ga-muted">' + UI.esc(item.email) + '</div>' : '') + '</td>' +
                (isOrders ? orderCells(item) : contactCell(item)) +
                '<td data-label="Комментарий" class="ld-comment-cell">' + (item.comment ? '<div class="ld-comment">' + UI.esc(item.comment) + '</div>' : '<span class="ga-muted">—</span>') + '</td>' +
                '<td data-label="Статус"><button type="button" class="ga-badge ' + status.badge + '" data-role="status-btn" title="Сменить статус">' + status.label + '</button></td>' +
                '<td class="t-actions"><div class="ga-row-actions">' +
                '<button type="button" class="ga-icon-btn ga-icon-btn--danger" data-role="delete" title="Удалить заявку" aria-label="Удалить заявку">' + UI.icon('trash') + '</button>' +
                '</div></td>' +
                '</tr>';
        }

        function renderRows() {
            var list = filtered();
            var columns = isOrders ? 8 : 7;

            if (!state.loaded) {
                return;
            }

            if (!list.length) {
                var empty = state.items.length
                    ? UI.emptyState(state.search ? 'Ничего не найдено' : 'Здесь пусто', state.search ? 'Попробуйте изменить запрос' : 'В этом статусе заявок нет')
                    : UI.emptyState(isOrders ? 'Заказов пока нет' : 'Заявок пока нет', isOrders ? 'Заказы с витрины картин появятся здесь' : 'Заявки с сайта появятся здесь');

                el.rows.innerHTML = '<tr class="ld-empty"><td colspan="' + columns + '">' + empty + '</td></tr>';
                el.more.hidden = true;
            } else {
                el.rows.innerHTML = list.slice(0, state.limit).map(row).join('');

                var rest = list.length - state.limit;
                el.more.hidden = rest <= 0;
                el.more.innerHTML = rest > 0
                    ? '<button type="button" class="ga-btn ga-btn--ghost" data-role="more-btn">Показать ещё ' + Math.min(rest, PAGE) + ' из ' + rest + '</button>'
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
            el.all.checked = visible.length > 0 && picked === visible.length;
            el.all.indeterminate = picked > 0 && picked < visible.length;
            el.all.disabled = visible.length === 0;

            el.rows.querySelectorAll('tr[data-id]').forEach(function (tr) {
                var selected = state.selected.has(tr.dataset.id);
                tr.classList.toggle('is-selected', selected);
                tr.querySelector('[data-role="pick"]').checked = selected;
            });
        }

        // Заявки старше недели, которые так и остались «новыми»: статусы раньше не вели
        function staleIds() {
            var border = Date.now() - 7 * 86400000;

            return state.items.filter(function (item) {
                var date = UI.parseDate(item.created_at);
                return item.status === 'new' && date && date.getTime() < border;
            }).map(function (item) {
                return String(item.id);
            });
        }

        function renderNotice() {
            var stale = staleIds();

            el.notice.hidden = stale.length < 10;

            if (!el.notice.hidden) {
                el.notice.innerHTML = UI.icon('clock') +
                    '<span><b>' + stale.length + ' ' + UI.plural(stale.length, 'заявка', 'заявки', 'заявок') + ' старше недели</b> всё ещё в статусе «новая». ' +
                    'Раньше статусы не отмечали — скорее всего, они давно обработаны.</span>' +
                    '<button type="button" class="ga-btn ga-btn--ink ga-btn--sm" data-role="close-stale">Закрыть их</button>';
            }
        }

        function render() {
            renderChips();
            renderNotice();
            renderRows();
        }

        function load() {
            return UI.api(API, {action: 'list', source: source}).then(function (json) {
                state.items = json.data || [];
                state.loaded = true;

                var ids = new Set(state.items.map(function (item) {
                    return String(item.id);
                }));
                state.selected.forEach(function (id) {
                    if (!ids.has(id)) {
                        state.selected.delete(id);
                    }
                });

                // Новых нет — показываем все, чтобы раздел не выглядел пустым
                if (state.status === 'new' && !counts().new) {
                    state.status = 'all';
                }

                render();
            }).catch(function (error) {
                state.loaded = true;
                render();
                UI.showError(error);
            });
        }

        function setStatus(ids, status) {
            return UI.api(API, {action: 'status', source: source, status: status, ids: ids.join(',')}).then(function () {
                var set = new Set(ids.map(String));

                state.items.forEach(function (item) {
                    if (set.has(String(item.id))) {
                        item.status = status;
                    }
                });
                ids.forEach(function (id) {
                    state.selected.delete(String(id));
                });

                render();
                UI.notify('success', ids.length === 1
                    ? 'Статус: ' + STATUSES[status].label.toLowerCase()
                    : 'Статус «' + STATUSES[status].label + '»: ' + ids.length + ' ' + UI.plural(ids.length, 'заявка', 'заявки', 'заявок'));
            }).catch(UI.showError);
        }

        function remove(ids) {
            var single = ids.length === 1;
            var item = single ? state.items.find(function (entry) {
                return String(entry.id) === String(ids[0]);
            }) : null;

            UI.confirm({
                title: single ? 'Удалить заявку?' : 'Удалить ' + ids.length + ' ' + UI.plural(ids.length, 'заявку', 'заявки', 'заявок') + '?',
                html: single && item
                    ? 'Заявка №' + UI.esc(item.id) + ' от <b>' + UI.esc(item.name || 'клиента') + '</b> будет удалена <b>безвозвратно</b>. Если заявка обработана — лучше просто закрыть её.'
                    : 'Выбранные заявки будут удалены <b>безвозвратно</b>. Если они обработаны — лучше просто закрыть их.',
                ok: single ? 'Удалить заявку' : 'Удалить ' + ids.length
            }).then(function (ok) {
                if (!ok) {
                    return;
                }

                UI.api(API, {action: 'delete', source: source, ids: ids.join(',')}).then(function () {
                    var set = new Set(ids.map(String));

                    state.items = state.items.filter(function (entry) {
                        return !set.has(String(entry.id));
                    });
                    set.forEach(function (id) {
                        state.selected.delete(id);
                    });

                    render();
                    UI.notify('success', single ? 'Заявка удалена' : 'Удалено заявок: ' + ids.length);
                }).catch(UI.showError);
            });
        }

        function bind() {
            el.status.addEventListener('click', function (event) {
                var chip = event.target.closest('[data-status]');

                if (chip) {
                    state.status = chip.dataset.status;
                    state.limit = PAGE;
                    state.selected.clear();
                    render();
                }
            });

            if (el.channel) {
                el.channel.addEventListener('change', function () {
                    state.channel = el.channel.value;
                    state.limit = PAGE;
                    renderRows();
                });
            }

            el.search.addEventListener('input', UI.debounce(function () {
                state.search = el.search.value;
                state.limit = PAGE;
                renderRows();
            }, 150));

            el.notice.addEventListener('click', function (event) {
                if (!event.target.closest('[data-role="close-stale"]')) {
                    return;
                }

                var ids = staleIds();

                UI.confirm({
                    title: 'Закрыть старые заявки?',
                    html: 'Отметим <b>' + ids.length + ' ' + UI.plural(ids.length, 'заявку', 'заявки', 'заявок') + '</b> старше недели как закрытые. ' +
                        'Ничего не удаляется — их всегда можно найти во вкладке «Закрытые».',
                    ok: 'Закрыть ' + ids.length,
                    danger: false
                }).then(function (ok) {
                    if (ok) {
                        setStatus(ids, 'done');
                    }
                });
            });

            el.more.addEventListener('click', function (event) {
                if (event.target.closest('[data-role="more-btn"]')) {
                    state.limit += PAGE;
                    renderRows();
                }
            });

            el.all.addEventListener('change', function () {
                filtered().slice(0, state.limit).forEach(function (item) {
                    if (el.all.checked) {
                        state.selected.add(String(item.id));
                    } else {
                        state.selected.delete(String(item.id));
                    }
                });
                renderSelection();
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
                var item = state.items.find(function (entry) {
                    return String(entry.id) === id;
                });
                var statusBtn = event.target.closest('[data-role="status-btn"]');

                if (statusBtn) {
                    UI.menu(statusBtn, Object.keys(STATUSES).map(function (key) {
                        return {
                            value: key,
                            active: item.status === key,
                            html: '<span class="ga-badge ' + STATUSES[key].badge + '">' + STATUSES[key].label + '</span>'
                        };
                    }), function (value) {
                        if (value !== item.status) {
                            setStatus([id], value);
                        }
                    });
                    return;
                }

                if (event.target.closest('[data-role="delete"]')) {
                    remove([id]);
                    return;
                }

                // Клик по комментарию — показать целиком
                var comment = event.target.closest('.ld-comment');

                if (comment) {
                    comment.classList.toggle('is-open');
                }
            });

            el.selbar.addEventListener('click', function (event) {
                var button = event.target.closest('[data-bulk]');

                if (!button) {
                    return;
                }

                var ids = Array.from(state.selected);
                var action = button.dataset.bulk;

                if (action === 'clear') {
                    state.selected.clear();
                    renderSelection();
                } else if (action === 'delete') {
                    remove(ids);
                } else {
                    setStatus(ids, action);
                }
            });

            document.addEventListener('keydown', function (event) {
                if (view.hidden || UI.hasOpenModal() || event.target.closest('input, textarea, select')) {
                    return;
                }

                if (event.key === 'Escape' && state.selected.size) {
                    state.selected.clear();
                    renderSelection();
                }
            });
        }

        UI.route(source === 'orders' ? 'orders' : 'leads', {
            title: options.title,
            init: mount,
            show: function () {
                load();
            }
        });
    }

    create({source: 'feedback', title: 'Обратная связь'});
    create({source: 'orders', title: 'Заказы картин'});
})();
