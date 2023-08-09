<?
session_start();

$master = false;
$minimaster = false;

/*if (
    $_SERVER["REMOTE_ADDR"] == '5.39.162.100' ||
    $_SERVER["REMOTE_ADDR"] == '31.173.10.9' ||
    $_SERVER["REMOTE_ADDR"] == '91.79.60.32' ||
    $_SERVER["REMOTE_ADDR"] == '176.108.160.115' ||
    $_SERVER["REMOTE_ADDR"] == '93.80.171.13' ||
    $_SERVER["REMOTE_ADDR"] == '195.91.191.75' ||
    $_SERVER["REMOTE_ADDR"] == '95.25.90.151'
) {
    $minimaster = true;
    $master = true;
}*/

if (!empty($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']) {
    $minimaster = true;
    $master = true;
}