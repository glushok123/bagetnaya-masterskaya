<?php
// Эндпоинты «Каталога работ» доступны только вошедшему администратору.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['user_logged_in'])) {
    http_response_code(403);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'status' => 'error',
        'message' => 'Нет доступа. Войдите в админку заново.',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// Сессия нужна только для проверки — отпускаем блокировку, чтобы запросы шли параллельно.
session_write_close();
