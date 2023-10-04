<?php
if (isset($_COOKIE['skidkod'])) {
    $skidkod = $_COOKIE['skidkod'];
} else {
    $skidkod = false;
}
$keyw = "багетная мастерская, багетная мастерская в Москве, багетная мастерская недорого";
$titl = "Багетная мастерская №1 в Москве - качественно и недорого!";
$desc = "Понадобились услуги недорогой багетной мастерской в Москве? Наша Багетная Мастерская №1 порадует Вас доступными ценами. Мы - лучшие в качественном оформлении багетными рамками.";
$gallery = "bagetnaya_masterskaya";
include "header.php";
$disco = false;

$not_mobile = !(isMobile());
?>
<div id="main">
    <div id="crops">Главная</div>

    <h1>Багетная мастерская №1 в Москве.</h1>

    <? include "gallery.php"; ?>

    <div
    <?
    if ($not_mobile == true) {
        if ($skidkod) {
            echo "
                        <div id='game15' class='game15end'><div>Ваш код: <b>" . $skidkod . "</b>
                        <br>Сообщите его менеджеру при оформлении заказа и получите скидку.
                        <br>Код действителен в течение суток.</div></div>
                    ";
        } else {
            echo "
                        <div id='game15' class='game15start row text-center' onselectstart='return false;'>
                        <div onmousedown='game15start(this);'>Сыграйте в \"пятнашки\"
                        <br>чтобы получить сегодня скидку 10%<br>на любой ваш заказ.
                        <br>Нажмите чтобы начать</div></div>
                        ";
        }
    }
    ?>

    <style>
        p {
            text-indent: 20px;
            /* Отступ первой строки в пикселах */
        }

        html {

            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }
    </style>

    <?php


    if ($not_mobile == false) {
        $info = '
        
            <hr style="visibility:none">
            <div class="accordion" id="accordionExample2">
        
              <div class="accordion-item ">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="width:90%; font-size:25px;border:3px solid red;">
                    -20% на вторую картину! Подробнее:
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
                  <div class="accordion-body text-center">
                    <strong>
                        С 25.04 до 25.05 включительно! При оформлении двух 
                        картин одновременно действует скидка 20% на вторую картину, 
                        равную или меньшую по стоимости! ПРОМОКОД: <b>MAY2023</b>
                    </strong>
                  </div>
                </div>
              </div>
            </div>
        ';
    };
    ?>

    <p>
        Багетная мастерская – это место, где можно заказать изготовление рамок для фотографий, картин,
        плакатов и других работ. Недаром такие мастерские пользовались популярностью среди любителей и
        профессионалов, среди художников разных направлений и людей,
        которые ценят прекрасное.
    </p>

    <hr>
    <h4 class="text-center">КТО МЫ</h4>
    <hr>

    <img src="/img/IMG_5552.JPG" align="left">

    <p>
        Багетная мастерская №1 – это команда профессионалов, которые любят свое дело!
        Талантливые дизайнеры подберут для Вас красивое оформление картины, а мастера создадут любую Вашу фантазию.
        Если Вам нужен изысканный резной багет для живописи или рама для интерьера в стиле минимализма – ждем Вас в гости!
    </p>

    <p>
        В Москве существует множество багетных мастерских, каждая из которых уникальна.
        Однако, важно выбрать ту, которая будет соответствовать вашему запросу и пожеланию.
        Одной из таких мастерских в Москве является «Багетная мастерская №1»,
        которая предлагает свои услуги: изготовление багетной рамы индивидуального
        формата для фотографий, картин, плакатов, вышивок и мозаик, карт и прочего.
    </p>

    <?
    if ($not_mobile == false) {
        if ($skidkod) {
            echo "
                        <div id='game15' class='game15end'><div>Ваш код: <b>" . $skidkod . "</b>
                        <br>Сообщите его менеджеру при оформлении заказа и получите скидку.
                        <br>Код действителен в течение суток.</div></div>
                    ";
        } else {
            echo "
                        <div id='game15' class='game15start' onselectstart='return false;'>
                        <div onmousedown='game15start(this);'>Сыграйте в \"пятнашки\"
                        <br>чтобы получить сегодня скидку 10%<br>на любой ваш заказ.
                        <br>Нажмите чтобы начать</div></div>
                        ";
        }
    }
    ?>
    <hr>
    <h4 class="text-center">ЧТО МЫ ДЕЛАЕМ</h4>
    <hr>
    <img src="/img/IMG_0710.JPG" align="right">

    <p>
        <br>
        Понадобились услуги недорогой багетной мастерской в Москве?
        Услуги Багетной мастерской №1 очень разнообразны.
        Мы используем в работе материалы высокого качества и осуществляем широкий спектр работ по
        оформлению картин, зеркал, икон, вышивок, медалей, купюр и других предметов.
    </p>

    <p>
        Все работы выполняются вручную, что позволяет создавать уникальные и качественные изделия.
        Кроме того, у мастерской есть огромный выбор образцов багета,
        паспарту, кантов и других декоративных элементов, которые можно
        использовать для создания оригинальных оформлений
    </p>

    <br>
    <br>


    <ul>
        <li>
            <p><b>Багетные работы</b>.
                Обрамление вышивок, плазменных панелей, картин и репродукций, фотографий и постеров.
                Изготовление подрамников для холстов. Изготовление фигурного паспарту для акварелей, пастелей и графики.
                Оформление гравюр. Зеркала в багетной раме. Опытные мастера Багетной мастерской №1 помогут
                Вам воплотить любые фантазии в реальность! А дизайнер со своей стороны поможет подобрать
                оптимальные материалы для индивидуальной работы из огромного количества рамок.
                В ходе производства применяется натуральное дерево, алюминий и пластик. Багетная мастерская недорого подберет для Вас красивое оформление!</p>
        </li>
        <li>
            <p><b>Широкоформатная печать на холсте</b> – лучшая идея для подарка.
                Можно создать портрет на холсте с фотографии.
                А если Вы хотите создать домашний уют с помощью картины, обратите внимание на такую услугу, как интерьерная печать холста.
                Изготовление картины под ключ снимет с Вас необходимость тратить время и силы на поиск подходящего изображения и рамки.
                Печать на холсте и бумаге - это прекрасная возможность воссоздать счастливые моменты семейной жизни или получить репродукцию картины известного художника. </p>
        </li>
        <li>
            <p><b>Накатка на пенокартон</b> – востребованная услуга, под которой подразумевается прикрепление полотна на твердую поверхность.
                Это идеальный вариант для оформления шикарного презента, проведения выставки, украшения офисов и ресторанов.
                Для накатки изображений мастера используют пенокартон. Это материал, обладающий легким весом,
                высоким уровнем прочности и стойкостью к негативным факторам окружающей среды.</p>
        </li>
    </ul>

    <hr>
    <h4 class="text-center">НАШИ ПРЕИМУЩЕСТВА</h4>
    <hr>
    <img src="/img/IMG_9237.JPG" align="left">
    <h5>1. Приемлемая стоимость</h5>
    <p>
        Наша Багетная мастерская в Москве предоставляет возможность подобрать оформление картины как бюджетного, так и премиального сегмента.
        Мы работаем с разными видами багета: пластиковый, деревянный и алюминиевый, а также с разными производителями:
        Россия, Китай, Италия, Испания и другие страны. Мы точно сможем подобрать для Вас подходящее оформление картины с учетом Вашего бюджета!
    </p>

    <h5>2. Гарантия</h5>
    <p>
        На продукцию нашей мастерской распространяется гарантия 1 год.
        В случае, если Вас не готовая продукция не отвечает ранее оговоренным условиям –
        мы готовы переделать Вам работу бесплатно!
    </p>

    <h5>3. Соблюдение сроков и услуга срочного заказа</h5>
    <p>
        Среднее время изготовления заказа в Багетной мастерской №1: 2-3 календарных дня.
        В случае необходимости срочной готовности – изготовим багет срочно от 1 часа!
    </p>

    <h5>4. Выездной подбор багета дизайнером и монтаж</h5>
    <p>
        Выездной подбор багета – это выезд на объект дизайнера в оговоренное время и день.
        Дизайнер привозит с собой образцы багета, паспарту, кантов и багетного стекла.
        Такая услуга позволить создать оформление картины исходя из освещения Вашего пространства, цветов стен, декоративных элементов.
    </p>

    <h5>5. Онлайн-калькулятор багета </h5>
    <p>
        Удобный сервис по подбору идеальной рамы в Багетной мастерской №1!
        В online-конструкторе багета можно не только найти подходящую раму, но и увидеть конечную стоимость Вашего заказа!
    </p>

    <h5>6. Доставка крупногабаритных работ</h5>
    <p>
        Багетная мастерская осуществляет доставку в Москве и Московской области больших форматов картин.
        Также в стоимость доставки входит подъем картин до квартиры!
    </p>

    <h5>7. Удобное расположение мастерских и график работы</h5>
    <p>
        Находится наша багетная мастерская в Москве рядом с метро Арбасткая и Новокузнецкая.
        Также есть рядом городская парковка рядом!
    </p>
    <hr>

    <section class="insta" style="">
        <? require($_SERVER["DOCUMENT_ROOT"] . '/inst.php'); ?>
    </section>
</div>
<div id="side">
    <style>
        .accordion-button:not(.collapsed) {
            color: white;
            background-color: #a21213;
            box-shadow: inset 0 -1px 0 rgb(0 0 0 / 13%);
        }

        @media screen and (max-width: 801px) {
            .show_desctop {
                display: none;
            }

            .show_mobile {
                display: block;
            }
        }
    </style>
    <div class="accordion" id="accordionExample">

        <!--div class="accordion-item show_desctop">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="width:90%; font-size:25px;border:3px solid red;">
            -20% на вторую картину! Подробнее:
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body text-center">
            <strong>
                С 25.04 до 25.05 включительно! При оформлении двух 
                картин одновременно действует скидка 20% на вторую картину, 
                равную или меньшую по стоимости! ПРОМОКОД: <b>MAY2023</b>
            </strong>
          </div>
        </div>
      </div>
    </div-->


        <video src="video/video.mp4" width="300px" ; height="600" autoplay loop muted controls></video>
        <h3>Смотрите также</h3>
        <a href="/bagety_dlya_kartin/oformit_kartinu_v_baget.html" class="fast2">Оформление картин и репродукций в багетные рамки</a>
        <a href="/ramki_dlya_vyshivki/oformlenie_vyshivki.html" class="fast1">Оформление вышивок в багет</a>
        <a href="/bagetnye_ramki/bagetnye_ramki_dlya_foto.html" class="fast1">Рамки для фотографий и постеров</a>
        <a href="/bagetnye_ramki/bagetnye_ramki_dlya_ikon.html" class="fast1">Багетные рамки для икон</a>

        <? include "bot.php"; ?>