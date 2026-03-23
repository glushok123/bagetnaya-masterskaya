<?php
$keywords = "Печать фото, круглая рамка, паспарту, прорисовка";
$title = "Комплект для картины в Багетной мастерской №1: услуги и стоимость";
$description = "Печать фото, багетные стекла для прямоугольных и круглых рамок, фигурные и классические паспарту, а также услуги по прорисовке с профессиональной командой!";

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
            <h1 class="color-main mb-5">КОМПЛЕКТ ДЛЯ КАРТИНЫ: УСЛУГИ И СТОИМОСТЬ</h1>

            <div class="row m-3">
                <p class="mx-auto">
                    Команда Багетной мастерской №1 оказывает не только комплекс услуг по оформлению картин и других
                    работ в багетные рамы, но также готова помочь Вам подобрать и приобрести необходимые составляющие
                    для самостоятельного оформления: печать фото, багетные стекла для прямоугольных и круглых рамок,
                    фигурные и классические паспарту, а также услуги по прорисовке картин маслом или фактурным гелем!
                    Также Вы можете выбрать необходимый тип крепления, рассчитать стоимость доставки в пределах Москвы и
                    МО. После предварительный расчетов оставьте заявку на обратную связь с менеджером для уточнения
                    сроков и других деталей Вашего заказа! Салоны Багетной мастерской №1 в самом центре столицы позволят
                    Вам получить заказ быстро и комфортно!
                </p>
            </div>

            <!-- Кнопка на другую страницу с расчётом багета под ключ -->
            <div class="row my-5">
                <a href="/baget_online">
                    <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white">
                        Рассчитать стоимость багета
                    </button>
                </a>
            </div>

            <section id="calc-price">
                <!-- Печать -->
                <div class="row p-1 m-2 text-center justify-content-center name-service">
                    Услуги печати и росписи
                </div>
                <div class="row text-center justify-content-center button-service">
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="service"
                            id="service_matte">Матовая
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="service"
                            id="service_glossy">Глянцевая
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="service"
                            id="service_canvas">Холст
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="service"
                            id="service_art_gel">Прорисовка арт-гелем
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="service"
                            id="service_oil_painting">Роспись маслом
                    </button>
                </div>

                <!-- Материалы -->
                <div class="row p-1 m-2 text-center justify-content-center name-service">
                    Материалы для картины
                </div>
                <div class="row text-center justify-content-center button-service">
                    <!-- Подрамник -->
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="materials"
                            id="materials_subframe">Подрамник
                    </button>
                    <!-- Подрамник + натяжка -->
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="materials"
                            id="materials_subframe_tension">Подрамник и натяжка
                    </button>
                    <!-- ПеноКартон -->
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="materials"
                            id="materials_foamboard">Пенокартон
                    </button>
                    <!-- ПеноКартон + накатка -->
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="materials"
                            id="materials_foamboard_mount">Пенокартон и накатка
                    </button>
                    <!-- Картон -->
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="materials"
                            id="materials_paperboard">Картон
                    </button>
                    <!-- Паспарту -->
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="materials"
                            id="materials_passepartout">Паспарту
                    </button>
                </div>

                <!-- Стекло -->
                <div class="row p-1 m-2 text-center justify-content-center name-service">
                    Багетное стекло
                </div>
                <div class="row text-center justify-content-center button-service">
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="glass"
                            id="glass_usual">Обычное
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="glass"
                            id="glass_matte">Матовое
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="glass"
                            id="glass_anti_glare">Антиблик
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="glass"
                            id="glass_plastic">Пластик
                    </button>
                </div>

                <!-- Крепления -->
                <div class="row p-1 m-2 text-center justify-content-center name-service">
                    Крепления для картины
                </div>
                <div class="row text-center justify-content-center button-service">
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="bracing"
                            id="bracing_standard">Стандартное
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="bracing"
                            id="bracing_reinforced">Усиленное
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="bracing"
                            id="bracing_clamps">Прижимы
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="bracing"
                            id="bracing_mirror">Зеркальное
                    </button>
                </div>

                <!-- Доставка -->
                <div class="row p-1 m-2 text-center justify-content-center name-service">
                    Доставка
                </div>
                <div class="row text-center justify-content-center button-service">
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="delivery"
                            id="delivery_sad">В пределах Садового
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="delivery"
                            id="delivery_ttk">В пределах <br>ТТК
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="delivery"
                            id="delivery_mkad">В пределах МКАД
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="delivery"
                            id="delivery_lift">С <br>подъёмом
                    </button>
                    <button class="button button-custom-index button-color-company-golden fix-width-185 check-type"
                            data-block="delivery"
                            id="delivery_outside">За МКАД
                    </button>
                </div>

                <!-- Внесите размеры и количество -->
                <div class="row p-1 m-2 text-center justify-content-center name-service">
                    <div>Укажите размеры (мм) и количество</div>
                    <div class="row">
                        <div class="col-12 col-md-5 col-xxl-5">
                            <div class="row justify-content-center">
                                <div class="col-5 col-md-5 col-xxl-3">
                                    <div class="mb-3 mx-auto">
                                        <input type="number" class="form-control check-dimensions"
                                               id="length-input"
                                               value="297"
                                               placeholder="Длина, мм">
                                    </div>
                                </div>
                                <div class="col-1 col-md-1 col-xxl-1">
                                    <div class="mb-3 color-white">X</div>
                                </div>
                                <div class="col-5 col-md-5 col-xxl-3">
                                    <div class="mb-3">
                                        <input type="number" class="form-control check-dimensions"
                                               id="width-input"
                                               value="210"
                                               placeholder="Ширина, мм">
                                    </div>
                                </div>
                            </div>
                            <!-- Количество -->
                            <div class="row justify-content-center">
                                <div class="col-7 col-md-7 col-xxl-7">
                                    <div class="mb-3 mx-auto">
                                        <input type="number" class="form-control check-change-count mx-auto"
                                               min="1"
                                               id="count-input"
                                               value="1"
                                               style="width: 100px;">
                                    </div>
                                </div>
                            </div>
                            <!-- Ввод километров, если за МКАД -->
                            <div class="row justify-content-center" id="distance-block" style="display:none;">
                                <div class="col-7 col-md-7 col-xxl-7">
                                    <div class="mb-3 mx-auto">
                                        <label>Км за МКАД:</label>
                                        <input type="number" class="form-control check-change-distance mx-auto"
                                               min="1"
                                               id="distance-input"
                                               value="10"
                                               style="width: 100px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Быстрые кнопки формата -->
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
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Итоговая стоимость -->
                <div class="row p-1 m-2 text-center justify-content-center price-service" id="price-service">
                    Выберите услугу
                </div>
            </section>

            <div class="row m-3">
                <p class="mx-auto">
                    После уточнения стоимости рекомендуем Вам оставить заявку на обратную связь, чтобы наши специалисты
                    помогли объединить заказы и определиться с адресом забора заказа.
                    Три салона Багетной мастерской №1 в Москве позволяют Вам выбрать наиболее удобный адрес!
                </p>
            </div>
            <div class="row text-center mt-3 mb-3 justify-content-center">
                <button
                        class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white"
                        data-bs-toggle="modal" data-bs-target="#feedbackModal">
                    Оставить заявку на обратную связь
                </button>
            </div>

            <div class="row text-center">
                <h3>С уважением к Вам,</h3>
                <h3>С любовью к Искусству!</h3>
                <h3>Команда Багетной мастерской №1</h3>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            // Храним допустимые размеры для некоторых материалов (ограничения)
            const LIMITS = {
                // [maxWidth, maxHeight]
                materials_subframe: [3000, 3000],           // больше - нельзя
                materials_subframe_tension: [3000, 3000],
                materials_foamboard: [1000, 1400],
                materials_foamboard_mount: [1000, 1400],
                materials_paperboard: [900, 1000],
                materials_passepartout: [800, 1000]
            };

            // Печать (за м²) + мин. стоимость
            const SERVICES = {
                service_matte: {priceM2: 5200, min: 2500},
                service_glossy: {priceM2: 5400, min: 2500},
                service_canvas: {priceM2: 8000, min: 2500},
                service_art_gel: {priceM2: 5000, min: 2500},
                service_oil_painting: {priceM2: 15000, min: 2500}
            };

            // Материалы (за м²) или за погонный метр
            // Минимальная цена 250₽ везде
            // Подрамник: 850₽/п.м до 1м², свыше 1м² -> 1100₽/п.м
            // Подрамник + Натяжка: 1275₽/п.м до 1м², свыше 1м² -> 1650₽/п.м
            // ПеноКартон: 3500₽/м² (простая листовая)
            // ПеноКартон + накатка: 5250₽/м²
            // Картон: 2000₽/м²
            // Паспарту: 4400₽/м²
            const MATERIALS = {
                materials_subframe: {
                    min: 250,
                    type: 'subframe', // особая логика
                    priceBefore1m2: 850,
                    priceAfter1m2: 1100
                },
                materials_subframe_tension: {
                    min: 250,
                    type: 'subframe',
                    priceBefore1m2: 1275,
                    priceAfter1m2: 1650
                },
                materials_foamboard: {
                    min: 250,
                    type: 'm2',
                    priceM2: 3500
                },
                materials_foamboard_mount: {
                    min: 250,
                    type: 'm2',
                    priceM2: 5250
                },
                materials_paperboard: {
                    min: 250,
                    type: 'm2',
                    priceM2: 2000
                },
                materials_passepartout: {
                    min: 250,
                    type: 'm2',
                    priceM2: 4400
                }
            };

            // Багетное стекло (за м²) + минимальная цена 250 ₽
            const GLASS = {
                glass_usual: {priceM2: 4400, min: 250},
                glass_matte: {priceM2: 7500, min: 250},
                glass_anti_glare: {priceM2: 30000, min: 250},
                glass_plastic: {priceM2: 4400, min: 250}
            };

            // Крепления (штучно), размеры не нужны
            // Добавлен "bracing_mirror": 750₽
            const BRACING = {
                bracing_standard: {priceEach: 300},
                bracing_reinforced: {priceEach: 500},
                bracing_clamps: {priceEach: 30},
                bracing_mirror: {priceEach: 750}
            };

            // Доставка: фиксированная, кроме выезда за МКАД (60₽/км)
            // При выборе доставки – тоже игнорируем поля размеров.
            const DELIVERY = {
                delivery_sad: {price: 800},
                delivery_ttk: {price: 1000},
                delivery_mkad: {price: 1200},
                delivery_lift: {price: 1500},
                // Если выбрано outside – 60 * distanceInput.val()
                delivery_outside: {pricePerKm: 60}
            };

            // Стандартные размеры А-форматов (мм)
            const A_SIZES = {
                a4: {width: 210, length: 297},
                a3: {width: 297, length: 420},
                a2: {width: 420, length: 594},
                a1: {width: 594, length: 841},
                a0: {width: 841, length: 1189}
            };

            // Текущее активное
            let activeBlock = null;   // service | materials | glass | bracing | delivery
            let activeType = null;   // ключ внутри соответствующего объекта
            let activeSize = null;   // a4 | a3 и т.д. (необязательно)

            // DOM-элементы
            const lengthInput = $('#length-input');
            const widthInput = $('#width-input');
            const countInput = $('#count-input');
            const distanceInput = $('#distance-input'); // км за МКАД
            const priceBlock = $('#price-service');
            const distanceBlock = $('#distance-block'); // показать/спрятать для "за МКАД"

            // Обнуление/вывод цены
            function showPrice(value) {
                priceBlock.text(value + ' ₽');
            }

            function showError(msg) {
                alert(msg);
                priceBlock.text('Невозможно рассчитать');
            }

            // Функция-обёртка для вычислений
            function calc() {
                // Если ничто не выбрано, выходим
                if (!activeBlock || !activeType) {
                    priceBlock.text('Выберите услугу');
                    return;
                }

                // Если выбраны "Крепления" или "Доставка" – игнорируем размеры
                if (activeBlock === 'bracing') {
                    calculateBracing();
                    return;
                }
                if (activeBlock === 'delivery') {
                    calculateDelivery();
                    return;
                }

                // Для остальных (service, materials, glass) считаем по площади (или периметру).
                let lengthMm = parseFloat(lengthInput.val()) || 0;
                let widthMm = parseFloat(widthInput.val()) || 0;
                let qty = parseFloat(countInput.val()) || 1;

                // Проверим на отрицательные/нулевые
                if (lengthMm <= 0 || widthMm <= 0) {
                    showError('Укажите корректные размеры!');
                    return;
                }

                // Считаем площадь в м²
                let area = (lengthMm / 1000) * (widthMm / 1000);
                let perimeter = 2 * ((lengthMm / 1000) + (widthMm / 1000));

                let total = 0;

                if (activeBlock === 'service') {
                    // Печать
                    let data = SERVICES[activeType];
                    total = area * data.priceM2;
                    if (total < data.min) {
                        total = data.min;
                    }
                    total = total * qty;
                    showPrice(Math.round(total));
                } else if (activeBlock === 'materials') {
                    // Материалы
                    let data = MATERIALS[activeType];
                    // Сначала проверяем ограничения по габаритам (если есть)
                    if (LIMITS[activeType]) {
                        const maxW = LIMITS[activeType][0];
                        const maxH = LIMITS[activeType][1];
                        if (lengthMm > maxH || widthMm > maxW) {
                            showError('Превышены допустимые габариты! Свяжитесь со специалистом.');
                            return;
                        }
                    }

                    // Подрамник (периметр) или обычный м²
                    if (data.type === 'subframe') {
                        // Смотрим, <=1 м² или нет
                        let pricePerLm = (area <= 1) ? data.priceBefore1m2 : data.priceAfter1m2;
                        // стоимость = периметр * цена за погонный метр
                        let subTotal = perimeter * pricePerLm;
                        // Минимум 250
                        if (subTotal < data.min) {
                            subTotal = data.min;
                        }
                        total = subTotal * qty;
                    } else if (data.type === 'm2') {
                        let subTotal = area * data.priceM2;
                        if (subTotal < data.min) {
                            subTotal = data.min;
                        }
                        total = subTotal * qty;
                    }
                    showPrice(Math.round(total));
                } else if (activeBlock === 'glass') {
                    // Стекло
                    let data = GLASS[activeType];
                    let subTotal = area * data.priceM2;
                    if (subTotal < data.min) {
                        subTotal = data.min;
                    }
                    total = subTotal * qty;
                    showPrice(Math.round(total));
                }
            }

            // Расчёт для креплений
            function calculateBracing() {
                let qty = parseFloat(countInput.val()) || 1;
                let priceEach = BRACING[activeType].priceEach;
                let total = priceEach * qty;
                showPrice(total);
            }

            // Расчёт для доставки
            function calculateDelivery() {
                let qty = parseFloat(countInput.val()) || 1;
                // обычно доставка оплачивается 1 раз, но если нужно умножать на количество,
                // можно менять логику. Предположим, что пользователь вводит 1 (или нужное число).
                let data = DELIVERY[activeType];
                let total = 0;
                if (activeType === 'delivery_outside') {
                    let dist = parseFloat(distanceInput.val()) || 0;
                    total = dist * data.pricePerKm;
                } else {
                    total = data.price;
                }
                total = total * qty;
                showPrice(total);
            }

            // Функция, чтобы проставить активSize, если пользователь вручную ввёл мм
            function checkIfASize() {
                // Проверим, совпадает ли с одним из A-форматов
                let lengthVal = Number(lengthInput.val());
                let widthVal = Number(widthInput.val());
                let found = null;
                for (let key in A_SIZES) {
                    if (
                        (A_SIZES[key].length === lengthVal && A_SIZES[key].width === widthVal) ||
                        (A_SIZES[key].length === widthVal && A_SIZES[key].width === lengthVal)
                    ) {
                        found = key;
                        break;
                    }
                }
                // Обновим "activeSize", снимем/проставим .active на кнопках
                if (found) {
                    activeSize = found;
                    $('.check-size.active').removeClass('active');
                    $('#' + found).addClass('active');
                } else {
                    activeSize = null;
                    $('.check-size.active').removeClass('active');
                }
            }

            // События
            // 1) Клик по типу (service, materials, glass, bracing, delivery)
            $(document).on('click', '.check-type', function () {
                // Снимаем прежнюю активность
                $('.check-type.active').removeClass('active');
                $(this).addClass('active');

                activeType = $(this).attr('id');
                activeBlock = $(this).data('block');

                // Если выбрали крепления или доставку – скрываем поля для размеров
                if (activeBlock === 'bracing' || activeBlock === 'delivery') {
                    // Прячем
                    $('#length-input').prop('disabled', true);
                    $('#width-input').prop('disabled', true);
                    // Прячем кнопки Аx?
                    $('.check-size').prop('disabled', true);
                    distanceBlock.hide();

                    if (activeBlock === 'delivery') {
                        // Если выбран "delivery_outside", показываем поле ввода км
                        if (activeType === 'delivery_outside') {
                            distanceBlock.show();
                        }
                    }
                } else {
                    // Иначе показываем
                    $('#length-input').prop('disabled', false);
                    $('#width-input').prop('disabled', false);
                    $('.check-size').prop('disabled', false);
                    distanceBlock.hide();
                }

                calc();
            });

            // 2) Клик по "типовым" размерам (А4, А3, ...)
            $(document).on('click', '.check-size', function () {
                $('.check-size.active').removeClass('active');
                $(this).addClass('active');
                activeSize = $(this).attr('id');
                // Подставим ширину и высоту
                lengthInput.val(A_SIZES[activeSize].length);
                widthInput.val(A_SIZES[activeSize].width);
                calc();
            });

            // 3) Изменение полей (длина, ширина, количество)
            $(document).on('change', '.check-dimensions', function () {
                checkIfASize();
                calc();
            });
            $(document).on('change', '.check-change-count', function () {
                calc();
            });
            $(document).on('change', '.check-change-distance', function () {
                calc();
            });

            // При загрузке страницы сразу проверим
            checkIfASize();
            calc();
        });
    </script>


<?

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>