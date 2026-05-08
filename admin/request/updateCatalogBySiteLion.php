<?
ini_set('max_execution_time', '300'); // 300 сек = 5 мин
ini_set('error_reporting', (string)E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

/*
    Обновление каталога по выгрузке Lion (XLS).
    Источник: общий XLS-фид Lion → парсинг → обновление price/storage в catalog_baget.
*/

require_once("SimpleXLSX.php");
require_once '../../base/connect.php';

// Новый формат выгрузки Lion — XLSX (старый .xls больше не обновляется)
$url = "https://frame.ru/upload/medialibrary/2f3/LionArtService.xlsx";

class UpdateCatalog
{
    public PDO $dbh;
    public string $textUpdateRows = '';
    public int $countUpdateRows = 0;
    public array $notFoundVendors = [];
    public array $typeBreakdown = [
        'alum' => 0, 'wood' => 0, 'pasp' => 0, 'plast' => 0, 'unknown' => 0,
    ];

    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Скачивание и обработка XLS по URL.
     */
    public function getCatalog(string $url, string $typeDesc): void
    {
        $startTime = microtime(true);
        $this->log("=== Старт обработки: <b>" . htmlspecialchars($typeDesc) . "</b> ===");
        $this->log("URL источника: <code>" . htmlspecialchars($url) . "</code>");

        $nameFile = $typeDesc . '-' . time() . '-' . random_int(1, 9_999_999_999) . ".xlsx";
        $dir = __DIR__ . '/updateFileXlsx';
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }
        $localPath = $dir . '/' . $nameFile;

        $this->log("Скачивание файла...");
        $this->log("&nbsp;&nbsp;allow_url_fopen=<b>" . (ini_get('allow_url_fopen') ? 'On' : 'Off') . "</b>, "
            . "cURL=<b>" . (function_exists('curl_init') ? 'есть' : 'НЕТ') . "</b>, "
            . "OpenSSL=<b>" . (extension_loaded('openssl') ? 'есть' : 'НЕТ') . "</b>");

        $downloadStart = microtime(true);
        $data          = false;
        $downloadInfo  = '';

        // 1) Пробуем cURL (на хостингах работает чаще всего)
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CONNECTTIMEOUT => 30,
                CURLOPT_TIMEOUT        => 120,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_USERAGENT      => 'Mozilla/5.0 (compatible; BagetCatalogUpdater/1.0)',
            ]);
            $data     = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlErr  = curl_error($ch);
            curl_close($ch);

            $downloadInfo = "cURL: HTTP <b>{$httpCode}</b>";
            if ($data === false || $data === '') {
                $data = false;
                $this->log("<b style='color:red'>cURL не смог скачать файл: " . htmlspecialchars($curlErr) . " (HTTP {$httpCode})</b>");
            } else {
                $this->log("✅ {$downloadInfo}");
            }
        }

        // 2) Fallback на file_get_contents
        if ($data === false) {
            $this->log("&nbsp;&nbsp;Пробую file_get_contents как fallback...");
            if (!ini_get('allow_url_fopen')) {
                $this->log("<b style='color:red'>allow_url_fopen=Off — file_get_contents для URL не работает на этом сервере.</b>");
            } else {
                $context = stream_context_create([
                    'http'  => ['method' => 'GET', 'timeout' => 60, 'user_agent' => 'BagetCatalogUpdater/1.0'],
                    'https' => ['method' => 'GET', 'timeout' => 60, 'user_agent' => 'BagetCatalogUpdater/1.0'],
                    'ssl'   => ['verify_peer' => false, 'verify_peer_name' => false],
                ]);
                $data = @file_get_contents($url, false, $context);
                if ($data === false) {
                    $err = error_get_last();
                    $this->log("<b style='color:red'>file_get_contents fail: " . htmlspecialchars($err['message'] ?? 'unknown') . "</b>");
                }
            }
        }

        $downloadTime = round(microtime(true) - $downloadStart, 2);

        if ($data === false || $data === '') {
            $this->log("<b style='color:red'>❌ ОШИБКА: не удалось скачать файл по URL ни одним способом.</b>");
            $this->log("Возможные причины: allow_url_fopen=Off, отсутствует cURL/OpenSSL, прокси/firewall блокирует исходящий https.");
            return;
        }

        $size = strlen($data);
        $this->log("Скачано: <b>" . number_format($size) . "</b> байт за <b>{$downloadTime}</b> сек.");

        if ($size < 1024) {
            $this->log("<b style='color:orange'>ВНИМАНИЕ: файл подозрительно мал (&lt; 1 КБ). Возможно URL отдал ошибку.</b>");
            $this->log("Первые 500 байт ответа: <pre>" . htmlspecialchars(substr($data, 0, 500)) . "</pre>");
        }

        $written = @file_put_contents($localPath, $data);
        if ($written === false) {
            $this->log("<b style='color:red'>ОШИБКА записи в {$localPath}. Проверь права на папку updateFileXlsx/.</b>");
            return;
        }
        $this->log("Файл сохранён: <code>" . htmlspecialchars($localPath) . "</code>");

        $this->update($nameFile);

        $totalTime = round(microtime(true) - $startTime, 2);
        $this->log("=== Завершено за <b>{$totalTime}</b> сек. ===");
    }

    /**
     * Парсинг XLS и обновление БД.
     */
    public function update(string $file): void
    {
        $parseStart = microtime(true);
        $xls = SimpleXLSX::parseFile(__DIR__ . '/updateFileXlsx/' . $file);
        if ($xls === false) {
            $this->log("<b style='color:red'>ОШИБКА парсинга XLSX: " . htmlspecialchars(SimpleXLSX::parseError()) . "</b>");
            return;
        }
        $parseTime = round(microtime(true) - $parseStart, 2);

        $countList = $xls->sheetsCount();
        $this->log("Парсинг XLSX: <b>{$parseTime}</b> сек. Листов: <b>{$countList}</b>");

        $count = 0;
        $countInDb = 0;
        $countActuallyUpdated = 0;
        $countWitheStorageIsNull = 0;
        $countSkippedRows = 0;
        $rawData = [];

        // Цикл по листам Excel-файла
        for ($sheetIdx = 0; $sheetIdx < $countList; $sheetIdx++) {
            $rows = $xls->rows($sheetIdx);
            $sheetRows = is_array($rows) ? count($rows) : 0;
            $sheetName = method_exists($xls, 'sheetName') ? $xls->sheetName($sheetIdx) : '';
            $this->log("Лист #{$sheetIdx} <i>" . htmlspecialchars((string)$sheetName) . "</i>: строк <b>{$sheetRows}</b>");

            // === ДАМП первых 10 непустых строк ===
            $this->log("&nbsp;&nbsp;<b>🔍 Дамп первых 10 строк (col0..col9):</b>");
            $dumpHtml = "<table border='1' cellpadding='3' cellspacing='0' style='font-size:11px;background:#fff'>";
            $dumpHtml .= "<tr style='background:#eee'><th>#</th>";
            $maxCols = 10;
            for ($c = 0; $c < $maxCols; $c++) {
                $mark = ($c === 0) ? ' (артикул?)' : (($c === 2) ? ' (price?)' : (($c === 4) ? ' (count?)' : ''));
                $dumpHtml .= "<th>col{$c}{$mark}</th>";
            }
            $dumpHtml .= "</tr>";
            $dumped = 0;
            foreach ($rows as $rowIdx => $row) {
                if ($dumped >= 10) break;
                if (!is_array($row)) continue;
                $allEmpty = true;
                foreach ($row as $v) { if ($v !== null && $v !== '') { $allEmpty = false; break; } }
                if ($allEmpty) continue;
                $dumpHtml .= "<tr><td>{$rowIdx}</td>";
                for ($c = 0; $c < $maxCols; $c++) {
                    $val = $row[$c] ?? '';
                    $dumpHtml .= "<td>" . htmlspecialchars((string)$val) . "</td>";
                }
                $dumpHtml .= "</tr>";
                $dumped++;
            }
            $dumpHtml .= "</table>";
            $this->log($dumpHtml);

            // Структура нового XLSX (заголовки в строке 4):
            //   col0 = Артикул
            //   col2 = Статус закупок (текст)
            //   col4 = Цена (руб./ед.)         ← обычная цена
            //   col5 = Ширина багета (мм)
            //   col6 = ЛИОН-Москва              ← остаток на складе Москва (используем только его)
            //   col7 = ЛИОН-Санкт-Петербург    ← НЕ используем
            //   col8 = Цена ЧОП                 ← если есть, приоритетнее
            //   col10 = Номенклатура (название)
            $kept = 0;
            foreach ($rows as $row) {
                $article   = isset($row[0]) ? trim((string)$row[0]) : '';
                $priceCell = $row[4] ?? null;
                $priceChop = $row[8] ?? null;
                $stockMsk  = $row[6] ?? null;

                // Пропускаем заголовки и служебные строки-разделители (где col4 не число)
                if ($article === '' || $article === 'Артикул' || !is_numeric($priceCell)) {
                    $countSkippedRows++;
                    continue;
                }

                $rawData[$article] = [
                    'article'   => $article,
                    'price'     => $priceCell,
                    'priceChop' => is_numeric($priceChop) ? $priceChop : null,
                    'count'     => is_numeric($stockMsk) ? $stockMsk : 0,
                    'status'    => trim((string)($row[2] ?? '')),
                ];
                $kept++;
            }
            $this->log("&nbsp;&nbsp;-> принято к обработке: <b>{$kept}</b>");
        }

        $totalRecords = count($rawData);
        $this->log("Всего уникальных записей после фильтра: <b>{$totalRecords}</b> (пропущено пустых/заголовков: <b>{$countSkippedRows}</b>)");

        $sumPriceBefore = 0;
        $sumPriceAfter  = 0;
        $minPriceAfter  = PHP_INT_MAX;
        $maxPriceAfter  = 0;
        $countDiscontinued = 0;
        $countByChop  = 0; // обновлено по Цене ЧОП ×4
        $countByBase  = 0; // обновлено по обычной Цене ×6

        foreach ($rawData as $item) {
            if (round((int)$item['count']) == 0) {
                $countWitheStorageIsNull++;
            }
            if (mb_stripos($item['status'] ?? '', 'снято') !== false) {
                $countDiscontinued++;
            }
            $count++;

            $vendor     = $item['article'];
            $priceBase  = (float)str_replace(',', '.', (string)$item['price']);
            $priceChop  = $item['priceChop'] !== null
                ? (float)str_replace(',', '.', (string)$item['priceChop'])
                : 0.0;
            $countBaget = (int)round((float)$item['count']);

            $hasChop = ($priceChop > 0);
            if ($hasChop) {
                $price       = (int)round($priceChop);
                $priceSource = 'ЧОП(col8)';
            } else {
                $price       = (int)round($priceBase);
                $priceSource = 'Цена(col4)';
            }
            $sumPriceBefore += $price;

            try {
                $stm = $this->dbh->prepare("SELECT type, fixed_price FROM catalog_baget WHERE vendor = ?");
                $stm->execute([$vendor]);
                $row = $stm->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                $this->log("<b style='color:red'>SQL SELECT ошибка для vendor={$vendor}: " . htmlspecialchars($e->getMessage()) . "</b>");
                continue;
            }

            if (!$row) {
                if (count($this->notFoundVendors) < 50) {
                    $this->notFoundVendors[] = $vendor;
                }
                continue;
            }

            $type = $row['type'] ?? 'unknown';
            $key  = isset($this->typeBreakdown[$type]) ? $type : 'unknown';
            $this->typeBreakdown[$key]++;

            // Множитель: зависит от типа в БД и наличия Цены ЧОП
            //   alum:  ЧОП ×4   | без ЧОП ×6
            //   wood:  ЧОП ×3.5 | без ЧОП ×3.5
            //   plast: ЧОП ×3.5 | без ЧОП ×5
            //   pasp:  ЧОП ×3.5 | без ЧОП ×3.5 (как дерево)
            //   default: как alum
            $multiplier = match ($type) {
                'wood'  => 3.5,
                'pasp'  => 3.5,
                'plast' => $hasChop ? 3.5 : 5,
                'alum'  => $hasChop ? 4   : 6,
                default => $hasChop ? 4   : 6,
            };

            $finalPrice = (int)round($price * $multiplier);
            $sumPriceAfter += $finalPrice;
            if ($finalPrice < $minPriceAfter) $minPriceAfter = $finalPrice;
            if ($finalPrice > $maxPriceAfter) $maxPriceAfter = $finalPrice;
            $countInDb++;
            if ($hasChop) $countByChop++;
            else          $countByBase++;

            $date_update = date('Y-m-d H:i:s');
            $company = 'lion';

            try {
                $stmt = $this->dbh->prepare(
                    "UPDATE catalog_baget
                        SET price = IF(fixed_price = 1, price, ?),
                            storage = ?,
                            date_update = ?,
                            company = ?
                      WHERE vendor = ?"
                );
                $stmt->execute([$finalPrice, $countBaget, $date_update, $company, $vendor]);
                if ($stmt->rowCount() > 0) {
                    $countActuallyUpdated++;
                }
                $fixedNote  = ((int)$row['fixed_price'] === 1) ? " <i>[fixed_price=1, цена не менялась]</i>" : '';
                $statusNote = !empty($item['status']) ? " <i style='color:#888'>[{$item['status']}]</i>" : '';
                $this->textUpdateRows .= "<br>обновление -> <b>{$vendor}</b> [{$type}, ×{$multiplier}]"
                    . " -> источник: <b>{$priceSource}</b> исходная: <b>{$price}</b>"
                    . " -> Цена: <b>{$finalPrice}</b>"
                    . " -> Остаток (Мск): <b>{$countBaget}</b>{$statusNote}{$fixedNote}";
                $this->countUpdateRows++;
            } catch (PDOException $e) {
                $this->log("<b style='color:red'>SQL UPDATE ошибка для vendor={$vendor}: " . htmlspecialchars($e->getMessage()) . "</b>");
            }
        }

        $countWitheStorageIsNotNull = $count - $countWitheStorageIsNull;
        $avgBefore = $count > 0 ? round($sumPriceBefore / $count) : 0;
        $avgAfter  = $countInDb > 0 ? round($sumPriceAfter / $countInDb) : 0;
        if ($countInDb === 0) $minPriceAfter = 0;

        $this->log('<hr>');
        $this->log("📊 <b>Статистика обработки</b>");
        $this->log("Записей в файле: <b>{$count}</b>");
        $this->log("Совпадений с БД: <b>{$countInDb}</b>");
        $this->log("Реально изменили строки в БД (rowCount&gt;0): <b>{$countActuallyUpdated}</b>");
        $this->log("Не найдено в БД: <b>" . ($count - $countInDb) . "</b>");
        $this->log("Не в наличии в Мск (count=0): <b>{$countWitheStorageIsNull}</b>");
        $this->log("В наличии в Мск: <b>{$countWitheStorageIsNotNull}</b>");
        $this->log("Со статусом «Снято с поставок» (среди обработанных): <b>{$countDiscontinued}</b>");
        $this->log("Источник цены: <b>ЧОП</b>: {$countByChop} | <b>обычная</b>: {$countByBase}");
        $this->log("Средняя цена до множителя: <b>{$avgBefore}</b>");
        $this->log("Средняя цена после: <b>{$avgAfter}</b> (мин: <b>{$minPriceAfter}</b>, макс: <b>{$maxPriceAfter}</b>)");
        $this->log("Распределение совпадений по типам:");
        $this->log("<pre>" . htmlspecialchars(print_r($this->typeBreakdown, true)) . "</pre>");

        if (!empty($this->notFoundVendors)) {
            $shown = count($this->notFoundVendors);
            $this->log("Примеры артикулов из файла, которых НЕТ в БД (показаны первые <b>{$shown}</b>):");
            $this->log("<pre>" . htmlspecialchars(implode(', ', $this->notFoundVendors)) . "</pre>");
        }
        $this->log('<hr>');
    }

    public function printTextUpdateRows(): string
    {
        return $this->textUpdateRows;
    }

    public function printCountUpdateRows(): int
    {
        return $this->countUpdateRows;
    }

    private function log(string $msg): void
    {
        echo $msg . "<br>\n";
        @ob_flush();
        @flush();
    }
}

echo "<style>body{font-family:monospace;font-size:13px;line-height:1.5}pre{background:#f4f4f4;padding:6px;border:1px solid #ddd}code{background:#f4f4f4;padding:1px 4px}</style>";

if (!isset($dbh) || !($dbh instanceof PDO)) {
    echo "<b style='color:red'>ОШИБКА: подключение к БД не установлено (\$dbh).</b>";
    exit;
}

$instance = new UpdateCatalog($dbh);
$instance->getCatalog($url, 'общий каталог Lion');

echo 'В БД обновлено <b>' . $instance->printCountUpdateRows() . '</b> позиций<hr>';
echo $instance->printTextUpdateRows();
