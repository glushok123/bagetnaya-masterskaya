<?php
$keywords = "Фоторамка, рамка для фото, фото в рамку, рамка ";
$title = "Изготовление рамки для фото любого размера в Багетной мастерской №1!";
$description = "В наших салонах Вы можете не только купить рамку в готовом виде, но и заказать рамку любого размера и дизайна! Рамки на заказ в любом тираже в Багетной мастерской №1 ";

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
            text-indent: 2em;

        }

        .home_design {
            font-family: Cormorant Garamond;
        }

        /* Мобильная версия: воздух между блоками и читаемый текст */
        @media screen and (max-width: 767.98px) {
            .home_design .row.m-3 {
                margin-left: 0 !important;
                margin-right: 0 !important;
                margin-top: 1.5rem !important;
                margin-bottom: 1.5rem !important;
                row-gap: 1rem;
            }

            .home_design .row.m-3 > div {
                padding-left: 12px;
                padding-right: 12px;
            }

            .home_design .row.m-3 > div {
                text-align: left;
            }

            .home_design p {
                font-size: 16px;
                line-height: 1.6;
                text-align: left;
                text-indent: 1em;
                padding-bottom: 12px;
            }

            .home_design h4 {
                margin-top: 0.5rem;
                margin-bottom: 0.75rem;
                font-size: 22px;
                text-align: left;
            }

            /* Картинки одного размера и по центру колонки */
            .home_design .row.m-3 img {
                display: block;
                width: 100% !important;
                max-width: 320px !important;
                height: auto !important;
                margin: 0 auto 0.75rem !important;
                border-radius: 6px;
            }
        }
    </style>
    <div class="container home_design">
        <div class="row text-center mt-3 mb-5">
            <div class="block-h1 text-center my-4 fade-in">

                <h2 class='color-main'>РАМКИ ДЛЯ ФОТО</h2>
                <h2 style="text-transform: uppercase;">В БАГЕТНОЙ МАСТЕРСКОЙ №1</h2>
            </div>
        </div>

        <div class="row m-3">

            <div class="col-12 col-md-8 my-auto text-start order-2 order-md-1">
                <h4>ФОТО В РАМЕ </h4>
                <p class="my-auto">
                    Фотография в раме: какой она должна быть сегодня ? Мода циклична. Сегодня мы все больше видим в
                    интерьере сочетание разных рам по стилю, материалу и замыслу.
                </p>
                <p>Фоторамки могут быть простыми прямыми нейтрального цвета из пластика или алюминия, не привлекая к
                    себе внимания. Могут располагаться на горизонтальной поверхности или аккуратно висеть на стене.</p>
                <p> Всё чаще в интерьерах встречаются яркие рамки для фото, которые являются акцентным аксессуаром.
                    Памятные фотографии или семейные фото, оформленные с паспарту в широкие багеты, перекликаются с
                    рамами круглой или овальной формы. Деревянные рамы мягких форм подчеркивают важность того или иного
                    события на фотографии. Составные рамы из нескольких багетов которые усилят эмоциональный посыл
                    фотографии и сделает ее эксклюзивным объектом в вашем интерьере. </p>
                <p>Наши мастера, менеджеры и дизайнеры предложат вам разные решение вашей задачи и на первый взгляд
                    скучное оформление может заиграть новыми красками.</p>
            </div>
            <div class="col-12 col-md-4 my-auto text-center order-1 order-md-2">
                <img src="/img/article/IMG_9333.HEIC.jpeg" style="
                      max-width: 100%;
                      height: auto;
                      transform: scaleX(-1);
                    ">
                <br>
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

        <div class="row m-3">
            <div class="col-12 col-md-4 my-auto text-center ">
                <img src="/img/article/IMG_4085.JPG" style="
                      max-width: 100%;
                      height: auto;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-4 my-auto text-center ">
                <img src="/img/article/IMG_5146.JPG" style="
                      max-width: 100%;
                      height: auto;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-4 my-auto text-center ">
                <img src="/img/article/IMG_5178.JPG" style="
                      max-width: 100%;
                      height: auto;
                    ">
                <br>
            </div>
        </div>

        <div class="row m-3">

            <div class="col-12 col-md-12 my-auto text-start">
                <h3 class='justify-content-center text-center'>РАМКИ НА ЗАКАЗ</h3>
                <p class="my-auto">
                    Замыслы могу быть разнообразными, и мы Багетная мастерская №1 умеем их воплощать. В нашем
                    ассортименте представлены образцы и лаконичных строгих рам, и ярких декоративных.
                </p>

                <p> Рамка на заказ может быть изготовлена в единственном экземпляре по индивидуальному макету только для
                    Вас из благородных пород дерева. Наше производство позволяет предложить Вам не просто фоторамку, а
                    раму круглой или овальной формы с таким же паспарту и индивидуальной покраской. </p>
                <p> Нужна рама, и Вы не знаете с чего начать оформление, оставьте запрос на нашем сайте, и мы свяжемся с
                    Вами удобным для вас способом!</p>
            </div>
        </div>

        <div class="row text-center mt-3 mb-3 justify-content-center">

            <button
                    class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь</b></button>
        </div>


        <div class="row m-3">
            <div class="col-12 col-md-4 my-auto text-center">
                <img src="/img/article/FullSizeRender.JPG" style="
                      max-width: 100%;
                      height: auto;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-8 my-auto text-start">
                <h4>ФОТО В РАМКУ</h4>
                <p class="my-auto">
                    Если же время на заказ ограничено - в наших салонах всегда есть готовые фоторамки из полистирола или
                    дерева, а также большой выбор паспарту из наличия.
                </p>
                <p> Мы всегда готовы предложить несколько вариантов стекла. Стоимость готовых рам начинается от 100 руб!
                    Мы в короткие сроки оформим Ваше изделие.</p>
                <p> По наличию и размерам готовых рам вас проконсультируют наши менеджеры, мастера и дизайнеры. </p>
                <p class="color-main"> Для вашего удобства на сайте есть галерея работ, где представлены фотографии уже
                    готовых работ, которые могут послужить примером для воплощения ваших идей.</p>
            </div>


        </div>


        <div class="row text-center justify-content-center  mb-5">
            <a href="/baget_for_karini">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Как подобрать багет для картины</b></button>
            </a>
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