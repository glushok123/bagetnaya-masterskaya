<?
	require_once './base/connect.php';
	require_once './constructor_baget/block_0_header.php';
	require_once './constructor_baget/new_header.php';

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

<div class="container">
    <div class="row text-center">
        <h1 class="name-header">Рассчитайте стоимость багета</h1>
    </div>
</div>

<div class="container-fluid ">
    <div class='row'>
        <div class='col-12 col-lg-7'>
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
							width:80%; height:96%; 
							margin:1% 0 0 2%; 
							padding:0; 
							background:url('pics/" . $z[11] . ".jpg')no-repeat center; 
							background-size:contain;
						\"></div>
					";
				}

				include('./constructor_baget/block_2_maket.php');
			?>
		</div>


		<div class='col-12 col-lg-5 mx-auto custom-margin-top' style='z-index: 50 !important;'>
			<? include('./constructor_baget/block_3_filter.php') ?>
		</div>
	</div>
</div>

<div id="bmenu" style="display: none;">
	<div class="sorter-menu">
		Сортировка:
		<select class='sort-select' id="sorter-catalog" name="sorter" data-type="" onchange="getcatalog();">
			<option value="publicvendor-asc">Артикул по возрастанию</option>
			<option value="publicvendor-desc">Артикул по убыванию</option>
			<option class="display-none" value="price-asc">Цена по возрастанию</option>
			<option class="display-none" value="price-desc">Цена по убыванию</option>
			<option class="display-none" value="width-asc">Размер по возрастанию</option>
			<option class="display-none" value="width-desc">Размер по убыванию</option>
		</select>
		<div id="baget-type-menu">
			<div class='row'>
				<div class='col-6 col-md-3 sort-margin-y'>
					<div>
						<button class="bmenu-open sort-b" onclick="getcatalog('plast');">Пластик</button>
					</div>
				</div>
				<div class='col-6 col-md-3 sort-margin-y'>
					<div>
						<button class="bmenu-open sort-b" onclick="getcatalog('wood');">Дерево</button>
					</div>
				</div>
				<div class='col-6 col-md-3 sort-margin-y'>
					<div>
						<button class="bmenu-open sort-b" onclick="getcatalog('alum');">Алюминий</button>
					</div>
				</div>
				<div class='col-6 col-md-3 sort-margin-y'>
					<div >
						<button class="bmenu-open sort-b" onclick="getcatalog('pasp');">Паспарту</button>
					</div>
				</div>
			</div>
		</div>
		<div class="closeme" onclick="closeme()"></div>
	</div>

	<div class="baget-conteiner container" onscroll="scrollingBmenu()"></div>
</div>

</body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/js/jquery.cookie.js"></script>
    <? include('./constructor_baget/scriptBagetOnline.php')?>
</HTML>