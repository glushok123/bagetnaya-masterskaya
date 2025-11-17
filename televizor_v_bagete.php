<?php
$keywords = "Телевизор в рамке, рамка для экрана, рамка для дисплея";
$title = "Стильное оформление техники: багетные рамки для телевизоров и экранов!";
$description = "Профессиональное обрамление ТВ-панелей в Багетной мастерской №1! Оперативный выезд на подбор, замер и изготовление рамки для телевизоров!";

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
            <h1 class="color-main mb-5">
                РАМКА ДЛЯ ДИСПЛЕЯ: СТИЛЬНОЕ БАГЕТНОЕ ОФОРМЛЕНИЕ
            </h1>
        </div>

        <div class="row m-3">
            <div class="col-12 col-md-4 my-auto text-center">
                <img src="/img/article/photo_2025-11-17_13-55-24.jpg" style="
                      max-width: 80%;
                      height: auto;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-8 my-auto <? if (isMobile()) { ?> text-center <? } ?>">
                <p class="my-auto">
                    Интерьерные решения – это не только про эстетику и красоту в помещении, но также практичные приемы,
                    которые связывают в единое целое разные объекты. К таким решениям можно отнести багетное обрамление
                    – рамки для экранов телевизора, как и для картин, являются связующим звеном между слишком лаконичным
                    экраном и, например, интерьером в стиле бохо или прованс!
                </p>


            </div>
        </div>
        <div class="row text-center justify-content-center my-5">
            <a href="/baget_online">
                <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white">
                    Рассчитать
                    стоимость багета
                </button>
            </a>
        </div>


        <div class="row text-center mt-3 mb-5">
            <h3>Телевизор в рамке: красота и практичность: </h3>
        </div>
        <div class="row m-3">
            <div class="col-12 col-md-8 my-auto <? if (isMobile()) { ?> text-center <? } ?>">
                <p>
                    В каких случаях рама для ТВ-панели уместна?
                </p>
                <p>1. Эстетичный вид: в некоторых интерьерах обрамленные телевизоры лучше вписываются в общий стиль </p>
                <p>2. Защитная функция: багетная рама скрывает технические края экрана, а также защищает от возможных повреждений</p>
                <p>3. Индивидуальный проект: команда Багетной мастерской №1 создает стильные решения любой сложности!</p>
                <p>Необходимо подобрать уникальный вариант именно для Вашего интерьера! Оставляйте заявку на обратную связь, чтобы получить консультацию специалиста!</p>

            </div>
            <div class="col-12 col-md-4 my-auto text-center">
                <img src="/img/article/photo_2025-11-17_13-55-29.jpg" style="
                      max-width: 80%;
                      height: auto;
                    ">
                <br>
            </div>

        </div>

        <div class="row text-center mt-3 mb-3 justify-content-center">

            <button
                    class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь</b></button>
        </div>


        <div class="row text-center mt-3 mb-5">
            <h3>Как выбрать рамку для дисплея? </h3>
        </div>
        <div class="row m-3">

            <div class="my-auto <? if (isMobile()) { ?> text-center <? } ?>">
                <p>1. Определите стиль Вашего интерьера: выбор багетных рамок огромное количество! </p>
                <p>2. Сделайте предварительный замер телевизора: эти данные помогут уточнить предварительную стоимость работ </p>
                <p>3. Обращайтесь к профессионалам: обрамление телевизоров – трудоемкий и кропотливый процесс, в течение которого необходимо учесть множество нюансов! </p>
                <p>Воспользуйтесь нашей услугой выездного подбора багета, в рамках которого специалист приезжает с образцами, самостоятельно снимает замеры и выполняет расчет стоимости при Вас!</p>

            </div>
        </div>

        <div class="row text-center justify-content-center my-5">
            <a href="/home_designer">
                <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white">
                    Выездной подбор багета
                </button>
            </a>
        </div>

        <h3    class="text-center">Создавайте красоту дома или в офисе вместе с командой Багетной мастерской №1 и превращайте ТВ-панели в произведения искусства!</h3>


    </div>

<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>