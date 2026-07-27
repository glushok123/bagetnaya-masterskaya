<?php
$keywords = "Интерьерное зеркало, зеркало в раме, зеркало на заказ, рама для зеркала";
$title = "Зеркало в раме – виды и решения для вашего интерьера";
$description = "Зеркало на заказ в раме под ключ в Багетной мастерской №1";

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

        /* списки с тире */
        .dash-list {
            list-style: none;
            padding-left: 0;
            margin: 8px 0 0;
            color: #474A51;
            font-family: Manrope;
            font-size: 20px;
            font-weight: 400;
        }

        .dash-list li {
            text-align: justify;
            margin-bottom: 10px;
        }

        .dash-list li::before {
            content: "– ";
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

            .article-block p,
            .dash-list {
                font-size: 16px;
            }

            .article-block p,
            .dash-list li {
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
            <h1 class="color-main">Зеркало в раме – виды и решения для вашего<br>интерьера</h1>
        </div>

        <!-- Блок 1: текст СЛЕВА, фото СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-8">
                <p>
                    Что является прототипом зеркала? Конечно это поверхность воды. Как в водной глади можно
                    увидеть окружающий мир, так и зеркало отражает действительность. Сложно представить,
                    например, ванную комнату без зеркала или примерочную комнату. Зеркало в раме или без него
                    встречаются в интерьерах и экстерьерах. Зеркала бывает следующих видов:
                </p>
                <ul class="dash-list">
                    <li>прямоугольной формы без рамы;</li>
                    <li>прямоугольной формы в раме;</li>
                    <li>круглое зеркало без рамы;</li>
                    <li>круглое зеркало в раме;</li>
                    <li>зеркало в раме с подсветкой;</li>
                    <li>зеркало хаотичной формы.</li>
                </ul>
            </div>
            <div class="col-12 col-md-4">
                <img src="/img/article/zerkalo_1.jpg" class="article-img hug-left" alt="Большое зеркало в резной золотой раме">
            </div>
        </div>

        <!-- Блок 2: фото СЛЕВА, текст СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-4">
                <img src="/img/article/zerkalo_2.jpg" class="article-img hug-right" alt="Зеркало в раме в интерьере галереи">
            </div>
            <div class="col-12 col-md-8">
                <p>
                    Это наиболее часто встречающие виды зеркал, реже в общественных интерьерах встречаются
                    арочные зеркала и зеркала других сложных форм. Когда нужно интерьерное зеркало –
                    предпочтение отдается зеркалам в раме. Удобное решение со многих сторон. Такое зеркало
                    легко монтировать на стену, за ним удобно ухаживать и неоспоримым бонусом будет то, что
                    правильно подобранная рама привнесет новые ноты в ваш интерьер.
                </p>
                <p>
                    Зеркало, обрамленное в раму может быть главным акцентом в пространстве или аксессуаром,
                    который дополнит его без лишнего внимания. Для того, чтобы рама для зеркала выполнила все
                    возложенные на нее задачи необходимы следующие шаги:
                </p>
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

        <!-- Блок 3: текст СЛЕВА, фото СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-8">
                <ul class="dash-list">
                    <li>
                        определить габаритный размер зеркала в раме (т е размер изделия, внешний размер рамы с
                        зеркалом);
                    </li>
                    <li>
                        определить стиль интерьера;
                    </li>
                    <li>
                        исходя из размеров и стиля подбирать раму: если зеркало больше 1,5 м² и рама будет из
                        пластика – стоит обратить внимание на рамы от 6 см шириной, так как более тонкая рама
                        может не выдержать веса стекла.
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-4">
                <img src="/img/article/zerkalo_3.jpg" class="article-img hug-left" alt="Фигурное зеркало в резной раме в интерьере">
            </div>
        </div>

        <!-- Кнопка: Оставить заявку на обратную связь -->
        <div class="row text-center justify-content-center mt-3 mb-5">
            <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white"
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь
            </button>
        </div>

        <!-- Блок 4: фото СЛЕВА, текст СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-4">
                <img src="/img/article/zerkalo_4.jpg" class="article-img hug-right" alt="Зеркало в золотой раме в санузле">
            </div>
            <div class="col-12 col-md-8">
                <p>
                    Для минималистичных решений подойдет багет из дерева и алюминия: при своей тонкости и
                    хрупкости рамы из такого материала будут крепкие и надежные. В санузлах гармонично будут
                    выглядеть рамы мозаичного типа с глянцевыми поверхностями, что наполнит пространство
                    дополнительным светом, ощущением воздуха и чистотой воды.
                </p>
                <p>
                    В коридорах, холлах, лобби, зонах прихожих зеркало в раме создает дополнительную
                    перспективу и увеличивают пространство. Для подбора рамы для зеркала воспользуйтесь
                    конструктором на нашем сайте или оставьте запрос на обратную связь, команда Багетной
                    мастерской №1 свяжется с вами и ответит на ваши вопросы.
                </p>
                <p>
                    Зеркало на заказ в раме под ключ в Багетной мастерской №1 это гарантия качества и
                    отличного результата.
                </p>
            </div>
        </div>

        <!-- Разделитель с кнопкой: Как подобрать багет для картины -->
        <div class="btn-divider">
            <a href="/baget_for_karini">
                <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 color-white">
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
