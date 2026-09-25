/* Поставщики: когда обновлялись цены и остатки, ручной запуск обновления с живым журналом. */
(function () {
    'use strict';

    var UI = window.AdminUI;

    var SUPPLIERS = [
        {
            key: 'neoart',
            name: 'Neoart',
            source: 'XML-фиды: дерево, пластик, алюминий, паспарту',
            script: '/admin/request/updateCatalogBySiteNeoart.php'
        },
        {
            key: 'interquadrum',
            name: 'Interquadrum',
            source: 'Выгрузки XLSX: дерево, пластик, паспарту',
            script: '/admin/request/updateCatalogBySiteInterquadrum.php'
        },
        {
            key: 'lion',
            name: 'Lion',
            source: 'Общая выгрузка XLSX',
            script: '/admin/request/updateCatalogBySiteLion.php'
        }
    ];

    var view;

    function stats() {
        var data = window.AdminOverview && window.AdminOverview.data();
        var map = {};

        ((data && data.suppliers) || []).forEach(function (row) {
            map[row.company] = row;
        });

        return map;
    }

    function render() {
        var map = stats();

        view.innerHTML = UI.pageHead({
            eyebrow: 'Каталог',
            title: 'Поставщики',
            sub: 'Цены и остатки обновляются автоматически каждый день в 8:00, 12:00 и 16:00. Если нужно раньше — запустите обновление вручную.'
        }) +
            '<div class="sp-grid">' + SUPPLIERS.map(function (supplier) {
                var row = map[supplier.key];

                return '<div class="ga-panel sp-card">' +
                    '<div class="sp-card-top">' +
                    '<div><div class="sp-name">' + supplier.name + '</div><div class="ga-muted">' + supplier.source + '</div></div>' +
                    '<span class="sp-mark" aria-hidden="true">' + UI.icon('refresh') + '</span>' +
                    '</div>' +
                    '<dl class="sp-facts">' +
                    '<div><dt>Позиций в каталоге</dt><dd>' + (row ? row.total.toLocaleString('ru-RU') : '—') + '</dd></div>' +
                    '<div><dt>Последнее обновление</dt><dd>' + (row && row.updated_at ? UI.esc(UI.date(row.updated_at)) : '—') + '</dd></div>' +
                    '</dl>' +
                    '<button type="button" class="ga-btn ga-btn--ink ga-btn--block" data-run="' + supplier.key + '">' + UI.icon('refresh') + 'Обновить сейчас</button>' +
                    '</div>';
            }).join('') + '</div>' +
            '<p class="sp-note ga-muted">' + UI.icon('clock') + 'Обновление меняет только цены и остатки у совпавших артикулов. Позиции с отметкой «фикс. цена» сохраняют свою цену.</p>';
    }

    function run(supplier) {
        UI.confirm({
            title: 'Обновить ' + supplier.name + '?',
            html: 'Скачаем свежие цены и остатки поставщика и обновим каталог. Это займёт до 5 минут — окно журнала не закрывайте до конца.',
            ok: 'Запустить обновление',
            danger: false
        }).then(function (ok) {
            if (!ok) {
                return;
            }

            var started = Date.now();
            var dialog = UI.dialog({
                size: 'xl',
                html: '<div class="ga-eyebrow">Поставщики</div>' +
                    '<h3 class="ga-modal-title">Обновление ' + supplier.name + '</h3>' +
                    '<div class="sp-log-status" data-role="status"><span class="sp-spinner" aria-hidden="true"></span><span>Идёт обновление… не закрывайте окно</span></div>' +
                    '<iframe class="sp-log" data-role="log" title="Журнал обновления"></iframe>' +
                    '<div class="ga-modal-actions"><button type="button" class="ga-btn ga-btn--ink" data-ga-close>Закрыть</button></div>'
            });

            var frame = dialog.card.querySelector('[data-role="log"]');
            var status = dialog.card.querySelector('[data-role="status"]');
            var follow = setInterval(function () {
                try {
                    var doc = frame.contentDocument;
                    doc.documentElement.scrollTop = doc.documentElement.scrollHeight;
                    doc.body.scrollTop = doc.body.scrollHeight;
                } catch (e) {
                    // журнал ещё не начался
                }
            }, 700);

            frame.addEventListener('load', function () {
                clearInterval(follow);

                var seconds = Math.round((Date.now() - started) / 1000);

                status.classList.add('is-done');
                status.innerHTML = UI.icon('check') + '<span>Готово за ' + seconds + ' с. Журнал ниже.</span>';
                UI.notify('success', supplier.name + ': обновление завершено');

                if (window.AdminOverview) {
                    window.AdminOverview.load().then(function () {
                        if (UI.isActive('suppliers')) {
                            render();
                        }
                    }).catch(function () {});
                }
            }, {once: true});

            frame.src = supplier.script + '?manual=' + started;
        });
    }

    UI.route('suppliers', {
        title: 'Поставщики',
        init: function (section) {
            view = section;

            view.addEventListener('click', function (event) {
                var button = event.target.closest('[data-run]');

                if (button) {
                    run(SUPPLIERS.find(function (supplier) {
                        return supplier.key === button.dataset.run;
                    }));
                }
            });
        },
        show: function () {
            render();

            if (window.AdminOverview) {
                window.AdminOverview.load().then(function () {
                    if (UI.isActive('suppliers')) {
                        render();
                    }
                }).catch(UI.showError);
            }
        }
    });
})();
