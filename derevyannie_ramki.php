<?php
$keywords = "Купить рамку, рамка для картины, деревянная рамка";
$title = "Деревянные рамки для картин в Багетной мастерской №1!";
$description = "Купить рамку по индивидуальным размерам для картин – создавайте красоту вместе с нашей командой!";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>

<style>
    .section-title {
        font-family: Cormorant Garamond;
        color: #C6110F;
        font-weight: bold;
        text-align: center;
        margin: 40px 0 20px;
        text-transform: uppercase;
        font-size: 50px;
    }
    .highlight-btn {
        background-color: #a3080d;
        color: white;
        border: none;
        padding: 20px 35px;
        font-size: 16px;
        border-radius: 4px;
        margin: 15px 0;
        max-width: fit-content;
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
        font-size: 30px;
        font-family: 'Manrope', sans-serif;
        color: #474A51;
    }
    .garamond{
        font-family: Cormorant Garamond, serif;
        font-size: 22px;
    }
    img {
        border-radius: 10px;
        max-width: 100%;
        height: auto;
    }
    .img-left {
        display: block;
        margin-right: auto;
    }
    .img-right {
        display: block;
        margin-left: auto;
    }
    @media screen and (max-width: 767px) {
        .mt-5{
            margin-top: 20px !important;
        }
        .section-title {
            font-size: 24px;
            margin: 30px 0 15px;
        }
        .garamond {
            font-size: 18px;
        }
        .section-text {
            font-size: 16px;
        }
        .highlight-btn {
            width: 100%;
            padding: 12px 10px;
            font-size: 15px;
            max-width: calc(100% - 20px);
        }
        img {
            max-height: 100%;
            max-width: calc(100dvw - 80px);
            margin-bottom: 15px;
        }
        .my-auto {
            margin: 15px 0 !important;
        }
        .text-left {
            text-align: center;
        }
        .img-left,
        .img-right {
            margin: 0 auto !important;
        }
        .end-block{
            padding-left: 20px;
        }
    }
</style>

<div class="container home_design">

    <!-- Блок 1 -->
    <div class="row">
        <h2 class="section-title text-center">РАМКИ ДЛЯ КАРТИНЫ ИЗ ДЕРЕВА:<br>НЕИЗМЕННАЯ КЛАССИКА</h2>

        <!-- Картинка: будет после текста на мобилке -->
        <div class="col-sm-4 order-1 order-sm-1">
            <img src="/img/article/telegram-cloud-document-2-5285175076994442904%201%20(1).png" alt="Деревянные рамки" class="img-responsive img-left">
        </div>

        <!-- Текст: будет первым на мобилке -->
        <div class="col-sm-8 text-left section-text my-auto order-0 order-sm-2">
            <p>Деревянные рамы для картин всегда были завершающим этапом обрамления художественных предметов искусства. Старые мастера часто не только писали великие произведения искусства, но также и самостоятельно изготавливали для них деревянные рамки, которые являлись продолжением сюжета! </p>
            <p>Сегодня рынок багетного искусства стал современным, но не менее элегантным! В статье мы рассказываем о том, какие бывают багетные рамы из дерева!</p>
        </div>
    </div>


    <!-- Блок 2 -->
    <div class="row mt-5">
        <h3 class="section-title">СОСНА: ГЛАВНЫЙ МАТЕРИАЛ В ПРОИЗВОДСТВЕ</h3>
        <div class="col-sm-12 section-text my-auto">
            <p>В багетных мастерских Вы можете встретить большое количество деревянных образцов багета. Но не следует обманываться: в 99% случаев все образцы сделаны из сосны! Более редко – аюс. Практически не встречается (или очень редко) – дуб. </p>
            <p>Однако купить рамку из комбинированного дерева – отличный вариант для многих видов искусства: гравюр, масла, графики и даже фотографий! </p>
            <p>В Багетной мастерской №1 более 1000 вариантов только деревянных образцов, что позволяет нашим специалистам подобрать исключительный и идеально подходящий багет для Ваших картин и фотографий!</p>
            <p>Смотрите также наши статьи про багет из металла и полистирола!</p>

        </div>

    </div>

    <!-- Кнопка -->
    <div class="row text-center section-text mt-5 mb-4">
        <button class="highlight-btn mx-auto" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
    </div>

    <!-- Блок 3 -->
    <div class="row">
        <h3 class="section-title">ГОТОВОЕ ИЗДЕНИЕ VS ИНЛИВИДУАЛЬНЫЙ ПРОЕКТ </h3>
        <div class="col-sm-7 section-text my-auto">
            <p>Купить рамку или оформить заказ на индивидуальное изготовление деревянной рамки – зависит только от Ваших предпочтений и целей.</p>
        </div>
        <div class="col-sm-5">
            <img src="/img/article/telegram-cloud-document-2-5285175076994442927%201.png" alt="Индивидуальное оформление рамок" class="img-responsive img-right">
        </div>
    </div>

    <!-- Блок 4 -->
    <div class="row mt-5">

        <div class="col-sm-6 section-text">
            <h3 class="section-title">Готовая рамка – это:</h3>
            <p><strong>- стандартный формат </strong> </p>
            <p><strong>- простой дизайн </strong></p>
            <p><strong>- простая работа (например, рамка для фото или акварели)</strong> </p>

            <h3 class="section-title">Индивидуальный заказ – это:</h3>
            <p><strong>- любой необходимый размер  </strong> </p>
            <p><strong>- возможность индивидуального дизайна (например, к интерьеру) </strong></p>
            <p><strong>- работа любой сложности: джерси, шайбы, медали, украшения и т.п.</strong> </p>
        </div>

        <div class="col-sm-5">
            <img src="/img/article/image%20(1).png" alt="Породы дерева" class="img-responsive img-right">
        </div>
    </div>

    <!-- Заключение -->
    <div class="row text-center section-text mt-5 mb-4">
        <p>Исходя из поставленной Вами задачи, специалисты Багетной мастерской №1 подберут для Вас наиболее выгодное и подходящее решение! Оставляйте заявку на обратную связь, чтобы наш менеджер ответил на все оставшиеся вопросы!</p>
        <button class="highlight-btn mx-auto" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
    </div>

</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
