<?php

$accessReferer = [
    'yandex',
    'ya',
    'google',
    'telegram',
    'youtube',
    'tiktok',
    'mail',
    'bing',
    '2gis',
    'rambler',
    'pinterest',
    'mail',
    'rutube',
    'tiktok',
    'instagram',
    'mamba',
    'twitter',
    'facebook',
    'yahoo',
    'reddit',
    'serpoff',
    'xing',
    'zoon',
    'spr',
    'baidu',
    'DuckDuckGo',

    'vk.com',
    't.me',
    'ok.ru',

    'flashfamily.bitrix24.ru',
    'recepty-kulinara.ru',
    'internet-start.net',
    'plaso.pro',
    'promopult.ru',

    'Яндекс',
    'Одноклассники',
    'ВКонтакте',
];

function blockBot(){
    global $accessReferer;

    if (isset($_SERVER['SERVER_NAME']) && str_contains(strtolower($_SERVER['SERVER_NAME']), 'virtual-baget-curent', )){
        return false;
    }

    if (isset($_SERVER['DOCUMENT_ROOT']) && str_contains(strtolower($_SERVER['DOCUMENT_ROOT']), 'virtual-baget-curent')){
        return false;
    }

    if (isset($_SERVER['SERVER_NAME']) && str_contains($_SERVER['SERVER_NAME'], 'bagetnaya-masterskaya', )){
        return true;
    }

    if (isset($_SERVER['DOCUMENT_ROOT']) && str_contains($_SERVER['DOCUMENT_ROOT'], 'bagetnaya-masterskaya')){
        return true;
    }

    // Для Яндекса
    if (isset($_GET['utm_source']) && $_GET['utm_source'] == 'yandex.direct') {
        return true;
    }

    // Для Google
    if (isset($_GET['gclid'])) {
        return true;
    }

    if (isset($_SERVER['HTTP_REFERER'])){
        foreach ($accessReferer as $item) {
            if (str_contains(strtolower($_SERVER['HTTP_REFERER']), strtolower($item))){
                return true;
            }
        }
    }

    return false;
}