<?php
$keywords = "Багет для картины, рамка для фото, выбрать рамку, рамка на заказ";
$title = "Как правильно подобрать багет для картины — советы багетной мастерской №1";
$description = "Пошаговая инструкция по выбору рамки, паспарту и стиля оформления картины. Практичные советы от команды багетной мастерской №1.";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>

    <style>
        .section-title {
            font-family: Cormorant Garamond;
            color: #C6110F;
            font-weight: bold;
            text-align: center;
            margin: 40px 0 20px;
            text-transform: uppercase;
            font-size: 40px;
        }

        .highlight-btn {
            background-color: #a3080d;
            color: white;
            border: none;
            padding: 20px 35px;
            font-size: 16px;
            border-radius: 4px;
            margin: 15px 0;
            max-width: fit-content;

        }

        .highlight-btn:hover {

            background-color: #870000;
            color: #fff;
        }

        .icon-check {
            color: #00a651;
            margin-right: 6px;
        }

        .section-text {
            font-size: 24px;
            font-family: 'Manrope', sans-serif;
            color: #474A51;
        }

        .garamond {
            font-family: Cormorant Garamond, serif;
            font-size: 22px;
        }

        img {
            border-radius: 10px;
            max-width: 100%;
            height: auto;
        }

        .img-left {
            display: block;
            margin-right: auto;
        }

        .img-right {
            display: block;
            margin-left: auto;
        }

        @media screen and (max-width: 767px) {
            .mt-5 {
                margin-top: 20px !important;
            }

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
                max-width: calc(100% - 20px);
            }

            img {
                max-height: 100%;
                max-width: calc(100dvw - 80px);
                margin-bottom: 15px;
            }

            .my-auto {
                margin: 15px 0 !important;
            }

            .text-left {
                text-align: center;
            }

            .img-left,
            .img-right {
                margin: 0 auto !important;
            }

            .end-block {
                padding-left: 20px;
            }
        }

    </style>

    <div class="container home_design">
        <!-- Заголовок -->
        <div class="row">
            <h2 class="section-title text-center">
                КАК ПРАВИЛЬНО ПОДОБРАТЬ БАГЕТ ДЛЯ КАРТИНЫ: <br>
                РЕКОМЕНДАЦИИ КОМАНДЫ БАГЕТНОЙ МАСТЕРСКОЙ №1
            </h2>
        </div>

        <!-- Блок 1 -->
        <div class="row mt-4">
            <div class="col-sm-4">
                <img src="/img/article/telegram-cloud-photo-size-2-5425050076243422565-y%201.png" class="img-left"
                     alt="Багеты для оформления">
            </div>
            <div class="col-sm-8 section-text garamond my-auto">
                <p><strong>Выбор оформления для картины</strong> — это не просто вопрос эстетики, а важнейший этап,
                    который может либо подчеркнуть ее красоту, либо испортить впечатление. Правильно подобранная рама,
                    паспарту и стекло способны преобразить даже самую простую работу.</p>
                <p>В этой статье — ключевые принципы выбора оформления для разных типов картин.</p>
            </div>
        </div>

        <!-- ОПРЕДЕЛИТЕ СТИЛЬ КАРТИНЫ -->
        <div class="row mt-5">
            <h3 class="section-title">ОПРЕДЕЛИТЕ СТИЛЬ КАРТИНЫ</h3>
            <div class="col-sm-12 section-text garamond">
                <p>Первое, на что стоит обратить внимание, — это стиль произведения:</p>
                <ul>
                    <li><strong>Классическая живопись</strong> (масло, акварель) — подойдут изящные рамы с лепниной,
                        позолотой или патиной.
                    </li>
                    <li><strong>Современное искусство</strong> (графика, абстракция, поп-арт) — лучше смотрятся в
                        простых рамах: черных, белых, металлических, иногда — без рамы (на подрамнике).
                    </li>
                    <li><strong>Фотографии и постеры</strong> — чаще оформляют в тонкие рамки на заказ с паспарту
                        (картонным полем), чтобы создать воздушность.
                    </li>
                    <li><strong>Детские рисунки и акварельные скетчи</strong> — можно выбрать рамку в ярких,
                        нестандартных цветах и формах или комбинировать с ярким паспарту.
                    </li>
                </ul>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-sm-6"><img src="/img/article/Rectangle%206093.png" class="img-left" alt="Выбор багета">
            </div>
            <div class="col-sm-6"><img src="/img/article/Rectangle%206094.png" class="img-right" alt="Оформление заказа">
            </div>
        </div>

        <!-- ВЫБОР РАМЫ: МАТЕРИАЛ И ЦВЕТ -->
        <div class="row mt-5">
            <h3 class="section-title">ВЫБОР РАМЫ: МАТЕРИАЛ И ЦВЕТ</h3>
            <div class="col-sm-6 section-text garamond">
                <p><strong>Материалы рам:</strong></p>
                <ul>
                    <li><strong>Дерево</strong> — универсальный вариант, подходит для классики и современного искусства.
                    </li>
                    <li><strong>Металл</strong> (алюминий, сталь) — идеален для минимализма, черно-белой графики и фото,
                        современных постеров.
                    </li>
                    <li><strong>Пластик</strong> — бюджетный вариант, подходит для постеров, временного оформления.</li>
                    <li><strong>Экорамки</strong> — безвредное оформление между акриловым стеклом и задником.</li>
                </ul>
            </div>
            <div class="col-sm-6 section-text garamond">
                <p><strong>Цвет рам:</strong></p>
                <ul>
                    <li>Нейтральные оттенки (черный, белый, серый, натуральное дерево) — подходят большинству сюжетов.
                    </li>
                    <li>Контрастные цвета — усиливают эмоции, акценты на картине, но важно не переборщить.</li>
                    <li>Металлизированные покрытия — эффектно на офисные картины, фото, постеры.</li>
                </ul>
            </div>
        </div>

        <!-- Кнопка -->
        <div class="row text-center section-text mt-4">
            <p class="text-danger"><strong>Если возникают трудности с самостоятельным подбором, оставляйте заявку на
                    обратную связь и мы обязательно поможем выбрать рамку и подобрать подходящее оформление!</strong>
            </p>
            <button class="highlight-btn mx-auto" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку
                на обратную связь
            </button>
        </div>

        <!-- Блок: ПАСПАРТУ -->
        <div class="row mt-5">
            <h3 class="section-title">ПАСПАРТУ: НУЖНО ЛИ И КАК ВЫБРАТЬ?</h3>
            <div class="col-sm-4">
                <img src="/img/article/Rectangle%206095.png" class="img-left" alt="Паспарту">
            </div>
            <div class="col-sm-8 section-text garamond my-auto">
                <p><strong>Паспарту</strong> — это «воздух» работы, а именно плотный цветной картон между рамой и
                    изображением. Оно нужно, чтобы:</p>
                <ul>
                    <li>визуально отделить изображение от рамы;</li>
                    <li>защитить картину от контакта со стеклом (особенно важно для акварели и графики);</li>
                    <li>добавить «воздуха» и сделать композицию легче.</li>
                </ul>
                <p><strong>Важно:</strong> паспарту не используется в оформлении без багетной рамы!</p>
            </div>
        </div>

        <!-- КАК ОФОРМИТЬ ЗАКАЗ -->
        <div class="row mt-5">
            <h3 class="section-title">КАК ОФОРМИТЬ ЗАКАЗ В БАГЕТНОЙ МАСТЕРСКОЙ №1</h3>
            <div class="col-sm-12 section-text garamond">
                <ol>
                    <li><strong>Очное посещение салонов</strong><br> Три салона в центре Москвы с мастерами, которые
                        помогут выбрать рамку на заказ и декоративные элементы.
                    </li>
                    <li class="mt-3"><strong>Online-конструктор багета</strong><br> На сайте есть онлайн-конструктор,
                        где можно подобрать рамку и стекло.
                    </li>
                    <li class="mt-3"><strong>Удаленная работа с дизайнером</strong><br> Подходит для визуализации и
                        согласования вариантов.
                    </li>
                    <li class="mt-3"><strong>Выездной подбор багета</strong><br> Мастер приезжает к вам с образцами —
                        идеальный вариант.
                    </li>
                </ol>
            </div>

        </div>
        <div class="row mt-5">
            <div class="col-sm-6"><img src="/img/article/Rectangle%206096.png" class="img-left" alt="Выбор багета">
            </div>
            <div class="col-sm-6"><img src="/img/article/Rectangle%206097.png" class="img-right" alt="Оформление заказа">
            </div>
        </div>
        <!-- Кнопка финальная -->
        <div class="row text-center section-text mt-5">
            <p class="text-danger"><strong>Не нашли ответ? Оставляйте заявку на обратную связь и мы свяжемся с
                    Вами!</strong></p>
            <button class="highlight-btn mx-auto" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку
                на обратную связь
            </button>
        </div>
    </div>

<?

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>