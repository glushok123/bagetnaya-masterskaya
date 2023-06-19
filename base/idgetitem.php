<?

$id = $_POST['id'];
require_once 'connect.php';
$stmt = $dbh->prepare("SELECT type,width,widthwithout,price,listimg,imgconst FROM catalog_baget WHERE publicvendor=?");
$stmt->bindParam(1, $id);
$stmt->execute();
$data = $stmt->fetchAll();


echo json_encode($data);
