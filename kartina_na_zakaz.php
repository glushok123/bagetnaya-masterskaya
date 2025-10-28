<?php
$keywords = "Портрет на заказ, прорисовка, картина на заказ, картина маслом, купить картину";
$title = "Картины на заказ в Багетной мастерской №1! ";
$description = "Профессиональная прорисовка картин маслом и арт-гелем в салонах Багетной мастерской №1!";

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

    .garamond {
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
        <h2 class="section-title">ДЕКОРАТИВНАЯ ПРОРИСОВКА КАРТИН В БАГЕТНОЙ<br>МАСТЕРСКОЙ №1</h2>
        <div class="col-sm-4 col-sm-offset-1">
            <img src="/img/article/telegram-cloud-document-2-5201835754921162974%201.png" class="img-responsive">
        </div>
        <div class="col-sm-6 text-left section-text my-auto">
            <p>Живопись – это великолепное украшение как для частых интерьеров, так и для рабочих пространств. Однако
                картины на заказ часто дорогие, а время из написания слишком велико! Современные технологии позволяют
                получить в кратчайшие сроки живописную работу, где сочетаются цифровая печать и ручная доработка маслом
                или арт-гелем! В данной статье рассказываем, как заказать репродукцию или портрет на заказ в Багетной
                мастерской №1!</p>
            <a href="/baget_online">
                <button class="highlight-btn">Рассчитать стоимость багета</button>
            </a>
        </div>
    </div>

    <!-- Блок 2 -->
    <div class="row">
        <h3 class="section-title">ЧТО ТАКОЕ – ПРОРИСОВКА?</h3>
        <p>Создание живописных репродукций можно разбить на несколько этапов: </p>
        <div class="col-sm-12 section-text">
            <p><strong class="garamond">1. Подбор и печать изображения</strong><br>Если Вам нравится определенное изображение – отправляйте файл менеджеру! Также можем предложить Вам помощь в подборе картин. Изображение печатается на натуральном специализированном холсте</p>
            <p><strong class="garamond">2. Предварительные багетные работы</strong><br>Печатный холст натягивается на специальную основу – подрамник, а также при необходимости подбирается обрамление </p>
            <p><strong class="garamond">3. Ручная доработка</strong><br>На данном этапе наш художник прорабатывает картину маслом или арт-гелем, в зависимости от Ваших целей и пожеланий. </p>
            <p>Данный вид работы занимает больше времени на изготовление, однако результат впечатляет своим объемом и фактурой! Смотрите примеры прорисовки в нашей галерее работ! </p>
            <a href="/%d1%81atalog-of-finished-works">
                <button class="highlight-btn">Галерея готовых работ</button>
            </a>
        </div>
    </div>

    <!-- Блок 3 -->
    <div class="row">
        <h3 class="section-title">КАК ЗАКАЗАТЬ КАРТИНУ </h3>
        <div class="col-sm-8 section-text">
            <p>Вы планируете купить картину с эффектом рукописной живописи? Команда Багетной мастерской №1 готова помочь!</p>
            <ul>
                <li>- напишите нам в любом удобном для Вас мессенджере или посетите любой удобный наш салон </li>
                <li>- согласуйте изображение и последующее оформление, если оно необходимо </li>
                <li>- согласуйте тип проработки: масло или арт-гель. </li>
            </ul>

            <p style="color: #a3080d;">Ознакомиться со стоимостью услуги прорисовки и другими видами багетных услуг Вы можете здесь</p>
            <a class="highlight-btn" href="/prices_for_print_and_canvas">Рассчитать стоимость</a>
        </div>
        <div class="col-sm-4 mx-auto">
            <img src="/img/article/telegram-cloud-document-2-5201835754921162994%201.png"
                 class="img-responsive mx-auto">
        </div>
    </div>

    <!-- Блок 4 -->
    <div class="row ">
        <h3 class="section-title">ПРОРИСОВКА: ДОСТОИНСТВА УСЛУГИ</h3>
        <div class="col-sm-4 col-sm-offset-1">
            <img src="/img/article/telegram-cloud-document-2-5201835754921163000%201.png" class="img-responsive">
        </div>
        <div class="col-sm-6 text-left section-text my-auto">
            <p><span class="icon-check">✅</span> быстрый результат, в сравнении с живописью на заказ.</p>
            <p><span class="icon-check">✅</span> экономия средств</p>
            <p><span class="icon-check">✅</span> эффект настоящего произведения искусства!</p>
            <a href="/baget_online">
                <button class="highlight-btn">Рассчитать стоимость багета</button>
            </a>
        </div>
    </div>

    <!-- Заключение -->
    <div class="row text-center section-text" style="margin: 40px 0;">
        <p>Оформляйте заказ на художественную доработку картин в Багетной мастерской №1 и получите великолепное произведение искусства для Ваших интерьеров или подарка ценителям прекрасного!</p>
    </div>
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
