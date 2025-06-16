<?php
$keywords = "Купить рамку, рамка для картины, деревянная рамка";
$title = "Деревянные рамки для картин в Багетной мастерской №1!";
$description = "Купить рамку по индивидуальным размерам для картин – создавайте красоту вместе с нашей командой!";

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
        <h2 class="section-title text-center">ДЕРЕВЯННЫЕ РАМКИ:<br>МАТЕРИАЛЫ И ГДЕ ЗАКАЗАТЬ</h2>

        <!-- Картинка: будет после текста на мобилке -->
        <div class="col-sm-4 order-1 order-sm-1">
            <img src="/img/article/telegram-cloud-document-2-5285175076994442904%201%20(1).png" alt="Деревянные рамки" class="img-responsive img-left">
        </div>

        <!-- Текст: будет первым на мобилке -->
        <div class="col-sm-8 text-left section-text my-auto order-0 order-sm-2">
            <p><strong>Рамки для картин из дерева</strong> — это классический и элегантный способ оформления художественных произведений, фотографий и зеркал. Они придают работе законченный вид, подчёркивают стиль интерьера и защищают картину от повреждений.</p>
            <p>В этой статье разберём, из какого дерева изготавливают багет, где можно купить рамку и почему Багетная мастерская №1 — лучший выбор для заказа.</p>
        </div>
    </div>


    <!-- Блок 2 -->
    <div class="row mt-5">
        <h3 class="section-title">МАТЕРИАЛЫ ИЗГОТОВЛЕНИЯ БАГЕТНЫХ РАМ</h3>
        <div class="col-sm-12 section-text my-auto">
            <p>Деревянные багеты изготавливают из разных пород древесины, каждая из которых имеет свои особенности:</p>
            <ul>
                <li><strong>Сосна</strong> — лёгкая, недорогая, хорошо поддаётся обработке. Наиболее популярный материал для изготовления деревянных рам.</li>
                <li><strong>Дуб</strong> — прочный, долговечный, с благородной текстурой, подходит для массивных рам индивидуального изготовления.</li>
                <li><strong>Орех</strong> — обладает красивым рисунком, часто используется в элитном оформлении. Очень редко используется для багета.</li>
                <li><strong>Бук</strong> — прочный и устойчивый к нагрузкам, подходит для крупных картин.</li>
                <li><strong>Вишня, красное дерево</strong> — имеют насыщенный оттенок, придают рамке роскошный вид.</li>
            </ul>
            <p>Кроме натурального дерева, встречаются комбинированные варианты: например, деревянная основа с полимерным или шпонированным покрытием.</p>
        </div>

    </div>

    <!-- Кнопка -->
    <div class="row text-center section-text mt-5 mb-4">
        <button class="highlight-btn mx-auto" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
    </div>

    <!-- Блок 3 -->
    <div class="row">
        <h3 class="section-title">КУПИТЬ РАМКУ ИЛИ ЗАКАЗАТЬ ИНДИВИДУАЛЬНОЕ ОФОРМЛЕНИЕ?</h3>
        <div class="col-sm-7 section-text my-auto">
            <p>В зависимости от предпочтений, целей оформления и задач – лучше выбирать индивидуальное изготовление рамки для картины. В этом случае вы гарантированно получите подходящий результат — рама будет подходить как к картине, так и к интерьеру!</p>
        </div>
        <div class="col-sm-5">
            <img src="/img/article/telegram-cloud-document-2-5285175076994442927%201.png" alt="Индивидуальное оформление рамок" class="img-responsive img-right">
        </div>
    </div>

    <!-- Блок 4 -->
    <div class="row mt-5">
        <h3 class="section-title">ПОЧЕМУ ВЫБИРАЮТ НАС:</h3>
        <div class="col-sm-7 section-text">
            <p><strong>1. Индивидуальный подход</strong> – можно выбрать не только дерево, но и форму, ширину, цвет и отделку багета.</p>
            <p><strong>2. Профессиональная консультация</strong> – наши специалисты помогут подобрать оптимальный вариант под стиль картины и интерьера.</p>
            <p><strong>3. Качественные материалы</strong> – в наших салонах используют качественные материалы и надёжные крепления.</p>
            <p><strong>4. Точность изготовления</strong> – рамка будет идеально подходить по размеру, без зазоров и перекосов.</p>
            <p><strong>5. Дополнительные услуги</strong> – паспарту, стекло (антибликовое, музейное), монтаж картины.</p>
        </div>
        <div class="col-sm-5">
            <img src="/img/article/image%20(1).png" alt="Породы дерева" class="img-responsive img-right">
        </div>
    </div>

    <!-- Заключение -->
    <div class="row text-center section-text mt-5 mb-4">
        <p><strong>Деревянные рамки</strong> – это универсальное и стильное решение для оформления картин, фотографий и зеркал. Если вы хотите получить качественное и эксклюзивное изделие, лучше всего обратиться в Багетную мастерскую №1, где вам изготовят рамку по вашим параметрам и с учётом всех нюансов.</p>
        <button class="highlight-btn mx-auto" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
    </div>

</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
