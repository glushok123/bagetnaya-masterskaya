<?php
$keywords = "Телевизор в рамке, рамка для экрана, рамка для дисплея, рамка для телевизора";
$title = "Багетные рамы для телевизоров, стильное решение для классического интерьера";
$description = "Рамка для телевизора- профессиональное оформление, выполнение работы под ключ командой Багетной мастерской №1";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
    <style>
        .article-block {
            margin-bottom: 25px;
        }

        .article-block p {
            color: #474A51;
            font-family: Manrope;
            font-size: 20px;
            font-weight: 400;
            text-align: justify;
            text-indent: 30px;
        }

        .article-img {
            display: block;
            width: 100%;
            max-width: 340px;
            height: auto;
            border-radius: 6px;
            margin-bottom: 16px;
        }

        .hug-right {
            margin-left: auto;
            margin-right: 0;
        }

        .hug-left {
            margin-left: 0;
            margin-right: auto;
        }

        .center-img {
            margin-left: auto;
            margin-right: auto;
        }

        h1.color-main,
        h2.color-main {
            text-transform: uppercase;
        }

        @media screen and (max-width: 767px) {

            .article-block p {
                font-size: 16px;
                text-align: left;
                text-indent: 0;
            }

            .article-img {
                max-width: 260px;
                margin-left: auto;
                margin-right: auto;
            }

            h1.color-main,
            h2.color-main {
                font-size: 24px;
            }
        }
    </style>

    <div class="container home_design">

        <!-- H1 -->
        <div class="row text-center mt-3 mb-4">
            <h1 class="color-main">Багетные рамы для телевизоров: стильное<br>решение для классического интерьера</h1>
        </div>

        <!-- Вступление -->
        <div class="row article-block">
            <div class="col-12">
                <p>
                    Современный мир, который нас окружает, состоит из мониторов, дисплеев и экранов. Монитор
                    компьютера или телевизионная панель являются связующим информационным звеном между нами и
                    внешним миром. Не смотря на всю современность и обиходность дисплеев иногда они совершенно
                    не вписываются в задуманный интерьер.
                </p>
                <p>
                    Для объединения экранов и пространства отличным инструментом выступает рамка для дисплея,
                    рамка для экрана и рамка для телевизора. Экранная техника отлично обрамляется в багет.
                    Чтобы стилистика интерьера читалась и в таких деталях, как рамка для телевизора,
                    понадобится грамотный подбор багета. Дизайнеры, менеджеры и мастера команды Багетной
                    мастерской №1 подберут и рассчитают нужный вариант рам исходя из эстетических и
                    технических характеристик вашего интерьера и изделия.
                </p>
            </div>
        </div>

        <!-- Кнопка: Рассчитать стоимость багета -->
        <div class="row text-center justify-content-center mt-3 mb-4">
            <a href="/baget_online">
                <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white">
                    Рассчитать стоимость багета
                </button>
            </a>
        </div>

        <!-- Полноширинный текст -->
        <div class="row article-block">
            <div class="col-12">
                <p>
                    Вам будут предложены рамы из полистирола, дерева и алюминия, а если среди готовых образцов
                    не будет подходящего варианта, мы сможем сделать раму по вашему индивидуальному запросу.
                    Такие рамы изготавливаются с нуля и только для Вас, начиная с подбора дерева: дуб, бук или
                    сосна, а также разработки макета и покрытия и окрашивания рамы. Второй такой рамы вы не
                    найдете! Индивидуальный дизайн и покраска, которая может включать элементы золочения и
                    состаривания, украсят Ваш интерьер и подчеркнут его эксклюзивность.
                </p>
            </div>
        </div>

        <!-- Два фото: изготовление на станке + готовая рама на ТВ -->
        <div class="row article-block justify-content-center align-items-center">
            <div class="col-12 col-md-6">
                <img src="/img/article/tv_baget_1.jpg" class="article-img center-img" alt="Изготовление багетной рамы для телевизора на станке">
            </div>
            <div class="col-12 col-md-6">
                <img src="/img/article/tv_baget_2.jpg" class="article-img center-img" alt="Телевизор в багетной раме в интерьере спальни">
            </div>
        </div>

        <!-- Кнопка: Оставить заявку на обратную связь -->
        <div class="row text-center justify-content-center mt-3 mb-5">
            <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white"
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь
            </button>
        </div>

        <!-- H2 -->
        <div class="row text-center mt-3 mb-4">
            <h2 class="color-main">
                Рамка для телевизора – профессиональное оформление, выполнение<br>
                работы под ключ командой Багетной мастерской №1
            </h2>
        </div>

        <!-- Блок: фото СЛЕВА, текст СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-4">
                <img src="/img/article/tv_baget_3.jpg" class="article-img hug-right" alt="Телевизор в золотой багетной раме на мраморной стене">
            </div>
            <div class="col-12 col-md-8">
                <p>
                    Рамка для телевизора требует тщательной подготовки. Перед изготовлением рамы понадобятся
                    очень точные параметры: длина, ширина, диагональ, толщина экрана, расположение кнопок и
                    других элементов.
                </p>
                <p>
                    Для того чтобы замеры были точными, команда Багетной мастерской №1 предлагает услуги по
                    выездному подбору багета и замерам, а также монтаж готовой рамы на вашем объекте!
                </p>
                <p>
                    Мы понимаем важность каждой детали, поэтому наш подход к каждому клиенту индивидуален. Мы
                    готовы предложить решения, которые соответствуют не только вашим эстетическим
                    предпочтениям, но и техническим требованиям.
                </p>
            </div>
        </div>

        <!-- Кнопка: Как подобрать багет для картины -->
        <div class="row text-center justify-content-center mt-3 mb-4">
            <a href="/baget_for_karini">
                <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white">
                    Как подобрать багет для картины
                </button>
            </a>
        </div>

        <!-- Подпись -->
        <div class="row text-center mb-5">
            <p class="fst-italic">
                С уважением к Вам,<br>
                С любовью к Искусству!<br>
                Багетная мастерская №1
            </p>
        </div>

    </div>

<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
