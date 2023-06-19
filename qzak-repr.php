<?
	$id=$_GET["id"];
	$name=$_GET["name"];
	$kont=$_GET["kont"];
	$komm=$_GET["komm"];
	$ipaddr=$_SERVER["REMOTE_ADDR"];
	$n=rand(1000,9999);
	$zakaz="<a href='http://bagetnaya-masterskaya.com/pechat_na_holste/katalog_reprodukciy/reprodukciya?id=".$id."'>ссылка</a><br>";
		if(isset($_GET["name"]) && isset($_GET["kont"])){
	mail("manager@bagetnaya-masterskaya.com",'Заказ репродукции №'.$n.' с Багетной мастерской',"IP: $ipaddr<br>Имя:<br><b>$name</b><br>Контакт:<br><b>$kont</b><br>Комментарий:<br><i>$komm</i><br>Заказ:$zakaz","From: Site <site@bagetnaya-masterskaya.com>\r\nReply-To: site@bagetnaya-masterskaya.com\r\nContent-type:text/html; charset=utf-8\r\n");
	echo $n;
}
	exit;
