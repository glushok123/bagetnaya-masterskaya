<?php

$keywords = empty($_GET['category']) ? "работы, багет, паспарту" : $_GET['category'] . ", работы, багет, паспарту";
$title = empty($_GET['category']) ? "Акварели, пастели и гравюры" : $_GET['category'];
$description = empty($_GET['category']) ? "Наши работы" : $_GET['category'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';

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


<style>
	.castom-image {
		width: 350px ;
		height: 350px ;
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
			width: 350px !important;
			height: 350px !important;
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
    html,
    body {
        max-width: 100%;
    }
    body {
        max-width: 100%;
        overflow-x: hidden;
    }
</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<hr>

<div class='container'>
	<div class='row text-center'>
        <div class="block-h1 text-center my-4 fade-in">
            <h1 class='color-main'>Наши работы раздела "<? echo $_GET['category']; ?> "</h1>
        </div>
		<hr>
        <div class="row text-center justify-content-center">
            <a href="/baget_online">
                <button
                        class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>Рассчитать
                    стоимость багета</button>
            </a>
            <a href="/сatalog-of-finished-works.php">
                Вернуться к разделам
            </a>

        </div>
	</div>
	<div class='row g-0'>
		<?
			foreach ($works as $item) {
				echo '
							<div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 p-1">
								<div class="card text-center justify-content-center h-100 pt-2" style="width:100%" href="/">
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

<br><br><br>

<style>
    .card{
        padding-bottom: 10px;
        border-radius: 6px;
        border: 3px solid var(--beige, #E0D2BB);
    }
    .card:hover{
        background: #E0D2BB;
    }
</style>

<script>
	function show(el) {
		el.find('.tekst_sverhu_kartinki_tekst').css('display', 'block')
	}

	function hide(el) {
		el.find('.tekst_sverhu_kartinki_tekst').css('display', 'none')
	}
</script>


<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>