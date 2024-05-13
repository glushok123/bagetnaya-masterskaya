<?
require_once '../../base/connect.php';

$idItem = '';

if (isset($_POST["idItem"])) {
    $idItem = $_POST["idItem"];
}

$stm = $dbh->prepare("SELECT * FROM catalog_baget where id = '" . $idItem . "'");
$stm->execute();
$data = $stm->fetch();

$src = $data['type'] == 'pasp' ? 'pi' : 'bi';

if (file_exists('../../' . $src . '/' . $data['listimg']) == true) {
    unlink('../../' . $src . '/' . $data['listimg']);
}

if (file_exists('../../' . $src . '/' . $data['imgconst']) == true) {
    unlink('../../' . $src . '/' . $data['imgconst']);
}

$count = $dbh->exec("DELETE FROM catalog_baget where id = '" . $idItem . "'");

echo $count;
