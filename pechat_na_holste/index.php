<?php
$keywords = "Широкоформатная печать, Печать на холсте, Картина на холсте";
$title = "Нужно заказать картину на холсте? Широкоформатная печать в Багетной мастерской №1";
$description = "Простой расчет стоимости печати на холсте в калькуляторе позволит Вам сразу ознакомиться с ценами ";

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
            <h1 class="color-main mb-5">ДЕКОРАТИВНАЯ ПЕЧАТЬ НА ХОЛСТЕ</h1>
        </div>


        <div class="row m-3">
            <div class="col-12 col-md-5 my-auto text-center">
                <img src="/img/article/IMG_7142.JPG" style="
                      max-width: 80%;
                      height: auto;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-7 my-auto <? if (isMobile()) { ?> text-center <? } ?>">
                <p class="my-auto">
                    Картина на холсте – великолепный вариант для оформления пространств: как жилого помещения, так и
                    рабочей зоны. Однако ручные работы художников зачастую имеют высокую стоимость, а срок их
                    изготовления достаточно велик. Здесь в помощь дизайнерам и любителям картин приходит декоративная
                    печать на холсте – в короткий срок Вы можете получить подходящее Вашим запросам изображение и
                    украсить Ваш интерьер как репродукциями знаменитых художников, так и современными фотографиями или
                    постерами!
                </p>


            </div>
        </div>


        <div class="row text-center justify-content-center  mb-5">
            <a href="/baget_online">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Рассчитать
                    стоимость багета
                </button>
            </a>
        </div>

        <div class="row m-3">
            <div class="col-12 col-md-7 my-auto text-end <? if (isMobile()) { ?> text-center <? } ?>">
                <p class="my-auto">
                    В Багетной мастерской Вы можете заказать широкоформатную печать любой фотографии или репродукции.
                    Наши дизайнеры помогут найти качественный исходник! Формат печати на холсте – 1 метр в ширину, в
                    длину без ограничения. Срок изготовления картины на холсте составляет от одного рабочего дня. Также
                    в мастерской Вы можете воспользоваться сопутствующей услугой по натяжке холста на подрамник!
                    Багетные мастера выполнят для Вас натяжку готового холста необходимым способом: стандартным,
                    студийным или галерейным методом. Подробнее о методах натяжки читайте в нашей статье!
                </p>
            </div>
            <div class="col-12 col-md-5 text-center">
                <img src="/img/article/IMG_7716.JPG" style="
                          max-width: 80%;
                      height: auto;
                    ">
                <br>
            </div>
        </div>


        <div class="row text-center justify-content-center  mb-5">
            <a href="/natyazhka_holsta/">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    натяжка холста</b></button>
            </a>
        </div>


        <div class="row text-center mt-3 mb-5">
            <h3>КАК ЗАКАЗАТЬ ХОЛСТ </h3>
        </div>

        <div class="row m-3">
            <div class="col-12 col-md-5 my-auto text-center">
                <img src="/img/article/IMG_2649.JPG" style="
                      max-width: 80%;
                      height: auto;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-7 my-auto <? if (isMobile()) { ?> text-center <? } ?>">
                <p class="my-auto">
                    В Багетной мастерской №1 множество способов оформить заказ на декоративный холст: связаться с нами
                    по телефону, почте, мессенджерах или социальных сетях. Но также Вы можете заказать готовый печатный
                    холст уже в раме с помощью конструктора багета! Просто напишите в комментарии о необходимости
                    печати, и специалист пришлет Вам корректный расчет стоимости!
                </p>
                <p class="my-auto">
                    Если Вы не нашли ответ на свой вопрос в данной статье, оставляйте заявку на обратную связь! Наш
                    специалист проконсультирует Вас по интересующим вопросам!
                </p>
            </div>
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