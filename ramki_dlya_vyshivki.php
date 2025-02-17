<?php
$keywords = "рамки для вышивки, оформление вышивки, купить рамку";
$title = "Где купить рамку для вышивки в Москве?";
$description = "Профессиональное оформление вышивок любой сложности в Багетной мастерской №1! ";
$gallery = "ramki_dlya_vyshivki";
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
        h3{
            font-family: Cormorant Garamond;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }
    </style>

    <div class="container">
        <div class="row text-center mt-3 mb-5">
            <h1 class="color-main block-h1">ОФОРМЛЕНИЕ ВЫШИВОК В БАГЕТНЫЕ РАМКИ:</h1>
            <h3 class="mt-3">КАК ПОДЧЕРКНУТЬ КРАСОТУ РУЧНОЙ РАБОТЫ</h3>
        </div>
        <div class="list-img">
            <div class="image">
                <img src="/img/article/IMG_8536%20(2).JPG" alt="Картинка">
            </div>
            <div class="image">
                <img src="/img/article/IMG_6094.JPG" alt="Картинка">
            </div>
            <div class="image">
                <img src="/img/article/IMG_0465.JPG" alt="Картинка">
            </div>
            <div class="image hide-mobile">
                <img src="/img/article/IMG_7410.JPG" alt="Картинка">
            </div>
        </div>
        <div class="row m-3 text-center">
            <p>
                Вышивка — это не просто рукоделие, это настоящее искусство, которое требует достойного оформления.
                Правильно подобранная рамка для вышивки может превратить вашу работу в изысканный элемент интерьера. В
                этой статье мы расскажем, как оформить разные виды вышивок в багетную рамку, на что обратить внимание
                при выборе и где купить рамку, которая идеально подойдёт для вашего творения.

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
            <h3>ПОЧЕМУ ВАЖНО ПРАВИЛЬНО ОФОРМИТЬ ВЫШИВКУ?</h3>
        </div>

        <div class="row m-3 text-center">
            <p>
                Оформление вышивки — это завершающий этап, который придаёт работе законченный вид. Рамка не только
                защищает вышивку от пыли и повреждений, но и подчёркивает её красоту. Неправильно подобранная рамка
                может испортить впечатление даже от самой изысканной работы.

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
            <h3>КАК ВЫБРАТЬ РАМКУ ДЛЯ ВЫШИВКИ?</h3>
        </div>

        <div class="row m-3">
            <div class="col-12 col-md-4 text-center">
                <img src="/img/article/IMG_8595.JPG" style="
                        object-fit: cover;
                        height: auto;
                        width: 100%;
                        margin-left: -15px;
                        border-radius: 20px;
                    ">

            </div>
            <div class="col-12 col-md-8">
                <p style="color: #AD1F2D; padding-bottom: 0;">Соответствие стилю</p>
                <p style="padding-bottom: 0; margin-bottom: 5px;"
                   class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    - Для классической вышивки (крестиком, гладью) подойдут деревянные рамки в традиционных оттенках:
                    коричневый, белый, золото, серебро.
                </p>
                <p style="padding-bottom: 0; margin-bottom: 5px;"
                   class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    - Современные работы (абстракция, минимализм) лучше смотрятся в металлических или пластиковых
                    рамках.
                </p>
                <p class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    - Этнические мотивы гармонируют с деревянными рамками с резьбой или в стиле "кантри".
                </p>

                <p style="color: #AD1F2D; padding-bottom: 0;">Цвет рамки</p>
                <p style="padding-bottom: 0; margin-bottom: 5px;"
                   class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    - Выбирайте цвет, который сочетается с основными оттенками вышивки. Нейтральные цвета (белый,
                    бежевый, серый) подходят для большинства работ.
                </p>
                <p style="padding-bottom: 0; margin-bottom: 5px;"
                   class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    - Можно выбрать рамку, которая повторяет один из акцентных цветов вышивки.
                </p>
                <p style="padding-bottom: 0; margin-bottom: 5px;"
                   class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    - Уместно также использовать паспарту (декоративный цветной картон) при оформлении вышивки для
                    создания дополнительного воздуха
                </p>
            </div>
        </div>
        <div class="row">
            <p style="color: #AD1F2D; padding-bottom: 0;">Стекло или без стекла?</p>
            <p style="" class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                Сегодня вышивки оформляют как со стеклом, так и без стекла вовсе. Команда Багетной мастерской №1
                рекомендует придерживаться оформления со стеклом, чтобы защитить вышивку от возможных повреждений, грязи
                и пыли.
            </p>

        </div>
        <div class="row text-center justify-content-center mt-3 mb-5">

            <button
                    class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь</b></button>

        </div>

        <div class="row m-3 align-middle">
            <div class="col-12 col-md-8 my-auto">
                <p class="<? if (isMobile()) { ?> text-center <? } else { ?>text-end<? } ?> element-animation">
                    <b>1. Подготовка работы</b><br>
                    Перед оформлением постирайте и отутюжьте вышивку, чтобы она выглядела аккуратно.
                </p>

                <p class="<? if (isMobile()) { ?> text-center <? } else { ?>text-end<? } ?> element-animation">
                    <b>2. Определите цель оформления</b><br>
                    Если Вы планируете разместить оформленную работу у себя дома или
                    в офисе – заранее определите место и его площадь. Если планируете работа планируется как подарок –
                    уточните предпочтения у получателя.
                </p>
                <p class="<? if (isMobile()) { ?> text-center <? } else { ?>text-end<? } ?> element-animation">
                    <b>3. Обратитесь к специалисту</b><br>
                    В Багетной мастерской №1 Вы можете обратиться к специалисту для подбора подходящего оформления, а
                    также запросить бесплатную визуализацию будущей работы!
                </p>
            </div>
            <div class="col-12 col-md-4 text-center">
                <img src="/img/article/IMG_3353.JPG" style="
                        object-fit: cover;
                        height: auto;
                        width: 100%;
                        margin-left: -15px;
                        border-radius: 20px;
                    ">

            </div>
        </div>

        <div class="row m-3 text-center">
            <p><b>
                    Подбор багета для вышивки — это важный этап, который требует внимания к деталям. Правильно
                    подобранная
                    рамка подчеркнёт красоту вашей работы и сделает её настоящим украшением интерьера. Если вы
                    сомневаетесь
                    в выборе, обратитесь в Багетную мастерскую №1 — наши профессионалы помогут вам создать идеальное
                    оформление.
                </b>
            </p>
        </div>

        <div class="row m-3 text-center">
            <p>
                <b>
                    Теперь вы знаете, как выбрать рамку для вышивки, где купить рамку и как оформить вышивку, чтобы она
                    радовала вас долгие годы. Удачного оформления!</b>
            </p>
        </div>

        <div class="row text-center justify-content-center mt-3 mb-5 flex-but">
            <a href="/bagetnye_raboty">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Багетные работы</b></button>
            </a>
            <a href="/home_designer">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Выездной подбор</b></button>
            </a>
            <a href="/prices_for_print_and_canvas">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Комплект для картины</b></button>
            </a>
        </div>
        <div class="row text-center">
            <h3>С уважением к Вам,</h3>
            <h3>С любовью к Искусству! </h3>
            <h3>Команда Багетной мастерской №1</h3>
        </div>
    </div>


    <style>

        .flex-but{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
        }
        .list-img {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 20px;

            .image {
                width: 100%;
                height: 290px;

                img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    border-radius: 20px;
                }
            }
        }
        @media (max-width: 1200px) {
            .hide-mobile{
                display: none !important;
            }
            .list-img{
                grid-template-columns: 1fr 1fr 1fr;
                gap: 15px;
            }
            .flex-but{
                display: grid;
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        @media (max-width: 992px) {
            .text-end{
                text-align: left !important;
            }
            .button-custom-index{
                text-wrap: nowrap;
                font-size: 16px;
            }
            .list-img{
                height: 150px;
                .image{
                    img{
                        height: 130px;
                    }
                }

            }
            p{
                padding-right: 0 !important;
                padding-left: 0 !important;
                padding-bottom: 0 !important;
            }
            h3{
                font-size: 17px;
            }
            .mb-5{
                margin-bottom: 0 !important;
            }
        }
    </style>
<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>