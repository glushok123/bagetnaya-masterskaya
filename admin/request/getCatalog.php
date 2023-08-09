<?
require_once '../../base/connect.php';

$typeCatalog = 'plast';
$sort = '';
$conditionSort = '';

if (isset($_POST["typeCatalog"])) {
    $typeCatalog = $_POST["typeCatalog"];
}

if (isset($_POST["sort"])) {
    $sort = $_POST["sort"];
}

if ($sort != '') {
    switch ($sort) {
        case 'priceDesc':
            $conditionSort = ' ORDER BY price DESC';
            break;
        case 'priceAsc':
            $conditionSort = ' ORDER BY price ASC';
            break;
        case 'idDesc':
            $conditionSort = ' ORDER BY publicvendor DESC';
            break;
        case 'idAsc':
            $conditionSort = ' ORDER BY publicvendor ASC';
            break;
        case 'countDesc':
            $conditionSort = ' ORDER BY storage DESC';
            break;
        case 'countAsc':
            $conditionSort = ' ORDER BY storage ASC';
            break;
        case 'widthDesc':
            $conditionSort = ' ORDER BY width DESC';
            break;
        case 'widthAsc':
            $conditionSort = ' ORDER BY width ASC';
            break;
        case 'widthwithoutDesc':
            $conditionSort = ' ORDER BY widthwithout DESC';
            break;
        case 'widthwithoutAsc':
            $conditionSort = ' ORDER BY widthwithout ASC';
            break;
    }
}

$stm = $dbh->prepare("SELECT * FROM catalog_baget where type = '" . $typeCatalog . "' " . $conditionSort);
$stm->execute();
$data = $stm->fetchAll();

$text = '<div class="container"><div class="row text-center justify-content-center">';

foreach ($data as $item) {
    $src = $item['type'] == 'pasp' ? 'pi' : 'bi';
    $color = $item['storage'] == 0 ? ' red' : ' green';

    $text = $text .
        '
                <div class="col-auto" >
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top rounded mx-auto d-block" src="/' . $src . '/' . $item['listimg'] . '" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Артикул: <span class="vendor">' . $item['publicvendor'] . '</span></h5>
                            <p>Арт. поставщика: <span class="blue">' . $item['vendor'] . '</span></p>
                            (<span class="blue">' . $item['company'] . '</span> - 
                            <span class="blue">' . $item['date_update'] . '</span>)
                            <hr>
                            <p class="card-title blue">Цена: <span class="price">' . $item['price'] . '</span></p>
                            <p class="card-title">Ширина: <span class="width">' . $item['width'] . '</span></p>
                            <p class="card-title">Без четверти: <span class="widthwithout">' . $item['widthwithout'] . '</span></p>
                            
                            <p class="card-title ' . $color . '">Количество: <span class="storage">' . $item['storage'] . '</span></p>
                            
                            <p class="card-title">Цвет: <span class="color">' . $item['color'] . '</span></p>
                            <p class="card-text"></p>
                            <hr>
                            <p>Основные цвета багета (определенные автоматически):</p>
                            <hr>
                            <div class="row my-3 text-center justify-content-center">
                                <div class="col-3">
                                    <div style="width:50px; height:50px; border-radius:100px; background-color: ' . $item['color_m1'] . '"></div>
                                </div>
                                <div class="col-3">
                                    <div style="width:50px; height:50px; border-radius:100px; background-color: ' . $item['color_m2'] . '"></div>
                                </div>
                                <div class="col-3">
                                    <div style="width:50px; height:50px; border-radius:100px; background-color: ' . $item['color_m3_1'] . '"></div>
                                </div>
                            </div>
                            <a class="btn btn-primary change" data-id="' . $item['id'] . '">Изменить</a>
                            <a class="btn btn-danger delete" data-id="' . $item['id'] . '">Удалить</a>
                        </div>
                    </div>
                </div>
          ';
}
$text = $text . '</div></div>';

echo $text;
