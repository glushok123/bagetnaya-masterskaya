<?
    $keywords = "багетные работы, работы, багет, паспарту";
    $title = "Багет онлайн, конструктор багета онлайн";
    $description = "Конструктор багета онлайн";

    $hideTop = true;

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


<div class="arrow-back">
    <a href="/" style="text-decoration: none; color:black;"><div class="signpost1-left">
        <p>На главную</p>
    </div>
    </a>
</div>

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

<div class="container"  <?	if (isMobile()) { ?>  style="margin-top: 60px;" <? } ?>>
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

<div id="bmenu" style="display: none; z-index: 9999999999999">
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

        <br>
        <div class="mt-4 search-article-block">
            <input type="number" class="form-control sort-margin-y" id="search-article" aria-describedby="" style="max-width: 250px;" placeholder="Артикул..." oninput="getcatalog('pasp', 1, true);">
        </div>
	</div>


        <div class="baget-conteiner container" onscroll="scrollingBmenu()">
            <div class='row' id="addBagetBlock">

            </div>
            <div id="showmore-triger" data-page="1" data-max="100" style="display: none">
                <img src="/assets/img/ajax-loader.gif" alt="">
            </div>
        </div>


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
        @media (min-width: 1400px ){
            .search-article-block{
                position: absolute;
                left: 1000px;
                top:0px;
                margin-top: 15px !important;
            }
        }

		.my-2{
			margin-top: 0.1rem!important;
			margin-bottom: 0.1rem!important;
		}
        #showmore-triger {
            text-align: center;
            padding: 10px;
            background: #ffdfdf;
        }

        /* Вывод товаров */
        .prod-list {
            overflow: hidden;
            margin: 0 0 20px 0;
        }
        .prod-item {
            width: 174px;
            height: 230px;
            float: left;
            border: 1px solid #ddd;
            padding: 20px;
            margin: 0 20px 20px 0;
            text-align: center;
            border-radius: 6px;
        }
        .prod-item-img {
            width: 100%;
        }
        .prod-item-name {
            font-size: 13px;
            line-height: 16px;
        }

        .prod-list .prod-item:nth-child(3n) {
            margin-right: 0
        }
.arrow-back{
    position: absolute;
    top:15px;
    left:15px;

}

        .arrow-6 {
            margin-right:0px;
        }

        .arrow-6 svg {
            width: 100px;
            height: auto;
            margin: 0 2rem;
            cursor: pointer;
            overflow: visible;
        }
        .arrow-6 svg {
            margin-right:0px;
        }
        .arrow-6 svg polygon,
        .arrow-6 svg path {
            transition: all 0.5s cubic-bezier(0.2, 1, 0.3, 1);
            fill: #6a1a21;
        }
        .arrow-6 svg:hover polygon,
        .arrow-6 svg:hover path {
            transition: all 1s cubic-bezier(0.2, 1, 0.3, 1);
            fill: #000;
        }
        .arrow-6 svg:hover .arrow-6-pl {
            animation: arrow-6-anim 1s cubic-bezier(0.2, 1, 0.3, 1) infinite;
        }
        .arrow-6 svg:hover .arrow-6-pl-fixed {
            animation: arrow-6-fixed-anim 1s cubic-bezier(0.2, 1, 0.3, 1) infinite;
        }

        @keyframes arrow-6-anim {
            0% {
                opacity: 1;
                transform: translateX(0);
            }
            5% {
                transform: translateX(-0.1rem);
            }
            100% {
                transform: translateX(1rem);
                opacity: 0;
            }
        }
        @keyframes arrow-6-fixed-anim {
            5% {
                opacity: 0;
            }
            20% {
                opacity: 0.4;
            }
            100% {
                opacity: 1;
            }
        }
        .signpost1-left{
            background-color: #dacab1; /* определяем цвет */
            width: 150px; /* устанавливаем размеры */
            height: 50px;
            clip-path: polygon(12% 0%, 100% 0%, 100% 100%, 12% 100%, 0% 50%); /* создаем полигон */
            shape-outside: polygon(12% 0%, 100% 0%, 100% 100%, 12% 100%, 0% 50%);
        }
        .signpost1-left p{
            font-size: 19px;
            margin: 0 auto;
            padding-top: 15px;
            text-align: center;
        }
        .signpost1-left{
            1px solid var(--beige, #e0d2bb) !important;
        }
        .signpost1-left:hover{
            background-color: #6a1a21;
            color: white;
        }
	</style>

	<? 
        include('./constructor_baget/scriptBagetOnline.php');
        require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
	?>

<script>
    var processDownload = false;
    var curentPage = 1;

    $('.baget-conteiner').scroll(function() {
        if (processDownload === false){
            buffer = 40 // # of pixels from bottom of scroll to fire your function. Can be 0
            if ($(".baget-conteiner").prop('scrollHeight') - $(".baget-conteiner").scrollTop() <= $(".baget-conteiner").height() + buffer )   {
                processDownload = true;
                curentPage = curentPage + 1;
                getcatalog($('#sorter-catalog').attr("data-type"), curentPage)
            }
        }
    });
</script>
</HTML>

