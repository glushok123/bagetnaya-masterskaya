<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once '../../base/connect.php';

$id = isset($_POST['painting_id']) ? (int)$_POST['painting_id'] : 0;
$name = isset($_POST['painting_name']) ? trim($_POST['painting_name']) : '';
$avtor = isset($_POST['painting_avtor']) ? trim($_POST['painting_avtor']) : '';
$size = isset($_POST['painting_size']) ? trim($_POST['painting_size']) : '';
$price = isset($_POST['painting_price']) ? trim($_POST['painting_price']) : '';
$active = isset($_POST['painting_active']) ? (int)$_POST['painting_active'] : 0;

if ($id <= 0 || $name === '' || $avtor === '' || $size === '' || $price === '') {
    http_response_code(400);
    echo 'error';
    exit;
}

$active = $active === 1 ? 1 : 0;

try {
    $stmt = $dbh->prepare('UPDATE paintings SET name = ?, avtor = ?, sizes = ?, price_one = ?, active = ? WHERE id = ?');
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $avtor);
    $stmt->bindParam(3, $size);
    $stmt->bindParam(4, $price);
    $stmt->bindParam(5, $active, PDO::PARAM_INT);
    $stmt->bindParam(6, $id, PDO::PARAM_INT);

    $stmt->execute();

    echo 'success';
} catch (PDOException $e) {
    http_response_code(500);
    echo 'error';
}
