<?php
$keywords    = "Оформление заказа";
$title       = "Оформление заказа";
$description = "Оформление заказа";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';

// --- Обработка ID заказа ---
if (isset($_GET['id']) && $_GET['id'] !== '') {
    $ident = trim((string)$_GET['id']);
    $z = explode('l', $ident);
} else {
    // Логируем отсутствие id
    $fp = fopen('lo/g.txt', 'ab');
    $towrite = date("j.m.Y G:i") . ' ! ' . $_SERVER["REMOTE_ADDR"] . ' ! (нет id) ! zakaz without id';
    fwrite($fp, $towrite . "\r\n");
    fclose($fp);

    // Редирект через meta refresh
    exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
}

// --- Подсчёт номера заказа ---
$zak_hist = file('base/zakaz-history.txt');
$z[15] = 500 + count($zak_hist);

// --- Запись в историю ---
$ident = implode('l', $z);
$f_zak_hist = fopen('base/zakaz-history.txt', 'ab');
$towrite = date("j.m.Y G:i") . '-!-' . $_SERVER["REMOTE_ADDR"] . '-!-' . $ident . "\r\n";
fwrite($f_zak_hist, $towrite);
fclose($f_zak_hist);

// --- Проверка / приём промокода ---
$pomokod = 'Не заполнен'; // По умолчанию «Не заполнен»
if (!empty($_GET['pomokod'])) {
    $pomokod = trim((string)$_GET['pomokod']);
}

// --- Расчёт итоговых размеров ---
$kartx = $z[9] + 2 * ($z[2] + $z[5]);
$karty = $z[10] + 2 * ($z[2] + $z[5]);
?>
    <div class="container">
        <div class="baget-zakaz-main">
            <div class="baget-zakaz-left justify-content-center text-center">
                <h1 class="number-order">Заказ №<?= $z[15] ?></h1>
                <hr>
            </div>
            <form id="orderForm" action="baget_accept.php?id=<?= urlencode($ident) ?>&pomokod=<?= urlencode($pomokod) ?>" method="post">
            <div class="row justify-content-center">
                <div class="col-12 col-md-4">
                    Артикул багета:
                    <strong><?= $z[0] ?></strong><br>
                    Ширина изображения:
                    <strong><?= $z[9] ?></strong> мм.<br>
                    Высота изображения:
                    <strong><?= $z[10] ?></strong> мм.<br>

                    <?php if ($z[3] !== '0'): ?>
                        <br>
                        <img src="/pi/<?= $z[3] ?>.jpg" width="100" height="100" alt="Паспарту">
                        <br>Артикул паспарту: <strong><?= $z[3] ?></strong><br>
                        Ширина паспарту: <strong><?= $z[5] ?></strong> мм.<br>
                    <?php endif; ?>

                    <?php
                    // Тип стекла
                    switch ((int)$z[6]) {
                        case 0:  echo '<br>Стекло: <strong>Нет</strong>';        break;
                        case 1:  echo '<br>Стекло: <strong>Обычное</strong>';    break;
                        case 2:  echo '<br>Стекло: <strong>Матовое</strong>';    break;
                        case 3:  echo '<br>Стекло: <strong>Антиблик</strong>';   break;
                        case 4:  echo '<br>Стекло: <strong>Пластиковое</strong>';break;
                    }

                    // Тип задника
                    switch ((int)$z[7]) {
                        case 0:  echo '<br>Задник: <strong>Нет</strong>';                break;
                        case 1:  echo '<br>Задник: <strong>Картон</strong>';             break;
                        case 2:  echo '<br>Задник: <strong>Пенокартон 5мм</strong>';     break;
                        case 3:  echo '<br>Задник: <strong>Пенокартон 10мм</strong>';    break;
                        case 4:  echo '<br>Задник: <strong>Подрамник</strong>';          break;
                    }
                    ?>

                    <br>Размер готовой картины, с учетом ширины багета и паспарту:
                    <br><strong><?= $kartx ?> x <?= $karty ?></strong> мм.<br>
                    <br><hr>
                    Цена: <strong style="font-size:120%;"><?= $z[13] ?></strong> р.
                    <br><hr>
                    Промокод: <strong style="font-size:120%;"><?= $pomokod ?></strong>
                </div>

                <div class="col-12 col-md-6">
                    <!-- Форма заказа -->


                        <div class="baget-zakaz-right">
                            <div class="b-1">
                                <div>Как к вам обращаться:</div>
                                <input type="text" class="input-1" name="name" style="height:40px;">
                                <div class="text-danger error-message" id="errorName"></div>
                            </div>

                            <div class="b-1">
                                <div>Ваш телефон:</div>
                                <input type="text" class="input-1" name="phone" style="height:40px;">
                                <div class="text-danger error-message" id="errorPhone"></div>
                            </div>

                            <div class="b-1">
                                <div>Электронная почта:</div>
                                <input type="email" class="input-1" name="mail" style="height:40px;">
                                <div class="text-danger error-message" id="errorMail"></div>
                            </div>

                            <div class="b-1">
                                <div>Самовывоз из:</div>
                                <select id="delivery" class="input-1" name="delivery" style="height:40px;">
                                    <option selected disabled value="">-- Выберите пункт --</option>
                                    <option value="м. Арбатская">м. Арбатская</option>
                                    <option value="м. Новокузнецкая">м. Новокузнецкая</option>
                                    <option value="м. Баррикадная">м. Баррикадная</option>
                                </select>
                                <div class="text-danger error-message" id="errorDelivery"></div>
                            </div>

                            <div class="b-1">
                                <div>Комментарий или дополнительные пожелания:</div>
                                <textarea name="reviu" class="input-1" style="height:110px;"></textarea>
                                <div class="text-danger error-message" id="errorReviu"></div>
                            </div>


                        </div>

                </div>
            </div>
        </div>
        <!-- Кнопки внутри формы, чтобы при сабмите уходили данные -->
        <div class="baget-zakaz-buttons mt-4">
            <input type="submit"
                   value="Отправить заказ"
                   class="button button-custom-index button-color-company-red fix-width-425
                                          mob-fix-width-340 color-white baget-zakaz-send"
                   style="margin-bottom:0 !important;">

            <a href="/baget_online?id=<?= urlencode($ident) ?>" class="baget-zakaz-back" rel="nofollow">
                Вернуться к выбору багета
            </a>
        </div>
        </form>
        <hr>


        <p class="confirm text-center">
            Нажимая на кнопку «Отправить заказ», я принимаю
            <a href="/terms.pdf">Пользовательское соглашение</a> и подтверждаю,
            что ознакомлен и согласен с
            <a href="/privacy.pdf">Политикой конфиденциальности</a>
            данного сайта.
        </p>
    </div>

    <style>
        .baget-zakaz-buttons {
            display: flex;
            gap: 40px;
            align-items: center;
            justify-content: center;
        }

        .baget-zakaz-right {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .b-1 {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .input-1 {
            border-radius: 8px;
            border: 1px solid #979595;
            padding: 5px;
        }

        .baget-zakaz-send {
            padding: 12px 24px;
            width: auto;
            box-sizing: border-box;
        }

        .number-order {
            margin-top: 20px;
            margin-bottom: 20px;
            color: #AD1F2D;
        }

        .confirm {
            margin: 1rem 0 3rem 0;
        }

        .error-message {
            font-size: 0.9rem;
        }
    </style>

    <!-- Скрипты валидации и маски (предполагается, что jQuery и mask plugin уже подключены) -->
    <script>
        $(function() {
            // Маска телефона
            $('[name="phone"]').mask('+7 (000) 000-00-00');

            // Валидация полей формы
            $('#orderForm').on('submit', function(e) {
                let isValid = true;

                // Сбрасываем старые тексты ошибок
                $('.error-message').text('');

                const name     = $('[name="name"]').val().trim();
                const phone    = $('[name="phone"]').val().trim();
                const mail     = $('[name="mail"]').val().trim();
                const delivery = $('[name="delivery"]').val();
                const reviu    = $('[name="reviu"]').val().trim();

                // Проверяем "Как к вам обращаться"
                if (name === '') {
                    $('#errorName').text('Введите имя');
                    isValid = false;
                }

                // Проверяем телефон
                if (phone === '') {
                    $('#errorPhone').text('Введите телефон');
                    isValid = false;
                }

                // Проверяем почту
                if (mail === '') {
                    $('#errorMail').text('Введите e-mail');
                    isValid = false;
                }

                // Проверяем самовывоз
                if (!delivery) {
                    $('#errorDelivery').text('Выберите пункт самовывоза');
                    isValid = false;
                }

                // Проверяем комментарий/пожелания
              //  if (reviu === '') {
              //      $('#errorReviu').text('Заполните комментарий');
              //      isValid = false;
              //  }

                if (!isValid) {
                    e.preventDefault(); // Останавливаем отправку формы при наличии ошибок
                }
            });
        });
    </script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
