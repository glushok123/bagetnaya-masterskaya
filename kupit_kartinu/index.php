<?php
$keywords = "Купить картину, картина для дома, интерьерная картина";
$title = "Продажа интерьерных картин для дома – оригинальные готовые решения для себя и в подарок!";
$description = "Купить картину художника, постер или репродукцию – найдите идеальную готовую работу в Багетной мастерской №1!";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
    <div class="container">
        <div class="row text-center mt-3 mb-4">
            <h1 class="color-main block-h1">ПРОДАЖА ИНТЕРЬЕРНЫХ КАРТИН – ОРИГИНАЛЫ И РЕПРОДУКЦИИ</h1>
        </div>

        <div class="row justify-content-center mb-4">
            <div class="col-12 col-lg-10">
                <p class="element-animation<? if (isMobile()) { ?> text-center<? } ?>">
                    Купить картину художника или приобрести репродукцию – команда Багетной мастерской №1 предлагает Вам ознакомиться с ассортиментом разных картин, которые ищут своего счастливого обладателя! Все картины представлены в салонах наших мастерских, а некоторые из них доступны к повтору! Заказывайте онлайн с доставкой в подарок в пределах МКАД!
                </p>
            </div>
        </div>

        <div class="row text-center justify-content-center mt-3 mb-5">
            <a href="/baget_online">
                <button class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Рассчитать стоимость багетного оформления
                </button>
            </a>
        </div>

        <div class="row text-center m-2">
            <h2 class="section-title">КАРТИНА ДЛЯ ДОМА ИЛИ В ПОДАРОК</h2>
        </div>
        <div class="row justify-content-center mb-4">
            <div class="col-12 col-lg-10 text-center text-lg-start">
                <p>
                    Каждую картину Вы можете приобрести очно в салонах Багетной мастерской №1 или заказать с доставкой! Готовая картина – это идеальный вариант для подарка любителю искусства, а также великолепное решение для дома или офисного пространства. Не откладывайте на потом, приобретайте репродукции и оригиналы художников уже сегодня!
                </p>
            </div>
        </div>

        <div class="row text-center justify-content-center mt-3 mb-5">
            <button
                    class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Получить консультацию
            </button>
        </div>
    </div>

    <style>
        p {
            color: #474A51;
            font-family: Manrope;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 1.6;
        }

        .section-title {
            font-family: Cormorant Garamond;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        @media screen and (max-width: 760px) {
            p {
                font-size: 18px;
                text-align: center;
            }
        }
    </style>
<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
