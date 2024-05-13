<?
$host = 'localhost'; // адрес сервера 
$database = 'a0458868_bagetnaya'; // имя базы данных
$user = 'a0458868_bagetnaya'; // имя пользователя
$password = '1226591Qwer'; // пароль

function testdb_connect($host, $user, $password)
{
    $dbh = new PDO("mysql:host=$host;dbname=a0458868_bagetnaya", $user, $password);
    return $dbh;
}

try {
    $dbh = testdb_connect($host, $user, $password);
    // echo 'Connected to database';
} catch (PDOException $e) {
    echo $e->getMessage();
}
