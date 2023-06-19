<?
require_once '../../base/connect.php';

$kod = 'none';

if (isset($_POST["kod"])) {
    $kod = $_POST["kod"];
}

$NewDate = Date('Y-m-d H:i:s');
$stm = $dbh->prepare("SELECT * FROM promo_kods where series_id = '" . $kod  . "' and active=1 and date_end >= '" . $NewDate . "'");
$stm->execute();
$data = $stm->fetch();

echo json_encode($data);
