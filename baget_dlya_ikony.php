<?php
$keywords = "Багетная мастерская, рамка для иконы, багетная рама";
$title = "Рамка для иконы – создаем уникальные решения для ценных объектов искусства!";
$description = "Профессиональное обрамление икон в Багетной мастерской №1";

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
            <h1 class="color-main">ОБРАМЛЕНИЕ ИКОН В БАГЕТНОЙ МАСТЕРСКОЙ №1</h1>
            <p>
                Багетная рама для иконы – это не просто декоративное оформление! Правильно подобранные материалы
                обеспечивают религиозным образам качественное обрамление и сохранность их целостности. Наша команда
                имеет большой опыт работы с особо ценными вещами и семейными реликвиями, а широкий выбор образов багета
                и сопутствующих материалов позволяет нам подобрать подходящие рамки для икон как для самого образа, так
                и к интерьеру!
            </p>
        </div>


        <div class="m-3 text-center" style="width: 100%;">
            <?
            if (!isMobile()) {
                ?>
                <img src="/img/article/IMG_3739.JPG" style="
                        object-fit: cover;
                        width: 19%;
                        max-height: 216px;
                        margin-top: 10px;
                        height: auto;
                    ">

                <img src="/img/article/IMG_2950.JPG" style="
                        object-fit: cover;
                        width: 19%;
                        max-height: 216px;
                        margin-top: 10px;
                        height: auto;
                    ">
                <img src="/img/article/IMG_2970.JPG" style="
                        object-fit: cover;
                        width: 19%;
                        max-height: 216px;
                        margin-top: 10px;
                        height: auto;
                    ">
                <img src="/img/article/IMG_7416.JPG" style="
                        object-fit: cover;
                        width: 19%;
                        max-height: 216px;
                        margin-top: 10px;
                        height: auto;
                    ">
                <img src="/img/article/IMG_3740.JPG" style="
                        object-fit: cover;
                        width: 19%;
                        max-height: 216px;
                        margin-top: 10px;
                        height: auto;
                    ">
                <?
            } else {
                ?>
                <img src="/img/article/IMG_3739.JPG" style="
                       object-fit: cover;
                        width: 32%;
                        max-height: 116px;
                        margin-top: 10px;
                        height: auto;
                    ">

                <img src="/img/article/IMG_2970.JPG" style="
                       object-fit: cover;
                        width: 32%;
                        max-height: 116px;
                        margin-top: 10px;
                        height: auto;
                    ">
                <img src="/img/article/IMG_7416.JPG" style="
                       object-fit: cover;
                        width: 32%;
                        max-height: 116px;
                        margin-top: 10px;
                        height: auto;
                    ">
                <?
            }
            ?>

            <div>
                <p class="fst-italic pt-2">
                    Оформление икон в Багетной мастерской №1
                </p>
            </div>
        </div>

        <div class="row text-center justify-content-center mt-3 mb-5">
            <a href="/сatalog-of-finished-works">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Галерея работ</b></button>
            </a>
        </div>


        <div class="row text-center mt-3 mb-5">
            <h3>СПОСОБЫ ОФОРМИТЬ ЗАКАЗ: </h3>
        </div>

        <div class="row m-3">
            <div class="col-12 col-md-6 text-center">
                <img src="/img/article/IMG_3742.JPG" style="
                        object-fit: cover;
                        height: 290px;
                        margin-left: -15px;
                    ">

            </div>
            <div class="col-12 col-md-6">
                <p class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    <b>1. Посещение салонов Багетной мастерской №1 </b><br>
                    Наши салоны расположены в самом центре Москвы рядом со станциями метро Новокузнецкая, Арбатская
                    и Баррикадная! Также уточняйте по наличию гостевой автомобильной парковки!

                </p>
                <p class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    <b>2. Онлайн конструктор багета </b><br>
                    Вы можете самостоятельно подобрать багетную раму для Вашей иконы в нашем конструкторе багета: в
                    каталоге представлен широкий выбор рам как из дерева, так и полистирола!

                </p>
            </div>
        </div>

        <div class="row text-center justify-content-center mt-3 mb-5">
            <a href="/baget_online">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Рассчитать стоимость багета</b></button>
            </a>
        </div>

        <div class="row m-3 align-middle">
            <div class="col-12 col-md-6 my-auto">
                <p class="<? if (isMobile()) { ?> text-center <? } else { ?>text-end<? } ?> element-animation">
                    <b>3. Онлайн подбор с дизайнером в мессенджерах</b><br> Нужна индивидуальная консультация и подбор
                    специалистом? Свяжитесь с нашим дизайнером – подбор в мессенджерах происходит легко и оперативно!
                </p>

                <p class="<? if (isMobile()) { ?> text-center <? } else { ?>text-end<? } ?> element-animation">
                    <b>4. Выездной подбор багета дизайнером </b><br> Рамки для икон, которые должны быть подходящими и
                    уместными не только для образа, но и для интерьера – задача не из простых. Здесь мы предлагаем Вам
                    воспользоваться услугой выездного подбора багета: в рамках услуги наш дизайнер привозит образцы
                    багета и других материалов, помогает подобрать подходящий вариант оформления и рассчитывает
                    стоимость при Вас! Услуга доставки туда-обратно входит в стоимость!
                </p>

            </div>
            <div class="col-12 col-md-6 text-center">
                <img src="/img/article/IMG_8853.JPG" style="

                        width: auto;
                        max-height: 350px;
                    ">

            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 col-md-6 text-center">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                        data-bs-toggle="modal" data-bs-target="#feedbackModal">
                    Оставить заявку на обратную связь</b></button>
            </div>
            <div class="col-12 col-md-6 my-auto">
                <p class="<? if (isMobile()) { ?> text-center <? } ?>">
                    Все еще остались вопросы? Оставляйте заявку на обратную связь, и мы обязательно свяжемся с Вами!
                </p>

            </div>
        </div>

        <div class="row text-center mt-3 mb-5">
            <h3>ВЫБИРАЙТЕ ПРОФЕССИОНАЛОВ</h3>
        </div>
        <p class=" text-center">Багетная мастерская №1 – это команда, которого с особым вниманием и бережностью
            относится к каждому заказу. Большой опыт наших мастеров и дизайнеров позволяет создавать уникальные,
            индивидуальные проекты, которые находят место в сердцах наших Заказчиков. Не нашли ответ на свой вопрос?
            Оставляйте заявку на обратную связь для профессиональной консультации со специалистом!</p>


    </div>

    <style>
        @media screen and (max-width: 991px) {

        }
    </style>
<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>