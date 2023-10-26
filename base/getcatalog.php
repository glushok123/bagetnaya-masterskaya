<?


require_once ('../auth/authCheck.php');
require_once 'connect.php';

global $dbh;
// Кол-во элементов
$limit = 20;

$type = $_POST['type'];
$sorter = $_POST['sorter'];

$page = empty($_POST['page'])? 1: intval($_POST['page']);
$page = (empty($page)) ? 1 : $page;
$start = ($page != 1) ? $page * $limit - $limit : 0;


if (isset($sorter)) {
	$sorter = explode('-', (string) $sorter);
	$orderby = $sorter[0];
	$ordertype = $sorter[1];
} else {
	$orderby = 'publicvendor';
}

$query = "SELECT * FROM catalog_baget WHERE type=? AND price > 0 AND storage > 9 ORDER BY " . $orderby . " " . $ordertype . " LIMIT {$start}, {$limit}";

$stmt = $dbh->prepare($query);
$stmt->bindParam(1, $type);
$stmt->execute();
$data = $stmt->fetchAll();

?> 


<?


foreach ($data as $baget) { ?>

	<? 
		$class = '';
		if ($baget['storage'] > 30) {
			$class = 'bg-nal2';
		} else{
			$class = 'bg-nal1';
		}
	?>

	<div class='my-2 mx-2 col-5 col-xl-2 text-start <?= $class ?>'>

		<a class=" catalog-item  del<?= $baget['id'] ?>" 
			onclick="
				<? if ($type == 'pasp') { ?>
					z[12]=0; 
					z[3]=<?= $baget['publicvendor'] ?>; 
					z[4]=<?= $baget['price'] ?>;
				<? } else { ?>
					z[12]=0; 
					z[0]=<?= $baget['publicvendor'] ?>; 
					z[1]=<?= $baget['price'] ?>; 
					z[2]=<?= $baget['width'] ?>; 
					z[22]=<?= $baget['widthwithout'] ?>; 
				<? } ?>
				changePage (); 
				getitem(<?= $baget['publicvendor'] ?>); 
				countprice ();" 
				name="<?= $baget['publicvendor'] ?>
			">

			<? 
				if (
					$_SERVER["REMOTE_ADDR"] == "31.173.10.9" || 
					$_SERVER["REMOTE_ADDR"] == "185.228.112.85" || 
					$_SERVER["REMOTE_ADDR"] == "5.39.162.100" || 
					$_SERVER["REMOTE_ADDR"] == '176.108.160.115'
				) { 
			?>
				<div class="delete-baget" onclick="deleteBaget(<?= $baget['id'] ?>);"></div>
			<? } ?>

			<div class="maskimg">
				<img src="
					<? if ($type == "pasp") { ?>
						/pi/
					<? } else { ?>
						/bi/
					<? } ?>
					<?= $baget['listimg'] ?>
				"
				realsrc="
					<? if ($type == "pasp") { ?>
						/pi/
					<? } else { ?>
						/bi/
					<? } ?>
					<?= $baget['listimg'] ?>
				" 
				align="center" 
				class="bmenuimg">
			</div>
			
			<div class='catalog-block-info my-2'>
				<h5 class='text-nowrap text-start catalog-art'>Арт. <?= $baget['publicvendor'] ?></h5>
				<? if ($minimaster) { ?>
					<h5 class='text-nowrap text-start catalog-art'>Арт. <?= $baget['vendor'] ?></h5>
				<? } ?>
				<? if ($type !== "pasp") { ?>
					<h5 class='text-nowrap text-start catalog-info'>Ширина: <?= $baget['width'] ?> мм</h5>
					<h5 class='text-nowrap text-start catalog-info'>Без четверти: <?= $baget['widthwithout'] ?> мм</h5>
				<? } ?>
				<? if ($type == "pasp") { ?>
					<br>Цвет: <?= $baget['color'] ?>
				<? } ?>
			</div>
			
			<div class='row text-center my-2'>
				<span class='catalog-price text-nowrap'><?= $baget['price'] ?> ₽</span> 
			</div>
			<? if ($type !== "pasp") { ?>
				<? if ($baget['storage'] > 30) { ?>
					
					<div class="nalich2">В наличии</div>
				<? } else { ?>
					<div class="nalich1">Огранич. кол-во</div>
			<? }
			} ?>
		</a>
	</div>

<? } ?>
