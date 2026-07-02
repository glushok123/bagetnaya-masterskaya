# Neoart Import Studio — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Админ-инструмент, который скачивает каталог багета Neoart (фид + фото), нарезает каждое фото угла рамы на две картинки (listimg для каталога, imgconst для конструктора) средствами PHP+GD, даёт менеджеру проверить/поправить их и одобренные товары переносит в `catalog_baget`.

**Architecture:** Отдельная staging-зона (3 таблицы `neoart_*` + папки `/neoart_import/`), изолированная от живого каталога до явного «одобрения». Скачивание и нарезка идут чанками по AJAX-поллингу из браузера (устойчиво к `max_execution_time`). Всё на чистом PHP+GD — без Python/pip/exec. Ручная правка — клиентский Cropper.js, финальный кроп режет GD из оригинала.

**Tech Stack:** PHP 8.x + PDO (MySQL `a0458868_bagetnaya`), GD 2.3.3, cURL. Фронт: jQuery 3.5, Bootstrap 5.1, DataTables 1.13, toastr 2.0 (уже подключены в `admin/index.php`), Cropper.js 1.6 (добавляется через CDN). Спека: `docs/superpowers/specs/2026-07-02-neoart-import-studio-design.md`.

## Global Constraints

Каждая задача неявно обязана соблюдать это:

- **Кодировка/переносы:** файлы UTF-8 + CRLF (git `core.autocrlf=true` сам разрулит; вручную не переконвертировать). Русский текст — UTF-8, не Windows-1251.
- **Короткие теги:** легаси-вьюхи (`admin/view/*.php`, `admin/index.php`) используют `<? ?>`. В НОВЫХ php-файлах писать `<?php` (это норма проекта для новых), но при вставке в существующие вьюхи (`ul_tab.php`, `div_tab.php`) сохранять их стиль `<?`.
- **Подключение БД:** каждый эндпоинт начинается с `require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';` — после этого доступен `$dbh` (PDO, `ERRMODE_EXCEPTION`, авто-локал/прод). Пароли прода НЕ хардкодить — connect.php сам их подставляет.
- **Ответы эндпоинтов:** JSON, `header('Content-Type: application/json; charset=utf-8')`, `echo json_encode($x, JSON_UNESCAPED_UNICODE)`. Ошибки — `http_response_code(4xx/5xx)` + `{"error": "..."}`.
- **Каталоги охвата:** только `wood`, `plast`, `alum`. Значение `catalog` напрямую = `type` в `catalog_baget`.
- **Neoart API:** base `https://www.neoart.ru/api.php`, auth `login=Copymaster&pass=Bagetnaya20130713!!`. JSON: `&action=json&catalog=<id>`; картинка: `&action=image&catalog=<id>&art=<арт>`. ID каталогов: wood=91, plast=92, alum=93. Множители/цены: wood ×3.5 (chop иначе base), plast ×5 (base), alum ×6 (chop иначе base). Разделитель артикула в фиде — `\` , в API картинок — `/`.
- **Имена файлов:** `safe_name($vendor)` = замена `\` и `/` на `-`, прочего небезопасного (`[^A-Za-z0-9._-]`) на `_` (как в `experiment/neoart-parser/parse.php`).
- **Тестирование:** в проекте НЕТ юнит-фреймворка (см. CLAUDE.md). Верификация каждой задачи — конкретный запускаемый чек: CLI-скрипт с ожидаемым выводом, действие в браузере админки, или SQL-запрос с ожидаемым результатом. Коммитить только после зелёного чека.
- **Работа в ветке `dev`.** Частые коммиты (по задаче минимум один).
- **Staging-пути:** корень `/neoart_import/`; `raw/<catalog>/`, `listimg/<catalog>/`, `imgconst/<catalog>/`, `_cache/`. Web-доступны для превью.

---

## File Structure

**Создаётся:**
- `sql/neoart_import.sql` — DDL 3 таблиц (запускается вручную на хостинге).
- `admin/config/neoartConfig.php` — конфиг каталогов (id/множитель/priceField) + пути staging + `neoart_safe_name()` + `neoart_paths()`.
- `admin/helpers/NeoartFeed.php` — класс: скачать/распарсить фид, посчитать цену, собрать запись.
- `admin/helpers/NeoartCutter.php` — класс: PHP+GD нарезка (auto) + ручной кроп listimg/imgconst.
- `admin/request/neoart/run_start.php` — старт запуска: фид → run + upsert neoart_item.
- `admin/request/neoart/run_download_chunk.php` — чанк скачивания raw.
- `admin/request/neoart/cut_chunk.php` — чанк нарезки.
- `admin/request/neoart/items_list.php` — грид ревью.
- `admin/request/neoart/item_get.php` — карточка.
- `admin/request/neoart/item_save_crop.php` — GD-кроп по координатам.
- `admin/request/neoart/item_upload.php` — ручная загрузка файла.
- `admin/request/neoart/item_reset.php` — переуборка одной позиции.
- `admin/request/neoart/item_approve.php` — публикация в catalog_baget.
- `admin/request/neoart/item_reject.php` — отклонить/удалить.
- `admin/request/neoart/cut_cli.php` — CLI-раннер нарезки + монтаж (верификация Task 5).
- `admin/view/neoart_import.php` — тело вкладки.
- `admin/assets/js/neoart_import.js` — весь JS вкладки.

**Модифицируется:**
- `admin/view/ul_tab.php` — новая вкладка-`<li>`.
- `admin/view/div_tab.php` — новый `tab-pane` + include вьюхи.
- `admin/index.php` — CDN Cropper.js + подключение `neoart_import.js`.
- `.gitignore` — игнор медиа `/neoart_import/`.

---

## Task 1: Фундамент — SQL, конфиг, папки, gitignore

**Files:**
- Create: `sql/neoart_import.sql`
- Create: `admin/config/neoartConfig.php`
- Create: `neoart_import/.gitkeep` (+ подпапки)
- Modify: `.gitignore`

**Interfaces:**
- Produces: таблицы `neoart_import_run`, `neoart_item`, `neoart_import_log`; функции `neoart_config()`, `neoart_safe_name(string): string`, `neoart_paths(string $catalog): array` (ключи `raw`,`listimg`,`imgconst` — абсолютные ФС-пути; `raw_url`,`listimg_url`,`imgconst_url` — web-префиксы), `neoart_cache_dir(): string`.

- [ ] **Step 1: DDL-файл**

Create `sql/neoart_import.sql`:

```sql
-- Neoart Import Studio: staging tables. Запускать вручную на хостинге (миграций нет).
CREATE TABLE IF NOT EXISTS `neoart_import_run` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `catalog` VARCHAR(8) NOT NULL,
  `status` ENUM('running','done','error','canceled') NOT NULL DEFAULT 'running',
  `total` INT NOT NULL DEFAULT 0,
  `downloaded` INT NOT NULL DEFAULT 0,
  `failed` INT NOT NULL DEFAULT 0,
  `skipped` INT NOT NULL DEFAULT 0,
  `started_at` DATETIME NULL,
  `finished_at` DATETIME NULL,
  `error` TEXT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `neoart_item` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `run_id` INT NULL,
  `catalog` VARCHAR(8) NOT NULL,
  `vendor` VARCHAR(64) NOT NULL,
  `name` VARCHAR(255) NULL,
  `section_id` VARCHAR(32) NULL,
  `section_name` VARCHAR(255) NULL,
  `width_mm` INT NOT NULL DEFAULT 0,
  `widthwithout_mm` INT NOT NULL DEFAULT 0,
  `height_mm` INT NOT NULL DEFAULT 0,
  `price_base` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `price_chop` DECIMAL(10,2) NULL,
  `price_final` INT NOT NULL DEFAULT 0,
  `storage` INT NOT NULL DEFAULT 0,
  `raw_img` VARCHAR(255) NULL,
  `listimg` VARCHAR(255) NULL,
  `imgconst` VARCHAR(255) NULL,
  `cut_status` ENUM('none','auto_ok','auto_flagged','manual','error') NOT NULL DEFAULT 'none',
  `cut_flags` VARCHAR(128) NULL,
  `in_catalog` TINYINT(1) NOT NULL DEFAULT 0,
  `catalog_publicvendor` VARCHAR(32) NULL,
  `review_status` ENUM('pending','approved','rejected','published') NOT NULL DEFAULT 'pending',
  `approved_at` DATETIME NULL,
  `download_error` VARCHAR(255) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  UNIQUE KEY `uniq_cat_vendor` (`catalog`,`vendor`),
  KEY `idx_catalog` (`catalog`),
  KEY `idx_review` (`review_status`),
  KEY `idx_cut` (`cut_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `neoart_import_log` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `run_id` INT NULL,
  `vendor` VARCHAR(64) NULL,
  `stage` ENUM('download','cut','publish') NOT NULL,
  `message` VARCHAR(512) NULL,
  `created_at` DATETIME NULL,
  KEY `idx_run` (`run_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

> Примечание: `charset=utf8` под существующую БучБ. Если у `catalog_baget` иной collation — согласовать вручную; на функциональность не влияет.

- [ ] **Step 2: Конфиг-файл**

Create `admin/config/neoartConfig.php`:

```php
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
```

- [ ] **Step 3: Staging-папки и .gitkeep**

```bash
cd "E:/OSPanel/domains/virtual-baget-curent"
mkdir -p neoart_import/raw neoart_import/listimg neoart_import/imgconst neoart_import/_cache
touch neoart_import/.gitkeep
```

- [ ] **Step 4: .gitignore — игнор медиа, но не структуру**

Добавить в конец `.gitignore`:

```
# Neoart Import Studio — staging media (не коммитим картинки/кеш)
/neoart_import/raw/
/neoart_import/listimg/
/neoart_import/imgconst/
/neoart_import/_cache/
```

- [ ] **Step 5: Верификация — прогнать SQL локально и проверить конфиг**

```bash
cd "E:/OSPanel/domains/virtual-baget-curent"
# прогнать DDL в локальную БД (OSPanel, root без пароля)
mysql -u root a0458868_bagetnaya < sql/neoart_import.sql
mysql -u root a0458868_bagetnaya -e "SHOW TABLES LIKE 'neoart\_%';"
# проверить хелперы конфига
php -r '$_SERVER["DOCUMENT_ROOT"]=getcwd(); require "admin/config/neoartConfig.php"; $p=neoart_paths("wood"); echo $p["raw"],PHP_EOL,$p["listimg_url"],PHP_EOL,neoart_safe_name("6005\\\\46"),PHP_EOL;'
```

Expected:
- `SHOW TABLES` печатает `neoart_import_run`, `neoart_item`, `neoart_import_log`.
- php печатает путь `.../neoart_import/raw/wood`, `/neoart_import/listimg/wood`, `6005-46`.
- Папки `neoart_import/raw/wood` и т.д. созданы.

- [ ] **Step 6: Commit**

```bash
git add sql/neoart_import.sql admin/config/neoartConfig.php .gitignore neoart_import/.gitkeep
git commit -m "feat(neoart): фундамент — staging-таблицы, конфиг, папки"
```

---

## Task 2: Скачивание фида — NeoartFeed + run_start.php

**Files:**
- Create: `admin/helpers/NeoartFeed.php`
- Create: `admin/request/neoart/run_start.php`

**Interfaces:**
- Consumes: `neoart_config()`, `neoart_safe_name()`, `neoart_cache_dir()`; `$dbh` (PDO).
- Produces:
  - `NeoartFeed::fetch(string $catalog): array` — массив ELEMENTS фида (из кеша `_cache/catalog_<id>.json` или качает и кеширует).
  - `NeoartFeed::sections(string $catalog): array` — карта `section_id => name`.
  - `NeoartFeed::record(array $element, array $sections, array $catCfg): ?array` — нормализованная запись (ключи: `vendor,name,section_id,section_name,width_mm,widthwithout_mm,height_mm,price_base,price_chop,price_final,storage`) или null если нет артикула.
  - Эндпоинт `run_start.php` (POST `catalog`) → JSON `{run_id, total, new, existing, vendors:[...]}` где `vendors` — список артикулов на скачку (все, `--images=all`-семантика — берём весь каталог для staging).

- [ ] **Step 1: Класс NeoartFeed**

Create `admin/helpers/NeoartFeed.php`:

```php
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
```

- [ ] **Step 2: Эндпоинт run_start.php**

Create `admin/request/neoart/run_start.php`:

```php
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/NeoartFeed.php';
header('Content-Type: application/json; charset=utf-8');

$catalog = $_POST['catalog'] ?? '';
$cfg = neoart_config();
if (!isset($cfg['catalogs'][$catalog])) {
    http_response_code(400);
    echo json_encode(['error' => 'Неизвестный каталог']);
    exit;
}
$catCfg = $cfg['catalogs'][$catalog];
$now = date('Y-m-d H:i:s');

try {
    $elements = NeoartFeed::fetch($catalog);
    $sections = NeoartFeed::sections($catalog);

    // артикулы уже в живом каталоге
    $existing = [];
    foreach ($dbh->query("SELECT vendor, publicvendor FROM catalog_baget WHERE type = " . $dbh->quote($catalog)) as $r) {
        $existing[trim((string)$r['vendor'])] = $r['publicvendor'];
    }

    // создаём run
    $dbh->prepare("INSERT INTO neoart_import_run(catalog,status,started_at) VALUES(?, 'running', ?)")
        ->execute([$catalog, $now]);
    $runId = (int)$dbh->lastInsertId();

    $ins = $dbh->prepare(
        "INSERT INTO neoart_item
          (run_id,catalog,vendor,name,section_id,section_name,width_mm,widthwithout_mm,height_mm,
           price_base,price_chop,price_final,storage,in_catalog,catalog_publicvendor,created_at,updated_at)
         VALUES (:run,:cat,:vendor,:name,:sid,:sname,:w,:ww,:h,:pb,:pc,:pf,:st,:inc,:cpv,:now,:now)
         ON DUPLICATE KEY UPDATE
           run_id=:run, name=:name, section_id=:sid, section_name=:sname,
           width_mm=:w, widthwithout_mm=:ww, height_mm=:h,
           price_base=:pb, price_chop=:pc, price_final=:pf, storage=:st,
           in_catalog=:inc, catalog_publicvendor=:cpv, updated_at=:now"
    );

    $vendors = []; $new = 0; $have = 0;
    foreach ($elements as $e) {
        $rec = NeoartFeed::record($e, $sections, $catCfg);
        if ($rec === null) continue;
        $inCatalog = array_key_exists($rec['vendor'], $existing);
        $inCatalog ? $have++ : $new++;
        $ins->execute([
            ':run' => $runId, ':cat' => $catalog, ':vendor' => $rec['vendor'], ':name' => $rec['name'],
            ':sid' => $rec['section_id'], ':sname' => $rec['section_name'],
            ':w' => $rec['width_mm'], ':ww' => $rec['widthwithout_mm'], ':h' => $rec['height_mm'],
            ':pb' => $rec['price_base'], ':pc' => $rec['price_chop'], ':pf' => $rec['price_final'],
            ':st' => $rec['storage'], ':inc' => $inCatalog ? 1 : 0,
            ':cpv' => $inCatalog ? $existing[$rec['vendor']] : null, ':now' => $now,
        ]);
        $vendors[] = $rec['vendor'];
    }

    $dbh->prepare("UPDATE neoart_import_run SET total=? WHERE id=?")->execute([count($vendors), $runId]);
    echo json_encode(['run_id' => $runId, 'total' => count($vendors), 'new' => $new, 'existing' => $have, 'vendors' => $vendors], JSON_UNESCAPED_UNICODE);
} catch (Throwable $ex) {
    http_response_code(500);
    echo json_encode(['error' => $ex->getMessage()]);
}
```

- [ ] **Step 3: Верификация — прогнать run_start через CLI-обёртку**

```bash
cd "E:/OSPanel/domains/virtual-baget-curent"
php -r '
$_SERVER["DOCUMENT_ROOT"]=getcwd(); $_SERVER["REQUEST_URI"]="/x"; $_SERVER["HTTP_HOST"]="localhost";
$_POST["catalog"]="wood";
require "admin/request/neoart/run_start.php";
'
mysql -u root a0458868_bagetnaya -e "SELECT catalog,total,status FROM neoart_import_run ORDER BY id DESC LIMIT 1; SELECT COUNT(*) AS items, SUM(in_catalog) AS in_cat FROM neoart_item WHERE catalog='wood';"
```

Expected:
- JSON с `run_id`, `total` (~1837 для wood), `new`/`existing` (existing ≈ число уже в каталоге).
- `neoart_import_run` — свежая строка `wood`, `total>0`.
- `neoart_item` для wood: `items` = total, `in_cat` > 0.
- Повторный запуск не плодит дубли (UNIQUE (catalog,vendor) + ON DUPLICATE) — `items` не растёт.

- [ ] **Step 4: Commit**

```bash
git add admin/helpers/NeoartFeed.php admin/request/neoart/run_start.php
git commit -m "feat(neoart): фид → run + upsert neoart_item (run_start)"
```

---

## Task 3: Чанк скачивания raw — run_download_chunk.php

**Files:**
- Create: `admin/request/neoart/run_download_chunk.php`

**Interfaces:**
- Consumes: `$dbh`, `neoart_config()`, `neoart_paths()`, `neoart_safe_name()`, `NeoartFeed` не нужен.
- Produces: POST `run_id`, `catalog`, `offset`, `size` → JSON `{done, total, ok, failed, next_offset}`. Качает раздел списка артикулов `[offset, offset+size)` из `neoart_item` этого run (по возрастанию id), пишет raw-файлы, обновляет `raw_img`/`download_error`, счётчики run, ошибки в `neoart_import_log`.

- [ ] **Step 1: Эндпоинт**

Create `admin/request/neoart/run_download_chunk.php`:

```php
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
header('Content-Type: application/json; charset=utf-8');

$runId   = (int)($_POST['run_id'] ?? 0);
$catalog = $_POST['catalog'] ?? '';
$offset  = max(0, (int)($_POST['offset'] ?? 0));
$size    = min(30, max(1, (int)($_POST['size'] ?? 15)));
$cfg = neoart_config();
$cat = $cfg['catalogs'][$catalog] ?? null;
if (!$cat || !$runId) { http_response_code(400); echo json_encode(['error' => 'bad params']); exit; }

$paths = neoart_paths($catalog);
$imgUrlBase = "{$cfg['api_base']}?{$cfg['api_auth']}&action=image&catalog={$cat['id']}&art=";
$now = date('Y-m-d H:i:s');

// весь список артикулов run (id по возрастанию) — берём окно
$all = $dbh->prepare("SELECT id, vendor FROM neoart_item WHERE run_id=? AND catalog=? ORDER BY id ASC");
$all->execute([$runId, $catalog]);
$rows = $all->fetchAll(PDO::FETCH_ASSOC);
$total = count($rows);
$batch = array_slice($rows, $offset, $size);

$logStmt = $dbh->prepare("INSERT INTO neoart_import_log(run_id,vendor,stage,message,created_at) VALUES(?,?,'download',?,?)");
$updOk  = $dbh->prepare("UPDATE neoart_item SET raw_img=?, download_error=NULL, updated_at=? WHERE id=?");
$updErr = $dbh->prepare("UPDATE neoart_item SET download_error=?, updated_at=? WHERE id=?");

$ok = 0; $failed = 0;
$mh = curl_multi_init();
$handles = [];
foreach ($batch as $r) {
    $file = "{$paths['raw']}/" . neoart_safe_name($r['vendor']) . '.jpg';
    if (is_file($file) && filesize($file) > 1000) { $ok++; continue; } // возобновление
    $art = str_replace('%2F', '/', rawurlencode(str_replace('\\', '/', $r['vendor'])));
    $ch = curl_init($imgUrlBase . $art);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CONNECTTIMEOUT => 30, CURLOPT_TIMEOUT => 90,
        CURLOPT_SSL_VERIFYPEER => false, CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; NeoartImport/1.0)',
    ]);
    curl_multi_add_handle($mh, $ch);
    $handles[] = [$ch, $r, $file];
}
do { $st = curl_multi_exec($mh, $running); if ($running) curl_multi_select($mh, 1.0); } while ($running && $st === CURLM_OK);

foreach ($handles as [$ch, $r, $file]) {
    $body = curl_multi_getcontent($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($body !== false && strlen((string)$body) > 1000 && substr((string)$body, 0, 2) === "\xFF\xD8" && $code >= 200 && $code < 400) {
        file_put_contents($file, $body);
        $updOk->execute([basename($file), $now, $r['id']]);
        $ok++;
    } else {
        $msg = "HTTP $code";
        $updErr->execute([$msg, $now, $r['id']]);
        $logStmt->execute([$runId, $r['vendor'], $msg, $now]);
        $failed++;
    }
    curl_multi_remove_handle($mh, $ch); curl_close($ch);
}
curl_multi_close($mh);

$nextOffset = $offset + $size;
$done = min($nextOffset, $total);
// накопительно обновляем счётчики run
$dbh->prepare("UPDATE neoart_import_run SET downloaded=downloaded+?, failed=failed+? WHERE id=?")
    ->execute([$ok, $failed, $runId]);
if ($done >= $total) {
    $dbh->prepare("UPDATE neoart_import_run SET status='done', finished_at=? WHERE id=?")->execute([$now, $runId]);
}
echo json_encode(['done' => $done, 'total' => $total, 'ok' => $ok, 'failed' => $failed, 'next_offset' => $nextOffset], JSON_UNESCAPED_UNICODE);
```

- [ ] **Step 2: Верификация — скачать первые 2 чанка + проверить лог ошибок**

```bash
cd "E:/OSPanel/domains/virtual-baget-curent"
RUN=$(mysql -u root a0458868_bagetnaya -N -e "SELECT id FROM neoart_import_run WHERE catalog='wood' ORDER BY id DESC LIMIT 1;")
php -r '
$_SERVER["DOCUMENT_ROOT"]=getcwd(); $_SERVER["REQUEST_URI"]="/x"; $_SERVER["HTTP_HOST"]="localhost";
$_POST=["run_id"=>$argv[1],"catalog"=>"wood","offset"=>"0","size"=>"10"];
require "admin/request/neoart/run_download_chunk.php";
' "$RUN"
ls neoart_import/raw/wood | head; echo "файлов:"; ls neoart_import/raw/wood | wc -l
mysql -u root a0458868_bagetnaya -e "SELECT vendor,raw_img,download_error FROM neoart_item WHERE run_id=$RUN AND catalog='wood' ORDER BY id LIMIT 12;"
```

Expected:
- JSON `{done:10,total:~1837,ok:<=10,failed:>=0,next_offset:10}`.
- В `neoart_import/raw/wood` появились .jpg (≈10, минус 404).
- У скачанных строк `raw_img` заполнен; у отсутствующих — `download_error='HTTP 404'` и запись в `neoart_import_log`.

- [ ] **Step 3: Commit**

```bash
git add admin/request/neoart/run_download_chunk.php
git commit -m "feat(neoart): чанк скачивания raw-фото (curl_multi, лог ошибок)"
```

---

## Task 4: UI-каркас вкладки + прогресс скачивания

**Files:**
- Modify: `admin/view/ul_tab.php` (добавить вкладку)
- Modify: `admin/view/div_tab.php` (добавить pane + include)
- Create: `admin/view/neoart_import.php`
- Create: `admin/assets/js/neoart_import.js`
- Modify: `admin/index.php` (подключить Cropper.js CDN + neoart_import.js)

**Interfaces:**
- Consumes: эндпоинты `run_start.php`, `run_download_chunk.php`.
- Produces: DOM-контракт — `#neoart-import` pane, селектор каталога `#neoartCatalog`, кнопки `#neoartRunDownload` / `#neoartRunCut`, бары `#neoartDlBar` / `#neoartCutBar`, панель ошибок `#neoartErrors`, контейнер грида `#neoartGrid` (наполняется в Task 7). JS-объект `window.NeoartUI` с методом `poll(endpoint, params, barSel, onDone)`.

- [ ] **Step 1: Вкладка в ul_tab.php**

В `admin/view/ul_tab.php` перед `<li>`-«Выход» вставить (сохраняя стиль `<?`):

```html
<li class="nav-item" role="presentation">
    <button class="nav-link" id="neoart-import-tab" data-bs-toggle="tab" data-bs-target="#neoart-import"
            type="button" role="tab" aria-controls="contact" aria-selected="false"
            data-type='neoart-import' style='color:#0d6efd'>Импорт Neoart
    </button>
</li>
```

- [ ] **Step 2: Pane в div_tab.php**

В `admin/view/div_tab.php` внутри `#myTabContent` (перед закрывающим `</div>` контейнера табов) добавить:

```php
    <div class="tab-pane fade" id="neoart-import" role="tabpanel" aria-labelledby="neoart-import-tab">
        <? require_once 'view/neoart_import.php'; ?>
    </div>
```

- [ ] **Step 3: Тело вкладки**

Create `admin/view/neoart_import.php`:

```php
<div class="container py-4" id="neoartImportApp">
    <div class="row g-3 align-items-end mb-3">
        <div class="col-auto">
            <label class="form-label mb-1">Каталог</label>
            <select class="form-select" id="neoartCatalog">
                <option value="wood">Дерево</option>
                <option value="plast">Пластик</option>
                <option value="alum">Алюминий</option>
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary" id="neoartRunDownload">1. Скачать базу</button>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-primary" id="neoartRunCut">2. Нарезать картинки</button>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-secondary" id="neoartRefreshGrid">Обновить список</button>
        </div>
    </div>

    <div class="mb-2">
        <div class="small text-muted" id="neoartDlLabel">Скачивание: —</div>
        <div class="progress" style="height:20px"><div class="progress-bar" id="neoartDlBar" style="width:0%">0%</div></div>
    </div>
    <div class="mb-3">
        <div class="small text-muted" id="neoartCutLabel">Нарезка: —</div>
        <div class="progress" style="height:20px"><div class="progress-bar bg-info" id="neoartCutBar" style="width:0%">0%</div></div>
    </div>

    <div class="card mb-3 d-none" id="neoartErrorsCard">
        <div class="card-header d-flex justify-content-between">
            <span>Ошибки</span><span class="badge bg-danger" id="neoartErrorsCount">0</span>
        </div>
        <div class="card-body" style="max-height:180px;overflow:auto" id="neoartErrors"></div>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-3" id="neoartFilters">
        <button class="btn btn-sm btn-outline-dark active" data-filter="all">Все</button>
        <button class="btn btn-sm btn-outline-warning" data-filter="flagged">Требуют правки</button>
        <button class="btn btn-sm btn-outline-success" data-filter="ready">Готовы</button>
        <button class="btn btn-sm btn-outline-secondary" data-filter="in_catalog">Уже в каталоге</button>
        <input class="form-control form-control-sm w-auto" id="neoartSearch" placeholder="поиск по артикулу">
    </div>

    <div class="row g-3" id="neoartGrid"></div>
</div>
```

- [ ] **Step 4: JS-каркас с поллингом**

Create `admin/assets/js/neoart_import.js`:

```javascript
(function () {
    const R = 'request/neoart/';
    const $ = window.jQuery;

    const NeoartUI = {
        run_id: null,
        catalog: function () { return $('#neoartCatalog').val(); },

        setBar: function (sel, done, total) {
            const pct = total ? Math.round(done / total * 100) : 0;
            $(sel).css('width', pct + '%').text(pct + '%');
        },

        // Чанковый поллинг: дергаем endpoint пока done<total.
        poll: function (endpoint, baseParams, barSel, labelSel, labelText, onDone) {
            let offset = 0;
            const size = baseParams.size || 15;
            const step = () => {
                $.post(R + endpoint, Object.assign({}, baseParams, { offset: offset, size: size }))
                    .done((res) => {
                        if (res.error) { toastr.error(res.error); return; }
                        NeoartUI.setBar(barSel, res.done, res.total);
                        $(labelSel).text(labelText + ' ' + res.done + '/' + res.total +
                            (res.failed ? ' (ошибок: ' + res.failed + ')' : ''));
                        offset = res.next_offset;
                        if (res.done < res.total) { step(); } else { onDone && onDone(res); }
                    })
                    .fail(() => toastr.error('Сбой запроса ' + endpoint));
            };
            step();
        },

        startDownload: function () {
            const cat = NeoartUI.catalog();
            $('#neoartDlLabel').text('Скачивание: подготовка фида…');
            $.post(R + 'run_start.php', { catalog: cat }).done((res) => {
                if (res.error) { toastr.error(res.error); return; }
                NeoartUI.run_id = res.run_id;
                toastr.info('Фид: всего ' + res.total + ', новых ' + res.new + ', в каталоге ' + res.existing);
                NeoartUI.poll('run_download_chunk.php', { run_id: res.run_id, catalog: cat, size: 15 },
                    '#neoartDlBar', '#neoartDlLabel', 'Скачано', () => {
                        toastr.success('Скачивание завершено');
                        NeoartUI.loadErrors();
                    });
            }).fail(() => toastr.error('run_start сбой'));
        },

        loadErrors: function () { /* реализуется в Task 6/7 (панель ошибок) */ },
        loadGrid: function () { /* реализуется в Task 7 */ },
    };

    $(function () {
        $('#neoartRunDownload').on('click', NeoartUI.startDownload);
        // #neoartRunCut — Task 6; #neoartRefreshGrid/#neoartFilters/#neoartSearch — Task 7
    });

    window.NeoartUI = NeoartUI;
})();
```

- [ ] **Step 5: Подключить ассеты в index.php**

В `admin/index.php` в `<head>` добавить Cropper.js CDN (после toastr):

```html
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.1/dist/cropper.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.1/dist/cropper.min.js"></script>
```

Перед `</html>` (после `app.js`) добавить:

```html
<script src="assets/js/neoart_import.js?v1"></script>
```

- [ ] **Step 6: Верификация — браузер**

1. Запустить OSPanel, открыть `http://localhost/admin/` (залогиниться).
2. Открыть вкладку «Импорт Neoart».
3. Выбрать «Дерево» → «1. Скачать базу».

Expected:
- Toastr показывает «Фид: всего …, новых …, в каталоге …».
- Бар «Скачивание» ползёт от 0% к 100%, лейбл `Скачано N/Total`.
- В `neoart_import/raw/wood` растёт число .jpg.
- Консоль браузера без ошибок; вкладка не блокирует UI между чанками.

- [ ] **Step 7: Commit**

```bash
git add admin/view/ul_tab.php admin/view/div_tab.php admin/view/neoart_import.php admin/assets/js/neoart_import.js admin/index.php
git commit -m "feat(neoart): вкладка админки + прогресс скачивания (чанковый поллинг)"
```

---

## Task 5: PHP+GD нарезка — NeoartCutter + CLI-раннер (верификация паритета)

**Files:**
- Create: `admin/helpers/NeoartCutter.php`
- Create: `admin/request/neoart/cut_cli.php`

**Interfaces:**
- Consumes: GD, `neoart_paths()` (в cut_chunk, не здесь).
- Produces:
  - `NeoartCutter::__construct(int $white=250, float $rowFrac=0.12, float $colFrac=0.12)`.
  - `cut(string $rawPath, string $listOut, string $constOut): array` → `['status'=>'auto_ok'|'auto_flagged'|'error', 'flags'=>string[]]`.
  - `cropListimg(string $rawPath, array $rect, string $out): bool` — `$rect=['x','y','w','h']` в пикселях оригинала → cover 150×100.
  - `cropImgconst(string $rawPath, array $rect, string $out): bool` — прямой кроп прямоугольника.
  - Константы результата listimg = 150×100.

- [ ] **Step 1: Класс NeoartCutter (порт cut.py на GD)**

Create `admin/helpers/NeoartCutter.php`:

```php
<?php
/**
 * PHP+GD порт experiment/neoart-parser/cut.py.
 * Детекция белого «окна» рамы на уменьшенной копии (быстро), кроп — из оригинала.
 */
class NeoartCutter
{
    public int $listW = 150;
    public int $listH = 100;
    private int $white;
    private float $rowFrac;
    private float $colFrac;
    private int $analyzeMax = 500;

    public function __construct(int $white = 250, float $rowFrac = 0.12, float $colFrac = 0.12)
    {
        $this->white = $white; $this->rowFrac = $rowFrac; $this->colFrac = $colFrac;
    }

    public function cut(string $rawPath, string $listOut, string $constOut): array
    {
        $src = @imagecreatefromjpeg($rawPath);
        if (!$src) return ['status' => 'error', 'flags' => ['load']];
        $W = imagesx($src); $H = imagesy($src);

        $det = $this->detect($src, $W, $H);
        if ($det === null) { imagedestroy($src); return ['status' => 'error', 'flags' => ['no-window']]; }

        [$cx0, $cy0, $cx1, $cy1] = $det['const'];
        $this->writeCrop($src, (int)$cx0, (int)$cy0, (int)($cx1 - $cx0), (int)($cy1 - $cy0), $constOut, 0, 0);

        [$lx0, $ly0, $lx1, $ly1] = $det['list'];
        $this->writeCover($src, (int)$lx0, (int)$ly0, (int)($lx1 - $lx0), (int)($ly1 - $ly0), $listOut);

        imagedestroy($src);
        $flags = $det['flags'];
        return ['status' => $flags ? 'auto_flagged' : 'auto_ok', 'flags' => $flags];
    }

    /** Детекция на уменьшенной копии. Возвращает прямоугольники в координатах ОРИГИНАЛА. */
    private function detect($src, int $W, int $H): ?array
    {
        $scale = min(1.0, $this->analyzeMax / max($W, $H));
        $aw = max(1, (int)round($W * $scale));
        $ah = max(1, (int)round($H * $scale));
        $an = imagecreatetruecolor($aw, $ah);
        imagecopyresampled($an, $src, 0, 0, 0, 0, $aw, $ah, $W, $H);

        // белая маска аналитической копии
        $white = [];               // $white[$y][$x] = 0/1
        $rowWhite = array_fill(0, $ah, 0);
        $colWhite = array_fill(0, $aw, 0);
        $rowNon   = array_fill(0, $ah, 0);
        $colNon   = array_fill(0, $aw, 0);
        $thr = $this->white;
        for ($y = 0; $y < $ah; $y++) {
            $row = [];
            for ($x = 0; $x < $aw; $x++) {
                $rgb = imagecolorat($an, $x, $y);
                $r = ($rgb >> 16) & 0xFF; $g = ($rgb >> 8) & 0xFF; $b = $rgb & 0xFF;
                $isW = ($r > $thr && $g > $thr && $b > $thr) ? 1 : 0;
                $row[$x] = $isW;
                if ($isW) { $rowWhite[$y]++; $colWhite[$x]++; }
                else { $rowNon[$y]++; $colNon[$x]++; }
            }
            $white[$y] = $row;
        }
        imagedestroy($an);

        // content bbox: строки/столбцы, где доля не-белого > 0.03
        $rows = []; for ($y = 0; $y < $ah; $y++) if ($rowNon[$y] / $aw > 0.03) $rows[] = $y;
        $cols = []; for ($x = 0; $x < $aw; $x++) if ($colNon[$x] / $ah > 0.03) $cols[] = $x;
        if (!$rows || !$cols) return null;
        $bx0 = $cols[0]; $bx1 = end($cols) + 1; $by0 = $rows[0]; $by1 = end($rows) + 1;

        // окно: самый длинный непрерывный блок белых строк внутри bbox
        $subW = $bx1 - $bx0;
        $rowFracArr = [];
        for ($y = $by0; $y < $by1; $y++) {
            $c = 0; for ($x = $bx0; $x < $bx1; $x++) $c += $white[$y][$x];
            $rowFracArr[$y] = $subW ? $c / $subW : 0;
        }
        [$r0, $r1] = $this->longestRun($rowFracArr, $by0, $by1, $this->rowFrac);
        if ($r0 === null) return null;
        $wy0 = $r0;                                  // верх окна = внутр. край верх. планки

        // право окна: самый длинный блок белых столбцов в строках окна
        $subH = $r1 - $r0;
        $colFracArr = [];
        for ($x = $bx0; $x < $bx1; $x++) {
            $c = 0; for ($y = $r0; $y < $r1; $y++) $c += $white[$y][$x];
            $colFracArr[$x] = $subH ? $c / $subH : 0;
        }
        [$c0, $c1] = $this->longestRun($colFracArr, $bx0, $bx1, $this->colFrac);
        if ($c0 === null) return null;
        $wx1 = $c1;                                  // право окна = внутр. край прав. планки

        $barTop = $wy0 - $by0;
        $barRight = $bx1 - $wx1;
        $cw = $bx1 - $bx0; $ch = $by1 - $by0;

        $flags = [];
        if ($barTop < 4 || $barTop < 0.03 * $ch) $flags[] = 'top=' . $barTop;
        if ($barTop > 0.72 * $ch) $flags[] = 'topBig';
        if ($barRight < 4 || $barRight < 0.035 * $cw) $flags[] = 'right=' . $barRight;
        if ($cw < 0.35 * $ch) $flags[] = 'narrow';
        // окно должно быть преимущественно белым
        $winW = 0; $winCnt = 0;
        for ($y = $wy0; $y < $by1; $y++) for ($x = $bx0; $x < $wx1; $x++) { $winCnt++; $winW += $white[$y][$x]; }
        if ($winCnt && $winW / $winCnt < 0.35) $flags[] = 'notwhite';

        // imgconst: верхняя планка над окном; срезаем края, пока крайняя линия преимущественно белая
        $cx0 = $bx0; $cy0 = $by0; $cx1 = $wx1; $cy1 = $wy0;
        $TRIM = 0.30;
        for ($i = 0; $i < 400; $i++) {
            if ($cx1 - $cx0 <= 6 || $cy1 - $cy0 <= 4) break;
            $changed = false;
            if ($this->colMean($white, $cx0, $cy0, $cy1) > $TRIM) { $cx0++; $changed = true; }
            if ($this->colMean($white, $cx1 - 1, $cy0, $cy1) > $TRIM) { $cx1--; $changed = true; }
            if ($this->rowMean($white, $cy0, $cx0, $cx1) > $TRIM) { $cy0++; $changed = true; }
            if ($this->rowMean($white, $cy1 - 1, $cx0, $cx1) > $TRIM) { $cy1--; $changed = true; }
            if (!$changed) break;
        }
        if ($cx1 - $cx0 < 10 || $cy1 - $cy0 < 4) {
            $flags[] = 'tiny';
            $cx0 = $bx0; $cy0 = $by0; $cx1 = max($bx0 + 10, $wx1); $cy1 = max($by0 + 4, $wy0);
        }

        // listimg: угол top-right + захват окна шириной с планки
        $lx0 = max($bx0, min($wx1 - $barRight, $bx1 - 6));
        $ly1 = min($by1, max($wy0 + $barTop, $by0 + 6));

        $inv = $scale > 0 ? 1.0 / $scale : 1.0;
        $toFull = fn($v, $max) => max(0, min($max, (int)round($v * $inv)));
        return [
            'flags' => $flags,
            'const' => [$toFull($cx0, $W), $toFull($cy0, $H), $toFull($cx1, $W), $toFull($cy1, $H)],
            'list'  => [$toFull($lx0, $W), $toFull($by0, $H), $toFull($bx1, $W), $toFull($ly1, $H)],
        ];
    }

    /** (start,end) самого длинного блока индексов [lo,hi), где $arr[i] > $thr. Индексы абсолютные. */
    private function longestRun(array $arr, int $lo, int $hi, float $thr): array
    {
        $bestLen = 0; $best = [null, null]; $i = $lo;
        while ($i < $hi) {
            if (($arr[$i] ?? 0) > $thr) {
                $j = $i; while ($j < $hi && ($arr[$j] ?? 0) > $thr) $j++;
                if ($j - $i > $bestLen) { $bestLen = $j - $i; $best = [$i, $j]; }
                $i = $j;
            } else $i++;
        }
        return $best;
    }

    private function colMean(array $white, int $x, int $y0, int $y1): float
    {
        if ($y1 <= $y0) return 0; $s = 0;
        for ($y = $y0; $y < $y1; $y++) $s += $white[$y][$x] ?? 0;
        return $s / ($y1 - $y0);
    }

    private function rowMean(array $white, int $y, int $x0, int $x1): float
    {
        if ($x1 <= $x0) return 0; $s = 0; $r = $white[$y] ?? [];
        for ($x = $x0; $x < $x1; $x++) $s += $r[$x] ?? 0;
        return $s / ($x1 - $x0);
    }

    private function writeCrop($src, int $x, int $y, int $w, int $h, string $out, int $tw, int $th): bool
    {
        $w = max(1, $w); $h = max(1, $h);
        $dst = imagecreatetruecolor($w, $h);
        imagecopy($dst, $src, 0, 0, $x, $y, $w, $h);
        $ok = imagejpeg($dst, $out, 90);
        imagedestroy($dst);
        return $ok;
    }

    /** cover: вписать по большей стороне + центр-кроп до listW×listH. */
    private function writeCover($src, int $x, int $y, int $w, int $h, string $out): bool
    {
        $w = max(1, $w); $h = max(1, $h);
        $crop = imagecreatetruecolor($w, $h);
        imagecopy($crop, $src, 0, 0, $x, $y, $w, $h);
        $scale = max($this->listW / $w, $this->listH / $h);
        $nw = max($this->listW, (int)round($w * $scale));
        $nh = max($this->listH, (int)round($h * $scale));
        $res = imagecreatetruecolor($nw, $nh);
        imagecopyresampled($res, $crop, 0, 0, 0, 0, $nw, $nh, $w, $h);
        $left = (int)(($nw - $this->listW) / 2);
        $top = (int)(($nh - $this->listH) / 2);
        $final = imagecreatetruecolor($this->listW, $this->listH);
        imagecopy($final, $res, 0, 0, $left, $top, $this->listW, $this->listH);
        $ok = imagejpeg($final, $out, 90);
        imagedestroy($crop); imagedestroy($res); imagedestroy($final);
        return $ok;
    }

    public function cropListimg(string $rawPath, array $rect, string $out): bool
    {
        $src = @imagecreatefromjpeg($rawPath); if (!$src) return false;
        $ok = $this->writeCover($src, (int)$rect['x'], (int)$rect['y'], (int)$rect['w'], (int)$rect['h'], $out);
        imagedestroy($src); return $ok;
    }

    public function cropImgconst(string $rawPath, array $rect, string $out): bool
    {
        $src = @imagecreatefromjpeg($rawPath); if (!$src) return false;
        $ok = $this->writeCrop($src, (int)$rect['x'], (int)$rect['y'], (int)$rect['w'], (int)$rect['h'], $out, 0, 0);
        imagedestroy($src); return $ok;
    }
}
```

- [ ] **Step 2: CLI-раннер + монтаж для верификации**

Create `admin/request/neoart/cut_cli.php`:

```php
<?php
/**
 * CLI: прогоняет NeoartCutter по выборке raw-фото эксперимента и собирает
 * два монтажа (imgconst / listimg) для визуального сравнения с cut.py.
 *   php admin/request/neoart/cut_cli.php <srcDir> <outDir> [limit]
 */
require_once __DIR__ . '/../../helpers/NeoartCutter.php';
$src = $argv[1] ?? (__DIR__ . '/../../../experiment/neoart-parser/images/raw');
$out = $argv[2] ?? (__DIR__ . '/../../../experiment/neoart-parser/cut_test_php');
$limit = (int)($argv[3] ?? 120);
@mkdir("$out/imgconst", 0775, true); @mkdir("$out/listimg", 0775, true);

$files = glob("$src/*.jpg");
sort($files);
if ($limit && count($files) > $limit) {
    $step = count($files) / $limit;
    $files = array_map(fn($i) => $files[(int)($i * $step)], range(0, $limit - 1));
}
$cutter = new NeoartCutter();
$ok = 0; $flag = 0; $err = 0; $flagged = [];
foreach ($files as $f) {
    $stem = pathinfo($f, PATHINFO_FILENAME);
    $r = $cutter->cut($f, "$out/listimg/$stem.jpg", "$out/imgconst/$stem.jpg");
    if ($r['status'] === 'auto_ok') $ok++;
    elseif ($r['status'] === 'auto_flagged') { $flag++; $flagged[] = "$stem\t" . implode(',', $r['flags']); }
    else { $err++; $flagged[] = "$stem\tERR:" . implode(',', $r['flags']); }
}
file_put_contents("$out/flagged.txt", implode("\n", $flagged));
echo "Обработано: " . count($files) . " | ok=$ok flagged=$flag err=$err\n";
echo "Результат: $out\n";

// монтажи
foreach ([['imgconst', 240, 120, 6], ['listimg', 150, 100, 8]] as [$sub, $cw, $chh, $cols]) {
    $imgs = glob("$out/$sub/*.jpg"); sort($imgs);
    if (count($imgs) > 54) { $st = count($imgs) / 54; $imgs = array_map(fn($i) => $imgs[(int)($i * $st)], range(0, 53)); }
    if (!$imgs) continue;
    $rows = (int)ceil(count($imgs) / $cols); $pad = 6;
    $cW = $cols * ($cw + $pad) + $pad; $cH = $rows * ($chh + $pad) + $pad;
    $canvas = imagecreatetruecolor($cW, $cH);
    imagefill($canvas, 0, 0, imagecolorallocate($canvas, 245, 245, 245));
    foreach ($imgs as $i => $p) {
        $im = @imagecreatefromjpeg($p); if (!$im) continue;
        $iw = imagesx($im); $ih = imagesy($im);
        $s = min($cw / $iw, $chh / $ih); $nw = (int)($iw * $s); $nh = (int)($ih * $s);
        $c = $i % $cols; $rrow = intdiv($i, $cols);
        $x = $pad + $c * ($cw + $pad) + (int)(($cw - $nw) / 2);
        $y = $pad + $rrow * ($chh + $pad) + (int)(($chh - $nh) / 2);
        imagecopyresampled($canvas, $im, $x, $y, 0, 0, $nw, $nh, $iw, $ih);
        imagedestroy($im);
    }
    imagejpeg($canvas, "$out/review_$sub.jpg", 88);
    imagedestroy($canvas);
    echo "review_$sub.jpg\n";
}
```

- [ ] **Step 3: Верификация — прогнать и сравнить монтажи**

```bash
cd "E:/OSPanel/domains/virtual-baget-curent"
php admin/request/neoart/cut_cli.php "" "" 120
```

Expected:
- Печатает `Обработано: 120 | ok=… flagged=… err=…`.
- Созданы `experiment/neoart-parser/cut_test_php/review_imgconst.jpg` и `review_listimg.jpg`.
- **Визуальная сверка**: открыть оба и сравнить с эталонными `experiment/neoart-parser/cut_test/review_imgconst.jpg` и `review_listimg.jpg` (Python-версия). Критерий приёмки: imgconst — прямые полосы профиля без белых полей; listimg — угол с окном внизу-слева, масштаб сопоставим с Python. Доля flagged сопоставима с Python (в пределах ~+5–8 п.п. допустимо — их менеджер добьёт руками).
- Если качество заметно хуже — подстроить пороги в конструкторе `NeoartCutter` (`white`, `rowFrac`, `colFrac`, `analyzeMax`) и перепрогнать. Зафиксировать финальные значения по умолчанию.

- [ ] **Step 4: Commit**

```bash
git add admin/helpers/NeoartCutter.php admin/request/neoart/cut_cli.php
git commit -m "feat(neoart): PHP+GD нарезка (порт cut.py) + CLI-раннер верификации"
```

---

## Task 6: Чанк нарезки — cut_chunk.php + прогресс в UI

**Files:**
- Create: `admin/request/neoart/cut_chunk.php`
- Create: `admin/request/neoart/errors_list.php` (панель ошибок)
- Modify: `admin/assets/js/neoart_import.js` (кнопка Нарезать + loadErrors)

**Interfaces:**
- Consumes: `$dbh`, `neoart_paths()`, `neoart_safe_name()`, `NeoartCutter`.
- Produces:
  - `cut_chunk.php` POST `catalog`, `offset`, `size` → JSON `{done,total,ok,flagged,err,next_offset}`. Обрабатывает позиции с `raw_img IS NOT NULL` и `cut_status IN('none','error')` (не трогает `manual`).
  - `errors_list.php` POST `catalog` → JSON `{items:[{vendor,stage,message,created_at}]}` (последние 100 из `neoart_import_log`).

- [ ] **Step 1: cut_chunk.php**

Create `admin/request/neoart/cut_chunk.php`:

```php
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/NeoartCutter.php';
header('Content-Type: application/json; charset=utf-8');

$catalog = $_POST['catalog'] ?? '';
$offset  = max(0, (int)($_POST['offset'] ?? 0));
$size    = min(20, max(1, (int)($_POST['size'] ?? 8)));
$cfg = neoart_config();
if (!isset($cfg['catalogs'][$catalog])) { http_response_code(400); echo json_encode(['error' => 'bad catalog']); exit; }

$paths = neoart_paths($catalog);
$now = date('Y-m-d H:i:s');

$all = $dbh->prepare("SELECT id,vendor,raw_img FROM neoart_item
                      WHERE catalog=? AND raw_img IS NOT NULL AND cut_status IN('none','error')
                      ORDER BY id ASC");
$all->execute([$catalog]);
$rows = $all->fetchAll(PDO::FETCH_ASSOC);
$total = count($rows);
$batch = array_slice($rows, $offset, $size);

$cutter = new NeoartCutter();
$upd = $dbh->prepare("UPDATE neoart_item SET listimg=?, imgconst=?, cut_status=?, cut_flags=?, updated_at=? WHERE id=?");
$log = $dbh->prepare("INSERT INTO neoart_import_log(vendor,stage,message,created_at) VALUES(?,'cut',?,?)");

$ok = 0; $flagged = 0; $err = 0;
foreach ($batch as $r) {
    $base = neoart_safe_name($r['vendor']) . '.jpg';
    $rawPath = "{$paths['raw']}/{$r['raw_img']}";
    $listOut = "{$paths['listimg']}/$base";
    $constOut = "{$paths['imgconst']}/$base";
    $res = $cutter->cut($rawPath, $listOut, $constOut);
    if ($res['status'] === 'error') {
        $err++;
        $upd->execute([null, null, 'error', implode(',', $res['flags']), $now, $r['id']]);
        $log->execute([$r['vendor'], 'нарезка: ' . implode(',', $res['flags']), $now]);
    } else {
        $res['status'] === 'auto_flagged' ? $flagged++ : $ok++;
        $upd->execute([$base, $base, $res['status'], implode(',', $res['flags']) ?: null, $now, $r['id']]);
    }
}
$nextOffset = $offset + $size;
$done = min($nextOffset, $total);
echo json_encode(['done' => $done, 'total' => $total, 'ok' => $ok, 'flagged' => $flagged, 'err' => $err, 'next_offset' => $nextOffset], JSON_UNESCAPED_UNICODE);
```

- [ ] **Step 2: errors_list.php**

Create `admin/request/neoart/errors_list.php`:

```php
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
header('Content-Type: application/json; charset=utf-8');
$catalog = $_POST['catalog'] ?? '';
$stmt = $dbh->prepare(
    "SELECT l.vendor,l.stage,l.message,l.created_at
     FROM neoart_import_log l
     LEFT JOIN neoart_item i ON i.vendor=l.vendor AND i.catalog=?
     WHERE (? = '' OR i.catalog=? OR l.vendor IS NULL)
     ORDER BY l.id DESC LIMIT 100"
);
$stmt->execute([$catalog, $catalog, $catalog]);
echo json_encode(['items' => $stmt->fetchAll(PDO::FETCH_ASSOC)], JSON_UNESCAPED_UNICODE);
```

- [ ] **Step 3: JS — кнопка Нарезать + панель ошибок**

В `admin/assets/js/neoart_import.js` заменить заглушку `loadErrors` и добавить старт нарезки. Внутри `NeoartUI` заменить `loadErrors: function () {}` на:

```javascript
        startCut: function () {
            const cat = NeoartUI.catalog();
            $('#neoartCutLabel').text('Нарезка: старт…');
            NeoartUI.poll('cut_chunk.php', { catalog: cat, size: 8 },
                '#neoartCutBar', '#neoartCutLabel', 'Нарезано', (res) => {
                    toastr.success('Нарезка завершена (флагов: ' + (res.flagged || 0) + ')');
                    NeoartUI.loadGrid && NeoartUI.loadGrid();
                });
        },

        loadErrors: function () {
            $.post(R + 'errors_list.php', { catalog: NeoartUI.catalog() }).done((res) => {
                const items = (res && res.items) || [];
                $('#neoartErrorsCount').text(items.length);
                if (!items.length) { $('#neoartErrorsCard').addClass('d-none'); return; }
                $('#neoartErrorsCard').removeClass('d-none');
                $('#neoartErrors').html(items.map(e =>
                    '<div class="small"><b>' + (e.vendor || '—') + '</b> [' + e.stage + '] ' + e.message + '</div>'
                ).join(''));
            });
        },
```

И в `$(function(){...})` добавить обработчик:

```javascript
        $('#neoartRunCut').on('click', NeoartUI.startCut);
```

- [ ] **Step 4: Верификация — браузер + SQL**

1. В браузере на вкладке «Импорт Neoart» (после того как raw уже качаются/скачаны) нажать «2. Нарезать картинки».

Expected:
- Бар «Нарезка» ползёт до 100%, лейбл `Нарезано N/Total`, toastr «Нарезка завершена (флагов: X)».
- В `neoart_import/listimg/wood` и `imgconst/wood` появились .jpg.

2. SQL-проверка:

```bash
mysql -u root a0458868_bagetnaya -e "SELECT cut_status, COUNT(*) FROM neoart_item WHERE catalog='wood' GROUP BY cut_status;"
```

Expected: строки `auto_ok`, `auto_flagged` (и, возможно, `error`) с ненулевыми счётчиками; `listimg`/`imgconst` заполнены у обработанных.

- [ ] **Step 5: Commit**

```bash
git add admin/request/neoart/cut_chunk.php admin/request/neoart/errors_list.php admin/assets/js/neoart_import.js
git commit -m "feat(neoart): чанк нарезки на GD + панель ошибок + прогресс"
```

---

## Task 7: Грид ревью — items_list + item_get + карточки/фильтры/бейджи

**Files:**
- Create: `admin/request/neoart/items_list.php`
- Create: `admin/request/neoart/item_get.php`
- Modify: `admin/assets/js/neoart_import.js` (loadGrid + фильтры + поиск + рендер карточек)

**Interfaces:**
- Consumes: `$dbh`, `neoart_paths()`.
- Produces:
  - `items_list.php` POST `catalog`, `filter`(all|flagged|ready|in_catalog), `query` → JSON `{items:[{id,vendor,name,width_mm,widthwithout_mm,price_final,storage,cut_status,cut_flags,in_catalog,catalog_publicvendor,review_status,raw_url,listimg_url,imgconst_url}]}`. `*_url` — готовые web-пути или null.
  - `item_get.php` POST `id` → JSON того же вида + все поля (`section_name,height_mm,price_base,price_chop,download_error,raw_img,listimg,imgconst`).
  - DOM: карточка `.neoart-card[data-id]` c кнопками `.neoart-edit`, `.neoart-approve`, `.neoart-reject`, чекбокс `.neoart-select`.

- [ ] **Step 1: items_list.php**

Create `admin/request/neoart/items_list.php`:

```php
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
header('Content-Type: application/json; charset=utf-8');

$catalog = $_POST['catalog'] ?? '';
$filter  = $_POST['filter'] ?? 'all';
$query   = trim((string)($_POST['query'] ?? ''));
if (!isset(neoart_config()['catalogs'][$catalog])) { http_response_code(400); echo json_encode(['error' => 'bad catalog']); exit; }

$where = ['catalog = ?']; $args = [$catalog];
if ($filter === 'flagged')    { $where[] = "cut_status IN('auto_flagged','error')"; }
elseif ($filter === 'ready')  { $where[] = "cut_status IN('auto_ok','manual') AND in_catalog=0 AND review_status='pending'"; }
elseif ($filter === 'in_catalog') { $where[] = "in_catalog=1"; }
if ($query !== '') { $where[] = "vendor LIKE ?"; $args[] = "%$query%"; }

$sql = "SELECT id,vendor,name,width_mm,widthwithout_mm,price_final,storage,cut_status,cut_flags,
               in_catalog,catalog_publicvendor,review_status,raw_img,listimg,imgconst
        FROM neoart_item WHERE " . implode(' AND ', $where) . " ORDER BY id ASC LIMIT 500";
$stmt = $dbh->prepare($sql); $stmt->execute($args);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$p = neoart_paths($catalog);
$u = fn($sub, $f) => $f ? ($p[$sub . '_url'] . '/' . $f) : null;
foreach ($rows as &$r) {
    $r['raw_url']      = $u('raw', $r['raw_img']);
    $r['listimg_url']  = $u('listimg', $r['listimg']);
    $r['imgconst_url'] = $u('imgconst', $r['imgconst']);
}
echo json_encode(['items' => $rows], JSON_UNESCAPED_UNICODE);
```

- [ ] **Step 2: item_get.php**

Create `admin/request/neoart/item_get.php`:

```php
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
header('Content-Type: application/json; charset=utf-8');

$id = (int)($_POST['id'] ?? 0);
$stmt = $dbh->prepare("SELECT * FROM neoart_item WHERE id=?");
$stmt->execute([$id]);
$r = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$r) { http_response_code(404); echo json_encode(['error' => 'not found']); exit; }
$p = neoart_paths($r['catalog']);
$u = fn($sub, $f) => $f ? ($p[$sub . '_url'] . '/' . $f) : null;
$r['raw_url']      = $u('raw', $r['raw_img']);
$r['listimg_url']  = $u('listimg', $r['listimg']);
$r['imgconst_url'] = $u('imgconst', $r['imgconst']);
echo json_encode(['item' => $r], JSON_UNESCAPED_UNICODE);
```

- [ ] **Step 3: JS — рендер грида, фильтры, поиск**

В `admin/assets/js/neoart_import.js` заменить заглушку `loadGrid` и добавить обработчики. Реализовать `loadGrid`:

```javascript
        _filter: 'all',

        cardHtml: function (it) {
            const badge = it.in_catalog == 1
                ? '<span class="badge bg-secondary">в каталоге ' + (it.catalog_publicvendor || '') + '</span>'
                : (it.cut_status === 'auto_flagged' || it.cut_status === 'error'
                    ? '<span class="badge bg-warning text-dark">правка: ' + (it.cut_flags || '') + '</span>'
                    : (it.review_status === 'published'
                        ? '<span class="badge bg-success">опубликован</span>'
                        : '<span class="badge bg-primary">готов</span>'));
            const img = (u, h) => u ? '<img src="' + u + '" style="height:' + h + 'px;border:1px solid #ddd">' : '<span class="text-muted small">нет</span>';
            const cw = 'width:100%;height:70px;background:url(' + (it.imgconst_url || '') + ') repeat-x;border:1px solid #ddd';
            const canApprove = it.in_catalog != 1 && it.listimg_url && it.imgconst_url && it.review_status !== 'published';
            return '' +
              '<div class="col-6 col-md-4 col-xl-3"><div class="card neoart-card h-100" data-id="' + it.id + '">' +
                '<div class="card-body p-2">' +
                  '<div class="d-flex justify-content-between align-items-center mb-1">' +
                    '<div class="form-check"><input class="form-check-input neoart-select" type="checkbox" ' + (canApprove ? '' : 'disabled') + '></div>' +
                    '<div class="small"><b>' + it.vendor + '</b></div>' + badge +
                  '</div>' +
                  '<div class="row g-1 mb-1">' +
                    '<div class="col-6 text-center"><div class="small text-muted">каталог</div>' + img(it.listimg_url, 60) + '</div>' +
                    '<div class="col-6 text-center"><div class="small text-muted">исходник</div>' + img(it.raw_url, 60) + '</div>' +
                  '</div>' +
                  '<div class="small text-muted">конструктор (repeat-x):</div><div style="' + cw + '"></div>' +
                  '<div class="small mt-1">Ш ' + it.width_mm + ' / без чт ' + it.widthwithout_mm + ' мм · ' + it.price_final + '₽ · ост ' + it.storage + '</div>' +
                  '<div class="d-flex gap-1 mt-2">' +
                    '<button class="btn btn-sm btn-outline-primary neoart-edit">Править</button>' +
                    '<button class="btn btn-sm btn-success neoart-approve" ' + (canApprove ? '' : 'disabled') + '>Одобрить</button>' +
                    '<button class="btn btn-sm btn-outline-danger neoart-reject">✕</button>' +
                  '</div>' +
                '</div>' +
              '</div></div>';
        },

        loadGrid: function () {
            $.post(R + 'items_list.php', { catalog: NeoartUI.catalog(), filter: NeoartUI._filter, query: $('#neoartSearch').val() })
                .done((res) => {
                    const items = (res && res.items) || [];
                    $('#neoartGrid').html(items.map(NeoartUI.cardHtml).join('') || '<div class="text-muted">Пусто</div>');
                });
        },
```

В `$(function(){...})` добавить:

```javascript
        $('#neoartRefreshGrid').on('click', NeoartUI.loadGrid);
        $('#neoartFilters').on('click', 'button[data-filter]', function () {
            $('#neoartFilters button').removeClass('active'); $(this).addClass('active');
            NeoartUI._filter = $(this).data('filter'); NeoartUI.loadGrid();
        });
        let t; $('#neoartSearch').on('input', function () { clearTimeout(t); t = setTimeout(NeoartUI.loadGrid, 300); });
        $('#neoartCatalog').on('change', NeoartUI.loadGrid);
```

- [ ] **Step 4: Верификация — браузер**

1. Открыть вкладку, выбрать «Дерево», нажать «Обновить список».

Expected:
- Грид карточек: у каждой — превью **каталог (listimg)** и **исходник (raw)**, полоса **конструктор** с `repeat-x` (видно, как планка тайлится в раму), артикул, Ш/без чт/цена/остаток.
- Фильтр «Требуют правки» показывает только флагнутые; «Уже в каталоге» — только с бейджем «в каталоге» и заблокированной кнопкой «Одобрить»; поиск по артикулу фильтрует.
- Кнопка «Одобрить» активна только у готовых новых (есть обе картинки, не в каталоге).

- [ ] **Step 5: Commit**

```bash
git add admin/request/neoart/items_list.php admin/request/neoart/item_get.php admin/assets/js/neoart_import.js
git commit -m "feat(neoart): грид ревью — карточки, фильтры, поиск, бейджи"
```

---

## Task 8: Визуальный редактор — кроп/загрузка/reset

**Files:**
- Create: `admin/request/neoart/item_save_crop.php`
- Create: `admin/request/neoart/item_upload.php`
- Create: `admin/request/neoart/item_reset.php`
- Modify: `admin/view/neoart_import.php` (модалка редактора)
- Modify: `admin/assets/js/neoart_import.js` (Cropper.js логика)

**Interfaces:**
- Consumes: `$dbh`, `neoart_paths()`, `neoart_safe_name()`, `NeoartCutter`, `NeoartFeed` не нужен.
- Produces:
  - `item_save_crop.php` POST `id`, `which`(listimg|imgconst), `x,y,w,h` (пиксели оригинала raw) → JSON `{ok, url}`. Режет GD из raw, ставит `cut_status='manual'`.
  - `item_upload.php` POST `id`, `which`(raw|listimg|imgconst) + `file` → JSON `{ok, url}`.
  - `item_reset.php` POST `id` → JSON `{ok, cut_status, cut_flags}`. Переуборка авто-нарезкой одной позиции.

- [ ] **Step 1: item_save_crop.php**

Create `admin/request/neoart/item_save_crop.php`:

```php
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/NeoartCutter.php';
header('Content-Type: application/json; charset=utf-8');

$id = (int)($_POST['id'] ?? 0);
$which = $_POST['which'] ?? '';
if (!in_array($which, ['listimg', 'imgconst'], true)) { http_response_code(400); echo json_encode(['error' => 'bad which']); exit; }

$stmt = $dbh->prepare("SELECT * FROM neoart_item WHERE id=?"); $stmt->execute([$id]);
$it = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$it || !$it['raw_img']) { http_response_code(404); echo json_encode(['error' => 'no raw']); exit; }

$p = neoart_paths($it['catalog']);
$rawPath = "{$p['raw']}/{$it['raw_img']}";
$base = neoart_safe_name($it['vendor']) . '.jpg';
$rect = ['x' => (int)$_POST['x'], 'y' => (int)$_POST['y'], 'w' => (int)$_POST['w'], 'h' => (int)$_POST['h']];

$cutter = new NeoartCutter();
$out = "{$p[$which]}/$base";
$ok = $which === 'listimg' ? $cutter->cropListimg($rawPath, $rect, $out) : $cutter->cropImgconst($rawPath, $rect, $out);
if (!$ok) { http_response_code(500); echo json_encode(['error' => 'crop failed']); exit; }

$dbh->prepare("UPDATE neoart_item SET $which=?, cut_status='manual', updated_at=? WHERE id=?")
    ->execute([$base, date('Y-m-d H:i:s'), $id]);
echo json_encode(['ok' => 1, 'url' => $p[$which . '_url'] . '/' . $base . '?t=' . time()], JSON_UNESCAPED_UNICODE);
```

- [ ] **Step 2: item_upload.php**

Create `admin/request/neoart/item_upload.php`:

```php
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
header('Content-Type: application/json; charset=utf-8');

$id = (int)($_POST['id'] ?? 0);
$which = $_POST['which'] ?? '';
if (!in_array($which, ['raw', 'listimg', 'imgconst'], true) || empty($_FILES['file'])) {
    http_response_code(400); echo json_encode(['error' => 'bad params']); exit;
}
$stmt = $dbh->prepare("SELECT * FROM neoart_item WHERE id=?"); $stmt->execute([$id]);
$it = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$it) { http_response_code(404); echo json_encode(['error' => 'not found']); exit; }

$info = @getimagesize($_FILES['file']['tmp_name']);
if (!$info || $info[2] !== IMAGETYPE_JPEG) { http_response_code(400); echo json_encode(['error' => 'нужен JPEG']); exit; }

$p = neoart_paths($it['catalog']);
$base = neoart_safe_name($it['vendor']) . '.jpg';
$dest = "{$p[$which]}/$base";
if (!move_uploaded_file($_FILES['file']['tmp_name'], $dest)) { http_response_code(500); echo json_encode(['error' => 'save failed']); exit; }

$col = $which === 'raw' ? 'raw_img' : $which;
$extra = $which === 'raw' ? '' : ", cut_status='manual'";
$dbh->prepare("UPDATE neoart_item SET $col=?$extra, updated_at=? WHERE id=?")
    ->execute([$base, date('Y-m-d H:i:s'), $id]);
echo json_encode(['ok' => 1, 'url' => $p[$which . '_url'] . '/' . $base . '?t=' . time()], JSON_UNESCAPED_UNICODE);
```

- [ ] **Step 3: item_reset.php**

Create `admin/request/neoart/item_reset.php`:

```php
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/NeoartCutter.php';
header('Content-Type: application/json; charset=utf-8');

$id = (int)($_POST['id'] ?? 0);
$stmt = $dbh->prepare("SELECT * FROM neoart_item WHERE id=?"); $stmt->execute([$id]);
$it = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$it || !$it['raw_img']) { http_response_code(404); echo json_encode(['error' => 'no raw']); exit; }

$p = neoart_paths($it['catalog']);
$base = neoart_safe_name($it['vendor']) . '.jpg';
$cutter = new NeoartCutter();
$res = $cutter->cut("{$p['raw']}/{$it['raw_img']}", "{$p['listimg']}/$base", "{$p['imgconst']}/$base");
$listimg = $res['status'] === 'error' ? null : $base;
$dbh->prepare("UPDATE neoart_item SET listimg=?, imgconst=?, cut_status=?, cut_flags=?, updated_at=? WHERE id=?")
    ->execute([$listimg, $listimg, $res['status'], implode(',', $res['flags']) ?: null, date('Y-m-d H:i:s'), $id]);
echo json_encode(['ok' => 1, 'cut_status' => $res['status'], 'cut_flags' => implode(',', $res['flags'])], JSON_UNESCAPED_UNICODE);
```

- [ ] **Step 4: Модалка редактора в neoart_import.php**

В конец `admin/view/neoart_import.php` (после закрывающего `</div>` `#neoartImportApp`) добавить:

```html
<div class="modal fade" id="neoartEditModal" tabindex="-1">
  <div class="modal-dialog modal-xl"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Редактор: <span id="neoartEditVendor"></span></h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">
      <div class="row g-3">
        <div class="col-lg-7">
          <div class="btn-group btn-group-sm mb-2">
            <button class="btn btn-outline-primary active" id="neoartModeList">Каталог (listimg)</button>
            <button class="btn btn-outline-primary" id="neoartModeConst">Конструктор (imgconst)</button>
          </div>
          <div style="max-height:60vh"><img id="neoartCropImg" style="max-width:100%"></div>
          <div class="mt-2 d-flex gap-2">
            <button class="btn btn-success btn-sm" id="neoartCropSave">Сохранить кроп</button>
            <label class="btn btn-outline-secondary btn-sm mb-0">Загрузить raw<input type="file" hidden id="neoartUpRaw" accept=".jpg,.jpeg"></label>
            <label class="btn btn-outline-secondary btn-sm mb-0">Загрузить listimg<input type="file" hidden id="neoartUpList" accept=".jpg,.jpeg"></label>
            <label class="btn btn-outline-secondary btn-sm mb-0">Загрузить imgconst<input type="file" hidden id="neoartUpConst" accept=".jpg,.jpeg"></label>
            <button class="btn btn-outline-warning btn-sm" id="neoartResetCut">Авто-нарезка заново</button>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="mb-2"><div class="small text-muted">Превью listimg (150×100)</div><img id="neoartPrevList" style="border:1px solid #ddd"></div>
          <div class="mb-2"><div class="small text-muted">Превью imgconst (repeat-x)</div><div id="neoartPrevConst" style="width:100%;height:80px;border:1px solid #ddd"></div></div>
          <div id="neoartEditInfo" class="small"></div>
        </div>
      </div>
    </div>
  </div></div>
</div>
```

- [ ] **Step 5: JS — Cropper.js логика**

В `admin/assets/js/neoart_import.js` добавить в `NeoartUI` (и обработчики в `$(function(){})`):

```javascript
        _edit: { id: null, item: null, cropper: null, mode: 'listimg' },

        openEdit: function (id) {
            $.post(R + 'item_get.php', { id: id }).done((res) => {
                const it = res.item; NeoartUI._edit.id = id; NeoartUI._edit.item = it;
                $('#neoartEditVendor').text(it.vendor);
                $('#neoartPrevList').attr('src', it.listimg_url || '');
                $('#neoartPrevConst').css('background', it.imgconst_url ? 'url(' + it.imgconst_url + ') repeat-x' : '');
                $('#neoartEditInfo').html('Ширина ' + it.width_mm + ' / без чт ' + it.widthwithout_mm + ' мм<br>Цена ' + it.price_final + '₽ · остаток ' + it.storage + '<br>Секция: ' + (it.section_name || '—') + '<br>Флаги: ' + (it.cut_flags || '—'));
                new bootstrap.Modal(document.getElementById('neoartEditModal')).show();
                NeoartUI.setMode('listimg', it.raw_url);
            });
        },

        setMode: function (mode, rawUrl) {
            NeoartUI._edit.mode = mode;
            $('#neoartModeList').toggleClass('active', mode === 'listimg');
            $('#neoartModeConst').toggleClass('active', mode === 'imgconst');
            const img = document.getElementById('neoartCropImg');
            img.src = rawUrl || NeoartUI._edit.item.raw_url;
            if (NeoartUI._edit.cropper) NeoartUI._edit.cropper.destroy();
            img.onload = () => {
                NeoartUI._edit.cropper = new Cropper(img, {
                    viewMode: 1, autoCropArea: 0.5,
                    aspectRatio: mode === 'listimg' ? 150 / 100 : NaN,
                });
            };
            if (img.complete) img.onload();
        },

        saveCrop: function () {
            const c = NeoartUI._edit.cropper; if (!c) return;
            const d = c.getData(true); // координаты в пикселях оригинала
            $.post(R + 'item_save_crop.php', {
                id: NeoartUI._edit.id, which: NeoartUI._edit.mode,
                x: d.x, y: d.y, w: d.width, h: d.height,
            }).done((res) => {
                if (res.error) { toastr.error(res.error); return; }
                toastr.success('Сохранено');
                if (NeoartUI._edit.mode === 'listimg') $('#neoartPrevList').attr('src', res.url);
                else $('#neoartPrevConst').css('background', 'url(' + res.url + ') repeat-x');
                NeoartUI.loadGrid();
            });
        },

        upload: function (which, fileInput) {
            const fd = new FormData(); fd.append('id', NeoartUI._edit.id); fd.append('which', which); fd.append('file', fileInput.files[0]);
            $.ajax({ url: R + 'item_upload.php', method: 'POST', data: fd, processData: false, contentType: false })
                .done((res) => {
                    if (res.error) { toastr.error(res.error); return; }
                    toastr.success('Загружено');
                    if (which === 'raw') NeoartUI.setMode(NeoartUI._edit.mode, res.url);
                    else if (which === 'listimg') $('#neoartPrevList').attr('src', res.url);
                    else $('#neoartPrevConst').css('background', 'url(' + res.url + ') repeat-x');
                    NeoartUI.loadGrid();
                });
        },

        resetCut: function () {
            $.post(R + 'item_reset.php', { id: NeoartUI._edit.id }).done((res) => {
                toastr.info('Пере-нарезано: ' + res.cut_status + ' ' + (res.cut_flags || ''));
                NeoartUI.openEdit(NeoartUI._edit.id); NeoartUI.loadGrid();
            });
        },
```

Обработчики в `$(function(){})`:

```javascript
        $('#neoartGrid').on('click', '.neoart-edit', function () {
            NeoartUI.openEdit($(this).closest('.neoart-card').data('id'));
        });
        $('#neoartModeList').on('click', () => NeoartUI.setMode('listimg'));
        $('#neoartModeConst').on('click', () => NeoartUI.setMode('imgconst'));
        $('#neoartCropSave').on('click', NeoartUI.saveCrop);
        $('#neoartResetCut').on('click', NeoartUI.resetCut);
        $('#neoartUpRaw').on('change', function () { NeoartUI.upload('raw', this); });
        $('#neoartUpList').on('change', function () { NeoartUI.upload('listimg', this); });
        $('#neoartUpConst').on('change', function () { NeoartUI.upload('imgconst', this); });
```

- [ ] **Step 6: Верификация — браузер**

1. В гриде у любой карточки нажать «Править».

Expected:
- Модалка: слева raw в Cropper (рамка кропа с соотношением 3:2 в режиме «Каталог»), справа превью listimg + repeat-x-полоса imgconst + инфа по товару.
- Переключение «Конструктор (imgconst)» → свободное соотношение кропа.
- «Сохранить кроп» в режиме «Каталог» → превью listimg обновилось; в режиме «Конструктор» → repeat-x-полоса обновилась; в БД `cut_status='manual'`.
- «Загрузить listimg» (свой JPEG) → превью обновилось.
- «Авто-нарезка заново» → пере-режет, флаги обновились.

- [ ] **Step 7: Commit**

```bash
git add admin/request/neoart/item_save_crop.php admin/request/neoart/item_upload.php admin/request/neoart/item_reset.php admin/view/neoart_import.php admin/assets/js/neoart_import.js
git commit -m "feat(neoart): визуальный редактор (Cropper.js) — кроп/загрузка/reset"
```

---

## Task 9: Публикация — item_approve (+массово) + item_reject

**Files:**
- Create: `admin/request/neoart/item_approve.php`
- Create: `admin/request/neoart/item_reject.php`
- Modify: `admin/assets/js/neoart_import.js` (approve/reject + массовое одобрение)
- Modify: `admin/view/neoart_import.php` (кнопка «Одобрить выбранные»)

**Interfaces:**
- Consumes: `$dbh`, `neoart_paths()`, `neoart_safe_name()`.
- Produces:
  - `item_approve.php` POST `ids` (CSV или `ids[]`) → JSON `{results:[{id,ok,publicvendor?,error?}]}`. На каждый: валидация (обе картинки, `in_catalog=0`, не `published`), `publicvendor=AUTO_INCREMENT(catalog_baget)+6000`, копия staging→`/bi/`, INSERT в `catalog_baget`, `review_status='published'`.
  - `item_reject.php` POST `id` → JSON `{ok}`. Ставит `review_status='rejected'`.

- [ ] **Step 1: item_approve.php**

Create `admin/request/neoart/item_approve.php`:

```php
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/neoartConfig.php';
header('Content-Type: application/json; charset=utf-8');

$raw = $_POST['ids'] ?? '';
$ids = is_array($raw) ? $raw : array_filter(array_map('intval', explode(',', (string)$raw)));
$ids = array_values(array_filter(array_map('intval', $ids)));
if (!$ids) { http_response_code(400); echo json_encode(['error' => 'no ids']); exit; }

$biDir = $_SERVER['DOCUMENT_ROOT'] . '/bi';
if (!is_dir($biDir)) @mkdir($biDir, 0775, true);
$now = date('Y-m-d H:i:s');
$results = [];

$sel = $dbh->prepare("SELECT * FROM neoart_item WHERE id=?");
$ins = $dbh->prepare("INSERT INTO catalog_baget(type,publicvendor,vendor,width,widthwithout,price,storage,listimg,imgconst)
                      VALUES(?,?,?,?,?,?,?,?,?)");
$log = $dbh->prepare("INSERT INTO neoart_import_log(vendor,stage,message,created_at) VALUES(?,'publish',?,?)");

foreach ($ids as $id) {
    $sel->execute([$id]); $it = $sel->fetch(PDO::FETCH_ASSOC);
    try {
        if (!$it) throw new RuntimeException('not found');
        if ($it['in_catalog'] == 1) throw new RuntimeException('уже в каталоге');
        if ($it['review_status'] === 'published') throw new RuntimeException('уже опубликован');
        if (!$it['listimg'] || !$it['imgconst']) throw new RuntimeException('нет обеих картинок');

        $p = neoart_paths($it['catalog']);
        $listSrc = "{$p['listimg']}/{$it['listimg']}";
        $constSrc = "{$p['imgconst']}/{$it['imgconst']}";
        if (!is_file($listSrc) || !is_file($constSrc)) throw new RuntimeException('файлы картинок не найдены');

        // publicvendor как в base/addnewbaget.php
        $ai = $dbh->query("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES
                           WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='catalog_baget'")->fetch(PDO::FETCH_ASSOC);
        $publicvendor = (int)$ai['AUTO_INCREMENT'] + 6000;

        $safe = neoart_safe_name($it['vendor']);
        $listName = $publicvendor . $safe . '.jpg';
        $constName = $publicvendor . 't' . $safe . '.jpg';
        if (!copy($listSrc, "$biDir/$listName")) throw new RuntimeException('копия listimg');
        if (!copy($constSrc, "$biDir/$constName")) throw new RuntimeException('копия imgconst');

        $dbh->beginTransaction();
        $ins->execute([$it['catalog'], $publicvendor, $it['vendor'], (int)$it['width_mm'], (int)$it['widthwithout_mm'],
                       (int)$it['price_final'], (int)$it['storage'], $listName, $constName]);
        $dbh->prepare("UPDATE neoart_item SET review_status='published', catalog_publicvendor=?, approved_at=?, updated_at=? WHERE id=?")
            ->execute([$publicvendor, $now, $now, $id]);
        $dbh->commit();
        $results[] = ['id' => $id, 'ok' => 1, 'publicvendor' => $publicvendor];
    } catch (Throwable $ex) {
        if ($dbh->inTransaction()) $dbh->rollBack();
        if ($it) $log->execute([$it['vendor'], $ex->getMessage(), $now]);
        $results[] = ['id' => $id, 'ok' => 0, 'error' => $ex->getMessage()];
    }
}
echo json_encode(['results' => $results], JSON_UNESCAPED_UNICODE);
```

- [ ] **Step 2: item_reject.php**

Create `admin/request/neoart/item_reject.php`:

```php
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';
header('Content-Type: application/json; charset=utf-8');
$id = (int)($_POST['id'] ?? 0);
$dbh->prepare("UPDATE neoart_item SET review_status='rejected', updated_at=? WHERE id=?")
    ->execute([date('Y-m-d H:i:s'), $id]);
echo json_encode(['ok' => 1]);
```

- [ ] **Step 3: Кнопка массового одобрения в neoart_import.php**

В `admin/view/neoart_import.php` в блок `#neoartFilters` (или рядом, перед `#neoartGrid`) добавить:

```html
<button class="btn btn-sm btn-success ms-auto" id="neoartApproveSelected">Одобрить выбранные</button>
```

- [ ] **Step 4: JS — approve/reject/массово**

В `admin/assets/js/neoart_import.js` добавить в `NeoartUI`:

```javascript
        approve: function (ids) {
            $.post(R + 'item_approve.php', { ids: ids.join(',') }).done((res) => {
                const results = (res && res.results) || [];
                const ok = results.filter(r => r.ok).length;
                const bad = results.filter(r => !r.ok);
                if (ok) toastr.success('Опубликовано: ' + ok);
                bad.forEach(b => toastr.error('id ' + b.id + ': ' + b.error));
                NeoartUI.loadGrid();
            }).fail(() => toastr.error('approve сбой'));
        },
```

Обработчики в `$(function(){})`:

```javascript
        $('#neoartGrid').on('click', '.neoart-approve', function () {
            NeoartUI.approve([$(this).closest('.neoart-card').data('id')]);
        });
        $('#neoartGrid').on('click', '.neoart-reject', function () {
            const id = $(this).closest('.neoart-card').data('id');
            $.post(R + 'item_reject.php', { id: id }).done(() => { toastr.info('Отклонён'); NeoartUI.loadGrid(); });
        });
        $('#neoartApproveSelected').on('click', function () {
            const ids = $('#neoartGrid .neoart-select:checked').map(function () {
                return $(this).closest('.neoart-card').data('id');
            }).get();
            if (!ids.length) { toastr.warning('Ничего не выбрано'); return; }
            NeoartUI.approve(ids);
        });
```

- [ ] **Step 5: Верификация — браузер + SQL**

1. В гриде «Готовы» выбрать новый товар → «Одобрить».

Expected:
- Toastr «Опубликовано: 1». Карточка получает бейдж «опубликован», кнопка «Одобрить» пропадает/блокируется.
- SQL:

```bash
mysql -u root a0458868_bagetnaya -e "SELECT type,publicvendor,vendor,listimg,imgconst,price,storage FROM catalog_baget ORDER BY id DESC LIMIT 3;"
ls -la bi/ | grep -E "$(mysql -u root a0458868_bagetnaya -N -e "SELECT publicvendor FROM catalog_baget ORDER BY id DESC LIMIT 1;")"
```

Expected: свежая строка в `catalog_baget` (type=wood, publicvendor≈AI+6000, обе картинки — `{pv}{vendor}.jpg` и `{pv}t{vendor}.jpg`); файлы лежат в `/bi/`.

2. Открыть реальный конструктор/каталог сайта — новый багет виден, в конструкторе профиль тайлится корректно.
3. Попытка одобрить товар «уже в каталоге» → кнопка заблокирована; массовое одобрение публикует несколько.

- [ ] **Step 6: Commit**

```bash
git add admin/request/neoart/item_approve.php admin/request/neoart/item_reject.php admin/view/neoart_import.php admin/assets/js/neoart_import.js
git commit -m "feat(neoart): публикация в catalog_baget (одобрение + массово) + отклонение"
```

---

## Deployment (после мержа в master)

1. Залить на хостинг по FTP/SFTP: `admin/**`, `docs/**` (по желанию), новый код. Медиа `/neoart_import/` создастся автоматически при первом запуске (mkdir в `neoart_paths`).
2. **Выполнить `sql/neoart_import.sql` вручную** в проде (phpMyAdmin/CLI) — миграций нет.
3. Проверить, что каталог `/bi/` и `/neoart_import/` доступны на запись веб-процессу.
4. На проде web-SAPI: убедиться, что нужные GD/cURL функции не в `disable_functions` (GD 2.3.3 подтверждён; cURL используется). Python не нужен.
5. Прогнать полный цикл на одном каталоге (wood) малой партией, свериться визуально, затем целиком.

## Self-Review (проверка плана против спеки)

- §4 модель данных → Task 1 (DDL 1:1 по спеке). ✓
- §5 run_start/download/cut/list/get/save_crop/upload/reset/approve/reject → Tasks 2,3,6,7,8,9. ✓
- §5 NeoartCutter + алгоритм → Task 5 (порт cut.py) + CLI-верификация. ✓
- §6 поток данных → Tasks 2→3→6→7→8→9 в порядке. ✓
- §7 прогресс (чанковый поллинг) → Task 4 `NeoartUI.poll`; ошибки в лог → Tasks 3,6 + панель Task 6. ✓
- §8 одобрение (publicvendor AI+6000, имена `{pv}{vendor}`/`{pv}t{vendor}`, in_catalog-блокировка, массово) → Task 9. ✓
- §9 фазы → Tasks 1–9 (фаза 4 = Task 7, фаза 5 = Task 8, фаза 6 = Task 9). ✓
- §10 вне охвата (pasp, обновление существующих, cron) → не планируется. ✓
- Типы/имена согласованы: `NeoartUI.poll/loadGrid/loadErrors/openEdit/setMode/saveCrop/upload/resetCut/approve`; `cut()` возвращает `['status','flags']` — одинаково в Tasks 5,6,8; `neoart_paths()` ключи `raw/listimg/imgconst(+_url)` — единообразно.
