<?
require_once '../../../base/connect.php';

$stm = $dbh->prepare("
        UPDATE gallery_work_images 
        SET
        description = '" . $_POST['description'] . "'
        where id = " . $_POST['id']);
$stm->execute();

echo ($stm->execute());
    //echo(json_encode($_POST['description']));
    //echo 'success';