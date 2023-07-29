<?php
	require_once 'base/connect.php';

	if (strpos(gethostbyaddr($_SERVER["REMOTE_ADDR"]), 'xml-sitemaps.com')) {
		exit;
	}
	//z[0] id багета, z[1] цена багета, z[2] ширина багета, z[3] id паспарту, z[4] цена паспарту, z[5] ширина паспарту, z[6] опция1, z[7] опция2, z[8] имя картинки, z[9] ширина картинки, z[10] высота картинки, z[11] картинка фона, z[12] меню, z[13] цена, z[14] тип сорировки, z[15] номер заказа, z[16] номер чека, z[17] допы, z[18] расстояние доставки, z[19] marw, z[20] marh, z[21] mash, z[22] ширина багета без четверти
	if (isset($_COOKIE['Skid'])) {
		$skidka = $_COOKIE['Skid'];
	} else {
		$skidka = 0;
	}
	$z = ["7233", "840", "38", "0", "0", "0", "0", "0", "0", "300", "200", "0", "0", "0", "1", "0", "0", "0", "0", "0", "0", "0", "32"];

	if (!empty($_GET['id'])) {
		$ident = $_GET['id'];
		$ident = str_replace(",", "", (string) $ident);
		$ident = str_replace(".", "", $ident);
		$ident = str_replace(" ", "", $ident);
		if (preg_match("/^[\dl]+$/", $ident)) {
			$z = explode('l', $ident);
			if (count($z) != 23) {
				exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
			}
		} else {
			exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
		}
	}

	$stmt = $dbh->prepare("SELECT price FROM catalog_baget WHERE publicvendor=?");
	$stmt->bindParam(1, $z[0]);
	$stmt->execute();
	$data = $stmt->fetchAll();

	if ($z[1] != $data[0]['price']) {
		$z[1] = $data[0]['price'];
	}

	if ($z[8] == '0') {
		$picname = 'pi/0.jpg';
	} else {
		if (file_exists('pics/' . $z[8] . '.jpg')) {
			$picname = 'pics/' . $z[8] . '.jpg';
		} else {
			$picname = 'pi/0.jpg';
			$z[8] = '0';
		}
	}

	if ($z[11] != '0' && !(file_exists('pics/' . $z[11] . '.jpg'))) {
		$z[11] = '0';
	}
	$master = false;
	$minimaster = false;

	if (
		$_SERVER["REMOTE_ADDR"] == '5.39.162.100' ||
		$_SERVER["REMOTE_ADDR"] == '31.173.10.9' ||
		$_SERVER["REMOTE_ADDR"] == '91.79.60.32' ||
		$_SERVER["REMOTE_ADDR"] == '176.108.160.115' ||
		$_SERVER["REMOTE_ADDR"] == '93.80.171.13' ||
		$_SERVER["REMOTE_ADDR"] == '195.91.191.75' ||
		$_SERVER["REMOTE_ADDR"] == '95.25.90.151'
	) {
		$minimaster = true;
	}

	$mainw = round(($z[9] + $z[5] + $z[2] + $z[5] + $z[2]) * $z[21] / 1000);
	$mainh = round(($z[10] + $z[5] + $z[2] + $z[5] + $z[2]) * $z[21] / 1000);

?>
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
    <link rel="stylesheet" type="text/css" href="/stylobgt.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <?
		if ($master) {
			echo '<style>.baganim {transition: none;}</style>';
		}
	?>
</HEAD>
<?
		echo "<body onresize=\"changesize ();\" onload=\"bgswitch();";
		if ($z[21] == "0") {
			echo "transformain();";
		}
		if ($z[11] == "0") {
			echo "changesize ();\" >";
		} else {
			echo "changesize ();\" onmousemove =\"mousemove(event)\" onmousedown=\"mousemove(event)\" onmouseup=\"mousemove(event)\" onselectstart=\"return false;\">";
		}
		function isMobile() {
			return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
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
            <? if(! isMobile()) {?>
            <div class="container">
                <div class='row text-center justify-content-center'>
                    <div class="col-6 ms-auto">
                        <h2 class='c1'>Примерить картину к багету</h2>
                        <?
							if ($z[8] != 0) {
								[$width, $height] = getimagesize($picname);
								echo '	<strong>Обратите внимание</strong><br>Размер изображения 
								' . $width . ' на ' . $height . '
								точек, соотношение сторон картины 
								зафиксировано соответственно. 
								<br>Печать изображения не входит в стоимость заказа<br>
								<a onclick="z[8]=0; rePage ();" class="t2 ">Убрать изображение картины</a>';
							} else {
								echo '
								<form id="fileform" action="/upload.php?id=' . implode("l", $z) . '" method="post" enctype="multipart/form-data">
									<label class="btn btn-secondary b1">
										<input type="file" name="filename"  onchange="javascript:this.form.submit();" style="display:none;">
										Выберите файл
									</label>
								</form>';
							}
						?>
                    </div>
                    <div class="col-6 mx-auto">
                        <h2 class='c1'>Просмотр в интерьере</h2>
                        <?
							if ($z[11] != 0) {
								echo '	<a onclick="z[11]=0; rePage ();" class="t2">Убрать изображение интерьера</a>';
							} else {
								echo '	
								<form id="fileform2" action="/upload2.php?id=' . implode("l", $z) . '" method="post" enctype="multipart/form-data">
									<label class="btn btn-secondary b1">
										<input type="file" name="filename" onchange="javascript:this.form.submit();" style="display:none;">
										Выберите файл
									</label>
								</form>';
							}
						?>
                    </div>
                </div>

            </div>

            <? } ?>
            <?
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
					\">
					</div>";
				}
			?>
            <div class="position-relative custom-height-block-1" id='block-orient-width'>
                <div class='position-absolute' style="top:10px">

                    <img src="/img/2.png" alt="" style='
							width:20%;
							display: none;
						' class='img-custom' id='img-custom'>

                    <div id='bagcont'>

                        <?
								$stmt = $dbh->prepare("SELECT listimg FROM catalog_baget WHERE publicvendor=?");
								$stmt->bindParam(1, $z[3]);
								$stmt->execute();
								$data = $stmt->fetchAll();
							?>

                        <div id='bgpass' class='baganim' style="background: url('pi/<?= $data[0]['listimg'] ?>');">
                        </div>
                        <div id='bgcenter' class='baganim' style="background:url('<?= $picname ?>');"></div>
                        <div id='bgtop' class='baganim' style="
								<?
									if (isset($_COOKIE['catalogfile'])  && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $_COOKIE['catalogfile'])) {
										echo 'background:url(/' . $_COOKIE['catalogfile'] . ') repeat-x';
									} else {
										echo 'background:url(/bi/' . $z[0] . 't.jpg) repeat-x';
									}
								?>
							"></div>

                        <div id='bgbot' class='baganim' style="
								<? 
									if (isset($_COOKIE['catalogfile'])  && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $_COOKIE['catalogfile'])) { 
								?>
									background:url('/<?= $_COOKIE['catalogfile'] ?>') repeat-x;
								<? } else { ?>
									background:url('/bi/<?= $z[0] ?>t.jpg') repeat-x;
								<? } ?>
							"></div>

                        <div id='bgrwrap' class='baganim'>
                            <div id='bgright' class='baganim' style="
									<? if (isset($_COOKIE['catalogfile']) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $_COOKIE['catalogfile'])) { ?>
										background:url('/<?= $_COOKIE['catalogfile'] ?>') repeat-x;
									<? } else { ?>
									background:url('/bi/<?= $z[0] ?>t.jpg') repeat-x;
									<? } ?>
								">
                            </div>
                        </div>

                        <div id='bglwrap' class='baganim'>
                            <div id='bgleft' class='baganim' style="
									<? if (isset($_COOKIE['catalogfile'])  && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $_COOKIE['catalogfile'])) { ?>
										background:url('/<?= $_COOKIE['catalogfile'] ?>') repeat-x;
									<? } else { ?>
									background:url('/bi/<?= $z[0] ?>t.jpg') repeat-x;
									<? } ?>
								">
                            </div>
                        </div>

                        <?
								if ($z[11] != 0) {
									echo "
										<div id=\"resizec\"></div>
										<div id=\"resizerb\"></div>
										<div id=\"resizelt\"></div>
										<div id=\"resizelb\"></div>
										<div id=\"resizert\"></div>
									</div>
								";
								} else {
									echo "
											<div class='baganim sizey' id='sizey'></div>
											<div class='baganim sizex' id='sizex'></div>
										</div>
									";
								}
							?>
                    </div>

                    <div id="bmenu" style="display: none;">
                        <div class="sorter-menu">
                            Сортировка:
                            <select id="sorter-catalog" name="sorter" data-type="" onchange="getcatalog();">
                                <option value="publicvendor-asc">Артикул по возрастанию</option>
                                <option value="publicvendor-desc">Артикул по убыванию</option>
                                <option class="display-none" value="price-asc">Цена по возрастанию</option>
                                <option class="display-none" value="price-desc">Цена по убыванию</option>
                                <option class="display-none" value="width-asc">Размер по возрастанию</option>
                                <option class="display-none" value="width-desc">Размер по убыванию</option>
                            </select>
                            <div id="baget-type-menu">
                                <span class="bmenu-open" onclick="getcatalog('plast');">Пластик</span>
                                <span class="bmenu-open" onclick="getcatalog('wood');">Дерево</span>
                                <span class="bmenu-open" onclick="getcatalog('alum');">Алюминий</span>
                                <span class="bmenu-open" onclick="getcatalog('pasp');">Паспарту</span>
                            </div>
                            <div class="closeme" onclick="closeme()"></div>
                        </div>
                        <div class="baget-conteiner" onscroll="scrollingBmenu()"></div>
                    </div>

                    <div class="layer"></div>
                </div>


            </div>

            <div class='col-12 col-lg-5 mx-auto custom-margin-top' style='z-index: 50 !important;'>

				<section>
					<? if(isMobile()) {?>
					<div class="">
						<br><br>
						<div class='row text-center justify-content-center'>
							<div class="col-6 ms-auto">
								<h2 class='c1'>Примерить картину к багету</h2>
								<?
										if ($z[8] != 0) {
											[$width, $height] = getimagesize($picname);
											echo '	<strong>Обратите внимание</strong><br>Размер изображения 
											' . $width . ' на ' . $height . '
											точек, соотношение сторон картины 
											зафиксировано соответственно. 
											<br>Печать изображения не входит в стоимость заказа<br>
											<a onclick="z[8]=0; rePage ();" class="t2 ">Убрать изображение картины</a>';
										} else {
											echo '
											<form id="fileform" action="/upload.php?id=' . implode("l", $z) . '" method="post" enctype="multipart/form-data">
												<label class="btn btn-secondary b1">
													<input type="file" name="filename"  onchange="javascript:this.form.submit();" style="display:none;">
													Выберите файл
												</label>
											</form>';
										}
									?>
							</div>
							<div class="col-6 mx-auto">
								<h2 class='c1'>Просмотр в интерьере</h2>
								<?
										if ($z[11] != 0) {
											echo '	<a onclick="z[11]=0; rePage ();" class="t2">Убрать изображение интерьера</a>';
										} else {
											echo '	
											<form id="fileform2" action="/upload2.php?id=' . implode("l", $z) . '" method="post" enctype="multipart/form-data">
												<label class="btn btn-secondary b1">
													<input type="file" name="filename" onchange="javascript:this.form.submit();" style="display:none;">
													Выберите файл
												</label>
											</form>';
										}
									?>
							</div>
						</div>
						<br>

					</div>

					<? } ?>
				</section>
				<section class='screen size-img'>
					<form id="form" name="form" onsubmit="return false;">
						<div class='row justify-contant-center' >
							<div class='bg-custom-gold w1 h1 d-flex'>
								<span class='s1 align-self-center container'>1. Укажите размеры изображения</span>
							</div>
						</div>
						
						<div class='container my-2'>
							<div class='row  justify-contant-center'>
								<div class='col-4 col-lg-3 col-xxl-2'>
									<div class="p2">
										<span class='s2 text-nowrap'>Ширина (мм)</span>
									</div>
								</div>
								<div class='col-4 col-lg-3 col-xxl-3'>
										<input 
											type="number" 
											class='i1' 
											id="fwid" 
											name="fwid" 
											onchange="changesize(9);countprice ();"
											value="<?= $z[9] ?>" 
											autocomplete="off"
										>
								</div>
								<div class='col-4 col-lg-3 col-xxl-3'>
										<button type="submit" class="btn btn-secondary b1">Применить</button>
								</div>
							</div>

							<div class='row justify-contant-center my-3'>
								<div class='col-4 col-lg-3 col-xxl-2'>
									<div class="p2">
										<span class='s2 text-nowrap'>Высота (мм)</span>
									</div>
								</div>
								<div class='col-4 col-lg-3 col-xxl-3'>
										<input 
											type="number" 
											class='i1' 
											id="fhig" 
											name="fhig"
											onchange="changesize(10);countprice ();" 
											value="<?= $z[10] ?>"
											autocomplete="off"
										>
								</div>
								<div class='col-4 col-lg-3 col-xxl-3'>
										<button type="submit" class="btn btn-secondary b1">Применить</button>
								</div>
							</div>
						</div>
					</form>
				</section>

				<section class='screen baget-and-paspartu'>
					<div class='row justify-contant-center' >
						<div class='bg-custom-gold w1 h1 d-flex'>
							<span class='s1 align-self-center container'>2. Выберете багет и паспарту</span>
						</div>
					</div>

					<div class='container my-2'>
						<div class='row  justify-contant-center'>
							<div class='col-2'>
								<div class="p2">
									<span class='s2 '>Багет</span>
								</div>
							</div>
							<div class='col-8'>
								<button type="button" class="bmenu-type btn b2" onclick="getcatalog('plast');">Пластик</button>
								<button type="button" class="bmenu-type btn b2" onclick="getcatalog('wood');">Дерево</button>
								<button type="button" class="bmenu-type btn b2" onclick="getcatalog('alum');">Аллюминий</button>
							</div>
						</div>
						<div class='row justify-contant-center my-3'>
							<div class='col-2'>
								<div class="p2">
									<span class='s2'>Паспарту</span>
								</div>
							</div>
							<div class='col-10'>
								<button type="button" class="bmenu-type choice-pasp btn btn-secondary b1 w120" onclick="getcatalog('pasp');">Выбрать</button>
								<button type="button" class="t2 close-pasp-block btn btn-secondary b1 w120" onclick="z[3]=0; z[4]=0; z[5]=0; changesize(); countprice ();">Удалить</button>
							</div>
						</div>
					</div>
				</section>

				<section class='screen steclo-and-zad'>
					<div class='row justify-contant-center' >
						<div class='bg-custom-gold w1 h1 d-flex'>
							<span class='s1 align-self-center container'>3. Выберите стекло и задник</span>
						</div>
					</div>
					<div class='container my-2'>
						<div class='row  justify-contant-center'>
							<div class='col-2'>
								<div class="p2 my-2">
									<span class='s2 '>Стекло</span>
								</div>
							</div>
							<div class='col-8'>
								<button type="button" class="btn b2 my-2" onclick="z[6]=1; bgswitch();">Обычное</button>
								<button type="button" class="btn b2 my-2" onclick="z[6]=2; bgswitch();">Матовое</button>
								<button type="button" class="btn b2 my-2" onclick="z[6]=3; bgswitch();">Антиблик</button>
								<button type="button" class="btn b2 my-2" onclick="z[6]=4; bgswitch();">Пластиковое</button>
								<button type="button" class="btn btn-secondary b1 w120"  onclick="z[6]=0; bgswitch();">Удалить</button>
							</div>
						</div>
						<div class='row justify-contant-center my-3'>
							<div class='col-2'>
								<div class="p2 my-2">
									<span class='s2'>Задник</span>
								</div>
							</div>
							<div class='col-8'>
								<button type="button" class="btn b2 my-2" onclick="z[7]=1; bgswitch();">Картон</button>
								<button type="button" class="btn b2 my-2 w176" onclick="z[7]=2; bgswitch();">Пенокартон 5 мм</button>
								<button type="button" class="btn b2 my-2 w176" onclick="z[7]=3; bgswitch();">Натяжка вышивки</button>
								<button type="button" class="btn b2 my-2" onclick="z[7]=4; bgswitch();">Подрамник</button>
								<button type="button" class="btn btn-secondary b1 w120" onclick="z[7]=0; bgswitch();">Удалить</button>
							</div>
						</div>
					</div>
				</section>

				<section class='screen itogo bg-custom-gold-itogo'>
					<div class='container my-2'>
						<div class='row text-center justify-contant-center block-itogo'>

							<span class='s-itogo'>Итоговая стоимость: <span class='s-itogo-price' id="price0">0</span><span class='s-itogo-price'> ₽</span></span>
							
						</div>
						<br>
						<div class='row  my-3 d-flex align-self-center'>
							<div class='col-4 '>
								<div class="p2 text-end">
									<span class='s2'>Промокод:</span>
								</div>
							</div>
							<div class='col-3'>
								<input id="promo_kod" type="text" class="i-promo" />
							</div>
							<div class='col-4'>
							<button type="button" class="btn btn-secondary b1 w120" >Применить</button>
							</div>
						</div>

						<br>

						<div class='row justify-contant-center text-center mx-auto'>
							<button class='butn b3 mx-auto'>Оформить заказ</button>
						</div>
					</div>
				</section>

                <table cellpadding="0" cellspacing="0" style=" z-index: 50;" class="mx-auto">
                    <tr>
                        <td style="vertical-align:middle;">
                            <div id="bagsidemenu">

                                <hr>
                                <span style="color:#339; font-weight:700;">Выберите багет и паспарту:</span><br>
                                <div style="width:50%; position:relative; float:left;">Багет: <b id="price1">0</b>
                                    р.<br>
                                    <span class="bmenu-type" onclick="getcatalog('plast');">Пластик</span>
                                    <span class="bmenu-type" onclick="getcatalog('wood');">Дерево</span>
                                    <span class="bmenu-type" onclick="getcatalog('alum');">Алюминий</span>

                                    <div class="pasp-block" id="blockarticul" style="display: none">
                                        <span style="color:black; font-weight:500;">Выбранный артикул:</span><br>
                                        <span id="articul" style=" font-weight:600; font-weight: bold;"></span>
                                    </div>

                                </div>
                                <div style="width:50%; position:relative; float:left; ">Паспарту: <b id="price2">0</b>
                                    р.<br>
                                    <a href="#" class="bmenu-type choice-pasp"
                                        onclick="getcatalog('pasp');">Выбрать</a><br><br>

                                    <div class="pasp-block" id="blockarticul2" <? if ($z[3] <> 0) {
                                        ?>style="display:block;"
                                        <? } ?>>
                                        <span style="color:black; font-weight:500;">Выбранный артикул:</span><br>
                                        <span id="articul2" style=" font-weight:600; font-weight: bold;">
                                            <? if ($z[3] <> 0) {
								echo ($z[3]);
							} ?>
                                        </span>
                                    </div>
                                    <div class="pasp-block" <? if ($z[3] <> 0) { ?>style="display:block;"
                                        <? } ?>>
                                        <a onclick="z[3]=0; z[4]=0; z[5]=0; changesize(); countprice ();"
                                            class="t2 close-pasp-block">Убрать</a><br>Размер (мм)<br>

                                        <form id="form2" name="form2" onsubmit="return false;">
                                            <input type="text" id="fpasp" name="fpasp"
                                                onchange="changesize(); countprice ();" value="<?= $z[5] ?>"
                                                autocomplete="off"><br>
                                            <input type="submit" value="Применить">
                                        </form>
                                    </div>

                                </div>
                                <hr>
                                <span style="color:#339; font-weight:700;">Выберите стекло и задник:</span><br>
                                <div style="width:50%; position:relative; float:left;">Стекло: <b id="price3">0</b>
                                    р.<br>
                                    <a id="sw60" class="t3" onclick="z[6]=0; bgswitch();">Нет</a><br>
                                    <a id="sw61" class="t2" onclick="z[6]=1; bgswitch();">Обычное</a><br>
                                    <a id="sw62" class="t2" onclick="z[6]=2; bgswitch();">Матовое</a><br>
                                    <a id="sw63" class="t2" onclick="z[6]=3; bgswitch();">Антиблик</a><br>
                                    <a id="sw64" class="t2" onclick="z[6]=4; bgswitch();">Пластиковое</a><br>
                                </div>
                                <div style="width:50%; position:relative; float:left; ">Задник: <b id="price4">0</b>
                                    р.<br>
                                    <a id="sw70" class="t3" onclick="z[7]=0; bgswitch();">Нет</a><br>
                                    <a id="sw71" class="t2" onclick="z[7]=1; bgswitch();">Картон</a><br>
                                    <a id="sw72" class="t2" onclick="z[7]=2; bgswitch();">Пенокартон 5мм</a><br>
                                    <a id="sw73" class="t2" onclick="z[7]=3; bgswitch();">Натяжка вышивки</a><br>
                                    <a id="sw74" class="t2" onclick="z[7]=4; bgswitch();">Подрамник</a><br>
                                </div>
                                <hr>Сборка рамы: <b id="price6">0</b> р.<br>
                                <hr>
                                Промокод: <input id="promo_kod" type="text" class="form-control form-control-lg"
                                    placeholder="Промокод" data-type="none" data-count="none" data-procent="none" />
                                <button id="get-info-promo-kods">Применить</button><br>
                                <span id="info-promokod"></span>
                                <hr>
                                Цена:<br><span style="font-size:200%;"><span id="price0">0</span> р</span><br>
                                <hr>
                                <br><a onclick="goPage(1)" class="bagzak">Оформить заказ</a>
                            </div>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/js/jquery.cookie.js"></script>
    <? include('./scriptBagetOnline.php')?>

</HTML>