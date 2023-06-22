<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$info = $_POST;

require_once 'connect.php';
$lastid = $dbh->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'catalog_baget'");
$lastid->execute();
$lastid = $lastid->fetchAll();

$type = $info["type"];
$publicvendor = intval($lastid[0]['AUTO_INCREMENT'])+6000;
$vendor = $info["vendor"];
$width = $info["width"];
$widthwithout = $info['widthwithout'];
if ($type == 'wood' || $type == 'alum') {
	$price = $info["price"] * 3.5;
}elseif ($type == 'plast') {
	$price = $info["price"] * 5;
}

$storage = 30;

$listimg = explode('/', (string) $info["listimg"]);
$listimg = end($listimg);
$resultlistimg = $publicvendor.$listimg;

$imgconst = explode('/', (string) $info["imgconst"]);
$imgconst = end($imgconst);
$resultimgconst = $publicvendor."t".$imgconst;

 try {
$stmt = $dbh->prepare("INSERT INTO catalog_baget(type,publicvendor,vendor,width,widthwithout,price,storage,listimg,imgconst) values (?,?,?,?,?,?,?,?,?)");

$stmt->bindParam(1, $type);
$stmt->bindParam(2, $publicvendor);
$stmt->bindParam(3, $vendor);
$stmt->bindParam(4, $width);
$stmt->bindParam(5, $widthwithout);
$stmt->bindParam(6, $price);
$stmt->bindParam(7, $storage);
$stmt->bindParam(8, $resultlistimg);
$stmt->bindParam(9, $resultimgconst);

$stmt->execute();
echo "added";
// rename('/'.$info["listimg"],'/bi/'.$publicvendor.$listimg);

$oldlistimg = "uploads/".$listimg;
$newlistimg = "../bi/".$resultlistimg;
rename($oldlistimg, $newlistimg);
var_dump($oldlistimg);
var_dump($newlistimg);

$oldimgconst = "uploads/".$imgconst;
$newimgconst = "../bi/".$resultimgconst;
rename($oldimgconst, $newimgconst);

// dirDel('uploads');

setcookie("bagettype", "", ['expires' => time()-3600]);
setcookie("vendor", "", ['expires' => time()-3600]);
setcookie("price", "", ['expires' => time()-3600]);
setcookie("widthwithout", "", ['expires' => time()-3600]);
setcookie("width", "", ['expires' => time()-3600]);
setcookie("imgconst", "", ['expires' => time()-3600]);
setcookie("listimg", "", ['expires' => time()-3600]);

}catch(PDOExecption $e) {
        $dbh->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }
