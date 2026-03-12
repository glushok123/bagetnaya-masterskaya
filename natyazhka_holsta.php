<?php
$keywords = "натяжка холста, круглый холст, холст на подрамнике";
$title = "В поисках багетной мастерской, где качественно выполнят работу по ?";
$description = "Профессиональная натяжка холста на подрамник в Багетной мастерской №1";

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

        h3 {
            font-family: Cormorant Garamond;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }
    </style>

    <div class="container">
        <div class="row text-center mt-3 mb-5">
            <h1 class="color-main block-h1">НАТЯЖКА ХОЛСТА: ОСОБЕННОСТИ И ВИДЫ</h1>
        </div>

        <div class="flex-image">
            <img src="/img/article/IMG_0484.jpg" class="mx-auto">
            <img src="/img/article/IMG_9708.jpg" class="mx-auto">
            <img src="/img/article/IMG_8571.jpg" class="mx-auto">
        </div>
        <div class="text-center m-3 font-20">
            Картина на холсте – популярный вид изобразительного искусства, который часто можно встретить не только в
            художественных галереях, но также в офисных пространствах и домашних интерьерах. Художники часто выбирают
            холст как главный материал для написания картин в различных техниках и разнообразными материалами. И главным
            здесь помощником выступает подрамник. Холст на подрамнике различных форм и размеров часто преображается в
            готовое произведение искусства даже без обрамления! В данной статье рассказываем, какие виды натяжки
            существуют, их преимущества и различия.
        </div>

        <div class="row text-center m-4">
            <h3>ЧТО ТАКОЕ ПОДРАМНИК ДЛЯ КАРТИНЫ?</h3>
        </div>
        <div class="text-center m-3 font-20">
            <span style="color: #AD1F2D;">Подрамник</span> — это деревянная конструкция, на которую натягивается холст.
            Он служит основой для картины,
            обеспечивая её жёсткость и устойчивость. Подрамник может быть модульным (с возможностью регулировки) или
            глухим (фиксированным). Выбор подрамника зависит от размера холста, техники исполнения и желаемого
            результата.
        </div>
        <div class="row text-center justify-content-center mt-3 mb-5">
            <a href="/prices_for_print_and_canvas">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Рассчитать стоимость </b></button>
            </a>
        </div>

        <div class="row text-center m-4">
            <h3>ВИДЫ НАТЯЖКИ ХОЛСТА</h3>
        </div>

        <div class="row m-3 flex-4">
            <div class="col-12 col-md-4 text-center hide-mobile">
                <h3 style="color: #AD1F2D;">СТАНДАРТНАЯ</h3>
                <img src="/img/article/IMG_0575.jpeg" style="
                        object-fit: cover;
                        height: auto;
                        max-height: 300px;
                        object-position: top; /* Центрирует изображение */
                        width: 100%;
                        margin-left: -15px;
                        border-radius: 20px;
                    ">

            </div>
            <div class="col-12 col-md-8 my-auto">
                <p class="block-p-1">Стандартная или обычная натяжка – это способ фиксации холста на деревянный каркас,
                    при котором скоба фиксирует холст в торце подрамника. Данный способ самый распространенный и
                    применяется для тех картин, которые в дальнейшем будут обрамлены в багетную раму .</p>
                <p class="block-p-1" style="padding: 0; margin: 0;"><span
                            style="color: #AD1F2D; margin: 0; padding: 5px;">Особенности:</span></p>
                <p class="block-p-1" style="padding: 0; margin: 0;">- Края холста видны сбоку. </p>
                <p class="block-p-1" style="padding: 0; margin: 0;">- Подходит для картин на подрамнике с рамкой. </p>
                <p class="block-p-1" style="padding: 0; margin: 0;">- Простота исполнения и доступность.</p>

            </div>
        </div>

        <div class="row m-5 flex-4">
            <div class="col-12 col-md-4 text-center hide-mobile">
                <h3 style="color: #AD1F2D;">ГАЛЕРЕЙНАЯ</h3>
                <img src="/img/article/IMG_0573.jpeg" style="
                        object-fit: cover;
                        height: auto;
                         max-height: 300px;
                         object-position: top; /* Центрирует изображение */
                        width: 100%;
                        margin-left: -15px;
                        border-radius: 20px;
                    ">

            </div>
            <div class="col-12 col-md-8 my-auto">
                <p class="block-p-1">Галерейная натяжка – это вид фиксации, при котором изображение продолжается на
                    торце подрамника, а фиксация скобами происходит на оборотной стороне подрамника. Такой способ
                    натяжки используется в случаях, если картину планируется разместить в интерьере без обрамления или в
                    багетный L-профиль. </p>
                <p class="block-p-1" style="padding: 0; margin: 0;"><span
                            style="color: #AD1F2D; margin: 0; padding: 5px;">Особенности:</span></p>
                <p class="block-p-1" style="padding: 0; margin: 0;">- Изображение переходит на боковые стороны.</p>
                <p class="block-p-1" style="padding: 0; margin: 0;">- Холст на подрамнике выглядит завершенным и без
                    рамы.</p>
                <p class="block-p-1" style="padding: 0; margin: 0;">- Идеально для современных интерьеров и
                    выставок.</p>

            </div>
        </div>

        <div class="row m-3 flex-4">
            <div class="col-12 col-md-4 text-center hide-mobile">
                <h3 style="color: #AD1F2D;">СТУДИЙНАЯ</h3>
                <img src="/img/article/IMG_0574.jpeg" style="
                        object-fit: cover;
                        height: auto;
                         max-height: 300px;
                           object-position: top; /* Центрирует изображение */

                        width: 100%;
                        margin-left: -15px;
                        border-radius: 20px;
                    ">

            </div>
            <div class="col-12 col-md-8 my-auto">
                <p class="block-p-1">Студийная натяжка – особый способ фиксации часто печатных холстов, при котором
                    изображение остается полностью на лицевой стороне подрамника, торцевую сторону подрамника огибает
                    белая часть холста, а фиксация происходит на оборотной стороне. Такой метод фиксации холста на
                    подрамник используется реже вышеупомянутых.</p>
                <p class="block-p-1" style="padding: 0; margin: 0;"><span
                            style="color: #AD1F2D; margin: 0; padding: 5px;">Особенности:</span></p>
                <p class="block-p-1" style="padding: 0; margin: 0;">- Края холста остаются чистыми. </p>
                <p class="block-p-1" style="padding: 0; margin: 0;">- Подходит для холстов с тонкой рамой или без
                    неё.</p>
                <p class="block-p-1" style="padding: 0; margin: 0;">- Универсальность и эстетичность.</p>

            </div>
        </div>


        <div class="row text-center justify-content-center mt-3 mb-5">

            <button
                    class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь</b></button>

        </div>

        <div class="row text-center m-4">
            <h3>КРУГЛЫЙ ХОЛСТ</h3>
        </div>

        <div class="row m-3 flex-4">
            <div class="col-12 col-md-8 my-auto">

                <p class="block-p-1">Особенно популярны сегодня круглые и овальные картины. За счет не прямоугольной
                    формы они освежают интерьеры и делают их более запоминающимися. В Багетной мастерской №1 Вы можете
                    также заказать правильный подрамник для овального или круглого холста любого диаметра!</p>
            </div>

            <div class="col-12 col-md-4 text-center">
                <img src="/img/article/IMG_3675.JPG" style="
                        object-fit: cover;
                        height: auto;
                        width: 100%;
                        margin-left: -15px;
                        border-radius: 20px;
                    ">

            </div>

        </div>

        <div class="row text-center justify-content-center mt-3 mb-5">
            <a href="/baget_online">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                    Рассчитать стоимость багета</b></button>
            </a>
        </div>

        <div class="row text-center m-4">
            <h3>ДОВЕРЯЙТЕ ПРОФЕССИОНАЛАМ</h3>
        </div>

        <div class="font-20 text-center">Если у Вас появилась необходимость в изготовлении подрамника для Вашей картины – лучше обращаться в профессиональные багетные салоны. Команда Багетной мастерской №1 создаст для Вас подходящий подрамник, а также предоставляет гарантию 1 год на все предоставленные услуги!
        </div>


        <div class="text-center m-3 font-20">
            Холст на подрамнике – это не только про технический процесс, но основополагающий этап в обрамлении картин. Натяжка холста подразумевает бережность, внимательность и заботливое отношение к картине.
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