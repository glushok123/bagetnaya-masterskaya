<?
require_once '../../base/connect.php';

$idItem = '';

if (isset($_POST["idItem"])) {
    $idItem = $_POST["idItem"];
}

$count = $dbh->exec("DELETE FROM promo_kods where series_id = '" . $idItem . "'");

echo $count;
