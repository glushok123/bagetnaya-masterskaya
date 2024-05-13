<?php

$keywords = "багетная мастерская, багетная мастерская в Москве, доставка картин";
$title = "Оплата услуг Багетной мастерской №1";
$description = "Здесь можно внести предоплату за работу, или оплатить её полностью";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
    <style>
        .custom-margin {
            margin-right: 25px;
            padding: 10px;
        }
    </style>
    <div class="custom-margin">
        <div class='container'>

            <div class="block-h1 text-center my-4 fade-in">
                <h1 class='color-main'>ОПЛАТА УСЛУГ БАГЕТНОЙ МАСТЕРСКОЙ №1</h1>
            </div>

            <div class="row text-center">
                <!--div class='col-12 justify-content-center'>
                    <div class="col-md-8 mx-auto" style="width:300px;    margin: 0 auto;">
                        <br>
                        <br>

                        <iframe src="https://yoomoney.ru/quickpay/fundraise/button?billNumber=ltQW9QHsviI.230315&" width="330" height="50" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
                        <br>


                    </div>
                </div-->

                <div>
                    <hr>
                    <h5>Перевод по номеру карты: </h5>
                    <h5 id="number-copy">2204 4502 4204 6818</h5>
                    <span>(Нажмите на номер для копирования)</span>
                    <hr>
                </div>

                <div class='col-12'>
                    <img src="/assets/qrCode.jpg" alt="" height="400px">
                </div>
            </div>

            <p>
            <h4 class="text-center" style="color: #6a1a21">Здесь можно внести предоплату за работу, или оплатить ее
                полностью! </h4>
            Пожалуйста, согласуйте с Вашим менеджером детали заказа перед внесением предоплаты 50% или
            полной оплаты работ багетной мастерской. Выше Вы можете выбрать удобный способ оплаты: перевод
            на ЮMoney или перевод по QR-коду. Если Ваша вносимая сумма превышает 15000 рублей,
            мы рекомендуем воспользоваться QR-кодом.
            </p>
            <p>
                Очно в Багетной мастерской №1 Вы можете внести средства за заказ наличными или картой!
            </p>
        </div>
        <div class="row text-center justify-content-center">
            <a href="/baget_online">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Рассчитать
                    стоимость багета
                </button>
            </a>
        </div>
        <div class='container'>

            <div class='row text-center'>
                <br>
                <h4>ДОСТАВКА ЗАКАЗОВ БАГЕТНОЙ МАСТЕРСКОЙ №1 </h4>
            </div>

            <p>
                Доставку осуществляет багетная мастерская в Москве и Московской
                области своим крупногабаритным автомобилем! Максимальный формат –
                2500*1500 мм. Форматы картин, превышающие указанные габариты,
                перевозятся сторонними организациями. Отправление Ваших заказов в
                другие города также возможно удобным для Вас сервисом доставки!
            </p>
            <p>
                Стоимость доставки картин рассчитывается индивидуально от 600 рублей
                по Москве и совершается на следующий рабочий день после дня готовности Вашего заказа.
            </p>
        </div>


        <script>

            /* сохраняем текстовое поле в переменную text */


            $(document).on('click', '#number-copy', function () {
                navigator.clipboard.writeText('2204 4502 4204 6818');

                Toastify({
                    text: "Номер скопирован в буфер обмена",
                    close: true,
                    className: "error",
                    backgroundColor: "#6a1a21"
                }).showToast();
            });
        </script>
    </div>


<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>