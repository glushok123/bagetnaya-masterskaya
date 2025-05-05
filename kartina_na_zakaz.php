<?php
$keywords = "Портрет на заказ, прорисовка, картина на заказ, картина маслом";
$title = "Картины на заказ в Багетной мастерской №1! ";
$description = "Создаем wow-эффект с профессиональной прорисовкой картин маслом! Воплотите любые картины или портреты на заказ!";

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
        font-family: Cormorant Garamond, serif;
        font-size: 22px;
    }
    img {
        border-radius: 10px;
        max-width: 100%;
        height: auto;
    }
    @media screen and (max-width: 767px) {
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
        }
        img {
            max-height: 200px;
            margin-bottom: 15px;
        }
        .my-auto {
            margin: 15px 0 !important;
        }
        .text-left {
            text-align: center;
        }
    }

</style>

<div class="container home_design">

    <!-- Блок 1 -->
    <div class="row text-center">
        <h2 class="section-title">КАРТИНЫ НА ЗАКАЗ В БАГЕТНОЙ<br>МАСТЕРСКОЙ №1</h2>
        <div class="col-sm-4 col-sm-offset-1">
            <img src="/img/article/telegram-cloud-document-2-5201835754921162974%201.png" class="img-responsive">
        </div>
        <div class="col-sm-6 text-left section-text my-auto">
            <p>Современные технологии позволяют создавать удивительные картины, сочетая цифровую печать и ручную доработку. Один из популярных методов — <strong>доработка печатных картин маслом</strong> на холсте, а также акрилом или гелем, что придает изображению объём, фактуру и эффект настоящей живописи.</p>
            <p>Такой подход часто используется для создания портретов на заказ и других художественных работ.</p>
            <a href="/baget_online"><button class="highlight-btn">Рассчитать стоимость багета</button></a>
        </div>
    </div>

    <!-- Блок 2 -->
    <div class="row">
        <h3 class="section-title">ЭТАПЫ ПРОРИСОВКИ ПЕЧАТНОГО ХОЛСТА</h3>
        <div class="col-sm-12 section-text">
            <p><strong class="garamond">1. Печать основы</strong><br>Изображение наносится на холст с помощью высококачественной печати. Это может быть портрет на заказ, пейзаж или любая другая картина.</p>
            <p><strong class="garamond">2. Ручная работа</strong><br>Художник команды Багетной мастерской №1 вручную прорисовывает детали картины:</p>
            <ul>
                <li>– Маслом — придает глубину и реалистичность, создаёт эффект классической живописи.</li>
                <li>– Акрилом — добавляет яркость и чёткость, быстро сохнет, подходит для современных стилей.</li>
                <li>– Гелем — создаёт объёмные мазки, имитируя краску картины маслом.</li>
            </ul>
            <p><strong class="garamond">3. Финишная обработка</strong><br>При необходимости готовую работу покрывают лаком для защиты и придания глянцевого или матового эффекта.</p>
        </div>
    </div>

    <!-- Блок 3 -->
    <div class="row">
        <h3 class="section-title">КАК СДЕЛАТЬ ЗАКАЗ</h3>
        <div class="col-sm-8 section-text">
            <p>Если вы хотите купить живопись с эффектом рукописной живописи, обращайтесь в Багетную мастерскую №1!</p>
            <p><strong>Существует несколько способов оформления заказа:</strong></p>
            <ul>
                <li>- посетите любой салон Багетной мастерской №1, где специалист проконсультирует Вас!</li>
                <li>- свяжитесь с нами в мессенджерах или по телефону</li>
                <li>- рассчитайте стоимость самостоятельно:</li>
            </ul>
            <ol>
                <li>выберите печать холста</li>
                <li>выберите основу холста: подрамник с натяжкой</li>
                <li>выберите услугу «прорисовка»</li>
            </ol>
            <p style="color: #a3080d;">Если возникли сложности, оставляйте заявку на обратную связь и мы обязательно свяжемся с Вами!</p>
            <button class="highlight-btn" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
        </div>
        <div class="col-sm-4 mx-auto">
            <img src="/img/article/telegram-cloud-document-2-5201835754921162994%201.png" class="img-responsive mx-auto">
        </div>
    </div>

    <!-- Блок 4 -->
    <div class="row ">
        <h3 class="section-title">ДОСТОИНСТВА УСЛУГИ<br>ДОРАБОТКИ КАРТИН НА ЗАКАЗ</h3>
        <div class="col-sm-4 col-sm-offset-1">
            <img src="/img/article/telegram-cloud-document-2-5201835754921163000%201.png" class="img-responsive">
        </div>
        <div class="col-sm-6 text-left section-text my-auto">
            <p><span class="icon-check">✅</span> экономия по сравнению с полностью ручной работой.</p>
            <p><span class="icon-check">✅</span> высокая детализация благодаря печати.</p>
            <p><span class="icon-check">✅</span> эффект натурально написанного произведения искусства без длительного ожидания.</p>
            <a href="/baget_online"><button class="highlight-btn">Рассчитать стоимость багета</button></a>
        </div>
    </div>

    <!-- Заключение -->
    <div class="row text-center section-text" style="margin: 40px 0;">
        <p>Закажите репродукцию любого художника или важный семейный портрет с ручной доработкой маслом в багетной мастерской №1 и получите уникальное произведение, которое украсит ваш интерьер!</p>
    </div>
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
