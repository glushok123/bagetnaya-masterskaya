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
		overflow-y: visible !important;

	}

	body {
		max-width: 100%;
		overflow-y: visible !important;
		overflow-x: hidden !important;
	}
	html{
		overflow-x: hidden !important;
	}

	.price {
		font-weight: bold;
	}

	.test {
		box-sizing: border-box !important;
	}

	form input {
		/* width:90% !important; */
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
</style>

<?php
$keyw = "Наши работы";
$titl = "Наши работы";
$desc = "Наши работы";

include "header.php";
require_once 'base/connect.php';

$category = [
	[
		'name' => 'Акварели, пастели и гравюры',
		'imgMain' => '/img/багетная - фотобанк работ/акварели, пастели и гравюры/ФОТО ДЛЯ ОБЛОЖКИ.JPG',
	],
	[
		'name' => 'Зеркала и тв-панели',
		'imgMain' => '/img/багетная - фотобанк работ/зеркала и тв-панели/IMG_4362.JPG',
	],
	[
		'name' => 'Иконы и вышивки',
		'imgMain' => '/img/багетная - фотобанк работ/иконы и вышивки/ФОТО ДЛЯ ОБЛОЖКИ.JPG',
	],
	[
		'name' => 'Ордена и медали, купюры и монеты',
		'imgMain' => '/img/багетная - фотобанк работ/ордена и медали, купюры и монеты/ФОТО ДЛЯ ОБЛОЖКИ.JPG',
	],
	[
		'name' => 'Оформление живописи',
		'imgMain' => '/img/багетная - фотобанк работ/оформление живописи/ФОТО ДЛЯ ОБЛОЖКИ.JPG',
	],
	[
		'name' => 'Постеры, плакаты и репродукции',
		'imgMain' => '/img/багетная - фотобанк работ/постеры, плакаты и репродукции/ФОТО ДЛЯ ОБЛОЖКИ.JPG',
	],
	[
		'name' => 'Сложные работы',
		'imgMain' => '/img\багетная - фотобанк работ/сложные работы/ФОТО ДЛЯ ОБЛОЖКИ.JPG',
	],
	[
		'name' => 'Фотографии и графика',
		'imgMain' => '/img/багетная - фотобанк работ/фотографии и графика/ФОТО ДЛЯ ОБЛОЖКИ.JPG',
	],
	[
		'name' => 'объектное оформление',
		'imgMain' => '/img/багетная - фотобанк работ/объектное оформление/C21D3219-DF2A-4588-8FF7-19E3046C04D2.JPG',
	],
	[
		'name' => 'Футболки и спортивные атрибуты',
		'imgMain' => '/img/багетная - фотобанк работ/ФУТБОЛКИ И СПОРТИВНЫЕ АТРИБУТЫ/23CA0087-6FB6-4D03-BCA8-E83DDF004619-min.JPG',
	],
]
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<style>
	p {
		text-indent: 20px;
		/* Отступ первой строки в пикселах */
	}
</style>
<div id='crops'>
	<a href='/'>Главная</a> » <a href='/сatalog-of-finished-works.php'>Наши работы</a>
</div>

<hr>

<div class='container'>
	<div class='row text-center'>
		<h3>Наши работы </h3>
		<hr>
	</div>

	<div class='row g-0'>
		<?
		foreach ($category as $item) {
			echo '
						<div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
							<div class="card text-center justify-content-center h-100" style="width:100%" href="/">
								<a href="/сatalog-of-finished-works-by-category.php?category=' . $item['name'] . '"><img src="' . $item['imgMain'] . '" class="rounded mx-auto d-block castom-image " alt="..."></a>
								
								<div class="card-body">
									<a href="/сatalog-of-finished-works-by-category.php?category=' . $item['name'] . '"><h5 class="card-title">' . $item['name'] . '</h5></a>
								</div>
							</div>
						</div>
					';
		}
		?>
	</div>
	<br>
	<p>
		Ищете идеальную раму для картины? Посмотрите примеры оформления разных видов искусства в
		Багетной мастерской №1! Мы подготовили для Вас каталог с разнообразными вариантами работ.
	</p>
	<p>
		Багетная мастерская № 1 имеет большой опыт работы в сфере декоративного оформления.
		Здесь Вы можете увидеть примеры оформления вышивок, икон, гравюр, рамы для живописи и
		3d-оформление монет, медалей и спортивных атрибутов. Профессиональная команда дизайнеров и
		мастеров подберет для Вас индивидуальное оформление картины в раме, отвечающее именно Вашим запросам!
		Ознакомьтесь с различными вариантами художественного оформления Багетной мастерской № 1 и найдите вдохновение именно для Вашей картины!
	</p>
</div>

<br><br><br>

<script>

</script>

<style>
	html, body {
		max-width: 100%;
		overflow-x: hidden;
	}
</style>