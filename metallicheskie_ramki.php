<?php
// URL страницы: https://bagetnaya-masterskaya.com/metallicheskie_ramki/
$keywords = "Купить рамку, рамка для картины, металлическая рамка";
$title = "Качественные металлические рамки в Багетной мастерской №1!";
$description = "Купить рамку для картины из алюминия – высокое качество, современный стиль и надежность!";

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
    .img-left { display: block; margin-right: auto; }
    .img-right { display: block; margin-left: auto; }

    @media screen and (max-width: 767px) {
        .mt-5{ margin-top: 20px !important; }
        .section-title { font-size: 24px; margin: 30px 0 15px; }
        .garamond { font-size: 18px; }
        .section-text { font-size: 16px; }
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
        .my-auto { margin: 15px 0 !important; }
        .text-left { text-align: center; }
        .img-left, .img-right { margin: 0 auto !important; }
        .end-block{ padding-left: 20px; }
    }
</style>

<div class="container home_design">

    <!-- Блок 1 -->
    <div class="row">
        <h2 class="section-title text-center">СОВРЕМЕННЫЕ РАМЫ ИЗ МЕТАЛЛА</h2>

        <!-- Картинка: после текста на мобилке -->
        <div class="col-sm-4 order-1 order-sm-1">
            <img src="/img/article/telegram-cloud-document-2-5305308281655294126 1.png" alt="Алюминиевые рамки" class="img-responsive img-left">
        </div>

        <!-- Текст: перед картинкой на мобилке -->
        <div class="col-sm-8 text-left section-text my-auto order-0 order-sm-2">
            <p>В поисках идеальной рамы в современном стиле? Качественные металлические рамки в Багетной мастерской №1 – это элегантный и практичный вариант для размещения фотографий, постеров и картин в любом интерьере! В наших салонах Вы можете купить рамку из алюминия для любого формата картины.</p>
            <p>В данной статье рассказываем об особенностях рам из алюминия, а также почему стоит оформлять работы в Багетной мастерской №1.</p>
        </div>
    </div>

    <!-- Блок 2 -->
    <div class="row mt-5">
        <h3 class="section-title">АЛЮМИНИЙ – НАДЕЖНОСТЬ И ДОЛГОВЕЧНОСТЬ</h3>
        <div class="col-sm-7 section-text my-auto">
            <p>Металлические рамки изготавливают из алюминиевых сплавов. Такой материал имеет ряд преимуществ:</p>
            <p>- легкость: рамки из алюминия значительно легче дерева</p>
            <p>- прочность: алюминий не деформируется, в отличие от дерева и полистирола</p>
            <p>- долговечность: данный материал устойчив к влаге, солнцу и другим факторам</p>
            <p>Подбирайте идеальный багет для Ваших картин в нашем конструкторе багета!</p>
            <!-- ДОБАВИТЬ КНОПКУ НА КОНСТРУКТОР -->
            <a href="/baget_online">
                <button class="highlight-btn">Открыть конструктор багета</button>
            </a>
        </div>
        <div class="col-sm-5">
            <img src="/img/article/telegram-cloud-document-2-5305308281655294113 1.png" alt="Алюминиевые профили" class="img-responsive img-right">
        </div>
    </div>


    <!-- Блок 3 -->
    <div class="row">
        <h3 class="section-title">РАМКА ДЛЯ КАРТИНЫ ИЗ МЕТАЛЛА: ДЛЯ ЧЕГО ИСПОЛЬЗОВАТЬ</h3>
        <div class="col-sm-8 text-left section-text my-auto">
            <p>Металлические рамки идеально подходят для оформления следующих типов работ:</p>
            <p>- географические карты<br>
                Такие работы часто используют в офисах и рабочих пространствах. Рамки из металла идеально выполняют свою функцию и поддерживают общий интерьер</p>
            <p>- фотографии и постеры<br>
                Для небольших фото купить рамку из алюминия – отличный вариант. Ширина рамок начинается от 7 миллиметров, что позволит сохранить небольшой формат и не «задавить» миниатюру.</p>
            <p>- масло на холсте<br>
                Алюминиевый багет имеет специфическую форму, которая часто не позволяет оформить холст на подрамнике. Однако современные производители создали особенный профиль – теперь в Багетной мастерской №1 Вы можете оформить современную интерьерную картину в алюминий!</p>

            <p>Оставляйте заявку на обратную связь для предварительного расчета стоимости!</p>
            <!-- ДОБАВИТЬ КНОПКУ НА ОБРАТНУЮ СВЯЗЬ -->
            <button class="highlight-btn" data-bs-toggle="modal" data-bs-target="#feedbackModal">Обратная связь</button>

        </div>
        <div class="col-sm-4">
            <img src="/img/article/telegram-cloud-document-2-5305308281655294120%201.png" alt="Примеры алюминиевых рамок" class="img-responsive img-right mb-3">
            <img src="/img/article/telegram-cloud-document-2-5305308281655294115%201.png" alt="Рамки в разных цветах" class="img-responsive img-right">
        </div>
    </div>

    <!-- Блок 4 -->
    <div class="row mt-5">
        <h3 class="section-title">МЕТАЛЛ В ПРОСТРАНСТВЕ: ГДЕ ИСПОЛЬЗОВАТЬ</h3>
        <div class="col-sm-12 section-text my-auto">
            <p>Рамки для картин из алюминия уместны практически в любых интерьерах:</p>
            <p><span class="icon-check">✅</span>домашний лофт и минимализм: алюминиевый багет достаточно строгий и хорошо перекликается с отделкой, освещением и другими элементами</p>
            <p><span class="icon-check">✅</span>openspace и современный кабинет: дипломы, сертификаты и мотивационные постеры для сотрудников – отличный вариант для продуктивной деятельности. Алюминиевый багет здесь будет не отвлекающим и подходящим элементом</p>
            <p><span class="icon-check">✅</span>выставки, экспозиции и форумы: алюминиевый багет отлично переносит сложности транспортировки.</p>

            <p class="mt-4">Алюминий – это стиль, надежность, практичность. Если Вы хотите оформить работы в металлические рамки – команда Багетной мастерской №1 будет рада помочь и создать для Вас уникальные решения. Получайте скидку 10% на сайте, чтобы Ваш будущий заказ был максимально приятным!</p>

            <!-- ДОБАВИТЬ КНОПКУ НА ПЯТНАШКИ -->

                <button class="highlight-btn" data-bs-toggle="modal" data-bs-target="#gameModal">Пятнашки: получить 10% скидку</button>

        </div>
    </div>

    <!-- Блок 5 -->
    <div class="row mt-5">
        <h3 class="section-title">ГДЕ КУПИТЬ РАМКУ ИЗ МЕТАЛЛА?</h3>
        <div class="col-sm-7 section-text">
            <p>Мы подберём оптимальные профили, стекло и крепления под Вашу задачу и стиль интерьера.</p>
            <p>Получайте скидку 10% на сайте, чтобы Ваш будущий заказ был максимально приятным!</p>
        </div>
        <div class="col-sm-5">
            <img src="/img/article/telegram-cloud-document-2-5305308281655294121%201.png" alt="Рамки в мастерской" class="img-responsive img-right">
        </div>
    </div>

    <!-- Заключение -->
    <div class="row text-center section-text mt-5 mb-4">
        <p>Алюминий – это стиль, надежность и практичность. Если Вы хотите оформить работы в металлические рамки – мы будем рады помочь и создать для Вас уникальные решения.</p>
        <button class="highlight-btn mx-auto" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
    </div>

    <div class="row section-text mt-5 mb-4 end-block">
        С уважением к Вам,<br>
        С любовью к Искусству!<br>
        Багетная мастерская №1
    </div>
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
