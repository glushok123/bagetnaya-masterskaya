<?
require_once '../../base/connect.php';

$stm = $dbh->prepare("
        UPDATE catalog_baget 
        SET
        price = '" . $_POST['price'] . "',
        width = '" . $_POST['width'] . "',
        widthwithout = '" . $_POST['widthwithout'] . "',
        storage = '" . $_POST['storage'] . "',
        color = '" . $_POST['color'] . "'
        where id = '" . $_POST['id'] . "'");
$stm->bindParam(1, $_POST['id']);
$stm->execute();

echo 'success';
