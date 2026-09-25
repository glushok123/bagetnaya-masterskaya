<?php
session_start();

if (!isset($_SESSION['user_logged_in'])) {
    header('Location: authentication-login.php');
    exit;
}

$adminLogin = (string)($_SESSION['login'] ?? 'admin');

// Версия файла = время изменения: после выкладки браузер сразу берёт свежий
function asset(string $path): string
{
    return $path . '?v=' . @filemtime(__DIR__ . '/' . $path);
}

function nav_link(string $route, string $icon, string $label, bool $count = false): string
{
    return '<a class="adm-nav-link" href="#/' . $route . '" data-route="' . $route . '">'
        . '<svg class="ga-ico" viewBox="0 0 24 24" aria-hidden="true"><use href="#i-' . $icon . '"/></svg>'
        . '<span>' . $label . '</span>'
        . ($count ? '<span class="adm-nav-count" data-count="' . $route . '"></span>' : '')
        . '</a>';
}
?>
<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Админка мастерской</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600&family=Golos+Text:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.1/dist/cropper.min.css">
    <link rel="stylesheet" href="<?= asset('assets/css/admin_ui.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/admin_sections.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/gallery_admin.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/neoart_import.css') ?>">
</head>

<body class="adm">

<!-- Иконки меню -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
    <symbol id="i-home" viewBox="0 0 24 24"><path d="M4 11l8-7 8 7"/><path d="M6 9.5V20h12V9.5"/><path d="M10 20v-6h4v6"/></symbol>
    <symbol id="i-frame" viewBox="0 0 24 24"><rect x="3.5" y="3.5" width="17" height="17" rx="1.5"/><rect x="7.5" y="7.5" width="9" height="9"/><path d="M3.5 3.5l4 4M20.5 3.5l-4 4M3.5 20.5l4-4M20.5 20.5l-4-4"/></symbol>
    <symbol id="i-download" viewBox="0 0 24 24"><path d="M12 4v11M7 10l5 5 5-5M5 20h14"/></symbol>
    <symbol id="i-refresh" viewBox="0 0 24 24"><path d="M20 11a8 8 0 0 0-14.6-4.5L4 8"/><path d="M4 4v4h4"/><path d="M4 13a8 8 0 0 0 14.6 4.5L20 16"/><path d="M20 20v-4h-4"/></symbol>
    <symbol id="i-inbox" viewBox="0 0 24 24"><path d="M4 13l2.5-8h11L20 13"/><path d="M4 13v6h16v-6h-5l-1 2h-4l-1-2H4z"/></symbol>
    <symbol id="i-bag" viewBox="0 0 24 24"><path d="M6 8h12l-1 12H7L6 8z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></symbol>
    <symbol id="i-grid" viewBox="0 0 24 24"><rect x="4" y="4" width="7" height="7" rx="1.5"/><rect x="13" y="4" width="7" height="7" rx="1.5"/><rect x="4" y="13" width="7" height="7" rx="1.5"/><rect x="13" y="13" width="7" height="7" rx="1.5"/></symbol>
    <symbol id="i-picture" viewBox="0 0 24 24"><rect x="3.5" y="5" width="17" height="14" rx="1.5"/><path d="M3.5 16l5-5 4 4 3-3 5 5"/><circle cx="15.5" cy="9" r="1.5"/></symbol>
    <symbol id="i-ticket" viewBox="0 0 24 24"><path d="M4 10a2 2 0 0 0 0 4v4h16v-4a2 2 0 0 1 0-4V6H4v4z"/><path d="M14 8v8" stroke-dasharray="2 2.5"/></symbol>
    <symbol id="i-logout" viewBox="0 0 24 24"><path d="M14 5h5v14h-5"/><path d="M10 8l-4 4 4 4M6 12h10"/></symbol>
</svg>

<div class="adm-shell">
    <header class="adm-topbar">
        <button type="button" class="ga-icon-btn ga-icon-btn--dark" id="admNavToggle" aria-label="Меню">
            <svg class="ga-ico" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
        <a class="adm-brand" href="#/overview">
            <span class="adm-brand-mark" aria-hidden="true"></span>
            <span class="adm-brand-title">Мастерская</span>
        </a>
        <span class="adm-topbar-title" id="admTopTitle"></span>
    </header>

    <nav class="adm-nav" id="admNav" aria-label="Разделы админки">
        <a class="adm-brand" href="#/overview">
            <span class="adm-brand-mark" aria-hidden="true"></span>
            <span>
                <span class="adm-brand-title">Багетная мастерская</span>
                <span class="adm-brand-sub">админка</span>
            </span>
        </a>

        <?= nav_link('overview', 'home', 'Обзор') ?>

        <div class="adm-nav-group">
            <div class="adm-nav-label">Заявки</div>
            <?= nav_link('leads', 'inbox', 'Обратная связь', true) ?>
            <?= nav_link('orders', 'bag', 'Заказы картин', true) ?>
        </div>

        <div class="adm-nav-group">
            <div class="adm-nav-label">Каталог</div>
            <?= nav_link('catalog', 'frame', 'Багет и паспарту') ?>
            <?= nav_link('suppliers', 'refresh', 'Поставщики') ?>
            <?= nav_link('neoart', 'download', 'Импорт Neoart') ?>
        </div>

        <div class="adm-nav-group">
            <div class="adm-nav-label">Сайт</div>
            <?= nav_link('works', 'grid', 'Каталог работ') ?>
            <?= nav_link('paintings', 'picture', 'Картины') ?>
            <?= nav_link('promo', 'ticket', 'Промокоды') ?>
        </div>

        <div class="adm-nav-foot">
            <div class="adm-user">
                <span class="adm-user-avatar"><?= htmlspecialchars(mb_substr($adminLogin, 0, 1), ENT_QUOTES, 'UTF-8') ?></span>
                <span><?= htmlspecialchars($adminLogin, ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <a class="adm-nav-link" href="auth/logout.php">
                <svg class="ga-ico" viewBox="0 0 24 24" aria-hidden="true"><use href="#i-logout"/></svg>
                <span>Выйти</span>
            </a>
        </div>
    </nav>

    <main class="adm-main">
        <section class="adm-view" data-view="overview" hidden></section>
        <section class="adm-view" data-view="leads" hidden></section>
        <section class="adm-view" data-view="orders" hidden></section>
        <section class="adm-view" data-view="catalog" hidden></section>
        <section class="adm-view" data-view="suppliers" hidden></section>

        <section class="adm-view" data-view="neoart" hidden>
            <div class="pg-head">
                <div>
                    <div class="ga-eyebrow">Каталог</div>
                    <h1 class="pg-title">Импорт Neoart</h1>
                    <div class="pg-sub">Скачать базу поставщика, нарезать картинки, проверить и опубликовать в каталог.</div>
                </div>
            </div>
            <? require_once 'view/neoart_import.php'; ?>
        </section>

        <section class="adm-view" data-view="works" hidden>
            <div class="pg-head">
                <div>
                    <div class="ga-eyebrow">Сайт</div>
                    <h1 class="pg-title">Каталог работ</h1>
                    <div class="pg-sub">Портфолио мастерской на сайте: категории и фотографии работ.</div>
                </div>
            </div>
            <? require_once 'view/gallery_works_admin.php'; ?>
        </section>

        <section class="adm-view" data-view="paintings" hidden></section>
        <section class="adm-view" data-view="promo" hidden></section>
    </main>
</div>

<!-- Подтверждение удаления (общее для всех разделов) -->
<div class="ga-modal" id="uiConfirm" hidden role="alertdialog" aria-modal="true" aria-labelledby="uiConfirmTitle" aria-describedby="uiConfirmText">
    <div class="ga-modal-backdrop" data-ga-close></div>
    <div class="ga-modal-card ga-modal-card--narrow">
        <h3 class="ga-modal-title" id="uiConfirmTitle"></h3>
        <p class="ga-modal-text" id="uiConfirmText"></p>
        <div class="ga-modal-actions">
            <button type="button" class="ga-btn ga-btn--ghost" data-ga-close>Отмена</button>
            <button type="button" class="ga-btn ga-btn--danger" id="uiConfirmOk">Удалить</button>
        </div>
    </div>
</div>

<div class="ga-toasts" id="uiToasts" aria-live="polite"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.1/dist/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script src="<?= asset('assets/js/admin_ui.js') ?>"></script>
<script src="<?= asset('assets/js/sections/overview.js') ?>"></script>
<script src="<?= asset('assets/js/sections/leads.js') ?>"></script>
<script src="<?= asset('assets/js/sections/catalog.js') ?>"></script>
<script src="<?= asset('assets/js/sections/suppliers.js') ?>"></script>
<script src="<?= asset('assets/js/sections/paintings.js') ?>"></script>
<script src="<?= asset('assets/js/sections/promo.js') ?>"></script>
<script src="<?= asset('assets/js/gallery_admin.js') ?>"></script>
<script src="<?= asset('assets/js/neoart_import.js') ?>"></script>
<script>
    AdminUI.route('works', {
        title: 'Каталог работ',
        show: function () {
            window.GalleryAdmin && window.GalleryAdmin.refresh();
        }
    });
    AdminUI.route('neoart', {
        title: 'Импорт Neoart',
        show: function () {
            if (window.NeoartUI) {
                NeoartUI.loadErrors();
                NeoartUI.loadGrid();
            }
        }
    });
    AdminUI.start();

    // Счётчики новых заявок в меню, если админку открыли не с «Обзора»
    if (!AdminUI.isActive('overview')) {
        AdminOverview.load().catch(function () {});
    }
</script>
</body>

</html>
