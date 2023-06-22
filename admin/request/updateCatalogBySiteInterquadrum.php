<?
ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
/*
    Здесь только обновление с interquadrum
*/
require_once("SimpleXLSX.php");
require_once '../../base/connect.php';

$wood_url = "https://interquadrum.ru/tools/downloadFile.php?type=catalogFilter&catalog=26&path=/catalog/baget-wood/"; //деревянный
$plastic_url = "https://interquadrum.ru/tools/downloadFile.php?type=catalogFilter&catalog=25&path=/catalog/baget-wood/"; //пластиковый
$paspartu_url = "https://interquadrum.ru/tools/downloadFile.php?type=catalogFilter&catalog=27&path=/catalog/carton/"; //паспарту
class UpdateCatalog
{
    public $url = 'https://interquadrum.ru/personal/?login=yes'; //ссылка на авторизацию
    public $ch; //инициализация
    public $host = 'localhost'; // адрес сервера 
    public $database = 'a0458868_bagetnaya'; // имя базы данных
    public $user = 'a0458868_bagetnaya'; // имя пользователя
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
     * Авторизация на сайте
     */
    public function auth()
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $this->url); // отправляем на
        curl_setopt($this->ch, CURLOPT_HEADER, 0); // пустые заголовки
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1); // возвратить то что вернул сервер
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1); // следовать за редиректами
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 30); // таймаут4
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false); // просто отключаем проверку сертификата
        curl_setopt($this->ch, CURLOPT_POST, 1); // использовать данные в post
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, ['AUTH_FORM' => 'Y', 'TYPE' => 'AUTH', 'backurl' => '/personal/', 'USER_LOGIN' => 'manager@bagetnaya-masterskaya.com', 'USER_PASSWORD' => 'fuckyourapax2202', 'Login' => 'Войти']);
        $data = curl_exec($this->ch);

        return $this->isAuth($data);
    }

    //О том, что мы авторизовались будем судить по наличию формы logout
    public function isAuth($data)
    {
        return strpos((string) $data, 'Выход') ? true : false;
    }

    /**
     * Получение каталога
     */
    public function getCatalog($url, $typeName)
    {
        $nameFile = $typeName . '-' . time() . '-' . random_int(1, 9_999_999_999) . ".xlsx";
        curl_setopt($this->ch, CURLOPT_URL, $url); // отправляем на
        $out = curl_exec($this->ch);
        $bite = fopen('updateFileXlsx/' . $nameFile, 'wb');
        fwrite($bite, $out);
        fclose($bite);

        echo ('<b>Загружен ' . $typeName . '</b><br>');
        $this->update($nameFile);
    }

    /**
     * обновление каталога
     */
    public function update($file)
    {
        $xlsx = SimpleXLSX::parse('updateFileXlsx/' . $file);

        $count = 0;
        $countInDb = 0;
        $countWitheStorageIsNull = 0;

        foreach ($xlsx->rows() as $item) {
            if (round( (int) $item[6]) == 0) {
                $countWitheStorageIsNull = $countWitheStorageIsNull + 1;
            }

            $count = $count + 1;

            $vendor = $item[0];
            $price = (int) $item[2];
            $price = round($price * 5);
            $countBaget = round( (int) $item[6]);

            $stm = $this->dbh->prepare("SELECT * FROM catalog_baget where vendor=?");
            $stm->bindParam(1, $vendor);
            $stm->execute();
            $data = $stm->fetchAll();
            $date_update = $date = date('Y-m-d H:i:s');
            $company = 'interquadrum';

            if ((is_countable($data) ? count($data) : 0) > 0) {
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

        echo ('Колличество строк в файле: <b>' . $count . '</b><br>');
        echo ('Колличество совпадений с Базой Данных: <b>' . $countInDb . '</b><br>');
        echo ('Колличество в файле не в наличии: <b>' . $countWitheStorageIsNull . '</b><br>');
        echo ('Колличество в файле в наличии: <b>' . $countWitheStorageIsNotNull . '</b><br><hr>');
    }

    public function printTextUpdateRows()
    {
        return $this->textUpdateRows;
    }

    public function printCountUpdateRows()
    {
        return $this->countUpdateRows;
    }
}

$instance = new UpdateCatalog();

if ($instance->auth() == true) {
    echo 'Успешная авторизация' . '<br><hr>';
} else {
    echo 'Авторизация не прошла' . '<br><hr>';
    return;
}

$instance->db_connect();
$instance->getCatalog($wood_url, 'wood');
$instance->getCatalog($plastic_url, 'plastic');
$instance->getCatalog($paspartu_url, 'pasp');

echo ('В БД обновлено <b>' . $instance->printCountUpdateRows() . '</b> багета');
echo ('<hr>');
echo ($instance->printTextUpdateRows());
