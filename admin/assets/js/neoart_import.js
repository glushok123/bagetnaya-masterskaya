(function () {
    const R = 'request/neoart/';
    const $ = window.jQuery;

    const NeoartUI = {
        run_id: null,
        catalog: function () { return $('#neoartCatalog').val(); },

        setBar: function (sel, done, total) {
            const pct = total ? Math.round(done / total * 100) : 0;
            $(sel).css('width', pct + '%').text(pct + '%');
        },

        // Чанковый поллинг: дергаем endpoint пока done<total.
        poll: function (endpoint, baseParams, barSel, labelSel, labelText, onDone) {
            let offset = 0;
            const size = baseParams.size || 15;
            const step = () => {
                $.post(R + endpoint, Object.assign({}, baseParams, { offset: offset, size: size }))
                    .done((res) => {
                        if (res.error) { toastr.error(res.error); return; }
                        NeoartUI.setBar(barSel, res.done, res.total);
                        $(labelSel).text(labelText + ' ' + res.done + '/' + res.total +
                            (res.failed ? ' (ошибок: ' + res.failed + ')' : ''));
                        offset = res.next_offset;
                        if (res.done < res.total) { step(); } else { onDone && onDone(res); }
                    })
                    .fail(() => toastr.error('Сбой запроса ' + endpoint));
            };
            step();
        },

        startDownload: function () {
            const cat = NeoartUI.catalog();
            $('#neoartDlLabel').text('Скачивание: подготовка фида…');
            $.post(R + 'run_start.php', { catalog: cat }).done((res) => {
                if (res.error) { toastr.error(res.error); return; }
                NeoartUI.run_id = res.run_id;
                toastr.info('Фид: всего ' + res.total + ', новых ' + res.new + ', в каталоге ' + res.existing);
                NeoartUI.poll('run_download_chunk.php', { run_id: res.run_id, catalog: cat, size: 15 },
                    '#neoartDlBar', '#neoartDlLabel', 'Скачано', () => {
                        toastr.success('Скачивание завершено');
                        NeoartUI.loadErrors();
                    });
            }).fail(() => toastr.error('run_start сбой'));
        },

        loadErrors: function () { /* реализуется в Task 6/7 (панель ошибок) */ },
        loadGrid: function () { /* реализуется в Task 7 */ },
    };

    $(function () {
        $('#neoartRunDownload').on('click', NeoartUI.startDownload);
        // #neoartRunCut — Task 6; #neoartRefreshGrid/#neoartFilters/#neoartSearch — Task 7
    });

    window.NeoartUI = NeoartUI;
})();
