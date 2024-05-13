<?php
$keyw = "Контакты";
$titl = "Контакты";
$desc = "Контакты";
include "header.php"
?>

    <div id="crops"><a href="/">Главная</a> » Контакты</div>
    <a name="main"></a>
    <h1>Контакты</h1>
    <div id="main">
        <div style="text-align:left;" itemscope itemtype="http://schema.org/LocalBusiness">
            <p><strong itemprop="name">Багетная мастерская №1</strong></p>
            <p><strong>Время работы: </strong>
                <time itemprop="openingHours" datetime="Mo-Su 9:00−21:00">9:00 - 21:00, ежедневно</time>
            </p>
            <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><strong>Адрес:</strong> <span
                        itemprop="addressLocality">Москва</span>, м. Новокузнецкая, <span itemprop="streetAddress">Климентовский переулок, 6</span>
            </p>
            <p><strong>Телефоны:</strong><span itemprop="telephone">+7 495 504-73-04</span>, <span itemprop="telephone">+7 495 951-77-51</span>
            </p>
            <p><strong>Электронная почта:</strong> <span itemprop="email" style="white-space:nowrap;"> manager@bagetnaya-masterskaya.com</span>
            </p>
        </div>
        <div class="yamap">
            <script type="text/javascript" charset="utf-8"
                    src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=XD1WoHwePr9BAYkPBJ0XKFzAScY0NCvr&height=450"></script>
        </div>
    </div>
    <div id="side">
        <h3>Смотрите также</h3>
        <a href="/dostavka.html" class="fast1">Доставка</a>

<? include "bot.php" ?>