<?php
$keywords = "багетная мастерская";
$title = "Контакты и адреса салонов Багетной мастерской №1";
$description = "В шаговой доступности от метро и городских и частных парковок!";
// $gallery="bagety_dlya_kartin";
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';
?>

    <style>
        .section-title {
            font-family: Cormorant Garamond;
            color: #C6110F;
            font-weight: bold;
            text-align: center;
            margin: 40px 0 20px;
            text-transform: uppercase;
            font-size: 50px;
        }

        .flex-custom-block {
            display: flex;
            flex-direction: row;
            width: 100%;
            gap: 20px;
            justify-content: center;
            margin-bottom: 20px;

            .block-image {
                img {
                    max-width: 440px;
                    @media (max-width: 1400px) {
                        max-width: 360px;
                    }
                    @media (max-width: 1200px){
                        max-width: 320px;
                    }

                }
                @media (max-width: 992px){
                    display: none;
                    visibility: hidden;
                }
            }
        }
    </style>
    <div class="container my-5 ">
        <h1 class="text-center fw-bold text-uppercase mb-4 section-title" style="color: #921b1f;">Контакты</h1>

        <div class="flex-custom-block ">
            <div class="block-image"><img src="/img/article/IMG_6164.JPEG" alt=""></div>

            <div class="text-center my-auto">
                <p class="fw-bold mb-1" style="font-size: 22px;">Менеджер-дизайнер</p>
                <p class="mb-1" style="font-size: 20px;">
                    <a href="tel:+789774274477" class="text-dark" style="text-decoration: underline;">8 (977)
                        427-44-77</a>
                </p>
                <p style="font-size: 20px;">
                    <a href="mailto:Manager@bagetnaya-masterskaya.com" class="text-dark"
                       style="text-decoration: underline;">Manager@bagetnaya-masterskaya.com</a>
                </p>
            </div>

            <div class="block-image"><img src="/img/article/IMG_7901.JPG" alt=""></div>
        </div>


        <!-- Версия для десктопа -->
        <div class="d-none d-md-block">
            <table class="table border align-middle">
                <thead>
                <tr class="text-uppercase  text-center" style="color: #AD1F2D;font-family: Cormorant Garamond;">
                    <th>м.Новокузнецкая</th>
                    <th>м.Арбатская</th>
                    <th>м.Баррикадная</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <!-- Новокузнецкая -->
                    <td>
                        <div class="d-inline-block px-2 py-1 mb-2 fw-semibold mt-2" style="background-color: #E1D1BC;">
                            Режим работы: 9:00–21:00, ежедневно
                        </div>
                        <p class="mb-3 mt-3"><b>Адрес:</b> Москва, Климентовский переулок, 6</p>
                        <p class=" "><a href="tel:+79778244212" class="text-dark "
                                        style="text-decoration: underline;">8 (977) 824-42-12</a></p>

                        <div class="mb-2">
                            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Ac2a326da2cf43fb0bf4f1e6cec8c71fc7533891be61426adcc09a64dfe4a27a4&amp;source=constructor"
                                    width="100%" height="300" frameborder="0"></iframe>
                        </div>
                    </td>

                    <!-- Арбатская -->
                    <td>
                        <div class="d-inline-block px-2 py-1 mb-2 fw-semibold mt-2" style="background-color: #E1D1BC;">
                            Режим работы: 9:00–21:00, ежедневно
                        </div>
                        <p class="mb-3 mt-3"><b>Адрес:</b> Москва, ул. Арбат д. 1</p>
                        <p class=""><a href="tel:+79268659295" class="text-dark "
                                       style="text-decoration: underline;">8 (926) 865-92-95</a></p>

                        <div class="mb-2">
                            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A9d58c19de6ff4c9727e51cd85147f97e3cee2f6f8a2341dde6c5a8b9a10f9967&amp;source=constructor"
                                    width="100%" height="300" frameborder="0"></iframe>
                        </div>
                    </td>

                    <!-- Баррикадная -->
                    <td>
                        <div class="d-inline-block px-2 py-1 mb-2 fw-semibold mt-2" style="background-color: #E1D1BC;">
                            Режим работы: 9:00–21:00, ежедневно
                        </div>
                        <p class="mb-3 mt-3"><b>Адрес:</b> Москва, Баррикадная 21/34с3</p>
                        <p class=""><a href="tel:+79773147771" class="text-dark "
                                       style="text-decoration: underline;">8 (977) 314-77-71</a></p>

                        <div class="mb-2">
                            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A51496af377eb4bff4770f42fb5eddfd5291dd0ebcf8f2d3664492bcb899f0ff7&amp;source=constructor"
                                    width="100%" height="300" frameborder="0"></iframe>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- Версия для мобильных -->
        <div class="d-md-none">
            <div class="row row-cols-1 g-4 text-center">
                <!-- Повторим каждую карточку как отдельный .col -->
                <div class="col border p-3">
                    <h5 class="text-uppercase fw-bold mb-3" style="color: #AD1F2D;">м.Новокузнецкая</h5>
                    <div class="d-inline-block px-3 py-2 mb-2 fw-semibold" style="background-color: #E1D1BC;">
                        Режим работы: 9:00–21:00, ежедневно
                    </div>
                    <p class="mb-2">Адрес: Москва, Климентовский переулок, 6</p>
                    <p class="fw-semibold mt-2">8 (977) 824-42-12</p>

                    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Ac2a326da2cf43fb0bf4f1e6cec8c71fc7533891be61426adcc09a64dfe4a27a4&amp;source=constructor"
                            width="100%" height="300" frameborder="0"></iframe>
                </div>

                <div class="col border p-3">
                    <h5 class="text-uppercase fw-bold mb-3" style="color: #AD1F2D;">м.Арбатская</h5>
                    <div class="d-inline-block px-3 py-2 mb-2 fw-semibold" style="background-color: #E1D1BC;">
                        Режим работы: 9:00–21:00, ежедневно
                    </div>
                    <p class="mb-2">Адрес: Москва, ул. Арбат д. 1</p>
                    <p class="fw-semibold mt-2">8 (926) 865-92-95</p>

                    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A9d58c19de6ff4c9727e51cd85147f97e3cee2f6f8a2341dde6c5a8b9a10f9967&amp;source=constructor"
                            width="100%" height="300" frameborder="0"></iframe>
                </div>

                <div class="col border p-3">
                    <h5 class="text-uppercase fw-bold mb-3" style="color: #AD1F2D;">м.Баррикадная</h5>
                    <div class="d-inline-block px-3 py-2 mb-2 fw-semibold" style="background-color: #E1D1BC;">
                        Режим работы: 9:00–21:00, ежедневно
                    </div>
                    <p class="mb-2">Адрес: Москва, Баррикадная 21/34с3</p>
                    <p class="fw-semibold mt-2">8 (977) 314-77-71</p>

                    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A51496af377eb4bff4770f42fb5eddfd5291dd0ebcf8f2d3664492bcb899f0ff7&amp;source=constructor"
                            width="100%" height="300" frameborder="0"></iframe>
                </div>
            </div>
        </div>


        <div>
            <p>
                Багетная мастерская 1 – это команда, создающая уникальные и индивидуальные проекты как для физических,
                так и для юридических лиц! Овальные и круглые рамы, многослойные фигурные паспарту, а также возможность
                создавать большие и сложные проекты – наш дружный коллектив всегда готов сделать для Вас невозможное!
                Наши салоны – не просто пункты приема, а полноценные багетные мастерские, где Вы лично можете пообщаться
                с мастерами и понаблюдать за процессом работ! А непосредственная близость к метро и наличие парковочных
                мест создает для Вас максимальное комфортное посещение. Ждем Вас!
            </p>
        </div>

        <!-- Нижний блок -->
        <div class="row mt-5 align-items-start">
            <div class="col-2 text-start d-none d-md-block">
                <!-- Картинка "1" -->
                <!--img src="/Group%2048095855%20(1).png" alt="decorative icon" class="img-fluid" style="max-width: 40px;"-->
            </div>
            <div class="col-12 col-md-8 mb-8 mb-md-0 text-md-start text-center">
                <p class=" mb-0" style="font-size: 25px">
                    Выбирайте удобный для Вас салон и создавайте красоту вместе<br>
                    <strong>с нашей командой!</strong>
                </p>
            </div>

        </div>

        <div class="col-12 col-md-4 text-md-end text-center mt-5 " style="width: 100%">
            <p class="mb-0" style="font-size: 25px">
                С уважением к Вам,<br>
                С любовью к Искусству!<br>
                <strong>Багетная мастерская 1</strong>
            </p>
        </div>


<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>