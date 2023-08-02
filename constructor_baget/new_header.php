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
    <link rel="stylesheet" type="text/css" href="/constructor_baget/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
<script src=" https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js " integrity=" sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo " crossorigin=" anonymous "></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <?
		if ($master) {
			echo '<style>.baganim {transition: none;}</style>';
		}
	?>
</HEAD>

<style>
    .navbar-brand{
        color: var(--graphit, #474A51);
        font-family: Cormorant Garamond;
        font-size: 32px;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
        text-transform: uppercase;
    }
    .nav-link{
        color: var(--graphit, #474A51) !important;
        font-size: 16px;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
    }
    .nav-item{
        margin-left: 30px;
    }
    .navbar{
        padding-left: 3rem;
        padding-right: 3rem;
        padding-top: 24px;
    }
    .img-brand{
        height: 35px;
    }

    @media (max-width: 768px) {
        .navbar-brand{
            font-size: 14px;
        }
        .img-brand{
            width: 10.137px;
            height: 16.684px;
            flex-shrink: 0;
        }
        .nav-item{
            margin-left: 0px;
        }
        .navbar{
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            padding-top: 10px;
        }
        .navbar-toggler{
            width: 41px;
            height: 41px;
            background-color: beige;
            border-radius: 400px;
            padding: 0px;
        }
        .navbar-toggler:focus{
            box-shadow: none;
        }
    }
</style>

<nav class="navbar navbar-expand-sm navbar-light">
	  <div class="container-fluid ">

        <?
            if (!isMobile()) {
                ?>
                    <a class="navbar-brand " href="#">Багетная мастерская </a>
                    <img src="/img/logo 2.png" alt="" class='img-brand'>
                <?
            }else{
                ?>
                    <div class='row'>
                        <div class='col-9'>
                            <a class="navbar-brand " href="#">Багетная мастерская </a>
                        </div>
                        <div class='col-3'>
                            <img src="/img/logo 2.png" alt="" class='img-brand'>
                        </div>
                    </div>
                <?
            }
        ?>




		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse " id="navbarSupportedContent">
		  <ul class="navbar-nav ms-auto">
			<li class="nav-item">
			  <a class="nav-link" aria-current="page" href="#">Галерея работ</a>
			</li>
            <li class="nav-item">
			  <a class="nav-link" aria-current="page" href="#">Услуги</a>
			</li>
            <li class="nav-item">
			  <a class="nav-link" aria-current="page" href="#">Контакты</a>
			</li>
            <li class="nav-item">
			  <a class="nav-link" aria-current="page" href="#">Оплата и доставка</a>
			</li>			
		  </ul>		  
		</div>
	  </div>
	</nav>
