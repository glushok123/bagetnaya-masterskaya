<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// $data = json_decode($_POST); 
$data = $_POST;
// var_dump($data);
require_once 'connect.php';
try {
    $stmt = $dbh->prepare("DELETE FROM catalog_baget WHERE id = ?");

    $stmt->bindParam(1, $data['rmid']);

    $stmt->execute();

    echo $data['rmid'];
} catch (PDOExecption $e) {
    $dbh->rollback();
    print "Error!: " . $e->getMessage() . "</br>";
}
