<?php
$keywords = "Купить рамку, рамка для картины, пластиковая рамка";
$title = "Пластиковые рамки для картин в Багетной мастерской №1!";
$description = "Купить рамку для картины из пластика – долговечность, стиль и оперативное изготовление!";

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
            font-size: 50px;
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
            font-size: 30px;
            font-family: 'Manrope', sans-serif;
            color: #474A51;
        }
        .garamond{
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
            .mt-5{
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
            .end-block{
                padding-left: 20px;
            }
        }

    </style>
    <div class="container home_design">

        <!-- Блок 1 -->
        <div class="row">
            <h2 class="section-title text-center">РАМКИ ДЛЯ КАРТИН ИЗ ПЛАСТИКА: <br>ОСОБЕННОСТИ И ПРИМЕНЕНИЕ</h2>

            <!-- Картинка: снизу на мобильных -->
            <div class="col-sm-4 order-1 order-sm-1">
                <img src="/img/article/telegram-cloud-document-2-5285175076994442904 1.png" alt="Пластиковые багеты" class="img-responsive img-left">
            </div>

            <!-- Текст: сверху на мобильных -->
            <div class="col-sm-8 text-left section-text my-auto order-0 order-sm-2">
                <p>Рамки из полистирола — популярный и практичный вариант оформления фотографий, постеров, картин и документов. Они лёгкие, доступные по цене и представлены в разнообразных дизайнах.</p>
                <p>В этой статье разберем, из чего делают пластиковые рамки, где их лучше использовать, а также как оформить заказ!</p>
            </div>
        </div>


        <!-- Блок 2 -->
        <div class="row mt-5">
            <h3 class="section-title">ИЗ ЧЕГО ДЕЛАЮТ ПЛАСТИКОВЫЕ РАМКИ?</h3>
            <div class="col-sm-7 section-text my-auto">
                <p>Пластиковые багеты изготавливают из разных видов <strong>полимерных материалов</strong>. Чаще всего — из полистирола (PS), который отличается лёгкостью, жёсткостью и устойчивостью к деформации.</p>
                <p>Благодаря невысокой цене и большому выбору стилей, рамки из пластика — одно из самых популярных решений на рынке.</p>
            </div>
            <div class="col-sm-5">
                <img src="/img/article/telegram-cloud-document-2-5284991660416069623 1.png" alt="Примеры пластиковых рамок" class="img-responsive img-right">
            </div>
        </div>

        <div class="row text-center section-text mt-5 mb-4">
            <button class="highlight-btn mx-auto" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
        </div>
        <!-- Блок 3 -->
        <div class="row mt-5">
            <h3 class="section-title">ГДЕ ЛУЧШЕ ИСПОЛЬЗОВАТЬ ПЛАСТИКОВЫЕ РАМКИ?</h3>
            <div class="col-sm-6 section-text my-auto">
                <p><span class="icon-check">✅</span><strong>Фотографии и постеры</strong> – лёгкие, не создают нагрузку на крепления.</p>
                <p><span class="icon-check">✅</span><strong>Офисное оформление</strong> – сертификаты, таблички, дипломы (бюджетно и практично).</p>
                <p><span class="icon-check">✅</span><strong>Влажные помещения</strong> – не боятся воды, в отличие от деревянных рамок.</p>
                <p><span class="icon-check">✅</span><strong>Выставки и временные экспозиции</strong> – удобно перевозить и устанавливать.</p>
                <a href="/baget_online"><button class="highlight-btn">Рассчитать стоимость багета</button></a>
            </div>
            <div class="col-sm-6">
                <img src="/img/article/telegram-cloud-document-2-5285175076994442912 1.png" alt="Где использовать пластиковые рамки" class="img-responsive img-right">
            </div>
        </div>

        <!-- Блок 4 -->
        <div class="row mt-5">
            <h3 class="section-title">ПОЧЕМУ ВЫБИРАЮТ БАГЕТНУЮ МАСТЕРСКУЮ №1?</h3>
            <div class="col-sm-7 section-text">
                <p><strong>1. Индивидуальный размер</strong> — изготовим рамку под любые размеры.</p>
                <p><strong>2. Разнообразие профилей</strong> — ширина, фактура, имитация дерева или металла.</p>
                <p><strong>3. Качественная сборка</strong> — точная подгонка и крепления.</p>
                <p><strong>4. Дополнительные услуги</strong> — стекло, паспарту, монтаж.</p>
                <p><strong>5. Консультация специалиста</strong> — помощь в подборе под ваш интерьер.</p>
            </div>
            <div class="col-sm-5">
                <img src="/img/article/бм 5.3 2.png" alt="Рамки из пластика в интерьере" class="img-responsive img-right">
            </div>
        </div>

        <!-- Заключение -->
        <div class="row text-center section-text mt-5 mb-4">
            <p>Пластиковые рамки — идеальный выбор для оформления недорогих, но стильных решений. Хотите идеальный результат? <strong>Оставьте заявку на обратную связь</strong>, и наши мастера свяжутся с вами для консультации!</p>
            <button class="highlight-btn mx-auto" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
        </div>
        <div class="row section-text mt-5 mb-4 end-block">
            С уважением к Вам,<br>
            С любовью к Искусству!<br>
            Багетная мастерская №1
        </div>
    </div>
<?

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>