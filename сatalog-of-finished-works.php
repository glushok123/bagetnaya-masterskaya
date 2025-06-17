<?php

$keywords = "Рамка для картины, пример оформления, багетная мастерская";
$title = "Примеры оформления картин в Багетной мастерской №1";
$description = "Ищете рамки для картин? Посмотрите примеры оформления разных видов искусства в Багетной мастерской №1 ";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';


$category = [
    [
        'name' => 'Акварели, пастели и гравюры',
        'imgMain' => '/img/багетная - фотобанк работ/акварели, пастели и гравюры/ФОТО ДЛЯ ОБЛОЖКИ.JPG',
    ],
    [
        'name' => 'Зеркала и тв-панели',
        'imgMain' => '/img/багетная - фотобанк работ/зеркала и тв-панели/IMG_4362.JPG',
    ],
    [
        'name' => 'Иконы и вышивки',
        'imgMain' => '/img/багетная - фотобанк работ/иконы и вышивки/ФОТО ДЛЯ ОБЛОЖКИ.JPG',
    ],
    [
        'name' => 'Ордена и медали, купюры и монеты',
        'imgMain' => '/img/багетная - фотобанк работ/ордена и медали, купюры и монеты/ФОТО ДЛЯ ОБЛОЖКИ.JPG',
    ],
    [
        'name' => 'Оформление живописи',
        'imgMain' => '/img/багетная - фотобанк работ/оформление живописи/ФОТО ДЛЯ ОБЛОЖКИ.JPG',
    ],
    [
        'name' => 'Постеры, плакаты и репродукции',
        'imgMain' => '/img/багетная - фотобанк работ/постеры, плакаты и репродукции/ФОТО ДЛЯ ОБЛОЖКИ.JPG',
    ],
    [
        'name' => 'Сложные работы',
        'imgMain' => '/img\багетная - фотобанк работ/сложные работы/ФОТО ДЛЯ ОБЛОЖКИ.JPG',
    ],
    [
        'name' => 'Фотографии и графика',
        'imgMain' => '/img/багетная - фотобанк работ/фотографии и графика/ФОТО ДЛЯ ОБЛОЖКИ.JPG',
    ],
    [
        'name' => 'Объектное оформление',
        'imgMain' => '/img/багетная - фотобанк работ/объектное оформление/C21D3219-DF2A-4588-8FF7-19E3046C04D2.JPG',
    ],
    [
        'name' => 'Футболки и спортивные атрибуты',
        'imgMain' => '/img/багетная - фотобанк работ/ФУТБОЛКИ И СПОРТИВНЫЕ АТРИБУТЫ/23CA0087-6FB6-4D03-BCA8-E83DDF004619-min.JPG',
    ],
]
?>

<style>
    .highlight-btn {
        background-color: #a3080d;
        color: white;
        border: none;
        padding: 20px 35px;
        font-size: 16px;
        border-radius: 4px;
        margin: 15px 0;
        max-width: fit-content;

    }
    .highlight-btn:hover {

        background-color: #870000;
        color: #fff;
    }

    .castom-image {
        width: 250px !important;
        height: 250px !important;
        object-fit: cover;
    }

    .carousel-item {
        text-align: center !important;
    }

    .d-block {
        display: inline-block !important;
    }

    html,
    body {
        max-width: 100%;
    }

    body {
        max-width: 100%;
        overflow-y: visible !important;
        overflow-x: hidden;
    }

    .price {
        font-weight: bold;
    }

    .test {
        box-sizing: border-box !important;
    }

    form input {
        /* width:90% !important; */
    }

    form select {
        width: 85% !important;
    }

    form textarea {
        width: 90% !important;
    }

    .hidden {
        display: none;
    }

    @media screen and (max-width: 1200px) {
        .castom-image {
            width: 180px !important;
            height: 180px !important;
        }
    }

    @media screen and (max-width: 900px) {
        .castom-image {
            width: 170px !important;
            height: 170px !important;
        }
    }

    @media screen and (max-width: 760px) {
        .castom-image {
            width: 130px !important;
            height: 130px !important;
        }

        .card-body button {
            font-size: 14px;
        }

        .card-body div.row a {
            padding-left: 0px;
            margin-left: 0px;
        }
    }
</style>
<style>
    p {
        text-indent: 20px;
        /* Отступ первой строки в пикселах */
    }
</style>

<div class="container">
    <div class="block-h1 text-center my-4 fade-in">
        <h1 class='color-main' style="text-transform: uppercase;">Галерея работ</h1>
        <div class='row style-text text-center pt-3' style="padding-left: 20%; padding-right: 20%">
            Багетная мастерская №1 – это команда, которой Вы можете доверять! Здесь Вы можете ознакомиться с уникальными примерами оформления готовых работ и с опытом наших специалистов!
        </div>
    </div>
</div>

<div class='container'>
    <div class='row g-0 justify-content-center' style="margin-right:10px;">
        <?
        foreach ($category as $item) {
            echo '
							<div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 mt-4">
								<div class="card text-center justify-content-center h-100 pt-3 " style="width:95%" href="/">
									<a href="/сatalog-of-finished-works-by-category.php?category=' . $item['name'] . '"><img src="' . $item['imgMain'] . '" class="rounded mx-auto d-block castom-image " alt="..."></a>
									
									<div class="card-body-new">
									    <div class="">
										<a style="
										text-decoration: none;
										color: black;
										"
										href="/сatalog-of-finished-works-by-category.php?category=' . $item['name'] . '"><h5 class="card-title">' . $item['name'] . '</h5></a>
										</div>
									
                                            <a href="/сatalog-of-finished-works-by-category.php?category=' . $item['name'] . '" class="but-show">
                   Посмотреть работы
                                            </a>
										
									</div>
								</div>
							</div>
						';
        }
        ?>
    </div>
    <div class="pt-5">
        <div class='row style-text text-center pt-3' style="padding-left: 20%; padding-right: 20%">
            Каждая картина обретает завершенность в правильном обрамлении. Эти и многие другие работы, которые не вошли в каталог – это работа с вдохновением, трепетным отношением, мастерством. Здесь не просто рамки для картины, а часто настоящие проекты, которые требуют особого умения и внимания. Все типы работ разделены по категориям для Вашего удобства.
        </div>
        <div class='row style-text text-center pt-3' style="padding-left: 20%; padding-right: 20%">
            На нашем сайте Вы можете рассчитать стоимость оформления в конструкторе багета. Если Вам необходим предварительный расчет стоимости сложного заказа, например, спортивной Джерси или наградных медалей, оставляйте заявку на обратную связь!
        </div>

        <!-- Кнопка -->
        <div class="row text-center section-text mt-5 mb-4">
            <button class="highlight-btn mx-auto" data-bs-toggle="modal" data-bs-target="#feedbackModal">Оставить заявку на обратную связь</button>
        </div>
    </div>
</div>





<style>
    .card {
        padding-bottom: 10px;
        border-radius: 17px;
        background-color: #F1E8E2;
        border: none;
    }

    .card:hover {
        /*background: #E0D2BB;*/
    }
    .but-show{
        position: relative;
        box-sizing: border-box;
        padding: 15px 10px;
        border-radius: 9px;
        background-color: #D5AEAE;
        color: black;
        border: 1px transparent;
        margin-top: 20px;
    }
    .but-show:hover{
        border: 1px black;
        color: black;
    }
    .card-body-new{
        display: flex;
        flex-direction: column;
        gap:20px;
        padding: 10px 10px;
        height: 100%;
        justify-content: space-between;
    }
</style>

<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>