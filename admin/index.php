<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';

if (!isset($_SESSION['user_logged_in'])) {
    header('Location:authentication-login.php');
}

?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админка</title>
    <script script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
    <script src="https://cdn.datatables.net/plug-ins/1.13.1/i18n/ru.json"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>

<body>

<? require_once 'view/ul_tab.php'; // ШАПКА
?>
<? require_once 'view/filter.php'; // ФИЛЬТЕР ДЛЯ ЭЛЕМЕНТОВ КОНСТРУКТОРА
?>
<? require_once 'view/div_tab.php'; // Тело табов (контент)
?>
<? require_once 'view/madal_add_catalog.php'; // Модальное окно добавления в каталог
?>
<? require_once 'view/madal_add_promokod.php'; // Модальное окно изменения промокода
?>
<? require_once 'view/madal_add_painting.php'; // Модальное окно добавления картины
?>
<? require_once 'view/madal_add_gallery_works.php'; // Модальное окно добавления галлерее работ
?>

</body>

<link rel="stylesheet" href="assets/css/app.css">
<script src="assets/js/app.js?v2"></script>

</html>