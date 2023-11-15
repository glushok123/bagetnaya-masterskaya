<?
    require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';

	$kod = strtoupper(base_convert(random_int(4369,65535), 10, 16));
	$NewDate = Date('Y-m-d H:i:s', strtotime('+2 days'));
	$stmt = $dbh->prepare("INSERT INTO promo_kods(series_id, sale_procent, active, date_end) values ('" . $kod . "', '10', '1', '" . $NewDate . "')");

	$stmt->execute();
	if (mail("manager@bagetnaya-masterskaya.com",'Скидка '.$kod,"Скидка $kod","From: Site <site@bagetnaya-masterskaya.com>\r\nReply-To: site@bagetnaya-masterskaya.com\r\nContent-type:text/html; charset = UTF-8\r\n")) {
		echo $kod;
	}
