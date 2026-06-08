<?php
$keywords = "Уход за рамками,  уход за картиной в раме, багетная мастерская";
$title = "Искусство жить долго: как правильно ухаживать за рамами и картинами, советы от Багетной мастерской";
$description = "Главные правила ухода за рамами от команды Багетной мастерской №1";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
<style>
    .care-article {
        max-width: 860px;
        color: #1f1f1f;
        font-family: Cormorant Garamond;
    }

    .care-article__section {
        margin-bottom: 34px;
    }

    .care-article__section--hero {
        margin-top: 28px;
    }

    .care-article__title,
    .care-article__subtitle {
        margin: 0;
        text-align: center;
        font-family: Cormorant Garamond;
        line-height: 1.35;
        font-weight: 600;
        text-transform: uppercase;
    }

    .care-article__title {
        color: #d02f2f;
    }

    .care-article__subtitle {
        color: #1f1f1f;
        margin-bottom: 28px;
    }

    .care-article__section-title {
        margin: 0 0 24px;
        color: #ff3a18;
        text-align: center;
        font-family: Cormorant Garamond;
        line-height: 1.35;
        font-weight: 500;
        text-transform: uppercase;
    }

    .care-article__hero-grid {
        display: grid;
        grid-template-columns: 170px minmax(0, 1fr) 170px;
        gap: 34px;
        align-items: center;
    }

    .care-article__rules-grid,
    .care-article__dust-grid {
        display: grid;
        grid-template-columns: 170px minmax(0, 1fr);
        gap: 30px;
        align-items: start;
    }

    .care-article__dust-grid {
        grid-template-columns: minmax(0, 1fr) 180px;
        gap: 34px;
        align-items: center;
    }

    .care-article__stack {
        display: grid;
        gap: 44px;
    }

    .care-article__image {
        display: block;
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .care-article__hero-image {
        aspect-ratio: 1 / 1.5;
    }

    .care-article__rule-image {
        aspect-ratio: 1 / 1.48;
    }

    .care-article__dust-image {
        aspect-ratio: 1 / 1.5;
    }

    .care-article__text {
        margin: 0;
        color: #474A51;
        font-family: Manrope;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        padding-bottom: 15px;
        text-indent: 2em;
    }

    .care-article__rules {
        display: grid;
        gap: 22px;
    }

    .care-article__rule {
        margin: 0;
        color: #474A51;
        font-family: Manrope;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        padding-bottom: 15px;
    }

    .care-article__button-row {
        display: flex;
        justify-content: center;
        margin: 24px 0 4px;
    }

    .care-article__signature h3 {
        font-family: Cormorant Garamond;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
    }

    @media screen and (max-width: 767.98px) {
        .care-article {
            max-width: 100%;
            padding-right: 16px;
            padding-left: 16px;
        }

        .care-article__section {
            margin-bottom: 30px;
        }

        .care-article__section--hero {
            margin-top: 18px;
        }

        .care-article__title {
            font-size: 22px;
            line-height: 1.2;
        }

        .care-article__subtitle,
        .care-article__section-title {
            font-size: 21px;
            line-height: 1.25;
        }

        .care-article__subtitle {
            margin-bottom: 20px;
        }

        .care-article__section-title {
            margin-bottom: 18px;
        }

        .care-article__hero-grid,
        .care-article__rules-grid,
        .care-article__dust-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .care-article__hero-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            align-items: start;
        }

        .care-article__hero-grid > div {
            grid-column: 1 / -1;
            order: 1;
        }

        .care-article__hero-grid > img {
            order: 2;
        }

        .care-article__stack {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .care-article__hero-image,
        .care-article__rule-image,
        .care-article__dust-image {
            width: 100%;
            max-width: 320px;
            margin: 0 auto;
        }

        .care-article__hero-image {
            max-width: none;
        }

        .care-article__dust-image {
            order: 1;
        }

        .care-article__dust-grid > div {
            order: 2;
        }

        .care-article__text,
        .care-article__rule {
            font-size: 16px;
            line-height: 1.6;
            text-align: left;
            text-indent: 1em;
            padding-bottom: 12px;
        }

        .care-article__rules {
            gap: 0;
        }

        .care-article__button-row {
            margin-top: 18px;
        }

        .care-article__button-row a,
        .care-article__button-row button {
            width: 100%;
            max-width: 340px;
        }

        .care-article__button-row button {
            white-space: normal;
            line-height: 1.25;
        }

        .care-article__signature {
            margin-top: 6px;
            margin-bottom: 24px;
        }

        .care-article__signature h3 {
            margin-bottom: 8px;
            font-size: 22px;
        }
    }
</style>
<div class="container care-article">
    <section class="care-article__section care-article__section--hero">
        <h1 class="care-article__title">ИСКУССТВО ЖИТЬ ДОЛГО:</h1>
        <h2 class="care-article__subtitle">КАК ПРАВИЛЬНО УХАЖИВАТЬ ЗА РАМАМИ И КАРТИНАМИ</h2>

        <div class="care-article__hero-grid">
            <img class="care-article__image care-article__hero-image" src="/img/article/FullSizeRender (2).JPG" alt="Картина в бирюзовой раме">
            <div>
                <p class="care-article__text">
                    Музей, галерея, загородный дом или городская квартира — в любом интерьере найдутся произведения искусства.
                    Картины, гобелены, батик, графика, скульптура, мозаика. Большие и маленькие, из стекла и дерева, мрамора и ткани.
                    Все эти предметы объединяет одно: они требуют правильного и бережного ухода.
                </p>
                <p class="care-article__text">
                    Багетная рама — не просто декоративный аксессуар, а сложное изделие, которое защищает художественную работу
                    и задаёт тон всему интерьеру. Как продлить жизнь раме и её содержимому? Запоминайте несколько простых, но важных правил.
                </p>
            </div>
            <img class="care-article__image care-article__hero-image" src="/img/article/FullSizeRender (3).JPG" alt="Картина с цветами в бирюзовой раме">
        </div>

        <div class="care-article__button-row">
            <a href="/baget_online">
                <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white">
                    Рассчитать стоимость багета
                </button>
            </a>
        </div>
    </section>

    <section class="care-article__section">
        <h2 class="care-article__section-title">ГЛАВНЫЕ ПРАВИЛА УХОДА ЗА РАМАМИ ОТ КОМАНДЫ БАГЕТНОЙ МАСТЕРСКОЙ №1</h2>

        <div class="care-article__rules-grid">
            <div class="care-article__stack">
                <img class="care-article__image care-article__rule-image" src="/img/article/IMG_5241.JPG" alt="Картина в черной раме">
                <img class="care-article__image care-article__rule-image" src="/img/article/IMG_5133.JPG" alt="Декоративная деревянная рама">
            </div>
            <div class="care-article__rules">
                <p class="care-article__rule">
                    - Прямой солнечный свет – это главный враг. Размещайте картины на стенах, куда не попадает прямой солнечный свет.
                    Ультрафиолет приводит к следующим последствиям: выцветанию плёнки на рамах из пластика и алюминия;
                    деформации и рассыханию деревянных рам; выгоранию самого изображения.
                </p>
                <p class="care-article__rule">
                    - Убираем пыль правильно: деревянные рамы - только сухая уборка (мягкая салфетка из микрофибры, сухая тряпка для пыли).
                    Пластик и алюминий протирать можно слегка влажной салфеткой, без агрессивной химии.
                    Рамы с обычным стеклом допускается очищать специальными средствами для чистки стёкол.
                    Музейное стекло: никаких жидкостей и спреев! Только сухая обработка мягкой кистью или пипидастром.
                    Ручное золочение: исключительно сухая уборка неабразивными тканями и салфетками.
                    Никакой влаги позолота может осыпаться.
                </p>
                <p class="care-article__rule">
                    Важно помнить, что влажная уборка не продлевает чистоту. Наоборот, попавшая внутрь рамы влага
                    губительна для бумаги, ткани и красочного слоя. Многие работы специально консервируют, чтобы избежать контакта с водой.
                </p>
            </div>
        </div>

        <div class="care-article__button-row">
            <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white" type="button" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь
            </button>
        </div>
    </section>

    <section class="care-article__section">
        <h2 class="care-article__section-title">ПРОТИВ ПЫЛИ (БЕЗ ВРЕДА ДЛЯ ИСКУССТВА)</h2>

        <div class="care-article__dust-grid">
            <div>
                <p class="care-article__text">
                    Пыль является неотъемлемой частью нашей жизни. Полностью избавиться от неё невозможно,
                    остаётся только регулярный и правильный уход. На что обратить внимание, это на то, что на тёмных рамах пыль заметна сильнее.
                    Если вы приверженец перфекционизма - присмотритесь к рамам в светлых оттенках
                    (они визуально дольше остаются чистыми). Используйте пипидастр и мягкие кисти для смахивания пыли
                    с декоративных и резных багетов. Сухие салфетки без ворса - ваш лучший друг для гладких поверхностей.
                </p>
                <p class="care-article__text">
                    Багетное изделие - это полноценный аксессуар интерьера, который требует такого же бережного и внимательного отношения,
                    как и само произведение искусства. Правильный уход не занимает много времени, но позволяет сохранить цвет,
                    фактуру и форму рамы на десятилетия.
                </p>
                <p class="care-article__text">
                    Берегите свои коллекции. А мы поможем их оформить!
                </p>
            </div>
            <img class="care-article__image care-article__dust-image" src="/img/article/FullSizeRender (1).JPG" alt="Картина в резной раме">
        </div>

        <div class="care-article__button-row">
            <a href="/bagetnye_ramki/">
                <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white">
                    Рамки для картин
                </button>
            </a>
        </div>
    </section>

    <div class="row text-center care-article__signature">
        <h3>С уважением к Вам,</h3>
        <h3>С любовью к Искусству!</h3>
        <h3>Багетная мастерская №1</h3>
    </div>
</div>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
