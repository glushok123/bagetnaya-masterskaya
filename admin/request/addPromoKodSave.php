<?php
require_once '../../base/connect.php';

try {
    $stmt = $dbh->prepare("INSERT INTO promo_kods(series_id, sale_procent, sale_count, active) values (?,?,?,?)");

    $stmt->bindParam(1, $_POST['series_id']);
    $stmt->bindParam(2, $_POST['sale_procent']);
    $stmt->bindParam(3, $_POST['sale_count']);
    $stmt->bindParam(4, $_POST['active']);

    $stmt->execute();

    echo "success";
} catch (PDOExecption $e) {
    $dbh->rollback();
    print "Error!: " . $e->getMessage() . "</br>";
}
