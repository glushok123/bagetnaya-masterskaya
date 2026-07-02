<?php
/**
 * Конфиг Neoart Import Studio: каталоги, пути staging, хелперы имён/путей.
 */

function neoart_config(): array
{
    return [
        'api_base' => 'https://www.neoart.ru/api.php',
        'api_auth' => 'login=Copymaster&pass=Bagetnaya20130713!!',
        'catalogs' => [
            'wood'  => ['id' => 91, 'multiplier' => 3.5, 'priceField' => 'auto'],
            'plast' => ['id' => 92, 'multiplier' => 5,   'priceField' => 'base'],
            'alum'  => ['id' => 93, 'multiplier' => 6,   'priceField' => 'auto'],
        ],
    ];
}

function neoart_root_fs(): string
{
    return $_SERVER['DOCUMENT_ROOT'] . '/neoart_import';
}

function neoart_cache_dir(): string
{
    $d = neoart_root_fs() . '/_cache';
    if (!is_dir($d)) @mkdir($d, 0775, true);
    return $d;
}

/** Абсолютные ФС-пути + web-URL-префиксы для картинок каталога. */
function neoart_paths(string $catalog): array
{
    $root = neoart_root_fs();
    $p = [];
    foreach (['raw', 'listimg', 'imgconst'] as $k) {
        $dir = "$root/$k/$catalog";
        if (!is_dir($dir)) @mkdir($dir, 0775, true);
        $p[$k] = $dir;
        $p[$k . '_url'] = "/neoart_import/$k/$catalog";
    }
    return $p;
}

/** Безопасное имя файла из артикула (как в experiment/neoart-parser/parse.php). */
function neoart_safe_name(string $s): string
{
    $s = str_replace(['\\', '/'], '-', $s);
    return preg_replace('~[^A-Za-z0-9._-]~', '_', $s);
}
