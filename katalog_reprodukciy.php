<?php
$keyw = "Каталог репродукций";
$titl = "Каталог репродукций";
$desc = "Каталог репродукций в Багетной мастерской №1";
include "header.php";
?>

<div id="crops"><a href="/">Главная</a> » Каталог репродукций</div>
<h1>Каталог репродукций</h1>
<div id="main" style="height:854px; overflow:hidden;">
    <div id='cl' class='cl0'>
        <?php
        $fa = file('base/reproduk.txt');
        for ($i = 0; $i < count($fa); $i++) {
            $b = explode(';', $fa[$i]);
            $link = rtrim($b[5]);
            echo "<a href='/katalog_reprodukciy/" . $link . ".html' class=\"catCard c" . $b[4] . "\">
							<div style=\"background:url('/reprodukmi/reprodukcya_" . $b[0] . ".jpg')no-repeat center,#333;\"></div>
							<br><strong>" . $b[1] . "</strong><br>" . $b[3] . "</a>";
        }
        ?>
    </div>
    <div id="pages">
        <?
        for ($i = 1; $i < 20; $i++) {
            echo '<span id="pages' . $i . '" onclick="switchpage(' . $i . ');">' . $i . '</span>';
        }
        ?>
    </div>
</div>
<div id="side">
    <h3>Каталог по авторам</h3>
    <div id='cl0' onclick="repFiltr(0);" class="catListSel">Все</div>
    <div id='cl1' onclick="repFiltr(1);" class="catList">Борис Ольшанский</div>
    <div id='cl2' onclick="repFiltr(2);" class="catList">Василий Кандинский</div>
    <div id='cl3' onclick="repFiltr(3);" class="catList">Виктор Васнецов</div>
    <div id='cl4' onclick="repFiltr(4);" class="catList">Винсент Ван Гог</div>
    <div id='cl5' onclick="repFiltr(5);" class="catList">Жак Жозеф Тиссо</div>
    <div id='cl6' onclick="repFiltr(6);" class="catList">Иван Айвазовский</div>
    <div id='cl7' onclick="repFiltr(7);" class="catList">Иван Шишкин</div>
    <div id='cl8' onclick="repFiltr(8);" class="catList">Леонардо да Винчи</div>
    <div id='cl9' onclick="repFiltr(9);" class="catList">Марк Шагал</div>
    <div id='cl10' onclick="repFiltr(10);" class="catList">Оскар Клод Моне</div>
    <div id='cl11' onclick="repFiltr(11);" class="catList">Пабло Пикассо</div>
    <div id='cl12' onclick="repFiltr(12);" class="catList">Рембранд</div>
    <div id='cl13' onclick="repFiltr(13);" class="catList">Рубенс</div>
    <div id='cl14' onclick="repFiltr(14);" class="catList">Сальвадор Дали</div>
    <div id='cl15' onclick="repFiltr(15);" class="catList">Сандро Ботичелли</div>
    <div id='cl16' onclick="repFiltr(16);" class="catList">Франциско Гойя</div>

    <?
    include "b3.php"
    ?>

    <script type="text/javascript">
        function repFiltr(id) {
            for (var i = 16; i >= 0; i--) {
                elem = document.getElementById('cl' + i);
                if (i == id) {
                    elem.className = "catListSel";
                    cl.className = 'cl' + i;
                } else {
                    elem.className = "catList";
                }
            }
            for (i = 1; i < 20; i++) {
                if (cl.offsetHeight > (i - 1) * 834) {
                    document.getElementById('pages' + i).style.display = '';
                } else {
                    document.getElementById('pages' + i).style.display = 'none';
                }
            }
            switchpage(1);
        }

        function switchpage(id) {
            cl.style.top = (-(id - 1) * 834) + 'px';
            for (i = 1; i < 20; i++) {
                document.getElementById('pages' + i).style.color = '#999';
                document.getElementById('pages' + i).style.fontWeight = '400';
            }
            document.getElementById('pages' + id).style.color = '#fff';
            document.getElementById('pages' + id).style.fontWeight = '700';
        }
    </script>