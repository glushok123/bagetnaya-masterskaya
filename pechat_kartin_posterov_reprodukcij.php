<?php
$keywords = "Печать фотографий, купить репродукцию, постер в рамке";
$title = "Где купить репродукцию или постер в рамке?";
$description = "Профессиональная печать фотографий и оформление в стильные рамы в Багетной мастерской №1";
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
    <div class="container text-center">
        <div id="main">
            <style>
                #calc2 {
                    position: relative;
                    float: left;
                    width: 500px;
                    left: 50%;
                    margin-left: -250px;
                }

                #calc-wrap {
                    position: relative;
                    float: left;
                    width: 100%;
                }

                .calcblock {
                    position: relative;
                    float: left;
                    width: 100%;
                    margin: 5px 0 5px 0;
                    box-shadow: 0 0 4px 1px #003366;
                    background: #fff;
                }

                .calchefo {
                    text-align: center;
                    background: #bbddff;
                    font-size: 1.5em;
                    line-height: 2em;
                }

                .calcblockinfo {
                    position: relative;
                    float: left;
                    width: 100%;
                    height: 1.25em;
                    text-align: center;
                    background: #ddeeff;
                    border-bottom: solid 1px #003366;
                }

                #serv1, #serv21 {
                    background: url("/img/serv1_bg.jpg") no-repeat top;
                }
                #serv1, #serv21 {
                    background: url("/img/serv1_bg.jpg") no-repeat top;
                }

                #serv2, #serv22 {
                    background: url("/img/serv1_bg.jpg") no-repeat top;
                }

                #serv3, #serv23 {
                    background: url("/img/serv1_bg.jpg") no-repeat top;
                }

                #serv4, #serv24 {
                    background: url("/img/serv2_bg.jpg") no-repeat top;
                }

                #serv7, #serv27 {
                    background: url("/img/serv2_bg.jpg") no-repeat top;
                }

                #serv5, #serv25 {
                    background: url("/img/serv2_bg.jpg") no-repeat top;
                }

                #serv6, #serv26 {
                    background: url("/img/serv3_bg.jpg") no-repeat top;
                }

                .calcservs, .calcservsel {
                    position: relative;
                    float: left;
                    width: 25%;
                    height: 100px;
                    margin: 5px 0 5px 0;
                    cursor: pointer;
                    text-align: center;
                    color: #0033ff;
                }

                .calcservs {
                    font-size: 0.875em;
                }

                .calcservsel {
                    font-size: 0.875em;
                    text-shadow: 0 0 0.5px #0033ff;
                }

                .calcservs:hover, .calcservsel:hover {
                    color: #990000;
                }

                .calcservs span, .calcservsel span {
                    margin-top: 50px;
                    display: block;
                }

                .calcblock form {
                    display: block;
                    position: relative;
                    float: left;
                    height: 80px;
                    margin-top: 17px;
                    width: 40%;
                    text-align: center;
                }

                .calcblock form input {
                    width: 50px;
                    height: 20px;
                    margin: 2px;
                    padding: 0px;
                }

                .calcsize, .calcsizesel {
                    position: relative;
                    float: left;
                    width: 12%;
                    height: 80px;
                    margin-top: 5px;
                    cursor: pointer;
                    text-align: center;
                    color: #003366;
                    line-height: 80px;
                    font-size: 1.5em;
                }

                .calcsizesel {
                    font-weight: bold;
                }
                .calcsize:hover, .calcsizesel:hover {
                    color: #990000;
                }

                #calcsize0, #calcsize20 {
                    background: url("/img/calc_size_0.jpg") no-repeat center;
                }

                #calcsize1, #calcsize21 {
                    background: url("/img/calc_size_1.jpg") no-repeat center;
                }

                #calcsize2, #calcsize22 {
                    background: url("/img/calc_size_2.jpg") no-repeat center;
                }

                #calcsize3, #calcsize23 {
                    background: url("/img/calc_size_3.jpg") no-repeat center;
                }

                #calcsize4, #calcsize24 {
                    background: url("/img/calc_size_4.jpg") no-repeat center;
                }
            </style>
            <h1>ПЕЧАТЬ ФОТОГРАФИЙ, ПОСТЕРОВ И РЕПРОДУКЦИЙ</h1>

            <hr>
            <h5>Что такое – накатка на пенокартон? Давайте разбираться!</h5>
            <hr>

            <img src="/img/IMG_2029.PNG" align="right" width="200px">

            <p>
                Картина в интерьере освежает пространство, делает его уникальным и
                отражает характер своего обладателя. Но оригинальные картины художников,
                а также качественные реплики красками зачастую очень дорогие!
                Здесь приходит на помощь интерьерная печать картин и репродукций на бумаге или холсте!
            </p>

            <p>
                В «Багетной мастерской №1» Вы можете заказать постер в рамке или
                просто печать фотографий Вашей семьи, путешествий, важных сердцу событий!
            </p>

            <p>
                Если же Вы хотите украсить пространство картинами великих художников,
                Вы можете купить репродукцию на холсте или бумаге в нашей мастерской!
                Широкоформатная печать часто позволяет нам воссоздать оригинальные форматы произведения искусства.
            </p>

            <hr>
            <h5>КАК ЗАКАЗАТЬ ПЕЧАТЬ КАРТИНЫ:</h5>
            <hr>

            <img src="/img/IMG_2023.PNG" align="left" width="200px">
            <p>Необходим постер в рамке? Рассказываем, как оформить такой заказ: </p>

            <h5>1. Определите изображение. </h5>
            <p>
                Это может быть Ваше изображение, или Вы знаете название картины, которую хотите получить в распечатанном
                виде
            </p>

            <h5>2. Передайте изображение нашему менеджеру </h5>
            <p>
                Вы можете отправить фотографию на почту (здесь контакты) или отправить название картины художника в
                мессенджеры
            </p>

            <h5>3. Определитесь с оформлением</h5>
            <p>
                Нужно ли натянуть холст на подрамник? Постер должен быть в
                современном или классическом стиле? Все нюансы Вы можете оговорить
                с нашим дизайнером и запросить визуализацию будущего оформления!
            </p>

            <h5>4. Сообщите, из какого салона будете забирать готовую работу!</h5>
            <p>
                Салоны Багетной мастерской №1 находятся по 2 адресам на ст.м. Арбатская и ст.м. Новокузнецкая!
            </p>


            <? $cs = 4;
            include "calc.php" ?>

        </div>
    </div>
    <script>
        function showinfo(id) {
            if (id == 1) {
                document.getElementById("info").innerHTML = '<h2>Сколько это стоит?</h2><p>Рассчитать, во что обойдется оформить изображение в багетную рамку можно, воспользовавшись нашим <a href="/baget_online" class="t2">БАГЕТНЫМ КОНСТРУКТОРОМ</a>, там же вы можно посмотреть весь каталог багетных рамок и при желании сразу оформить заказ. </p><p>Узнать цены на обычные услуги нашей багетной мастерской можно в следующем мини-калькуляторе, просто выберите интересующую вас услугу и укажите размеры изображения:</p><div id="calc-wrap"><div id="calc"><div class="calcblock"><div class="calcblockinfo">Выберите интересующую вас услугу:</div><div id="serv1" class="calcservsel" onclick="makeprice(1);"><span>Печать<br>на холсте<br>300 г/м2</span></div> <div id="serv2" class="calcservs" onclick="makeprice(2);"><span>Печать<br>на матовой<br>200 г/м2</span></div> <div id="serv3" class="calcservs" onclick="makeprice(3);"><span>Печать<br>на глянцевой<br>250 г/м2</span></div><div id="serv7" class="calcservs" onclick="makeprice(7);"><span>Накатка<br>на пенокартон<br>для студентов</span></div><div id="serv4" class="calcservs" onclick="makeprice(4);"><span>Накатка<br>на пенокартон<br>5 мм</span></div><div id="serv5" class="calcservs" onclick="makeprice(5);"><span>Накатка<br>на пенокартон<br>10 мм</span></div><div id="serv6" class="calcservs" onclick="makeprice(6);"><span>Натяжка<br>на подрамник<br>50х18 мм</span></div></div><div class="calcblock"><div class="calcblockinfo">Выберите размеры и количество:</div><form name="form" onsubmit="return false;"><input type="text" id="widinp" name="wid" onchange="makeprice(0);" value="210" autocomplete="off">х<input type="text" id="heiinp" name="hei" onchange="makeprice(0);" value="297" autocomplete="off">мм<br><input type="text" id="numinp" name="num" onchange="makeprice(0);" value="1" autocomplete="off">шт</form><div id="calcsize4" class="calcsizesel" onclick="setsize(4);">А4</div><div id="calcsize3" class="calcsize" onclick="setsize(3);">А3</div><div id="calcsize2" class="calcsize" onclick="setsize(2);">А2</div><div id="calcsize1" class="calcsize" onclick="setsize(1);">А1</div><div id="calcsize0" class="calcsize" onclick="setsize(0);">А0</div></div><div class="calcblock calchefo"><strong><span style="color: #f00;" id="price">546</span>&nbsp;руб.</strong></div></div></div><p>Если с самостоятельным подсчетом заказа возникли затруднения, тогда напишите или позвоните нам и наш багетный мастер поможет рассчитать Ваш заказ. Электронная почта, телефон и схема проезда на странице <a href="/#contacts" class="t2">контакты</a>.</p><p>Стоимость доставки Вашего заказа по Москве – 600 рублей. Звоните, пишите, приезжайте - ждем Ваших заказов!</p><div class="infoclose" onclick="hideinfo();"></div>';
            }
            if (id == 2) {
                document.getElementById("info").innerHTML = '<h2>Как сделать и оплатить заказ?</h2>Сделать заказ в нашей Багетной Мастерской №1 можно несколькими способами:<ol><li>Заказ можно оформить в <a href="/baget_online" class="t2">БАГЕТНОМ КОНСТРУКТОРЕ</a>, там же можно расчитать стоимость работ, а так же посмотреть весь каталог багетных рамок.<br>В данном случае наш администратор непременно перезвонит Вам, уточнит параметры заказа и сообщит, когда можно будет подъехать и забрать его (по желанию оформляем доставку).</li><li>Можно приехать по адресу м.Новокузнецкая, Климентовский переулок, дом 6 (<a href="/#contacts" class="t2">схема проезда</a>) и оформить заказ на месте. Если у Вас небольшой заказ, то при наличии багета на складе, мы выполним его в Вашем присутствии за 20-30 минут. Только по предварительной записи по телефонам +7 (495) 951-77-51 или +7 (495) 504-73-04</li><li>Также, для Вашего удобства, у нас работает точка приема заказов по адресу: метро Октябрьская, Калужская площадь, дом 1, компания <a href="http://www.copymaster.biz/#contacts" class="t2" rel="nofollow">КОПИМАСТЕР</a> (100 метров от метро, отдельный вход прямо со стороны Ленинского проспекта)</li></ol><p>Частные лица могут оплачивать заказы наличными деньгами (в том числе банковской картой). Если Вы представитель юридического лица, то мы готовы выставить счет для оплаты по безналичному расчету.</p><div class="infoclose" onclick="hideinfo();"></div>';
            }
            if (id == 3) {
                document.getElementById("info").innerHTML = '<h2>Что мы делаем?</h2><p>Мы оформляем в багетные рамки постеры, фотографии, изображения, вышивки и многое другое. Варианты багетных рамок можно посмотреть в нашем <a href="/baget_online" class="t2">БАГЕТНОМ КОНСТРУКТОРЕ</a>, там же вы cможете посчитать цену работы и при желании сразу оформить заказ.</p><p>Мы печатаем на холсте, на глянцевой и матовой бумаге любые форматы изображений.</p><p>Мы делаем красивые модульные картины для Вашего интерьера.</p><p>Мы накатываем на пенокартон, делаем натяжку на подрамник, предоставляем услуги дизайнера.</p><p>А самое главное – мы рядом с м.Новокузнецкая и м.Третьяковская. Схему проезда можно посмотреть на странице <a href="/#contacts" class="t2">контакты</a>.</p><div class="infoclose" onclick="hideinfo();"></div>';
            }
            document.getElementById("info").className = 'infoshow';
            document.getElementById('info_shade').className = 'infoshow';
        }

        function hideinfo() {
            document.getElementById("info").className = 'infohide';
            document.getElementById('info_shade').className = 'infohide';
        }

        var lastserv = "1";
        var lastsize = "4";
        var questresult = '';

        function makeprice(id, ib) {
            finalprice = 0;
            if (id == "0") {
                id = lastserv;
            }
            if (ib) {
                document.getElementById('serv2' + lastserv).className = 'calcservs';
                lastserv = id;
                document.getElementById('serv2' + lastserv).className = 'calcservsel';
                x = Number(document.getElementById('widinp2').value);
                y = Number(document.getElementById('heiinp2').value);
                n = Number(document.getElementById('numinp2').value);
            } else {
                document.getElementById('serv' + lastserv).className = 'calcservs';
                lastserv = id;
                document.getElementById('serv' + lastserv).className = 'calcservsel';
                x = Number(document.getElementById('widinp').value);
                y = Number(document.getElementById('heiinp').value);
                n = Number(document.getElementById('numinp').value);
            }
            if (x > 1000 || y > 1000) {
                if (x >= y) {
                    z = x;
                } else {
                    z = y;
                }
            } else {
                if (x >= y) {
                    z = y;
                } else {
                    z = x;
                }
            }
            s = x * y;

            if (id == "1") {
                finalprice = s * 0.007;
            }
            if (id == "2") {
                finalprice = x * y * 0.0035;
            }
            if (id == "3") {
                finalprice = x * y * 0.004;
            }
            if (id == "4") {
                finalprice = x * y * 0.004;
            }
            if (id == "7") {
                finalprice = x * y * 0.0016 * 1.3 * 0.9;
            }
            if (id == "5") {
                finalprice = x * y * 0.0025 * 1.3;
            }
            if (id == "6") {
                finalprice = x * y * 0.0035;
            }
            finalprice = n * finalprice;
            finalprice = Math.round(finalprice);
            if (ib) {
                document.getElementById('price2').innerHTML = finalprice;
            } else {
                document.getElementById('price').innerHTML = finalprice;
            }
            return;
        }

        function setsize(id, ib) {

            if (ib) {
                document.getElementById('calcsize2' + lastsize).className = 'calcsize';
                lastsize = id;
                document.getElementById('calcsize2' + lastsize).className = 'calcsizesel';
            } else {
                document.getElementById('calcsize' + lastsize).className = 'calcsize';
                lastsize = id;
                document.getElementById('calcsize' + lastsize).className = 'calcsizesel';
            }
            if (id == "0") {
                x = 841;
                y = 1189;
            }
            if (id == "1") {
                x = 594;
                y = 841;
            }
            if (id == "2") {
                x = 420;
                y = 594;
            }
            if (id == "3") {
                x = 297;
                y = 420;
            }
            if (id == "4") {
                x = 210;
                y = 297;
            }
            if (ib) {
                document.getElementById('widinp2').value = x;
                document.getElementById('heiinp2').value = y;
                makeprice(0, 1);
            } else {
                document.getElementById('widinp').value = x;
                document.getElementById('heiinp').value = y;
                makeprice(0);
            }
        }

        function getXmlHttp() {
            var xmlhttp;
            try {
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (E) {
                    xmlhttp = false;
                }
            }
            if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
                xmlhttp = new XMLHttpRequest();
            }
            return xmlhttp;
        }

        function quest(id) {
            var quests = document.getElementsByClassName('quest');
            var rads = document.getElementsByName('q' + id);
            for (var i = 0; i < rads.length; i++) {
                if (rads[i].checked) {
                    questresult += (i + 1) + 'l';
                    quests[id - 1].style.display = "none";
                    quests[id].style.display = "block";
                    if (id == 8) {
                        var req = getXmlHttp();
                        var url = '/sendquest.php?id=' + questresult;
                        req.open('GET', url, true);
                        req.send(null);
                    }
                }
            }
            ;
        }

    </script>
<?

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>