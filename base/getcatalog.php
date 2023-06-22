<?
$master = false;
$minimaster = false;
// if ($_SERVER["REMOTE_ADDR"]=='5.39.162.100' || $_SERVER["REMOTE_ADDR"]=='127.0.0.1') {$master=true;}
if (
	$_SERVER["REMOTE_ADDR"] == '5.39.162.100' ||
	$_SERVER["REMOTE_ADDR"] == '5.39.162.199' ||
	$_SERVER["REMOTE_ADDR"] == '176.108.160.115' ||
	$_SERVER["REMOTE_ADDR"] == '95.25.90.151' ||
	$_SERVER["REMOTE_ADDR"] == '195.91.191.75' ||
	$_SERVER["REMOTE_ADDR"] == '31.173.10.9'
) {
	$minimaster = true;
}
$type = $_POST['type'];
$sorter = $_POST['sorter'];
if (isset($sorter)) {
	$sorter = explode('-', (string) $sorter);
	$orderby = $sorter[0];
	$ordertype = $sorter[1];
} else {
	$orderby = 'publicvendor';
}

$query = "SELECT * FROM catalog_baget WHERE type=? AND price > 0 AND storage > 9 ORDER BY " . $orderby . " " . $ordertype;
require_once 'connect.php';
$stmt = $dbh->prepare($query);
$stmt->bindParam(1, $type);
$stmt->execute();
$data = $stmt->fetchAll();
foreach ($data as $baget) { ?>

	<a class="catalog-item del<?= $baget['id'] ?>" onclick="
	<? if ($type == "pasp") { ?>
	z[12]=0; z[3]=<?= $baget['publicvendor'] ?>; z[4]=<?= $baget['price'] ?>;
	<? } else { ?>
		z[12]=0; z[0]=<?= $baget['publicvendor'] ?>; z[1]=<?= $baget['price'] ?>; z[2]=<?= $baget['width'] ?>; z[22]=<?= $baget['widthwithout'] ?>; 
	<? } ?>
	changePage (); getitem(<?= $baget['publicvendor'] ?>); countprice ();" name="<?= $baget['publicvendor'] ?>">
		<? if ($_SERVER["REMOTE_ADDR"] == "31.173.10.9" || $_SERVER["REMOTE_ADDR"] == "185.228.112.85" || $_SERVER["REMOTE_ADDR"] == "5.39.162.100" || $_SERVER["REMOTE_ADDR"] == '176.108.160.115') { ?>
			<div class="delete-baget" onclick="deleteBaget(<?= $baget['id'] ?>);"></div>
		<? } ?>
		<div class="maskimg"><img src="/img/loading.gif" realsrc="<? if ($type == "pasp") { ?>/pi/<? } else { ?>/bi/<? } ?><?= $baget['listimg'] ?>" align="left" class="bmenuimg"></div>
		<b>Арт. <?= $baget['publicvendor'] ?></b>
		<? if ($minimaster) { ?>
			<br>Арт. <?= $baget['vendor'] ?>
		<? } ?>
		<? if ($type !== "pasp") { ?>
			<br>Ширина: <?= $baget['width'] ?> мм
			<br>Без четверти: <?= $baget['widthwithout'] ?> мм
		<? } ?>
		<? if ($type == "pasp") { ?>
			<br>Цвет: <?= $baget['color'] ?>
		<? } ?>
		<br><span style="font-size:125%;"><?= $baget['price'] ?></span>р.
		<? if ($type !== "pasp") { ?>
			<? if ($baget['storage'] > 30) { ?>
				<br>
				<div class="nalich2">есть в наличии</div>
			<? } else { ?>
				<br>
				<div class="nalich1">огранич. кол-во</div>
		<? }
		} ?>
	</a>
<? } ?>