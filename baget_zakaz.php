<?
if ($_GET['id']) {
	$ident = $_GET['id'];
	if (preg_match("/^[\dl]+$/", (string) $ident)) {
		$z = explode('l', (string) $ident);
	} else {
		$fp = fopen('lo/g.txt', 'a');
		$towrite = date("j.m.Y G:i") . ' ! ' . $_SERVER["REMOTE_ADDR"] . ' ! ' . $ident . ' ! zakaz bad id';
		fwrite($fp, $towrite);
		fwrite($fp, "\r\n");
		fclose($fp);
		exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
	}
} else {
	$fp = fopen('lo/g.txt', 'a');
	$towrite = date("j.m.Y G:i") . ' ! ' . $_SERVER["REMOTE_ADDR"] . ' ! ' . $ident . ' ! zakaz without id';
	fwrite($fp, $towrite);
	fwrite($fp, "\r\n");
	fclose($fp);
	exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
}
?>
<!DOCTYPE HTML>
<HTML>

<HEAD>
	<link rel="SHORTCUT ICON" href="/favicon.ico">
	<? if ($_GET['id']) {
		echo '<link rel="canonical" href="http://bagetnaya-masterskaya.com/baget_zakaz"/>';
	} ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="content-language" content="ru">
	<meta name="keywords" content="заказ багета, багет онлайн">
	<meta name="description" content="">
	<title>Заказ багета онлайн</title>
	<link rel="stylesheet" type="text/css" href="/stylobgt.css">

<BODY>

	<?
	$zak_hist = file('base/zakaz-history.txt');
	$z[15] = 500 + (is_countable($zak_hist) ? count($zak_hist) : 0);
	$ident = implode("l", $z);
	$f_zak_hist = fopen('base/zakaz-history.txt', 'a');
	$towrite = date("j.m.Y G:i") . '-!-' . $_SERVER["REMOTE_ADDR"] . '-!-' . $ident . "\r\n";
	fwrite($f_zak_hist, $towrite);
	fclose($f_zak_hist);
	$pomokod = "не определен";

	if (isset($_GET["pomokod"])) {
		$pomokod = $_GET["pomokod"];
	}
	?>

	<div class="baget-zakaz-main">
		<div class="baget-zakaz-left"><?
										$kartx = $z[9] + 2 * ($z[2] + $z[5]);
										$karty = $z[10] + 2 * ($z[2] + $z[5]); ?>
			<div style="width:250px; font-size:150%; text-align:center;">Заказ №<?= $z[15] ?></div>
			<hr>
			<!-- <img src="/bi/<?= $z['0'] ?>.jpg"><br> -->
			Артикул багета: <strong><?= $z[0] ?></strong><br>Ширина изображения: <strong><?= $z[9] ?></strong> мм.<br>Высота изображения: <strong><?= $z[10] ?></strong> мм.<br>
			<? if ($z[3] <> "0") {
				echo '<br><img src="/pi/' . $z[3] . '.jpg" width="100px" height="100px">';
				echo '<br>Артикул паспарту: <strong>' . $z[3] . '</strong><br>Ширина паспарту: <strong>' . $z[5] . '</strong> мм.<br>';
			}
			if ($z[6] == 0) {
				echo '<br>Стекло: <strong>Нет</strong>';
			}
			if ($z[6] == 1) {
				echo '<br>Стекло: <strong>Обычное</strong>';
			}
			if ($z[6] == 2) {
				echo '<br>Стекло: <strong>Матовое</strong>';
			}
			if ($z[6] == 3) {
				echo '<br>Стекло: <strong>Антиблик</strong>';
			}
			if ($z[6] == 4) {
				echo '<br>Стекло: <strong>Пластиковое</strong>';
			}
			if ($z[7] == 0) {
				echo '<br>Задник: <strong>Нет</strong>';
			}
			if ($z[7] == 1) {
				echo '<br>Задник: <strong>Картон</strong>';
			}
			if ($z[7] == 2) {
				echo '<br>Задник: <strong>Пенокартон 5мм</strong>';
			}
			if ($z[7] == 3) {
				echo '<br>Задник: <strong>Пенокартон 10мм</strong>';
			}
			if ($z[7] == 4) {
				echo '<br>Задник: <strong>Подрамник</strong>';
			}
			echo '<br>Размер готовой картины, с учетом ширины багета и паспарту:<br><strong>' . $kartx . 'x' . $karty . '</strong> мм.<br>';
			echo '<br><hr>Цена: <strong style="font-size:120%;">' . $z[13] . '</strong> р.';
			echo '<br><hr>Промокод: <strong style="font-size:120%;">' .  $pomokod   . '</strong> ';
			?>

		</div>
		<form action="baget_accept.php?id=<?= $ident ?>&pomokod=<?= $pomokod ?>" method="post">
			<div class="baget-zakaz-right">
				Как к вам обращаться:<br><input type=text name="name" style="width:540px; height:30px; background:#fffaf4;" required>
				Ваш телефон:<br><input type=text name="phone" style="width:540px; height:30px; background:#fffaf4;" required>
				Электронная почта:<br><input type=text name="mail" style="width:540px; height:30px;">
				Самовывоз из: <br>
				<select id='delivery' name="delivery" style="width:540px; height:30px;">
					<option selected disabled></option>
					<option value="м. Арбатская">м. Арбатская</option>
					<option value="м. Новокузнецкая">м. Новокузнецкая</option>

				</select>
				Комментарий или дополнительные пожелания: <BR><textarea name="reviu" style="width:540px; height:285px;"></textarea>

			</div>

			<div class="baget-zakaz-buttons">
				<a href="/baget_online?id='.$ident.'" class="baget-zakaz-back" rel="nofollow">Вернуться к выбору багета</a>

				<input type="submit" value="Отправить заказ" class="baget-zakaz-send">
				<hr>
				<p>Нажимая на кнопку "Отправить заказ", я принимаю <a href="/terms.pdf">Пользовательское соглашение</a> и подтверждаю, что ознакомлен и согласен с <a href="/privacy.pdf">Политикой конфиденциальности</a> данного сайта</p>
			</div>

		</form>
		<?
		//-------------------------------------------------------------------------------------------------------------------------------
		echo '</div>';
		if ($_SERVER["REMOTE_ADDR"] == '127.0.0.1') {
			exit;
		}
		?>

		<!-- Yandex.Metrika counter -->
		<script type="text/javascript">
			(function(m, e, t, r, i, k, a) {
				m[i] = m[i] || function() {
					(m[i].a = m[i].a || []).push(arguments)
				};
				m[i].l = 1 * new Date();
				k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
			})
			(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

			ym(60934651, "init", {
				clickmap: true,
				trackLinks: true,
				accurateTrackBounce: true,
				webvisor: true
			});
		</script>
		<noscript>
			<div><img src="https://mc.yandex.ru/watch/60934651" style="position:absolute; left:-9999px;" alt="" /></div>
		</noscript>
		<!-- /Yandex.Metrika counter -->

</body>

</HTML>