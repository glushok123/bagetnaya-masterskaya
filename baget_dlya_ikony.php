<?php
$keywords = "багет для икон, рамка для иконы, рамка на заказ";
$title = "Багет для икон – качественное и долговечное обрамление";
$description = "Как правильно выбрать рамку для иконы? Багетная Мастерская №1 предлагает багет для икон любой сложности!";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
    <style>
        * {
            font-family: Cormorant Garamond;
        }

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
            <h1 class="color-main">БАГЕТ ДЛЯ ИКОН – КАЧЕСТВЕННОЕ ОБРАМЛЕНИЕ</h1>
            <h3 class="mt-3">Как правильно выбрать рамку для иконы? Как корректно оформлять образ? <br>Рассказываем в
                статье!</h3>
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

        <div class="row m-3 text-center">
            <p>
                Изготовление багетного оформления для икон – процесс очень щепетильный. В своей работе специалисты
                Багетной мастерской №1 выбирают только лучшие материалы и техники! Ведь багетная рамка на заказ
                создается не только с декоративной целью, но и защитной: массивные рамы и качественные стекла защищают
                образы от возможных механических повреждений и агрессивной окружающей среды в виде пыли, солнечных лучей
                и прочего.
            </p>
        </div>

        <div class="row text-center justify-content-center mt-3 mb-5">
            <a href="/baget_online">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Рассчитать стоимость багета</b></button>
            </a>
        </div>

        <div class="row text-center mt-3 mb-5">
            <h3>На что следует обратить внимание при выборе багета для иконы?</h3>
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
                <p class="element-animation <? if (isMobile()) {?> text-center <? }?>">
                    <b> 1. Опытный багетный мастер.</b><br> Грамотные специалисты Багетной мастерской №1 не просто
                    расскажут Вам о
                    широком опыте в оформлении разного вида работ, но также предоставят портфолио нашей компании!
                </p>
                <p class="element-animation <? if (isMobile()) {?> text-center <? }?>">
                    <b>2. Широкий выбор материалов.</b><br> Наша мастерская постаралась собрать широкую коллекцию
                    различных
                    образцов багета, стекол, паспарту для правильного и гармоничного создания рамки на заказ для Вас!
                </p>
            </div>
        </div>

        <div class="row m-3 align-middle">
            <div class="col-12 col-md-6 my-auto">
                <p class="<? if (isMobile()) {?> text-center <? }else {?>text-end<? }?> element-animation">
                    <b>3. Подходящая багетная рама.</b><br> Современные тенденции позволяют оформлять разные виду
                    искусства в
                    совершенно непредсказуемые стили! Однако для таких работ, как иконы, лучше использовать деревянные
                    резные рамы. Однако в ассортименте Багетной мастерской №1 также присутствует широкий выбор
                    пластикового багета!
                </p>

                <p class="<? if (isMobile()) {?> text-center <? }else {?>text-end<? }?> element-animation">
                    <b>4. Тип багетного стекла.</b><br> В случае изготовления рамки для икон со стеклом мы рекомендуем
                    использовать
                    музейное стекло для лучшей цветопередачи.
                </p>
                <p class="<? if (isMobile()) {?> text-center <? }else {?>text-end<? }?> element-animation">
                    <b>5. Срок изготовления багетной рамы для иконы.</b><br> Не следует спешить с изготовлением багетной
                    рамы.
                    Закладывайте за создание оформления иконы хотя бы 5-7 дней: для качественного оформления спешить не
                    стоит!
                </p>
            </div>
            <div class="col-12 col-md-6 text-center">
                <img src="/img/article/IMG_8853.JPG" style="
                        object-fit: cover;
                        width: 90%;
                        max-height: 450px;
                    ">

            </div>
        </div>

        <div class="row text-center mt-3 mb-5">
            <h3>КАК ЗАКАЗАТЬ ОФОРМЛЕНИЕ ИКОНЫ</h3>
        </div>
        <p class="mt-2 text-center">В первую очередь лучше определиться, как Вы видите будущее оформление Вашей иконы?
            Воспользуйтесь нашим конструктором багета, чтобы примерить и заказать подходящую раму!</p>
        <p class=" text-center">Также Вы можете посетить наши салоны для получения профессиональной консультации по изготовлению багета для
            иконы и вместе со специалистом создать неповторимое оформление!</p>

        <div class="row mt-3">
            <div class="col-12 col-md-6 text-center">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                        data-bs-toggle="modal" data-bs-target="#feedbackModal">
                    Оставить заявку на обратную связь</b></button>
            </div>
            <div class="col-12 col-md-6 my-auto">
                <p class="<? if (isMobile()) {?> text-center <? }?>">
                    Все еще остались вопросы? Оставляйте заявку на обратную связь, и мы обязательно свяжемся с Вами!
                </p>

            </div>
        </div>
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