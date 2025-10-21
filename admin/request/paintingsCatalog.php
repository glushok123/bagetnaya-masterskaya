<?
require_once '../../base/connect.php';


$stm = $dbh->prepare("SELECT * FROM paintings");
$stm->execute();
$data = $stm->fetchAll();

$text = '
    <div class="container">
        <div class="container">
            <div class="row text-center justify-content-center">
                <button type="button" class="btn btn-success" style="max-width: 200px!important; margin:20px 20px 20px 20px" data-bs-toggle="modal" data-bs-target="#ModalAddPainting">Добавить</button>
                <hr>
            </div>
            <div class="row g-0 " products-block style="margin-right: 25px!important">';

foreach ($data as $item) {
    $stm = $dbh->prepare("SELECT * FROM paintings_images where paintings_id = '" . $item['id'] . "'");
    $stm->execute();
    $images = $stm->fetchAll();

    $countImage = 0;
    $textImageHeader = '';
    $textImageBody = '';
    $textImageFooter = '';

    $activeValue = (int)$item['active'] === 1 ? 1 : 0;
    $activeText = $activeValue === 1 ? 'да' : 'нет';

    $name = htmlspecialchars($item['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $avtor = htmlspecialchars($item['avtor'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $sizes = htmlspecialchars($item['sizes'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $price = htmlspecialchars($item['price_one'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

    foreach ($images as $image) {
        if ($countImage == 0) {
            $textImageHeader = $textImageHeader . '<button type="button" data-bs-target="#carousel' . $item['id'] . '" data-bs-slide-to="' . $countImage . '" class="active" aria-current="true" aria-label="Slide ' . $countImage . '"></button>';
            $textImageBody = $textImageBody . '
                <div class="carousel-item active">
                    <a data-fancybox="images" href="/фото_картин/' . $image['image'] . '"><img src="/фото_картин/' . $image['image'] . '" class="d-block w-95 castom-image rounded" alt="..." ></a>
                </div>
            ';
        } else {
            $textImageHeader = $textImageHeader . '<button type="button" data-bs-target="#carousel' . $item['id'] . '" data-bs-slide-to="' . $countImage . '" aria-label="Slide ' . $countImage . '"></button>';
            $textImageBody = $textImageBody . '
                <div class="carousel-item">
                    <a data-fancybox="images" href="/фото_картин/' . $image['image'] . '"><img src="/фото_картин/' . $image['image'] . '" class="d-block w-95 castom-image rounded" alt="..." ></a>
                    
                </div>
            ';
        }

        $countImage = $countImage + 1;
    }

    $textImage = '
            <div id="carousel' . $item['id'] . '" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    ' . $textImageHeader . '
                </div>
                <div class="carousel-inner ">
                    ' . $textImageBody . '
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel' . $item['id'] . '"  data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Предыдущий</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel' . $item['id'] . '"  data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Следующий</span>
                </button>
            </div>
        ';


    $text = $text . '
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 d-flex align-items-stretch">
                <div class="card text-center h-100" style="width:100%" href="/">
                    ' . $textImage . '
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title name">' . $name . '</h5>
                        <hr>
                        <h5 class="card-text avtor">ID: ' . $item['id'] . '</h5>
                        <h5 class="card-text avtor">Автор: ' . $avtor . '</h5>
                        <h5 class="card-text size">' . $sizes . ' мм</h5>
                        <h5 class="card-text price">' . $price . ' ₽</h5>
                        <h5 class="card-text active">Активна: ' . $activeText . '</h5>
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary btn-edit-painting"
                                    data-id="' . $item['id'] . '"
                                    data-name="' . $name . '"
                                    data-avtor="' . $avtor . '"
                                    data-size="' . $sizes . '"
                                    data-price="' . $price . '"
                                    data-active="' . $activeValue . '">Изменить</button>
                            <button class="btn btn-outline-danger btn-delete-painting" data-id="' . $item['id'] . '">Удалить</button>
                        </div>
                    </div>
                </div>
            </div>

        ';
}
$text = $text . '</div></div></div>';

echo $text;
