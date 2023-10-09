<?
	require_once './base/connect.php';
	require_once './constructor_baget/block_0_header.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';

	echo "<body onresize=\"changesize ();\" onload=\"bgswitch();";
	if ($z[21] == "0") {
		echo "transformain();";
	}
	if ($z[11] == "0") {
		echo "changesize ();\" >";
	} else {
		echo "changesize ();\" onmousemove =\"mousemove(event)\" onmousedown=\"mousemove(event)\" onmouseup=\"mousemove(event)\" onselectstart=\"return false;\">";
	}
?>

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

<div class="container">
    <div class="row text-center">
        <h1 class="name-header element-animation">Рассчитайте стоимость багета</h1>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="/constructor_baget/style.css?v<?=$v?>">

<div class="container-fluid ">
    <div class='row'>
        <div class='col-12 col-lg-8 '>
            <?
				if (!isMobile()) {
					include('./constructor_baget/block_1.php');
				}

				if ($z[11] == "0") {
					//
				} else {
					echo "
						<div style=\"
							position:absolute; 
							width:80%; height: 100vh; 
							margin: 3%; 
							padding:0; 
							background:url('pics/" . $z[11] . ".jpg')no-repeat center; 
							background-size:contain;
							z-index
						\"></div>
					";
				}

				include('./constructor_baget/block_2_maket.php');
			?>
		</div>

			
		<div class='col-12 col-lg-4 mx-auto custom-margin-top' style='z-index: 50 !important;' id='block2'>
			<? include('./constructor_baget/block_3_filter.php') ?>
		</div>
	</div>
</div>

<div id="bmenu" style="display: none;">
	<div class="sorter-menu">
		<div id="baget-type-menu">
			<div class='row'>
				<div class='col-6 col-md-3 sort-margin-y'>
					<div>
						<button class="bmenu-open sort-b" id='catalog-plast' onclick="getcatalog('plast');">Пластик</button>
					</div>
				</div>
				<div class='col-6 col-md-3 sort-margin-y'>
					<div>
						<button class="bmenu-open sort-b" id='catalog-wood' onclick="getcatalog('wood');">Дерево</button>
					</div>
				</div>
				<div class='col-6 col-md-3 sort-margin-y'>
					<div>
						<button class="bmenu-open sort-b" id='catalog-alum' onclick="getcatalog('alum');">Алюминий</button>
					</div>
				</div>
				<div class='col-6 col-md-3 sort-margin-y'>
					<div >
						<button class="bmenu-open sort-b" id='catalog-pasp' onclick="getcatalog('pasp');">Паспарту</button>
					</div>
				</div>
			</div>
		</div>
		
		<span>Сортировка:</span>
		

		<select class='sort-select' id="sorter-catalog" name="sorter" data-type="" onchange="getcatalog();">
			<option value="publicvendor-asc">Артикул по возрастанию</option>
			<option value="publicvendor-desc">Артикул по убыванию</option>
			<option class="display-none" value="price-asc">Цена по возрастанию</option>
			<option class="display-none" value="price-desc">Цена по убыванию</option>
			<option class="display-none" value="width-asc">Размер по возрастанию</option>
			<option class="display-none" value="width-desc">Размер по убыванию</option>
		</select>

		<div class="closeme" onclick="closeme()"></div>
	</div>

	<div class="baget-conteiner container" onscroll="scrollingBmenu()"></div>
</div>

</body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/js/jquery.cookie.js"></script>


	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Багет подобранный искусственным интеллектом на основании спектрального анализа изображения</h5>
			<button type="button" class="btn-close btn-close-custom" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body" id ='custom-baget-me'>
				<div class='row baget-conteiner' id='test-r'>

				</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary btn-close-custom" data-bs-dismiss="modal">Закрыть</button>
		</div>
		</div>
	</div>
	</div>
	<style>
		.my-2{
			margin-top: 0.1rem!important;
			margin-bottom: 0.1rem!important;
		}
	</style>
	<? 
	include('./constructor_baget/scriptBagetOnline.php');
	require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
	?>
</HTML>

