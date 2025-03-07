<?php
$keywords = "Подрамник, натяжка холста, холст на подрамнике";
$title = "В поисках мастерской, где качественно выполнят работу по натяжке холста?";
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
            <h1 class="color-main block-h1">ПОДРАМНИК ДЛЯ КАРТИН В БАГЕТНОЙ
                МАСТЕРСКОЙ №1</h1>
        </div>

        <div class="flex-image">
            <img src="/img/article/IMG_0484.jpg" class="mx-auto">
            <img src="/img/article/IMG_9708.jpg" class="mx-auto">
            <img src="/img/article/IMG_8571.jpg" class="mx-auto">
        </div>
        <div class="text-center m-3 font-20">
            Натяжка холста — это важный этап создания картины, который влияет на её внешний вид, долговечность и
            презентабельность. Правильно выполненная натяжка на подрамник обеспечивает ровную поверхность, предотвращает
            провисание холста и его деформацию, а также подчеркивает художественную ценность произведения. В этой статье
            мы рассмотрим основные виды натяжки: галерейную, студийную и стандартную, а также
            их особенности.
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
                <p class="block-p-1">Стандартная натяжка холста — это классический способ, при котором холст крепится к
                    подрамнику с помощью скоб. Края холста заворачиваются на боковые стороны подрамника, а изображение
                    располагается на лицевой части. Такой метод подходит для картин, которые будут оформляться в
                    багетную раму.</p>
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
                <p class="block-p-1">Галерейная натяжка холста — это метод, при котором холст натягивается так, что
                    изображение продолжается на боковых сторонах подрамника. Это создаёт эффект 3D и позволяет
                    выставлять картину без дополнительного оформления в раму.
                    Такой способ часто используется в современном искусстве и
                    галереях.</p>
                <p class="block-p-1" style="padding: 0; margin: 0;"><span
                            style="color: #AD1F2D; margin: 0; padding: 5px;">Особенности:</span></p>
                <p class="block-p-1" style="padding: 0; margin: 0;">- Изображение переходит на боковые стороны.</p>
                <p class="block-p-1" style="padding: 0; margin: 0;">- Холст на подрамнике выглядит завершенным и без рамы.</p>
                <p class="block-p-1" style="padding: 0; margin: 0;">- Идеально для современных интерьеров и выставок.</p>

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
                <p class="block-p-1">Студийная натяжка холста — это промежуточный вариант между стандартной и галерейной
                    натяжкой. Холст крепится к подрамнику так, что его края остаются чистыми, но изображение не
                    переходит на боковые стороны. Этот метод часто используется для картин, которые планируется оформить
                    в раму, но с минималистичным дизайном.</p>
                <p class="block-p-1" style="padding: 0; margin: 0;"><span
                            style="color: #AD1F2D; margin: 0; padding: 5px;">Особенности:</span></p>
                <p class="block-p-1" style="padding: 0; margin: 0;">- Края холста остаются чистыми. </p>
                <p class="block-p-1" style="padding: 0; margin: 0;">- Подходит для холстов с тонкой рамой или без неё.</p>
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
            <h3>КАК ВЫБРАТЬ ПОДХОДЯЩИЙ СПОСОБ НАТЯЖКИ?</h3>
        </div>

        <div class="row m-3 flex-4">
            <div class="col-12 col-md-8 my-auto">
                <p style="font-weight: bold">Выбор способа натяжки холста зависит от ваших целей и предпочтений: </p>
                <p class="block-p-1">- Если картина будет оформляться в багетную раму, выбирайте стандартную
                    натяжку. </p>
                <p class="block-p-1">- Для современного интерьера или выставки без рамы подойдёт галерейная
                    натяжка. </p>
                <p class="block-p-1">- Если вы хотите сохранить минимализм, но с возможностью добавления рамы,
                    остановитесь на студийной натяжке.</p>
            </div>

            <div class="col-12 col-md-4 text-center">
                <img src="/img/article/IMG_0710.jpg" style="
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
            <h3>ПРЕИМУЩЕСТВА ПРОФЕССИОНАЛЬНОЙ НАТЯЖКИ В
                БАГЕТНОЙ МАСТЕРСКОЙ №1</h3>
        </div>

        <div class="font-20 text-center">Процесс подготовки подрамника требует навыков и опыта. Профессиональное
            выполнение этой работы нашими специалистами гарантирует:
        </div>
        <div class="font-20 text-center">- Ровную поверхность без складок и провисаний.</div>
        <div class="font-20 text-center">- Долговечность картины.</div>
        <div class="font-20 text-center mt-3">- Эстетичный вид и презентабельность.</div>

        <div class="text-center m-3 font-20">
            Холст на подрамнике — это не просто технический процесс, а важный этап создания картины, который влияет на
            её восприятие и долговечность. Выбор между стандартной, галерейной и студийной натяжкой зависит от ваших
            целей и стиля произведения. Независимо от выбора, доверяйте эту работу профессионалам, чтобы ваша картина
            выглядела безупречно и радовала вас долгие годы.
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