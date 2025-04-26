<?php
$keywords = "Купить рамку, рамка для картины, рамка срочно, готовая рамка, рамка день в день";
$title = "Изготовление рамки день в день! Экспресс-заказ от 30 минут в Багетной мастерской №1";
$description = "Необходима рамка срочно? Изготовим для Вас рамку для картины в самые короткие сроки!";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
<style>
    .section-title {
        font-family: Cormorant Garamond;
        color: #a3080d;
        font-weight: bold;
        text-align: center;
        margin: 40px 0 20px;
        text-transform: uppercase;
    }
    .highlight-btn {
        background-color: #a3080d;
        color: white;
        border: none;
        padding: 10px 25px;
        font-size: 16px;
        border-radius: 4px;
        margin: 15px 0;
    }
    .highlight-btn:hover {
        background-color: #870000;
        color: #fff;
    }
    .icon-check {
        color: #00a651;
        margin-right: 6px;
    }
    .section-text {
        font-size: 18px;
        font-family: 'Manrope', sans-serif;
        color: #474A51;
    }
    .garamond{
        font-family: Cormorant Garamond;
        font-size: 22px;
    }
    img {
        border-radius: 10px;
        max-width: 100%; /* Не шире контейнера */
        height: auto;    /* Сохранять пропорции */
    }

    .img-custom {
        object-fit: contain;
    }


    img {
        border-radius: 10px;
        max-width: 100%;
        height: auto;
    }

    .img-custom {
        object-fit: contain;
    }

    .img-1 {
        max-width: 286px;
        max-height: 382px;
    }

    .img-2 {
        max-width: 396px;
        max-height: 561px;
    }

    .img-3 {
        max-width: 404px;
        max-height: 461px;
    }

    @media screen and (max-width: 767px){
        .img-1 {
            max-width: 100%;
            height: auto;
            max-height: 376px;
        }

        .img-2 {
            max-width: 100%;
            height: auto;
            max-height: 412px;
        }

        .img-3 {
            max-width: 100%;
            height: auto;
            max-height: 340px;
        }
    }
</style>

<div class="container home_design">

    <!-- Блок 1 -->
    <div class="row">
        <div class="col-12">
            <h2 class="section-title text-center">
                <span style="font-size: 40px">EXPRESS-ЗАКАЗ:</span><br>
                СРОЧНОЕ ИЗГОТОВЛЕНИЕ РАМКИ ДЛЯ КАРТИНЫ И ФОТО — ДЕНЬ В ДЕНЬ
            </h2>
        </div>

        <div class="col-12 col-md-5 text-center">
            <img src="/img/article/telegram-cloud-photo-size-2-5425050076243422565-y%201.png" class="img-custom img-1">
        </div>

        <div class="col-12 col-md-7 text-left section-text my-auto">
            <p>Нужна рамка <strong>срочно</strong> для картины или фотографии? В Багетной мастерской №1 вы можете купить рамку и оформить заказ день в день с изготовлением от 30 минут!</p>
            <p>Мы предлагаем как готовые изделия стандартных размеров, так и индивидуальное изготовление в <strong>кратчайшие сроки</strong>!</p>
            <a href="/baget_online">
                <button class="highlight-btn">Рассчитать стоимость багета</button>
            </a>
        </div>
    </div>
    <!-- Блок 2 -->
    <div class="row text-center">
        <h3 class="section-title">ДЛЯ ЧЕГО УСЛУГА EXPRESS-ЗАКАЗА?</h3>
        <div class="col-sm-12 section-text">
            <p><strong class="garamond">СРОЧНЫЙ ПОДАРОК</strong><br>Хотите красиво оформить картину или фото к празднику?</p>
            <p><strong class="garamond">СМЕНА ИНТЕРЬЕРА</strong><br>Решили обновить оформление в кратчайшие сроки?</p>
            <p><strong class="garamond">ВНЕЗАПНАЯ ВЫСТАВКА</strong><br>Нужно срочно подготовить работу к экспозиции?</p>
            <p><span style="color:#a3080d;">Наша мастерская гарантирует быструю и качественную работу без потери в деталях!<br>Оставляйте заявку на обратную связь – мы свяжемся с Вами!</span></p>
            <button class="highlight-btn" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
        </div>
    </div>

    <!-- Блок 3 -->
    <div class="row">
        <h3 class="section-title">КАК ЗАКАЗАТЬ РАМКУ ДЕНЬ В ДЕНЬ?</h3>
        <div class="col-sm-6 section-text my-auto">
            <p>Срочный заказ Вы можете оформить в Багетной мастерской №1, обратившись непосредственно в салон – Вам предложат различные варианты багета и паспарту для Вашей работы.</p>
            <p><strong class="garamond">1. Выберите багет</strong><br>У нас есть готовые рамки и большой выбор материалов.</p>
            <p><strong class="garamond">2. Определитесь с паспарту (если нужно)</strong><br>Это придаст изображению глубину.</p>
            <p><strong class="garamond">3. Укажите срочность</strong><br>Мы изготовим рамку день в день в течение нескольких часов в зависимости от сложности!</p>
        </div>
        <div class="col-sm-6">
            <img src="/img/article/image%20707.png" class="img-custom img-2">
        </div>
    </div>

    <!-- Блок 4 -->
    <div class="row">
        <h3 class="section-title">ВАЖНЫЕ НЮАНСЫ СРОЧНОГО ОФОРМЛЕНИЯ</h3>
        <div class="col-sm-12 section-text text-center">
            <p><strong class="garamond">ОГРАНИЧЕННОСТЬ ВЫБОРА МАТЕРИАЛОВ</strong><br>В ассортименте багетной мастерской №1 большой выбор багета, паспарту и других декоративных элементов для изготовления рамки срочно. Однако выбор будет меньше, чем при стандартном заказе: обратитесь в салон для уточнения деталей!</p>
            <p><strong class="garamond">ВРЕМЯ И СТОИМОСТЬ ИЗГОТОВЛЕНИЯ</strong><br>Срок изготовления рамки день в день начинается от 30 минут. Если Вам необходимо срочно оформить большое количество картин, времени мастеру понадобится больше: до 1 рабочего дня. Стоимость срочного заказа также будет выше обычной и зависит от сложности, загруженности салонов и времени обращения.</p>
            <a href="/baget_online"><button class="highlight-btn">Рассчитать стоимость багета</button></a>
        </div>
    </div>

    <!-- Блок 5 -->
    <div class="row">
        <h3 class="section-title">ПОЧЕМУ СТОИТ ОБРАТИТЬСЯ ИМЕННО К НАМ?</h3>
        <div class="col-sm-4">
            <img src="/img/article/telegram-cloud-photo-size-2-5276430906288104718-y%201.png" class="img-custom img-3">
        </div>
        <div class="col-sm-8 text-left section-text my-auto">
            <p><span class="icon-check">✅</span> скорость – изготовление рамки день в день.</p>
            <p><span class="icon-check">✅</span> качество – используем только надёжные материалы.</p>
            <p><span class="icon-check">✅</span> гибкость – работаем с любыми форматами и стилями.</p>
            <a href="/baget_online"><button class="highlight-btn">Рассчитать стоимость багета</button></a>
        </div>
    </div>

    <!-- Заключение -->
    <div class="row text-center section-text" style="margin: 40px 0;">
        <p>Не откладывайте оформление картины или фото на потом – закажите рамку срочно в багетной мастерской №1 и получите <strong>идеальный результат</strong> уже сегодня!</p>
    </div>
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
