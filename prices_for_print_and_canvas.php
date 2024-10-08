<?php
$keywords = "Подрамник для холста, печать фотографий, печать на холсте, рассчитать стоимость";
$title = "Рассчитайте стоимость печати фотографий или подрамник для холста в 2 клика!";
$description = "В Багетной мастерской №1 Вы можете не только заказать оформление картин под ключ, но также приобрести подрамник для холста, крепление для рамы, печать фото и многое другое!";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
    <style>

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

        p {

            color: #474A51;
            font-family: Manrope;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            padding-bottom: 15px;

        }

        .home_design {
            font-family: Cormorant Garamond;
        }

        #calc-price .name-service {
            background: #474A51;
            color: white;
            width: 100%;
            font-family: Manrope;
            font-size: 20px;
            border-radius: 8px;
        }

        #calc-price .price-service {
            background: #AD1F2D;
            color: white;
            width: 100%;
            font-family: Manrope;
            font-size: 20px;
            border-radius: 8px;
        }

        #calc-price .fix-width-90 {
            width: 90px;
            margin: 5px;
        }

        #calc-price .check-type.active, #calc-price .check-size.active {
            background: #AD1F2D;
            color: white;
        }
    </style>
    <div class="container home_design">
        <div class="row text-center mt-3 mb-5">
            <h1 class="color-main mb-5">КОМПЛЕКТ ДЛЯ КАРТИНЫ: РАССЧИТАТЬ СТОИМОСТЬ САМОСТОЯТЕЛЬНО</h1>


            <div class="row m-3">
                <p class="mx-auto">
                    В Багетной мастерской №1 Вы можете не только заказать оформление картин под ключ, но также
                    приобрести
                    подрамник для холста, крепление для рамы, печать постеров и многое другое. В калькуляторе стоимости
                    Вы
                    можете выбрать необходимый материал, указать размеры и количество, чтобы увидеть финальную стоимость
                    продукции!
                </p>
            </div>

            <div class="row my-5">
                <a href="/baget_online">
                    <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white">
                        Рассчитать
                        стоимость багета
                    </button>
                </a>
            </div>

            <section id="calc-price">
                <div class="row p-1 m-2 text-center justify-content-center name-service">
                    Услуги печати
                </div>
                <div class="row text-center justify-content-center button-service">
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="service"
                            id="service_matte">матовая
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="service"
                            id="service_canvas">холст
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="service"
                            id="service_glossy">глянцевая
                    </button>
                </div>
                <div class="row  p-1 m-2 text-center justify-content-center name-service">
                    Материалы для картины
                </div>
                <div class="row  text-center justify-content-center button-service">
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="materials"
                            id="materials_subframe">подрамник
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="materials"
                            id="materials_foamboard">пенокартон
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="materials"
                            id="materials_paperboard">картон
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="materials"
                            id="materials_passepartout">паспарту
                    </button>
                </div>
                <div class="row  p-1 m-2 text-center justify-content-center name-service">
                    Багетное стекло
                </div>
                <div class="row text-center justify-content-center button-service">
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="glass"
                            id="glass_usual">обычное
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="glass"
                            id="glass_anti_glare">антиблик
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="glass"
                            id="glass_matte">матовое
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="glass"
                            id="glass_plastic">пластик
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="glass"
                            id="glass_museum">музейное
                    </button>
                </div>
                <div class="row  p-1 m-2 text-center justify-content-center name-service">
                    Крепление для картины
                </div>
                <div class="row text-center justify-content-center button-service">
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="bracing"
                            id="bracing_standard">крепление
                        стандартное
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="bracing"
                            id="bracing_reinforced">крепление
                        усиленное
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="bracing"
                            id="bracing_clamps">прижимы для
                        подрамника
                    </button>
                </div>
                <div class="row  p-1 m-2 text-center justify-content-center name-service">
                    Внесите размеры и количество
                    <div class="row">
                        <div class="col-12 col-md-5 col-xxl-5">
                            <div class="row  justify-content-center ">
                                <div class="col-5 col-md-5 col-xxl-3">
                                    <div class="mb-3 mx-auto">
                                        <input type="number" class="i1 form-control check-change-custom"
                                               id="length-input"
                                               aria-describedby="emailHelp" value="297">
                                    </div>
                                </div>

                                <div class="col-1 col-md-1 col-xxl-1 ">
                                    <div class="mb-3 color-white">
                                        X
                                    </div>
                                </div>

                                <div class="col-5 col-md-5 col-xxl-3">
                                    <div class="mb-3">
                                        <input type="number" class="i1 form-control check-change-custom"
                                               id="width-input"
                                               aria-describedby="emailHelp" value="210">
                                    </div>
                                </div>
                            </div>
                            <div class="row  justify-content-center ">
                                <div class="col-7 col-md-7 col-xxl-7">
                                    <div class="mb-3  mx-auto">
                                        <input type="number" class="i1 form-control check-change-custom-count mx-auto"
                                               min="1"
                                               id="count-input"
                                               aria-describedby="emailHelp" value="1" width="100px"
                                               style="width: 100px;">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-md-7 col-xxl-7">
                            <div class="row text-center justify-content-center button-service">
                                <button class="button button-custom-index button-color-company-golden fix-width-90 check-size"
                                        id="a4">А4
                                </button>
                                <button class="button button-custom-index button-color-company-golden fix-width-90 check-size"
                                        id="a3">А3
                                </button>
                                <button class="button button-custom-index button-color-company-golden fix-width-90 check-size"
                                        id="a2">А2
                                </button>
                                <button class="button button-custom-index button-color-company-golden fix-width-90 check-size"
                                        id="a1">А1
                                </button>
                                <button class="button button-custom-index button-color-company-golden fix-width-90 check-size"
                                        id="a0">А0
                                </button>
                            </div
                        </div>
                    </div>
                </div>
        </div>

        <div class="row  p-1 m-2 text-center justify-content-center price-service" id="price-service">
            Выберите услугу
        </div>
        </section>


        <div class="row m-3">
            <p class="mx-auto">

                В нашем калькуляторе багета Вы можете выбрать подходящую багетную раму и сопутствующие материалы.
                Здесь
                же Вы можете отдельно заказать печать на холсте или печать фотографий! Также наш калькулятор
                позволит
                Вам заказать только паспарту, или только багетное стекло, если в процессе транспортировки что-то
                повредилось. В указанную в таблице стоимость входит также работа мастера! Поэтому Вы можете быть
                уверены, что видите конечную стоимость продукции. Мы строго следим за качеством и стараемся, чтобы
                Ваши
                заказы приносили Вам удовольствие! После уточнения стоимости рекомендуем Вам оставить заявку на
                обратную
                связь, чтобы наши специалисты помогли объединить заказы и определиться с адресом забора заказа. Три
                салона Багетной мастерской №1 в Москве позволяют Вам выбрать наиболее удобный адрес!

            </p>
        </div>


        <div class="row text-center mt-3 mb-3 justify-content-center">

            <button
                    class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь</b></button>
        </div>


        <div class="row text-center">
            <h3>С уважением к Вам,</h3>
            <h3>С любовью к Искусству! </h3>
            <h3>Команда Багетной мастерской №1</h3>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var sizeLengthInput = $('#length-input');
            var sizeWidthInput = $('#width-input');
            var countInput = $('#count-input');
            var priceBlock = $('#price-service');

            var activeType = null;
            var activeBlock = null;
            var activeSize = null;
            var price = null;

            var bracing = {
                bracing_standard: {
                    price: 300,
                },
                bracing_reinforced: {
                    price: 500,
                },
                bracing_clamps: {
                    price: 30,
                }
            };

            var glass = {
                glass_usual: {
                    minPrice: 250,
                    a4: 250,
                    a3: 500,
                    a2: 100,
                    a1: 1500,
                    a0: 2500,
                    m: 4400,
                },
                glass_anti_glare: {
                    minPrice: 1500,
                    a4: 1500,
                    a3: 3000,
                    a2: 6000,
                    a1: 12500,
                    a0: 25000,
                    m: 4400,
                },
                glass_matte: {
                    minPrice: 450,
                    a4: 450,
                    a3: 900,
                    a2: 1600,
                    a1: 2800,
                    a0: 5500,
                    m: 30000,
                },
                glass_plastic: {
                    minPrice: 250,
                    a4: 250,
                    a3: 500,
                    a2: 1000,
                    a1: 1500,
                    a0: 2500,
                    m: 4400,
                },
                glass_museum: {
                    minPrice: 1500,
                    a4: 1500,
                    a3: 3000,
                    a2: 6000,
                    a1: 12500,
                    a0: 25000,
                    m: 4400,
                },
            };

            var materials = {
                materials_subframe: {
                    minPrice: 250,
                    m_before: 4400,
                    m_after: 5500,
                    a4: 840,
                    a3: 1190,
                    a2: 1680,
                    a1: 2370,
                    a0: 4490,
                },
                materials_foamboard: {
                    minPrice: 250,
                    m_before: 5200,
                    m_after: 9000,
                    a4: 300,
                    a3: 650,
                    a2: 1300,
                    a1: 2600,
                    a0: 4500,
                },
                materials_paperboard: {
                    minPrice: 250,
                    m_before: 2000,
                    a4: 250,
                    a3: 350,
                    a2: 650,
                    a1: 1200,
                    a0: 0,
                },
                materials_passepartout: {
                    minPrice: 250,
                    m_before: 4400,
                    m_after: 5500,
                    max_1: 1000,
                    max_2: 800,
                    a4: 1500,
                    a3: 2300,
                    a2: 3100,
                    a1: 3900,
                    a0: 0,
                },
            };

            var services = {
                service_matte: {
                    minPrice: 250,
                    a4: 250,
                    a3: 500,
                    a2: 1500,
                    a1: 3000,
                    a0: 4000,
                    m: 4000,
                },
                service_canvas: {
                    minPrice: 1000,
                    a4: 2000,
                    a3: 3500,
                    a2: 4000,
                    a1: 5000,
                    a0: 10000,
                    m: 8000,
                },
                service_glossy: {
                    minPrice: 500,
                    a4: 500,
                    a3: 1000,
                    a2: 3000,
                    a1: 4000,
                    a0: 5400,
                    m: 5400,
                }
            };

            var sizeId = {
                a4: {
                    width: 210,
                    length: 297,
                },
                a3: {
                    width: 297,
                    length: 420,
                },
                a2: {
                    width: 420,
                    length: 594,
                },
                a1: {
                    width: 594,
                    length: 841,
                },
                a0: {
                    width: 841,
                    length: 1189,
                }
            };

            function calc() {
                switch (activeBlock) {
                    case 'service':
                        calcServices();
                        break;
                    case 'materials':
                        calcMaterials();
                        break;
                    case 'glass':
                        calcGlass();
                        break;
                    case 'bracing':
                        calcBracing();
                        break;
                    default:
                        break;
                }
            }

            function calcServices() {
                if (activeSize !== null) {
                    price = services[activeType][activeSize] * countInput.val();
                    priceBlock.text(price);
                } else {
                    price = ((sizeLengthInput.val() * sizeWidthInput.val()) / 1000000) * services[activeType].m * countInput.val()
                    if (price < services[activeType].minPrice) {
                        price = services[activeType].minPrice
                    }
                    priceBlock.text(Math.round(price));
                }
            }

            function calcMaterials() {
                if (activeType === 'materials_subframe') {
                    let p = 0;
                    if (((sizeLengthInput.val() * sizeWidthInput.val()) / 1000000) > 1) {
                        p = materials[activeType].m_after
                    } else {
                        p = materials[activeType].m_before
                    }
                    price = ((sizeLengthInput.val() * sizeWidthInput.val()) / 1000000) * p * countInput.val()

                    if (price < materials[activeType].minPrice) {
                        price = materials[activeType].minPrice
                    }
                    priceBlock.text(Math.round(price));
                }
                if (activeType === 'materials_foamboard') {
                     p = 0;
                    if (((sizeLengthInput.val() * sizeWidthInput.val()) / 1000000) > 1.4) {
                        p = materials[activeType].m_after
                    } else {
                        p = materials[activeType].m_before
                    }
                    price = ((sizeLengthInput.val() * sizeWidthInput.val()) / 1000000) * p * countInput.val()

                    if (price < materials[activeType].minPrice) {
                        price = materials[activeType].minPrice
                    }
                    priceBlock.text(Math.round(price));
                }

                if (activeType === 'materials_paperboard') {
                    if (((sizeLengthInput.val() * sizeWidthInput.val()) / 1000000) > 0.9) {
                        alert("Максимальный формат листа картона - 1000х900 мм. Пожалуйста, выберете пенокартон или обратитесь к специалисту через обратную связь. Спасибо!")
                    }

                    price = ((sizeLengthInput.val() * sizeWidthInput.val()) / 1000000) * materials[activeType].m_before * countInput.val()

                    if (price < materials[activeType].minPrice) {
                        price = materials[activeType].minPrice
                    }
                    priceBlock.text(Math.round(price));
                }

                if (activeType === 'materials_passepartout') {
                    if (((sizeLengthInput.val() * sizeWidthInput.val()) / 1000000) > 0.8) {
                        alert("Максимальный формат листа паспарту - 1000х800 мм. Пожалуйста, обратитесь к специалисту через обратную связь. Спасибо!")
                    }

                    price = ((sizeLengthInput.val() * sizeWidthInput.val()) / 1000000) * materials[activeType].m_before * countInput.val()

                    if (price < materials[activeType].minPrice) {
                        price = materials[activeType].minPrice
                    }
                    priceBlock.text(Math.round(price));
                }
            }

            function calcGlass() {
                if (activeSize !== null) {
                    price = glass[activeType][activeSize] * countInput.val();
                    priceBlock.text(Math.round(price));
                } else {
                    sizeCustom = sizeLengthInput.val() * sizeWidthInput.val();


                    if (sizeCustom < sizeId.a4.width*sizeId.a4.length){
                        activeSizeNew = 'a4'
                    }

                    if (sizeId.a4.width*sizeId.a4.length < sizeCustom && sizeCustom < sizeId.a3.width*sizeId.a3.length){
                        activeSizeNew = 'a3'
                    }

                    if (sizeId.a3.width*sizeId.a3.length < sizeCustom && sizeCustom < sizeId.a2.width*sizeId.a2.length){
                        activeSizeNew = 'a2'
                    }

                    if (sizeId.a2.width*sizeId.a2.length < sizeCustom && sizeCustom < sizeId.a1.width*sizeId.a1.length){
                        activeSizeNew = 'a1'
                    }

                    if (sizeId.a1.width*sizeId.a1.length < sizeCustom  && sizeCustom < sizeId.a0.width*sizeId.a0.length){
                        activeSizeNew = 'a0'
                    }

                    if (sizeCustom > sizeId.a0.width*sizeId.a0.length){
                        activeSizeNew = 'a0'
                    }

                    price = glass[activeType][activeSizeNew] * countInput.val();
                    priceBlock.text(Math.round(price));
                }
            }

            function calcBracing() {
                price = bracing[activeType].price * countInput.val();
                priceBlock.text(price);
            }

            function changeSize() {
                if (sizeId.a4.width === Number(sizeWidthInput.val()) && sizeId.a4.length === Number(sizeLengthInput.val())) {
                    activeSize = 'a4'
                } else if (sizeId.a3.width === Number(sizeWidthInput.val()) && sizeId.a3.length === Number(sizeLengthInput.val())) {
                    activeSize = 'a3'
                } else if (sizeId.a2width === Number(sizeWidthInput.val()) && sizeId.a2.length === Number(sizeLengthInput.val())) {
                    activeSize = 'a2'
                } else if (sizeId.a1.width === Number(sizeWidthInput.val()) && sizeId.a1.length === Number(sizeLengthInput.val())) {
                    activeSize = 'a1'
                } else if (sizeId.a0.width === Number(sizeWidthInput.val()) && sizeId.a0.length === Number(sizeLengthInput.val())) {
                    activeSize = 'a0'
                } else {
                    activeSize = null
                }

                if (activeSize !== null) {
                    $('.check-size.active').removeClass('active')
                    $('#' + activeSize).addClass('active')
                } else {
                    $('.check-size.active').removeClass('active')
                }
            }

            $(document).on('click', '.check-type', function () {
                $('.check-type.active').removeClass('active')
                $(this).addClass('active')
                activeType = $(this).attr('id')
                activeBlock = $(this).data('block')
                calc()
            });

            $(document).on('click', '.check-size', function () {
                $('.check-size.active').removeClass('active')
                $(this).addClass('active')
                activeSize = $(this).attr('id')

                sizeLengthInput.val(sizeId[activeSize].length)
                sizeWidthInput.val(sizeId[activeSize].width)
                calc()
            })

            $(document).on('change', '.check-change-custom', function () {
                changeSize()
                calc();
            })

            $(document).on('change', '.check-change-custom-count', function () {
                calc();
            })

            changeSize();
        });
    </script>

<?

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>