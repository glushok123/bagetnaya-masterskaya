<?php
$keywords = "Рамка и паспарту для вышивки , вышивка крестиком, оформить вышивку ";
$title = "Как оформить вышивку в Багетной Мастерской №1";
$description = "Вышивка, один из не многих видов искусства который не «читается» зрителем без оформления. Яркая, живописная или ультрасовременная вышивка нуждается в раме.";

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

                <h2 class='color-main'>КАК ОФОРМИТЬ ВЫШИВКУ</h2>
                <h2 style="text-transform: uppercase;">В БАГЕТНОЙ МАСТЕРСКОЙ №1</h2>
            </div>
        </div>

        <div class="row m-3">

            <div class="col-12 col-md-6 my-auto text-start order-2 order-md-1">
                <h4 class='color-main'>ОФОРМЛЕНИЕ ВЫШИВКИ</h4>
                <p class="my-auto">
                    Вышивка - один из видов декоративно-прикладного искусства, который не теряет своей популярности, а
                    наоборот становится более востребованным с каждым годом. Вышивка, один из не многих видов искусства
                    который не «читается» зрителем без оформления. Яркая, живописная или ультрасовременная вышивка
                    нуждается в раме.
                </p>
                <p> За многие годы оформления вышивок сформировались негласные правила оформления – обязательное
                    паспарту, за частую двойное, широкая часть более светлая, а внутри окантовка - акцентная узкая
                    полоска в цвет вышивке. Рама так же подбирается именно в тон вышивке, а не под стиль помещения, где
                    будет висеть. В современные интерьеры не всегда вписывается такое оформление и теряется ценность
                    кропотливого труда рукодельников.</p>


            </div>
            <div class="col-12 col-md-6 my-auto text-center order-1 order-md-2">
                <img src="/img/article/IMG_8882.HEIC.jpeg" style="
                      max-width: 100%;
                      height: auto;
                    ">
                <br>
            </div>

            <p class="order-3"> Многообразие багетных рам позволяет оформить вышивку разными способами, продлить ее жизнь и сделать из
                нее самостоятельное произведение искусства которое будет дополнять и наполнять пространство.</p>
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
            <div class="col-12 col-md-4 my-auto text-center">
                <img src="/img/article/IMG_8913.JPG" style="
                      max-width: 100%;
                      height: auto;
                      transform: scaleX(-1);
                    ">
                <br>
            </div>
            <div class="col-12 col-md-8 my-auto text-start">
                <h4 class='color-main'>ВЫШИВКА КРЕСТИКОМ</h4>
                <p class="my-auto">
                    Для вышивки крестиком можно использовать декоративные канты, а так же составлять несколько рам в
                    единое оформление. Для сохранности всех крестиков, можно использовать паспарту в сочетании с кантом,
                    что подчеркнет четкую линию стежков. Рама не всегда должна стилистически сочетаться с вышивкой, она
                    может больше гармонировать с интерьером или вписываться в развеску и одновременно подчеркивать
                    изысканность работы.
                </p>
                <h4 class='color-main'>ВЫШИВКА БИСЕРОМ И КАМНЯМИ</h4>
                <p> Всё чаще мы сталкиваемся с оформлением вышивок с натуральными камнями и бисером. Важной деталью
                    данного оформления выступает стекло, которое не должно прилегать к выпуклой части вышивки. Для
                    данного вида вышивок хорошо подойдут рамы «коробочка» и высокий багет киотного типа. В таком
                    оформлении стекло располагается над вышивкой, и чтобы яркость камней не пропала лучше использовать
                    музейное антибликовое стекло. Данное оформление подойдет и для вышивки лентами.</p>
            </div>
        </div>

        <div class="row text-center mt-3 mb-3 justify-content-center">

            <button
                    class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь</b></button>
        </div>

        <div class="row m-3">

            <div class="col-12 col-md-6 my-auto text-start order-2 order-md-1">
                <h4 class='color-main'> РАМКА И ПАСПАРТУ ДЛЯ ВЫШИВКИ </h4>
                <p class="my-auto">
                    Если у вас круглая или овальная вышивка, или вышивка для которой понадобится фигурное паспарту – вы
                    найдете его у нас. Наши мастера, дизайнеры и менеджеры помогут в подборе необходимой формы окна
                    паспарту, оторое мы сделаем специально для вас. Круглую вышивку можно оформить с паспарту и в
                    прямоугольную раму, а можно и в раму овальных и круглых форм. Так же вставим необходимое круглое
                    стекло: обычное художественное, матовое или антибликовое (музейное).
                </p>
                <p> Обязательным нужно отметить то, что каждая вышивка консервируется, это служит отличной защитой от
                    пыли, изменения влажности в помещении и других факторов, повреждающих ваше произведение.</p>
                <p>
                    Одна и та же вышивка может быть обрамлена совершенно разными способами, главная задача сохранить
                    вышивку на долгие годы и радовать своего владельца!
                </p>

            </div>
            <div class="col-12 col-md-6 my-auto text-center order-1 order-md-2">
                <img src="/img/article/IMG_8833.png" style="
                      max-width: 80%;
                      height: auto;
                    ">
                <br>
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