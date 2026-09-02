<?php
$keywords = "багет для икон, рамка для иконы, рамки на заказ, рама для иконы";
$title = "Багет для икон – простое и доступное решение оформления";
$description = "Советы по оформлению икон в рамы от Багетной Мастерской №1!";

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

        /* финальная строка красным по центру */
        .final-note {
            color: #AD1F2D;
            font-family: Manrope;
            font-size: 20px;
            font-weight: 500;
            text-align: center;
            max-width: 1000px;
            margin: 10px auto 0;
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
            .final-note {
                font-size: 16px;
            }

            .article-block p {
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
            <h1 class="color-main">Багет для икон – простое и доступное решение<br>оформления</h1>
        </div>

        <!-- Блок 1: фото СЛЕВА, текст СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-4">
                <img src="/img/article/baget_ikony_1.jpg" class="article-img hug-right" alt="Икона в резной золочёной раме">
            </div>
            <div class="col-12 col-md-8">
                <p>
                    Рама для иконы – простое и понятное решение, когда не хочется оформлять икону в киот. В
                    современной интерпретации икон киот не всегда является уместным. Например, у вас есть
                    вышивка Образа, который занимает важное место в вашей жизни, и вы хотите лаконично вписать
                    его в ваш интерьер. Рамка для иконы будет правильным решением. Многообразие багетов
                    позволяет сделать рамки на заказ любого подходящего дизайна и материала.
                </p>
            </div>
        </div>

        <!-- Полноширинный текст -->
        <div class="row article-block">
            <div class="col-12">
                <p>
                    Для иконы вышитой крестиком подойдет одинарный багет, не слишком широкий и более плоский.
                    Декоративные элементы будут только отвлекать от кропотливого труда рукодельницы, которая
                    вышила это произведение. Для икон, вышитых бисером и драгоценными камнями лучше
                    использовать двойной багет, для того, чтобы избежать прикосновений стекла и материала.
                    Такие работы органично выглядят в багетах шириной 5-6 см с золочением и декоративными
                    орнаментами.
                </p>
                <p>
                    Иконы и Образы, изображенные на бумаге, могут быть оформлены в простые рамы. Багет для икон
                    часто подбирают с цветной частью, которая перекликается с цветом на иконе, что еще больше
                    объединяет икону с рамой.
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

        <!-- H2 -->
        <div class="row text-center mt-3 mb-4">
            <h2 class="color-main">Советы по оформлению икон в рамы от Багетной Мастерской №1:</h2>
        </div>

        <!-- Блок 2: текст СЛЕВА, фото СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-8">
                <p>
                    При выборе багетного оформления стоит учитывать не только стиль, но и саму композицию.
                    Например, если вы предпочитаете сделать акцент на изображении – выбирайте строгую рамку
                    нейтрального цвета.
                </p>
                <p>
                    Если же вы хотите добавить Вашему интерьеру дополнительный акцент, то попробуйте
                    использовать рамки с орнаментом или в ярких цветах.
                </p>
            </div>
            <div class="col-12 col-md-4">
                <img src="/img/article/baget_ikony_2.jpg" class="article-img hug-left" alt="Икона в деревянной раме с килевидным навершием">
            </div>
        </div>

        <!-- Кнопка: Оставить заявку на обратную связь -->
        <div class="row text-center justify-content-center mt-3 mb-5">
            <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white"
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь
            </button>
        </div>

        <!-- Блок 3: фото СЛЕВА, текст СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-4">
                <img src="/img/article/baget_ikony_3.jpg" class="article-img hug-right" alt="Бисерные иконы в багетных рамах">
            </div>
            <div class="col-12 col-md-8">
                <p>
                    Современные интерьеры часто требуют нестандартных решений. В нашем ассортименте Вы найдете
                    багет для икон, который идеально подойдет для Ваших предпочтений.
                </p>
                <p>
                    Простые формы и чистые линии рамок позволят сделать икону акцентом в интерьере, не
                    перегружая пространство лишними деталями. Если ваш интерьер выполнен в классическом стиле,
                    не бойтесь добавлять элементы, подчеркивающие красоту и достоинство иконы.
                </p>
                <p>
                    В этом случае можно использовать багеты с художественными орнаментами и золочением. Такие
                    багеты отнесут вас к традиционному обрамлению, что подчеркнет духовную значимость и
                    ценность вашего произведения искусства.
                </p>
            </div>
        </div>

        <!-- Финальная строка -->
        <div class="row">
            <p class="final-note">
                Рама для иконы – это больше, чем просто элементы оформления. Она создает гармоничное сочетание
                с вашим интерьером, подчеркивает стилистические особенности и защищает вашу икону от внешних
                негативных воздействий. Выбирайте багет с умом и заботой, и ваш Образ будет радовать вас на
                протяжении долгих лет!
            </p>
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
