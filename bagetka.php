<?

if ($_GET['id']) {
    echo '<a href="bagetka.php?id=a">Сформированные заказы</a> - <a href="bagetka.php?id=b">Отправленные заказы</a> - <a href="bagetka.php?id=c">Лог</a><br>';
    if ($_GET['id'] == 'a') {
        $zak_hist = file('base/zakaz-history.txt');
        echo '<table border="1" style="border-collapse:collapse;"><tr><td width="100px">Дата</td><td width="100px">IP</td><td width="400px">Id заказа</td></tr>';
        for ($i = (is_countable($zak_hist) ? count($zak_hist) : 0) - 1; $i > 0; $i--) {
            $z = explode('-!-', $zak_hist[$i]);
            echo '<tr><td>' . $z[0] . '</td><td>' . $z[1] . '</td><td><a href="/baget_online?id=' . $z[2] . '">' . $z[2] . '</a></td></tr>';
        }
        echo '</table>';
    }
    if ($_GET['id'] == 'b') {
        $zak_hist = file('base/zakazend-history.txt');
        echo '<table border="1" style="border-collapse:collapse;"><tr><td width="100px">Дата</td><td width="100px">IP</td><td width="400px">Id заказа</td><td width="100px">Имя</td><td width="100px">Телефон</td><td width="100px">Email</td><td width="50px">Статус</td></tr>';
        for ($i = (is_countable($zak_hist) ? count($zak_hist) : 0) - 1; $i > 0; $i--) {
            $z = explode('-!-', $zak_hist[$i]);
            echo '<tr><td>' . $z[0] . '</td><td>' . $z[1] . '</td><td><a href="/baget_online?id=' . $z[2] . '">' . $z[2] . '</a></td><td>' . $z[3] . '</td><td>' . $z[4] . '</td><td>' . $z[5] . '</td><td>' . $z[6] . '</td></tr>';
        }
        echo '</table>';
    }
    if ($_GET['id'] == 'c') {
        $zak_hist = file('lo/g.txt');
        echo '<table border="1" style="border-collapse:collapse;"><tr><td width="100px">Дата</td><td width="100px">IP</td><td width="400px">Id</td><td width="200px">Статус</td></tr>';
        for ($i = (is_countable($zak_hist) ? count($zak_hist) : 0) - 1; $i > 0; $i--) {
            $z = explode(' ! ', $zak_hist[$i]);
            echo '<tr><td>' . $z[0] . '</td><td>' . $z[1] . '</td><td><a href="/baget_online?id=' . $z[2] . '">' . $z[2] . '</a></td><td>' . $z[3] . '</td></tr>';
        }
        echo '</table>';
    }
}
