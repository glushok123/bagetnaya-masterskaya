<?php
$keywords = "Рамка для картины, багетная мастерская, картина на подрамнике";
$title = "Обрамление живописи: варианты, способы и стоимость рамок для картины в Багетной мастерской №1!";
$description = "Дизайнерский подбор и оформление картин на подрамнике с командой профессионалов!";

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
        .show-mobile{
            display: none;
        }
    </style>
    <div class="container">
        <div class="row text-center mt-3 mb-5">
            <h1 class="color-main block-h1">ОФОРМЛЕНИЕ ЖИВОПИСИ</h1>
            <h3 class="mt-3">ИСКУССТВО ЗАВЕРШЕНИЯ ХУДОЖЕСТВЕННОГО ПРОИЗВЕДЕНИЯ МАСЛОМ</h3>
        </div>
        <div class="flex-1">
            <div class="img f100">
                <img src="/img/article/IMG_8571.jpg" alt="Картинка">
                <img src="/img/article/IMG_5569.jpg" alt="Картинка" class="show-mobile">
                <img src="/img/article/IMG_2376%20(1).jpg" alt="Картинка" class="show-mobile">
            </div>
            <div>
                <p>
                    Оформление живописи в Багетной мастерской №1 — это важный этап, который завершает процесс создания
                    художественного произведения. Правильно подобранная рамка для картины не только защищает изображение
                    от внешних воздействий, но и подчеркивает её эстетическую ценность, гармонично вписывая её в
                    интерьер. В этой статье мы рассмотрим основные аспекты выбора и оформления картин на подрамнике.
                </p>
            </div>
            <div class="img hide-mobile">
                <img src="/img/article/IMG_5569.jpg" alt="Картинка">
            </div>
        </div>
        <div class="row text-center mt-3 mb-5">
            <h3>ЗАЧЕМ НУЖНА БАГЕТНАЯ РАМА</h3>
        </div>
        <div class="text-center custom">
            <p style="font-weight: bold">Багетная рама выполняет несколько функций:</p>
            <p><span style="color: #AD1F2D;">Эстетическая:</span> рама завершает композицию, подчеркивает стиль и
                цветовую гамму картины </p>
            <p><span style="color: #AD1F2D;">Защитная:</span> защищает края холста от повреждений, а также предохраняет
                картину от пыли и возможных механических воздействий (в случае составной рамы со стеклом).</p>
            <p><span style="color: #AD1F2D;">Декоративная:</span> рама может стать элементом интерьера, связывая картину
                с окружающим пространством.</p>
            <p class="mt-3">Читайте подробнее о картинах на подрамниках и видах натяжки в нашей статье!</p>
        </div>
        <div class="row text-center justify-content-center  mb-5">
            <a href="/natyazhka_holsta/">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Натяжка холстов</b></button>
            </a>
        </div>

        <div class="row text-center mt-3 mb-5">
            <h3>КАК ВЫБРАТЬ РАМКУ ДЛЯ КАРТИНЫ</h3>
        </div>

        <div class="flex-2">
            <div>
                <p style="font-weight: bold">Багетная рама выполняет несколько функций:</p>
                <p><span style="color: #AD1F2D;">Стиль картины:</span> для классической живописи лучше подойдут
                    деревянные рамы с резьбой или позолотой, а для современного искусства — минималистичные алюминиевые
                    или пластиковые рамы.</p>
                <p><span style="color: #AD1F2D;">Цветовая гамма:</span> рама должна гармонировать с основными цветами
                    картины. Она может быть нейтральной (чтобы не отвлекать внимание от произведения) или контрастной
                    (чтобы подчеркнуть определённые
                    элементы).</p>
                <p><span style="color: #AD1F2D;">Размер и пропорции:</span> ширина рамы должна соответствовать размеру
                    картины. Для больших полотен лучше выбирать широкие рамы, а для небольших работ — узкие. Однако все
                    очень индивидуально и следует получить консультацию специалиста багетной мастерской!
                    Интерьер: рама должна сочетаться с общим стилем помещения, где будет находиться картина. Так общий
                    вид пространства будет сбалансирован. В противном случае картина станет акцентным элементом
                    интерьера!</p>
                <div class="row text-center justify-content-center mt-3 mb-5">
                    <a href="/baget_online">
                        <button
                                class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                            Рассчитать стоимость багета</b></button>
                    </a>
                </div>
            </div>
            <div class="flex-image hide-mobile">
                <div class="img">
                    <img src="/img/article/IMG_6524%20(1).jpg" alt="Картинка">
                </div>
                <div class="img">
                    <img src="/img/article/IMG_0477%20(2).jpg" alt="Картинка">
                </div>
            </div>
        </div>

        <div class="row text-center mt-3 mb-5">
            <h3>СОВЕТЫ ПО ОФОРМЛЕНИЮ МАСЛЯНОЙ ЖИВОПИСИ</h3>
        </div>
        <div class="row m-3 flex-4">
            <div class="col-12 col-md-4 text-center hide-mobile">
                <img src="/img/article/IMG_2376%20(1).jpg" style="
                        object-fit: cover;
                        height: auto;
                        width: 100%;
                        margin-left: -15px;
                        border-radius: 20px;
                    ">

            </div>
            <div class="col-12 col-md-8 my-auto">
                <p style="padding-bottom: 0; margin-bottom: 5px;"
                   class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    - Не бойтесь экспериментировать с формой и цветом рамы, но помните, что она должна дополнять, а не
                    перебивать картину.
                </p>
                <p style="padding-bottom: 0; margin-bottom: 5px;"
                   class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    - Если Вы хотите оформить живопись под стекло, выбирайте многосоставные варианты, чтобы стекло не
                    касалось мазков работы!
                </p>
                <p style="padding-bottom: 0; margin-bottom: 5px;"
                   class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    - Если картина большая, выбирайте раму с крепким каркасом, чтобы обеспечить
                    устойчивость.
                </p>
                <p class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    - Обратитесь к профессионалам, если сомневаетесь в выборе. Команда Багетной мастерской №1 поможет
                    подобрать оптимальное решение!
                </p>
            </div>
        </div>

        <div class="row text-center justify-content-center mt-3 mb-5">

            <button
                    class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь</b></button>

        </div>

        <div class="row text-center mt-3 mb-5">
            <h3>УХОД ЗА РАМКОЙ ДЛЯ КАРТИНЫ</h3>
        </div>
        <div class="row m-3 flex-4">
            <div class="col-12 col-md-4 text-center">
                <img src="/img/article/IMG_0454.jpg" style="
                        object-fit: cover;
                        height: auto;
                        width: 100%;
                        margin-left: -15px;
                        border-radius: 20px;
                    ">

            </div>
            <div class="col-12 col-md-8 my-auto">
                <p style="font-weight: bold">Чтобы рама и картина сохраняли свой вид долгие годы, следуйте простым
                    правилам:</p>
                <p style="padding-bottom: 0; margin-bottom: 5px;"
                   class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    - Регулярно очищайте раму от пыли мягкой тканью.
                </p>
                <p style="padding-bottom: 0; margin-bottom: 5px;"
                   class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    - Избегайте попадания влаги на рамы, чтобы предотвратить возможную деформацию или испортить
                    пленочное покрытие.
                </p>
                <p class="element-animation <? if (isMobile()) { ?> text-center <? } ?>">
                    - Храните картины в сухих помещениях, защищённых от прямых солнечных лучей.
                </p>
            </div>
        </div>
        <div class="row m-3 text-center">
            <p>
                Оформление живописи в багетные рамы — это не просто технический процесс, а настоящее искусство.
                Правильно подобранная рама способна преобразить картину, подчеркнуть её достоинства и сделать её
                настоящим украшением интерьера. Уделите внимание выбору, и ваше произведение искусства заиграет
                новыми красками!

            </p>
        </div>
        <div class="row text-center mt-5">
            <h4>С уважением к Вам,</h4>
            <h4>С любовью к Искусству! </h4>
            <h4>Команда Багетной мастерской №1</h4>
        </div>
    </div>


    <style>
        .flex-1 {
            display: grid;
            grid-template-columns: 1fr 3fr 1fr;
            gap: 20px;
            text-align: center;
            align-items: center;
        }

        .flex-1 .img {
            width: 100%;

            img {
                width: 100%;
                border-radius: 8px;
                object-fit: cover;
            }
        }

        .custom p {
            margin-bottom: 0;
        }

        .flex-2 {
            display: grid;
            grid-template-columns: 3fr 1fr;
            gap: 20px;
            align-items: center;
        }

        .flex-2 .flex-image {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .flex-2 .flex-image .img {
            width: 100%;
            height: 270px;

            img {
                width: 100%;
                height: 100%;
                border-radius: 8px;
                object-fit: cover;
            }
        }

        @media (max-width: 750px) {

            .flex-1 {
                display: grid;
                grid-template-columns: 1fr;
                gap: 20px;
                text-align: center;
                align-items: center;
            }
            .flex-1 .img {
                width: 100%;
                img {
                    object-fit: cover;
                    width: 100%;
                    border-radius: 8px;
                }
            }

            .f100{
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 10px;
            }
            .f100 img{
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .show-mobile{
                display: block;
            }
            .hide-mobile{
                display: none !important;
            }
            .flex-2{
                grid-template-columns: 1fr;
            }
        }
    </style>
<?

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>