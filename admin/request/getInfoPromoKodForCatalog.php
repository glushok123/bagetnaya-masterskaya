<?
require_once '../../base/connect.php';

$kod = 'none';

if (isset($_POST["kod"])) {
    $kod = (string)$_POST["kod"];
}

$NewDate = Date('Y-m-d H:i:s');
$stm = $dbh->prepare("SELECT * FROM promo_kods where series_id = ? and active=1 and date_end >= ?");
$stm->execute([$kod, $NewDate]);
$data = $stm->fetch();

echo json_encode($data, JSON_THROW_ON_ERROR);
