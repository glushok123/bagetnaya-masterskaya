<?php
$keywords = "Накатка, пенокартон, основа для фото";
$title = "Накатка на пенокартон в Багетной мастерской №1";
$description = "ИДЕАЛЬНАЯ ОСНОВА ДЛЯ ФОТО И ОСОБЕННОСТИ НАКАТКИ ИЗОБРАЖЕНИЙ В БАГЕТНОЙ МАСТЕРСКОЙ №1";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
    <style>
        .font-20 {
            font-size: 20px;
        }

        .flex-image {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            width: 100%;
            max-height: 320px;
            gap: 20px;
            justify-content: center;
            align-items: center;
        }

        .flex-image img {
            object-fit: cover;
            height: 320px;
            border-radius: 20px;
            justify-content: center;
            text-align: center;

        }

        p {

            color: #474A51;
            font-family: Manrope;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            padding-bottom: 15px;

        }

        .text {
            color: #474A51;
            font-family: Manrope, serif;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
        }

        h3 {
            font-family: Cormorant Garamond;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .red {
            color: #AD1F2D;
        }
    </style>

    <div class="container">
        <div class="row text-center mt-3 mb-5">
            <h1 class="color-main block-h1">ПЕНОКАРТОН: ИДЕАЛЬНАЯ ОСНОВА ДЛЯ ФОТО И
                ОСОБЕННОСТИ НАКАТКИ ИЗОБРАЖЕНИЙ В
                БАГЕТНОЙ МАСТЕРСКОЙ №1</h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-3">
                <img src="/img/article/IMG_6100.jpg" style="
                        object-fit: contain;
                        width: 100%;
                        border-radius: 20px;
                    ">
            </div>
            <div class="col-12 col-md-6 my-auto">
                <div class="text my-auto text-center">
                    Пенокартон – популярный материал, широко используемый для создания качественных фотопанно, постеров
                    и рекламных изделий. Благодаря своей жесткости, легкости и доступной цене он является отличной базой
                    для фотографий и постеров, а технология накатывания фото позволяет добиться безупречного
                    результата.
                </div>
            </div>
            <div class="col-12 col-md-3">
                <img src="/img/article/IMG_6099.jpg" style="
                        object-fit: contain;
                        width: 100%;
                        margin-left: -15px;
                        border-radius: 20px;
                    ">
            </div>
        </div>

        <div class="row text-center m-4">
            <h3>ЧТО ТАКОЕ ПЕНОКАРТОН?</h3>
        </div>

        <div class="text text-center">
            Пенокартон (или вспененный пластик) – это многослойный материал, состоящий из двух слоев бумаги или пластика
            и вспененного полистирола между ними. Он обладает рядом преимуществ
        </div>

        <div class="text text-center mt-2">
            <span class="red">- Легкость</span>
            – удобен для транспортировки и монтажа.
        </div>
        <div class="text text-center mt-2">
            <span class="red">- Жесткость</span>
            – хорошо держит форму, не деформируется.
        </div>
        <div class="text text-center mt-2">
            <span class="red">- Доступность</span>
            – дешевле, чем дерево или металл.
        </div>
        <div class="text text-center mt-2">
            <span class="red">- Универсальность</span>
            – подходит для печатных фотографий и постеров, рекламы, художественных работ.
        </div>


        <div class="row text-center m-4">
            <h3>НАКАТКА ИЗОБРАЖЕНИЙ И ЭТАПЫ ПРОЦЕССА</h3>
        </div>

        <div class="text text-center">
            Накатка – это процесс нанесения отпечатанного изображения на основу с помощью клеевого состава. В Багетной
            мастерской №1 эта технология позволяет создавать долговечные и визуально привлекательные изделия.
        </div>
        <div class="text text-center m-2 red">
            Этапы процесса
        </div>

        <div class="row m-3 flex-4">
            <div class="col-12 col-md-4 text-center hide-mobile">
                <img src="/img/article/IMG_7531.jpg" style="
                        object-fit: contain;
                        max-height: 300px;
                        width: 100%;
                        border-radius: 20px;
                    ">

            </div>
            <div class="col-12 col-md-8 my-auto">
                <div class="text  mt-2">
                    <span class="red">1. Подготовка изображения</span>
                    – фотография печатается на бумаге или пленке с учетом размера основы.
                </div>
                <div class="text  mt-2">
                    <span class="red">2. Нанесение клея</span>
                    – специальный клей с нейтральным Ph равномерно распределяется по поверхности основы. Состав
                    специального клея для накатки фото не портит изображения в процессе эксплуатации.
                </div>
                <div class="text  mt-2">
                    <span class="red">3. Соединение</span>
                    – отпечаток аккуратно накладывается на основу, разглаживается для удаления пузырьков воздуха.
                </div>
                <div class="text  mt-2">
                    <span class="red">4. Обрезка</span>
                    – излишки материала удаляются, края изделия становятся ровными.
                </div>
            </div>
        </div>

        <div class="text text-center">
            Рассчитать стоимость работ и услуг можно самостоятельно по ссылке ниже!
        </div>

        <div class="row text-center justify-content-center  m-4">
            <a href="/prices_for_print_and_canvas">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    комплект для картины</b></button>
            </a>
        </div>

        <div class="row m-3 flex-4">
            <div class="col-12 col-md-8 my-auto">
                <div class="text text-center">
                    Пенокартон – это удобная и практичная основа для многих видов работ, а технология накатки позволяет
                    создавать яркие и долговечные изделия. В Багетной мастерской №1 такой метод пользуется спросом
                    благодаря простоте обработки и отличному результату. Если вам нужно качественное оформление
                    фотографий или рекламных материалов, оставляйте заявку на обратную связь – наши специалисты свяжутся
                    с Вами в кратчайшие сроки для консультации!
                </div>
            </div>

            <div class="col-12 col-md-4 text-center">
                <img src="/img/article/IMG_2985.jpg" style="
                        object-fit: cover;
                        height: auto;
                        width: 100%;
                        margin-left: -15px;
                        border-radius: 20px;
                    ">

            </div>

        </div>

        <div class="row text-center justify-content-center mt-3 mb-5">

            <button
                    class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь</b></button>

        </div>

        <div class="row text-center mt-5">
            <h4>С уважением к Вам,</h4>
            <h4>С любовью к Искусству! </h4>
            <h4>Команда Багетной мастерской №1</h4>
        </div>
    </div>


<?

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>