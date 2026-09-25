/* Готовые картины: витрина карточек, редактор с фотографиями, показ на сайте, удаление. */
(function () {
    'use strict';

    var UI = window.AdminUI;
    var API = '/admin/request/api/paintings.php';

    var state = {items: [], loaded: false, search: '', show: 'all'};
    var view;
    var el = {};

    function findItem(id) {
        return state.items.find(function (item) {
            return String(item.id) === String(id);
        }) || null;
    }

    function sizeLabel(size) {
        return String(size || '').replace(/\s*[*xх×]\s*/gi, ' × ');
    }

    function filtered() {
        var query = state.search.trim().toLowerCase();

        return state.items.filter(function (item) {
            if (state.show === 'on' && !item.active) {
                return false;
            }
            if (state.show === 'off' && item.active) {
                return false;
            }

            return !query || (item.name + ' ' + item.author + ' ' + item.id).toLowerCase().indexOf(query) !== -1;
        });
    }

    function mount(section) {
        view = section;
        view.innerHTML = UI.pageHead({
            eyebrow: 'Сайт',
            title: 'Картины',
            sub: 'Готовые картины на витрине сайта.',
            subId: 'ptSub',
            actions: '<button type="button" class="ga-btn ga-btn--ink" data-role="add">' + UI.icon('plus') + 'Добавить картину</button>'
        }) +
            '<div class="ga-toolbar">' +
            '<div class="ga-toolbar-left"><div class="ga-chips" data-role="show"></div></div>' +
            '<label class="ga-search">' + UI.icon('search') + '<input type="search" data-role="search" placeholder="Название или автор" aria-label="Поиск картин"></label>' +
            '</div>' +
            '<div class="pt-grid" data-role="grid"></div>';

        el.grid = view.querySelector('[data-role="grid"]');
        el.show = view.querySelector('[data-role="show"]');
        el.search = view.querySelector('[data-role="search"]');

        view.querySelector('[data-role="add"]').addEventListener('click', function () {
            openEditor(null);
        });

        el.search.addEventListener('input', UI.debounce(function () {
            state.search = el.search.value;
            renderGrid();
        }, 120));

        el.show.addEventListener('click', function (event) {
            var chip = event.target.closest('[data-show]');

            if (chip) {
                state.show = chip.dataset.show;
                render();
            }
        });

        el.grid.addEventListener('click', function (event) {
            var card = event.target.closest('[data-id]');

            if (!card) {
                return;
            }

            if (event.target.closest('[data-role="delete"]')) {
                remove(findItem(card.dataset.id));
            } else if (!event.target.closest('.ga-switch')) {
                openEditor(findItem(card.dataset.id));
            }
        });

        el.grid.addEventListener('change', function (event) {
            var toggle = event.target.closest('[data-role="active"]');

            if (toggle) {
                toggleActive(findItem(toggle.closest('[data-id]').dataset.id), toggle);
            }
        });
    }

    function card(item, index) {
        var image = item.images[0];

        return '<article class="pt-card' + (item.active ? '' : ' is-off') + '" data-id="' + item.id + '" style="--i:' + Math.min(index, 20) + '">' +
            '<div class="pt-mat">' + (image ? '<img src="' + UI.esc(image.url) + '" alt="" loading="lazy" onerror="this.parentNode.classList.add(\'is-broken\')">' : '<span class="pt-noimg">Нет фото</span>') +
            (item.images.length > 1 ? '<span class="pt-count">' + UI.icon('picture') + item.images.length + '</span>' : '') +
            '</div>' +
            '<div class="pt-body">' +
            '<h3 class="pt-name">' + UI.esc(item.name) + '</h3>' +
            '<div class="ga-muted">' + UI.esc(item.author) + '</div>' +
            '<div class="pt-meta"><span>' + UI.esc(sizeLabel(item.size)) + ' мм</span><b>' + UI.money(item.price) + '</b></div>' +
            '</div>' +
            '<div class="pt-foot">' +
            '<label class="ga-switch ga-switch--sm"><input type="checkbox" data-role="active"' + (item.active ? ' checked' : '') + '>' +
            '<span class="ga-switch-track"></span><span class="ga-switch-label">' + (item.active ? 'На сайте' : 'Скрыта') + '</span></label>' +
            '<span class="pt-actions">' +
            '<button type="button" class="ga-icon-btn" title="Изменить" aria-label="Изменить">' + UI.icon('edit') + '</button>' +
            '<button type="button" class="ga-icon-btn ga-icon-btn--danger" data-role="delete" title="Удалить" aria-label="Удалить">' + UI.icon('trash') + '</button>' +
            '</span></div>' +
            '</article>';
    }

    function render() {
        var on = state.items.filter(function (item) {
            return item.active;
        }).length;

        el.show.innerHTML = [['all', 'Все', state.items.length], ['on', 'На сайте', on], ['off', 'Скрытые', state.items.length - on]].map(function (chip) {
            return '<button type="button" class="ga-chip-btn' + (state.show === chip[0] ? ' is-active' : '') + '" data-show="' + chip[0] + '">' +
                chip[1] + ' <span class="ga-seg-count">' + chip[2] + '</span></button>';
        }).join('');

        var sub = document.getElementById('ptSub');

        if (sub && state.loaded) {
            sub.textContent = state.items.length + ' ' + UI.plural(state.items.length, 'картина', 'картины', 'картин') + ' · на сайте ' + on;
        }

        renderGrid();
    }

    function renderGrid() {
        if (!state.loaded) {
            el.grid.innerHTML = new Array(7).join('<div class="pt-card"><div class="pt-mat"><span class="ga-skel" style="position:absolute;inset:0"></span></div>' +
                '<div class="pt-body"><span class="ga-skel" style="height:18px;width:70%"></span><span class="ga-skel" style="height:12px;width:45%;margin-top:8px"></span></div></div>');
            return;
        }

        var list = filtered();

        el.grid.innerHTML = list.length
            ? list.map(card).join('')
            : UI.emptyState(state.items.length ? 'Ничего не найдено' : 'Картин пока нет', state.items.length ? 'Измените поиск или фильтр' : 'Добавьте первую картину на витрину');
    }

    function load(openId) {
        return UI.api(API, {action: 'list'}).then(function (json) {
            state.items = json.data || [];
            state.loaded = true;
            render();

            if (openId) {
                var item = findItem(openId);

                if (item) {
                    openEditor(item);
                } else {
                    UI.notify('warning', 'Картина №' + openId + ' не найдена — возможно, её удалили');
                }
            }
        }).catch(function (error) {
            state.loaded = true;
            render();
            UI.showError(error);
        });
    }

    function saveRequest(item, extra) {
        var data = extra instanceof FormData ? extra : new FormData();

        data.append('action', 'save');

        if (item) {
            ['name', 'author', 'size', 'price'].forEach(function (key) {
                if (!data.has(key)) {
                    data.append(key, item[key]);
                }
            });
            data.append('id', item.id);
        }

        return UI.api(API, data);
    }

    function replaceItem(saved) {
        var index = state.items.findIndex(function (item) {
            return String(item.id) === String(saved.id);
        });

        if (index === -1) {
            state.items.unshift(saved);
        } else {
            state.items[index] = saved;
        }
    }

    function toggleActive(item, toggle) {
        var data = new FormData();
        data.append('active', toggle.checked ? '1' : '0');

        saveRequest(item, data).then(function (json) {
            replaceItem(json.data);
            render();
            UI.notify('success', json.data.active ? '«' + json.data.name + '» снова на сайте' : '«' + json.data.name + '» скрыта с сайта');
        }).catch(function (error) {
            toggle.checked = !toggle.checked;
            UI.showError(error);
        });
    }

    function remove(item, onDone) {
        if (!item) {
            return;
        }

        UI.confirm({
            title: 'Удалить картину?',
            html: '<b>«' + UI.esc(item.name) + '»</b> пропадёт с витрины, фотографии будут удалены <b>безвозвратно</b>. Чтобы просто убрать её с сайта — выключите «На сайте».',
            ok: 'Удалить картину'
        }).then(function (ok) {
            if (!ok) {
                return;
            }

            UI.api(API, {action: 'delete', id: item.id}).then(function () {
                state.items = state.items.filter(function (entry) {
                    return entry.id !== item.id;
                });
                render();
                UI.notify('success', 'Картина удалена');

                if (onDone) {
                    onDone();
                }
            }).catch(UI.showError);
        });
    }

    // ---------- Редактор ----------

    function openEditor(item) {
        var isNew = !item;
        var removeIds = new Set();
        var newFiles = [];

        var dialog = UI.dialog({
            size: 'wide',
            focus: isNew ? '[name="name"]' : null,
            html: '<div class="pt-editor">' +
                '<div class="pt-editor-media">' +
                '<div class="ga-field-label">Фотографии</div>' +
                '<div class="pt-photos" data-role="photos"></div>' +
                '<p class="ga-field-hint">Первое фото — обложка на витрине. JPG или PNG.</p>' +
                '</div>' +
                '<form class="pt-editor-form" data-role="form" novalidate>' +
                '<div class="ga-eyebrow">' + (isNew ? 'Новая картина' : 'Картина №' + item.id) + '</div>' +
                '<h3 class="ga-modal-title">' + (isNew ? 'Добавить на витрину' : UI.esc(item.name)) + '</h3>' +
                '<div class="ga-form-grid">' +
                '<label class="ga-field ga-span-all"><span class="ga-field-label">Название</span><input class="ga-input" name="name" value="' + UI.esc(item ? item.name : '') + '"></label>' +
                '<label class="ga-field ga-span-all"><span class="ga-field-label">Автор</span><input class="ga-input" name="author" value="' + UI.esc(item ? item.author : '') + '"></label>' +
                '<label class="ga-field"><span class="ga-field-label">Размер, мм</span><input class="ga-input" name="size" placeholder="600*450" value="' + UI.esc(item ? item.size : '') + '"></label>' +
                '<label class="ga-field"><span class="ga-field-label">Цена</span><span class="ga-input-group"><input class="ga-input" type="number" min="0" name="price" value="' + UI.esc(item ? item.price : '') + '"><span class="ga-input-suffix">₽</span></span></label>' +
                '<label class="ga-switch ga-span-all"><input type="checkbox" name="active"' + (!item || item.active ? ' checked' : '') + '><span class="ga-switch-track"></span><span class="ga-switch-label">Показывать на сайте</span></label>' +
                '</div>' +
                '<div class="ga-modal-actions' + (isNew ? '' : ' ga-modal-actions--split') + '">' +
                (isNew ? '' : '<button type="button" class="ga-btn ga-btn--danger-ghost" data-role="delete">' + UI.icon('trash') + 'Удалить</button>') +
                '<div class="ga-modal-actions-group"><button type="button" class="ga-btn ga-btn--ghost" data-ga-close>Отмена</button>' +
                '<button type="submit" class="ga-btn ga-btn--ink" data-role="save">' + (isNew ? 'Добавить' : 'Сохранить') + '</button></div>' +
                '</div>' +
                '</form>' +
                '</div>',
            onClose: function () {
                newFiles.forEach(function (entry) {
                    URL.revokeObjectURL(entry.url);
                });
            }
        });

        var photos = dialog.card.querySelector('[data-role="photos"]');
        var form = dialog.card.querySelector('[data-role="form"]');

        function renderPhotos() {
            var existing = item ? item.images.map(function (image) {
                var removed = removeIds.has(image.id);

                return '<div class="pt-photo' + (removed ? ' is-removed' : '') + '" data-image="' + image.id + '">' +
                    '<img src="' + UI.esc(image.url) + '" alt="">' +
                    '<button type="button" class="pt-photo-btn" data-role="toggle-photo" title="' + (removed ? 'Вернуть' : 'Убрать фото') + '">' +
                    UI.icon(removed ? 'refresh' : 'x') + '</button>' +
                    (removed ? '<span class="pt-photo-note">будет удалено</span>' : '') +
                    '</div>';
            }).join('') : '';

            var added = newFiles.map(function (entry, index) {
                return '<div class="pt-photo is-new" data-new="' + index + '"><img src="' + entry.url + '" alt="">' +
                    '<button type="button" class="pt-photo-btn" data-role="drop-new" title="Не добавлять">' + UI.icon('x') + '</button>' +
                    '<span class="pt-photo-note">новое</span></div>';
            }).join('');

            photos.innerHTML = existing + added +
                '<label class="pt-photo pt-photo-add">' + UI.icon('plus') + '<span>Добавить фото</span>' +
                '<input type="file" accept=".jpg,.jpeg,.png,image/jpeg,image/png" multiple data-role="add-photo"></label>';
        }

        photos.addEventListener('click', function (event) {
            var toggle = event.target.closest('[data-role="toggle-photo"]');
            var dropNew = event.target.closest('[data-role="drop-new"]');

            if (toggle) {
                var id = parseInt(toggle.closest('[data-image]').dataset.image, 10);

                if (removeIds.has(id)) {
                    removeIds.delete(id);
                } else {
                    removeIds.add(id);
                }
                renderPhotos();
            } else if (dropNew) {
                var index = parseInt(dropNew.closest('[data-new]').dataset.new, 10);
                URL.revokeObjectURL(newFiles[index].url);
                newFiles.splice(index, 1);
                renderPhotos();
            }
        });

        photos.addEventListener('change', function (event) {
            if (event.target.closest('[data-role="add-photo"]')) {
                Array.prototype.forEach.call(event.target.files, function (file) {
                    if (/^image\/(jpeg|png)$/i.test(file.type) || /\.(jpe?g|png)$/i.test(file.name)) {
                        newFiles.push({file: file, url: URL.createObjectURL(file)});
                    } else {
                        UI.notify('warning', file.name + ': нужен JPG или PNG');
                    }
                });
                renderPhotos();
            }
        });

        renderPhotos();

        var deleteButton = dialog.card.querySelector('[data-role="delete"]');

        if (deleteButton) {
            deleteButton.addEventListener('click', function () {
                remove(item, dialog.close);
            });
        }

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            var required = ['name', 'author', 'size', 'price'];
            var missing = required.filter(function (name) {
                return !form[name].value.trim();
            });

            form.querySelectorAll('.is-invalid').forEach(function (input) {
                input.classList.remove('is-invalid');
            });
            missing.forEach(function (name) {
                form[name].classList.add('is-invalid');
            });

            if (missing.length) {
                UI.notify('warning', 'Заполните название, автора, размер и цену');
                return;
            }

            var data = new FormData();

            required.forEach(function (name) {
                data.append(name, form[name].value.trim());
            });
            data.append('active', form.active.checked ? '1' : '0');
            newFiles.forEach(function (entry) {
                data.append('images[]', entry.file, entry.file.name);
            });
            removeIds.forEach(function (id) {
                data.append('remove_images[]', id);
            });

            var submit = dialog.card.querySelector('[data-role="save"]');
            submit.disabled = true;

            saveRequest(item, data).then(function (json) {
                replaceItem(json.data);
                render();
                dialog.close();
                UI.notify('success', isNew ? 'Картина добавлена' : 'Изменения сохранены');
            }).catch(function (error) {
                submit.disabled = false;
                UI.showError(error);
            });
        });
    }

    UI.route('paintings', {
        title: 'Картины',
        init: mount,
        show: function (section, params) {
            if (!state.loaded) {
                render();
            }

            load(params[0]);
        }
    });
})();
