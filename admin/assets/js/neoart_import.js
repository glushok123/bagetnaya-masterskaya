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
            $('#neoartDlWrap').removeClass('d-none');
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
            $('#neoartCutWrap').removeClass('d-none');
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

        loadGrid: function () {
            $.post(R + 'items_list.php', { catalog: NeoartUI.catalog(), filter: NeoartUI._filter, query: $('#neoartSearch').val() })
                .done((res) => {
                    const items = (res && res.items) || [];
                    $('#neoartGrid').html(items.map(NeoartUI.cardHtml).join('') || '<div class="text-muted">Пусто</div>');
                });
        },

        _edit: { id: null, item: null, cropper: null, mode: 'listimg' },

        openEdit: function (id) {
            $.post(R + 'item_get.php', { id: id }).done((res) => {
                const it = res.item; NeoartUI._edit.id = id; NeoartUI._edit.item = it;
                $('#neoartEditVendor').text(it.vendor);
                $('#neoartPrevList').attr('src', it.listimg_url || '');
                $('#neoartPrevConst').css('background', it.imgconst_url ? 'url(' + it.imgconst_url + ') repeat-x' : '');
                const esc = NeoartUI.esc;
                $('#neoartEditInfo').html(
                    'Ширина ' + esc(it.width_mm) + ' / без чт ' + esc(it.widthwithout_mm) + ' мм<br>' +
                    'Цена ' + esc(it.price_final) + '₽ · остаток ' + esc(it.storage) + '<br>' +
                    'Секция: ' + esc(it.section_name || '—') + '<br>' +
                    'Флаги: ' + esc(it.cut_flags || '—')
                );
                new bootstrap.Modal(document.getElementById('neoartEditModal')).show();
                NeoartUI.setMode('listimg', it.raw_url);
            });
        },

        setMode: function (mode, rawUrl) {
            NeoartUI._edit.mode = mode;
            $('#neoartModeList').toggleClass('active', mode === 'listimg');
            $('#neoartModeConst').toggleClass('active', mode === 'imgconst');
            const img = document.getElementById('neoartCropImg');
            img.src = rawUrl || NeoartUI._edit.item.raw_url;
            if (NeoartUI._edit.cropper) NeoartUI._edit.cropper.destroy();
            img.onload = () => {
                NeoartUI._edit.cropper = new Cropper(img, {
                    viewMode: 1, autoCropArea: 0.5,
                    aspectRatio: mode === 'listimg' ? 150 / 100 : NaN,
                });
            };
            if (img.complete) img.onload();
        },

        saveCrop: function () {
            const c = NeoartUI._edit.cropper; if (!c) return;
            const d = c.getData(true); // координаты в пикселях оригинала
            $.post(R + 'item_save_crop.php', {
                id: NeoartUI._edit.id, which: NeoartUI._edit.mode,
                x: d.x, y: d.y, w: d.width, h: d.height,
            }).done((res) => {
                if (res.error) { toastr.error(res.error); return; }
                toastr.success('Сохранено');
                if (NeoartUI._edit.mode === 'listimg') $('#neoartPrevList').attr('src', res.url);
                else $('#neoartPrevConst').css('background', 'url(' + res.url + ') repeat-x');
                NeoartUI.loadGrid();
            });
        },

        upload: function (which, fileInput) {
            const fd = new FormData(); fd.append('id', NeoartUI._edit.id); fd.append('which', which); fd.append('file', fileInput.files[0]);
            $.ajax({ url: R + 'item_upload.php', method: 'POST', data: fd, processData: false, contentType: false })
                .done((res) => {
                    if (res.error) { toastr.error(res.error); return; }
                    toastr.success('Загружено');
                    if (which === 'raw') NeoartUI.setMode(NeoartUI._edit.mode, res.url);
                    else if (which === 'listimg') $('#neoartPrevList').attr('src', res.url);
                    else $('#neoartPrevConst').css('background', 'url(' + res.url + ') repeat-x');
                    NeoartUI.loadGrid();
                });
        },

        resetCut: function () {
            $.post(R + 'item_reset.php', { id: NeoartUI._edit.id }).done((res) => {
                toastr.info('Пере-нарезано: ' + res.cut_status + ' ' + (res.cut_flags || ''));
                NeoartUI.openEdit(NeoartUI._edit.id); NeoartUI.loadGrid();
            });
        },

        approve: function (ids) {
            $.post(R + 'item_approve.php', { ids: ids.join(',') }).done((res) => {
                const results = (res && res.results) || [];
                const ok = results.filter(r => r.ok).length;
                const bad = results.filter(r => !r.ok);
                if (ok) toastr.success('Опубликовано: ' + ok);
                bad.forEach(b => toastr.error('id ' + b.id + ': ' + b.error));
                NeoartUI.loadGrid();
            }).fail(() => toastr.error('approve сбой'));
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

        $('#neoartGrid').on('click', '.neoart-card', function (e) {
            if ($(e.target).closest('.neoart-approve, .neoart-reject, .neoart-select').length) return;
            NeoartUI.openEdit($(this).data('id'));
        });
        $('#neoartGrid').on('click', '.neoart-approve, .neoart-reject', function (e) { e.stopPropagation(); });
        $('#neoartGrid').on('click', '.neoart-select', function (e) { e.stopPropagation(); });
        $('#neoartModeList').on('click', () => NeoartUI.setMode('listimg'));
        $('#neoartModeConst').on('click', () => NeoartUI.setMode('imgconst'));
        $('#neoartCropSave').on('click', NeoartUI.saveCrop);
        $('#neoartResetCut').on('click', NeoartUI.resetCut);
        $('#neoartUpRaw').on('change', function () { NeoartUI.upload('raw', this); });
        $('#neoartUpList').on('change', function () { NeoartUI.upload('listimg', this); });
        $('#neoartUpConst').on('change', function () { NeoartUI.upload('imgconst', this); });

        $('#neoartGrid').on('click', '.neoart-approve', function () {
            NeoartUI.approve([$(this).closest('.neoart-card').data('id')]);
        });
        $('#neoartGrid').on('click', '.neoart-reject', function () {
            const id = $(this).closest('.neoart-card').data('id');
            $.post(R + 'item_reject.php', { id: id }).done(() => { toastr.info('Отклонён'); NeoartUI.loadGrid(); });
        });
        $('#neoartApproveSelected').on('click', function () {
            const ids = $('#neoartGrid .neoart-select:checked').map(function () {
                return $(this).closest('.neoart-card').data('id');
            }).get();
            if (!ids.length) { toastr.warning('Ничего не выбрано'); return; }
            NeoartUI.approve(ids);
        });
    });

    window.NeoartUI = NeoartUI;
})();
