<?php
$keywords = "Багет для картин, рамка для фото, заказать багет";
$title = "Багет для картин и фотографий в Багетной мастерской №1";
$description = "Индивидуальные рамки для фото и багеты для картин на заказ: собирают профессионалы!";

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
    </style>
    <div class="container ">
        <div class="row text-center mt-3 mb-5">
            <h1 class="color-main">Багет для картин и фотографий в <br>Багетной мастерской №1</h1>
        </div>


        <div class="row m-3">
            <div class="col-12 col-md-5 my-auto">
                <img src="/img/article/IMG_9690.JPEG" style="
                        object-fit: cover;
                        width: 100%;
                        height: auto;
                        max-height: 300px;
                    ">
                <br>
                <div class="fst-italic mx-auto"><b>Оформление Багетной мастерской №1</b></div>
            </div>
            <div class="col-12 col-md-7 my-auto">
                <p class="my-auto">
                    Памятные фотографии и ценные сердцу картины, ценные открытки и детские рисунки… Такие работы
                    особенно важно сохранять!
                    Наиболее подходящий способ – это изготовление рамки для фото и картин!
                </p>
            </div>
        </div>


        <div class="row text-center mt-5 mb-3">
            <h3>Какие рамы бывают и как правильно выбрать?</h3>
            <h5>В первую очередь важно определить: что Вы планируете оформить в раму?</h5>
            <p>
                Так, например, багетную раму следует выбирать исходя из Вашей цели: вписать в интерьер или подчеркнуть
                важность изображения без связи с окружающим пространством. Если планируется заказать багет для домашней
                галереи с постерами, детскими рисунками, винтажными фотографиями – в первую очередь следует выбрать все
                работы и обратиться к специалисту!
            </p>
        </div>

        <div class="row text-center justify-content-center  mb-5">
            <a href="/baget_online">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Рассчитать стоимость багета</b></button>
            </a>
        </div>

        <div class="row m-3">
            <div class="col-12 col-md-5 my-auto">
                <img src="/img/article/IMG_5732.JPEG" style="
                        object-fit: cover;
                        width: 100%;
                        height: auto;
                        max-height: 300px;
                    ">
                <br>

            </div>
            <div class="col-12 col-md-7">
                <p>
                    В нашем ассортименте Вы можете найти рамы из следующих материалов: дерево, пластик, алюминий. Каждый
                    материал может быть применим для любого типа работ, однако следует учитывать множество факторов,
                    например:
                </p>
                <p>
                    - алюминиевый багет не используется с холстами на подрамнике
                </p>
                <p>
                    - пластиковый багет не стоит использовать для постеров и картин большого формата
                </p>
                <p>
                    - деревянный багет – это самый универсальный материал, подходящий наибольшему числу фотографий и
                    картин – его диапазон стоимости и вариантов дизайна очень широкий!
                </p>
                <p>
                    Подробнее о каждом виде материала багета Вы можете прочитать в наших статьях:
                </p>
            </div>
        </div>
        <div class="row text-center justify-content-center  mb-5">
            <div class="col-12 col-md-4">
                <a href="/derevyannie_ramki">
                    <button
                            class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                        деревянные рамки</b></button>
                </a>
            </div>
            <div class="col-12 col-md-4">
                <a href="/plastikovye_ramki">
                    <button
                            class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                        пластиковые рамки</b></button>
                </a>
            </div>
            <div class="col-12 col-md-4">
                <a href="/metallicheskie_ramki">
                    <button
                            class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                        металлические рамки</b></button>
                </a>
            </div>
        </div>

        <div class="row text-center mt-3 mb-3 justify-content-center">
            <p>
                Вы можете абсолютно бесплатно получить консультацию в наших социальных сетях, мессенджерах и по телефону
                – специалисты Багетной мастерской №1 подскажут подходящий вариант оформления, рассчитают стоимость, и
                при необходимости – подготовят визуализацию будущей работы!
            </p>
            <button
                    class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь</b></button>
        </div>

        <div class="row text-center mt-5 mb-5">
            <h3>КАК ЗАКАЗАТЬ БАГЕТ?</h3>
            <p class="my-auto">Команда Багетной мастерской №1 предлагает несколько вариантов оформления заказа рамки для
                фото или картины:</p>
        </div>

        <div class="row mt-5 mb-5">
            <div class="col-12 col-md-5 my-auto">
                <img src="/img/article/IMG_9043.JPG" style="
                        object-fit: cover;
                        width: 100%;
                        height: auto;
                        max-height: 300px;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-7 <? if (isMobile()) {?> text-center <? }?>">
                <p >
                    - приходите в гости!<br>
                    Сеть Багетных мастерских №1 в Москве предлагает 3 удобных для посещения адреса! Все салоны обладают
                    широким ассортиментом багета и сопутствующих материалов. А также наши специалисты с удовольствием
                    помогут Вам с подбором оформления!
                </p>
                <p>
                    - выездной подбор багета<br> Если Вам неудобно приехать, мы приедем к Вам! Дизайнер с собой привозит от 50 образцов багета и паспарту: такая услуга позволяет подобрать багет для картины непосредственно в интерьере!
                </p>
                <p>
                    - online-конструктор багета<br> При желании самостоятельно подобрать оформление Вашей фотографии или картины и сразу увидеть конечную стоимость заказа <br>– переходите к наш конструктор багета!
                </p>
            </div>
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