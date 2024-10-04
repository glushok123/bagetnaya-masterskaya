<?php
$keywords = "Рамка для картины, купить рамку, багет для картины";
$title = "Купить рамку для Вашей картины и не только: уникальные оформления произведений искусства в Багетной мастерской №1";
$description = "Создавайте красоту вместе с нами! Широкий ассортимент багета для картин и других объектов искусства в сети Багетных мастерских №1!";

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
            <h1 class="color-main mb-3">РАМКА ДЛЯ КАРТИНЫ <br> ИНДИВИДУАЛЬНЫЙ ПОДХОД К КАЖДОЙ РАБОТЕ
            </h1>
        </div>
        <div class="row text-center">
            <p class="my-auto">Любой предмет искусства, будь то картина художника или памятные фотографии и атрибуты,
                заслуживает быть достойно сохраненным. Самый популярный способ защитить, сохранить и приумножить красоту
                и значимость таких объектов – это оформление в багетные рамы с остеклением!</p>
        </div>


        <div class="row m-3">
            <div class="col-12 col-md-5 my-auto text-center">
                <img src="/img/article/IMG_2576.JPG" style="
                      max-width: 80%;
                      height: auto;
                    ">
                <br>
            </div>
            <div class="col-12 col-md-7 my-auto <? if (isMobile()) { ?> text-center <? } ?>">
                <p class="my-auto">
                    В наших салонах Багетной мастерской №1 мы стараемся держать максимально широкий ассортимент багета
                    для картин и не только: образцы из дерева, пластика, а также образцы металлических рам – большое
                    множество различных вариантов позволяет нашим специалистам подобрать индивидуальное и стилистически
                    верное оформление для живописи, медалей и орденов, современных постеров и спортивных атрибутов!
                    Смотрите наш каталог готовых работ!
                </p>


            </div>
        </div>

        <div class="row text-center justify-content-center  mb-5">
            <a href="/сatalog-of-finished-works">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    каталог готовых работ</b></button>
            </a>
        </div>

        <div class="row text-center mt-3 mb-5">
            <h1 class="mb-3">КАК ВЫБРАТЬ БАГЕТНУЮ РАМУ
            </h1>
        </div>
        <div class="row text-center">
            <p class="my-auto">Чтобы оформление Вашей работы получилось красивым и гармоничным, мы рекомендуем
                придерживаться следующих основных правил в выборе рамки для картины:</p>
            <p class="my-auto">1. Багет для картины должен помочь сфокусировать внимание зрителя именно на сюжете!
                Выбирайте подходящие формы и цвета: а лучше воспользуйтесь помощью специалиста. В наших салонах Вы
                можете получить консультацию совершенно бесплатно!</p>
            <p class="my-auto">2. Следует заранее определить, где объект искусства будет расположен в дальнейшем.
                Понимание окружающего интерьера упросит задачу подбора оформления рамки на заказ!</p>
        </div>

        <div class="row text-center justify-content-center  mb-5">
            <a href="/baget_online">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Рассчитать
                    стоимость багета
                </button>
            </a>
        </div>

        <div class="row text-center mt-3 mb-5">
            <h1 class="mb-3">СПОСОБЫ ОФОРМЛЕНИЯ ЗАКАЗА
            </h1>
        </div>

        <div class="row m-3">
            <div class="col-12 col-md-5 my-auto text-center">
                <img src="/img/article/IMG_7292.JPG" style="
                      max-width: 80%;
                      height: auto;
                    ">
                <br>
                <img src="/img/article/IMG_6239.JPG" style="
                      max-width: 80%;
                      height: auto;
                    ">
            </div>
            <div class="col-12 col-md-7 my-auto <? if (isMobile()) { ?> text-center <? } ?>">
                <p class="my-auto">
                    • <b>Посещение салонов Багетной мастерской №1</b><br>
                    Самый верный способ выбрать подходящее оформление – это посетить салон Багетной мастерской №1 вместе
                    с планируемым к оформлению объектом: большой выбор багета, паспарту и сопутствующих материалов, а
                    также грамотный специалист поможет Вам подобрать идеальное оформление!

                </p>
                <p class="my-auto">
                    • <b>Выездной подбор багета</b><br>
                    Если посещение салона по некоторым обстоятельствам не предоставляется возможным – запланируйте
                    встречу с нашим дизайнером! В рамках данной услуги наш специалист приезжает к Вам домой или офис с
                    образцами для подбора. Выездной подбор багета – идеальный вариант для тех, кому важна гармоничная
                    уместность материалов в существующем интерьере!

                </p>
                <p class="my-auto">
                    • <b>ONLINE-Конструктор багета</b><br>
                    В нашем конструкторе багета Вы можете самостоятельно выбрать понравившееся оформление и оформить
                    заказ удаленно! Мы стараемся постоянно пополнять ассортимент конструктора, а также внимательно
                    следим за его актуальностью! Здесь Вы можете купить рамку и выбрать удобный адрес самовывоза!

                </p>

            </div>
        </div>


        <div class="row text-center mt-3 mb-5">
            <h1>ГОТОВЫЕ ИЗДЕЛИЯ В БАГЕТНОЙ МАСТЕРСКОЙ №1</h1>

        </div>
        <div class="row text-center">
            <p class="my-auto">В наших салонах Вы можете купить рамку без ожидания срока готовности: большое количество
                багетных изделий различных размеров и дизайнов уже ждут Вас! Важно: уточняйте наличие в салонах Багетной
                мастерской №1!</p>
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