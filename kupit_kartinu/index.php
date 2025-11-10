<?php
$keywords = "Купить картину, картина для дома, интерьерная картина";
$title = "Продажа интерьерных картин для дома – оригинальные готовые решения для себя и в подарок!";
$description = "Купить картину художника, постер или репродукцию – найдите идеальную готовую работу в Багетной мастерской №1!";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
<div class="container">
    <div class="row text-center mt-3 mb-4">
        <h1 class="color-main block-h1">ОРИГИНАЛЫ И РЕПРОДУКЦИИ<br>
            ГОТОВЫЕ ИНТЕРЬЕРНЫЕ КАРТИНЫ, ДОСТУПНЫЕ К ПОКУПКЕ
        </h1>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-12 col-lg-10">
            <p class="element-animation<? if (isMobile()) { ?> text-center<? } ?>">
                Багетная мастерская №1 – это место, где Вы можете не только заказать индивидуальное оформление для Ваших
                работ, но также купить картину или репродукцию известного художника! Мы регулярно стараемся пополнять
                ассортимент, а также сотрудничаем с молодыми художниками. Большую часть готовых работ Вы можете увидеть
                в салонах на м. Арбатская и м. Баррикадная. Кроме того, Вы можете приобрести картину для дома или офиса
                через сайт с бесплатной доставкой по г. Москва в проделах МКАД!
            </p>
        </div>
    </div>

    <div class="row text-center justify-content-center mt-3 mb-5">
        <a href="/baget_online">
            <button class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                Рассчитать стоимость багетного оформления
            </button>
        </a>
    </div>

    <div class="row text-center m-2">
        <h2 class="section-title">КАРТИНА ДЛЯ ДОМА ИЛИ В ПОДАРОК</h2>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-lg-10 text-center text-lg-start">
            <p>
                Готовые картины – это также великолепный вариант подарка на любой праздник как для мужчин, так и для
                женщин! Нужна консультация? Оставляйте заявку на обратную связь. Наши специалисты проконсультируют Вас и
                ответят на все вопросы!
            </p>
            <p>Создавайте красоту и уют вместе с командой Багетной мастерской №1!</p>
        </div>
    </div>

    <div class="row text-center justify-content-center mt-3 mb-5">
        <button
                class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                data-bs-toggle="modal" data-bs-target="#feedbackModal">
            Получить консультацию
        </button>
    </div>
</div>

<style>
    p {
        color: #474A51;
        font-family: Manrope;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 1.6;
    }

    .section-title {
        font-family: Cormorant Garamond;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
    }

    @media screen and (max-width: 760px) {
        p {
            font-size: 18px;
            text-align: center;
        }
    }
</style>
<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
