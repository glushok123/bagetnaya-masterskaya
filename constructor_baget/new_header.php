<!DOCTYPE HTML>
<HTML onselectstart="return false;">

<HEAD>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="SHORTCUT ICON" href="/favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="content-language" content="ru">
    <meta name="description" content="Конструктор багета онлайн">
    <meta name="keywords" content="Багет онлайн, конструктор багета онлайн">
    <title>Конструктор багета онлайн</title>

    <link rel="image_src" href="http://bagetnaya-masterskaya.com/pics/<? echo $z[8]; ?>.jpg" />
    <meta property="og:description" content="Онлайн оформление вышивок, икон, картин, фотографий в багетные рамки" />
    <meta property="og:image" content="http://bagetnaya-masterskaya.com/img/bagetnaya_masterskaya.jpg">

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/apple-touch-icon-144-precomposed.png " />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-144-precomposed.png" />
    <link rel="stylesheet" type="text/css" href="/constructor_baget/style.css?v2">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src=" https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js "
        integrity=" sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo " crossorigin=" anonymous ">
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <?
		if ($master) {
			echo '<style>.baganim {transition: none;}</style>';
		}
	?>
    <link rel="stylesheet" href="/assets/css/main.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</HEAD>

<div class='block-sk-circle hidden'>
    <div class="sk-circle">
    <div class="sk-circle1 sk-child"></div>
    <div class="sk-circle2 sk-child"></div>
    <div class="sk-circle3 sk-child"></div>
    <div class="sk-circle4 sk-child"></div>
    <div class="sk-circle5 sk-child"></div>
    <div class="sk-circle6 sk-child"></div>
    <div class="sk-circle7 sk-child"></div>
    <div class="sk-circle8 sk-child"></div>
    <div class="sk-circle9 sk-child"></div>
    <div class="sk-circle10 sk-child"></div>
    <div class="sk-circle11 sk-child"></div>
    <div class="sk-circle12 sk-child"></div>
    </div>
</div>


<nav class="navbar navbar-expand-sm navbar-light">
    <div class="container-fluid ">

        <?
            if (!isMobile()) {
                ?>
            <a class="navbar-brand " href="/">Багетная мастерская </a>
            <img src="/img/logo 2.png" alt="" class='img-brand'>
            <?
            }else{
                ?>
            <div class='row'>
                <div class='col-9'>
                    <a class="navbar-brand " href="/">Багетная мастерская </a>
                </div>
                <div class='col-3'>
                    <img src="/img/logo 2.png" alt="" class='img-brand'>
                </div>
            </div>
            <?
            }
        ?>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/сatalog-of-finished-works.php">Галерея работ</a>
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
                        <li><a class="dropdown-item" href="/kak_uhazhivat_za_ramkoi.php">Уход за рамкой для картины</a>
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
            </ul>
        </div>
    </div>
</nav>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Багет подобранный искусственным интеллектом на основании спектрального анализа изображения</h5>
        <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body " id ='custom-baget-me'>
            <div class='row baget-conteiner' id='test-r'>

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-close-custom" data-bs-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>