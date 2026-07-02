<?php
require_once __DIR__ . '/../config/neoartConfig.php';

class NeoartFeed
{
    /** Скачивает (или берёт из кеша) фид, возвращает ELEMENTS. */
    public static function fetch(string $catalog): array
    {
        $cfg = neoart_config();
        $cat = $cfg['catalogs'][$catalog] ?? null;
        if (!$cat) throw new InvalidArgumentException("Неизвестный каталог: $catalog");

        $cacheFile = neoart_cache_dir() . "/catalog_{$cat['id']}.json";
        $json = null;
        if (is_file($cacheFile)) {
            $json = json_decode((string)file_get_contents($cacheFile), true);
        }
        if (!$json) {
            $url = "{$cfg['api_base']}?{$cfg['api_auth']}&action=json&catalog={$cat['id']}";
            $body = self::httpGet($url, 240);
            if ($body === false) throw new RuntimeException('Не удалось скачать фид Neoart');
            file_put_contents($cacheFile, $body);
            $json = json_decode($body, true);
        }
        return $json[$cat['id']]['ELEMENTS'] ?? [];
    }

    public static function sections(string $catalog): array
    {
        $cfg = neoart_config();
        $cat = $cfg['catalogs'][$catalog];
        $cacheFile = neoart_cache_dir() . "/catalog_{$cat['id']}.json";
        $json = is_file($cacheFile) ? json_decode((string)file_get_contents($cacheFile), true) : [];
        $out = [];
        foreach (($json[$cat['id']]['SECTIONS'] ?? []) as $sid => $s) {
            $out[$sid] = $s['NAME'] ?? '';
        }
        return $out;
    }

    /** Нормализует один элемент фида в запись. */
    public static function record(array $e, array $sections, array $catCfg): ?array
    {
        $vendor = trim((string)($e['ARTICLE'] ?? ''));
        if ($vendor === '') return null;
        $pv = $e['PROPS_VALUES'] ?? [];

        if (($catCfg['priceField'] ?? 'auto') === 'base') {
            $raw = (float)($e['PRICES']['BASE'] ?? 0);
        } else {
            $raw = isset($e['PRICES']['CHOP']) ? (float)$e['PRICES']['CHOP'] : (float)($e['PRICES']['BASE'] ?? 0);
        }
        $sid = (string)($e['IBLOCK_SECTION_ID'] ?? '');
        return [
            'vendor'          => $vendor,
            'name'            => trim((string)($e['NAME'] ?? '')),
            'section_id'      => $sid,
            'section_name'    => $sections[$sid] ?? '',
            'width_mm'        => isset($pv['WIDTH'])       ? (int)round((float)$pv['WIDTH'] * 10)       : 0,
            'widthwithout_mm' => isset($pv['WIDTH_MINUS']) ? (int)round((float)$pv['WIDTH_MINUS'] * 10) : 0,
            'height_mm'       => isset($pv['HEIGHT'])      ? (int)round((float)$pv['HEIGHT'] * 10)      : 0,
            'price_base'      => (float)($e['PRICES']['BASE'] ?? 0),
            'price_chop'      => isset($e['PRICES']['CHOP']) ? (float)$e['PRICES']['CHOP'] : null,
            'price_final'     => (int)round($raw * $catCfg['multiplier']),
            'storage'         => isset($e['QUANTITY']['COUNT_SE']) ? (int)round((float)$e['QUANTITY']['COUNT_SE']) : 0,
        ];
    }

    public static function httpGet(string $url, int $timeout = 60, int $attempts = 3)
    {
        for ($i = 1; $i <= $attempts; $i++) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CONNECTTIMEOUT => 30,
                CURLOPT_TIMEOUT        => $timeout,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_USERAGENT      => 'Mozilla/5.0 (compatible; NeoartImport/1.0)',
            ]);
            $body = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($body !== false && $code >= 200 && $code < 400) return $body;
            if ($code === 404) return false;
            if ($i < $attempts) sleep(2);
        }
        return false;
    }
}
