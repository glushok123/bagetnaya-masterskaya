/* Обзор: сводка по заявкам, каталогу и сайту — вместо старой «Статистики». */
(function () {
    'use strict';

    var UI = window.AdminUI;
    var API = '/admin/request/api/overview.php';

    var TYPE_NAMES = {plast: 'Пластик', wood: 'Дерево', alum: 'Алюминий', pasp: 'Паспарту'};
    var TYPE_ORDER = ['wood', 'plast', 'alum', 'pasp'];
    var SUPPLIER_NAMES = {neoart: 'Neoart', interquadrum: 'Interquadrum', lion: 'Lion', manual: 'Добавлено вручную'};
    var WEEKDAYS = ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'];
    var MONTHS = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];

    var lastData = null;

    function greeting() {
        var hour = new Date().getHours();

        if (hour < 5) {
            return 'Доброй ночи';
        }
        if (hour < 12) {
            return 'Доброе утро';
        }
        if (hour < 18) {
            return 'Добрый день';
        }

        return 'Добрый вечер';
    }

    function today() {
        var d = new Date();
        var weekday = WEEKDAYS[d.getDay()];

        return weekday.charAt(0).toUpperCase() + weekday.slice(1) + ', ' + d.getDate() + ' ' + MONTHS[d.getMonth()];
    }

    function num(value) {
        return (parseInt(value, 10) || 0).toLocaleString('ru-RU').replace(/,/g, ' ');
    }

    function channelIcon(channel) {
        return /позвон/i.test(channel || '') ? UI.icon('phone') : UI.icon('chat');
    }

    function card(options) {
        return '<a class="st-card' + (options.accent ? ' st-card--accent' : '') + '" href="' + options.href + '">' +
            '<div class="st-label">' + options.label + '</div>' +
            '<div class="st-value">' + options.value + '</div>' +
            (options.note ? '<div class="st-note">' + options.note + '</div>' : '') +
            (options.extra || '') +
            '</a>';
    }

    function bars(days) {
        var max = Math.max.apply(null, days.map(function (day) {
            return day.total;
        }).concat([1]));

        return '<div class="st-bars" aria-hidden="true">' + days.map(function (day, index) {
            var height = Math.max(6, Math.round(day.total / max * 100));
            return '<span class="st-bar' + (index === days.length - 1 ? ' is-today' : '') + '" style="height:' + height + '%" title="' +
                UI.esc(UI.date(day.day, false) + ': ' + day.total) + '"></span>';
        }).join('') + '</div>';
    }

    function renderSkeleton(view) {
        view.innerHTML = UI.pageHead({eyebrow: today(), title: greeting(), sub: 'Собираем сводку по мастерской…'}) +
            '<div class="st-grid">' + new Array(7).join('<div class="st-card"><span class="ga-skel" style="height:12px;width:50%"></span>' +
                '<span class="ga-skel" style="height:34px;width:40%;margin-top:12px"></span></div>') + '</div>';
    }

    function render(view, data) {
        var leads = data.leads;
        var catalogTotal = 0;
        var catalogInStock = 0;
        var catalogNoPrice = 0;
        var byType = {};

        data.catalog.forEach(function (row) {
            byType[row.type] = row;
            catalogTotal += row.total;
            catalogInStock += row.in_stock;
            catalogNoPrice += row.no_price;
        });

        var cards =
            card({
                accent: true,
                href: '#/leads',
                label: 'Новые заявки',
                value: num(leads.new_count),
                note: 'сегодня <b>' + num(leads.today) + '</b> · за 7 дней <b>' + num(leads.week) + '</b>',
                extra: bars(leads.days)
            }) +
            card({
                href: '#/orders',
                label: 'Заказы картин',
                value: num(data.orders.new_count),
                note: data.orders.total ? 'новых из ' + num(data.orders.total) : 'заказов пока не было'
            }) +
            card({
                href: '#/catalog',
                label: 'Багет и паспарту',
                value: num(catalogTotal),
                note: 'в наличии <b>' + num(catalogInStock) + '</b>' + (catalogNoPrice ? ' · без цены <b>' + num(catalogNoPrice) + '</b>' : '')
            }) +
            card({
                href: '#/promo',
                label: 'Промокоды',
                value: num(data.promo.working),
                note: 'действуют сейчас из ' + num(data.promo.total)
            }) +
            card({
                href: '#/paintings',
                label: 'Картины',
                value: num(data.paintings.active),
                note: 'на сайте из ' + num(data.paintings.total)
            }) +
            card({
                href: '#/works',
                label: 'Каталог работ',
                value: num(data.works.works),
                note: 'фото в ' + num(data.works.categories) + ' ' + UI.plural(data.works.categories, 'категории', 'категориях', 'категориях')
            });

        var latest = data.latest.length ? data.latest.map(function (lead) {
            return '<a class="ov-lead" href="#/leads">' +
                '<span class="ov-lead-icon">' + channelIcon(lead.channel) + '</span>' +
                '<span class="ov-lead-body">' +
                '<span class="ov-lead-top"><b>' + UI.esc(lead.name) + '</b>' + (lead.is_new ? '<span class="ga-badge ga-badge--new">новая</span>' : '') + '</span>' +
                '<span class="ov-lead-text">' + UI.esc(lead.comment || lead.channel) + '</span>' +
                '</span>' +
                '<span class="ov-lead-date">' + UI.esc(UI.date(lead.created_at)) + '</span>' +
                '</a>';
        }).join('') : UI.emptyState('Заявок пока нет', '');

        var typeRows = TYPE_ORDER.filter(function (type) {
            return byType[type];
        }).map(function (type) {
            var row = byType[type];

            return '<tr>' +
                '<td><a class="ga-strong ov-type-link" href="#/catalog/' + type + '">' + TYPE_NAMES[type] + '</a></td>' +
                '<td class="t-num">' + num(row.total) + '</td>' +
                '<td class="t-num">' + num(row.in_stock) + '</td>' +
                '<td class="t-num' + (row.out_of_stock ? ' ov-warn' : '') + '">' + num(row.out_of_stock) + '</td>' +
                '<td class="t-num' + (row.no_price ? ' ov-warn' : '') + '">' + num(row.no_price) + '</td>' +
                '<td class="t-num">' + (row.avg_price ? UI.money(row.avg_price) : '—') + '</td>' +
                '</tr>';
        }).join('');

        var suppliers = data.suppliers.slice().sort(function (a, b) {
            return b.total - a.total;
        }).map(function (row) {
            return '<div class="ov-supplier">' +
                '<div class="ov-supplier-name">' + UI.esc(SUPPLIER_NAMES[row.company] || row.company) + '</div>' +
                '<div class="ga-muted">' + num(row.total) + ' ' + UI.plural(row.total, 'позиция', 'позиции', 'позиций') +
                (row.updated_at && row.company !== 'manual' ? ' · обновлено ' + UI.esc(UI.date(row.updated_at)) : '') + '</div>' +
                '</div>';
        }).join('');

        view.innerHTML = UI.pageHead({
            eyebrow: today(),
            title: greeting(),
            sub: leads.new_count
                ? 'Ждут ответа: ' + num(leads.new_count) + ' ' + UI.plural(leads.new_count, 'заявка', 'заявки', 'заявок') + '.'
                : 'Все заявки разобраны.',
            actions: '<a class="ga-btn ga-btn--ink" href="#/leads">' + UI.icon('inbox') + 'Разобрать заявки</a>'
        }) +
            '<div class="st-grid ov-cards">' + cards + '</div>' +
            '<div class="ov-columns">' +
            '<div class="ga-panel">' +
            '<div class="ga-panel-head"><div class="ga-panel-title">Последние заявки</div><a class="ga-link" href="#/leads">Все заявки ' + UI.icon('open') + '</a></div>' +
            '<div class="ov-leads">' + latest + '</div>' +
            '</div>' +
            '<div class="ov-stack">' +
            '<div class="ga-panel">' +
            '<div class="ga-panel-head"><div class="ga-panel-title">Каталог по типам</div><a class="ga-link" href="#/catalog">Открыть ' + UI.icon('open') + '</a></div>' +
            '<div class="ga-table-wrap"><table class="ga-table ov-table"><thead><tr><th>Тип</th><th class="t-num">Всего</th><th class="t-num">В наличии</th>' +
            '<th class="t-num">Нет</th><th class="t-num">Без цены</th><th class="t-num">Средняя цена</th></tr></thead><tbody>' + typeRows + '</tbody></table></div>' +
            '</div>' +
            '<div class="ga-panel">' +
            '<div class="ga-panel-head"><div class="ga-panel-title">Поставщики</div><a class="ga-link" href="#/suppliers">Обновить ' + UI.icon('open') + '</a></div>' +
            '<div class="ov-suppliers">' + suppliers + '</div>' +
            '</div>' +
            '</div>' +
            '</div>';
    }

    function load() {
        return UI.api(API).then(function (data) {
            lastData = data;
            UI.setCount('leads', data.leads.new_count);
            UI.setCount('orders', data.orders.new_count);
            return data;
        });
    }

    UI.route('overview', {
        title: 'Обзор',
        show: function (view) {
            if (lastData) {
                render(view, lastData);
            } else {
                renderSkeleton(view);
            }

            load().then(function (data) {
                if (UI.isActive('overview')) {
                    render(view, data);
                }
            }).catch(UI.showError);
        }
    });

    // Счётчики новых заявок в меню — сразу при открытии админки и раз в 2 минуты
    window.AdminOverview = {
        load: load,
        data: function () {
            return lastData;
        }
    };

    setInterval(function () {
        if (!document.hidden) {
            load().catch(function () {});
        }
    }, 120000);
})();
