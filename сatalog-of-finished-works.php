<?php

$keywords = "багетные работы, работы, багет, паспарту";
$title = "Багетная мастерская №1 - Наши работы";
$description = "Работы Багетной мастерской №1";

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
        <h1 class='color-main' style="text-transform: uppercase;">Наши работы</h1>
        <div class='row style-text text-center pt-3' style="padding-left: 20%; padding-right: 20%">
            Ищете идеальную раму для картины? Посмотрите примеры оформления разных видов искусства в Багетной мастерской
            №1! Мы подготовили для Вас каталог с разнообразными вариантами работ.
        </div>
        <div class="row my-5">
            <a href="/baget_online">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Рассчитать
                    стоимость багета
                </button>
            </a>
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
									
									<div class="card-body relative">
									    <div class="pb-5">
										<a style="
										text-decoration: none;
										color: black;
										"
										href="/сatalog-of-finished-works-by-category.php?category=' . $item['name'] . '"><h5 class="card-title">' . $item['name'] . '</h5></a>
										</div>
										<div style="position: absolute; bottom: 0px;" class="row text-center mx-auto pt-5 justify-content-center ">
                                            <a href="/сatalog-of-finished-works-by-category.php?category=' . $item['name'] . '" class="mt-5 justify-content-center">
                                                <button class="button button-custom-index button-color-company-golden mt-5 mx-auto" 
                                                style="
                                            padding: 5px;
                                            padding-right: 10px;
                                            padding-right: 10px;
                                            ">Посмотреть работы</button>
                                            </a>
										</div>
									</div>
								</div>
							</div>
						';
        }
        ?>
    </div>
</div>

<div class="pt-5">
    <div class='row style-text text-center pt-3' style="padding-left: 20%; padding-right: 20%">
        Багетная мастерская № 1 имеет большой опыт работы в сфере декоративного оформления. Здесь Вы можете увидеть
        примеры оформления вышивок, икон, гравюр, рамы для живописи и 3d-оформление монет, медалей и спортивных
        атрибутов.
    </div>
    <div class='row style-text text-center pt-3' style="padding-left: 20%; padding-right: 20%">
        Профессиональная команда дизайнеров и мастеров подберет для Вас индивидуальное оформление картины в раме,
        отвечающее именно Вашим запросам! Ознакомьтесь с различными вариантами художественного оформления Багетной
        мастерской № 1 и найдите вдохновение именно для Вашей картины!
    </div>
</div>

</div>


<style>
    .card {
        padding-bottom: 10px;
        border-radius: 6px;
        border: 3px solid var(--beige, #E0D2BB);
    }

    .card:hover {
        background: #E0D2BB;
    }
</style>

<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>