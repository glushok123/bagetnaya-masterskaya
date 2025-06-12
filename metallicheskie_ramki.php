<?php
$keywords = "Купить рамку, рамка для картины, металлическая рамка";
$title = "Качественные металлические рамки в Багетной мастерской №1! ";
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
        <h2 class="section-title text-center">МЕТАЛЛИЧЕСКИЕ РАМКИ: <br>СОВРЕМЕННЫЙ СТИЛЬ И НАДЁЖНОСТЬ</h2>

        <!-- Картинка: после текста на мобилке -->
        <div class="col-sm-4 order-1 order-sm-1">
            <img src="/img/article/telegram-cloud-document-2-5305308281655294126 1.png" alt="Алюминиевые рамки" class="img-responsive img-left">
        </div>

        <!-- Текст: перед картинкой на мобилке -->
        <div class="col-sm-8 text-left section-text my-auto order-0 order-sm-2">
            <p>Алюминиевые рамки — это элегантное и практичное решение для оформления картин, фотографий, постеров и зеркал. Они придают работе современный вид, отличаются лёгкостью и долговечностью.</p>
            <p>В этой статье разберем, из чего делают металлические рамки, где их лучше использовать и почему Багетная мастерская №1 — оптимальный выбор для заказа алюминиевых рам!</p>
        </div>
    </div>


    <!-- Блок 2 -->
    <div class="row mt-5">
        <h3 class="section-title">ИЗ ЧЕГО ДЕЛАЮТ РАМКИ?</h3>
        <div class="col-sm-7 section-text my-auto">
            <p>Алюминиевые багеты изготавливают из алюминиевых сплавов (чаще всего алюминий + магний или кремний), которые <strong>обеспечивают</strong>:</p>
            <p>✔ Лёгкость — почти в 3 раза легче стали.</p>
            <p>✔ Прочность — устойчивы к деформациям.</p>
            <p>✔ Коррозионную стойкость — не ржавеют, подходят для влажных помещений.</p>
            <p>✔ Гибкость обработки — можно создавать тонкие и сложные профили.</p>
        </div>
        <div class="col-sm-5">
            <img src="/img/article/telegram-cloud-document-2-5305308281655294113 1.png" alt="Алюминиевые профили" class="img-responsive img-right">
        </div>
    </div>

    <!-- Кнопка -->
    <div class="row text-center section-text mt-5 mb-4">
        <button class="highlight-btn mx-auto" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
    </div>

    <!-- Блок 3 -->
    <div class="row">
        <h3 class="section-title">ВИДЫ ПОКРЫТИЙ МЕТАЛЛИЧЕСКИХ РАМОК:</h3>
        <div class="col-sm-8 text-left section-text my-auto">
            <p><strong>- Анодирование</strong><br>
                повышает износостойкость, даёт матовый или глянцевый эффект (золото, серебро, бронза, чёрный).</p>
            <p><strong>- Порошковая окраска</strong><br>
                позволяет получить любой цвет (включая имитацию дерева или металла).</p>
            <p><strong>- Ламинирование</strong><br>
                декоративная плёнка с текстурой (например, под дерево или камень).</p>
            <a href="/baget_online">
                <button class="highlight-btn">Рассчитать стоимость багета</button>
            </a>
        </div>
        <div class="col-sm-4">
            <img src="/img/article/telegram-cloud-document-2-5305308281655294120%201.png" alt="Примеры алюминиевых рамок" class="img-responsive img-right mb-3">
            <img src="/img/article/telegram-cloud-document-2-5305308281655294115%201.png" alt="Рамки в разных цветах" class="img-responsive img-right">
        </div>
    </div>


    <!-- Блок 4 -->
    <div class="row mt-5">
        <h3 class="section-title">ГДЕ ЛУЧШЕ ИСПОЛЬЗОВАТЬ АЛЮМИНИЕВЫЕ РАМКИ?</h3>
        <div class="col-sm-12 section-text my-auto">
            <p><span class="icon-check">✅</span>Для современного интерьера (лофт, минимализм) — строгие линии и металлический блеск.</p>
            <p><span class="icon-check">✅</span>Для фотографий и постеров — лёгкие и прочные.</p>
            <p><span class="icon-check">✅</span>Для офисного оформления — дипломы, сертификаты, реклама.</p>
            <p><span class="icon-check">✅</span>Для выставок — удобно транспортировать.</p>
            <p><span class="icon-check">✅</span>Для влажных помещений — не боятся воды.</p>
            <p class="mt-4"><strong>Не подходят для:</strong></p>
            <p><span class="text-danger">❌</span>Классических картин в старинном стиле.</p>
            <p><span class="text-danger">❌</span>Очень тяжёлых работ или зеркал — требуется усиленное крепление.</p>
            <p><span class="text-danger">❌</span>Картин на высоком подрамнике — из-за сложного профиля.</p>
        </div>

    </div>

    <!-- Блок 5 -->
    <div class="row mt-5">
        <h3 class="section-title">ГДЕ КУПИТЬ РАМКУ ИЗ МЕТАЛЛА?</h3>
        <div class="col-sm-7 section-text">
            <p><strong>1. Изготовим точный размер</strong> — под нестандартные картины.</p>
            <p><strong>2. Широкий выбор</strong> — разная ширина, форма и страны-производители.</p>
            <p><strong>3. Качество сборки</strong> — гарантия 1 год на продукцию.</p>
            <p><strong>4. Дополнительные опции</strong> — антибликовое стекло, крепления, паспарту.</p>
            <p><strong>5. Профессиональный совет</strong> — подберём рамку под стиль интерьера.</p>
        </div>
        <div class="col-sm-5">
            <img src="/img/article/telegram-cloud-document-2-5305308281655294121%201.png" alt="Рамки в мастерской" class="img-responsive img-right">
        </div>
    </div>

    <!-- Заключение -->
    <div class="row text-center section-text mt-5 mb-4">
        <p>Металлические рамки – это стильное, легкое и долговечное решение для оформления картин и фотографий. Они идеально впишутся в современный интерьер и прослужат десятилетиями. Если вам нужно качественное и индивидуальное оформление, <strong>лучше всего обратиться в Багетную мастерскую №1</strong>, где изготовят идеальную рамку для картины по вашим параметрам.</p>
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
