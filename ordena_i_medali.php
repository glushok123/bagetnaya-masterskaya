<?php
$keywords = "Рамка для медалей, ордена и медали, оформить медали";
$title = "Оформить медали, сохранить память на долгие годы";
$description = "Ордена и медали в раме, как лучше оформить советы и рекомендации от Багетной мастерской №1";

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

        h3.color-main {
            font-family: Cormorant Garamond, 'Times New Roman', serif;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 24px;
            margin-bottom: 16px;
        }

        .num-list {
            padding-left: 22px;
            margin: 0;
            color: #474A51;
            font-family: Manrope;
            font-size: 20px;
            font-weight: 400;
        }

        .num-list li {
            text-align: justify;
            margin-bottom: 10px;
        }

        /* большой финальный текст */
        .big-note p {
            font-size: 24px;
            text-indent: 0;
        }

        h1.color-main,
        h2.color-main {
            text-transform: uppercase;
        }

        @media screen and (max-width: 767px) {

            .article-block p,
            .num-list {
                font-size: 16px;
            }

            .article-block p,
            .num-list li {
                text-align: left;
                text-indent: 0;
            }

            .big-note p {
                font-size: 18px;
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

            h3.color-main {
                font-size: 20px;
            }
        }
    </style>

    <div class="container home_design">

        <!-- H1 -->
        <div class="row text-center mt-3 mb-4">
            <h1 class="color-main">Рамка для медалей: сохранить память на долгие<br>годы</h1>
        </div>

        <!-- Вступление -->
        <div class="row article-block">
            <div class="col-12">
                <p>
                    Наша страна имеет длинную и насыщенную историю, которую создают люди. Многообразие
                    отраслей, структур, подразделений, направлений, которые ежедневно занимаются общественно
                    значимой деятельностью.
                </p>
                <p>
                    Важнейшие подвиги, события и открытия, достижения отмечают памятными медалями, значками,
                    орденами, дипломами и грамотами. Если диплом или грамоту чаще удостаивают местом на стене,
                    то ордена и медали как правила остаются в коробочках и ящичках. История остается в
                    глубинах комнат.
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

        <!-- Два примера оформления медалей -->
        <div class="row article-block justify-content-center align-items-center">
            <div class="col-12 col-md-5">
                <img src="/img/article/medali_1.jpg" class="article-img center-img" alt="Медаль в багетной раме с паспарту">
            </div>
            <div class="col-12 col-md-5">
                <img src="/img/article/medali_2.jpg" class="article-img center-img" alt="Медаль на ленте в раме со стеклом">
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
                    Сохранить память, продлить жизнь выдающимся событиям поможет рамка для медалей и оформление
                    в багет. Как и живописное произведение, графику или артефакт, ордена и медали могут быть
                    оформлены таким образом, что с легкостью впишутся в ваш интерьер, будь то офис или жилое
                    помещение.
                </p>
                <p>
                    Особенность оформления медалей состоит в том, чтобы создать объемный короб с открывающейся
                    рамкой. Нужный объем создается благодаря компоновке нескольких багетных рамок, с
                    использованием паспарту. Нужный эффект достигается с помощью компоновки медалей, орденов и
                    удостоверений к ним, а также шевронов и других наградных аксессуаров.
                </p>
            </div>
        </div>

        <!-- Блок с советами: фото СЛЕВА, заголовок + нумерованный список СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-4">
                <img src="/img/article/medali_3.jpg" class="article-img hug-right" alt="Ордена и медали с фотографией в раме-коллаже">
            </div>
            <div class="col-12 col-md-8">
                <h3 class="color-main">Ордена и медали в раме – как лучше оформить: советы и рекомендации от Багетной мастерской №1:</h3>
                <ol class="num-list">
                    <li>Выбирайте багет, подходящий под интерьер по цвету или материалу, чтобы он гармонично вписывался в ваш интерьер;</li>
                    <li>Выбирайте паспарту светлее по тону, чем металл, из которого изготовлены ордена и медали;</li>
                    <li>Оформить медали лучше в раму со стеклом обычным художественным или антибликовым (музейным), чтобы были видны все мелкие детали;</li>
                    <li>Придайте композиции законченность, используя несколько медалей разных размеров и форм. Это добавит динамики и интереса к вашему оформлению;</li>
                    <li>Обратите внимание на освещение: размещение рамки с медалями в хорошо освещенном месте позволит не только подчеркнуть их красоту, но и будет способствовать сохранению их первоначального вида;</li>
                    <li>Если ордена и медали имеют значимую историю, дополните оформление текстовыми вставками, например, кратким описанием достижения или именем награжденного. Это придаст композиции индивидуальность и станет прекрасным дополнением к визуальному восприятию;</li>
                    <li>Не забывайте о размере рамки. Рамка для медалей должна гармонично сочетаться с другими элементами интерьера и не затмевать саму награду;</li>
                    <li>Если у вас есть множество медалей и наград, рассмотрите возможность создания коллажа. Так вы сможете представить сразу несколько достижений и рассказать целую историю, которая будет радовать глаз и напоминать о важных моментах в вашей жизни.</li>
                </ol>
            </div>
        </div>

        <!-- Кнопка: Рамки для картин -->
        <div class="row text-center justify-content-center mt-3 mb-5">
            <a href="/ramki_dlya_kartin">
                <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white">
                    Рамки для картин
                </button>
            </a>
        </div>

        <!-- Блок: текст СЛЕВА, фото СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-8">
                <p>
                    Наша Багетная мастерская №1 предлагает вам уникальные решения для оформления медалей и
                    наград. Мы поможем вам выбрать подходящие материалы, цвета и формы, исходя из ваших
                    предпочтений и стиля интерьера. С помощью наших мастеров вы сможете не просто оформить
                    медали, а получить настоящее произведение искусства, которое будет вдохновлять и радовать
                    вас и ваших близких.
                </p>
            </div>
            <div class="col-12 col-md-4">
                <img src="/img/article/medali_4.jpg" class="article-img hug-left" alt="Орден и удостоверение в раме на бархате">
            </div>
        </div>

        <!-- Блок: фото СЛЕВА, крупный текст СПРАВА -->
        <div class="row article-block big-note align-items-center">
            <div class="col-12 col-md-4">
                <img src="/img/article/medali_5.jpg" class="article-img hug-right" alt="Памятный знак в багетной раме">
            </div>
            <div class="col-12 col-md-8">
                <p>
                    Помните, что каждый орден и каждая медаль – это не просто предмет, а символ ваших
                    достижений и упорства. Давайте вместе сохранять эту память.
                </p>
            </div>
        </div>

        <!-- Подпись -->
        <div class="row text-center mt-2 mb-5">
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
