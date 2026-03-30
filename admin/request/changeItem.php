<?
require_once '../../base/connect.php';

$price = $_POST['price'];
$width = $_POST['width'];
$widthwithout = $_POST['widthwithout'];
$storage = $_POST['storage'];
$color = $_POST['color'];
$fixedPrice = !empty($_POST['fixed_price']) ? 1 : 0;
$id = $_POST['id'];

$stm = $dbh->prepare("
        UPDATE catalog_baget 
        SET
        price = ?,
        width = ?,
        widthwithout = ?,
        storage = ?,
        color = ?,
        fixed_price = ?
        where id = ?");

$stm->execute([
    $price,
    $width,
    $widthwithout,
    $storage,
    $color,
    $fixedPrice,
    $id,
]);

echo 'success';
