<?php
$keywords = "уход за рамкой, багетная рамка, чистка багета, как чистить багет, как ухаживать за рамой";
$title = "Как ухаживать за багетной рамкой — советы от Багетной мастерской №1";
$description = "Простые советы по уходу за багетными рамками и стеклом: как продлить срок службы, избежать пыли, солнца и влаги.";

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
        font-size:32px;
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
        <h2 class="section-title text-center">Как ухаживать за багетной рамкой
            и декоративными элементами: рекомендации по сохранению красоты!</h2>

        <!-- Картинка: после текста на мобилке -->
        <div class="col-sm-4 order-1 order-sm-1">
            <img src="/img/article/бм%20пост%205%202.png" alt="Алюминиевые рамки" class="img-responsive img-left">
        </div>

        <!-- Текст: перед картинкой на мобилке -->
        <div class="col-sm-8 text-left section-text my-auto order-0 order-sm-2">
            <p>Багетные рамы и декоративные элементы, такие как багетные стекла, придают интерьеру изысканность, но требуют бережного ухода, чтобы сохранить их первоначальный вид. </p>
            <p>В этой статье команда Багетной мастерской №1 делится простыми и эффективными способами ухода за рамками для картин и другими декоративными деталями.  </p>
            <div class="row text-center section-text mt-2 mb-4">
                <button class="highlight-btn " data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
            </div>
        </div>
    </div>

    <!-- Блок 2 -->
    <div class="row mt-5">
        <h3 class="section-title">Регулярная очистка от пыли</h3>
        <div class="my-auto section-text text-center" style="width: 100%;">Пыль — главный враг декоративных изделий. <br> <span class="bold">Чтобы она не скапливалась:</span></div>
        <div class="col-sm-7 section-text my-auto">
            <p><span style="color: #AD1F2D;" class="garamond">Для деревянных и пластиковых рам</span> используйте мягкую кисть (например,
                для макияжа или художественную) или микрофибровую салфетку. </p>
            <p><span style="color: #AD1F2D;" class="garamond">Для золоченых и лакированных рам</span> избегайте влаги — достаточно сухой чистки
                или специальных средств для позолоты. </p>
        </div>
        <div class="col-sm-5">
            <img src="/img/article/бм%20пост%205.1%201.png" alt="Алюминиевые профили" class="img-responsive img-right">
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-sm-5">
            <img src="/img/article/бм%20пост%205.1%201.png" alt="Алюминиевые профили" class="img-responsive img-right">
        </div>
        <div class="col-sm-7 section-text my-auto">
            <p><span style="color: #AD1F2D;" class="garamond">Для тканевых или резных элементов</span> подойдет пылесос с насадкой-щеткой
                на минимальной мощности.  </p>
            <p><span style="color: #AD1F2D;" class="garamond">При очищении музейных стекол</span> не используйте растворы для очищения зеркал и окон – достаточно просто смахнуть накопившуюся пыль! </p>
        </div>

    </div>


    <div class="row mt-5">

        <!-- Текст: перед картинкой на мобилке -->
        <div class="col-sm-8 text-left section-text my-auto">
            <h3 class="section-title text-center">Бережная влажная очистка</h3>
            <p>Если пыль въелась или появились загрязнения: </p>
            <p>- <strong>Деревянные рамки</strong> для картин можно протереть слегка влажной тканью с каплей мягкого мыла, затем сразу вытереть насухо. </p>
            <p>- <strong>Позолоченные и старинные рамы</strong> лучше чистить специальными составами для позолоты или сухой салфеткой. Вода может повредить покрытие.  </p>
            <p>- <strong>Металлические алюминиевые рамы</strong> очищайте мягкой тканью.  </p>
            <p>- Не используйте способы влажной очистки
                для багетных стекол.</p>
            <div class="row text-center section-text mt-2 mb-4">
                <button class="highlight-btn " data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
            </div>
        </div>

        <div class="col-sm-4">
            <img src="/img/article/image%20732.png" alt="Алюминиевые рамки" class="img-responsive img-left">
        </div>
    </div>


    <div class="row mt-5">

        <div class="col-sm-4">
            <img src="/img/article/telegram-cloud-photo-size-2-5253468606669387553-y 1.png" alt="Алюминиевые рамки" class="img-responsive img-left">
        </div>

        <!-- Текст: перед картинкой на мобилке -->
        <div class="col-sm-8 text-left section-text my-auto">
            <h3 class="section-title text-center">Защита от солнца и влаги</h3>
            <p>- <strong>Избегайте прямых солнечных лучей </strong> покрытия и пленки выцветают, а дерево рассыхается.</p>
            <p>- <strong>Используйте художественное или музейное стекло для картин</strong>— это защитит и изображение, и багетную раму.</p>
            <p>- <strong>Не размещайте рамы в сырых помещениях</strong> это может привести к деформации и плесени.</p>
            <a href="/baget_online">
                <button class="highlight-btn">Рассчитать стоимость багета</button>
            </a>
        </div>


    </div>

    <div class="row mt-5">



        <!-- Текст: перед картинкой на мобилке -->
        <div class="col-sm-8 text-left section-text my-auto">
            <h3 class="section-title text-center">Хранение и транспортировка  </h3>
            <p>Если нужно убрать раму на время:  </p>
            <p>- Заверните в мягкую ткань или пузырчатую пленку.  </p>
            <p>- Храните в сухом месте, избегая перепадов температур.  </p>
            <p>- Для перевозки используйте картонные уголки, чтобы защитить углы.  </p>
        </div>
        <div class="col-sm-4">
            <img src="/img/article/telegram-cloud-photo-size-2-5253468606669387555-y 1.png" alt="Алюминиевые рамки" class="img-responsive img-left">
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
