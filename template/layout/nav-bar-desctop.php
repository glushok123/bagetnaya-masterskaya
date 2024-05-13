<div class='box-shadow-custom desctop-nav'>

    <nav class="navbar navbar-expand-sm navbar-light">
        <div class="container-fluid ">


            <?
            if (!isMobile()) {
                ?>
                <a class="navbar-brand element-animation" href="/"><img src="/assets/img/logo.PNG" alt=""
                                                                        class='img-brand'
                                                                        style="width: auto; height: 80px;"> </a>

                <?
            } else {
                ?>
                <div class='row'>
                    <div class='col-9'>
                        <a class="navbar-brand element-animation" href="/">Багетная мастерская </a>
                    </div>
                    <div class='col-3'>
                        <img src="/img/logo 2.svg" alt="" class='img-brand'>
                    </div>
                </div>
                <?
            }
            ?>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse text-nowrap " id="navbarSupportedContent" style="position: relative">

                <div class='row pt-1 px-1' style="
                    position: absolute;
                    margin-left: auto;
                    margin-right: auto;
                    left: 0;
                    right: 0;
                    text-align: center; top:0px;
                    color: #808080;
                    font-family: Cormorant Garamond;
                    font-style: normal;
                    font-weight: 500;
                    line-height: normal;

                    ">


                    <div class='col'>
                        <h3 style="margin-bottom: 0px;">НОВОКУЗНЕЦКАЯ</h3>
                        <a href="tel:+79778244212" style="color: black;text-decoration: none;">
                            <h5 style="color: #808080;text-decoration: none;">8(977) 824-42-12</h5>
                        </a>
                    </div>
                    <div class='col'>
                        <h3 style="margin-bottom: 0px;">АРБАТСКАЯ</h3>
                        <a href="tel:+79268659295" style="color: black;text-decoration: none;">
                            <h5 style="color: #808080;text-decoration: none;">8(926) 865-92-95</h5>
                        </a>

                    </div>
                    <div class='col'>
                        <h3 style="margin-bottom: 0px;">БАРРИКАДНАЯ</h3>
                        <a href="tel:+79779647429" style="color: black;text-decoration: none;">
                            <h5 style="color: red;text-decoration: none;">Cкоро открытие!</h5>
                        </a>
                    </div>

                </div>

                <ul class="navbar-nav ms-auto" style="margin-top: 70px;">
                    <li class="nav-item">
                        <a class="nav-link " href="#" id="navbarDropdown" role="button" data-bs-toggle="navbarDropdown2"
                           href="/сatalog-of-finished-works.php" aria-expanded="false">
                            Галерея работ
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                            <li><a class="dropdown-item"
                                   href="/сatalog-of-finished-works-by-category.php?category=Акварели,%20пастели%20и%20гравюры">Акварели,
                                    пастели и гравюры</a></li>
                            <li><a class="dropdown-item"
                                   href="/сatalog-of-finished-works-by-category.php?category=Зеркала%20и%20тв-панели">Зеркала
                                    и
                                    тв-панели</a></li>
                            <li><a class="dropdown-item"
                                   href="/сatalog-of-finished-works-by-category.php?category=Иконы%20и%20вышивки">Иконы
                                    и
                                    вышивки</a></li>
                            <li><a class="dropdown-item"
                                   href="/сatalog-of-finished-works-by-category.php?category=Ордена%20и%20медали,%20купюры%20и%20монеты">Ордена
                                    и медали, купюры и монеты</a></li>
                            <li><a class="dropdown-item"
                                   href="/сatalog-of-finished-works-by-category.php?category=Оформление%20живописи">Оформление
                                    живописи</a></li>
                            <li><a class="dropdown-item"
                                   href="/сatalog-of-finished-works-by-category.php?category=Постеры,%20плакаты%20и%20репродукции">Постеры,
                                    плакаты и репродукции</a></li>
                            <li><a class="dropdown-item"
                                   href="/сatalog-of-finished-works-by-category.php?category=Сложные%20работы">Сложные
                                    работы</a></li>
                            <li><a class="dropdown-item"
                                   href="/сatalog-of-finished-works-by-category.php?category=Фотографии%20и%20графика">Фотографии
                                    и графика</a></li>
                            <li><a class="dropdown-item"
                                   href="/сatalog-of-finished-works-by-category.php?category=Футболки%20и%20спортивные%20атрибуты">Футболки
                                    и спортивные атрибуты</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Услуги
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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
                            </li>
                            <li><a class="dropdown-item" href="/prices_for_print_and_canvas/">Оформление художественных
                                    выставок</a></li>
                            <li><a class="dropdown-item" href="/baget_for_karini.php">Подбор багета для картины</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/contacts.php">Контакты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/oplata_uslug.php">Оплата и доставка</a>
                    </li>

                    <?
                    if (isMobile()) {
                        ?>

                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/картины%20багетной%20мастерской.php">Купить
                                картину</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/contacts.php">Адреса багетных мастерских</a>
                        </li>

                        <?
                    }
                    ?>

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

    <?
    if (!isMobile()) {
        ?>

        <div class='text-end custom-margin-navbar-2-row'>
            <div class="d-inline">
                <div class="nav-item d-inline">
                    <a class="nav-link d-inline" aria-current="page" href="/картины%20багетной%20мастерской.php">Купить
                        картину</a>
                </div>
            </div>
            <div class="d-inline ">
                <div class="nav-item d-inline">
                    <a class="nav-link d-inline" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown">
                        Адреса багетных мастерских
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown3">
                        <div class='my-2 px-3'>
                            <div class='nav-name-metro'>м. Арбат</div>
                            <div class='nav-address my-2'>Москва, м. Арбатская, ул. Арбат д. 1</div>
                            <div class='nav-phone'>8 (495) 665-25-61</div>
                            <div class='nav-phone'>8 (926) 865-92-95 (WhatsApp)</div>
                            <div class='nav-time-work my-1'>Ежедневно, 9:00 - 21:00</div>
                        </div>
                        <div class='px-3'>
                            <hr>
                        </div>
                        <div class='my-2 px-3'>
                            <div class='nav-name-metro'>м. Новокузнецкая</div>
                            <div class='nav-address my-2'>Москва, м. Новокузнецкая, Климентовский переулок, 6</div>
                            <div class='nav-phone'>8 (499) 714-80-62</div>
                            <div class='nav-phone'>8 (977) 824-42-12 (WhatsApp)</div>
                            <div class='nav-time-work my-1'>Ежедневно, 9:00 - 21:00</div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <?
    }
    ?>
</div>

