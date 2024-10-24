<?php
$keywords = "Для иконы, киот, багетная рама, оформление икон";
$title = "Изготовление киотов и багетных рам для икон!";
$description = "Безупречное качество и профессиональный подход: индивидуальное изготовление рам и киотов для икон и других особенно ценных вещей!";

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
            <h1 class="color-main mb-5">ОБРАМЛЕНИЕ ИКОН В БАГЕТНОЙ МАСТЕРСКОЙ №1</h1>
        </div>

        <div class="row m-3">
            <div class="col-12 col-md-4 my-auto text-center">
                <img src="/img/article/IMG_8853%20(1).jpg" style="
                      max-width: 80%;
                      height: auto;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-8 my-auto <? if (isMobile()) { ?> text-center <? } ?>">
                <p class="my-auto">
                    Оформление икон – это процесс особенной важности! С особой аккуратностью и трепетностью команда
                    Багетной мастерской №1 подходит к данной работе: начиная от подбора материалов для иконы, заканчивая
                    сборкой подходящего обрамления. Опыт наших специалистов позволяет нам создавать уникальные сочетания
                    багетных рам, киотов и особых коробов с открывающимися створками для различных изображений святых:
                    будь то написанное изображение, или ручная вышивка бисером и каменьями.
                    Для подбора материалов мы рекомендуем обращаться в мастерскую лично с иконой, однако Вы
                    заблаговременно можете подобрать понравившийся профиль багета в нашем конструкторе багета!
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
        <div class="row my-5">
            <p class="my-auto">
                Выбор материалов в Багетной мастерской №1 максимально широкий, а навыки наших специалистов создавать
                многосоставные рамы позволит Вам получить подходящее оформление с наивысшим качеством в кратчайшие
                сроки! Смотрите нашу галерею выполненных работ, чтобы убедиться!
            </p>
        </div>



        <div class="row text-center justify-content-center  mb-5">
            <a href="/сatalog-of-finished-works">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Галерея готовых работ</b></button>
            </a>
        </div>

        <div class="row text-center mt-3 mb-5">
            <h3>РЕКОМЕНДАЦИИ К БАГЕТНОМУ ОФОРМЛЕНИЮ</h3>
        </div>
        <div class="row m-3">
            <div class="col-12 col-md-4 my-auto text-center">
                <img src="/img/article/IMG_8586.jpg" style="
                      max-width: 80%;
                      height: auto;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-8 my-auto <? if (isMobile()) { ?> text-center <? } ?>">
                <p class="my-auto">
                    •	Не торопитесь: тщательно выбирайте мастерскую, специалиста и обрамление: опыт работы с иконами важен для получения наилучшего изделия!<br>
                    •	Выбирайте оформление иконы очно в мастерской: так вместе со специалистом Вы сможете обсудить нюансы обрамления, а также убедиться в уместности багетного профиля<br>
                    •	Отдавайте предпочтение безбликовому музейному стеклу: так Ваша работа будет лучше защищена от выцветания<br>
                    •	Оставайтесь верны себе: несмотря для широкий ассортимент багета и множество предложенных вариантов оформления для иконы: обрамление должно откликаться с Вашими пожеланиями!<br>
                </p>


            </div>
        </div>

        <div class="row text-center justify-content-center my-5">
            <p class="my-auto">
                ·Остались вопросы? Оставляйте заявку на обратную связь, и мы свяжемся с Вами в кратчайшие сроки!
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