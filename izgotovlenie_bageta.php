<?php
$keywords = "Багетная мастерская, круглая рамка, рамка на заказ";
$title = "Рамки на заказ любой формы в Багетной мастерской №1";
$description = "Фигурные рамы для картин и зеркал: создаем рамы любой сложности!";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>

<style>
    .font-20 {
        font-size: 20px;
    }

    p {
        color: #474A51;
        font-family: Manrope;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        padding-bottom: 15px;
    }

    h3 {
        font-family: Cormorant Garamond;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
    }

    .block-1-flex {
        display: grid;
        grid-template-columns: 1fr 2fr 1fr;
        gap: 40px;
        align-items: start;
    }

    .block-1-flex.mobile {
        display: none;
    }

    .block-1-flex .img-block-1 {
        width: 250px;
        height: 342px;
        object-fit: cover;
    }

    .block-1-flex .flex-images {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .block-2-flex {
        display: grid;
        grid-template-columns: 1fr 4fr;
        gap: 40px;
        align-items: start;
    }

    .block-2-flex .img-block-2 {
        width: 300px;
        max-width: 100%;
        height: auto;
    }

    .block-3-flex {
        display: grid;
        grid-template-columns: 4fr 1fr;
        gap: 40px;
        align-items: start;
    }

    .block-3-flex .img-block-3 {
        width: 300px;
        max-width: 100%;
        height: auto;
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

    @media (max-width: 1000px) {
        .block-1-flex.desctop {
            display: none;
        }

        .block-1-flex.mobile {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 180px;
            gap: 24px;
        }

        .block-1-flex.mobile .img-block-1 {
            width: 180px;
            height: 250px;
        }
    }

    @media (max-width: 768px) {
        .home_design {
            padding-left: 16px;
            padding-right: 16px;
        }

        .home_design .row {
            margin-left: 0;
            margin-right: 0;
        }

        .home_design .mt-5 {
            margin-top: 2rem !important;
        }

        .home_design .mb-5 {
            margin-bottom: 2rem !important;
        }

        .block-h1 {
            font-size: 32px;
            line-height: 1.1;
        }

        h2 {
            font-size: 28px;
            line-height: 1.2;
        }

        h3 {
            font-size: 30px;
            line-height: 1.15;
        }

        h4 {
            font-size: 24px;
            line-height: 1.2;
        }

        p,
        li {
            font-size: 18px;
            line-height: 1.55;
        }

        ul {
            padding-left: 20px;
            margin-bottom: 0;
        }

        .highlight-btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 100%;
            padding: 16px 20px;
            font-size: 15px;
            text-align: center;
        }

        .block-1-flex.mobile,
        .block-2-flex,
        .block-3-flex {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .block-1-flex.mobile .flex-images {
            order: -1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .block-1-flex.mobile .img-block-1,
        .block-2-flex .img-block-2,
        .block-3-flex .img-block-3 {
            width: 100%;
            max-width: 100%;
            height: auto;
            border-radius: 16px;
        }

        .block-1-flex.mobile .img-block-1 {
            aspect-ratio: 3 / 4;
        }

        .block-2-flex,
        .block-3-flex {
            text-align: left !important;
        }

        .block-2-flex .text-center,
        .block-3-flex .text-center {
            text-align: left !important;
        }
    }

    @media (max-width: 480px) {
        .block-h1 {
            font-size: 26px;
        }

        h2 {
            font-size: 24px;
        }

        h3 {
            font-size: 26px;
        }

        h4 {
            font-size: 20px;
        }

        p,
        li {
            font-size: 16px;
        }
    }
</style>

<div class="container home_design">

    <div class="row text-center mt-3 mb-5">
        <h1 class="color-main block-h1">РАМКИ НА ЗАКАЗ ЛЮБОЙ ФОРМЫ</h1>
        <h1 class="block-h1">В БАГЕТНОЙ МАСТЕРСКОЙ №1</h1>
    </div>

    <div class="block-1-flex desctop">
        <img src="/img/article/IMG_3714.JPG" alt="" class="img-block-1">
        <div>
            <h3>Багетные рамы для картин –</h3>
            <p>это важный элемент обрамления, который соединяет художественный сюжет и окружающую обстановку,
                создавая цельный образ для современных интерьеров. Как жилые и офисные пространства обретают
                сложность и многогранность, так и мода в багетном обрамлении также не стоит на месте! </p>
            <p>

                В данной статье рассказываем, что умеет и может предложить для реализации команда Багетной
                мастерской №1!</p>
        </div>
        <img src="/img/article/IMG_3717.JPG" alt="" class="img-block-1">
    </div>

    <div class="block-1-flex mobile">

        <div>
            <h3>Багетные рамы для картин –</h3>
            <p>это важный элемент обрамления, который соединяет художественный сюжет и окружающую обстановку,
                создавая цельный образ для современных интерьеров. Как жилые и офисные пространства обретают
                сложность и многогранность, так и мода в багетном обрамлении также не стоит на месте! </p>
            <p>

                В данной статье рассказываем, что умеет и может предложить для реализации команда Багетной
                мастерской №1!</p>
        </div>
        <div class="flex-images">
            <img src="/img/article/IMG_3714.JPG" alt="" class="img-block-1">
            <img src="/img/article/IMG_3717.JPG" alt="" class="img-block-1">
        </div>
    </div>

    <div class="row text-center justify-content-center mt-3 mb-5">
        <a href="/baget_online">
            <button class="highlight-btn">Рассчитать стоимость багета</button>
        </a>
    </div>

    <div class="block-2-flex mt-5">
        <img src="/img/article/IMG_3731.JPEG" alt="" class="img-block-2">
        <div>
            <h2>МАТЕРИАЛЫ БАГЕТА</h2>
            <p class="pt-3">Самые распространенные материалы, используемые в багетных салонах, это:</p>
            <p class="color-main">- дерево, сосна; полистирол; алюминий</p>
            <p>Рамы из этих материалов поставляются рейками, что позволяет быстро и качественно подготовить
                прямоугольную раму подходящего дизайна.</p>
            <p>В нашем ассортименте Вы также можете получить раму из таких пород древесины, как:</p>
            <p class="color-main">- дуб, бук, ясень и береза</p>
            <p>Рамы из этих материалов изготавливаются индивидуально: разные формы и размеры – от миниатюрных круглых
                рамок до багетных рам «как в Третьяковской галерее»!</p>
            <a href="/baget_for_karini">
                <button class="highlight-btn">Как подобрать багет для картины</button>
            </a>
        </div>
    </div>

    <div class="block-2-flex mt-5">
        <img src="/img/article/IMG_3715.JPG" alt="" class="img-block-2">
        <div>
            <h2 class="text-center">ФОРМА И ЦВЕТ</h2>
            <p class="color-main text-center mt-4">Широкий выбор багета различных цветов, фактур и ширины: в наших салонах Вы можете ознакомиться с большим
                ассортиментов совершенно разных багетов!</p>
            <p class="text-center">Кроме того, Вы можете заказать совершенно индивидуальный цвет и форму Вашей будущей рамы: наши дизайнеры
                разрабатывают макеты будущих проектов, а мастера воплощают их в жизнь с особым вниманием к деталям!</p>
            <div class="row text-center justify-content-center mt-3 mb-5">

                <button class="highlight-btn " data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на
                    обратную связь
                </button>

            </div>
        </div>

    </div>

    <div class="block-3-flex mt-5">
        <div class="">
            <h2 class="text-center color-main">СРОКИ И СТОИМОСТЬ</h2>
            <p class="mt-5">Оформляя заказ в багетной мастерской  помнить, что спешка не дружит с качеством. Однако некоторый ориентир по срокам можно дать следующий:</p>
            <ul>
                <li>Средний срок изготовления рамы из таких материалов, как сосна и полистирол, составляет 3-7 календарных дней в зависимости от сложности и объема заказа.</li>
                <li>Алюминий – до 10 календарных дней.</li>
                <li>Рамки на заказ из ценных пород дерева нестандартных форм и параметров – от 14 календарных дней!</li>
            </ul>
            <p class="color-main mt-5">При необходимости получения заказа быстрее – сообщите об этом менеджеру!
                Остались вопросы? С радостью ответим Вам в кратчайшие сроки!</p>
        </div>
        <img src="/img/article/IMG_3718.JPG" alt="" class="img-block-3">
    </div>


    <div class="row text-center mt-5">
        <h4>С уважением к Вам,</h4>
        <h4>С любовью к Искусству! </h4>
        <h4>Команда Багетной мастерской №1</h4>
    </div>
</div>


<?

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>]
