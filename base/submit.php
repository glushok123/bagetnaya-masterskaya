<?php
// Автор: Тимур Камаев, http://wp-kama.ru/

if (isset($_POST['my_file_upload'])) {
    // ВАЖНО! тут должны быть все проверки безопасности передавемых файлов и вывести ошибки если нужно

    $uploaddir = './uploads'; // . - текущая папка где находится submit.php

    // cоздадим папку если её нет
    if (!is_dir($uploaddir)) mkdir($uploaddir, 0777);

    $files      = $_FILES; // полученные файлы
    $done_files = [];

    // переместим файлы из временной директории в указанную
    foreach ($files as $file) {
        $file_name = cyrillic_translit($file['name']);

        if (move_uploaded_file($file['tmp_name'], "$uploaddir/$file_name")) {
            $done_files[] = 'base/uploads/' . $file_name;//realpath("$uploaddir/$file_name");
        }
    }
   

    $catalogfile = $done_files[0];//explode("/", $done_files[0]);
    
    //$path = array_slice($catalogfile, 6);
    //echo(json_encode($catalogfile));
    //$catalogfile = implode("/", $path);
    $calcfile = $done_files[1];//explode("/", $done_files[1]);
    //$path = array_slice($calcfile, 6);
    //$calcfile = implode("/", $path);
    $path = ['catalogfile' =>  $catalogfile, 'calcfile' => $calcfile];
    // $data = $done_files ? $done_files : array('error' => 'Ошибка загрузки файлов.');
    // setcookie("catalogfile", $catalogfile);
    // exit( json_encode( $data ) );

    $data = $done_files ? ['files' => $done_files] : ['error' => 'Ошибка загрузки файлов.'];
    echo (json_encode($path, JSON_THROW_ON_ERROR));
    exit();
}


## Транслитирация кирилических символов
function cyrillic_translit($title)
{
    $iso9_table = ['А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G', 'Ґ' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE', 'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'J', 'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K', 'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ў' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS', 'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g', 'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye', 'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'j', 'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k', 'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ў' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts', 'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'];

    $name = strtr($title, $iso9_table);
    $name = preg_replace('~[^A-Za-z0-9\'_\-\.]~', '-', $name);
    $name = preg_replace('~\-+~', '-', $name); // --- на -
    $name = preg_replace('~^-+|-+$~', '', $name); // кил - на концах

    return $name;
}
