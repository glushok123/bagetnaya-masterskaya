<?php
$keywords = "купить багет для картин, недорогой багет для картины, рамка на заказ, рамка для картины";
$title = "Рамки для картин на заказ в Багетной мастерской №1 по доступным ценам!";
$description = "Широкий ассортимент рам на заказ, по выгодным ценам в кратчайшие сроки в Багетной мастерской №1";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>
    <style>
        .article-block {
            margin-bottom: 25px;
        }

        .article-block p {
            color: #474A51;
            font-family: Manrope;
            font-size: 20px;
            font-weight: 400;
            text-align: justify;
            text-indent: 30px;
        }

        .article-block ul {
            color: #474A51;
            font-family: Manrope;
            font-size: 20px;
            font-weight: 400;
        }

        .article-block li {
            margin-bottom: 12px;
            text-align: justify;
        }

        .article-img {
            display: block;
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 6px;
            margin-bottom: 16px;
        }

        /* прижать фото к тексту (к центру страницы) */
        .hug-right {
            margin-left: auto;
            margin-right: 0;
        }

        .hug-left {
            margin-left: 0;
            margin-right: auto;
        }

        h1.color-main,
        h2.color-main {
            text-transform: uppercase;
        }

        @media screen and (max-width: 767px) {

            .article-block p,
            .article-block ul {
                font-size: 16px;
            }

            /* на мобильном — по левому краю (читабельнее), без отступа абзаца */
            .article-block p,
            .article-block li {
                text-align: left;
                text-indent: 0;
            }

            .article-img {
                max-width: 260px;
                margin-left: auto;
                margin-right: auto;
            }

            h1.color-main,
            h2.color-main {
                font-size: 24px;
            }
        }
    </style>

    <div class="container home_design">

        <!-- H1 -->
        <div class="row text-center mt-3 mb-3">
            <h1 class="color-main">Багеты для картин<br>в Багетной мастерской №1</h1>
        </div>

        <!-- H2 -->
        <div class="row text-center mb-4">
            <h2 class="color-main">Рамка для картины, прихоть или необходимая часть произведения?</h2>
        </div>

        <!-- Вступление: на всю ширину -->
        <div class="row article-block">
            <div class="col-12">
                <p>
                    Если мы назовем слово «картина», автоматически всплывает образ картины в раме. Когда
                    картина и рама стали неотъемлемой частью друг друга? Обращаясь к истории, мы найдем первые
                    упоминания о настенной живописи которую украшали узорами еще в VII-II веке до н.э. В
                    древнем Риме активно использовали архитектурные элементы для разделения фресок друг от
                    друга. Еще в средневековых рукописных манускриптах страницы украшали декоративной
                    обводкой рамкой.
                </p>
            </div>
        </div>

        <!-- Текст СЛЕВА, триптих СПРАВА (по центру по вертикали) -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-8">
                <p>
                    В привычном смысле рамка для картины появилась в эпоху возрождения и связано это с
                    активным развитием станковой живописи. В исторических заметках есть первые упоминания об
                    обильно украшенных полотнах рамой, которая была уже отдельной частью произведения, а не
                    частью живописи. В тоже время начинается активное использование рам, с различными
                    элементами барельефа.
                </p>
            </div>
            <div class="col-12 col-md-4">
                <img src="/img/article/kartina_baget_3.jpg" class="article-img hug-left" alt="Триптих картин в багетной раме">
            </div>
        </div>

        <!-- Фото СЛЕВА, текст СПРАВА (по центру по вертикали) -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-4">
                <img src="/img/article/kartina_baget_2.jpg" class="article-img hug-right" alt="Картина «Чесменский бой» в багетной раме">
            </div>
            <div class="col-12 col-md-8">
                <p>
                    Каждая картина была обрамлена в индивидуально изготовленную раму. С течением времени
                    появилось негласное правило, что картина – как законченный предмет искусства должна
                    находится в раме. Рамка для картины выполняет и защитную и эстетическую функцию. Не смотря
                    на активно развивающийся стиль минимализма, и использование 3D-холстов на подрамнике,
                    которые подразумевают продолжение картины на торцах, обрамление остается очень актуальной
                    темой.
                </p>
            </div>
        </div>

        <!-- Кнопка: Рассчитать стоимость багета -->
        <div class="row text-center justify-content-center mt-3 mb-5">
            <a href="/baget_online">
                <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white">
                    Рассчитать стоимость багета
                </button>
            </a>
        </div>

        <!-- На всю ширину -->
        <div class="row article-block">
            <div class="col-12">
                <p>
                    Как и в любой сфере жизни, в багетной есть свои модные течения, тренды и стили. Ни один
                    дизайн проект не обходится без настенного декора, в роли которого выступает освещение,
                    полки и конечно картины, постеры, фотографии и другое. Настенный декор, который можно
                    отнести к изобразительному или декоративному искусству размещается в раме. Классические
                    мотивы будь то пейзаж, натюрморт или портрет должны быть обрамлены, чтобы сюжет отделялся
                    от общей среды, и при этом именно рама является проводником от объекта к интерьеру.
                </p>
                <p>
                    В багетной мастерской №1 вы сможете подобрать и заказать как багетную рамку так и сделать
                    рамку на заказ. В чем разница рамы и багета? Багет – это рейка, хлыст, молдинг,
                    направляющая, которая имеет или не имеет декоративного покрытия и длиной от 2,85 до 2,9
                    метров. Из такого материала собираются рамки прямоугольной формы, где все 4 угла на такой
                    раме будут одинаковые. В случае, если вам нужна овальная, круглая рама или рамка с
                    разносторонними элементами, что нельзя сделать из рейки – это будет рамка на заказ,
                    которая изготовится индивидуально для вас из дерева благородных пород.
                </p>
            </div>
        </div>

        <!-- Кнопка: Оставить заявку на обратную связь -->
        <div class="row text-center justify-content-center mt-3 mb-5">
            <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white"
                    data-bs-toggle="modal" data-bs-target="#feedbackModal">
                Оставить заявку на обратную связь
            </button>
        </div>

        <!-- Список СЛЕВА, фото СПРАВА (по центру по вертикали) -->
        <div class="row article-block align-items-center">
            <div class="col-12 col-md-8">
                <p>Купить багет для картины можно удобными для вас способами:</p>
                <ul>
                    <li>
                        онлайн через заказ на сайте, где есть удобный конструктор, в который вы можете
                        загрузить изображение и получить макет будущей рамы;
                    </li>
                    <li>
                        рамка на заказ может быть оформлена по телефону, почте или через мессенджер;
                    </li>
                    <li>
                        а также лучшим и самым надежным способом остается живая встреча в Багетной мастерской
                        №1, где представлен широкий ассортимент багетов и рам;
                    </li>
                    <li>
                        выездной подбор багета, в рамках которого наш дизайнер приезжает к Вам!
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-4">
                <img src="/img/article/kartina_baget_1.jpg" class="article-img hug-left" alt="Картина с цветами в багетной раме">
            </div>
        </div>

        <!-- На всю ширину: сроки -->
        <div class="row article-block">
            <div class="col-12">
                <p>
                    Недорогой багет для картины всегда можно найти в наших мастерских как из материала в
                    наличии, так и под заказ. Сроки изготовления рам и оформительских работ занимают в среднем
                    3-7 дней, есть опция срочного выполнения заказа от нескольких часов до суток. Будем рады
                    оформить ваше искусство!
                </p>
            </div>
        </div>

        <!-- Кнопка: Как подобрать багет для картины -->
        <div class="row text-center justify-content-center mt-3 mb-4">
            <a href="/baget_for_karini">
                <button class="button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white">
                    Как подобрать багет для картины
                </button>
            </a>
        </div>

        <!-- Подпись -->
        <div class="row text-center mb-5">
            <p class="fst-italic">
                С уважением к Вам,<br>
                С любовью к Искусству!<br>
                Команда Багетной мастерской №1
            </p>
        </div>

    </div>

<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
