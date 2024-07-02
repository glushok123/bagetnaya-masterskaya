<?php
$keywords = "Багетная рама, рамка для картины, купить рамку";
$title = "Рамки для картин в Багетной мастерской №1";
$description = "Багетные рамы из дерева, пластика и металла для самых разных предметов искусства! Как выбрать и купить рамку в Багетной мастерской №1 – читайте в статье!";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
    <style>
        * {
            font-family: Cormorant Garamond;
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
        .castom-image {
            width: 100% !important;
            height: auto !important;
            max-height: 170px;
            object-fit: cover;
        }
        .card {
            padding-bottom: 10px;
            border-radius: 6px;
            border: 3px solid var(--beige, #E0D2BB);
            height: 350px !important;
        }

        .card:hover {
            background: #E0D2BB;
        }
    </style>
    <div class="container ">
        <div class="row text-center mt-3 mb-5">
            <h1 class="color-main">РАМКИ ДЛЯ КАРТИН <br>
                В БАГЕТНОЙ МАСТЕРСКОЙ №1</h1>
            <h3>БАГЕТНАЯ РАМА – ИСТОРИЯ <br> ВОЗНИКНОВЕНИЯ</h3>
        </div>


        <div class="row m-3">
            <div class="col-12 col-md-6 text-center">
                <img src="/img/article/baget_ramki_1.png" style="
                        object-fit: cover;
                        height: 290px;
                        margin-left: -15px;
                    ">
                <p class="mt-2"><b>Картина Susan Eby Glass - Baguette express</b></p>
            </div>
            <div class="col-12 col-md-6">
                <p>
                    Слово «Baguette» с французского означает «рейка», «палочка».
                    Сдоба, придуманная во Франции, приобрела свое название лишь в 1920 году, а вот багет как
                    обрамление картины начал свое существование задолго до этого!
                </p>
                <p>
                    Обрамление родом из архитектуры. Первообразом багета являлись своды храмов, в которые
                    вписывались иконописные сюжеты – фрески. А багетные рамы в том виде, в котором мы привыкли их
                    видеть, правильнее всего отнести к эпохе Ренессанса! Сам Леонардо Да Винчи считал, что рама –
                    это продолжение картины, и она должна соответствовать величию и достоинству последнего.
                    Купить рамку в 14-16 веках не представлялось возможным, так как рама зачастую создавалась самими
                    художниками и являлась таким же предметом искусства, как и само полотно.
                </p>
            </div>
        </div>

        <div class="row m-3 align-middle">
            <div class="col-12 col-md-6 my-auto">
                <p class="align-middle">
                    В современном мире рамка для картины – это индивидуальный продукт, который можно выбрать согласно
                    своим предпочтениям, интерьеру и техническим характеристикам! А благодаря грамотным специалистам,
                    работающим в Багетной мастерской №1 – обрамление картины будет гармоничным и уместным. Мы создаем
                    обрамления, отвечающие Вашим необходимостям!
                </p>

            </div>
            <div class="col-12 col-md-6 text-center">
                <img src="/img/article/успенский_собор_во_владимире_1158–1160_годы.jpg" style="
                        object-fit: cover;
                        height: 290px;
                    ">
                <p class="mt-2"><b>Успенский собор во Владимире (1158-1160 г)</b></p>
            </div>
        </div>

        <div class="row text-center mt-3 mb-5">
            <h3>БАГЕТНАЯ РАМА – НАЗНАЧЕНИЕ</h3>
        </div>
        <p class="mt-2">Сегодня у багета есть две главных задачи: декоративная и защитная. Декоративная задача – не
            только логичное и уместное продолжение сюжета, но также гармония с окружающим пространством. Защитная задача
            – это обеспечение сохранности от механических повреждений, выцветания и других факторов.</p>
        <p>Широкий ассортимент багета и таких сопутствующих материалов, как паспарту, канты или слипы, стекла и прочие
            материалы, позволяют нам создавать подходящее и уникальное оформление картины! А в online- конструкторе
            багета Вы можете самостоятельно подобрать к картине подходящую раму!</p>

        <div class="row text-center justify-content-center mt-3 mb-5">
            <a href="/baget_online">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Рассчитать стоимость багета</b></button>
            </a>
        </div>

        <div class="row text-center mt-3 mb-5">
            <h3>БАГЕТНАЯ РАМА – МАТЕРИАЛЫ</h3>
        </div>
        <div class="row m-3">
            <div class="col-12 col-md-6 text-center">
                <img src="/img/article/IMG_8332 (1).jpg" style="
                        object-fit: cover;
                        height: 290px;
                        margin-left: -15px;
                    ">
            </div>
            <div class="col-12 col-md-6 my-auto">
                <p>
                    В современных багетных мастерских рамки для картин представлены в нескольких материалах – дерево,
                    пластик, алюминий, редко – рамы из МДФ. Во всех категориях – широкий выбор дизайна! Однако внешний
                    вид – не единственный параметр выбора! Так, например, для тяжелых картин или зеркал лучше выбирать
                    массивные деревянные рамы, а для работ в помещения с повышенной влажностью – пластиковые. Больше
                    подробностей Вы можете узнать у наших специалистов, оставив заявку на обратную связь!
                </p>

            </div>
        </div>

        <div class="row text-center justify-content-center mt-3 mb-5">

            <button
                    class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь</b></button>

        </div>

        <div class="row text-center mt-3 mb-5">
            <h3>РАМКА ДЛЯ КАРТИНЫ В БАГЕТНОЙ МАСТЕРСКОЙ №1</h3>
        </div>

        <div class="row m-3 align-middle">
            <div class="col-12 col-md-6 my-auto">
                <p class="align-middle">
                    Багетная мастерская №1 – сеть профессиональных багетных мастерских в Москве, где Вам точно смогут
                    подобрать подходящее оформление предмета искусства! Наш опыт не заканчивается на картинах, но также
                    это могут быть различные объемные объекты, спортивные атрибуты, иконы и многое другое! Больше
                    выполненных нами работ Вы можете увидеть в галерее работ. Свой ассортимент мы также пополняем
                    готовой продукцией – Вы можете купить рамку в готовом собранном виде в любом салоне!
                </p>
                <p><b>С уважением к Вам, С любовью к Искусству!</b></p>
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-6">
                        <div class="">
                            <div class="card text-center justify-content-center h-100 pt-3 " style="width:95%" href="/">
                                <a href="/сatalog-of-finished-works-by-category.php?category=Акварели, пастели и гравюры"><img src="/img/багетная - фотобанк работ/акварели, пастели и гравюры/ФОТО ДЛЯ ОБЛОЖКИ.JPG" class="rounded mx-auto d-block castom-image " alt="..."></a>

                                <div class="card-body relative">
                                    <div class="pb-5">
                                        <a style="
										text-decoration: none;
										color: black;
										"
                                           href="/сatalog-of-finished-works-by-category.php?category=Акварели, пастели и гравюры"><h5 class="card-title">Акварели, пастели и гравюры</h5></a>
                                    </div>
                                    <div style="position: absolute; bottom: 0px;" class="row text-center mx-auto pt-5 justify-content-center ">
                                        <a href="/сatalog-of-finished-works-by-category.php?category=Акварели, пастели и гравюры" class="mt-5 justify-content-center">
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
                    </div>
                    <div class="col-6">
                        <div class="">
                            <div class="card text-center justify-content-center h-100 pt-3 " style="width:95%" href="/">
                                <a href="/сatalog-of-finished-works-by-category.php?category=Зеркала и тв-панели"><img src="/img/багетная - фотобанк работ/зеркала и тв-панели/IMG_4362.JPG" class="rounded mx-auto d-block castom-image " alt="..."></a>

                                <div class="card-body relative">
                                    <div class="pb-5">
                                        <a style="
										text-decoration: none;
										color: black;
										"
                                           href="/сatalog-of-finished-works-by-category.php?category=Зеркала и тв-панели"><h5 class="card-title">Зеркала и тв-панели</h5></a>
                                    </div>
                                    <div style="position: absolute; bottom: 0px;" class="row text-center mx-auto pt-5 justify-content-center ">
                                        <a href="/сatalog-of-finished-works-by-category.php?category=Зеркала и тв-панели" class="mt-5 justify-content-center">
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
                    </div>
                    <div class="row text-center justify-content-center mt-3 mb-5">
                        <a href="/сatalog-of-finished-works">
                            <button
                                    class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                                посмотреть больше работ</b></button>
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>