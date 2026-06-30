<?php
$keywords = "Подрамник для картины, подрамник для холста, круглый подрамник";
$title = "Подрамник для картины: что это и зачем нужен";
$description = "Подрамник для картины: что это и зачем нужен узнаем в Багетной мастерской №1";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
<style>
    .care-article {
        max-width: 860px;
        color: #1f1f1f;
        font-family: Cormorant Garamond;
    }

    .care-article__section {
        margin-bottom: 40px;
    }

    .care-article__section--hero {
        margin-top: 28px;
    }

    .care-article__title {
        margin: 0 0 28px;
        color: #d02f2f;
        text-align: center;
        font-family: Cormorant Garamond;
        line-height: 1.35;
        font-weight: 600;
        text-transform: uppercase;
    }

    .care-article__section-title {
        margin: 0 0 26px;
        color: #ff3a18;
        text-align: center;
        font-family: Cormorant Garamond;
        line-height: 1.35;
        font-weight: 500;
        text-transform: uppercase;
    }

    .care-article__intro {
        display: grid;
        gap: 18px;
        margin-bottom: 30px;
    }

    .care-article__intro-grid {
        display: grid;
        grid-template-columns: 320px minmax(0, 1fr);
        gap: 36px;
        align-items: center;
        margin-bottom: 26px;
    }

    .care-article__shape-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 300px;
        gap: 38px;
        align-items: center;
        margin-bottom: 30px;
    }

    .care-article__order-grid {
        display: grid;
        grid-template-columns: 300px minmax(0, 1fr);
        gap: 38px;
        align-items: center;
    }

    .care-article__image {
        display: block;
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .care-article__image--square {
        aspect-ratio: 1 / 1;
    }

    .care-article__image--portrait {
        aspect-ratio: 3 / 4;
    }

    .care-article__text {
        margin: 0;
        color: #474A51;
        font-family: Manrope;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 1.5;
        text-indent: 2em;
    }

    .care-article__text + .care-article__text {
        margin-top: 16px;
    }

    .care-article__button-row {
        display: flex;
        justify-content: center;
        margin: 28px 0 4px;
    }

    .care-article__signature {
        margin-top: 32px;
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
            margin-bottom: 32px;
        }

        .care-article__section--hero {
            margin-top: 18px;
        }

        .care-article__title {
            font-size: 22px;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .care-article__section-title {
            font-size: 21px;
            line-height: 1.25;
            margin-bottom: 18px;
        }

        .care-article__intro {
            gap: 14px;
            margin-bottom: 18px;
        }

        .care-article__intro-grid,
        .care-article__shape-grid,
        .care-article__order-grid {
            grid-template-columns: 1fr;
            gap: 16px;
            margin-bottom: 18px;
        }

        .care-article__intro-grid > .care-article__image,
        .care-article__shape-grid > .care-article__image,
        .care-article__order-grid > .care-article__image {
            order: 1;
            width: 100%;
            max-width: 320px;
            margin: 0 auto;
        }

        .care-article__intro-grid > div,
        .care-article__shape-grid > div,
        .care-article__order-grid > div {
            order: 2;
        }

        .care-article__text {
            font-size: 16px;
            line-height: 1.6;
            text-align: left;
            text-indent: 1em;
        }

        .care-article__text + .care-article__text {
            margin-top: 12px;
        }

        .care-article__button-row {
            margin-top: 20px;
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
            margin-top: 22px;
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
        <h1 class="care-article__title">Подрамник для картины: что это и зачем нужен?</h1>

        <div class="care-article__intro">
            <p class="care-article__text">
                На протяжении многих столетий создаются, пишутся и рисуются картины. Живопись, графика, батик, гобелен —
                это формы искусства, которой нужна основа. Этой основой является подрамник. Годами меняется состав красок,
                разбавителей, материалы для холстов, основы для кистей и лишь форма «натянутый холст» остаётся неизменной.
                Речь идёт о подрамнике — той самой деревянной конструкции, на которую натягивается холст.
            </p>
            <p class="care-article__text">
                Подрамник для холста — это не просто «палка с гвоздями», а основа, от которой зависит, провиснет ли работа
                через год и будут ли на ней заломы.
            </p>
            <p class="care-article__text">
                Вы написали холст, вложили душу в сюжет, подобрали цвета, а повесить картину на стену или отправить
                на выставку, оформить в раму без правильной основы — это рисковать её сохранностью и внешним видом.
            </p>
        </div>

        <div class="care-article__intro-grid">
            <img class="care-article__image care-article__image--square" src="/img/article/podramnik_voin.jpg" alt="Картина на подрамнике в багетной раме">
            <div>
                <p class="care-article__text">
                    Подрамник для холста представляет собой внутреннюю раму, которая служит основой для барабана полотна.
                    За счёт того, что подрамник прилегает к основе очень маленькой площадью, это даёт возможность холсту
                    дышать, и ваше произведение сохраняется на долгие годы. Подрамник может быть стандартный, но зачастую
                    нужен и не стандартный размер. Тут мы начинаем делать свою работу! Мастера, менеджеры и дизайнеры
                    в Багетной мастерской №1 подберут подходящий размер подрамника именно для вашей работы.
                </p>
            </div>
        </div>

        <p class="care-article__text">
            А также проконсультируют о том, какая натяжка нужна именно в вашем случае. Во всём мире подрамники для картин
            делятся на два вида: клиновидный модульный и цельный склеенный. На своём производстве для подрамников
            прямоугольной формы мы используем технологию изготовления цельного подрамника: он более лёгкий, компактный
            и более доступный. При изготовлении подрамника наша команда подбирает нужный размер, ширину и высоту
            подрамника, чтобы он точно подходил под вашу работу.
        </p>

        <div class="care-article__button-row">
            <a href="/baget_for_karini">
                <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white">
                    Как подобрать багет для картины
                </button>
            </a>
        </div>
    </section>

    <section class="care-article__section">
        <h2 class="care-article__section-title">Идеальная форма: круглый подрамник, овальный подрамник</h2>

        <div class="care-article__shape-grid">
            <div>
                <p class="care-article__text">
                    Принято считать, что картина — это прямоугольник, квадрат, вертикаль, горизонталь. Но что, если выйти
                    за жёсткие рамки прямых углов? Всё чаще в современных интерьерах, на выставках и в частных коллекциях
                    встречаются работы на овальных подрамниках для картин. И это не просто дань моде — это осознанный
                    эстетический и композиционный приём. Данная форма позволяет экспериментировать с композицией,
                    выделяться и увлечь зрителя круговым взглядом.
                </p>
                <p class="care-article__text">
                    Круглая или овальная форма сглаживает акцент и визуально смягчает пространство. Найти и купить овальный
                    или круглый подрамник достаточно непросто! В Багетной мастерской №1 есть своё производство круглых
                    и овальных подрамников: для этого мы используем мдф и делаем цельный круг или овал. Максимальный размер
                    круглого подрамника составляет 150 см в диаметре!
                </p>
            </div>
            <img class="care-article__image care-article__image--portrait" src="/img/article/podramnik_ramki.jpg" alt="Картины на подрамниках в багетных рамах">
        </div>

        <div class="care-article__order-grid">
            <img class="care-article__image care-article__image--portrait" src="/img/article/podramnik_more.jpg" alt="Картина на подрамнике в деревянной раме">
            <div>
                <p class="care-article__text">
                    Область применения круглого подрамника не ограничивается только картиной: на подрамник оформляются
                    и гобелены, и платки, габаритные вышивки, а в некоторых случаях может быть натянута и бумага.
                </p>
                <p class="care-article__text">
                    Для заказа нужного подрамника оставьте заявку на сайте, в мессенджере или звоните — будем рады вам помочь!
                </p>
            </div>
        </div>

        <div class="care-article__button-row">
            <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white" type="button" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь
            </button>
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
