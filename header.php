<?php
$blockPageAccess = 1;
$checked = 0;
 
// Функция отправки запроса на сервер Google reCAPTCHA
function sendRequestToCaptchaServer($captcha) {
    global $checked;
 
    // Здесь секретный ключ
    $secretKey = "6Ld7Of4mAAAAAMfRzRRshUqByG8TZ9ijEO7Wb-BB";
    // Формируем запрос и отправляем полученый токен на сервер проверки
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array('secret' => $secretKey, 'response' => $captcha);
 
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context = stream_context_create($options);
 
    // Запрос к серверу google.com/recaptcha и отлов ошибок
    set_error_handler(
            function ($severity, $message, $file, $line) {
                throw new ErrorException($message, $severity, $severity, $file, $line);
            }
    );
 
    try {
        $response = file_get_contents($url, false, $context);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
 
    restore_error_handler();
 
//    $response = file_get_contents($url, false, $context);
    $responseKeys = json_decode($response, true);
    // От сервера мы получаем ответ о набранных "очках" - от 0 до 1.
    // 1 - значит это точно человек, а 0 - это точно бот
    // Вы можете установить любой порог "прохождения". Я использую 0.5
    if ($responseKeys["success"] AND $responseKeys["score"] > 0.5 AND $responseKeys["action"] == 'homepage') {
        $checked = 1;
        // Если это человек, то просто ничего не делаем
    } else {
        // А если это бот, то завершаем работу. Перед завершением можно показать боту какое-нибудь сообщение.
        echo('<h1>Доступ запрещен!</h1>');
        exit;
    }
}
 
// Инициализируем переменную
$captcha = '';
// Проверяем, имеется ли токен и присваеваем его значение переменной
if (isset($_GET["token"])) {
    $captcha = filter_input(INPUT_GET, 'token', FILTER_UNSAFE_RAW);
} elseif (isset($_POST["token"])) {
    $captcha = filter_input(INPUT_POST, 'token', FILTER_UNSAFE_RAW);
}
 
// Этот раздел срабатывает только если включена блокировка ботов к страницам
if ($blockPageAccess) {
    // Проверяем, является ли значение пустым
    if (!$captcha) {
        // Если токен отсутствует, значит нужно показать страницу получения токена
        // У первоначального запроса могут быть GET параметры - собираем их, чтобы передать конечной странице
        $get = '';
        foreach ($_GET as $key => $value) {
            $get = $get . "&$key=$value";
        }
        // Выводим код получения токена
        echo '
            <!DOCTYPE html>
            
            <html>
                <head>
                    <title>Are you a human being?</title>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <script src="https://www.google.com/recaptcha/api.js?render=6Ld7Of4mAAAAAAt9yg0iPn9pFXyZ3O5vbgrNTY10"></script>
                </head>
                <body>
                    <script>
                        grecaptcha.ready(function () {
                            grecaptcha.execute(\'6Ld7Of4mAAAAAAt9yg0iPn9pFXyZ3O5vbgrNTY10\', {action: \'homepage\'}).then(function (token) {
                                //alert(token)
                                window.location.replace("?token=" + token + "' . $get . '");
                            });
                        });
                    </script>
                </body>
            </html>
            ';
        // Больше никаких дел нет - отключаемся. Теперь пользователь придёт снова, но уже с токеном
        exit;
    }
    // Если же токен всё-таки прислан, то инициируем запрос к серверу.
    sendRequestToCaptchaServer($captcha);
}

// получим ip клиента
$ip = $_SERVER['REMOTE_ADDR'];
// подключим файл SxGeo.php
require_once 'SxGeo.php';
// создадим объект SxGeo (1 аргумент – имя файла базы данных, 2 аргумент – режим работы: SXGEO_FILE (по умолчанию), SXGEO_BATCH  (пакетная обработка, увеличивает скорость при обработке множества IP за раз), SXGEO_MEMORY (кэширование БД в памяти, еще увеличивает скорость пакетной обработки, но требует больше памяти, для загрузки всей базы в память).
$SxGeo = new SxGeo('SxGeo.dat', SXGEO_BATCH | SXGEO_MEMORY);
// получаем двухзначный ISO-код страны (RU, UA и др.)
$country_code = $SxGeo->getCountry($ip);

if ($country_code != 'RU') {
    echo('<h1>Доступ запрещен! Вы можете попасть на сайт из РФ!</h1>');
    exit;
} 

?>

<!DOCTYPE HTML>
<HTML lang="ru-RU">

<HEAD>
    <meta charset="utf-8">
    <TITLE><? echo $titl; ?></TITLE>
    <META NAME="Description" CONTENT="<? echo $desc; ?>">
    <META NAME="Keywords" CONTENT="<? echo $keyw; ?>">
    <link rel="SHORTCUT ICON" href="/favicon.ico">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <link rel="canonical" href="<? echo $url; ?>" />

    <link rel="image_src" href="http://bagetnaya-masterskaya.com/img/bagetnaya_masterskaya.jpg" />
    <meta property="og:type" content="website">
    <meta property="og:title" content="Багетная мастерская № 1" />
    <meta property="og:description" content="Мы оформляем в багетные рамки постеры, фотографии, изображения, вышивки и многое другое. Печатаем на холсте, на глянцевой и матовой бумаге любые форматы изображений. Делаем красивые модульные картины для Вашего интерьера. Накатываем на пенокартон, делаем натяжку на подрамник, предоставляем услуги дизайнера." />
    <meta property="og:url" content="http://bagetnaya-masterskaya.com" />
    <meta property="og:image" content="http://bagetnaya-masterskaya.com/img/bagetnaya_masterskaya.jpg" />
    <meta name="geo.placename" content="Климентовский пер., 6, Москва, Россия, 115184" />
    <meta name="geo.position" content="55.7411820;37.6301270" />
    <meta name="geo.region" content="RU-" />
    <meta name="yandex-verification" content="495a973ffa1b3033" />
    <meta name="yandex-verification" content="1e115d792752091b" />

    <meta name="ICBM" content="55.7411820, 37.6301270" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <link href="/assets/css/app.css" rel="stylesheet" />
    <script src="/assets/js/gallery.js"></script>

    <script src="https://kit.fontawesome.com/5fc8cb6b98.js" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144-precomposed.png" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-169398394-2"></script>
    <!--script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-169398394-2');
    </script>


    <!--script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(94108947, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true
        });
    </!--script>
    <noscript><div><img src="https://mc.yandex.ru/watch/94108947" style="position:absolute; left:-9999px;" alt="" /></div></noscript>


  	<script-- type="text/javascript">
  		(function(m, e, t, r, i, k, a) {
  			m[i] = m[i] || function() {
  				(m[i].a = m[i].a || []).push(arguments)
  			};
  			m[i].l = 1 * new Date();
  			k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
  		})
  		(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

  		ym(60934651, "init", {
  			clickmap: true,
  			trackLinks: true,
  			accurateTrackBounce: true,
  			webvisor: true
  		});
  	</script-->
  	<noscript>
  		<div><img src="https://mc.yandex.ru/watch/60934651" style="position:absolute; left:-9999px;" alt="" /></div>
  	</noscript>

</HEAD>

<BODY>
    <div class="container-fluid">
        <br>

        <div class='row text-center'>
            <div class='col mob-header-hide'>
                <div class="border-top-red margin-top ">

                    <span class="dropdown" style='z-index:999999999999999999999999999999;'>
                        <button class="btn resize-font " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            ГАЛЕРЕЯ РАБОТ
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="/сatalog-of-finished-works-by-category.php?category=Акварели,%20пастели%20и%20гравюры">Акварели, пастели и гравюры</a></li>
                            <li><a class="dropdown-item" href="/сatalog-of-finished-works-by-category.php?category=Зеркала%20и%20тв-панели">Зеркала и тв-панели</a></li>
                            <li><a class="dropdown-item" href="/сatalog-of-finished-works-by-category.php?category=Иконы%20и%20вышивки">Иконы и вышивки</a></li>
                            <li><a class="dropdown-item" href="/сatalog-of-finished-works-by-category.php?category=Ордена%20и%20медали,%20купюры%20и%20монеты">Ордена и медали, купюры и монеты</a></li>
                            <li><a class="dropdown-item" href="/сatalog-of-finished-works-by-category.php?category=Оформление%20живописи">Оформление живописи</a></li>
                            <li><a class="dropdown-item" href="/сatalog-of-finished-works-by-category.php?category=Постеры,%20плакаты%20и%20репродукции">Постеры, плакаты и репродукции</a></li>
                            <li><a class="dropdown-item" href="/сatalog-of-finished-works-by-category.php?category=Сложные%20работы">Сложные работы</a></li>
                            <li><a class="dropdown-item" href="/сatalog-of-finished-works-by-category.php?category=Фотографии%20и%20графика">Фотографии и графика</a></li>
                            <li><a class="dropdown-item" href="/сatalog-of-finished-works-by-category.php?category=Футболки%20и%20спортивные%20атрибуты">Футболки и спортивные атрибуты</a></li>
                        </ul>
                    </span>
                    <span class="dropdown">
                        <button class="btn resize-font" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            УСЛУГИ
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
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
                            <li><a class="dropdown-item" href="/pechat_kartin_posterov_reprodukcij/">печать постеров, фотографий и репродукций</a></li>
                            <li><a class="dropdown-item" href="/nakatka_na_penokarton/">накатка на пенокартон</a></li>
                            <li><a class="dropdown-item" href="/express_zakaz.php">EXPRESS-ЗАКАЗ</a></li>
                            <li><a class="dropdown-item" href="/obramlenie_kartiny.php">Обрамление картины</a></li>
                            <li><a class="dropdown-item" href="/derevyannie_ramki.php">Деревянные рамки</a></li>
                            <li><a class="dropdown-item" href="/plastikovye_ramki.php">Пластиковые рамки</a></li>
                        </ul>
                    </span>
                    <button type="button" class="btn resize-font"> <a href="/contacts.php" style="text-decoration: none;color:black;">КОНТАКТЫ</a> </button>
                </div>
            </div>
            <div class='col ms-md-auto' style='max-width:350px;'>
                <a href="/">
                    <img src="/img/IMG_0282.PNG" alt="" style="height:100px;">
                </a>
            </div>
            <div class='col mob-header-hide'>
                <div class="border-top-red margin-top margin-right">
                    <button type="button" class="btn resize-font"><a href="/oplata_uslug.php" style="text-decoration: none;color:black;">ОПЛАТА И ДОСТАВКА</a></button>
                    <button type="button" class="btn resize-font"><a href="/картины%20багетной%20мастерской.php" style="text-decoration: none;color:black;">КУПИТЬ КАРТИНУ</a></button>
                </div>
            </div>
        </div>
    </div>
    <div id="site">
        <div class="ball"></div>

        <div class='container' id='activeTime'>
            <div class='row' style='text-align:center'>
                <div class='col'>
                    <svg viewBox="0 0 50 60" width="40" height="40">
                        <circle class="circle st_OF6 blink_me" cx="15" cy="30" r="10" />
                    </svg>
                    <span>Сейчас работаем</span>
                </div>

                <div class="pilsing">
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

        <div class='container' id='Time' style='display: none'>
            <div class='row2' style='
                text-align: center;
                border: 2px solid red;
                border-radius: 10px;
                padding: 10px;
                background: #eddbd1;
                font-family: Helvetica, Arial, sans-serif !important;
                '>
                <span>21.12.2022 работаем до 17:00</span>
            </div>
            <style>
                .circle {
                    stroke: #1A1A1A;
                }
            </style>
        </div>

        <script>
            var dt = new Date();
            var time = dt.getHours();
            if (time >= 21 || time < 9) {
                $('#activeTime').hide()
            }
        </script>

        <div class="head_buttons_block">
            <div class="head_center_button_wrapper"></div>
            <a href="/baget_online" class="head_center_button">РАССЧИТАТЬ<BR>СТОИМОСТЬ<BR>БАГЕТА</a>
            <div class="head_side_buttons head_side_buttons_left">
                <a href="/сatalog-of-finished-works.php">Каталог готовых работ</a>
                <div>Посмотрите примеры рам для картин,<br> выполненных нашей командой!</div>
            </div>
            <div class="head_side_buttons head_side_buttons_right">
                <a href="/картины багетной мастерской.php">Купить картину</a>
                <div>Купить готовую интерьерную картину<br>в интерьер или в подарок</div>
            </div>
            <div class="head_side_buttons head_side_buttons_left">
                <a href="https://bagetnaya-masterskaya.com/oplata_uslug.php">Оплата и доставка</a>
                <div>Cпособы внесения оплаты и условия <br>доставки Заказов</div>
            </div>
            <div class="head_side_buttons head_side_buttons_right">
                <a href="https://bagetnaya-masterskaya.com/contacts.php">Контакты</a>
                <div>Наши салоны в Москве, способы связи,<br> время работы и карты</div>
            </div>
        </div>
        <div id="mid">

            <?
            include 'modules_php/feedBack.php';
            ?>