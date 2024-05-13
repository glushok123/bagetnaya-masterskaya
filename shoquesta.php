<style>
    body {
        width: 650px;
        margin-left: calc(50% - 325px);
        padding: 0;
        margin-top: 0;
    }

    div {
        position: relative;
        float: left;
        width: calc(100% - 2px);
        border: solid 1px #666;
        text-align: center;
        margin: 1px 0;
    }

    h2 {
        position: relative;
        float: left;
        width: 100%;
        display: block;
        line-height: 1.25em;
        height: 1.25em;
        text-align: center;
        font-weight: 400;
        font-size: 1.125em;
        margin: 0;
        padding: 0;
        background: #ccf;
        border-top: solid 2px #000;
    }

    div > p {
        position: absolute;
        top: 0;
        left: 0;
        margin: 0;
        padding: 0;
        display: block;
        background: #9f9;
        height: 100%;
        z-index: -1;
    }
</style>

<?
$b = [];
$f = file('base/quest.txt');
$cf = is_countable($f) ? count($f) : 0;
for ($i = 0; $i < $cf; $i++) {
    $a = explode('|', $f[$i]);
    $b = explode('l', $a[1]);
    if ($b[0] == '1') {
        $c[0] += 1;
    }
    if ($b[0] == '2') {
        $c[1] += 1;
    }
    if ($b[0] == '3') {
        $c[2] += 1;
    }
    if ($b[0] == '4') {
        $c[3] += 1;
    }
    if ($b[1] == '1') {
        $c[4] += 1;
    }
    if ($b[1] == '2') {
        $c[5] += 1;
    }
    if ($b[1] == '3') {
        $c[6] += 1;
    }
    if ($b[1] == '4') {
        $c[7] += 1;
    }
    if ($b[1] == '5') {
        $c[8] += 1;
    }
    if ($b[2] == '1') {
        $c[9] += 1;
    }
    if ($b[2] == '2') {
        $c[10] += 1;
    }
    if ($b[2] == '3') {
        $c[11] += 1;
    }
    if ($b[3] == '1') {
        $c[12] += 1;
    }
    if ($b[3] == '2') {
        $c[13] += 1;
    }
    if ($b[3] == '3') {
        $c[14] += 1;
    }
    if ($b[3] == '4') {
        $c[15] += 1;
    }
    if ($b[3] == '5') {
        $c[16] += 1;
    }
    if ($b[3] == '6') {
        $c[17] += 1;
    }
    if ($b[4] == '1') {
        $c[18] += 1;
    }
    if ($b[4] == '2') {
        $c[19] += 1;
    }
    if ($b[4] == '3') {
        $c[20] += 1;
    }
    if ($b[4] == '4') {
        $c[21] += 1;
    }
    if ($b[4] == '5') {
        $c[22] += 1;
    }
    if ($b[5] == '1') {
        $c[23] += 1;
    }
    if ($b[5] == '2') {
        $c[24] += 1;
    }
    if ($b[5] == '3') {
        $c[25] += 1;
    }
    if ($b[5] == '4') {
        $c[26] += 1;
    }
    if ($b[5] == '5') {
        $c[27] += 1;
    }
    if ($b[6] == '1') {
        $c[28] += 1;
    }
    if ($b[6] == '2') {
        $c[29] += 1;
    }
    if ($b[6] == '3') {
        $c[30] += 1;
    }
    if ($b[7] == '1') {
        $c[31] += 1;
    }
    if ($b[7] == '2') {
        $c[32] += 1;
    }
    if ($b[7] == '3') {
        $c[33] += 1;
    }
}

for ($i = 0; $i < 34; $i++) {
    $c[$i] = round($c[$i] / $cf * 100);
}

echo "<h2>Всего проголосовало:</h2>";
echo "<div>$cf человек</div>";
echo "<h2>1. Откуда Вы узнали о нашей компании:</h2>";
echo '<div><p style="width:' . $c[0] . '%;"></p>Яндекс: ' . $c[0] . '%</div>';
echo '<div><p style="width:' . $c[1] . '%;"></p>Google: ' . $c[1] . '%</div>';
echo '<div><p style="width:' . $c[2] . '%;"></p>Реклама на сайтах: ' . $c[2] . '%</div>';
echo '<div><p style="width:' . $c[3] . '%;"></p>Рекомендация знакомых: ' . $c[3] . '%</div>';
echo "<h2>2. Как часто Вы пользуетесь услугами багетных мастерских:</h2>";
echo '<div><p style="width:' . $c[4] . '%;"></p>раз в месяц: ' . $c[4] . '%</div>';
echo '<div><p style="width:' . $c[5] . '%;"></p>раз в год: ' . $c[5] . '%</div>';
echo '<div><p style="width:' . $c[6] . '%;"></p>3-4 раза в год: ' . $c[6] . '%</div>';
echo '<div><p style="width:' . $c[7] . '%;"></p>постоянно пользуюсь: ' . $c[7] . '%</div>';
echo '<div><p style="width:' . $c[8] . '%;"></p>первый и последний раз в жизни: ' . $c[8] . '%</div>';
echo "<h2>3. Для каких целей Вы обычно делаете заказы в Багетной мастерской:</h2>";
echo '<div><p style="width:' . $c[9] . '%;"></p>оформляю собственное творчество: ' . $c[9] . '%</div>';
echo '<div><p style="width:' . $c[10] . '%;"></p>заказываю в качестве подарка для друзей и родственников: ' . $c[10] . '%</div>';
echo '<div><p style="width:' . $c[11] . '%;"></p>в связи с потребностями в таких услугах нашей компании: ' . $c[11] . '%</div>';
echo "<h2>4. Какой услугой нашей мастерской Вы воспользовались в этот раз:</h2>";
echo '<div><p style="width:' . $c[12] . '%;"></p>оформление картины или фотографии в багет: ' . $c[12] . '%</div>';
echo '<div><p style="width:' . $c[13] . '%;"></p>печать изображения на холсте: ' . $c[13] . '%</div>';
echo '<div><p style="width:' . $c[14] . '%;"></p>оформление вышивки (хэндмейда) в багет: ' . $c[14] . '%</div>';
echo '<div><p style="width:' . $c[15] . '%;"></p>заказывал модульную картину: ' . $c[15] . '%</div>';
echo '<div><p style="width:' . $c[16] . '%;"></p>оформление иконы в багет: ' . $c[16] . '%</div>';
echo '<div><p style="width:' . $c[17] . '%;"></p>накатка на пенокартон: ' . $c[17] . '%</div>';
echo "<h2>5. Что Вам не понравилось в работе нашей мастерской:</h2>";
echo '<div><p style="width:' . $c[18] . '%;"></p>все отлично и все понравилось: ' . $c[18] . '%</div>';
echo '<div><p style="width:' . $c[19] . '%;"></p>некачественно выполнен заказ: ' . $c[19] . '%</div>';
echo '<div><p style="width:' . $c[20] . '%;"></p>не слишком вежливое и внимательное отношение сотрудников: ' . $c[20] . '%</div>';
echo '<div><p style="width:' . $c[21] . '%;"></p>неудобное расположение мастерской: ' . $c[21] . '%</div>';
echo '<div><p style="width:' . $c[22] . '%;"></p>высокая цена на оказываемые услуги: ' . $c[22] . '%</div>';
echo "<h2>6. Оцените по 5-ти балльной шкале удобство нашего сайта:</h2>";
echo '<div><p style="width:' . $c[23] . '%;"></p>1: ' . $c[23] . '%</div>';
echo '<div><p style="width:' . $c[24] . '%;"></p>2: ' . $c[24] . '%</div>';
echo '<div><p style="width:' . $c[25] . '%;"></p>3: ' . $c[25] . '%</div>';
echo '<div><p style="width:' . $c[26] . '%;"></p>4: ' . $c[26] . '%</div>';
echo '<div><p style="width:' . $c[27] . '%;"></p>5: ' . $c[27] . '%</div>';
echo "<h2>7. Воспользовались ли Вы скидкой предоставляемой на нашем сайте:</h2>";
echo '<div><p style="width:' . $c[28] . '%;"></p>да: ' . $c[28] . '%</div>';
echo '<div><p style="width:' . $c[29] . '%;"></p>нет: ' . $c[29] . '%</div>';
echo '<div><p style="width:' . $c[30] . '%;"></p>что-то не заметил, где тут у вас дают скидку: ' . $c[30] . '%</div>';
echo "<h2>8. Готовы ли Вы еще раз воспользоваться услугами нашей Багетной мастерской:</h2>";
echo '<div><p style="width:' . $c[31] . '%;"></p>да: ' . $c[31] . '%</div>';
echo '<div><p style="width:' . $c[32] . '%;"></p>нет: ' . $c[32] . '%</div>';
echo '<div><p style="width:' . $c[33] . '%;"></p>сначала проверю, как работают другие мастерские: ' . $c[33] . '%</div>';
?>