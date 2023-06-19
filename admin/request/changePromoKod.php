<?
require_once '../../base/connect.php';

$stm = $dbh->prepare("
        UPDATE promo_kods 
        SET
        sale_procent = '" . $_POST['sale_procent'] . "',
        sale_count = '" . $_POST['sale_count'] . "',
        active = '" . $_POST['active'] . "'
        where series_id = '" . $_POST['series_id'] . "'");
$stm->execute();

echo 'success';
