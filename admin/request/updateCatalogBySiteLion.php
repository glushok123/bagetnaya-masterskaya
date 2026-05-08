<?
ini_set('max_execution_time', '300'); // 300 сек = 5 мин
ini_set('error_reporting', (string)E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

/*
    Обновление каталога по выгрузке Lion (XLS).
    Источник: общий XLS-фид Lion → парсинг → обновление price/storage в catalog_baget.
*/

require_once("SimpleXLS.php");
require_once '../../base/connect.php';

$url = "http://frame.ru/upload/medialibrary/2f3/LionArtService.xls"; // общий XLS-фид

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

        $nameFile = $typeDesc . '-' . time() . '-' . random_int(1, 9_999_999_999) . ".xls";
        $dir = __DIR__ . '/updateFileXlsx';
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }
        $localPath = $dir . '/' . $nameFile;

        $this->log("Скачивание файла...");
        $downloadStart = microtime(true);
        $context = stream_context_create([
            'http' => ['method' => 'GET', 'timeout' => 60],
        ]);
        $data = @file_get_contents($url, false, $context);
        $downloadTime = round(microtime(true) - $downloadStart, 2);

        if ($data === false) {
            $this->log("<b style='color:red'>ОШИБКА: не удалось скачать файл по URL.</b>");
            return;
        }
        $size = strlen($data);
        $this->log("Скачано: <b>" . number_format($size) . "</b> байт за <b>{$downloadTime}</b> сек.");

        if ($size < 1024) {
            $this->log("<b style='color:orange'>ВНИМАНИЕ: файл подозрительно мал (&lt; 1 КБ). Возможно URL отдал ошибку.</b>");
        }

        file_put_contents($localPath, $data);
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
        $xls = SimpleXLS::parseFile(__DIR__ . '/updateFileXlsx/' . $file);
        if ($xls === false) {
            $this->log("<b style='color:red'>ОШИБКА парсинга XLS: " . htmlspecialchars(SimpleXLS::parseError()) . "</b>");
            return;
        }
        $parseTime = round(microtime(true) - $parseStart, 2);

        $countList = is_array($xls->sheets) ? count($xls->sheets) : 0;
        $this->log("Парсинг XLS: <b>{$parseTime}</b> сек. Листов: <b>{$countList}</b>");

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
            $this->log("Лист #{$sheetIdx}: строк <b>{$sheetRows}</b>");

            $kept = 0;
            foreach ($rows as $row) {
                if (
                    $row[0] == null ||
                    $row[2] == null ||
                    $row[4] == null ||
                    $row[0] == 'Артикул'
                ) {
                    $countSkippedRows++;
                    continue;
                }

                $article = trim((string)$row[0]);
                $rawData[$article] = [
                    'article'  => $article,
                    'price'    => $row[2],
                    'priceTop' => $row[7] ?? null,
                    'count'    => $row[4],
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

        foreach ($rawData as $item) {
            if (round((int)$item['count']) == 0) {
                $countWitheStorageIsNull++;
            }
            $count++;

            $vendor      = $item['article'];
            $priceRaw    = (int)round((float)str_replace(',', '', (string)$item['price']));
            $priceTopRaw = (int)round((float)str_replace(',', '', (string)$item['priceTop']));
            $countBaget  = (int)round((float)str_replace('>', '', (string)$item['count']));

            // Если задан priceTop — он приоритетнее
            $price = !empty($priceTopRaw) ? $priceTopRaw : $priceRaw;
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
            $multiplier = match ($type) {
                'alum'         => 6,
                'pasp', 'wood' => 3.5,
                'plast'        => 5,
                default        => 5,
            };
            $key = isset($this->typeBreakdown[$type]) ? $type : 'unknown';
            $this->typeBreakdown[$key]++;

            $finalPrice = (int)round($price * $multiplier);
            $sumPriceAfter += $finalPrice;
            if ($finalPrice < $minPriceAfter) $minPriceAfter = $finalPrice;
            if ($finalPrice > $maxPriceAfter) $maxPriceAfter = $finalPrice;
            $countInDb++;

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
                $fixedNote = ((int)$row['fixed_price'] === 1) ? " <i>[fixed_price=1, цена не менялась]</i>" : '';
                $this->textUpdateRows .= "<br>обновление -> <b>{$vendor}</b> [{$type}, ×{$multiplier}] -> Цена: <b>{$finalPrice}</b> -> Кол-во: <b>{$countBaget}</b>{$fixedNote}";
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
        $this->log("Не в наличии (count=0): <b>{$countWitheStorageIsNull}</b>");
        $this->log("В наличии: <b>{$countWitheStorageIsNotNull}</b>");
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
