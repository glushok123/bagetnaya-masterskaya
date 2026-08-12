<?php
$keywords = "Багет для картин, рамка для фото, заказать рамку";
$title = "Оформление в багет фотографий и картин в Багетной мастерской №1";
$description = "Обрамить изделие в красивую раму на заказ в Багетной мастерской №1, доверяйте профессионалам.";

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
            .dash-list,
            .final-note {
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
            <h1 class="color-main">Оформление в багет для картин и фотографий в<br>Багетной мастерской №1</h1>
        </div>

        <!-- Блок 1: фото СЛЕВА (2 шт.), текст СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-4">
                <img src="/img/article/baget_kartina_1.jpg" class="article-img hug-right" alt="Фотография в деревянном багете">
                <img src="/img/article/baget_kartina_2.jpg" class="article-img hug-right" alt="Фигурная рама для фотографии">
            </div>
            <div class="col-12 col-md-8">
                <p>
                    Багет для картин: что это такое, для чего он нужен и как выбрать подходящую раму – ответы
                    на эти вопросы подготовила команда Багетной мастерской №1!
                </p>
                <p>
                    Картина, вышивка, эстамп, плакат, художественная фотография, постер, офорт и другие
                    художественные произведения – это искусство, которым принято украшать пространства. Если
                    произведение выполнено на бумаге, то без повреждения повесить его будет невозможно, и
                    сохранить на долгое время также не получится. Для того, чтобы разместить фото или картину
                    на поверхности понадобится заказать рамку.
                </p>
            </div>
        </div>

        <!-- Блок 2: фото СЛЕВА, текст СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-4">
                <img src="/img/article/baget_kartina_3.jpg" class="article-img hug-right" alt="Круглая рама для фото">
            </div>
            <div class="col-12 col-md-8">
                <p style="text-indent: 0; margin-bottom: 8px;"><b>Назначение рам:</b></p>
                <ul class="dash-list">
                    <li>Утилитарная функция рамы – защита произведения от пыли, грязи и солнечных лучей.</li>
                    <li>Декоративная функция – украшения пространства.</li>
                    <li>Эстетическая функция – подчеркнуть глубину произведения.</li>
                </ul>
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

        <!-- Полноширинный текст -->
        <div class="row article-block">
            <div class="col-12">
                <p>
                    Рамка для фото или картины может располагаться на вертикальной или горизонтальной
                    поверхности. Для рам до размера 24*30 – есть ножки для того, чтобы ее расположить стоя. Для
                    рам большего размера как правило ножки не предусмотрены, но иногда мы можем изготовить
                    ножки на заказ если позволяют технические характеристики багета, а именно размер работы и
                    ширина багета. На все остальные рамы предусмотрена фурнитура которая позволит расположить
                    картину на стене. Для расположения картины на стене в качестве фурнитуры используются
                    подвесные пластины, D-кольца или зубчатые пластины. Если размер картины позволяет делать
                    одну точку подвески – используется так же стальной трос, который подбирается мастером по
                    весу картины.
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

        <!-- Блок 3: текст СЛЕВА, 2 фото СПРАВА -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-8">
                <p>
                    Багет для картин будет отличаться от готовой рамы не только индивидуально изготовленным
                    размером рамы, а также в таких деталях как задник. Задник может быть съёмный на гибких
                    лепестках или поворотных лепестках, а также задник может быть зашит и законсервирован, что
                    позволит сохранить работу от пыли, изменения влажности и других влияний окружающей среды.
                </p>
                <p>
                    Если на вашей работе или фотографии есть важные записи на оборотной стороне, мы также
                    поможем сохранить ее в визуальном доступе, задник может быть закрыт стеклом или
                    плексигласом, а также листом паспарту с индивидуально вырезанным окошком под памятную
                    запись или другое. Рамка для фото, заказанная индивидуально может быть и с различными
                    видами стекла.
                </p>
                <p>
                    Для старых фотографий лучше заказать рамку с музейным (антибликовым) стеклом с защитой от
                    УФ-лучей, которое поможет сохранить памятные фотографии на долго. Для работ с большими
                    цветовыми пятнами или противоположно мелкими элементами, которые хочется завуалировать и
                    при этом оставить работу без яркого блика – подойдет матовое стекло. Во всех остальных
                    случаях обычное художественное стекло 2 мм толщины. Если рамка для фото будет висеть в
                    детской комнате или в пространстве где предполагаются динамичные события – лучше
                    использовать плексиглас. Это тонкий пластик, который при падении не даст осколков.
                </p>
            </div>
            <div class="col-12 col-md-4">
                <img src="/img/article/baget_kartina_4.jpg" class="article-img hug-left" alt="Картина в багетной раме">
                <img src="/img/article/baget_kartina_5.jpg" class="article-img hug-left" alt="Пейзаж в багетной раме">
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

        <!-- Финальная строка -->
        <div class="row">
            <p class="final-note">
                Обрамить изделие, заказать рамку в Багетной мастерской №1, это увлекательный процесс, который
                позволит вам окунуться в мир разнообразия вариантов настенного декора.
            </p>
        </div>

        <!-- Подпись -->
        <div class="row text-center mt-3 mb-5">
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
