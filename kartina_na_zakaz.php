<?php
$keywords = "Портрет на заказ, прорисовка, картины на заказ, картина маслом, картины купить";
$title = "Картины и репродукции на заказ в Багетной мастерской №1";
$description = "Прорисовка картин, создание жикле, профессиональный подход к созданию картин для вашего интерьера";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
    <style>
        .article-block {
            margin-bottom: 25px;
        }

        .article-block p {
            color: #474A51;
            font-family: Manrope;
            font-size: 20px;
            font-weight: 400;
            text-align: justify;
            text-indent: 30px;
        }

        .article-img {
            display: block;
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 6px;
            margin-bottom: 16px;
        }

        .hug-right {
            margin-left: auto;
            margin-right: 0;
        }

        .hug-left {
            margin-left: 0;
            margin-right: auto;
        }

        .center-img {
            margin-left: auto;
            margin-right: auto;
        }

        h1.color-main,
        h2.color-main {
            text-transform: uppercase;
        }

        @media screen and (max-width: 767px) {

            .article-block p {
                font-size: 16px;
                text-align: left;
                text-indent: 0;
            }

            .article-img {
                max-width: 260px;
                margin-left: auto;
                margin-right: auto;
            }

            h1.color-main,
            h2.color-main {
                font-size: 24px;
            }
        }
    </style>

    <div class="container home_design">

        <!-- H1 -->
        <div class="row text-center mt-3 mb-4">
            <h1 class="color-main">Картины и репродукции на заказ в Багетной<br>мастерской №1</h1>
        </div>

        <!-- Верхний блок: фото — текст — фото -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-3">
                <img src="/img/article/prorisovka_1.jpg" class="article-img center-img" alt="Историческая картина в багетной раме">
            </div>
            <div class="col-12 col-md-6">
                <p>
                    Многообразие художников и сюжетов позволяют найти сюжет для каждого зрителя. Однако часто
                    сталкиваемся с тем, что есть картина автора, которая заинтересовала Вас и вы хотели бы ей
                    обладать, но по ряду причин это становится невозможным.
                </p>
                <p>
                    Для решения таких задач в Багетной мастерской №1 есть опция – художественной или
                    декоративной прорисовки.
                </p>
            </div>
            <div class="col-12 col-md-3">
                <img src="/img/article/prorisovka_2.jpg" class="article-img center-img" alt="Репродукция морского боя в раме">
            </div>
        </div>

        <!-- Полноширинный текст -->
        <div class="row article-block">
            <div class="col-12">
                <p>
                    Портрет на заказ или картина маслом – любой из видов живописи может быть сделан специально
                    для Вас в кратчайшие сроки и по приятной цене.
                </p>
                <p>
                    Что же такое прорисовка? Прорисовка в контексте создания картины, это художественная
                    доработка изображения, напечатанного на холсте. Картины на заказ печатаются на холсте,
                    затем художник масляными красками или арт-гелем добавляет глубины и объема печатному
                    изображению. В мире искусства такая техника переноса изображения носит название – жикле.
                    Таким образом создаются качественные репродукции, но не только за счет красочного
                    нанесенного слоя, но и за счет качественного исходника файла для печати. Оцифровка и
                    цветокоррекция – это подготовительные и важные этапы в создании качественного жикле.
                </p>
            </div>
        </div>

        <!-- Кнопка: Оставить заявку на обратную связь -->
        <div class="row text-center justify-content-center mt-3 mb-5">
            <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white"
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь
            </button>
        </div>

        <!-- Блок: фото СЛЕВА, текст СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-4">
                <img src="/img/article/prorisovka_3.jpg" class="article-img hug-right" alt="Картина с прорисовкой в багетной раме">
            </div>
            <div class="col-12 col-md-8">
                <p>
                    Багетная мастерская №1 работает с подготовленными файлами для печати, мы можем их
                    кадрировать, в нужный размер, далее происходит печать работы, натяжки ее на необходимый
                    подрамник стандартный прямоугольный или круглый и овальный.
                </p>
                <p>
                    Прорисовка работы в зависимости от выбранного материала. Для тонкой лессировочной живописи
                    лучше выбирать масло, так как объемные мазки будут создавать эффект искусственности, не
                    натуральности мазка, а масляная краска, нанесённая тонким слоем, создаст нужную глубину и
                    реалистичность вашей картины.
                </p>
                <p>
                    Для работ, написанных в технике импасто отличным будет применение прозрачного арт-геля,
                    который создает объем так похожий на мазки масляной или акриловой живописи. При
                    необходимости и для достижения большего эффекта картина маслом может быть с кракелюрам – это
                    тонкий слой состаренного лака имитирующий натуральные трещины.
                </p>
            </div>
        </div>

        <!-- H2 -->
        <div class="row text-center mt-3 mb-4">
            <h2 class="color-main">Прорисовка картин, создание жикле, профессиональный подход<br>к созданию картин для вашего интерьера</h2>
        </div>

        <!-- Полноширинный текст -->
        <div class="row article-block">
            <div class="col-12">
                <p>
                    Когда в интерьер нужно купить картины, команда Багетной мастерской №1 всегда готова к
                    реализации ваших идей, от просто оформления в раму, до создания индивидуального
                    произведения искусства или же очень особенной рамы для него.
                </p>
                <p>
                    Картины на заказ, багеты на заказ, индивидуальное изготовление рам любых форм и подрамников
                    к ним – нужно решить сложную оформительскую задачу, Вам к нам, ждем вас для воплощения
                    самых смелых решений!
                </p>
            </div>
        </div>

        <!-- Кнопка: Как подобрать багет для картины -->
        <div class="row text-center justify-content-center mt-3 mb-4">
            <a href="/baget_for_karini">
                <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white">
                    Как подобрать багет для картины
                </button>
            </a>
        </div>

        <!-- Подпись -->
        <div class="row text-center mb-5">
            <p class="fst-italic">
                С уважением к Вам,<br>
                С любовью к Искусству!<br>
                Багетная мастерская №1
            </p>
        </div>

    </div>

<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
