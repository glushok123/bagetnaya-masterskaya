<?php
// Пример оформления заказа на современный манер, PHP 8.1
declare(strict_types=1);

if (isset($_GET['id']) && $_GET['id'] !== '') {
    $ident = trim((string) $_GET['id']);
    $z = explode('l', $ident);
} else {
    // Логируем отсутствие id
    $fp = fopen('lo/g.txt', 'ab');
    $towrite = date("j.m.Y G:i").' ! '.$_SERVER["REMOTE_ADDR"].' ! (нет id) ! zakaz without id';
    fwrite($fp, $towrite."\r\n");
    fclose($fp);

    // «Старый» метод «редиректа» через meta refresh оставляем, чтобы не ломать логику
    exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
}

// Подсчёт номера заказа
$zak_hist = file('base/zakaz-history.txt');
$z[15] = 500 + count($zak_hist);

// Запишем в историю
$ident = implode('l', $z);
$f_zak_hist = fopen('base/zakaz-history.txt', 'ab');
$towrite = date("j.m.Y G:i") . '-!-' . $_SERVER["REMOTE_ADDR"] . '-!-' . $ident . "\r\n";
fwrite($f_zak_hist, $towrite);
fclose($f_zak_hist);

// Проверка/приём промокода
$pomokod = 'не определен';
if (isset($_GET['pomokod'])) {
    $pomokod = trim((string) $_GET['pomokod']);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <?php if (!empty($_GET['id'])): ?>
        <link rel="canonical" href="http://bagetnaya-masterskaya.com/baget_zakaz"/>
    <?php endif; ?>
    <meta http-equiv="content-language" content="ru">
    <meta name="keywords" content="заказ багета, багет онлайн">
    <meta name="description" content="">
    <title>Заказ багета онлайн</title>
    <link rel="stylesheet" type="text/css" href="/stylobgt.css">
    <link rel="shortcut icon" href="/favicon.ico">
</head>
<body>

<?php
// Расчёт итоговых размеров
$kartx = $z[9] + 2 * ($z[2] + $z[5]);
$karty = $z[10] + 2 * ($z[2] + $z[5]);
?>

<div class="baget-zakaz-main">
    <div class="baget-zakaz-left">
        <div style="width:250px; font-size:150%; text-align:center;">
            Заказ №<?= $z[15] ?>
        </div>
        <hr>

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
        // Вывод типа стекла
        switch ((int)$z[6]) {
            case 0: echo '<br>Стекло: <strong>Нет</strong>'; break;
            case 1: echo '<br>Стекло: <strong>Обычное</strong>'; break;
            case 2: echo '<br>Стекло: <strong>Матовое</strong>'; break;
            case 3: echo '<br>Стекло: <strong>Антиблик</strong>'; break;
            case 4: echo '<br>Стекло: <strong>Пластиковое</strong>'; break;
        }

        // Вывод задника
        switch ((int)$z[7]) {
            case 0: echo '<br>Задник: <strong>Нет</strong>'; break;
            case 1: echo '<br>Задник: <strong>Картон</strong>'; break;
            case 2: echo '<br>Задник: <strong>Пенокартон 5мм</strong>'; break;
            case 3: echo '<br>Задник: <strong>Пенокартон 10мм</strong>'; break;
            case 4: echo '<br>Задник: <strong>Подрамник</strong>'; break;
        }
        ?>

        <br>Размер готовой картины, с учетом ширины багета и паспарту:
        <br><strong><?= $kartx ?> x <?= $karty ?></strong> мм.<br>
        <br><hr>
        Цена: <strong style="font-size:120%;"><?= $z[13] ?></strong> р.
        <br><hr>
        Промокод: <strong style="font-size:120%;"><?= $pomokod ?></strong>
    </div>

    <form action="baget_accept.php?id=<?= urlencode($ident) ?>&pomokod=<?= urlencode($pomokod) ?>" method="post">
        <div class="baget-zakaz-right">
            Как к вам обращаться:<br>
            <input type="text" name="name" style="width:540px; height:30px; background:#fffaf4;" required>

            Ваш телефон:<br>
            <input type="text" name="phone" style="width:540px; height:30px; background:#fffaf4;" required>

            Электронная почта:<br>
            <input type="email" name="mail" style="width:540px; height:30px;">

            Самовывоз из:<br>
            <select id="delivery" name="delivery" style="width:540px; height:30px;">
                <option selected disabled></option>
                <option value="м. Арбатская">м. Арбатская</option>
                <option value="м. Новокузнецкая">м. Новокузнецкая</option>
                <option value="м. Баррикадная">м. Баррикадная</option>
            </select>

            Комментарий или дополнительные пожелания:<br>
            <textarea name="reviu" style="width:540px; height:285px;"></textarea>
        </div>

        <div class="baget-zakaz-buttons">
            <!-- Возвращаемся к выбору багета -->
            <a href="/baget_online?id=<?= urlencode($ident) ?>" class="baget-zakaz-back" rel="nofollow">
                Вернуться к выбору багета
            </a>

            <input type="submit" value="Отправить заказ" class="baget-zakaz-send">
            <hr>
            <p class="confirm">
                Нажимая на кнопку «Отправить заказ», я принимаю
                <a href="/terms.pdf">Пользовательское соглашение</a> и подтверждаю,
                что ознакомлен и согласен с
                <a href="/privacy.pdf">Политикой конфиденциальности</a>
                данного сайта.
            </p>
        </div>
    </form>


</div>

<style>
    .baget-zakaz-main{
        border-radius: 20px;
        padding: 15px;
        background: white;
        box-shadow: none;
        border: 1px solid #5E646A;
    }
    .confirm{
        margin-top: 20px;
    }
</style>

<?php
// Дополнительный выход при локальном IP, чтобы не плодить лишние записи
if ($_SERVER["REMOTE_ADDR"] === '127.0.0.1') {
    exit;
}
?>


</body>
</html>
