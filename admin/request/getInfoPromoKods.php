<?
require_once '../../base/connect.php';

$stm = $dbh->prepare("SELECT * FROM promo_kods");
$stm->execute();
$data = $stm->fetchAll();

$text = '<div class="container">
    <br>
    <div class="row text-center justify-content-center">
        <br>
        <button style="max-width:150px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAddPromoKod">Добавить</button>
        <br>
    </div>
    <div class="row text-center justify-content-center">';
$text = $text . '<table class="table table-striped table-bordered table-dark table-hover table-sm" id="promo-kods-table">';
$text = $text . '
        <thead>
            <tr>
                <th>Код</th>
                <th>Скидка в процентах</th>
                <th>Скидка в рублях</th>
                <th>Активный</th>
                <th>Действие</th>
            </tr>
        </thead><tbody>';

foreach ($data as $item) {
    $saleProcent = empty($item['sale_procent']) ? '0' : $item['sale_procent'];
    $saleCount = empty($item['sale_count']) ? '0' : $item['sale_count'];
    $active = $item['active'] == '1' ? 'активный' : 'не активный';

    $text = $text .
        '
            <tr>
                <td><span class="promokod">' . $item['series_id'] . '</span></td>
                <td><span class="procent">' . $saleProcent  . '</span>%</td>
                <td><span class="count">' . $saleCount . '</span> р.</td>
                <td><span class="active">' . $active . '</span></td>
                <td>
                    <button type="button" class="btn btn-danger delete-promo-kod" data-series="' . $item['series_id'] . '">Удалить</button>
                    <button style="margin-left:10px;" type="button" class="btn btn-success init-change-promo-kod" data-series="' . $item['series_id'] . '">Изменить</button>
                </td>
            </tr>
          ';
}
$text = $text . '</tbody></table></div></div>';

echo $text;
