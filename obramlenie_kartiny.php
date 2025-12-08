<?php
$keywords = "Багет для картины, рамка на заказ, купить рамку, рамка для фото";
$title = "Рамки на заказ и готовые изделия в салонах Багетной мастерской №1!";
$description = "Купить рамку для фото или заказать уникальный багет для картины со скидкой 10% на первый заказ!";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>

    <style>
        .section-title {
            font-family: Cormorant Garamond;
            color: #a3080d;
            font-weight: bold;
            text-align: center;
            margin: 40px 0 20px;
            text-transform: uppercase;
        }

        .highlight-btn {
            background-color: #a3080d;
            color: white;
            border: none;
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 4px;
            margin: 15px 0;
        }

        .highlight-btn:hover {
            background-color: #870000;
            color: #fff;
        }

        .section-text {
            font-size: 18px;
            font-family: 'Manrope', sans-serif;
            color: #474A51;
        }

        .garamond {
            font-family: Cormorant Garamond;
            font-size: 22px;
        }

        @media screen and (max-width: 767px) {
            .section-title {
                font-size: 24px;
                margin: 30px 0 15px;
            }

            .garamond {
                font-size: 18px;
            }

            .section-text {
                font-size: 16px;
            }

            .highlight-btn {
                width: 100%;
                padding: 12px 10px;
                font-size: 15px;
            }

            img {
                max-height: 200px;
                margin-bottom: 15px;
            }

            .text-left {
                text-align: center;
            }
        }

        img {
            border-radius: 10px;
            max-width: 100%;
            height: auto;
        }

        .img-custom {
            object-fit: contain;
        }

        .img-1 {
            max-width: 286px;
            max-height: 382px;
        }

        .img-2 {
            max-width: 396px;
            max-height: 561px;
        }

        .img-3 {
            max-width: 404px;
            max-height: 461px;
        }

        @media screen and (max-width: 767px) {
            .img-1 {
                max-width: 100%;
                height: auto;
                max-height: 376px;
            }

            .img-2 {
                max-width: 100%;
                height: auto;
                max-height: 412px;
            }

            .img-3 {
                max-width: 100%;
                height: auto;
                max-height: 340px;
            }
        }
    </style>

    <div class="container home_design">

        <!-- Блок 1 -->
        <div class="row text-center">
            <h2 class="section-title">БАГЕТ ДЛЯ КАРТИНЫ:<br>ВЫБИРАЕМ РАМЫ В БАГЕТНОЙ МАСТЕРСКОЙ №1</h2>
            <div class="col-sm-4 col-sm-offset-1">
                <img src="/img/article/telegram-cloud-photo-size-2-5425050076243422565-y%201%20(2).png"
                     class="img-responsive">
            </div>
            <div class="col-sm-6 text-left section-text my-auto">
                <p>Картины, постеры и фотографии в рамах часто украшают домашние и рабочие пространства. Чтобы
                    по-настоящему создавать уместные объекты искусства – обратите Ваше внимание на рамки на заказ: любые
                    нестандартные форматы и формы, подходящие именно Вам – именно такие проекты создает команда Багетной
                    мастерской №1!</p>
                <p>Рамки для фото и картин – это не только красивый завершающий элемент декора. Багетное обрамление
                    также имеет защитную функцию для изображения как от механических повреждений, так и от других
                    окружающих факторов. В данной статье рассказываем, как происходит процесс обрамления в Багетной
                    мастерской №1 и как купить рамку для Вашего предмета искусства!</p>

                <a href="/baget_online">
                    <button class="highlight-btn">Рассчитать стоимость багета</button>
                </a>
            </div>
        </div>

        <!-- Блок 2 -->
        <div class="row">
            <h3 class="section-title">ПРОЦЕСС ОБРАМЛЕНИЯ: ПРИНЦИП «ОТКРЫТОЙ КУХНИ»</h3>
            <div class="col-sm-8 section-text text-center  my-auto">
                <p>1. Прием заказа в работу:</p>
                <p>В наших салонах представлено большое количество вариантов багета из алюминия, дерева и полистирола, а
                    также различные текстурные паспарту, канты и многое другое! Наши специалисты подбирают оформление
                    Ваших работ на основе Ваших предпочтений и необходимостей. </p>
                <p>2. Процесс оформления картин</p>
                <p>После выбранных и согласованных рамок для фото или картин в течение 2-5 дней в зависимости от объема
                    и сложности мы подготавливаем все материалы и оформляем картины. Вы можете как оставить картины в
                    салоне или принести их непосредственно на монтаж в раму. Принцип работы наших салонов – «открытая
                    кухня» - где Вы можете лично наблюдать за работой мастера!</p>
                <p>3. Выдача готового изделия</p>
                <p>Как только Вы получили оповещение о готовом заказе – Вы можете забрать Вашу картину! Упаковка
                    включает в себя защитные транспортные уголки и стрейч-пленку. Если Вам небходима более надежная
                    упаковка или подарочный вариант – сообщите об этом!</p>
                <button class="highlight-btn" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на
                    обратную связь
                </button>
            </div>
            <div class="col-sm-4">
                <img src="/img/article/IMG_2602%202.png" class="img-responsive" style="margin-bottom:15px;">
                <img src="/img/article/IMG_2602%203.png" class="img-responsive">
            </div>
        </div>

        <!-- Блок 3 -->
        <div class="row">
            <h3 class="section-title">КАК ОФОРМИТЬ ЗАКАЗ В БАГЕТНОЙ МАСТЕРСКОЙ №1</h3>
            <div class="col-sm-8 section-text text-center my-auto">
                <p>Подбор багета для картины – процесс увлекательный. Иногда удается найти вариант с первых минут
                    работы, но случаются и более длительный труд по подбору. Фактуры, цвета и формы – специалисты
                    Багетной мастерской №1 всегда стараются найти лучший вариант! Для Вашего удобства, процесс подбора
                    рамки на заказ может быть следующим: </p>
                <ul>
                    <li>посещение салонов Багетной мастерской №1</li>
                    <li>общение со специалистами в мессенджерах </li>
                    <li>оформление заказа в online-конструкторе багета</li>
                    <li>услуга выездного подбора багета </li>
                </ul>
                <p>Перед тем как купить рамку, проконсультируйтесь со специалистом: он поможет подобрать оптимальный
                    вариант под стиль изображения и интерьера.</p>
                <p>В случае, если Вам не удалось найти подходящее готовое решение, Вы можете воспользоваться услугой
                    express-заказа! Подробнее читайте в статье:</p>
                <a href="/express_zakaz.php">
                    <button class="highlight-btn">Express-заказ</button>
                </a>
            </div>
            <div class="col-sm-4">
                <img src="/img/article/image%20707.png" class="img-responsive"
                     style="margin-bottom:15px; max-width: 200px;">
                <img src="/img/article/IMG_2602%204.png" class="img-responsive" style="max-width: 200px;">
            </div>
        </div>

        <!-- Заключение -->
        <div class="row text-center section-text" style="margin: 40px 0;">
            <p>В наших салонах также представлено некоторое количество готовых изделий, поэтому Вы можете купить рамку по очень приятной стоимости!</p>

            <a href="/сatalog-of-finished-works">
                <button class="highlight-btn">Галерея готовых работ</button>
            </a>

            <p>Создавайте красоту вместе с нашей командой!</p>
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