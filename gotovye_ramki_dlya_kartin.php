<?php
$keywords = "Рамка для картины, купить рамку, рамка а4, купить багет для картины";
$title = "Готовые рамка для картин разных форматов в Багетной мастерской №1";
$description = "Быстрое оформление: как выбрать готовую рамку для вашего изделия в Багетной мастерской №1";

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
            max-width: 300px;
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

        /* линия-разделитель с кнопкой по центру */
        .btn-divider {
            position: relative;
            text-align: center;
            margin: 15px 0 30px;
        }

        .btn-divider::before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            border-top: 1px solid #e0d9d0;
            z-index: 0;
        }

        .btn-divider a {
            position: relative;
            z-index: 1;
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
            <h1 class="color-main">Быстрое оформление: как выбрать готовую рамку<br>для вашего изделия</h1>
        </div>

        <!-- Блок 1: текст СЛЕВА, фото СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-8">
                <p>
                    В жизни каждого из нас иногда возникает необходимость быстро оформить произведение
                    искусства, фотографию или диплом. Идеальным решением в таких случаях служит покупка
                    готовой рамки. Багетные салоны, такие как наша мастерская, предлагают купить багет для
                    картины разных форматов, что позволяет выбрать идеальный вариант для любого изделия.
                </p>
            </div>
            <div class="col-12 col-md-4">
                <img src="/img/article/gotovaya_ramka_1.jpg" class="article-img hug-left" alt="Готовые рамки для картин в интерьере">
            </div>
        </div>

        <!-- Кнопка: Рассчитать стоимость багета -->
        <div class="row text-center justify-content-center mt-3 mb-5">
            <a href="/baget_online">
                <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white">
                    Рассчитать стоимость багета
                </button>
            </a>
        </div>

        <!-- Блок 2: фото СЛЕВА, текст СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-4">
                <img src="/img/article/gotovaya_ramka_2.jpg" class="article-img hug-right" alt="Готовая рамка для картины">
            </div>
            <div class="col-12 col-md-8">
                <p>
                    Когда время играет на руку, а ждать индивидуально изготовленную рамку некогда, готовые
                    решения становятся настоящим спасением. На нашей витрине представлены на выбор: рамка а4,
                    а3, а5, а6 форматов, а также квадратные и вытянутые нестандартные рамы. Такой ассортимент
                    позволяет легко купить рамку, подходящую для вашего оформления фотографии, картины или
                    диплома.
                </p>
            </div>
        </div>

        <!-- Кнопка: Оставить заявку на обратную связь -->
        <div class="row text-center justify-content-center mt-3 mb-5">
            <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white"
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь
            </button>
        </div>

        <!-- Полноширинный текст -->
        <div class="row article-block">
            <div class="col-12">
                <p>
                    Качество рамок будет такое же, как и при изготовлении рам на заказ. Большинство из них
                    изготовлены из полистирола, что делает их легкими и доступными по цене.
                </p>
                <p>
                    Тем не менее, мы также предлагаем деревянные и алюминиевые багеты для тех, кто
                    предпочитает более традиционные или современные материалы. Это позволяет купить багет для
                    картины, который будет гармонично вписываться в интерьер вашего дома или офиса.
                </p>
            </div>
        </div>

        <!-- Блок 3: текст СЛЕВА, фото СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-8">
                <p>
                    Если подготовленная вами работа немного меньше выбранной рамки, это не повод для
                    переживания! В Багетной мастерской №1 всегда есть в наличии паспарту, которые помогут
                    заполнить недостающее пространство и сделают оформление ещё более привлекательным. Это
                    позволит не только эстетически улучшить композицию, но и подчеркнуть значимость вашего
                    произведения.
                </p>
            </div>
            <div class="col-12 col-md-4">
                <img src="/img/article/gotovaya_ramka_3.jpg" class="article-img hug-left" alt="Готовые деревянные рамки для фотографий">
            </div>
        </div>

        <!-- Полноширинный текст -->
        <div class="row article-block">
            <div class="col-12">
                <p>
                    Рамка для картины может быть со стеклом и без него. Мы предлагаем различные варианты
                    стекол: пластиковое, обычное художественное, матовое или антибликовое.
                </p>
                <p>
                    Те, кто предпочитает минималистичный подход, могут выбрать рамки без стекла. В дополнение к
                    этому, вы сможете выбрать задник из переплетного картона или пенокартона разной толщины,
                    что сделает ваше оформление ещё более надежным и красивым.
                </p>
                <p>
                    Одним из основных преимуществ готовых рам является их стоимость. Они в значительной степени
                    дешевле, чем индивидуально изготовленные варианты, что позволяет вам сэкономить деньги и
                    время без потери качества.
                </p>
                <p>
                    Таким образом, если вам срочно нужно оформить ваше изделие, не упустите возможность
                    посетить нашу Багетную мастерскую №1 и купить рамку!
                </p>
            </div>
        </div>

        <!-- Разделитель с кнопкой: Рамки для картин -->
        <div class="btn-divider">
            <a href="/ramki_dlya_kartin">
                <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 color-white">
                    Рамки для картин
                </button>
            </a>
        </div>

        <!-- Подпись -->
        <div class="row text-center mb-5">
            <p class="fst-italic">
                С уважением к Вам,<br>
                С любовью к Искусству!<br>
                Команда Багетной мастерской №1
            </p>
        </div>

    </div>

<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
