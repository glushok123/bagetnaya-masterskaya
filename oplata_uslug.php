<?php

$keywords = "багетная мастерская, картина на заказ, купить картину";
$title = "Купить картину и внести оплату в один клик!";
$description = "Оплата и доставка картин на заказ в Багетной мастерской №1  ";

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
            text-align: center;
            color: #6c6c6c;
            margin-top: 30px;
        }
    </style>

    <div class="container">
        <div class="section-title">ОПЛАТА УСЛУГ</div>
        <div class="section-text">
            <p><strong>Багетная мастерская №1</strong> – это команда профессионалов, готовых создавать для Вас уникальные оформления, а также картины на заказ с прорисовкой маслом и другие индивидуальные проекты! </p>
            <p>Три салона в центре Москвы с непосредственной близостью метро и парковок – наша команда делает все, чтобы Вам было удобно и легко оформить заказ!</p>
            <p>Ниже представлены официальные реквизиты и QR-код для внесения предоплаты за заказ. Предварительно свяжитесь с салоном!</p>
        </div>

        <div class="text-center mt-4">
            <img src="/img/article/Rectangle%206091.png" alt="Интерьер с картиной" class="img-fluid" style="max-width:150px; margin: 10px;">
            <img src="/img/article/Rectangle%206090.png" alt="Процесс упаковки картины" class="img-fluid" style="max-width:150px; margin: 10px;">
        </div>

        <div class="section-text mt-4">
            <hr>
            <h3 class="color-main">Для информации о внесении предоплаты, пожалуйста, свяжитесь с менеджером</h3>
            <hr>
            <!--p>Перевод по номеру карты:</p>
            <p id="number-copy" class="card-number">2204 3207 0606 7453</p>
            <p><small>(Нажмите на номер для копирования)</small></p-->
            <!--img src="/assets/qrCode.jpg" alt="QR-код для оплаты" class="qr-img"-->

            <!--p><strong>Здесь Вы можете внести предоплату по оформленному заказу!</strong></p>
            <p>Предварительно необходимо связаться с менеджером! В случае, если возникли вопросы по внесению средств, пожалуйста, оставьте заявку на обратную связь!</p-->
        </div>

        <button class="highlight-btn" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>

        <div class="section-title mt-5">ДОСТАВКА ГОТОВЫХ ЗАКАЗОВ</div>
        <div class="section-text">
            <p>Вы оформили заказ или решили купить картину? Воспользуйтесь также услугой доставки!</p>
            <p>Крупногабаритная доставка картин и других изделий нашего салона позволит Вам получить готовые работы в полной сохранности!</p>
            <p>Стоимость доставки: </p>
            <p>В пределах Садового кольца – 800 рублей</p>
            <p>В пределах ТТК – 1000 рублей</p>
            <p>В пределах МКАД – 1200 рублей </p>
            <p>Доставка с подъемом на этаж – 1500 рублей </p>
            <p>Доставка за МКАД рассчитывается индивидуально. Уточнить стоимость доставки Вы можете у менеджера, или рассчитать ее самостоятельно!</p>
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
            navigator.clipboard.writeText('2204 3207 0606 7453');

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