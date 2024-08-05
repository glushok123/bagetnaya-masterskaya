<?php
$keywords = "Багетная мастерская, выбрать рамку, дизайнер на дом";
$title = "Выездной подбор с Багетной мастерской №1 – выбираем рамки на территории Заказчика!";
$description = "Как идеально подобрать оформление картины к интерьеру? Команда Багетной мастерской №1 предлагает Вам воспользоваться услугой выезда дизайнера на дом!";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
    <style>

        @media screen and (max-width: 1200px) {
            .castom-image {
                width: 180px !important;
                height: 180px !important;
            }
        }

        @media screen and (max-width: 900px) {
            .castom-image {
                width: 170px !important;
                height: 170px !important;
            }
        }

        @media screen and (max-width: 760px) {
            .castom-image {
                width: 130px !important;
                height: 130px !important;
            }

            .card-body button {
                font-size: 14px;
            }

            .card-body div.row a {
                padding-left: 0px;
                margin-left: 0px;
            }
        }

        .castom-image {
            width: 100% !important;
            height: auto !important;
            max-height: 170px;
            object-fit: cover;
        }

        .card {
            padding-bottom: 10px;
            border-radius: 6px;
            border: 3px solid var(--beige, #E0D2BB);
            height: 350px !important;
        }

        .card:hover {
            background: #E0D2BB;
        }

        p {

            color: #474A51;
            font-family: Manrope;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            padding-bottom: 15px;

        }
        .home_design {
            font-family: Cormorant Garamond;
        }
    </style>
    <div class="container home_design">
        <div class="row text-center mt-3 mb-5">
            <h1 class="color-main mb-5">ВЫЕЗДНОЙ ПОДБОР БАГЕТА</h1>
            <h4>Как идеально подобрать оформление картины к интерьеру? Наша команда предлагает Вам воспользоваться
                замечательной услугой выездного подбора багета! </h4>
        </div>


        <div class="row m-3">
            <div class="col-12 col-md-5 my-auto">
                <img src="/img/article/photo_2024-08-05_12-56-39.jpg" style="
                      max-width: 100%;
                      height: auto;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-7 my-auto">
                <p class="my-auto">
                    Сегодня современный интерьер – это персонализированная история, которая раскрывает внутренний мир
                    проживающих или работающих в определенном пространстве. Не удивительно, что и требования к картинам
                    и рамам такие же: сегодня следует не просто выбрать рамку для картины, но также уместно вписать в
                    интерьер и подчеркнуть индивидуальность!
                </p>
                <p class="my-auto">
                    Приезд дизайнера на дом или офис поможет решить сразу несколько вопросов к оформлению, которые
                    невозможно решить в багетном салоне: какие оттенки наилучшим образом выглядят в пространстве? Какие
                    формы наиболее органичны? Какой итоговый размер картины будет выглядеть гармонично с окружающей
                    средой? Работа багетного дизайнера в интерьере позволяет безошибочно выбрать рамку и сопутствующие
                    материалы: Ваш офис или жилое пространство преобразится!
                </p>
            </div>
        </div>

        <div class="row text-center justify-content-center  mb-5">
            <a href="/baget_online">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Рассчитать стоимость багета</b></button>
            </a>
        </div>


        <div class="row m-3">
            <div class="col-12 col-md-7 my-auto text-end">
                <h3 class="mb-5">ЧТО ВХОДИТ В СТОИМОСТЬ:</h3>
                <p>• Предварительное согласование дизайна</p>
                <p>• Выезд специалиста с образцами багета и сопутствующими материалами </p>
                <p>• Расчет стоимости и согласование на месте</p>
                <p>• Визуализация будущего оформления в интерьере</p>
                <p>• Доставка «туда-обратно»</p>
            </div>
            <div class="col-12 col-md-5">
                <img src="/img/article/photo_2024-08-05_12-56-45.jpg" style="
                      max-width: 100%;
                      height: auto;
                    ">
                <br>
            </div>
        </div>
        <div class="row m-3 text-center">
            <p>Выездной подбор багета осуществляется в рабочее время с понедельника по пятницу. Стоимость данной услуги
                оговаривается отдельно и зависит от нескольких факторов: адрес, количество оформляемых картин, временной
                промежуток встречи. Для уточнения деталей оставляйте заявку на обратную связь с указанием на услугу
                выездного подбора багета!</p>
        </div>


        <div class="row text-center mt-3 mb-3 justify-content-center">

            <button
                    class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь</b></button>
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