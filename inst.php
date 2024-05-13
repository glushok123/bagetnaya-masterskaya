<?

$params = ['owner_id' => '-210965475', 'album_id' => '283484773', 'v' => '5.131', 'access_token' => 'bea612cebea612cebea612ce66befdd80fbbea6bea612cee4ba2830bf89a26a4e2d4958', 'count' => 100];

$response = json_decode(file_get_contents('https://api.vk.com/method/photos.get?' . http_build_query($params)), true, 512, JSON_THROW_ON_ERROR);

$urls = [];
for ($i = 0; $i < (is_countable($response['response']['items']) ? count($response['response']['items']) : 0); $i++) {
    array_push($urls, $response['response']['items'][$i]['sizes'][2]['url'] . PHP_EOL);
}
$kol = count($urls);
?>

<style>
    .mobserv2 {
        display: none;
    }

    .mobserv4 {
        display: block;
    }


    @media (max-width: 500px) {

        .mobserv4 {
            display: none;
        }

        .mobserv2 {
            display: block;
        }

        #service {
            display: none;
        }

    }


    /* Slideshow container */
    .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
    }

    /* Caption text */
    .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active {
        background-color: #717171;
    }

    /* Fading animation */
    .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @-webkit-keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
        .text {
            font-size: 11px
        }
    }

    .row {
        text-align: center;
        margin: 0 auto;
    }

    .col {
        display: inline-block;
        text-align: center;
        margin: 0 auto;
    }

    a.knopka {
        color: black;
        /* цвет текста */
        text-decoration: none;
        /* убирать подчёркивание у ссылок */
        user-select: none;
        /* убирать выделение текста */
        background: #d9d9d9;
        /* фон кнопки */
        padding: .7em 1.5em;
        /* отступ от текста */
        outline: none;
        /* убирать контур в Mozilla */
        margin: 0px 20px 20px 0px;

    }

    a.knopka:hover {
        background: rgb(232, 95, 76);
    }

    /* при наведении курсора мышки */
    a.knopka:active {
        background: rgb(152, 15, 0);
    }

    /* при нажатии */

    @media (max-width: 980px) {
        #pk-knopka {
            display: none;
        }

        #mob-knopka {
            display: block;
        }

        .a.knopka {
            min-width: 180px;
        }
    }

    @media (min-width: 981px) {
        #pk-knopka {
            display: block;
        }

        #mob-knopka {
            display: none;
        }
    }

    .container-knopka {
        text-align: center;
        margin: 0 auto;
    }
</style>

<h2 class='container-knopka'>МЫ В ВКОНТАКТЕ</h2>
<div class='container' id='pk-knopka'>
    <br>
    <div class='row'>
        <div class='col'>
            <a href="https://vk.com/market-210965475?section=album_1" class="knopka">Купить картину</a>
        </div>
        <div class='col'>
            <a href="https://vk.com/@bagetnaya1" class="knopka">Читать статьи</a>
        </div>
        <div class='col'>
            <a href="https://vk.com/bagetnaya1" class="knopka">Смотреть ленту</a>
        </div>
    </div>
</div>

<div class='container-knopka' id='mob-knopka'>
    <br>
    <div>
        <a href="https://vk.com/market-210965475?section=album_1" class="knopka">Купить картину</a>
    </div>
    <br><br>
    <div>
        <a href="https://vk.com/@bagetnaya1" class="knopka">Читать статьи</a>
    </div>
    <br><br>
    <div>
        <a href="https://vk.com/bagetnaya1" class="knopka">Смотреть ленту</a>
    </div>

</div>
<br>
<div class="insta-photo mobserv4">
    <div class="img-wrapper" data-fancybox="images" href="<?php echo $urls[$kol - 1]; ?>"><img
                style=" object-fit: cover;    width: 250px;    height: 230px;" src="<?php echo $urls[$kol - 1]; ?>">
    </div>
</div>

<div class="insta-photo mobserv4">
    <div class="img-wrapper" data-fancybox="images" href="<?php echo $urls[$kol - 2]; ?>"><img
                style=" object-fit: cover;    width: 250px;    height: 230px;" src="<?php echo $urls[$kol - 2]; ?>">
    </div>
</div>

<div class="insta-photo mobserv4">
    <div class="img-wrapper" data-fancybox="images" href="<?php echo $urls[$kol - 3]; ?>"><img
                style=" object-fit: cover;    width: 250px;    height: 230px;" src="<?php echo $urls[$kol - 3]; ?>">
    </div>
</div>

<div class="insta-photo mobserv4">
    <div class="img-wrapper" data-fancybox="images" href="<?php echo $urls[$kol - 4]; ?>"><img
                style=" object-fit: cover;    width: 250px;    height: 230px;" src="<?php echo $urls[$kol - 4]; ?>">
    </div>
</div>

<div class="insta-photo mobserv4">
    <div class="img-wrapper" data-fancybox="images" href="<?php echo $urls[$kol - 5]; ?>"><img
                style=" object-fit: cover;    width: 250px;    height: 230px;" src="<?php echo $urls[$kol - 5]; ?>">
    </div>
</div>
<div class="insta-photo mobserv4">
    <div class="img-wrapper" data-fancybox="images" href="<?php echo $urls[$kol - 6]; ?>"><img
                style=" object-fit: cover;    width: 250px;    height: 230px;" src="<?php echo $urls[$kol - 6]; ?>">
    </div>
</div>


<div class="slideshow-container mobserv2">

    <div class="mySlides fade">
        <div class="numbertext">1 / 6</div>
        <a data-fancybox="images-mob" href="<?php echo $urls[$kol - 1]; ?>">
            <img src="<?php echo $urls[$kol - 1]; ?>" style="object-fit: cover; width:100%; height:375px;">
        </a>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">2 / 6</div>
        <a data-fancybox="images-mob" href="<?php echo $urls[$kol - 2]; ?>">
            <img src="<?php echo $urls[$kol - 2]; ?>" style="object-fit: cover; width:100%; height:375px;">
        </a>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">3 / 6</div>
        <a data-fancybox="images-mob" href="<?php echo $urls[$kol - 3]; ?>">
            <img src="<?php echo $urls[$kol - 3]; ?>" style="object-fit: cover; width:100%; height:375px;">
        </a>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">4 / 6</div>
        <a data-fancybox="images-mob" href="<?php echo $urls[$kol - 4]; ?>">
            <img src="<?php echo $urls[$kol - 4]; ?>" style="object-fit: cover; width:100%; height:375px;">
        </a>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">5 / 6</div>
        <a data-fancybox="images-mob" href="<?php echo $urls[$kol - 5]; ?>">
            <img src="<?php echo $urls[$kol - 5]; ?>" style="object-fit: cover;  width:100%; height:375px;">
        </a>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">6 / 6</div>
        <a data-fancybox="images-mob" href="<?php echo $urls[$kol - 6]; ?>">
            <img src="<?php echo $urls[$kol - 6]; ?>" style="object-fit: cover;  width:100%; height:375px;">
        </a>
    </div>

</div>
<br>

<div class="mobserv2" style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
</div>

<script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        setTimeout(showSlides, 3000); // Change image every 2 seconds
    }
</script>

