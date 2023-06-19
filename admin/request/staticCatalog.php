<?
require_once '../../base/connect.php';

$stm = $dbh->prepare("SELECT * FROM catalog_baget");
$stm->bindParam(1, $z[0]);
$stm->execute();
$data = $stm->fetchAll();

$text = '<div class="container"><div class="row text-center justify-content-center">';
$text = $text . '<table class="table table-striped table-bordered table-dark table-hover">';

$totalCount = 0;
$plastCount = 0;
$woodCount = 0;
$alumCount = 0;
$paspCount = 0;

$totalPrice = 0;
$plastPrice = 0;
$woodPrice = 0;
$alumPrice = 0;
$paspPrice = 0;

$totalCountPriceNull = 0;
$plastCountPriceNull = 0;
$woodCountPriceNull = 0;
$alumCountPriceNull = 0;
$paspCountPriceNull = 0;

$totalCountStorageNull = 0;
$plastCountStorageNull = 0;
$woodCountStorageNull = 0;
$alumCountStorageNull = 0;
$paspCountStorageNull = 0;

$totalCountStorage = 0;
$plastCountStorage = 0;
$woodCountStorage = 0;
$alumCountStorage = 0;
$paspCountStorage = 0;

foreach ($data as $item) {
    // Общее количество
    $totalCount = $totalCount + 1;
    if ($item['type'] == 'plast') {
        $plastCount = $plastCount + 1;
    }
    if ($item['type'] == 'wood') {
        $woodCount = $woodCount + 1;
    }
    if ($item['type'] == 'alum') {
        $alumCount = $alumCount + 1;
    }
    if ($item['type'] == 'pasp') {
        $paspCount = $paspCount + 1;
    }

    // Цена равная 0
    if ($item['price'] == 0) {
        $totalCountPriceNull = $totalCountPriceNull + 1;
    } else {
        $totalPrice = $totalPrice + $item['price'];
    }

    if ($item['type'] == 'plast' && $item['price'] == 0) {
        $plastCountPriceNull = $plastCountPriceNull + 1;
    } else if ($item['type'] == 'plast' && $item['price'] != 0) {
        $plastPrice = $plastPrice + $item['price'];
    }

    if ($item['type'] == 'wood' && $item['price'] == 0) {
        $woodCountPriceNull = $woodCountPriceNull + 1;
    } else if ($item['type'] == 'wood' && $item['price'] != 0) {
        $woodPrice = $woodPrice + $item['price'];
    }

    if ($item['type'] == 'alum' && $item['price'] == 0) {
        $alumCountPriceNull = $alumCountPriceNull + 1;
    } else if ($item['type'] == 'alum' && $item['price'] != 0) {
        $alumPrice = $alumPrice + $item['price'];
    }

    if ($item['type'] == 'pasp' && $item['price'] == 0) {
        $paspCountPriceNull = $paspCountPriceNull + 1;
    } else if ($item['type'] == 'pasp' && $item['price'] != 0) {
        $paspPrice = $paspPrice + $item['price'];
    }

    // количество
    if ($item['storage'] != 0) {
        $totalCountStorage = $totalCountStorage + 1;
    }

    if ($item['type'] == 'plast' && $item['storage'] != 0) {
        $plastCountStorage = $plastCountStorage + 1;
    }

    if ($item['type'] == 'wood' && $item['storage'] != 0) {
        $woodCountStorage = $woodCountStorage + 1;
    }

    if ($item['type'] == 'alum' && $item['storage'] != 0) {
        $alumCountStorage = $alumCountStorage + 1;
    }

    if ($item['type'] == 'pasp' && $item['storage'] != 0) {
        $paspCountStorage = $paspCountStorage + 1;
    }
}

$totalCountStorageNull = $totalCount - $totalCountStorage;
$plastCountStorageNull = $plastCount - $plastCountStorage;
$woodCountStorageNull = $woodCount - $woodCountStorage;
$alumCountStorageNull = $alumCount - $alumCountStorage;
$paspCountStorageNull = $paspCount - $paspCountStorage;

$totalPrice = ceil($totalPrice / ($totalCount - $totalCountPriceNull));
$plastPrice = ceil($plastPrice / ($plastCount - $plastCountPriceNull));
$woodPrice = ceil($woodPrice / ($woodCount - $woodCountPriceNull));
$alumPrice = ceil($alumPrice / ($alumCount - $alumCountPriceNull));
$paspPrice = ceil($paspPrice / ($paspCount - $paspCountPriceNull));

$text = $text . '
        <tr>
            <td>Тип</td>
            <td>Общее количество</td>
            <td>Без цены</td>
            <td>В наличии</td>
            <td>Не в наличии</td>
            <td>Средняя цена</td>
        </tr>
        <tr>
            <td>Пластик</td>
            <td>' . $plastCount . '</td>
            <td>' . $plastCountPriceNull . '</td>
            <td>' . $plastCountStorage . '</td>
            <td>' . $plastCountStorageNull . '</td>
            <td>' . $plastPrice . '</td>
        </tr>
        <tr>
            <td>Дерево</td>
            <td>' . $woodCount . '</td>
            <td>' . $woodCountPriceNull . '</td>
            <td>' . $woodCountStorage . '</td>
            <td>' . $woodCountStorageNull . '</td>
            <td>' . $woodPrice . '</td>
        </tr>
        <tr>
            <td>Алюминий</td>
            <td>' . $alumCount . '</td>
            <td>' . $alumCountPriceNull . '</td>
            <td>' . $alumCountStorage . '</td>
            <td>' . $alumCountStorageNull . '</td>
            <td>' . $alumPrice . '</td>
        </tr>
        <tr>
            <td>Паспарту</td>
            <td>' . $paspCount . '</td>
            <td>' . $paspCountPriceNull . '</td>
            <td>' . $paspCountStorage . '</td>
            <td>' . $paspCountStorageNull . '</td>
            <td>' . $paspPrice . '</td>
        </tr>
        <tr>
        <td>Итого</td>
            <td>' . $totalCount . '</td>
            <td>' . $totalCountPriceNull . '</td>
            <td>' . $totalCountStorage . '</td>
            <td>' . $totalCountStorageNull . '</td>
            <td>' . $totalPrice . '</td>
        </tr>
    ';

$text = $text . '</table></div></div>';

echo $text;
