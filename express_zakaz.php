<?php
$keywords = "Купить рамку, рамка для картины, рамка срочно, готовая рамка, рамка день в день";
$title = "Изготовление рамки день в день! Экспресс-заказ от 30 минут в Багетной мастерской №1";
$description = "Необходима рамка срочно? Изготовим для Вас рамку для картины в самые короткие сроки!";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
<style>
    .section-title {
        font-family: Cormorant Garamond;
        color: #a3080d;
        font-weight: bold;
        text-align: center;
        margin: 40px 0 20px;
        text-transform: uppercase;
    }
    .highlight-btn {
        background-color: #a3080d;
        color: white;
        border: none;
        padding: 10px 25px;
        font-size: 16px;
        border-radius: 4px;
        margin: 15px 0;
    }
    .highlight-btn:hover {
        background-color: #870000;
        color: #fff;
    }
    .icon-check {
        color: #00a651;
        margin-right: 6px;
    }
    .section-text {
        font-size: 18px;
        font-family: 'Manrope', sans-serif;
        color: #474A51;
    }
    .garamond{
        font-family: Cormorant Garamond;
        font-size: 22px;
    }
    img {
        border-radius: 10px;
        max-width: 100%; /* Не шире контейнера */
        height: auto;    /* Сохранять пропорции */
    }

    .img-custom {
        object-fit: contain;
    }


    img {
        border-radius: 10px;
        max-width: 100%;
        height: auto;
    }

    .img-custom {
        object-fit: contain;
    }

    .img-1 {
        max-width: 286px;
        max-height: 382px;
    }

    .img-2 {
        max-width: 396px;
        max-height: 561px;
    }

    .img-3 {
        max-width: 404px;
        max-height: 461px;
    }

    @media screen and (max-width: 767px){
        .img-1 {
            max-width: 100%;
            height: auto;
            max-height: 376px;
        }

        .img-2 {
            max-width: 100%;
            height: auto;
            max-height: 412px;
        }

        .img-3 {
            max-width: 100%;
            height: auto;
            max-height: 340px;
        }
    }
</style>

<div class="container home_design">

    <!-- Блок 1 -->
    <div class="row">
        <div class="col-12">
            <h2 class="section-title text-center">
                <span style="font-size: 40px">ЭКСПРЕСС-ЗАКАЗ</span><br>
                ИЗГОТОВЛЕНИЕ РАМКИ ДЕНЬ В ДЕНЬ ОТ 30 МИНУТ
            </h2>
        </div>

        <div class="col-12 col-md-5 text-center">
            <img src="/img/article/telegram-cloud-photo-size-2-5425050076243422565-y%201.png" class="img-custom img-1" alt="Экспресс-изготовление рамок">
        </div>

        <div class="col-12 col-md-7 text-left section-text my-auto">
            <p>Нужна рамка <strong>срочно</strong>? В салонах Багетной мастерской №1 вы можете купить готовую рамку или заказать индивидуальное изготовление день в день. Выполним оформление картины, фотографии, постера или диплома без ожидания – от 30 минут.</p>
            <p>Стандартные рамки часто не подходят по размеру, стилю или профилю. Мы подберём багет, стекло и паспарту, чтобы срочно оформить работу и сохранить задуманную эстетику.</p>
            <a href="/baget_online">
                <button class="highlight-btn">Рассчитать стоимость багета</button>
            </a>
        </div>
    </div>

    <!-- Блок 2 -->
    <div class="row text-center">
        <h3 class="section-title">ЭКСПРЕСС-ЗАКАЗ: ДЛЯ ЧЕГО УСЛУГА</h3>
        <div class="col-sm-12 section-text">
            <p><strong class="garamond">СРОЧНЫЕ ПОДАРКИ</strong><br>Рамка для картины или фотографии в подарок коллеге, близкому, партнёру – оформим день в день.</p>
            <p><strong class="garamond">ВЫСТАВКИ И ЭКСПОЗИЦИИ</strong><br>Подготовим работы к экспозиции за считанные часы и поможем подобрать оформление под требуемый стиль.</p>
            <p><strong class="garamond">ДИПЛОМНЫЕ И УЧЕБНЫЕ ПРОЕКТЫ</strong><br>Срочно оформим диплом, чертёж или работу для защиты в специализированных вузах.</p>
            <p><span style="color:#a3080d;">Любое событие – от дня рождения до выпускного – не повод откладывать идеальное оформление. Оставьте заявку, и менеджер уточнит все детали.</span></p>
            <button class="highlight-btn" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
        </div>
    </div>

    <!-- Блок 3 -->
    <div class="row">
        <h3 class="section-title">КАК ОФОРМИТЬ ЭКСПРЕСС-ЗАКАЗ</h3>
        <div class="col-sm-6 section-text my-auto">
            <p>Для срочного изготовления лучше всего приехать в любой из наших салонов. Специалист покажет варианты багета, подберёт стекло, паспарту и другие материалы, доступные для изготовления рамки день в день.</p>
            <p><strong class="garamond">1. Выберите формат</strong><br>Возьмите с собой работу или укажите точные размеры, чтобы мы подобрали подходящий профиль.</p>
            <p><strong class="garamond">2. Определитесь с комплектацией</strong><br>Решите, нужно ли паспарту, защитное или музейное стекло, декоративные элементы.</p>
            <p><strong class="garamond">3. Сообщите срок готовности</strong><br>Минимальное время изготовления – от 30 минут, финальный срок зависит от сложности и количества изделий.</p>
            <p>Заказать рамку можно и онлайн: воспользуйтесь конструктором багета на сайте и укажите срочность в комментарии, менеджер свяжется с вами для подтверждения.</p>
        </div>
        <div class="col-sm-6">
            <img src="/img/article/image%20707.png" class="img-custom img-2" alt="Как оформить экспресс-заказ">
        </div>
    </div>

    <!-- Блок 4 -->
    <div class="row">
        <h3 class="section-title">СТОИМОСТЬ И ВРЕМЯ ИЗГОТОВЛЕНИЯ</h3>
        <div class="col-sm-12 section-text text-center">
            <p><strong class="garamond">СРОКИ</strong><br>Изготовим рамку день в день от 30 минут. На оформление нескольких работ или сложных проектов закладывайте до одного рабочего дня.</p>
            <p><strong class="garamond">ТИП РАБОТЫ</strong><br>Для холста на подрамнике достаточно рамы, а для гравюры или фото потребуются стекло, паспарту и кант – мастер предупредит о дополнительном времени.</p>
            <p><strong class="garamond">ОБЪЁМ ЗАКАЗА</strong><br>При заказе от трёх рам и более специалисты рассчитуют срок с учётом загрузки мастерской.</p>
            <p><strong class="garamond">СТОИМОСТЬ</strong><br>Срочное оформление рассчитывается с коэффициентом х1–х3. Он зависит от сложности, времени обращения и сезонной загрузки (например, декабрь и январь).</p>
            <a href="/baget_online"><button class="highlight-btn">Рассчитать стоимость багета</button></a>
        </div>
    </div>

    <!-- Блок 5 -->
    <div class="row">
        <h3 class="section-title">ПОЧЕМУ – БАГЕТНАЯ МАСТЕРСКАЯ №1?</h3>
        <div class="col-sm-4">
            <img src="/img/article/telegram-cloud-photo-size-2-5276430906288104718-y%201.png" class="img-custom img-3" alt="Команда мастерской">
        </div>
        <div class="col-sm-8 text-left section-text my-auto">
            <p><span class="icon-check">✅</span> Профессиональная команда – высокое качество и скорость работы без потери деталей.</p>
            <p><span class="icon-check">✅</span> Три салона в центре Москвы – удобно добраться на автомобиле и общественным транспортом.</p>
            <p><span class="icon-check">✅</span> Гарантия на изготовление рамки и оформление – 1 календарный год.</p>
            <p><span class="icon-check">✅</span> Работаем ежедневно с 9:00 до 21:00 и готовы помочь с оформлением любой сложности.</p>
            <a href="/baget_online"><button class="highlight-btn">Рассчитать стоимость багета</button></a>
        </div>
    </div>

    <!-- Заключение -->
    <div class="row text-center section-text" style="margin: 40px 0;">
        <p>Если у вас остались вопросы или появились новые идеи, приезжайте в Багетную мастерскую №1. Оформим <strong>готовую рамку</strong> или изготовим <strong>рамку срочно</strong> день в день – вы получите идеальный результат без ожидания!</p>
    </div>
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
