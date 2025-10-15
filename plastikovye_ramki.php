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
            <h2 class="section-title text-center">ПЛАСТИКОВЫЕ РАМКИ: <br>ДОЛГОВЕЧНОСТЬ, СТИЛЬ И ОПЕРАТИВНОЕ ИЗГОТОВЛЕНИЕ!</h2>

            <!-- Картинка: снизу на мобильных -->
            <div class="col-sm-4 order-1 order-sm-1">
                <img src="/img/article/telegram-cloud-document-2-5285175076994442904 1.png" alt="Пластиковые багеты" class="img-responsive img-left">
            </div>

            <!-- Текст: сверху на мобильных -->
            <div class="col-sm-8 text-left section-text my-auto order-0 order-sm-2">
                <p>Багет из полистирола – самый популярный материал в оформлении предметов искусства в бюджетном сегменте. С каждым годом качество этого материала увеличивается, а ассортимент дизайнов увеличивается!</p>
                <p>Купить рамку из пластика или заказать индивидуальное оформление в стильных и недорогих материалах можно в Багетной мастерской №1! Рассказываем об особенностях в данной статье!</p>
            </div>
        </div>


        <!-- Блок 2 -->
        <div class="row mt-5">
            <h3 class="section-title">РАМКИ ДЛЯ КАРТИН ИЗ ПОЛИСТИРОЛА: ПРЕИМУЩЕСТВА И НЕДОСТАТКИ</h3>
            <div class="col-sm-7 section-text my-auto">
                <p class="garamond"><strong>ГЛАВНЫЕ ПЛЮСЫ МАТЕРИАЛА:</strong></p>
                <ul class="section-text">
                    <li>- легкость: пластик намного легче, чем дерево или металл</li>
                    <li>- долговечность: пластик не боится влахи, сухости, солнца</li>
                    <li>- стоимость: сырье для изготовления пластиковых рамок значительно дешевле других аналогов.</li>
                </ul>
                <p class="garamond"><strong>ГЛАВНЫЕ МИНУСЫ МАТЕРИАЛА:</strong></p>
                <ul class="section-text">
                    <li>- малая практичность: полистирол не реставрируют. Если рама по каким-либо причинам потеряла привлекательный внешний вид – придется заменить полностью.</li>
                    <li>- малая прочность: купить рамку для зеркала или картины большого формата нельзя. Полистирол – недостаточно крепкий материал, чтобы выдерживать большой вес.</li>
                </ul>
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
            <h3 class="section-title">ЛУЧШЕЕ ПРИМЕНЕНИЕ ПОЛИСТИРОЛА</h3>
            <div class="col-sm-6 section-text my-auto">
                <p><span class="icon-check">✅</span><strong>Для чего:</strong> небольшие постеры и фотографии – выставки, мероприятия или для транспортировки</p>
                <p><span class="icon-check">✅</span><strong>Где:</strong> ванные комнаты, кухни – рамки из полистирола не боятся влаги, а также за ними легко ухаживать</p>
                <p><span class="icon-check">✅</span><strong>Когда:</strong> для временного оформления, или для неколлекционных работ</p>
                <p>Антикварные и коллекционные работы следует оформлять в деревянные профили, которые наиболее подходят для музейного обрамления. Пластиковые рамки, несмотря на их достоинства, не обладают необходимыми характеристиками и престижностью.</p>
                <a href="/baget_online"><button class="highlight-btn">Рассчитать стоимость багета</button></a>
            </div>
            <div class="col-sm-6">
                <img src="/img/article/telegram-cloud-document-2-5285175076994442912 1.png" alt="Где использовать пластиковые рамки" class="img-responsive img-right">
            </div>
        </div>

        <!-- Блок 4 -->
        <div class="row mt-5">
            <h3 class="section-title">ОФОРМЛЕНИЕ В БАГЕТНОЙ МАСТЕРСКОЙ №1: ПОЧЕМУ ВЫБИРАЮТ НАС</h3>
            <div class="col-sm-7 section-text">
                <p><strong>1.</strong> Любые индивидуальные форматы</p>
                <p><strong>2.</strong> Широчайший ассортимент багета</p>
                <p><strong>3.</strong> Качественная сборка в короткие сроки</p>
                <p><strong>4.</strong> Бесплатные консультации и подготовки визуализаций</p>
                <p><strong>5.</strong> Три салона в центре Москвы: удобное расположение и наличие парковочных мест!</p>
                <p><strong>6.</strong> Дополнительные услуги: профессиональная дорисовка, собственная доставка, выездные подборы к Вам домой!</p>
            </div>
            <div class="col-sm-5">
                <img src="/img/article/бм 5.3 2.png" alt="Рамки из пластика в интерьере" class="img-responsive img-right">
            </div>
        </div>

        <!-- Заключение -->
        <div class="row text-center section-text mt-5 mb-4">
            <p>В данной статье мы рассказали о самых ярких признаках рамок для картин из пластика, их особенностях и применении. Купить рамку из полистирола или заказать индивидуальный проект – выбор за Вами! Однако всегда прислушивайтесь к рекомендации специалиста!</p>
            <button class="highlight-btn mx-auto" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
        </div>
        <div class="row section-text mt-5 mb-4 end-block">
            С уважением к Вам,<br>
            С любовью к Искусству!<br>
            Команда Багетной мастерской №1
        </div>
    </div>
<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
