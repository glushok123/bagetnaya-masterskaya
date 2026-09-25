<?php
/*
    Общий вход для JSON-эндпоинтов админки:
    проверка входа, подключение к БД, помощники для ответа.
*/

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

if (!isset($_SESSION['user_logged_in'])) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Нет доступа. Войдите в админку заново.'], JSON_UNESCAPED_UNICODE);
    exit;
}

session_write_close();

require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';

// connect.php включает вывод ошибок — в JSON они не нужны
ini_set('display_errors', '0');

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

set_exception_handler(function (Throwable $exception) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Ошибка сервера: ' . $exception->getMessage()], JSON_UNESCAPED_UNICODE);
    exit;
});

function json_ok(array $payload = []): void
{
    echo json_encode(['status' => 'success'] + $payload, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
    exit;
}

function json_fail(string $message): void
{
    echo json_encode(['status' => 'error', 'message' => $message], JSON_UNESCAPED_UNICODE);
    exit;
}

function post_str(string $key, string $default = ''): string
{
    return isset($_POST[$key]) ? trim((string)$_POST[$key]) : $default;
}

function post_int(string $key, int $default = 0): int
{
    return isset($_POST[$key]) && $_POST[$key] !== '' ? (int)$_POST[$key] : $default;
}

/**
 * Массив целых id: строка «1,2,3» или ids[].
 * Строкой — чтобы тысяча id не упёрлась в max_input_vars.
 */
function post_ids(string $key = 'ids'): array
{
    $raw = $_POST[$key] ?? [];
    $ids = is_array($raw) ? $raw : explode(',', (string)$raw);

    return array_values(array_unique(array_filter(array_map('intval', $ids), fn($id) => $id > 0)));
}

function placeholders(array $values): string
{
    return implode(',', array_fill(0, count($values), '?'));
}

/**
 * Сохраняет загруженный файл-картинку (JPG/PNG) в папку сайта.
 * Возвращает имя файла или null, если файла нет. Ошибку — через json_fail.
 */
function save_uploaded_image(string $field, string $urlDir, array $allowedTypes = [IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png'], ?array $file = null): ?string
{
    $file = $file ?? ($_FILES[$field] ?? null);

    if (!$file || empty($file['tmp_name'])) {
        return null;
    }

    if (!empty($file['error']) || !is_uploaded_file($file['tmp_name'])) {
        $tooBig = in_array((int)$file['error'], [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE], true);
        json_fail($tooBig ? 'Файл слишком большой.' : 'Файл не получен.');
    }

    $info = @getimagesize($file['tmp_name']);

    if (empty($info) || !isset($allowedTypes[$info[2]])) {
        json_fail('Нужна картинка ' . strtoupper(implode(' или ', array_unique($allowedTypes))) . '.');
    }

    $dir = $_SERVER['DOCUMENT_ROOT'] . $urlDir;

    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $name = time() . '-' . random_int(1, 9_999_999_999) . '.' . $allowedTypes[$info[2]];

    if (!move_uploaded_file($file['tmp_name'], $dir . $name)) {
        json_fail('Не удалось сохранить файл.');
    }

    return $name;
}

function remove_site_file(string $urlDir, ?string $name): void
{
    if (!$name || strpos($name, '..') !== false) {
        return;
    }

    $path = $_SERVER['DOCUMENT_ROOT'] . $urlDir . $name;

    if (is_file($path)) {
        @unlink($path);
    }
}
