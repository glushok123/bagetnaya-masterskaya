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
                ИЗГОТОВЛЕНИЕ РАМКИ ДЕНЬ В ДЕНЬ
            </h2>
        </div>

        <div class="col-12 col-md-5 text-center">
            <img src="/img/article/telegram-cloud-photo-size-2-5425050076243422565-y%201.png" class="img-custom img-1" alt="Экспресс-изготовление рамок">
        </div>

        <div class="col-12 col-md-7 text-left section-text my-auto">
            <p>Оформление картин, фотографий, гравюр и других видов искусства – это долгий, кропотливый процесс, который занимает обычно от 3 календарных дней. Что делать, если на оформление есть не более двух часов?</p>
            <p>Готовые рамки стандартных размеров в наличии часто не подходят по формату, стилю или профилю. Наша команда Багетной мастерской №1 может предложить Вам экспресс-оформление рамок срочно в день обращения!</p>
            <a href="/baget_online">
                <button class="highlight-btn">Рассчитать стоимость багета</button>
            </a>
        </div>
    </div>

    <!-- Блок 2 -->
    <div class="row text-center">
        <h3 class="section-title">ЭКСПРЕСС-ЗАКАЗ: ДЛЯ ЧЕГО УСЛУГА</h3>
        <div class="col-sm-12 section-text">
            <p>- Срочная рамка для картины в подарок коллеге или близкому человеку</p>
            <p>- Оформление на выставку или экспозицию в кратчайшие сроки</p>
            <p>- Дипломное оформление для учащихся в специализированных ВУЗах</p>
            <p>Любое событие, будь то день рождения, юбилей или выпускной – Вы можете как купить рамку в готовом виде, так и заказать срочное оформление день в день в наших салонах! Оставляйте заявку на обратную связь, чтобы уточнить детали с менеджером!</p>
            <button class="highlight-btn" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
        </div>
    </div>

    <!-- Блок 3 -->
    <div class="row">
        <h3 class="section-title">КАК ОФОРМИТЬ ЭКСПРЕСС-ЗАКАЗ</h3>
        <div class="col-sm-6 section-text my-auto">
            <p>Для срочного изготовления следует обращаться непосредственно в салон: приезжайте по удобному для Вас адресу – специалист покажет Вам доступные материалы к изготовлению рамок день в день, а также паспарту, виды стекол и прочие материалы!</p>
            <p>Вы также можете воспользоваться нашим конструктором багета на сайте, где в комментарии к заказу уточнить необходимый срок готовности: наш менеджер сориентирует Вас по наличию материалов или предложит максимально похожие альтернативы!</p>
        </div>
        <div class="col-sm-6">
            <img src="/img/article/image%20707.png" class="img-custom img-2" alt="Как оформить экспресс-заказ">
        </div>
    </div>

    <!-- Блок 4 -->
    <div class="row">
        <h3 class="section-title">СТОИМОСТЬ И ВРЕМЯ ИЗГОТОВЛЕНИЯ</h3>
        <div class="col-sm-12 section-text text-center">
            <p>Сроки изготовления рамок срочно начинается от 30 минут! Общее время оформления зависит от нескольких факторов:</p>
            <p>- тип работы<br>Если у Вас холст на подрамнике и необходима только рама – времени у мастера уйдет меньше, в сравнении с оформлением гравюры: где необходимо стекло, паспарту, рама и, возможно, декоративный кант!</p>
            <p>- количество готовых рамок<br>Если Вам необходимо обрамить от 3 работ и более – времени также мастеру потребуется больше. Даже при срочном изготовлении следует закладывать некоторое время на багетное оформление!</p>
            <p>Стоимость срочного изготовления багетных рам и сопутствующих элементов также будет выше обычной: коэффициент может быть от х1 до х3 в зависимости также от разных факторов: загруженность мастерской, время обращения и даже месяца (новогодний месяц - декабрь или свободный месяц - январь!)</p>
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
            <p>ПОЧЕМУ – БАГЕТНАЯ МАСТЕРСКАЯ №1 ?</p>
            <p>- Качество и скорость профессиональной команды</p>
            <p>- Три салона в центре Москвы с удобным расположением как для любителей собственного транспорта, так и общественного</p>
            <p>- Гарантия на изготовление – 1 календарный год</p>
            <p>- Ежедневный график работы с 9.00 до 21.00!</p>
            <a href="/baget_online"><button class="highlight-btn">Рассчитать стоимость багета</button></a>
        </div>
    </div>

    <!-- Заключение -->
    <div class="row text-center section-text" style="margin: 40px 0;">
        <p>Багетная мастерская №1 – это команда. Мы всегда готовы помочь с оформлением рамок для картин любой сложности в любые сроки! Если у Вас остались вопросы или родились идеи – ждем Вас в гости!</p>
    </div>
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
