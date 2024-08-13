<?php
$keywords = "Ордена и медали, награды и ордена, оформить награды";
$title = "Где заказать панно для наград и орденов?";
$description = "Оформление ценных вещей с профессиональной командой Багетной мастерской №1 ";

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
            <h1 class="color-main mb-5">ИЗГОТОВЛЕНИЕ ДЕКОРАТИВНЫХ ПАННО И БАГЕТНЫХ РАМ ДЛЯ НАГРАД И ОРДЕНОВ</h1>
            <h4>Обеспечить сохранность, смотреть и гордиться – вот правильный вариант, как следует хранить ордена и медали где бы то ни было: дом ли это, музей или рабочее пространство! Как правильно подобрать раму и что следует учесть при оформлении медалей: рассказываем в статье!</h4>
        </div>

        <div class="row text-center mt-3 mb-5">
            <h3>ПРОЦЕСС ПОДГОТОВКИ И ОФОРМЛЕНИЯ </h3>
        </div>

        <div class="row m-3">
            <div class="col-12 col-md-5 my-auto text-center">
                <img src="/img/article/IMG_9880.JPEG" style="
                      max-width: 80%;
                      height: auto;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-7 my-auto <? if (isMobile()) {?> text-center <? }?>">
                <p class="my-auto">
                    1.	В первую очередь определите количество орденов и медалей, которые Вы планируете оформить в багет: от этого зависит итоговый формат панно, расположение. Также восстановите хронологию наград и подберите памятные фотографии при необходимости.
                </p>
                <p class="my-auto">
                    2.	Выбирайте мастерскую с опытом работы 3D-оформления: ознакомьтесь с фотографиями ранее выполненных работ, отзывами. Также познакомьтесь со специалистом, который будет выполнять Ваш заказ. Преимуществом Багетной мастерской №1 является возможность лично общаться с багетным мастером!
                </p>
                <p class="my-auto">
                    3.	Согласуйте все до мельчайших подробностей: цвет паспарту, багетная рама, внутренняя декоративная отделка… Все это Вам расскажет грамотный специалист Багетной мастерской №1! А наш дизайнер в короткий срок подготовит визуализацию будущего панно.
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


        <div class="row m-3">
            <div class="col-12 col-md-7 my-auto text-end <? if (isMobile()) {?> text-center <? }?>">
                <p class="my-auto">
                    4.	Отдавайте предпочтение классическим вариантам материалов, чтобы оформить награды: используйте не выручный деревянный багет и декоративные канты. Остановите выбор багетного стекла на безбликовом: такое стекло имеет замечательную цветопередачу! В качестве фона мы рекомендуем использовать бархат. Также уместным будет использовать металлические таблички с необходимой информацией.
                </p>
                <p class="my-auto">
                    5.	Оставьте награды и ордена в мастерской. Это важно для качественного их размещения в раме! Если оставить медали по особым обстоятельствам не получается, запланируйте день визита со специалистом, в течение которого багетный мастер будет выполнять работу. Вы сможете понаблюдать за процессом монтажа в любом салоне Багетной мастерской №1!
                </p>
                <p class="my-auto">
                    6.	Качественное оформление не терпит спешки: заложите на данную работу не менее 7 дней: так специалист успеет качественно выполнить Ваш заказ!
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