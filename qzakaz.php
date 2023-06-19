<?
	$img=$_GET["img"];
	$size=$_GET["size"];
	$name=$_GET["name"];
	$kont=$_GET["kont"];
	$komm=$_GET["komm"];
	$ipaddr=$_SERVER["REMOTE_ADDR"];
	$n=rand(1000,9999);
	if ($size==0) {$zakaz.='маленький размер';}
	if ($size==1) {$zakaz.='средний размер';}
	if ($size==2) {$zakaz.='большой размер';}
	if ($_GET["ident"]) {$ident=$_GET["ident"]; $zakaz.='<br><a href="http://modulnye-kartiny.biz?id='.$ident.'">Ссылка на сайт модульных</a>';};
	if(isset($_GET["img"]) && isset($_GET["size"]) && isset($_GET["name"]) && isset($_GET["kont"])){
	mail("manager@bagetnaya-masterskaya.com",'Заказ №'.$n.' с Багетной мастерской',"IP: $ipaddr<br>Имя:<br><b>$name</b><br>Контакт:<br><b>$kont</b><br>Комментарий:<br><i>$komm</i><br>Заказ:$zakaz","From: Site <site@bagetnaya-masterskaya.com>\r\nReply-To: site@bagetnaya-masterskaya.com\r\nContent-type:text/html; charset=utf-8\r\n");
	echo $n;
}
	exit;
