<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/config.php';
    session_start();

    clearAuthCookie();
    session_destroy();
    clearAuthCookie();

    header('Location: /admin/index.php');
    exit;
