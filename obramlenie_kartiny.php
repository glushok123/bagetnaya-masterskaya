<?php
$keywords = "Багет для картины, рамка на заказ, купить рамку, рамка для фото";
$title = "Багет для картины, рамка на заказ, купить рамку, рамка для фото
Рамки на заказ и готовые изделия в салонах Багетной мастерской №1!
";
$description = "Купить рамку для фото или заказать уникальный багет для картины со скидкой 10% на первый заказ!";
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>

    <style>
        .section-title {
            font-family: Cormorant Garamond;
            color: #a3080d;
            font-weight: bold;
            text-align: center;
            margin: 40px 0 20px;
            text-transform: uppercase;
        }
        .highlight-btn {
            background-color: #a3080d;
            color: white;
            border: none;
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 4px;
            margin: 15px 0;
        }
        .highlight-btn:hover {
            background-color: #870000;
            color: #fff;
        }
        .section-text {
            font-size: 18px;
            font-family: 'Manrope', sans-serif;
            color: #474A51;
        }
        .garamond {
            font-family: Cormorant Garamond;
            font-size: 22px;
        }

        @media screen and (max-width: 767px) {
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
            }
            img {
                max-height: 200px;
                margin-bottom: 15px;
            }
            .text-left {
                text-align: center;
            }
        }

        img {
            border-radius: 10px;
            max-width: 100%;
            height: auto;
        }

        .img-custom {
            object-fit: contain;
        }

        .img-1 {
            max-width: 286px;
            max-height: 382px;
        }

        .img-2 {
            max-width: 396px;
            max-height: 561px;
        }

        .img-3 {
            max-width: 404px;
            max-height: 461px;
        }

        @media screen and (max-width: 767px){
            .img-1 {
                max-width: 100%;
                height: auto;
                max-height: 376px;
            }

            .img-2 {
                max-width: 100%;
                height: auto;
                max-height: 412px;
            }

            .img-3 {
                max-width: 100%;
                height: auto;
                max-height: 340px;
            }
        }
    </style>

    <div class="container home_design">

        <!-- Блок 1 -->
        <div class="row text-center">
            <h2 class="section-title">ОФОРМЛЕНИЕ КАРТИН В БАГЕТНОЙ МАСТЕРСКОЙ №1:<br> КАК ВЫБРАТЬ ИДЕАЛЬНУЮ РАМКУ</h2>
            <div class="col-sm-4 col-sm-offset-1">
                <img src="/img/article/telegram-cloud-photo-size-2-5425050076243422565-y%201%20(2).png" class="img-responsive">
            </div>
            <div class="col-sm-6 text-left section-text my-auto">
                <p>Искусство требует достойного обрамления, и Багетная мастерская №1 — это место, где Ваша картина или фотография обретает завершённый вид</p>
                <p>Правильно подобранный багет для картины не только подчёркивает её красоту, но и защищает от внешних воздействий. В этой статье мы расскажем, как выбрать идеальную рамку для фото и почему стоит заказать индивидуальное оформление</p>
                <a href="/baget_online"><button class="highlight-btn">Рассчитать стоимость багета</button></a>
            </div>
        </div>

        <!-- Блок 2 -->
        <div class="row">
            <h3 class="section-title">ПОЧЕМУ СТОИТ ВЫБРАТЬ РАМКУ НА ЗАКАЗ?</h3>
            <div class="col-sm-8 section-text text-center  my-auto">
                <p>В Багетной мастерской №1 Вы можете купить рамку или заказать уникальный багет для картины со скидкой 10% на первый заказ! Однако готовые рамки не всегда соответствуют размеру и стилю вашего изображения</p>
                <p><strong>Наши специалисты смогут Вам предложить:</strong></p>
                <ul>
                    <li>Индивидуальный подбор багета к Вашей работе в соответствии с цветовой стилистикой, гармоничную ширину и подходящую фактуру</li>
                    <li>Различные варианты паспарту, которые добавят глубину и акцент для фотографии, графики или даже живописи!</li>
                    <li>Профессиональное оформление с учётом сохранности особенно ценных и галерейных объектов искусства</li>
                    <li>Уникальное предложение и бесплатная подготовка визуализации, подходящей в любой интерьер</li>
                </ul>
                <button class="highlight-btn" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
            </div>
            <div class="col-sm-4">
                <img src="/img/article/IMG_2602%202.png" class="img-responsive" style="margin-bottom:15px;">
                <img src="/img/article/IMG_2602%203.png" class="img-responsive">
            </div>
        </div>

        <!-- Блок 3 -->
        <div class="row">
            <h3 class="section-title">ГДЕ КУПИТЬ РАМКУ ДЛЯ КАРТИНЫ ИЛИ ФОТО?</h3>
            <div class="col-sm-8 section-text text-center my-auto">
                <p>В салонах Багетной мастерской №1 также существует ограниченное предложение готовых рам для картин, которые Вы можете приобрести!</p>
                <ul>
                    <li><strong>Деревянный багет</strong> — классика, подходящая для живописи и портретов.</li>
                    <li><strong>Алюминиевые рамки</strong> — современный вариант для фотографий и постеров.</li>
                    <li><strong>Пластиковые профили</strong> — бюджетное решение, устойчивое к влаге.</li>
                </ul>
                <p>Перед тем как купить рамку, проконсультируйтесь со специалистом: он поможет подобрать оптимальный вариант под стиль изображения и интерьера.</p>
                <p>В случае, если Вам не удалось найти подходящее готовое решение, Вы можете воспользоваться услугой express-заказа! Подробнее читайте в статье:</p>
                <a href="/express_zakaz.php"><button class="highlight-btn">Express-заказ</button></a>
            </div>
            <div class="col-sm-4">
                <img src="/img/article/image%20707.png" class="img-responsive" style="margin-bottom:15px; max-width: 200px;">
                <img src="/img/article/IMG_2602%204.png" class="img-responsive" style="max-width: 200px;">
            </div>
        </div>

        <!-- Заключение -->
        <div class="row text-center section-text" style="margin: 40px 0;">
            <p>Оформление картин и фотографий в Багетной мастерской №1 — это не просто покупка аксессуара, а создание законченного художественного произведения. Багет для картины, подобранный нашими профессионалами, преобразит ваш интерьер и подчеркнёт ценность изображения.</p>
            <p style="color: #a3080d;"><strong>Хотите уникальное оформление?</strong><br>Закажите рамку на заказ в Багетной мастерской №1!</p>
        </div>
    </div>

<?

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>