<?php
$keywords = "Как ухаживать за, рамка для картины, багетная мастерская";
$title = "Продлеваем жизнь искусству! Или как ухаживать за рамкой для картины";
$description = "Рекомендации команды Багетной мастерской №1 по уходу за багетными изделиями";

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

    .garamond {
        font-family: Cormorant Garamond, serif;
        font-size: 32px;
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

    <!-- Блок 1 -->
    <div class="row">
        <h2 class="section-title text-center">КАК УХАЖИВАТЬ ЗА РАМКОЙ: РЕКОМЕНДАЦИИ</h2>

        <!-- Картинка: после текста на мобилке -->
        <div class="col-sm-4 order-1 order-sm-1">
            <img src="/img/article/бм%20пост%205%202.png" alt="Алюминиевые рамки" class="img-responsive img-left">
        </div>

        <!-- Текст: перед картинкой на мобилке -->
        <div class="col-sm-8 text-left section-text my-auto order-0 order-sm-2">
            <p>Любые изделия, будь то декоративные подсвечники, фоторамки и прочие интерьерные атрибуты, требуют к себе
                особенного внимания! Для сохранения первоначального вида необходимо следовать нескольким несложным
                правилам, которые команда Багетной мастерской №1 собрала для Вас в данной статье! </p>

            <div class="row text-center section-text mt-2 mb-4">
                <button class="highlight-btn " data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на
                    обратную связь
                </button>
            </div>
        </div>
    </div>

    <!-- Блок 2 -->
    <div class="row mt-5">
        <h3 class=" text-center p-3">ПЫЛЬ: ГЛАВНЫЙ ВРАГ</h3>
        <div class="col-sm-5">
            <img src="/img/article/бм%20пост%205.1%201.png" alt="Алюминиевые профили" class="img-responsive img-left">
        </div>
        <div class="col-sm-7 section-text my-auto">
            <p>Рамки для картины – великолепное украшение в любом пространстве, однако очистку картин от пыли нередко
                игнорируют. Что следует делать, чтобы пыль не скапливалась: </p>
            <p>- Регулярно очищайте рамы от пыли салфеткой из микрофибры или мягкой кистью </p>
            <p>- Не используйте влажные способы очистки для рам с ручным золочением – только сухая уборка</p>
            <p>- Обычные стекла на картинах и зеркала можно протирать классическими средствами для мойки зеркал и
                мягкими салфетками </p>
            <p>- Музейные стекла не следует очищать специальными средствами: достаточно просто смахивать пыль мягкими
                кистями!</p>
        </div>

    </div>


    <div class="row mt-5">

        <!-- Текст: перед картинкой на мобилке -->
        <div class="col-sm-8 text-left section-text my-auto">
            <h3  class=" text-center p-3">КОГДА НУЖНА ВЛАЖНАЯ УБОРКА</h3>
            <p>В случае, если сухой очистки недостаточно, чтобы убрать уже въевшиеся загрязнения, можно прибегнуть к
                влажной очистке изделий:</p>
            <p>1. Пластиковые рамки для картин не боятся влаги: спокойно используйте влажные ткани для очистки </p>
            <p>2. Деревянные рамы обязательно следует вытереть насухо после влажной очистки. Если деревянная рама с
                ручным покрытием или золочением – лучше от влажной очистки отказаться.</p>
            <p>3. Алюминиевые рамы можно очищать слегка влажными тканями, после чего следует хорошо обработать сухой
                тканью. </p>

            <div class="row text-center section-text mt-2 mb-4">
                <button class="highlight-btn " data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на
                    обратную связь
                </button>
            </div>
        </div>

        <div class="col-sm-4">
            <img src="/img/article/image%20732.png" alt="Алюминиевые рамки" class="img-responsive img-left">
        </div>
    </div>


    <div class="row mt-5">

        <div class="col-sm-4">
            <img src="/img/article/telegram-cloud-photo-size-2-5253468606669387553-y 1.png" alt="Алюминиевые рамки"
                 class="img-responsive img-left">
        </div>

        <!-- Текст: перед картинкой на мобилке -->
        <div class="col-sm-8 text-left section-text my-auto">
            <h3 class=" text-center p-3">ЗАЩИТА ОТ СОЛНЦА</h3>
            <p>Прямые солнечные лучи негативно влияют на багетные изделия вне зависимости от материала! Поэтому не
                следует размещать картины непосредственно напротив окон с солнечной стороны: покрытия и пленки
                пластиковых и алюминиевых рам выцветают, а деревянные рамы рассыхаются и теряют привлекательный
                вид. </p>
            <a href="/baget_online">
                <button class="highlight-btn">Рассчитать стоимость багета</button>
            </a>
        </div>


    </div>

    <div class="row mt-5">
        <!-- Текст: перед картинкой на мобилке -->
        <div class="col-sm-8 text-left section-text my-auto">
            <h3  class=" text-center p-3">ХРАНЕНИЕ И ТРАНСПОРТИРОВКА </h3>
            <p>Переезд или планирование выставки – следует всегда быть готовым к возможной транспортировке картин или
                временному хранению! </p>
            <p>Советы для временного хранения:</p>
            <p>- оберните картины в рамах в мягкую ткань или поролон </p>
            <p>- храните картины в вертикальном положении (чтобы в последствии ничего не упало на работу)</p>
            <p>- храните в месте, где нет влаги и перепадов температур </p>
            <p>При самостоятельной транспортировке на небольшие расстояния лучше использовать специальные картонные
                уголки и поролон. При необходимости доставки транспортной компанией обязательно используйте
                дополнительную услугу обрешетки! Надеемся, наша статья о том, как ухаживать за багетными изделиями
                оказалась для Вас полезной!</p>
        </div>
        <div class="col-sm-4">
            <img src="/img/article/telegram-cloud-photo-size-2-5253468606669387555-y 1.png" alt="Алюминиевые рамки"
                 class="img-responsive img-left">
        </div>

    </div>

    <a href="/baget_online">
        <button class="highlight-btn">Рассчитать стоимость багета</button>
    </a>
</div>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
