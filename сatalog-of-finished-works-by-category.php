<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<style>
	* {
		box-sizing: content-box;
	}

	.castom-image {
		width: 250px !important;
		height: 250px !important;
		object-fit: cover;
	}

	.carousel-item {
		text-align: center !important;
	}

	.d-block {
		display: inline-block !important;
	}

	html,
	body {
		max-width: 100%;

	}

	body {
		max-width: 100%;
		overflow-y: visible !important;
		overflow-x: hidden;
	}

	.price {
		font-weight: bold;
	}

	.test {
		box-sizing: border-box !important;
	}

	form input {
		/*width:90% !important;*/
	}

	form select {
		width: 85% !important;
	}

	form textarea {
		width: 90% !important;
	}

	.hidden {
		display: none;
	}

	@media screen and (max-width: 1200px) {
		.castom-image {
			width: 200px !important;
			height: 200px !important;
		}
	}

	@media screen and (max-width: 900px) {
		.castom-image {
			width: 170px !important;
			height: 170px !important;
		}
	}

	.tekst_sverhu_kartinki {
		position: relative;
	}

	.tekst_sverhu_kartinki_tekst {
		position: absolute;
		bottom: 5%;
		text-transform: uppercase;
		color: white !important;
		width: 93%;
		background: #1c1515dc;
		padding: 10px;
		text-align: center;
		display: none;
		font-size: 15px;
	}

	.fancybox-caption {
		background: #1c1515dc !important;
		bottom: 10% !important;
		padding-top: 15px !important;
	}
</style>

<?php
$keyw = empty($_GET['category']) ? "работы, багет, паспарту" : $_GET['category'] . ", работы, багет, паспарту";
$titl = empty($_GET['category']) ? "Акварели, пастели и гравюры" : $_GET['category'];
$desc = empty($_GET['category']) ? "Наши работы" : $_GET['category'];

include "header.php";
require_once 'base/connect.php';

$category = [
	'Акварели, пастели и гравюры' => [
		'urlFromImages' => './img/багетная - фотобанк работ/акварели, пастели и гравюры/',
		'id' => 1
	],
	'Зеркала и тв-панели' => [
		'urlFromImages' => './img/багетная - фотобанк работ/зеркала и тв-панели/',
		'id' => 2
	],
	'Иконы и вышивки' => [
		'urlFromImages' => './img/багетная - фотобанк работ/иконы и вышивки/',
		'id' => 3
	],
	'Ордена и медали, купюры и монеты' => [
		'urlFromImages' => './img/багетная - фотобанк работ/ордена и медали, купюры и монеты/',
		'id' => 4
	],
	'Оформление живописи' => [
		'urlFromImages' => './img/багетная - фотобанк работ/оформление живописи/',
		'id' => 5
	],
	'Постеры, плакаты и репродукции' => [
		'urlFromImages' => './img/багетная - фотобанк работ/постеры, плакаты и репродукции/',
		'id' => 6
	],
	'Сложные работы' => [
		'urlFromImages' => './img/багетная - фотобанк работ/сложные работы/',
		'id' => 7
	],
	'Фотографии и графика' => [
		'urlFromImages' => './img/багетная - фотобанк работ/фотографии и графика/',
		'id' => 8
	],
	'объектное оформление' => [
		'urlFromImages' => './img/багетная - фотобанк работ/объектное оформление/',
		'id' => 9
	],
	'Футболки и спортивные атрибуты' => [
		'urlFromImages' => './img/багетная - фотобанк работ/ФУТБОЛКИ И СПОРТИВНЫЕ АТРИБУТЫ/',
		'id' => 10
	],
];

$stm = $dbh->prepare("SELECT * FROM gallery_work_images where category = " . $category[$_GET['category']]['id']);
$stm->execute();
$works = $stm->fetchAll();
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<div id='crops'>
	<a href='/'>Главная</a> » <a href='/сatalog-of-finished-works.php'>Наши работы</a> » <a href='/сatalog-of-finished-works-by-category.php?category=<? echo $_GET['category']; ?>'><? echo $_GET['category']; ?></a>
</div>

<hr>

<div class='container'>
	<div class='row text-center'>
		<h3>Наши работы раздела "<? echo $_GET['category']; ?> "</h3>
		<hr>
		<a href='/сatalog-of-finished-works.php'>Вернуться к разделам</a>
	</div>
	<div class='row g-0'>
		<?
			foreach ($works as $item) {
				echo '
							<div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
								<div class="card text-center justify-content-center h-100" style="width:100%" href="/">
									<a data-fancybox="images"  data-caption="' . $item['description'] . '" href="' . $item['url_image'] . '"  style="text-decoration: none;" class="tekst_sverhu_kartinki" onmouseover="show($(this))" onmouseout="hide($(this))">
										<img src="' . $item['url_image'] . '" class="rounded mx-auto d-block castom-image " alt="..." >
										<h5 style="color:black;" display:none" class="tekst_sverhu_kartinki_tekst">' . $item['description'] . '</h5>
									</a>
								</div>
							</div>
						';
			}
		?>
	</div>
</div>

<div id="left">
	<a href="/pechat_na_holste/" class="lm unmark"> Печать на холсте</a>
	<a href="/bagetnye_raboty/" class="lm unmark"> Багетные работы</a>
	<a href="/natyazhka_holsta/" class="lm unmark"> Натяжка холста</a>
	<a href="/nakatka_na_penokarton/" class="lm unmark"> Накатка на пенокартон</a>
	<a href="/pechat_na_penokartone/" class="lm unmark"> Печать на пенокартоне</a>
	<a href="/ramki_dlya_ikon/" class="lm unmark"> Рамки для икон</a>
	<a href="/ramki_dlya_kartin/" class="lm unmark"> Рамки для картин</a>
	<a href="/bagetnye_ramki/" class="lm unmark"> Багетные рамки</a>
	<a href="/ramki_dlya_vyshivki/" class="lm unmark"> Рамки для вышивки</a>
	<a href="/baget_dlya_ikony/" class="lm unmark"> Багет для иконы</a>
	<a href="/bagety_dlya_kartin/" class="lm unmark"> Багеты для картин</a>
	<a href="/zerkala_v_bagete/" class="lm unmark"> Зеркала в багете</a>
	<a href="/ordena_i_medali/" class="lm unmark"> Панно для наград и орденов</a>
</div>


<br><br><br><br><br>

<script>
	function show(el) {
		el.find('.tekst_sverhu_kartinki_tekst').css('display', 'block')
	}

	function hide(el) {
		el.find('.tekst_sverhu_kartinki_tekst').css('display', 'none')
	}
</script>