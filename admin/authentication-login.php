<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/config.php';

require_once 'auth/authProv.php';

if (isset($_SESSION['user_logged_in'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="robots" content="noindex, nofollow">
    <title>Вход · Админка мастерской</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600&family=Golos+Text:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="assets/css/admin_ui.css?v=<?= @filemtime(__DIR__ . '/assets/css/admin_ui.css') ?>">
    <style>
        .lg { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); min-height: 100vh; }
        .lg-art {
            position: relative; display: flex; flex-direction: column; justify-content: space-between; padding: 44px;
            background: #1d1c1a radial-gradient(700px 480px at 20% 10%, rgba(201, 165, 106, .18), transparent 70%);
            color: #d9d3c7; overflow: hidden;
        }
        /* Большая рама с паспарту */
        .lg-frame {
            align-self: center; width: min(360px, 70%); aspect-ratio: 4 / 5; border-radius: 4px;
            border: 18px solid var(--gold-2);
            box-shadow: inset 0 0 0 2px #8a6a38, inset 0 0 0 30px #f4efe4, inset 0 0 0 32px #d8ccb4, 0 40px 80px -30px rgba(0, 0, 0, .8);
            background: linear-gradient(160deg, #3a352e, #26231f);
        }
        .lg-quote { max-width: 420px; font: 500 26px/1.25 var(--display); color: #f1ebe0; }
        .lg-side { display: flex; align-items: center; justify-content: center; padding: 32px 20px; }
        .lg-card { width: min(380px, 100%); }
        .lg-card .pg-title { font-size: 42px; }
        .lg-form { display: flex; flex-direction: column; gap: 16px; margin-top: 28px; }
        .lg-form .ga-input { height: 46px; font-size: 15px; }
        .lg-form .ga-btn { height: 46px; font-size: 15px; }
        .lg-error { min-height: 20px; color: var(--wine); font-size: 13.5px; }
        .lg-foot { margin-top: 28px; color: var(--muted); font-size: 12.5px; }
        @media (max-width: 860px) {
            .lg { grid-template-columns: 1fr; }
            .lg-art { display: none; }
        }
    </style>
</head>

<body class="adm">
<div class="lg">
    <div class="lg-art" aria-hidden="true">
        <a class="adm-brand" href="/">
            <span class="adm-brand-mark"></span>
            <span><span class="adm-brand-title">Багетная мастерская</span><span class="adm-brand-sub">админка</span></span>
        </a>
        <div class="lg-frame"></div>
        <div class="lg-quote">Хорошая рама не спорит с работой — она помогает её увидеть.</div>
    </div>

    <div class="lg-side">
        <div class="lg-card">
            <div class="ga-eyebrow">Багетная мастерская №1</div>
            <h1 class="pg-title">Вход в админку</h1>
            <div class="pg-sub">Заявки, каталог багета, работы и промокоды — в одном месте.</div>

            <form class="lg-form" id="loginForm" novalidate>
                <label class="ga-field">
                    <span class="ga-field-label">Логин или почта</span>
                    <input class="ga-input" id="login_login" name="login" autocomplete="username" autofocus>
                </label>
                <label class="ga-field">
                    <span class="ga-field-label">Пароль</span>
                    <input class="ga-input" id="login_passwd" name="passwd" type="password" autocomplete="current-password">
                </label>
                <div class="lg-error" id="loginError" role="alert"></div>
                <button type="submit" class="ga-btn ga-btn--ink ga-btn--block" id="loginSubmit">Войти</button>
            </form>

            <div class="lg-foot">Сайт: <a class="ga-link" href="/">bagetnaya-masterskaya.com</a></div>
        </div>
    </div>
</div>

<script>
    (function () {
        var form = document.getElementById('loginForm');
        var error = document.getElementById('loginError');
        var submit = document.getElementById('loginSubmit');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            var login = form.login.value.trim();
            var passwd = form.passwd.value;

            form.login.classList.toggle('is-invalid', !login);
            form.passwd.classList.toggle('is-invalid', !passwd);

            if (!login || !passwd) {
                error.textContent = 'Введите логин и пароль';
                return;
            }

            var data = new FormData();
            data.append('login', login);
            data.append('passwd', passwd);

            submit.disabled = true;
            submit.textContent = 'Проверяем…';
            error.textContent = '';

            fetch('auth/login.php', {method: 'POST', body: data, credentials: 'same-origin'})
                .then(function (response) {
                    return response.json();
                })
                .then(function (json) {
                    if (json.status === 'success') {
                        window.location.href = 'index.php';
                        return;
                    }

                    error.textContent = json.mes || 'Неверный логин или пароль';
                    form.passwd.classList.add('is-invalid');
                    form.passwd.select();
                })
                .catch(function () {
                    error.textContent = 'Не удалось связаться с сервером. Попробуйте ещё раз.';
                })
                .then(function () {
                    if (submit.textContent === 'Проверяем…') {
                        submit.disabled = false;
                        submit.textContent = 'Войти';
                    }
                });
        });
    })();
</script>
</body>

</html>
