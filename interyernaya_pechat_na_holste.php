<?php
$keywords = "Широкоформатная печать, печать на холсте, печать фото, картина на холсте";
$title = "Широкоформатная печать картин на холсте в Багетной мастерской №1";
$description = "Создание репродукций, печать на холсте и оформление в багет под ключ, в Багетной мастерской №1";

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

        /* 3 пункта-особенности с тире */
        .feature-list {
            list-style: none;
            padding-left: 0;
            margin: 0;
            color: #474A51;
            font-family: Manrope;
            font-size: 20px;
            font-weight: 400;
        }

        .feature-list li {
            text-align: justify;
            margin-bottom: 14px;
        }

        .feature-list li::before {
            content: "– ";
        }

        /* центральный текст в блоке из двух фото */
        .center-note {
            color: #474A51;
            font-family: Manrope;
            font-size: 20px;
            font-weight: 400;
            text-align: center;
        }

        /* горизонтальная линия-разделитель с кнопкой по центру */
        .btn-divider {
            position: relative;
            text-align: center;
            margin: 15px 0 40px;
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
            .feature-list,
            .center-note {
                font-size: 16px;
            }

            .article-block p,
            .feature-list li {
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
            <h1 class="color-main">Широкоформатная печать картин в<br>Багетной мастерской №1</h1>
        </div>

        <!-- Блок 1: текст СЛЕВА, фото СПРАВА (по центру по вертикали) -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-8">
                <p>
                    Искусство становится по настоящему великим, когда его копируют! Возможно изначально в это
                    выражение вкладывались другие смыслы, но мы рассмотрим данный вопрос со стороны картин на
                    холсте. Светский интерьер, холл отеля или государственное учреждение – это пространства, по
                    умолчанию в которых имеется настенный декор. Чаще всего таким элементом визуальной
                    нагрузки выступают картины, картины-оригиналы, репродукции и копии. Согласитесь, что
                    невозможно во все общественные здания или секретариаты повесить настоящую живопись, да и
                    бюджеты, как правило, на такое украшение выделяют достаточно скромные в сравнении со
                    стоимостью подлинной живописи. На помощь приходят репродукции и печать на холсте.
                </p>
            </div>
            <div class="col-12 col-md-4">
                <img src="/img/article/pechat_holst_1.jpg" class="article-img hug-left" alt="Картины на холсте в багетных рамах">
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

        <!-- Полноширинный текст -->
        <div class="row article-block">
            <div class="col-12">
                <p>
                    Интерьерная печать на холсте может повторить шедевр мирового изобразительного искусства без
                    претензий на оригинальность или подлинность! Это не подделка, а только демонстрация
                    уважения к данному произведению. Как прекрасно, что печать на хосте позволяет дополнить
                    интерьер мировыми художественными произведениями. Картина на холсте, напечатанная и
                    натянутая на подрамник и оформленная в подходящую раму, всегда будет хорошим дополнением к
                    интерьеру.
                </p>
                <p>
                    Если же нет желания наполнять интерьер старыми хитами, всегда есть фотографии! Для того,
                    чтобы у фотографии была долгая жизнь ее можно напечатать на холсте и сделать классическое
                    оформление.
                </p>
            </div>
        </div>

        <!-- H2 -->
        <div class="row text-center mt-3 mb-4">
            <h2 class="color-main">
                Преимущество печати фото на холсте в отличии от печати на<br>
                бумаге в трёх главных особенностях:
            </h2>
        </div>

        <!-- 3 особенности -->
        <div class="row article-block">
            <div class="col-12">
                <ul class="feature-list">
                    <li>
                        <b>формат:</b> холст почти не ограничен по размеру;
                    </li>
                    <li>
                        <b>оформление фотографии:</b> холст большого размера традиционно оформляется на
                        подрамник, в отличии от бумаги которую необходимо будет накатать или прижать стеклом.
                        Стекло в свою очередь добавляет вес, блик и лишает возможности оформления в тонкую
                        раму;
                    </li>
                    <li>
                        <b>деформация:</b> в исключительных случаях печать на холсте может деформироваться и
                        это зависит от совпадения многих факторов, бумага же впитывает влагу и терпит
                        различного рода трансформации на постоянной основе.
                    </li>
                </ul>
            </div>
        </div>

        <!-- Блок 3: фото — текст — фото -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-4">
                <img src="/img/article/pechat_holst_2.jpg" class="article-img hug-right" alt="Репродукция картины на холсте в багете">
            </div>
            <div class="col-12 col-md-4">
                <p class="center-note">
                    Создание репродукций, печать на холсте и оформление в багет под ключ, в Багетной
                    мастерской №1 – это экономия времени и гарантия высокого результата!
                </p>
            </div>
            <div class="col-12 col-md-4">
                <img src="/img/article/pechat_holst_3.jpg" class="article-img hug-left" alt="Фото на холсте в деревянной раме">
            </div>
        </div>

        <!-- Кнопка: Оставить заявку на обратную связь -->
        <div class="row text-center justify-content-center mt-3 mb-4">
            <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white"
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь
            </button>
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
