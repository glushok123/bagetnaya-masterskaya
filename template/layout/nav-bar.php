<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/helpers/gallery-categories.php';

if (!isset($galleryCategories) || !is_array($galleryCategories)) {
    $galleryCategories = [];

    if (isset($dbh) && $dbh instanceof PDO) {
        $galleryCategories = loadGalleryCategories($dbh);
    }
}
?>
<div class='box-shadow-custom mobali-nav'>


    <nav class="navbar navbar-expand-xl navbar-light">
        <div class="container-fluid ">


            <div class='row'>
                <div class='col-12' style="padding: 0px !important;">
                    <a class="navbar-brand element-animation" href="/"><img src="/assets/img/logo.PNG" alt=""
                                                                            class='img-brand'
                                                                            style="width: 136px; height: auto;"></a>
                    <a href="https://api.whatsapp.com/send/?phone=79774274477&text=Здравствуйте%2C+у+меня+есть+вопрос"><img src="/admin/assets/whatsapp-logo_icon-icons.com_66175.png" style="width: 25px; height: auto"></a>
                    <a href="tel:+79774274477" style="color: black; font-size: 14px; text-decoration: none;">+7-977-427-44-77</a>
                </div>
            </div>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link " id="navbarDropdown" role="button" data-bs-toggle="navbarDropdown2"
                           href="/сatalog-of-finished-works" aria-expanded="false">
                            Галерея работ
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                            <?php if (!empty($galleryCategories)) : ?>
                                <?php foreach ($galleryCategories as $category): ?>
                                    <li><a class="dropdown-item"
                                           href="<?= prepareGalleryCategoryLink($category); ?>"><?= escapeGalleryCategoryName($category); ?></a></li>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <li><span class="dropdown-item disabled">Раздел находится в разработке</span></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Услуги
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/prices_for_print_and_canvas/">КОМПЛЕКТ ДЛЯ КАРТИНЫ: РАССЧИТАТЬ СТОИМОСТЬ САМОСТОЯТЕЛЬНО</a></li>
                            <li><a class="dropdown-item" href="/bagetnye_raboty.php">багетные работы</a></li>
                            <li><a class="dropdown-item" href="/bagetnye_ramki/">Багетные рамки</a></li>
                            <li><a class="dropdown-item" href="/baget_dlya_ikony/">Багет для иконы</a></li>
                            <li><a class="dropdown-item" href="/bagety_dlya_kartin/">Багеты для картин</a></li>
                            <li><a class="dropdown-item" href="/home_designer.php">Выездной подбор багета</a></li>
                            <li><a class="dropdown-item" href="/ordena_i_medali/">Панно для наград и орденов</a></li>
                            <li><a class="dropdown-item" href="/pechat_na_holste/">Печать на холсте</a></li>
                            <li><a class="dropdown-item" href="/pechat_na_penokartone/">Печать на пенокартоне</a></li>
                            <li><a class="dropdown-item" href="/ramki_dlya_kartin/">Рамки для картин</a></li>
                            <li><a class="dropdown-item" href="/ramki_dlya_ikon/">Рамки для икон</a></li>
                            <li><a class="dropdown-item" href="/ramki_dlya_vyshivki/">Рамки для вышивки</a></li>
                            <li><a class="dropdown-item" href="/designation_references.php">Оформление живописи</a></li>
                            <li><a class="dropdown-item" href="/zerkala_v_bagete/">Зеркала в багете</a></li>
                            <li><a class="dropdown-item" href="/formation_football.php">Оформление футболок</a></li>
                            <li><a class="dropdown-item" href="/object_forming.php">Объектное оформление</a></li>
                            <li><a class="dropdown-item" href="/natyazhka_holsta/">Натяжка холста</a></li>
                            <li><a class="dropdown-item" href="/pechat_kartin_posterov_reprodukcij/">печать постеров,
                                    фотографий и репродукций</a></li>
                            <li><a class="dropdown-item" href="/nakatka_na_penokarton/">накатка на пенокартон</a></li>
                            <li><a class="dropdown-item" href="/express_zakaz.php">EXPRESS-ЗАКАЗ</a></li>
                            <li><a class="dropdown-item" href="/obramlenie_kartiny.php">Обрамление картины</a></li>
                            <li><a class="dropdown-item" href="/derevyannie_ramki.php">Деревянные рамки</a></li>
                            <li><a class="dropdown-item" href="/plastikovye_ramki.php">Пластиковые рамки</a></li>
                            <li><a class="dropdown-item" href="/metallicheskie_ramki.php">Металлические рамки</a></li>
                            <li><a class="dropdown-item" href="/kak_uhazhivat_za_ramkoi.php">Уход за рамкой для
                                    картины</a>
                            </li><li><a class="dropdown-item" href="/kartina_na_zakaz.php">Картина на заказ</a>
                            </li>

                            <li><a class="dropdown-item" href="/baget_for_karini.php">Подбор багета для картины</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/contacts.php">Контакты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/oplata_uslug.php">Оплата и доставка</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/картины%20багетной%20мастерской.php">Картины и репродукции</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/contacts.php">Адреса багетных мастерских</a>
                    </li>


                    <li class="nav-item">

                        <form action="https://yandex.ru/search/site/" method="get" target="_blank"
                              accept-charset="utf-8" class="search-form custom-search" id="searchform"
                              itemprop="potentialAction" itemscope itemtype="https://schema.org/SearchAction">

                            <meta itemprop="target" content="https://virtual-baget-curent/search/?s={s}">
                            <input type="hidden" name="searchid">

                            <div class="form-group has-search max-weight-183">
                                <input type="hidden" name="searchid" value="3468587"/>
                                <input type="hidden" name="l10n" value="ru"/>
                                <input type="hidden" name="reqenc" value=""/>
                                <span class="fa fa-search form-control-feedback" id="searchsubmit" data-search="body"
                                      type='submit'></span>
                                <input type="text" name="text" class="search-form__input form-control"
                                       placeholder="Поиск по сайту.." autocomplete="off" itemprop="query-input">
                            </div>
                            <input type="hidden" name="web" value="0">
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </nav>


</div>
<!--div class="mobali-nav">
    <div class='row pt-2 px-1 text-center justify-content-center box-shadow-custom ' style="
                    color: #0f0f0f;
                    font-family: Cormorant Garamond;
                    font-style: normal;
                    font-weight: 500;
                    line-height: normal;
                    font-size: 12px;
                    margin-top: 9px;
                    padding-bottom: 9px;
                    ">
        <div class='col-4 text-center'>
            <span>НОВОКУЗНЕЦКАЯ</span>
            <a href="tel:+79778244212" style="color: black;text-decoration: none;" class="text-center"><br>
                <span style="color: #0f0f0f;text-decoration: none;" class="text-center">8(977) 824-42-12</span>
            </a>
        </div>
        <div class='col-4'>
            <span>АРБАТСКАЯ</span>
            <a href="tel:+79268659295" style="color: black;text-decoration: none;"><br>
                <span style="color: black;text-decoration: none;">8(926) 865-92-95</span>
            </a>
        </div>
        <div class='col-4'>
            <span>БАРРИКАДНАЯ</span>
            <a href="tel:+79773147771" style="color: black;text-decoration: none;"><br>
                <span style="color: #808080;text-decoration: none;">8(977) 314-77-71</span>
            </a>
        </div>
    </div>
</div-->

