<?php
$keywords = "Рама для картины, художественная выставка, персональная скидка, для оформления выставкие";
$title = "Персональные скидки для оформления выставки! Создаем рамы для картин на художественных выставках и не только!";
$description = "Наша команда поможет Вам в оформлении художественной выставки: широкий ассортимент багета, качественное изготовление рам для картин, а также персональные скидки для художников в Багетной мастерской №1 ";

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
            <h1 class="color-main mb-5">ПЕРСОНАЛЬНЫЕ СКИДКИ ДЛЯ ОФОРМЛЕНИЯ ВЫСТАВОК</h1>
        </div>


        <div class="row m-3 text-center">
            <p class="my-auto">
                Художественные выставки – это всегда волнительно! И совершенно неважно: начинающий ли Вы деятель
                искусства, или имеете колоссальный опыт в этом деле. В процессе поиска подходящей багетной мастерской,
                способной выполнить все требования к оформлению, у Вас могут возникнуть следующие вопросы:
            </p>
        </div>

        <div class="row m-3">
            <div class="col-12 col-md-5 my-auto text-center">
                <img src="/img/article/IMG_0421.JPG" style="
                      max-width: 80%;
                      height: auto;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-7 my-auto <? if (isMobile()) { ?> text-center <? } ?>">
                <p class="my-auto">
                    1. Как быстро выполняется работа по изготовлению рам для картин и сопутствующих материалов?
                </p>
                <p class="my-auto">
                    2. Где сделают качественное оформление Ваших работ? Здесь очень важен опыт багетных мастеров!
                </p>
                <p class="my-auto">
                    3. Где смогут сделать оформление картин в достаточно сжатые сроки? И даже день в день!
                </p>
                <p class="my-auto">
                    4. А есть ли персональные скидки? Ведь есть большая разница: оформить пару картин для себя и
                    оформить большую серию работ для выставки!
                </p>

            </div>
        </div>

        <div class="row m-3 text-center">
            <p class="mx-auto">
                Отвечаем на все вопросы в данной статье!
            </p>
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

        <div class="row text-center mt-3 mb-5">
            <h3>ОФОРМЛЕНИЕ КАРТИН ДЛЯ ВЫСТАВКИ</h3>
        </div>
        <div class="row m-3">
            <div class="col-12 col-md-7 my-auto text-end <? if (isMobile()) { ?> text-center <? } ?>">
                <p class="my-auto">
                    В Багетной мастерской №1 представлен широкий ассортимент багета, паспарту, кантов, багетных стекол и
                    других материалов, позволяющих нам создавать красивые, качественные и уместные оформления разных
                    видов искусства! Среди большого множества как деревянных образцов багета, так и пластиковых или
                    алюминиевых вариантов в наших выставочных залах, наши специалисты помогут Вам подобрать подходящие и
                    отвечающее Вашим требованиям материалы для оформления выставки! Предварительно Вы можете подобрать
                    рамы для картины в нашем конструкторе багета! Мы отслеживаем все новинки на багетном рынке и
                    регулярно пополняем наши коллекции!
                </p>
            </div>
            <div class="col-12 col-md-5 text-center">
                <img src="/img/article/IMG_9683.JPG" style="
                          max-width: 80%;
                      height: auto;
                      max-height: 400px;
                    ">
                <br>
            </div>
        </div>

        <div class="row text-center mt-3 mb-5">
            <h3>ОПЫТ БАГЕТНОЙ МАСТЕРСКОЙ №1</h3>
        </div>

        <p class="my-auto text-center">
            Наша команда имеет колоссальный опыт в сфере багетного дела! Иногда кажется, мы оформляли все: фотографии,
            акварели, пастели, масло и акрил, спортивные атрибуты, посуда, футболки и декоративные платки, деньги,
            драгоценности, ордена, оружие… Однако мы всегда открыты к новому опыту! Смотрите галерею наших работ!
        </p>

        <div class="row text-center justify-content-center  mb-5">
            <a href="/сatalog-of-finished-works">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    смотреть галерею работ</b></button>
            </a>
        </div>

        <div class="row m-3">
            <div class="col-12 col-md-5 my-auto text-center">
                <img src="/img/article/IMG_6172.JPG" style="
                      max-width: 80%;
                      height: auto;
                      max-height: 700px;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-7 my-auto <? if (isMobile()) { ?> text-center <? } ?>">
                <div class="row text-center mt-3 mb-5">
                    <h3>СРОЧНОЕ ОБРАМЛЕНИЕ КАРТИН</h3>
                </div>
                <p class="my-auto">
                    К выставке лучше готовиться заблаговременно, особенно если оформить необходимо большое количество
                    картин! Мы всегда рекомендуем закладывать на багетные работы около 7-10 календарных дней. Ведь
                    спешка – враг качества. Однако при необходимости выполнить большую серию работ в сроки до 3 дней –
                    мы можем помочь практически с любым тиражом!
                    Художественная выставка – важное событие для авторов, и мы всегда готовы прийти на помощь. Более
                    того, если Вы планируете выставлять не более 3 картин – мы сможем выполнить оформление картин день в
                    день из материалов в наличии!
                </p>
                <div class="row text-center mt-3 mb-5">
                    <h3>ПЕРСОНАЛЬНЫЕ СКИДКИ ДЛЯ
                        ХУДОЖНИКОВ</h3>
                </div>

                <p class="my-auto">
                    Багетная мастерская №1 предлагает Вам не только качественное и быстрое оформление картин, но также
                    приятные скидки до 20%! Размер скидки зависит от количества оформляемых работ, срочности заказа, а
                    также выбранных к оформлению материалов. Чтобы рассчитать стоимость оформления, оставляйте заявку на
                    обратную связь с комментарием о необходимости подготовки к выставке: с Вами свяжется наш специалист!
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