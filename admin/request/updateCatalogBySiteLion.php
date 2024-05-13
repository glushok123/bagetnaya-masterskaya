<?
ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
/*
    Здесь только обновление с lion
*/


require_once("SimpleXLS.php");

require_once '../../base/connect.php';

$url = "http://frame.ru/upload/medialibrary/2f3/LionArtService.xls"; //общий

class UpdateCatalog
{
    public $ch; //инициализация
    public $host = 'localhost'; // адрес сервера 
    public $database = 'a0458868_bagetnaya'; // имя базы данных
    //public $user = 'root'; // имя пользователя
    public $user = 'a0458868_bagetnaya'; // имя пользователя
    //public $password = ''; // пароль
    public $password = '1226591Qwer'; // пароль
    public $dbh; //название подключения к БД
    public $textUpdateRows = '';
    public $countUpdateRows = 0;

    /**
     * Подключение к БД
     */
    public function db_connect()
    {
        try {
            $this->dbh = new PDO("mysql:host=$this->host;dbname=a0458868_bagetnaya", $this->user, $this->password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Получение каталога
     */
    public function getCatalog($url, $typeDesc)
    {
        $nameFile = $typeDesc . '-' . time() . '-' . random_int(1, 9_999_999_999) . ".xls";

        $context = stream_context_create(array(
            'https' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
            )
        ));

        $data = file_get_contents($url, false, $context);
        file_put_contents('updateFileXlsx/' . $nameFile, $data);

        echo('<b>Загружен ' . $typeDesc . '</b><br>');
        $this->update($nameFile);
    }

    /**
     * обновление каталога
     */
    public function update($file)
    {
        $xls = SimpleXLS::parseFile('updateFileXlsx/' . $file);

        $count = 0;
        $countInDb = 0;
        $countWitheStorageIsNull = 0;
        $tables = [];
        $data = [];

        $countList = 0;
        $countListTest = 0;


        foreach ($xls->sheets as $worksheet) {
            $tables[] = $worksheet;
            $countList = $countList + 1;
        }

        // Цикл по листам Excel-файла
        while ($countListTest != $countList) {
            if ($countListTest == 0) {
                $dataArray = $xls->rows();
            } else {
                $dataArray = $xls->rows($countListTest);
            }
            foreach ($dataArray as $row) {
                if (
                    $row[0] == null ||
                    $row[2] == null ||
                    $row[4] == null ||
                    $row[0] == 'Артикул'
                ) {
                    continue;
                }

                $data[$row[0]] = [
                    'article' => $row[0],
                    'price' => $row[2],
                    'count' => $row[4],
                ];
            }
            $countListTest = $countListTest + 1;
        }

        foreach ($data as $item) {
            if (round((int)$item['count']) == 0) {
                $countWitheStorageIsNull = $countWitheStorageIsNull + 1;
            }

            $count = $count + 1;
            $vendor = $item['article'];
            $price = round(str_replace(',', '', (string)$item['price']));
            $countBaget = round(str_replace('>', '', (string)$item['count']));

            $multiplier = 5;

            $stm = $this->dbh->prepare("SELECT * FROM catalog_baget where vendor=?");
            $stm->bindParam(1, $vendor);
            $stm->execute();
            $data = $stm->fetchAll();
            $date_update = date('Y-m-d H:i:s');
            $company = 'lion';

            if (count($data) > 0) {
                if ($data[0]['type'] == 'alum' || $data[0]['type'] == 'pasp' || $data[0]['type'] == 'wood') {
                    $multiplier = 3.5;
                }

                if ($data[0]['type'] == 'plast') {
                    $multiplier = 5;
                }

                $price = round($price * $multiplier);

                $countInDb = $countInDb + 1;
                $stmt = $this->dbh->prepare("UPDATE catalog_baget SET price=?,storage=?,date_update=?,company=? WHERE vendor=?");
                $stmt->bindParam(1, $price);
                $stmt->bindParam(2, $countBaget);
                $stmt->bindParam(3, $date_update);
                $stmt->bindParam(4, $company);
                $stmt->bindParam(5, $vendor);
                $stmt->execute();
                $this->textUpdateRows = $this->textUpdateRows . "<br> обновление -> <b>" . $vendor . "</b> -> Цена: <b>" . $price . "</b> -> Количество: <b>" . $countBaget . '</b>';
                $this->countUpdateRows = $this->countUpdateRows + 1;
            }
        }

        $countWitheStorageIsNotNull = $count - $countWitheStorageIsNull;
        echo('<hr>');
        echo('Колличество элементов в файле: <b>' . $count . '</b><br>');
        echo('Колличество совпадений с Базой Данных: <b>' . $countInDb . '</b><br>');
        echo('Колличество в файле не в наличии: <b>' . $countWitheStorageIsNull . '</b><br>');
        echo('Колличество в файле в наличии: <b>' . $countWitheStorageIsNotNull . '</b><br><hr>');
    }

    public function printTextUpdateRows()
    {
        return $this->textUpdateRows;
    }

    public function printCountUpdateRows()
    {
        return $this->countUpdateRows;
    }

    /**
     * Красивый вывод массива
     *
     * @param string $var
     * @param null $_livel
     * @return string
     */
    public function outArray(mixed $array, $var = 'array', $_livel = null): string
    {
        $out = $margin = '';
        $nr = "<br>";
        $tab = "\t";

        if (is_null($_livel)) {
            $out .= '$' . $var . ' = ';
            if (!empty($array)) {
                $out .= $this->outArray($array, $var, 0);
            }
            $out .= ';';
        } else {
            for ($n = 1; $n <= $_livel; $n++) {
                $margin .= $tab;
            }
            $_livel++;

            if (is_array($array)) {
                $i = 1;
                $count = count($array);
                $out .= 'array(' . $nr;
                foreach ($array as $key => $row) {
                    $out .= $margin . $tab;
                    if (is_numeric($key)) {
                        $out .= $key . ' => ';
                    } else {
                        $out .= "'" . $key . "' => ";
                    }

                    if (is_array($row)) {
                        $out .= $this->outArray($row, $var, $_livel);
                    } elseif (is_null($row)) {
                        $out .= 'null';
                    } elseif (is_numeric($row)) {
                        $out .= $row;
                    } else {
                        $out .= "'" . addslashes((string)$row) . "'";
                    }

                    if ($count > $i) {
                        $out .= ',';
                    }

                    $out .= $nr;
                    $i++;
                }

                $out .= $margin . ')';
            } else {
                $out .= "'" . addslashes((string)$array) . "'";
            }
        }

        return $out;
    }
}

$instance = new UpdateCatalog();

$instance->db_connect();
$instance->getCatalog($url, 'общий каталог Lion');

echo('В БД обновлено <b>' . $instance->printCountUpdateRows() . '</b> багета');
echo('<hr>');
echo($instance->printTextUpdateRows());
