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

        startCut: function () {
            const cat = NeoartUI.catalog();
            $('#neoartCutLabel').text('Нарезка: старт…');
            NeoartUI.poll('cut_chunk.php', { catalog: cat, size: 8 },
                '#neoartCutBar', '#neoartCutLabel', 'Нарезано', (res) => {
                    toastr.success('Нарезка завершена (флагов: ' + (res.flagged || 0) + ')');
                    NeoartUI.loadGrid && NeoartUI.loadGrid();
                });
        },

        loadErrors: function () {
            $.post(R + 'errors_list.php', { catalog: NeoartUI.catalog() }).done((res) => {
                const items = (res && res.items) || [];
                $('#neoartErrorsCount').text(items.length);
                if (!items.length) { $('#neoartErrorsCard').addClass('d-none'); return; }
                $('#neoartErrorsCard').removeClass('d-none');
                const $box = $('#neoartErrors').empty();
                items.forEach(e => {
                    $('<div class="small">')
                      .append($('<b>').text(e.vendor || '—'))
                      .append(document.createTextNode(' [' + e.stage + '] ' + (e.message || '')))
                      .appendTo($box);
                });
            });
        },

        _filter: 'all',

        esc: function (s) {
            return String(s == null ? '' : s)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        },

        cardHtml: function (it) {
            const esc = NeoartUI.esc;
            const badge = it.in_catalog == 1
                ? '<span class="badge bg-secondary">в каталоге ' + esc(it.catalog_publicvendor || '') + '</span>'
                : (it.cut_status === 'auto_flagged' || it.cut_status === 'error'
                    ? '<span class="badge bg-warning text-dark">правка: ' + esc(it.cut_flags || '') + '</span>'
                    : (it.review_status === 'published'
                        ? '<span class="badge bg-success">опубликован</span>'
                        : '<span class="badge bg-primary">готов</span>'));
            const img = (u, h) => u ? '<img src="' + esc(u) + '" style="height:' + h + 'px;border:1px solid #ddd">' : '<span class="text-muted small">нет</span>';
            const cw = 'width:100%;height:70px;background:url(' + esc(it.imgconst_url || '') + ') repeat-x;border:1px solid #ddd';
            const canApprove = it.in_catalog != 1 && it.listimg_url && it.imgconst_url && it.review_status !== 'published';
            return '' +
              '<div class="col-6 col-md-4 col-xl-3"><div class="card neoart-card h-100" data-id="' + it.id + '">' +
                '<div class="card-body p-2">' +
                  '<div class="d-flex justify-content-between align-items-center mb-1">' +
                    '<div class="form-check"><input class="form-check-input neoart-select" type="checkbox" ' + (canApprove ? '' : 'disabled') + '></div>' +
                    '<div class="small"><b>' + esc(it.vendor) + '</b></div>' + badge +
                  '</div>' +
                  '<div class="row g-1 mb-1">' +
                    '<div class="col-6 text-center"><div class="small text-muted">каталог</div>' + img(it.listimg_url, 60) + '</div>' +
                    '<div class="col-6 text-center"><div class="small text-muted">исходник</div>' + img(it.raw_url, 60) + '</div>' +
                  '</div>' +
                  '<div class="small text-muted">конструктор (repeat-x):</div><div style="' + cw + '"></div>' +
                  '<div class="small mt-1">Ш ' + it.width_mm + ' / без чт ' + it.widthwithout_mm + ' мм · ' + it.price_final + '₽ · ост ' + it.storage + '</div>' +
                  '<div class="d-flex gap-1 mt-2">' +
                    '<button class="btn btn-sm btn-outline-primary neoart-edit">Править</button>' +
                    '<button class="btn btn-sm btn-success neoart-approve" ' + (canApprove ? '' : 'disabled') + '>Одобрить</button>' +
                    '<button class="btn btn-sm btn-outline-danger neoart-reject">✕</button>' +
                  '</div>' +
                '</div>' +
              '</div></div>';
        },

        loadGrid: function () {
            $.post(R + 'items_list.php', { catalog: NeoartUI.catalog(), filter: NeoartUI._filter, query: $('#neoartSearch').val() })
                .done((res) => {
                    const items = (res && res.items) || [];
                    $('#neoartGrid').html(items.map(NeoartUI.cardHtml).join('') || '<div class="text-muted">Пусто</div>');
                });
        },
    };

    $(function () {
        $('#neoartRunDownload').on('click', NeoartUI.startDownload);
        $('#neoartRunCut').on('click', NeoartUI.startCut);
        $('#neoartRefreshGrid').on('click', NeoartUI.loadGrid);
        $('#neoartFilters').on('click', 'button[data-filter]', function () {
            $('#neoartFilters button').removeClass('active'); $(this).addClass('active');
            NeoartUI._filter = $(this).data('filter'); NeoartUI.loadGrid();
        });
        let t; $('#neoartSearch').on('input', function () { clearTimeout(t); t = setTimeout(NeoartUI.loadGrid, 300); });
        $('#neoartCatalog').on('change', NeoartUI.loadGrid);
    });

    window.NeoartUI = NeoartUI;
})();
