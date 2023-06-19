<?
require_once '../../base/connect.php';

$idItem = '';

$stm = $dbh->prepare("SELECT * FROM catalog_baget where price = 0");
$stm->execute();
$data = $stm->fetchAll();

foreach ($data as $item) {
    $src = $item['type'] == 'pasp' ? 'pi' : 'bi';

    if (file_exists('../../' . $src . '/' . $item['listimg']) == true) {
        unlink('../../' . $src . '/' . $item['listimg']);
    }

    if (file_exists('../../' . $src . '/' . $item['imgconst']) == true) {
        unlink('../../' . $src . '/' . $item['imgconst']);
    }

    $dbh->exec("DELETE FROM catalog_baget where id = '" . $item['id'] . "'");
}
var_dump($data);


    //echo $count;