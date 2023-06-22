<?
/*
    Здесь только обновление с neoart
*/
require_once '../../base/connect.php';

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$xmlwood = simplexml_load_file("https://www.neoart.ru/api.php?login=Copymaster&pass=NeoVasukov777&action=xml&catalog=91");
$xmlplast = simplexml_load_file("https://www.neoart.ru/api.php?login=Copymaster&pass=NeoVasukov777&action=xml&catalog=92");
$xmlalum = simplexml_load_file("https://www.neoart.ru/api.php?login=Copymaster&pass=NeoVasukov777&action=xml&catalog=93");
$xmlpasp = simplexml_load_file("https://www.neoart.ru/api.php?login=Copymaster&pass=NeoVasukov777&action=xml&catalog=104");

echo "######################################### <br>";
$countInDbWood = 0;
// новое обновление цен дерево
foreach ($xmlwood->category->item as $item) {
    $s = strval($item->article);
    if (!isset($item->price->chop)) {
        $priceW[$s] = $item->price->base;
    } else {
        $priceW[$s] = $item->price->chop;
    }

    $countW[$s] = (int) $item->quantity->countse;
    $price = round($priceW[$s] * 3.5);
    $count = round($countW[$s]);

    $stm = $dbh->prepare("SELECT * FROM catalog_baget where vendor=?");
    $stm->bindParam(1, $s);
    $stm->execute();
    $data = $stm->fetchAll();
    $date_update = $date = date('Y-m-d H:i:s');
    $company = 'neoart';

    if ((is_countable($data) ? count($data) : 0) > 0) {
        $countInDbWood += 1;
        $stmt = $dbh->prepare("UPDATE catalog_baget SET price=?,storage=?,date_update=?,company=? WHERE vendor=?");
        $stmt->bindParam(1, $price);
        $stmt->bindParam(2, $count);
        $stmt->bindParam(3, $date_update);
        $stmt->bindParam(4, $company);
        $stmt->bindParam(5, $s);
        $stmt->execute();
        echo "обновление дерево -> " . $s . "<br>";
    }
}

echo "######################################### <br>";
$countInDbPlast = 0;
// новое обновление цен пластик
foreach ($xmlplast->category->item as $item) {
    $s = strval($item->article);
    if (!isset($item->price->chop)) {
        $priceW[$s] = $item->price->base;
    } else {
        $priceW[$s] = $item->price->chop;
    }

    $countW[$s] = (int) $item->quantity->countse;
    $price = round($priceW[$s] * 5);
    $count = round($countW[$s]);

    $stm = $dbh->prepare("SELECT * FROM catalog_baget where vendor=?");
    $stm->bindParam(1, $s);
    $stm->execute();
    $data = $stm->fetchAll();
    $date_update = $date = date('Y-m-d H:i:s');
    $company = 'neoart';

    if ((is_countable($data) ? count($data) : 0) > 0) {
        $countInDbPlast += 1;
        $stmt = $dbh->prepare("UPDATE catalog_baget SET price=?,storage=?,date_update=?,company=? WHERE vendor=?");
        $stmt->bindParam(1, $price);
        $stmt->bindParam(2, $count);
        $stmt->bindParam(3, $date_update);
        $stmt->bindParam(4, $company);
        $stmt->bindParam(5, $s);
        $stmt->execute();
        echo "обновление пластик -> " . $s . "<br>";
    }
}

echo "######################################### <br>";
$countInDbAlum = 0;
// новое обновление цен аллюминия
foreach ($xmlalum->category->item as $item) {
    $s = strval($item->article);
    if (!isset($item->price->chop)) {
        $priceW[$s] = $item->price->base;
    } else {
        $priceW[$s] = $item->price->chop;
    }

    $countW[$s] = (int) $item->quantity->countse;
    $price = round($priceW[$s] * 3.5);
    $count = round($countW[$s]);

    $stm = $dbh->prepare("SELECT * FROM catalog_baget where vendor=?");
    $stm->bindParam(1, $s);
    $stm->execute();
    $data = $stm->fetchAll();
    $date_update = $date = date('Y-m-d H:i:s');
    $company = 'neoart';

    if ((is_countable($data) ? count($data) : 0) > 0) {
        $countInDbAlum += 1;
        $stmt = $dbh->prepare("UPDATE catalog_baget SET price=?,storage=?,date_update=?,company=? WHERE vendor=?");
        $stmt->bindParam(1, $price);
        $stmt->bindParam(2, $count);
        $stmt->bindParam(3, $date_update);
        $stmt->bindParam(4, $company);
        $stmt->bindParam(5, $s);
        $stmt->execute();
        echo "обновление аллюминия -> " . $s . "<br>";
    }
}

echo "######################################### <br>";
$countInDbPasp = 0;
// новое обновление цен паспарту
foreach ($xmlpasp->category->item as $item) {
    $s = strval($item->article);
    if (!isset($item->price->chop)) {
        $priceW[$s] = $item->price->base;
    } else {
        $priceW[$s] = $item->price->chop;
    }

    $countW[$s] = (int) $item->quantity->countse;
    $price = round($priceW[$s] * 3.5);
    $count = round($countW[$s]);


    $stm = $dbh->prepare("SELECT * FROM catalog_baget where vendor=?");
    $stm->bindParam(1, $s);
    $stm->execute();
    $data = $stm->fetchAll();
    $date_update = $date = date('Y-m-d H:i:s');
    $company = 'neoart';

    if ((is_countable($data) ? count($data) : 0) > 0) {
        $countInDbPasp = $countInDbPasp + 1;
        $stmt = $dbh->prepare("UPDATE catalog_baget SET price=?,storage=?,date_update=?,company=? WHERE vendor=?");
        $stmt->bindParam(1, $price);
        $stmt->bindParam(2, $count);
        $stmt->bindParam(3, $date_update);
        $stmt->bindParam(4, $company);
        $stmt->bindParam(5, $s);
        $stmt->execute();
        echo "обновление паспарту -> " . $s . "<br>";
    }
}

echo "######################################### <br>";
echo "обновлено паспарту -> " . $countInDbPasp . "<br>";
echo "обновлено аллюминия -> " . $countInDbAlum . "<br>";
echo "обновлено пластик -> " . $countInDbPlast . "<br>";
echo "обновлено дерево -> " . $countInDbWood . "<br>";
