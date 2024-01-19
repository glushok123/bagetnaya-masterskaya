<?php
$keywords = "контакты багетной мастерской, адрес багетной мастерской, багетная мастерская на карте";
$title = "Контакты багетной мастерской в Москве";
$description = "Контакты багетной мастерской в Москве, телефоны и схема проезда.";
// $gallery="bagety_dlya_kartin";
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>

    <div class="block-h1 text-center my-4 fade-in">
        <h1 class='color-main'>КОНТАКТЫ</h1>
    </div>

        <div class="container">
            <hr>
            <div class="row">
                <div class="col">
                    <div style="text-align:left;" itemscope itemtype="http://schema.org/LocalBusiness">
                        <h4 style="color: #6a1a21;" class="text-center"><strong itemprop="name" >Багетная мастерская №1 - м. Новокузнецкая</strong></h4>
                        <hr>
                        <p><strong>Предоплата услуг: <a href="/oplata_uslug.php" class="t2">онлайн платеж</a></strong></p>
                        <p><strong>Электронная почта:</strong> <a href="mailto:manager@bagetnaya-masterskaya.com" itemprop="email" class="t3"> manager@bagetnaya-masterskaya.com</a></p>
                        <p>
                            <strong>Телефоны: </strong><a href="tel:+74997148062" itemprop="telephone" class="t3">8 (499) 714-80-62</a>, <a href="tel:+79778244212" itemprop="telephone" class="t3">8 (977) 824-42-12 (WhatsApp)</a>
                            <a title="Whatsapp" href="https://wa.me/79778244212"><img src="img/Whatsapp_37229.png" alt="Написать в Whatsapp" style="width:50px; height:50px;" /></a>
                        </p>
                        <p><strong>Время работы: </strong><span itemprop="openingHours" content="Mo-Su 9:00−21:00">9:00 - 21:00, ежедневно</span></p>
                        <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><strong>Адрес:</strong> <span itemprop="addressLocality">Москва</span>, м. Новокузнецкая, <span itemprop="streetAddress">Климентовский переулок, 6</span></p>
                    </div>
                    <div class="yamap">
                        <script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=XD1WoHwePr9BAYkPBJ0XKFzAScY0NCvr&height=300"></script>
                    </div>
                </div>
                <div class="col">
                    <div id="arbat" style="text-align:left;" itemscope itemtype="http://schema.org/LocalBusiness">
                        <h4 style="color: #6a1a21;" class="text-center"><strong itemprop="name">Багетная мастерская №1 - м. Арбатская</strong></h4>
                        <hr>
                        <p><strong>Предоплата услуг: <a href="/oplata_uslug.php" class="t2">онлайн платеж</a></strong></p>
                        <p><strong>Электронная почта: </strong> <a href="mailto:manager@bagetnaya-masterskaya.com" itemprop="email" class="t3"> manager@bagetnaya-masterskaya.com</a></p>
                        <p>
                            <strong>Телефоны: </strong><a href="tel:>+74956652561" itemprop="telephone" class="t3">8 (495) 665-25-61, </a><a href="tel:>+79268659295" itemprop="telephone" class="t3">8 (926) 865-92-95 (WhatsApp)</a>
                            <a title="Whatsapp" href="https://wa.me/79268659295"><img src="img/Whatsapp_37229.png" alt="Написать в Whatsapp" style="width:50px; height:50px;" /></a>
                        </p>
                        <p><strong>Время работы: </strong><span itemprop="openingHours" content="Mo-Su 9:00−21:00">9:00 - 21:00, ежедневно</span></p>


                        <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><strong>Адрес:</strong> <span itemprop="addressLocality">Москва</span>, м. Арбатская, <span itemprop="streetAddress">ул. Арбат д. 1</span></p>
                    </div>
                    <div class="yamap">
                        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A7745ecc6090941daf7594769aab7ea687460dd4f16b9f44b54397c476ce3bfc8&amp;width=100%25&amp;height=300&amp;lang=ru_RU&amp;scroll=true"></script>
                    </div>
                </div>
            </div>
        </div>



<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>