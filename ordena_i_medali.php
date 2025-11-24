<?php
$keywords = "Рамка для медалей, медали и ордена, оформить медали";
$title = "Рамки для медалей: достойное оформление Ваших наград!";
$description = "Оформление медалей и орденов с профессиональной командой Багетной мастерской №1 ";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
    <style>

        @media screen and (max-width: 1200px) {
            .castom-image {
                width: 180px !important;
                height: 180px !important;
            }
        }

        @media screen and (max-width: 900px) {
            .castom-image {
                width: 170px !important;
                height: 170px !important;
            }
        }

        @media screen and (max-width: 760px) {
            .castom-image {
                width: 130px !important;
                height: 130px !important;
            }

            .card-body button {
                font-size: 14px;
            }

            .card-body div.row a {
                padding-left: 0px;
                margin-left: 0px;
            }
        }

        .castom-image {
            width: 100% !important;
            height: auto !important;
            max-height: 170px;
            object-fit: cover;
        }

        .card {
            padding-bottom: 10px;
            border-radius: 6px;
            border: 3px solid var(--beige, #E0D2BB);
            height: 350px !important;
        }

        .card:hover {
            background: #E0D2BB;
        }

        p {

            color: #474A51;
            font-family: Manrope;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            padding-bottom: 15px;

        }

        .home_design {
            font-family: Cormorant Garamond;
        }
    </style>
    <div class="container home_design">
        <div class="row text-center mt-3 mb-5">
            <h1 class="color-main mb-5">Рамки для медалей: достойное оформление ваших наград </h1>
            <h4>Медали и ордена — это не просто знаки отличия, а символы ваших достижений, памяти и гордости. Чтобы они
                сохранились на долгие годы и выглядели презентабельно, важно правильно их оформить. В Багетной
                мастерской №1 вы можете заказать рамку для медалей, которая подчеркнёт их значимость и станет стильным
                элементом интерьера. </h4>
        </div>

        <div class="row text-center mt-3 mb-5">
            <h3>Почему стоит оформить медали в панно? </h3>
        </div>

        <div class="row m-3">
            <div class="col-12 col-md-5 my-auto text-center">
                <img src="/img/article/IMG_9880.JPEG" style="
                      max-width: 80%;
                      height: auto;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-7 my-auto <? if (isMobile()) { ?> text-center <? } ?>">
                <p class="my-auto">
                    1. Сохранность — специальное оформление защищает награды от пыли, влаги и повреждений
                </p>
                <p class="my-auto">
                    2. Эстетика — красиво расположенные медали и ордена в багетной раме смотрятся торжественно и благородно.
                </p>
                <p class="my-auto">
                    3. Удобство — панно можно повесить на стену или поставить на полку, чтобы награды всегда были на виду.
                </p>
                <p class="my-auto">

                </p>

            </div>
        </div>

        <div class="row text-center justify-content-center  mb-5">
            <a href="/сatalog-of-finished-works">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    смотреть галерею работ</b></button>
            </a>
        </div>


        <div class="row text-center mt-3 mb-5">
            <h3>Как оформить медали: варианты дизайна </h3>
        </div>


        <div class="row m-3">
            <div class="col-12 col-md-7 my-auto text-end <? if (isMobile()) { ?> text-center <? } ?>">
                <p class="my-auto">
                    1. Классическое оформление<br>
                    Используются деревянные или пластиковые рамы с бархатным или тканевым фоном. Такой вариант подходит для парадного размещения наград.

                </p>
                <p class="my-auto">
                    2. Современный стиль<br>
                    Минималистичные рамки с подсветкой. Идеально для интерьеров в стиле хай-тек или лофт.

                </p>
                <p class="my-auto">
                    3. Тематическое оформление <br>
                    Если медали связаны с определённым событием (например, военная служба или спортивные достижения), можно добавить гравировку, фотографии или символику.

                </p>
            </div>
            <div class="col-12 col-md-5 text-center">
                <img src="/img/article/IMG_3762.JPG" style="
                          max-width: 80%;
                      height: auto;
                    ">
                <br>
            </div>
        </div>

        <div class="row text-center mt-3 mb-5">
            <h3>Где заказать панно наград и других ценных вещей? </h3>
        </div>

        <div class="row text-center mt-3 mb-5">
            <p>Команда Багетной мастерской №1 готова создавать для Вас самые различные индивидуальные панно для медалей и орденов. Мы используем качественные материалы и предлагаем различные варианты дизайна!
                Создайте достойное обрамление для ваших наград — пусть они украшают ваш дом и напоминают о важных моментах жизни!
            </p>
        </div>

        <div class="row text-center mt-3 mb-3 justify-content-center">

            <button
                    class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь</b></button>
        </div>


        <div class="row text-center">
            <h3>С уважением к Вам,</h3>
            <h3>С любовью к Искусству! </h3>
            <h3>Команда Багетной мастерской №1</h3>
        </div>
    </div>

<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>