<?php

$keywords = "багетная мастерская, багетная мастерская в Москве, доставка картин";
$title = "Оплата услуг Багетной мастерской №1";
$description = "Здесь можно внести предоплату за работу, или оплатить её полностью";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>

    <style>
        .section-title {
            font-family: Cormorant Garamond, serif;
            color: #C6110F;
            font-weight: bold;
            text-align: center;
            margin: 40px 0 20px;
            text-transform: uppercase;
            font-size: 36px;
        }
        .section-text {
            font-size: 18px;
            font-family: 'Manrope', sans-serif;
            color: #474A51;
            text-align: center;
        }
        .highlight-btn {
            background-color: #a3080d;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            border-radius: 4px;
            margin: 20px auto;
            display: block;
        }
        .highlight-btn:hover {
            background-color: #870000;
        }
        .card-number {
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }
        .qr-img {
            max-width: 360px;
            height: auto;
            margin: 20px auto;
            display: block;
        }
        .end-text {
            font-size: 25px;
            font-family: Cormorant Garamond, serif;
            text-align: right;
            color: #6c6c6c;
            margin-top: 30px;
        }
    </style>

    <div class="container">
        <div class="section-title">ОПЛАТА УСЛУГ</div>
        <div class="section-text">
            <p><strong>Багетная мастерская №1</strong> – это сеть салонов, предоставляющих услуги по персональному оформлению картин, продаже готовых рамок и авторских картин, а также изготовлению картин на заказ с росписью маслом или арт-гелем, репродукций и постеров!</p>
        </div>

        <div class="text-center mt-4">
            <img src="/img/article/Rectangle%206091.png" alt="Интерьер с картиной" class="img-fluid" style="max-width:150px; margin: 10px;">
            <img src="/img/article/Rectangle%206090.png" alt="Процесс упаковки картины" class="img-fluid" style="max-width:150px; margin: 10px;">
        </div>

        <div class="section-text mt-4">
            <p>Перевод по номеру карты:</p>
            <p id="number-copy" class="card-number">2204 4502 4204 6818</p>
            <p><small>(Нажмите на номер для копирования)</small></p>
            <img src="/assets/qrCode.jpg" alt="QR-код для оплаты" class="qr-img">

            <p><strong>Здесь Вы можете внести предоплату по оформленному заказу!</strong></p>
            <p>Предварительно необходимо связаться с менеджером! В случае, если возникли вопросы по внесению средств, пожалуйста, оставьте заявку на обратную связь!</p>
        </div>

        <button class="highlight-btn" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>

        <div class="section-title mt-5">ДОСТАВКА ГОТОВЫХ ИЗДЕЛИЙ</div>
        <div class="section-text">
            <p>Если Вы решили купить картину или заказать оформление Ваших постеров или фотографий – воспользуйтесь услугой доставки силами нашей команды!</p>
            <p>Стоимость доставки в пределах Садового кольца без подъема – 800 рублей.<br>
                Стоимость доставки в пределах ТТК без подъема – 1000 рублей.<br>
                Стоимость доставки в пределах МКАД без подъема – 1200 рублей.<br>
                Стоимость доставки по Москве в пределах МКАД с подъемом на этаж – 1500 рублей.<br>
                Доставка за пределы МКАД рассчитывается персонально.</p>
            <p>Для точного расчета стоимости доставки обратитесь к менеджеру или рассчитайте самостоятельно по ссылке ниже!</p>
        </div>

        <a href="/prices_for_print_and_canvas">
            <button class="highlight-btn">Комплект для картины</button>
        </a>

        <div class="end-text">
            С уважением к Вам,<br>
            С любовью к Искусству!<br>
            Багетная мастерская №1
        </div>

    </div>

    <script>
        $(document).on('click', '#number-copy', function () {
            navigator.clipboard.writeText('2204 4502 4204 6818');

            Toastify({
                text: "Номер скопирован в буфер обмена",
                close: true,
                className: "info",
                backgroundColor: "#6a1a21"
            }).showToast();
        });
    </script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>