/* Общий набор админки: запросы, уведомления, окна, подтверждения, навигация по разделам. */
(function () {
    'use strict';

    var ICONS = {
        home: '<path d="M4 11l8-7 8 7"/><path d="M6 9.5V20h12V9.5"/><path d="M10 20v-6h4v6"/>',
        frame: '<rect x="3.5" y="3.5" width="17" height="17" rx="1.5"/><rect x="7.5" y="7.5" width="9" height="9"/><path d="M3.5 3.5l4 4M20.5 3.5l-4 4M3.5 20.5l4-4M20.5 20.5l-4-4"/>',
        download: '<path d="M12 4v11M7 10l5 5 5-5M5 20h14"/>',
        upload: '<path d="M12 16V4M7 9l5-5 5 5M5 20h14"/>',
        refresh: '<path d="M20 11a8 8 0 0 0-14.6-4.5L4 8"/><path d="M4 4v4h4"/><path d="M4 13a8 8 0 0 0 14.6 4.5L20 16"/><path d="M20 20v-4h-4"/>',
        inbox: '<path d="M4 13l2.5-8h11L20 13"/><path d="M4 13v6h16v-6h-5l-1 2h-4l-1-2H4z"/>',
        bag: '<path d="M6 8h12l-1 12H7L6 8z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>',
        grid: '<rect x="4" y="4" width="7" height="7" rx="1.5"/><rect x="13" y="4" width="7" height="7" rx="1.5"/><rect x="4" y="13" width="7" height="7" rx="1.5"/><rect x="13" y="13" width="7" height="7" rx="1.5"/>',
        picture: '<rect x="3.5" y="5" width="17" height="14" rx="1.5"/><path d="M3.5 16l5-5 4 4 3-3 5 5"/><circle cx="15.5" cy="9" r="1.5"/>',
        ticket: '<path d="M4 8a2 2 0 0 0 0 4v4h16v-4a2 2 0 0 1 0-4V4H4v4z" transform="translate(0 2)"/><path d="M14 6v12" stroke-dasharray="2 2.5"/>',
        logout: '<path d="M14 5h5v14h-5"/><path d="M10 8l-4 4 4 4M6 12h10"/>',
        menu: '<path d="M4 7h16M4 12h16M4 17h16"/>',
        plus: '<path d="M12 5v14M5 12h14"/>',
        edit: '<path d="M4 20h4L19 9l-4-4L4 16v4z"/><path d="M13.5 6.5l4 4"/>',
        open: '<path d="M14 5h5v5"/><path d="M19 5l-8 8"/><path d="M18 14v5H5V6h5"/>',
        trash: '<path d="M4 7h16"/><path d="M9 7V4.5h6V7"/><path d="M6.5 7l1 13h9l1-13"/><path d="M10 11v5.5M14 11v5.5"/>',
        search: '<circle cx="11" cy="11" r="6.5"/><path d="M20 20l-4-4"/>',
        x: '<path d="M6 6l12 12M18 6L6 18"/>',
        check: '<path d="M5 12.5l4.5 4.5L19 7.5"/>',
        phone: '<path d="M6.5 4h3l1.5 4-2 1.2a11 11 0 0 0 5.8 5.8L16 13l4 1.5v3A2.5 2.5 0 0 1 17.5 20 14 14 0 0 1 4 6.5 2.5 2.5 0 0 1 6.5 4z"/>',
        chat: '<path d="M5 5h14v10H10l-4 4v-4H5z"/>',
        copy: '<rect x="8" y="8" width="11" height="11" rx="2"/><path d="M5 15V6a1 1 0 0 1 1-1h9"/>',
        spark: '<path d="M12 4v4M12 16v4M4 12h4M16 12h4M6.5 6.5l2.5 2.5M15 15l2.5 2.5M6.5 17.5L9 15M15 9l2.5-2.5"/>',
        clock: '<circle cx="12" cy="12" r="8"/><path d="M12 8v4l3 2"/>'
    };

    function icon(name, extraClass) {
        return '<svg class="ga-ico' + (extraClass ? ' ' + extraClass : '') + '" viewBox="0 0 24 24" aria-hidden="true">' + (ICONS[name] || '') + '</svg>';
    }

    function esc(value) {
        return String(value === null || value === undefined ? '' : value).replace(/[&<>"']/g, function (char) {
            return {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'}[char];
        });
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

    function money(value) {
        var number = parseInt(value, 10) || 0;
        return number.toLocaleString('ru-RU').replace(/,/g, ' ') + ' ₽';
    }

    var MONTHS = ['янв', 'фев', 'мар', 'апр', 'мая', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'];

    function parseDate(value) {
        if (!value) {
            return null;
        }

        var parts = String(value).match(/(\d{4})-(\d{2})-(\d{2})(?:[ T](\d{2}):(\d{2}))?/);

        return parts ? new Date(+parts[1], +parts[2] - 1, +parts[3], +(parts[4] || 0), +(parts[5] || 0)) : null;
    }

    // «сегодня, 14:05», «вчера, 09:12», «12 сен», «12 сен 2024»
    function date(value, withTime) {
        var d = parseDate(value);

        if (!d) {
            return '—';
        }

        var now = new Date();
        var today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
        var day = new Date(d.getFullYear(), d.getMonth(), d.getDate());
        var diff = Math.round((today - day) / 86400000);
        var time = ('0' + d.getHours()).slice(-2) + ':' + ('0' + d.getMinutes()).slice(-2);
        var label;

        if (diff === 0) {
            label = 'сегодня';
        } else if (diff === 1) {
            label = 'вчера';
        } else {
            label = d.getDate() + ' ' + MONTHS[d.getMonth()] + (d.getFullYear() !== now.getFullYear() ? ' ' + d.getFullYear() : '');
        }

        return withTime === false ? label : label + ', ' + time;
    }

    function debounce(fn, wait) {
        var timer;

        return function () {
            var args = arguments;
            var self = this;

            clearTimeout(timer);
            timer = setTimeout(function () {
                fn.apply(self, args);
            }, wait);
        };
    }

    function byId(id) {
        return document.getElementById(id);
    }

    // ---------- Запросы ----------

    function toFormData(data) {
        if (data instanceof FormData) {
            return data;
        }

        var form = new FormData();

        Object.keys(data || {}).forEach(function (key) {
            var value = data[key];

            if (Array.isArray(value)) {
                value.forEach(function (item) {
                    form.append(key + '[]', item);
                });
            } else if (value !== undefined && value !== null) {
                form.append(key, value);
            }
        });

        return form;
    }

    function api(url, data) {
        return fetch(url, {
            method: 'POST',
            body: toFormData(data),
            credentials: 'same-origin'
        }).then(function (response) {
            return response.text().then(function (text) {
                var json;

                try {
                    json = JSON.parse(text);
                } catch (e) {
                    throw new Error(response.status === 403
                        ? 'Сессия закончилась — войдите в админку заново'
                        : 'Неожиданный ответ сервера: ' + text.replace(/<[^>]+>/g, ' ').trim().slice(0, 200));
                }

                if (json.status && json.status !== 'success') {
                    var error = new Error(json.message || 'Ошибка сервера');
                    error.status = response.status;
                    throw error;
                }

                return json;
            });
        });
    }

    // ---------- Уведомления ----------

    function toasts() {
        var box = byId('uiToasts');

        if (!box) {
            box = document.createElement('div');
            box.id = 'uiToasts';
            box.className = 'ga-toasts';
            box.setAttribute('aria-live', 'polite');
            document.body.appendChild(box);
        }

        return box;
    }

    function notify(type, message) {
        var box = toasts();
        var toast = document.createElement('div');

        toast.className = 'ga-toast ga-toast--' + type;
        toast.setAttribute('role', type === 'error' ? 'alert' : 'status');
        toast.innerHTML = '<span class="ga-toast-dot" aria-hidden="true"></span><span></span>';
        toast.lastChild.textContent = message;
        box.appendChild(toast);

        while (box.children.length > 4) {
            box.removeChild(box.firstChild);
        }

        setTimeout(function () {
            toast.classList.add('is-leaving');
            setTimeout(function () {
                toast.remove();
            }, 220);
        }, type === 'error' ? 6000 : 3000);

        if (type === 'error' && /войдите в админку/.test(message)) {
            setTimeout(function () {
                window.location.href = '/admin/authentication-login.php';
            }, 1800);
        }
    }

    function showError(error) {
        notify('error', error && error.message ? error.message : 'Что-то пошло не так');
    }

    // ---------- Окна ----------

    var modalStack = [];

    function openModal(modal, options) {
        options = options || {};

        if (modalStack.indexOf(modal) !== -1) {
            return;
        }

        modal.hidden = false;
        modal._returnFocus = document.activeElement;
        modal._onClose = options.onClose || null;
        modalStack.push(modal);
        document.body.style.overflow = 'hidden';

        var target = options.focus || modal.querySelector('[autofocus], .ga-modal-card input:not([type=hidden]):not([type=file]), .ga-modal-card select, .ga-modal-card textarea, .ga-modal-card button');

        if (target) {
            setTimeout(function () {
                target.focus();
            }, 30);
        }
    }

    function closeModal(modal) {
        var index = modalStack.indexOf(modal);

        if (index === -1) {
            return;
        }

        modalStack.splice(index, 1);
        modal.hidden = true;

        if (!modalStack.length) {
            document.body.style.overflow = '';
        }

        if (typeof modal._onClose === 'function') {
            var onClose = modal._onClose;
            modal._onClose = null;
            onClose();
        }

        if (modal._returnFocus && document.contains(modal._returnFocus)) {
            modal._returnFocus.focus();
        }

        if (modal.dataset.temporary) {
            modal.remove();
        }
    }

    function topModal() {
        return modalStack[modalStack.length - 1] || null;
    }

    /**
     * Окно, собранное из разметки. size: form | narrow | wide | xl.
     * Возвращает {el, card, close}. После закрытия окно удаляется.
     */
    function dialog(options) {
        var modal = document.createElement('div');

        modal.className = 'ga-modal';
        modal.hidden = true;
        modal.dataset.temporary = '1';
        modal.setAttribute('role', 'dialog');
        modal.setAttribute('aria-modal', 'true');
        modal.innerHTML = '<div class="ga-modal-backdrop" data-ga-close></div>' +
            '<div class="ga-modal-card' + (options.size ? ' ga-modal-card--' + options.size : '') + '">' +
            '<button type="button" class="ga-icon-btn ga-modal-close" data-ga-close aria-label="Закрыть">' + icon('x') + '</button>' +
            options.html + '</div>';
        document.body.appendChild(modal);

        var handle = {
            el: modal,
            card: modal.querySelector('.ga-modal-card'),
            close: function () {
                closeModal(modal);
            }
        };

        openModal(modal, {onClose: options.onClose, focus: options.focus && modal.querySelector(options.focus)});

        return handle;
    }

    var confirmResolve = null;

    /**
     * Подтверждение перед удалением. Возвращает Promise<boolean>.
     * Фокус на «Отмене» — случайный Enter ничего не удалит.
     */
    function confirm(options) {
        var modal = byId('uiConfirm');

        if (confirmResolve) {
            closeModal(modal);
        }

        byId('uiConfirmTitle').textContent = options.title;
        byId('uiConfirmText').innerHTML = options.html || esc(options.text || '');

        var ok = byId('uiConfirmOk');
        ok.textContent = options.ok || 'Удалить';
        ok.className = 'ga-btn ' + (options.danger === false ? 'ga-btn--ink' : 'ga-btn--danger');

        openModal(modal, {
            focus: modal.querySelector('.ga-modal-actions [data-ga-close]'),
            onClose: function () {
                if (confirmResolve) {
                    var resolve = confirmResolve;
                    confirmResolve = null;
                    resolve(false);
                }
            }
        });

        return new Promise(function (resolve) {
            confirmResolve = resolve;
        });
    }

    document.addEventListener('click', function (event) {
        if (event.target.closest('#uiConfirmOk')) {
            var resolve = confirmResolve;

            confirmResolve = null;
            closeModal(byId('uiConfirm'));

            if (resolve) {
                resolve(true);
            }
            return;
        }

        var closer = event.target.closest('[data-ga-close]');
        var modal = closer && closer.closest('.ga-modal');

        if (modal) {
            closeModal(modal);
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modalStack.length) {
            event.preventDefault();
            event.stopImmediatePropagation();
            closeModal(topModal());
        }
    }, true);

    // ---------- Разделы и навигация ----------

    var routes = {};
    var current = null;
    var defaultRoute = 'overview';

    function route(name, handlers) {
        routes[name] = handlers;
    }

    function parseHash() {
        var parts = window.location.hash.replace(/^#\/?/, '').split('/').filter(Boolean).map(decodeURIComponent);

        return {name: parts[0] || defaultRoute, params: parts.slice(1)};
    }

    function go(name, params) {
        var hash = '#/' + [name].concat(params || []).map(encodeURIComponent).join('/');

        if (window.location.hash === hash) {
            render();
        } else {
            window.location.hash = hash;
        }
    }

    // Меняем адрес без перерисовки раздела (например, при переключении вкладки внутри раздела)
    function setParams(params) {
        if (!current) {
            return;
        }

        var hash = '#/' + [current].concat(params || []).map(encodeURIComponent).join('/');
        history.replaceState(null, '', hash);
    }

    function render() {
        var target = parseHash();

        if (!routes[target.name] || !document.querySelector('[data-view="' + target.name + '"]')) {
            target = {name: defaultRoute, params: []};
        }

        var view = document.querySelector('[data-view="' + target.name + '"]');
        var handlers = routes[target.name];

        document.querySelectorAll('[data-view]').forEach(function (section) {
            section.hidden = section !== view;
        });

        document.querySelectorAll('.adm-nav-link[data-route]').forEach(function (link) {
            link.classList.toggle('is-active', link.dataset.route === target.name);
        });

        var title = handlers.title || '';
        var topTitle = byId('admTopTitle');

        if (topTitle) {
            topTitle.textContent = title;
        }
        document.title = (title ? title + ' · ' : '') + 'Админка мастерской';

        if (!view._inited && handlers.init) {
            view._inited = true;
            handlers.init(view);
        }

        current = target.name;
        closeNav();

        if (handlers.show) {
            handlers.show(view, target.params);
        }

        window.scrollTo(0, 0);
    }

    function isActive(name) {
        return current === name;
    }

    function setCount(name, value) {
        var badge = document.querySelector('[data-count="' + name + '"]');

        if (badge) {
            badge.textContent = value ? String(value) : '';
        }
    }

    // Мобильное меню
    function openNav() {
        var nav = byId('admNav');

        nav.classList.add('is-open');

        if (!byId('admNavBackdrop')) {
            var backdrop = document.createElement('div');
            backdrop.id = 'admNavBackdrop';
            backdrop.className = 'adm-nav-backdrop';
            backdrop.addEventListener('click', closeNav);
            document.body.appendChild(backdrop);
        }
    }

    function closeNav() {
        var nav = byId('admNav');
        var backdrop = byId('admNavBackdrop');

        if (nav) {
            nav.classList.remove('is-open');
        }
        if (backdrop) {
            backdrop.remove();
        }
    }

    function start() {
        var toggle = byId('admNavToggle');

        if (toggle) {
            toggle.addEventListener('click', openNav);
        }

        window.addEventListener('hashchange', render);
        render();
    }

    // ---------- Общие куски разметки ----------

    function emptyState(title, text) {
        return '<div class="ga-empty"><span class="ga-empty-frame" aria-hidden="true"></span>' +
            '<div class="ga-empty-title">' + esc(title) + '</div>' + (text ? '<div>' + esc(text) + '</div>' : '') + '</div>';
    }

    function skeletonRows(columns, rows) {
        var cells = new Array(columns + 1).join('<td><span class="ga-skel" style="height:14px;width:70%"></span></td>');
        return new Array((rows || 8) + 1).join('<tr>' + cells + '</tr>');
    }

    function pageHead(options) {
        return '<div class="pg-head"><div>' +
            (options.eyebrow ? '<div class="ga-eyebrow">' + esc(options.eyebrow) + '</div>' : '') +
            '<h1 class="pg-title">' + esc(options.title) + '</h1>' +
            (options.sub ? '<div class="pg-sub"' + (options.subId ? ' id="' + options.subId + '"' : '') + '>' + options.sub + '</div>' : '') +
            '</div>' + (options.actions ? '<div class="pg-actions">' + options.actions + '</div>' : '') + '</div>';
    }

    // Превью выбранной картинки внутри .ga-drop-file
    function bindFilePreview(label) {
        var input = label.querySelector('input[type=file]');
        var hint = label.querySelector('.ga-drop-file-text');
        var defaultText = hint ? hint.textContent : '';

        input.addEventListener('change', function () {
            var file = input.files && input.files[0];
            var old = label.querySelector('img');

            if (old) {
                URL.revokeObjectURL(old.src);
                old.remove();
            }

            label.classList.toggle('has-file', !!file);

            if (file) {
                var img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.alt = '';
                label.insertBefore(img, hint);
            }

            if (hint) {
                hint.textContent = file ? file.name : defaultText;
            }
        });
    }

    // Всплывающее меню у кнопки: items = [{value, label, html?}], onPick(value)
    var openMenu = null;

    function closeMenu() {
        if (openMenu) {
            openMenu.remove();
            openMenu = null;
        }
    }

    function menu(anchor, items, onPick) {
        closeMenu();

        var box = document.createElement('div');
        box.className = 'ga-menu';
        box.setAttribute('role', 'menu');
        box.innerHTML = items.map(function (item) {
            return '<button type="button" class="ga-menu-item' + (item.active ? ' is-active' : '') + '" role="menuitem" data-value="' + esc(item.value) + '">' +
                (item.html || esc(item.label)) + '</button>';
        }).join('');
        document.body.appendChild(box);

        var rect = anchor.getBoundingClientRect();
        var top = rect.bottom + 6;
        var left = Math.min(rect.left, window.innerWidth - box.offsetWidth - 12);

        if (top + box.offsetHeight > window.innerHeight - 12) {
            top = rect.top - box.offsetHeight - 6;
        }

        box.style.top = Math.max(12, top) + 'px';
        box.style.left = Math.max(12, left) + 'px';
        openMenu = box;

        box.addEventListener('click', function (event) {
            var item = event.target.closest('[data-value]');

            if (item) {
                closeMenu();
                onPick(item.dataset.value);
            }
        });

        var first = box.querySelector('.ga-menu-item');

        if (first) {
            first.focus();
        }
    }

    document.addEventListener('mousedown', function (event) {
        if (openMenu && !event.target.closest('.ga-menu')) {
            closeMenu();
        }
    });
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeMenu();
        }
    });
    window.addEventListener('scroll', closeMenu, true);
    window.addEventListener('resize', closeMenu);

    window.AdminUI = {
        menu: menu,
        closeMenu: closeMenu,
        icon: icon,
        esc: esc,
        plural: plural,
        money: money,
        date: date,
        parseDate: parseDate,
        debounce: debounce,
        api: api,
        notify: notify,
        showError: showError,
        openModal: openModal,
        closeModal: closeModal,
        dialog: dialog,
        confirm: confirm,
        hasOpenModal: function () {
            return modalStack.length > 0;
        },
        route: route,
        go: go,
        setParams: setParams,
        isActive: isActive,
        setCount: setCount,
        start: start,
        emptyState: emptyState,
        skeletonRows: skeletonRows,
        pageHead: pageHead,
        bindFilePreview: bindFilePreview
    };
})();
