<?

if ($_GET['id']) {
	$ident = $_GET['id'];
	if (preg_match("/^[\dl]+$/", $ident)) {
		$z = explode('l', $ident);
	} else {
		$fp = fopen('lo/g.txt', 'a');
		$towrite = date("j.m.Y G:i") . ' ! ' . $_SERVER["REMOTE_ADDR"] . ' ! ' . $ident . ' ! accept bad id';
		fwrite($fp, $towrite);
		fwrite($fp, "\r\n");
		fclose($fp);
		exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
	}
} else {
	$fp = fopen('lo/g.txt', 'a');
	$towrite = date("j.m.Y G:i") . ' ! ' . $_SERVER["REMOTE_ADDR"] . ' ! ' . $ident . ' ! accept without id';
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
		echo '<link rel="canonical" href="http://bagetnaya-masterskaya.com/baget_accept"/>';
	} ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="/stylobgt.css">

	<?

	$f_zak_hist = fopen('base/zakazend-history.txt', 'a');
	$symbols = array(";", ":", "(", ")", "{", "}", "[", "]", "'", "\'", "\\", "\"", "<", ">", ",", "/");
	$name = str_replace($symbols, " ", $_POST['name']);
	$phone = str_replace($symbols, " ", $_POST['phone']);
	$mail = str_replace($symbols, " ", $_POST['mail']);
	$reviu = str_replace($symbols, " ", $_POST['reviu']);
	$bart = '';
	$pomokod = "не определен";

	if (isset($_GET["pomokod"])) {
		$pomokod = $_GET["pomokod"];
	}

	require_once 'base/connect.php';
	$stmt = $dbh->prepare("SELECT * FROM catalog_baget WHERE publicvendor=?");
	$stmt->bindParam(1, $z[0]);
	$stmt->execute();
	$data = $stmt->fetchAll();
	// var_dump($data);
	// var_dump($z[0]);
	$bart = $data[0]['vendor'];

	$nameFormat = "Горизонтально";

	if ($z[10] > $z[9]) {
		$nameFormat = "Вертикально";
	}

	if ($z[10] == $z[9]) {
		$nameFormat = "Квадрат";
	}

	$zakaz = '<br>Артикул багета (реальный): <b>' . $bart . '</b><br>Артикул багета (с сайта): <b>' . $z[0] . '</b><br>Ширина изображения: <b>' . $z[9] . '</b> мм.<br>Высота изображения: <b>' . $z[10] . '</b> мм.<br>' . 'Формат: <b>' . $nameFormat . '</b><br>';
	$zakazkl = '</b><br>Артикул багета: <b>' . $z[0] . '</b><br>Ширина изображения: <b>' . $z[9] . '</b> мм.<br>Высота изображения: <b>' . $z[10] . '</b> мм.<br>' . 'Формат: <b>' . $nameFormat . '</b><br>';

	if ($z[3] <> "0") {

		$stmt = $dbh->prepare("SELECT vendor FROM catalog_baget WHERE publicvendor=?");
		$stmt->bindParam(1, $z[3]);
		$stmt->execute();
		$data = $stmt->fetchAll();

		$zakaz2 = '
				<br>Артикул паспарту (реальный): <b>' . $data[0]['vendor'] . '</b>
				<br>Артикул паспарту (с сайта): <b>' . $z[3] . '</b>
				<br>Ширина паспарту: <b>' . $z[5] . '</b> мм.<br>';
		$zakazkl2 = '
				Артикул паспарту: <b>' . $z[3] . '</b>
				<br>Ширина паспарту: <b>' . $z[5] . '</b> мм.
				<br>';
	}
	if ($z[6] == 0) {
		$zakaz3 = '<br>Стекло: <strong>Нет</strong>';
	}
	if ($z[6] == 1) {
		$zakaz3 = '<br>Стекло: <strong>Обычное</strong>';
	}
	if ($z[6] == 2) {
		$zakaz3 = '<br>Стекло: <strong>Матовое</strong>';
	}
	if ($z[6] == 3) {
		$zakaz3 = '<br>Стекло: <strong>Антиблик</strong>';
	}
	if ($z[6] == 4) {
		$zakaz3 = '<br>Стекло: <strong>Пластиковое</strong>';
	}
	if ($z[7] == 0) {
		$zakaz3 = $zakaz3 . '<br>Задник: <strong>Нет</strong>';
	}
	if ($z[7] == 1) {
		$zakaz3 = $zakaz3 . '<br>Задник: <strong>Картон</strong>';
	}
	if ($z[7] == 2) {
		$zakaz3 = $zakaz3 . '<br>Задник: <strong>Пенокартон 5мм</strong>';
	}
	if ($z[7] == 3) {
		$zakaz3 = $zakaz3 . '<br>Задник: <strong>Пенокартон 10мм</strong>';
	}
	if ($z[7] == 4) {
		$zakaz3 = $zakaz3 . '<br>Задник: <strong>Подрамник</strong>';
	}

	$zakaz3 = $zakaz3 . '<br><hr>Цена: <strong style="font-size:120%;">' . $z[13] . '</strong> р.';
	if ($z[8] != 0) {
		$imghref = '<br><a href="http://bagetnaya-masterskaya.com/pics/' . $z[8] . '.jpg">Ссылка на картинку</a>';
	} else {
		$imghref = '';
	}
	$z[19] = $z[20] = $z[21] = $z[11] = $z[8] = "0";
	$zakaz .= $zakaz2 . $zakaz3 . '<br><a href="http://bagetnaya-masterskaya.com/baget_online?id=' . implode("l", $z) . '" rel="nofollow" >Ссылка</a>' . $imghref;
	$zakazkl .= $zakazkl2 . $zakaz3 . '<br><a href="http://bagetnaya-masterskaya.com/baget_online?id=' . implode("l", $z) . '" rel="nofollow" >Ссылка</a>';
	$ipaddr = $_SERVER["REMOTE_ADDR"];
	//manager@bagetnaya-masterskaya.com
	//glushok19999@gmail.com
	if (mail("manager@bagetnaya-masterskaya.com", 'Заказ №' . $z[15] . ' с Багетной мастерской', "IP: $ipaddr<br>Имя:<br><b>$name</b><br>Телефон:<br><b>$phone</b><br>Почта:<br><b>$mail</b><br>Адрес самовывоза:<br><b>" . $_POST['delivery'] . "</b><br>Комментарий:<br><i>$reviu</i><br>Заказ:$zakaz<br>Промокод:$pomokod", "From: Site <site@bagetnaya-masterskaya.com>\r\nReply-To: site@bagetnaya-masterskaya.com\r\nContent-type:text/html; charset = UTF-8\r\n")) {
		mail($mail, $name . ' вы оформили заказ на сайте Багетной мастерской', "Номер заказа: <b>$z[15]</b><br>$zakazkl", "From: Багетная мастерская №1 <manager@bagetnaya-masterskaya.com>\r\nReply-To: manager@bagetnaya-masterskaya.com\r\nContent-type:text/html; charset = UTF-8\r\n");
		echo '<title>Ваш заказ принят</title>
				</HEAD>
				<BODY>
				<div class="baget-zakaz-main">
					<div class="baget-zakaz-accept">
						Ваш заказ принят!<br>В ближайшее время наш менеджер свяжется с вами.
					</div>
					<a rel="nofollow" href="/baget_online?id=' . $ident . '" class="baget-zakaz-accept-button1">Вернуться к выбору багета</a>
					<a rel="nofollow" href="/" class="baget-zakaz-accept-button2">Перейти на главную страницу</a>
				</div>';
		$towrite = date("j.m.Y G:i") . '-!-' . $_SERVER["REMOTE_ADDR"] . '-!-' . $ident . '-!-' . $name . '-!-' . $phone . '-!-' . $mail . '-!-' . 'OK' . "\r\n";
		fwrite($f_zak_hist, $towrite);
		fclose($f_zak_hist);
	} else {
		echo '<title>Ошибка при отправке заказа</title>
				</HEAD>
				<BODY>
				<div class="baget-zakaz-main">
					<div class="baget-zakaz-error">
						При отправке заказа произошла ошибка!<br>Свяжитесь, пожалуйста, с нами по телефонам:<br> 8 (495) 504-73-04 или 8 (495) 951-77-51
					</div>
					<a rel="nofollow" href="/baget_online?id=' . $ident . '" class="baget-zakaz-accept-button1">Вернуться к выбору багета</a>
					<a rel="nofollow" href="/" class="baget-zakaz-accept-button2">Перейти на главную страницу</a>
				</div>';
		$towrite = date("F j, Y, g:i a") . '-!-' . $_SERVER["REMOTE_ADDR"] . '-!-' . $ident . '-!-' . $name . '-!-' . $phone . '-!-' . $mail . '-!-' . 'ERR' . "\r\n";
		fwrite($f_zak_hist, $towrite);
		fclose($f_zak_hist);
	}


	if (($_SERVER["REMOTE_ADDR"] == '127.0.0.1')) {
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