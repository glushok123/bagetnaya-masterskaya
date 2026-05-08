<?
/*
    Обновление каталога по XML-фидам Neoart.
    Источник: 4 XML-каталога (дерево/пластик/алюминий/паспарту) → парсинг → обновление price/storage в catalog_baget.
    Если артикул не найден И содержит .QP/.QA/.QD/.IQ/.IK — пытаемся найти укороченный артикул, переименовать и обновить.
*/

require_once '../../base/connect.php';

ini_set('error_reporting', (string)E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
ini_set('max_execution_time', '300');

if (!isset($dbh) || !($dbh instanceof PDO)) {
    echo "<b style='color:red'>ОШИБКА: подключение к БД не установлено (\$dbh).</b>";
    exit;
}
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// === Конфигурация каталогов ===
$apiBase = "https://www.neoart.ru/api.php";
$apiAuth = "login=Copymaster&pass=Bagetnaya20130713!!&action=xml";

$catalogs = [
    [
        'name'       => 'дерево',
        'id'         => 91,
        'multiplier' => 3.5,
        'priceField' => 'auto',  // chop приоритетнее, иначе base
    ],
    [
        'name'       => 'пластик',
        'id'         => 92,
        'multiplier' => 5,
        'priceField' => 'base',  // только base (как в исходной логике)
    ],
    [
        'name'       => 'аллюминий',
        'id'         => 93,
        'multiplier' => 6,
        'priceField' => 'auto',
    ],
    [
        'name'       => 'паспарту',
        'id'         => 104,
        'multiplier' => 5,
        'priceField' => 'auto',
    ],
];

$qpSuffixes = ['.QP', '.QA', '.QD', '.IQ', '.IK'];

// === Стартовый блок ===
echo "<style>body{font-family:monospace;font-size:13px;line-height:1.5}pre{background:#f4f4f4;padding:6px;border:1px solid #ddd}code{background:#f4f4f4;padding:1px 4px}table{border-collapse:collapse;margin-top:8px}th,td{padding:4px 10px}</style>";
echo "<h2>🚀 Старт обновления каталогов Neoart</h2>";
echo "Дата запуска: <b>" . date('Y-m-d H:i:s') . "</b><br>";
echo "PHP: <b>" . PHP_VERSION . "</b>, OS: <b>" . PHP_OS_FAMILY . "</b><br>";
echo "Каталогов к обработке: <b>" . count($catalogs) . "</b><br>";

$totalStart   = microtime(true);
$globalStats  = [];
$changeIndex  = [];

foreach ($catalogs as $cat) {
    $catStart = microtime(true);
    echo "<hr>";
    echo "<h3>📦 Каталог: <b>{$cat['name']}</b> (id={$cat['id']}, ×{$cat['multiplier']}, price={$cat['priceField']})</h3>";

    $url = "{$apiBase}?{$apiAuth}&catalog={$cat['id']}";
    echo "URL: <code>" . htmlspecialchars($url) . "</code><br>";

    echo "Загрузка XML...<br>";
    $loadStart = microtime(true);
    $xml = @simplexml_load_file($url);
    $loadTime = round(microtime(true) - $loadStart, 2);

    if ($xml === false) {
        echo "<b style='color:red'>❌ Ошибка загрузки/парсинга XML</b><br>";
        $globalStats[$cat['name']] = ['error' => true];
        continue;
    }
    echo "✅ XML загружен за <b>{$loadTime}</b> сек.<br>";

    $items      = $xml->category->item ?? [];
    $totalItems = is_countable($items) ? count($items) : 0;
    echo "Всего &lt;item&gt; в фиде: <b>{$totalItems}</b><br><br>";

    $stat = [
        'total'           => $totalItems,
        'updated'         => 0,
        'rowCountUpdated' => 0,
        'renamed'         => 0,
        'notFound'        => 0,
        'notFoundList'    => [],
        'skippedEmpty'    => 0,
        'sqlErrors'       => 0,
    ];

    foreach ($items as $item) {
        $s = trim((string)$item->article);
        if ($s === '') {
            $stat['skippedEmpty']++;
            continue;
        }

        // Выбор цены
        if ($cat['priceField'] === 'base') {
            $rawPrice = (float)$item->price->base;
        } else {
            $rawPrice = isset($item->price->chop)
                ? (float)$item->price->chop
                : (float)$item->price->base;
        }

        $price = (int)round($rawPrice * $cat['multiplier']);
        $count = (int)round((float)$item->quantity->countse);

        try {
            $stm = $dbh->prepare("SELECT id FROM catalog_baget WHERE vendor = ?");
            $stm->execute([$s]);
            $row = $stm->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<b style='color:red'>SQL SELECT ошибка для vendor={$s}: " . htmlspecialchars($e->getMessage()) . "</b><br>";
            $stat['sqlErrors']++;
            continue;
        }

        if ($row) {
            // прямое совпадение → обновляем
            try {
                $stmt = $dbh->prepare(
                    "UPDATE catalog_baget
                        SET price = IF(fixed_price = 1, price, ?),
                            storage = ?,
                            date_update = ?,
                            company = ?
                      WHERE vendor = ?"
                );
                $stmt->execute([$price, $count, date('Y-m-d H:i:s'), 'neoart', $s]);
                $stat['updated']++;
                if ($stmt->rowCount() > 0) {
                    $stat['rowCountUpdated']++;
                }
                echo "обновление {$cat['name']} -> <b>{$s}</b> (цена {$price}, кол-во {$count})<br>";
            } catch (PDOException $e) {
                echo "<b style='color:red'>SQL UPDATE ошибка для vendor={$s}: " . htmlspecialchars($e->getMessage()) . "</b><br>";
                $stat['sqlErrors']++;
            }
            continue;
        }

        // Прямого совпадения нет → проверим суффиксы .QP/.QA/.QD/.IQ/.IK
        $hasSuffix = false;
        foreach ($qpSuffixes as $suf) {
            if (strpos($s, $suf) !== false) {  // ФИКС: было strpos(...) без !== false
                $hasSuffix = true;
                break;
            }
        }

        if ($hasSuffix && strlen($s) > 3) {
            $artOriginal = $s;
            $artShort    = substr($s, 0, -3);

            try {
                $stm = $dbh->prepare("SELECT id FROM catalog_baget WHERE vendor = ?");
                $stm->execute([$artShort]);
                $rowShort = $stm->fetch(PDO::FETCH_ASSOC);

                if ($rowShort) {
                    // переименовать укороченный → полный
                    $stmt = $dbh->prepare("UPDATE catalog_baget SET vendor = ? WHERE vendor = ?");
                    $stmt->execute([$artOriginal, $artShort]);

                    $changeIndex[] = [$artShort, $artOriginal];
                    $stat['renamed']++;

                    // и сразу обновить цену/остаток (в исходнике этого не было — поэтому обновление отставало на 1 запуск)
                    $stmt = $dbh->prepare(
                        "UPDATE catalog_baget
                            SET price = IF(fixed_price = 1, price, ?),
                                storage = ?,
                                date_update = ?,
                                company = ?
                          WHERE vendor = ?"
                    );
                    $stmt->execute([$price, $count, date('Y-m-d H:i:s'), 'neoart', $artOriginal]);
                    $stat['updated']++;
                    if ($stmt->rowCount() > 0) {
                        $stat['rowCountUpdated']++;
                    }
                    echo "🔄 переименован <b>{$artShort}</b> -> <b>{$artOriginal}</b> + обновление (цена {$price}, кол-во {$count})<br>";
                    continue;
                }
            } catch (PDOException $e) {
                echo "<b style='color:red'>SQL ошибка при переименовании для {$s}: " . htmlspecialchars($e->getMessage()) . "</b><br>";
                $stat['sqlErrors']++;
                continue;
            }
        }

        // не нашли никак
        $stat['notFound']++;
        if (count($stat['notFoundList']) < 30) {
            $stat['notFoundList'][] = $s;
        }
    }

    $catTime = round(microtime(true) - $catStart, 2);
    echo "<br><b>📊 Статистика по {$cat['name']}:</b><br>";
    echo "Всего в фиде: <b>{$stat['total']}</b><br>";
    echo "Обновлено: <b>{$stat['updated']}</b><br>";
    echo "Реально изменили строки (rowCount&gt;0): <b>{$stat['rowCountUpdated']}</b><br>";
    echo "Переименовано (короткий → полный): <b>{$stat['renamed']}</b><br>";
    echo "Не найдено в БД: <b>{$stat['notFound']}</b><br>";
    echo "Пропущено (пустой артикул): <b>{$stat['skippedEmpty']}</b><br>";
    echo "SQL-ошибок: <b>{$stat['sqlErrors']}</b><br>";
    echo "Время обработки: <b>{$catTime}</b> сек.<br>";

    if (!empty($stat['notFoundList'])) {
        $shown = count($stat['notFoundList']);
        echo "Примеры артикулов из фида, которых НЕТ в БД (первые <b>{$shown}</b>):";
        echo "<pre>" . htmlspecialchars(implode(', ', $stat['notFoundList'])) . "</pre>";
    }

    $globalStats[$cat['name']] = $stat;
    @ob_flush();
    @flush();
}

$totalTime = round(microtime(true) - $totalStart, 2);

echo "<hr><h2>🏁 Итоговая сводка (за {$totalTime} сек.)</h2>";
echo "<table border='1' cellpadding='6' cellspacing='0'>";
echo "<tr style='background:#eee'>"
    . "<th>Каталог</th><th>В фиде</th><th>Обновлено</th><th>rowCount&gt;0</th>"
    . "<th>Переименовано</th><th>Не найдено</th><th>Пустых</th><th>SQL-ошибок</th>"
    . "</tr>";

$sumTotal = $sumUpdated = $sumRow = $sumRenamed = $sumNotFound = 0;
foreach ($globalStats as $name => $s) {
    if (!empty($s['error'])) {
        echo "<tr><td>{$name}</td><td colspan='7' style='color:red'>ОШИБКА ЗАГРУЗКИ XML</td></tr>";
        continue;
    }
    echo "<tr>"
        . "<td><b>{$name}</b></td>"
        . "<td align='right'>{$s['total']}</td>"
        . "<td align='right'>{$s['updated']}</td>"
        . "<td align='right'>{$s['rowCountUpdated']}</td>"
        . "<td align='right'>{$s['renamed']}</td>"
        . "<td align='right'>{$s['notFound']}</td>"
        . "<td align='right'>{$s['skippedEmpty']}</td>"
        . "<td align='right'>{$s['sqlErrors']}</td>"
        . "</tr>";
    $sumTotal    += $s['total'];
    $sumUpdated  += $s['updated'];
    $sumRow      += $s['rowCountUpdated'];
    $sumRenamed  += $s['renamed'];
    $sumNotFound += $s['notFound'];
}
echo "<tr style='background:#f9f9f9;font-weight:bold'>"
    . "<td>ИТОГО</td>"
    . "<td align='right'>{$sumTotal}</td>"
    . "<td align='right'>{$sumUpdated}</td>"
    . "<td align='right'>{$sumRow}</td>"
    . "<td align='right'>{$sumRenamed}</td>"
    . "<td align='right'>{$sumNotFound}</td>"
    . "<td>—</td><td>—</td>"
    . "</tr>";
echo "</table>";

echo "<br>Всего переименований за прогон: <b>" . count($changeIndex) . "</b><br>";
if (!empty($changeIndex)) {
    echo "<details><summary>Показать список переименований</summary>";
    echo "<pre>" . htmlspecialchars(print_r($changeIndex, true)) . "</pre>";
    echo "</details>";
}
