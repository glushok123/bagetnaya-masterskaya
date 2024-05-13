<?
require_once '../../base/connect.php';

$stm = $dbh->prepare("SELECT * FROM orders_paintings");
$stm->execute();
$data = $stm->fetchAll();

$text = '<div class="container">
    <br>

    <div class="row text-center justify-content-center">';
$text = $text . '<table class="table table-striped table-bordered table-dark table-hover table-sm" id="orders-paintings-table">';
$text = $text . '
        <thead>
            <tr>
                <th>id</th>
                <th>Клиент</th>
                <th>email</th>
                <th>телефон</th>
                <th>статус</th>
                <th>Картина</th>
                <th>Тип доставки</th>
                <th>Адресс</th>
                <th>Комментарий</th>
                <th>Дата</th>
            </tr>
        </thead><tbody>';

foreach ($data as $item) {
    $active = $item['active'] == '1' ? 'активный' : 'не активный';

    $text = $text .
        '
            <tr>
                <td><span class="promokod">' . $item['id'] . '</span></td>
                <td><span class="procent">' . $item['name'] . '</span></td>
                <td><span class="count">' . $item['email'] . '</span></td>
                <td><span class="active">' . $item['phone'] . '</span></td>
                <td><span class="active">' . $item['status'] . '</span></td>
                <td><span class="active"><a href="https://bagetnaya-masterskaya.com/admin/?paintings-id=' . $item['painting_id'] . '">Перейти</a></span></td>
                <td><span class="active">' . $item['type_dostavky'] . '</span></td>
                <td><span class="active">' . $item['address'] . '</span></td>
                <td><span class="active">' . $item['comment'] . '</span></td>
                <td><span class="active">' . $item['created_at'] . '</span></td>
            </tr>
          ';
}
$text = $text . '</tbody></table></div></div>';

echo $text;
