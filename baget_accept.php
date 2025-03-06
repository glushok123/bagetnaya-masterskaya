<?php
$keywords = "Оформление заказа";
$title = "Оформление заказа";
$description = "Оформление заказа";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';

// Инициализируем $ident, чтобы не было undefined при отсутствии id
$ident = '';
if (isset($_GET['id']) && $_GET['id'] !== '') {
    $ident = (string)$_GET['id'];
    $z = explode('l', $ident);
} else {
    // Пишем в лог, что не было ID
    $fp = fopen('lo/g.txt', 'a');
    $towrite = date("j.m.Y G:i") . ' ! ' . $_SERVER["REMOTE_ADDR"] . ' ! ' . $ident . ' ! accept without id';
    fwrite($fp, $towrite . "\r\n");
    fclose($fp);

    // Старый метод "редиректа" через meta refresh
    exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
}

// Подготовка/очистка данных из $_POST
$_POST['delivery'] = empty($_POST['delivery']) ? '' : $_POST['delivery'];

// Файл лога
$f_zak_hist = fopen('base/zakazend-history.txt', 'a');

// Удаляем некоторые символы из строк
$symbols = [";", ":", "(", ")", "{", "}", "[", "]", "'", "\'", "\\", "\"", "<", ">", ",", "/"];
$name = str_replace($symbols, " ", (string)($_POST['name'] ?? ''));
$phone = str_replace($symbols, " ", (string)($_POST['phone'] ?? ''));
$mail = str_replace($symbols, " ", (string)($_POST['mail'] ?? ''));
$reviu = str_replace($symbols, " ", (string)($_POST['reviu'] ?? ''));

// Промокод
$pomokod = "не определен";
if (isset($_GET["pomokod"])) {
    $pomokod = (string)$_GET["pomokod"];
}

// Подключение к БД и получение реального артикула багета
require_once 'base/connect.php';
$stmt = $dbh->prepare("SELECT * FROM catalog_baget WHERE publicvendor=?");
$stmt->bindParam(1, $z[0]);
$stmt->execute();
$data = $stmt->fetchAll();
$bart = $data[0]['vendor'] ?? '';

// Определяем формат (горизонтальный, вертикальный, квадрат)
$nameFormat = "Горизонтально";
if ($z[10] > $z[9]) {
    $nameFormat = "Вертикально";
} elseif ($z[10] == $z[9]) {
    $nameFormat = "Квадрат";
}

// Подготовка текста для письма клиенту
$zakazkl = '<div><b>Здравствуйте, ' . $name . '! </b></div><br>';
$zakazkl .= '<div><b>Ваш заказ принят, в данный момент специалист проверяет наличие всех материалов. '
    . 'Мы свяжемся с Вами в ближайшее время! </b></div><br>';
$zakazkl .= '<div><b>Детали заказа: </b></div><br>';
$zakazkl .= '<div>Номер заказа: <b>' . $z[15] . '</b></div><br>';

// Подготовка текста для письма в мастерскую
$zakaz = '<br>Артикул багета (реальный): <b>' . $bart . '</b>'
    . '<br>Артикул багета (с сайта): <b>' . $z[0] . '</b>'
    . '<br>Ширина изображения: <b>' . $z[9] . '</b> мм.'
    . '<br>Высота изображения: <b>' . $z[10] . '</b> мм.'
    . '<br>Формат: <b>' . $nameFormat . '</b><br>';

$zakazkl .= '</b><br>Артикул багета: <b>' . $z[0] . '</b>'
    . '<br>Ширина изображения: <b>' . $z[9] . '</b> мм.'
    . '<br>Высота изображения: <b>' . $z[10] . '</b> мм.'
    . '<br>Формат: <b>' . $nameFormat . '</b><br>';

// Паспарту
$zakaz2 = '';
$zakazkl2 = '';
if ($z[3] !== "0") {
    $stmt = $dbh->prepare("SELECT vendor FROM catalog_baget WHERE publicvendor=?");
    $stmt->bindParam(1, $z[3]);
    $stmt->execute();
    $data = $stmt->fetchAll();
    $realPasp = $data[0]['vendor'] ?? '';

    $zakaz2 = '<br>Артикул паспарту (реальный): <b>' . $realPasp . '</b>'
        . '<br>Артикул паспарту (с сайта): <b>' . $z[3] . '</b>'
        . '<br>Ширина паспарту: <b>' . $z[5] . '</b> мм.<br>';

    $zakazkl2 = 'Артикул паспарту: <b>' . $z[3] . '</b>'
        . '<br>Ширина паспарту: <b>' . $z[5] . '</b> мм.<br>';
}

// Стекло и задник
$zakaz3 = '';
// Стекло
if ($z[6] == 0) {
    $zakaz3 .= '<br>Стекло: <strong>Нет</strong>';
} elseif ($z[6] == 1) {
    $zakaz3 .= '<br>Стекло: <strong>Обычное</strong>';
} elseif ($z[6] == 2) {
    $zakaz3 .= '<br>Стекло: <strong>Матовое</strong>';
} elseif ($z[6] == 3) {
    $zakaz3 .= '<br>Стекло: <strong>Антиблик</strong>';
} elseif ($z[6] == 4) {
    $zakaz3 .= '<br>Стекло: <strong>Пластиковое</strong>';
}

// Задник
if ($z[7] == 0) {
    $zakaz3 .= '<br>Задник: <strong>Нет</strong>';
} elseif ($z[7] == 1) {
    $zakaz3 .= '<br>Задник: <strong>Картон</strong>';
} elseif ($z[7] == 2) {
    $zakaz3 .= '<br>Задник: <strong>Пенокартон 5мм</strong>';
} elseif ($z[7] == 3) {
    $zakaz3 .= '<br>Задник: <strong>Пенокартон 10мм</strong>';
} elseif ($z[7] == 4) {
    $zakaz3 .= '<br>Задник: <strong>Подрамник</strong>';
}

// Цена
$zakaz3 .= '<br><hr>Цена: <strong style="font-size:120%;">' . $z[13] . '</strong> р.';

// Ссылка на картинку, если есть
$imghref = '';
if ($z[8] != 0) {
    $imghref = '<br><a href="http://bagetnaya-masterskaya.com/pics/' . $z[8] . '.jpg">Ссылка на картинку</a>';
}

// Обнуляем часть данных
$z[19] = $z[20] = $z[21] = $z[11] = $z[8] = "0";

// Дописываем всё в итоговые строки
$zakaz .= $zakaz2 . $zakaz3
    . '<br><a href="http://bagetnaya-masterskaya.com/baget_online?id=' . implode("l", $z)
    . '" rel="nofollow">Ссылка</a>' . $imghref;

$zakazkl .= $zakazkl2 . $zakaz3
    . '<br><a href="http://bagetnaya-masterskaya.com/baget_online?id=' . implode("l", $z)
    . '" rel="nofollow">Ссылка</a>';

// Отправка писем
$ipaddr = $_SERVER["REMOTE_ADDR"];
// Отправляем письмо клиенту
$fromName = "Новый заказ №" . $z[15];
$fromNameEncoded = "=?UTF-8?B?" . base64_encode($fromName) . "?=";
$mailHeaders = "From: $fromNameEncoded <manager@bagetnaya-masterskaya.com>\r\n"
    . "Reply-To: manager@bagetnaya-masterskaya.com\r\n"
    . "Content-Type: text/html; charset=UTF-8\r\n";

$subjectForManager = 'Заказ №' . $z[15] . ' с Багетной мастерской';
$messageForManager = "IP: $ipaddr<br>"
    . "Имя:<br><b>$name</b><br>"
    . "Телефон:<br><b>$phone</b><br>"
    . "Почта:<br><b>$mail</b><br>"
    . "Адрес самовывоза:<br><b>{$_POST['delivery']}</b><br>"
    . "Комментарий:<br><i>$reviu</i><br>"
    . "Заказ:$zakaz<br>"
    . "Промокод:$pomokod";

// Если письмо менеджеру отправилось
if (mail("manager@bagetnaya-masterskaya.com", $subjectForManager, $messageForManager, $mailHeaders)) {
    // Отправляем письмо клиенту
    $fromName = "Багетная мастерская №1";
    $fromNameEncoded = "=?UTF-8?B?" . base64_encode($fromName) . "?=";
    $headersClient = "From: $fromNameEncoded <manager@bagetnaya-masterskaya.com>\r\n"
        . "Reply-To: manager@bagetnaya-masterskaya.com\r\n"
        . "Content-Type: text/html; charset=UTF-8\r\n";

    $subjectClient = $name . ' вы оформили заказ на сайте Багетной мастерской';
    $messageClient = $zakazkl;
    mail($mail, $subjectClient, $messageClient, $headersClient);

    // Выводим страницу успеха
    echo '
          <div class=" baget-zakaz-main text-center m-5">
              <div class="baget-zakaz-accept">
                  <h1 style="color:  #AD1F2D; margin-bottom: 20px;">Ваш заказ принят!</h1>
                  <h3>В ближайшее время наш менеджер свяжется с вами.</h3>
              </div>
              <div class="flex-but justify-content-center">
                  <a rel="nofollow" href="/baget_online?id=' . $ident . '" class="baget-zakaz-accept-button1">
                      Вернуться к выбору багета
                  </a>
                  <a rel="nofollow" href="/" class="baget-zakaz-accept-button2">
                      Перейти на главную страницу
                  </a>
              </div>
          </div>';

    // Запись в лог-файл
    $towrite = date("j.m.Y G:i")
        . '-!-' . $_SERVER["REMOTE_ADDR"]
        . '-!-' . $ident
        . '-!-' . $name
        . '-!-' . $phone
        . '-!-' . $mail
        . '-!-' . 'OK'
        . "\r\n";
    fwrite($f_zak_hist, $towrite);
    fclose($f_zak_hist);

} else {
    // Выводим страницу ошибки
    echo '<title>Ошибка при отправке заказа</title>
          </HEAD>
          <BODY>
          <div class="baget-zakaz-main">
              <div class="baget-zakaz-error">
                  При отправке заказа произошла ошибка!<br>
                  Свяжитесь, пожалуйста, с нами по телефонам:<br>
                  8 (495) 504-73-04 или 8 (495) 951-77-51
              </div>
              <a rel="nofollow" href="/baget_online?id=' . $ident . '" class="baget-zakaz-accept-button1">
                  Вернуться к выбору багета
              </a>
              <a rel="nofollow" href="/" class="baget-zakaz-accept-button2">
                  Перейти на главную страницу
              </a>
          </div>';

    // Запись о неудачной отправке
    $towrite = date("F j, Y, g:i a")
        . '-!-' . $_SERVER["REMOTE_ADDR"]
        . '-!-' . $ident
        . '-!-' . $name
        . '-!-' . $phone
        . '-!-' . $mail
        . '-!-' . 'ERR'
        . "\r\n";
    fwrite($f_zak_hist, $towrite);
    fclose($f_zak_hist);
}
?>

    <style>
        .flex-but {
            margin-top: 40px;
            display: flex;
            gap: 20px;
        }
    </style>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
