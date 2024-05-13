<div id="calc-wrap">
    <div id="calc2">
        <!--<div class="calcblock calchefo">Расчет цены</div>-->
        <div class="calcblock">
            <div class="calcblockinfo">Выберите интересующую вас услугу:</div>
            <div id="serv21" class="calcservsel" onclick="makeprice('1',1);">
                <span>Печать<br>на холсте<br>300 г/м2</span></div>
            <div id="serv22" class="calcservs" onclick="makeprice('2',1);"><span>Печать<br>на матовой<br>200 г/м2</span>
            </div>
            <div id="serv23" class="calcservs" onclick="makeprice('3',1);">
                <span>Печать<br>на глянцевой<br>250 г/м2</span></div>
            <!--div id="serv27" class="calcservs" onclick="makeprice('7',1);"><span>Накатка<br>на пенокартон<br>для студентов</span></div-->
            <div id="serv24" class="calcservs" onclick="makeprice('4',1);"><span>Накатка<br>на пенокартон<br>5 мм</span>
            </div>
            <!--div id="serv25" class="calcservs" onclick="makeprice('5',1);"><span>Накатка<br>на пенокартон<br>10 мм</span></div-->
            <div id="serv26" class="calcservs" onclick="makeprice('6',1);">
                <span>Натяжка<br>на подрамник<br>50х18 мм</span></div>
        </div>
        <div class="calcblock">
            <div class="calcblockinfo">Выберите размеры и количество:</div>
            <form name="form" onsubmit="return false;">
                <input type="text" id="widinp2" name="wid" onchange="makeprice(0,1);" value="210" autocomplete="off">х
                <input type="text" id="heiinp2" name="hei" onchange="makeprice(0,1);" value="297"
                       autocomplete="off">мм<br>
                <input type="text" id="numinp2" name="num" onchange="makeprice(0,1);" value="1" autocomplete="off">шт
            </form>
            <div id="calcsize24" class="calcsizesel" onclick="setPrice2('a4')">А4</div>
            <div id="calcsize23" class="calcsize" onclick="setPrice2('a3');">А3</div>
            <div id="calcsize22" class="calcsize" onclick="setPrice2('a2');">А2</div>
            <div id="calcsize21" class="calcsize" onclick="setPrice2('a1');">А1</div>
            <div id="calcsize20" class="calcsize" onclick="setPrice2('a0');">А0</div>
        </div>
        <div class="calcblock calchefo">
            <strong><span style="color: #f00;" id="price2">1100</span>&nbsp;руб.</strong>
        </div>
    </div>
</div>

<?
if ($cs == 4) {
    echo "<script>window.onload = function(){makeprice('4',1);};</script>";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function setPrice2(size) {
        serv21 = { //холст
            'a4': 800,
            'a3': 1000,
            'a2': 1500,
            'a1': 3000,
            'a0': 6000
        };
        serv22 = { //матовая
            'a4': 300,
            'a3': 400,
            'a2': 600,
            'a1': 1200,
            'a0': 2400
        };
        serv23 = { //глянцевой
            'a4': 800,
            'a3': 100,
            'a2': 1200,
            'a1': 2400,
            'a0': 3600
        };
        serv24 = { //пенокартон
            'a4': 550,
            'a3': 850,
            'a2': 1400,
            'a1': 2700,
            'a0': 4000
        };
        serv26 = { //подрамник
            'a4': 550,
            'a3': 850,
            'a2': 1400,
            'a1': 2700,
            'a0': 3700
        };

        let activeMaterial = $('.calcservsel');

        if (activeMaterial.attr('id') == "serv21") {
            document.getElementById('price2').innerHTML = serv21[size];
        } else if (activeMaterial.attr('id') == "serv22") {
            document.getElementById('price2').innerHTML = serv22[size];
        } else if (activeMaterial.attr('id') == "serv23") {
            document.getElementById('price2').innerHTML = serv23[size];
        } else if (activeMaterial.attr('id') == "serv24") {
            document.getElementById('price2').innerHTML = serv24[size];
        } else if (activeMaterial.attr('id') == "serv26") {
            document.getElementById('price2').innerHTML = serv26[size];
        }
    }
</script>