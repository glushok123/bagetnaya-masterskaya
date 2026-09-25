<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/config.php';

header('Content-Type: application/json; charset=utf-8');

function client_ip()
{
    $ipaddress = '';

    if (isset($_SERVER['HTTP_CF_CONNECTING_IP']))
        $ipaddress = $_SERVER['HTTP_CF_CONNECTING_IP'];
    else if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$login = trim((string)($_POST['login'] ?? ''));
$passwd = (string)($_POST['passwd'] ?? '');

$db = getDbInstance();
$user = null;

if ($login !== '' && $passwd !== '') {
    // Только подготовленные запросы: логин и пароль не попадают в текст SQL
    $db->where('(login = ? OR email = ?)', [$login, $login]);
    $user = $db->getOne('user_accaunt');
}

$stored = $user ? (string)$user['passwd'] : '';
$valid = $user && (
    (str_starts_with($stored, '$2y$') && password_verify($passwd, $stored))
    || hash_equals($stored, $passwd)
);

if (!$valid) {
    usleep(600000); // притормаживаем подбор пароля
    echo json_encode(['status' => 'error', 'mes' => 'Неверный логин или пароль'], JSON_UNESCAPED_UNICODE);
    exit;
}

session_regenerate_id(true);

$_SESSION['user_logged_in'] = TRUE;
$_SESSION['login'] = $user['login'];
$_SESSION['email'] = $user['email'];
$_SESSION['type_user'] = $user['type_user'];
$_SESSION['id_user'] = $user['id'];
$_SESSION['type'] = $user['type'];
$_SESSION['IP'] = client_ip();

$agent = (string)($_SERVER['HTTP_USER_AGENT'] ?? '');
preg_match("/(MSIE|Opera|Firefox|Chrome|Version)(?:\/| )([0-9.]+)/", $agent, $bInfo);
$browserName = isset($bInfo[1]) ? ($bInfo[1] == "Version" ? "Safari" : $bInfo[1]) : 'unknown';
$browserVersion = $bInfo[2] ?? '';

$series_id = randomString(16);
$remember_token = getSecureRandomToken();
$encryted_remember_token = password_hash((string)$remember_token, PASSWORD_DEFAULT);
$expiry_time = date('Y-m-d H:i:s', strtotime(' + 60 days'));
$expires = strtotime($expiry_time);

// insert() из MysqliDb падает на PHP 8 — пишем подготовленным запросом
$db->rawQuery(
    'INSERT INTO user_accaunt_session (id_user, date_in, device, ip, series_id, remember_token, expires) VALUES (?, ?, ?, ?, ?, ?, ?)',
    [
        $user['id'],
        date('Y-m-d H:i:s'),
        mb_substr($browserName . '/' . $browserVersion . '/' . gethostbyaddr($_SERVER['REMOTE_ADDR']), 0, 250),
        client_ip(),
        $series_id,
        $encryted_remember_token,
        $expiry_time,
    ]
);

setcookie('series_id', (string)$series_id, ['expires' => $expires, 'path' => "/", 'httponly' => true, 'samesite' => 'Lax']);
setcookie('remember_token', (string)$remember_token, ['expires' => $expires, 'path' => "/", 'httponly' => true, 'samesite' => 'Lax']);

$db->where('id', $user['id']);
$db->update("user_accaunt", ['series_id' => $series_id, 'remember_token' => $encryted_remember_token, 'expires' => $expiry_time]);

echo json_encode(['status' => 'success'], JSON_UNESCAPED_UNICODE);
