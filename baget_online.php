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
$z = array("7233", "840", "38", "0", "0", "0", "0", "0", "0", "300", "200", "0", "0", "0", "1", "0", "0", "0", "0", "0", "0", "0", "32");

if ($_GET['id']) {
	$ident = $_GET['id'];
	$ident = str_replace(",", "", $ident);
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

if ($z[1] != $data["price"]) {
	$z[1] = $data[0]["price"];
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

if (!$minimaster) {

	//session_start();
	/*if (isset($_SERVER['HTTP_COOKIE'])){ 
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			foreach($cookies as $cookie) { 
				$parts = explode('=', $cookie); 
				$name = trim($parts[0]);
				setcookie($name, '', time()-1000);
				setcookie($name, '', time()-1000, '/');
			}
		}*/
	//session_destroy();
}
?>
<!DOCTYPE HTML>
<HTML onselectstart="return false;">

<HEAD>
	<link rel="SHORTCUT ICON" href="/favicon.ico">
	<? if (false && $_GET['id']) {
		echo '<link rel="canonical" href="http://bagetnaya-masterskaya.com/baget_online"/>';
	} ?>

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

	<script>
		<? echo 'var z=[' . $z[0] . ',' . $z[1] . ',' . $z[2] . ',' . $z[3] . ',' . $z[4] . ',' . $z[5] . ',' . $z[6] . ',' . $z[7] . ',' . $z[8] . ',' . $z[9] . ',' . $z[10] . ',' . $z[11] . ',' . $z[12] . ',' . $z[13] . ',' . $z[14] . ',' . $z[15] . ',' . $z[16] . ',' . $z[17] . ',' . $z[18] . ',' . $z[19] . ',' . $z[20] . ',' . $z[21] . ',' . $z[22] . '], mainw=' . $mainw . ', mainh=' . $mainh; ?>

		var curTimerId = 0;
		cursw6 = 0,
			cursw7 = 0,
			s = 0,
			price0 = 0,
			price1 = 0,
			price2 = 0,
			price3 = 0,
			price4 = 0,
			price6 = 0,
			price7 = 0,
			someflag = moveflag = rebflag = retflag = relflag = rerflag = false;

		function mousemove(e) {
			if (e.type == "mousedown") {
				Xstart = e.clientX;
				Ystart = e.clientY;
				if (z[19] < Xstart && Xstart < z[19] + mainw && z[20] < Ystart && Ystart < z[20] + mainh) {
					if (Xstart > z[19] + mainw * 0.8 && Ystart > z[20] + mainh * 0.8) {
						rebflag = rerflag = true;
					} else if (Xstart < z[19] + mainw * 0.2 && Ystart < z[20] + mainh * 0.2) {
						retflag = relflag = true;
					} else if (Xstart > z[19] + mainw * 0.8 && Ystart < z[20] + mainh * 0.2) {
						retflag = rerflag = true;
					} else if (Xstart < z[19] + mainw * 0.2 && Ystart > z[20] + mainh * 0.8) {
						relflag = rebflag = true;
					} else {
						moveflag = true;
					}
					someflag = true;
					newimgwid = mainw;
					newimghei = mainh;
					newxpos = xpos = z[19];
					newypos = ypos = z[20];
					imgk = mainh / mainw;
					document.getElementById('bagcont').className = 'baginst';
					document.getElementById('bgpass').className = 'baginst';
					document.getElementById('bgtop').className = 'baginst';
					document.getElementById('bgbot').className = 'baginst';
					document.getElementById('bgleft').className = 'baginst';
					document.getElementById('bglwrap').className = 'baginst';
					document.getElementById('bgrwrap').className = 'baginst';
					document.getElementById('bgright').className = 'baginst';
					document.getElementById('bgcenter').className = 'baginst';
				}
			}
			if (e.type == "mouseup" && someflag) {
				z[19] = xpos = newxpos;
				z[20] = ypos = newypos;
				z[21] = Math.floor(z[21] * newimgwid / mainw);
				mainw = newimgwid;
				mainh = newimghei;
				changePage();
				someflag = moveflag = relflag = rebflag = retflag = rerflag = false;
				document.getElementById('bagcont').className = 'baganim';
				document.getElementById('bgpass').className = 'baganim';
				document.getElementById('bgtop').className = 'baganim';
				document.getElementById('bgbot').className = 'baganim';
				document.getElementById('bgleft').className = 'baganim';
				document.getElementById('bglwrap').className = 'baginst';
				document.getElementById('bgrwrap').className = 'baginst';
				document.getElementById('bgright').className = 'baganim';
				document.getElementById('bgcenter').className = 'baganim';
			}
			if (someflag) {
				dx = e.clientX - Xstart;
				dy = e.clientY - Ystart;
			}
			if (moveflag) {
				newxpos = z[19] + dx;
				newypos = z[20] + dy;
			}
			if (rerflag) {
				newimgwid = mainw + dx;
				if (newimgwid < 50) {
					newimgwid = 50;
				}
			}
			if (relflag) {
				newimgwid = mainw - dx;
				if (newimgwid < 50) {
					newimgwid = 50;
				}
			}
			if (retflag) {
				newimghei = mainh - dy;
				if (newimghei < 50) {
					newimghei = 50;
				}
			}
			if (rebflag) {
				newimghei = mainh + dy;
				if (newimghei < 50) {
					newimghei = 50;
				}
			}

			if (someflag) {
				newfixedhei = Math.floor(newimgwid * imgk);
				newfixedwid = Math.floor(newimghei / imgk);
				if (newfixedhei * newimgwid < newfixedwid * newimghei) {
					newimgwid = newfixedwid;
				} else {
					newimghei = newfixedhei;
				}

			}

			if (relflag) {
				newxpos = xpos - newimgwid + mainw;
			}
			if (retflag) {
				newypos = ypos - newimghei + mainh;
			}
			if (someflag) {

				if (z[5] > 0) {
					kox = newimgwid / (2 * z[2] + 2 * z[5] + z[9]);
					koy = newimghei / (2 * z[2] + 2 * z[5] + z[10]);
				} else {
					kox = newimgwid / (z[9] + 2 * z[22] + 2);
					koy = newimghei / (z[10] + 2 * z[22] + 2);
				}

				t = Math.floor(kox * z[2]);

				if (z[5] > 0) {
					wim = Math.floor(kox * (z[2] + z[5]));
					him = Math.floor(koy * (z[2] + z[5]));
					wi = Math.floor(newimgwid) - t - wim;
					hi = Math.floor(newimghei) - t - him;
				} else {
					wim = Math.floor(kox * z[22]);
					him = Math.floor(koy * z[22]);
					wi = Math.floor(newimgwid) - 2 * wim;
					hi = Math.floor(newimghei) - 2 * him;
				}



				ws = newimghei / 1.41421;

				bagcont.style.width = Math.floor(newimgwid) + 'px';
				bagcont.style.height = Math.floor(newimghei) + 'px';
				bagcont.style.left = Math.floor(newxpos) + 'px';
				bagcont.style.top = Math.floor(newypos) + 'px';

				bgtop.style.height = t + 'px';
				bgbot.style.height = t + 'px';
				bgrwrap.style.width = ws + 'px';
				bgrwrap.style.height = ws + 'px';
				bglwrap.style.width = ws + 'px';
				bglwrap.style.height = ws + 'px';
				bgright.style.height = t + 'px';
				bgleft.style.height = t + 'px';

				bgcenter.style.width = wi + 'px';
				bgcenter.style.height = hi + 'px';
				bgcenter.style.top = him + 'px';
				bgcenter.style.left = wim + 'px';
			}
		}

		function transformain() {
			width = document.body.clientWidth;
			height = document.body.clientHeight;
			if (z[11] == "0") {
				mainw = width * 0.6;
				mainh = height * 0.8;
				z[19] = Math.floor(width * 0.1);
				z[20] = Math.floor(height * 0.1);
			} else {
				mainw = width * 0.3;
				mainh = height * 0.4;
				z[19] = Math.floor(width * 0.2);
				z[20] = Math.floor(height * 0.2);
			}
			if (z[5] > 0) {
				raschx = z[9] + 2 * z[2] + 2 * z[5];
				raschy = z[10] + 2 * z[2] + 2 * z[5];
			} else {
				raschx = z[9] + 2 * z[22] + 2;
				raschy = z[10] + 2 * z[22] + 2;
			}
			raschk = raschx / raschy;
			if (mainw / mainh > raschk) {
				z[21] = Math.floor(1000 * mainw / raschx);
			} else {
				z[21] = Math.floor(1000 * mainh / raschy);
			}
			document.getElementById('bagcont').style.width = mainw + 'px';
			document.getElementById('bagcont').style.height = mainh + 'px';
			document.getElementById('bagcont').style.left = z[19] + 'px';
			document.getElementById('bagcont').style.top = z[20] + 'px';

			document.getElementById('img-custom').style.left = z[19] + mainw / 2 - document.getElementById('img-custom').style.width / 2 + 'px';
			document.getElementById('img-custom').style.top = z[20] - 80 + 'px';
			document.getElementById('img-custom').style.width = mainw / 4 + 'px';
		}

		function changesize(flag) {
			<? if ($z[8] != 0) {
				list($width, $height) = getimagesize($picname); ?>
				imgkof = <?= $height / $width ?>;
				if (flag == 9) {
					z[9] = Number(document.forms["form"]["fwid"].value);
					if (z[9] > 3000) {
						z[9] = 3000;
						document.getElementById("fwid").value = 3000;
					}
					if (z[9] < 50) {
						z[9] = 50;
						document.getElementById("fwid").value = 50;
					}
					z[10] = Math.floor(z[9] * imgkof);
					document.getElementById("fhig").value = Math.floor(z[10]);
				}
				if (flag == 10) {
					z[10] = Number(document.forms["form"]["fhig"].value);
					if (z[10] > 3000) {
						z[10] = 3000;
						document.getElementById("fhig").value = 3000;
					}
					if (z[10] < 50) {
						z[10] = 50;
						document.getElementById("fhig").value = 50;
					}
					z[9] = Math.floor(z[10] / imgkof);
					document.getElementById("fwid").value = Math.floor(z[9]);
				}
			<? } else { ?>
				z[9] = Number(document.forms["form"]["fwid"].value);
				z[10] = Number(document.forms["form"]["fhig"].value);
				if (z[9] > 3000) {
					z[9] = 3000;
					document.getElementById("fwid").value = 3000;
				}
				if (z[9] < 50) {
					z[9] = 50;
					document.getElementById("fwid").value = 50;
				}
				if (z[10] > 3000) {
					z[10] = 3000;
					document.getElementById("fhig").value = 3000;
				}
				if (z[10] < 50) {
					z[10] = 50;
					document.getElementById("fhig").value = 50;
				}
			<? } ?>

			if (z[3]) {
				z[5] = Number(document.forms["form2"]["fpasp"].value);
				if (z[5] > 1000) {
					z[5] = 1000;
					document.getElementById("fpasp").value = 1000;
				}
				if (z[5] < 0) {
					z[5] = 0;
					z[3] = 0;
					z[4] = 0;
					rePage();
				}
			}

			if (z[5] > 0) {
				raschx = z[9] + 2 * z[2] + 2 * z[5];
				raschy = z[10] + 2 * z[2] + 2 * z[5];
			} else {
				raschx = z[9] + 2 * z[22] + 2;
				raschy = z[10] + 2 * z[22] + 2;
			}

			<? if ($z[11] == "0") { ?>
				width = document.body.clientWidth;
				height = document.body.clientHeight;

				maxmainw = width * 0.6;
				maxmainh = height * 0.8;
				z[19] = Math.floor(width * 0.1);
				z[20] = Math.floor(height * 0.1);

				raschk = raschx / raschy;
				if (maxmainw / maxmainh < raschk) {
					z[21] = Math.floor(1000 * maxmainw / raschx);
					z[20] = Math.floor(height * 0.5) - raschy * z[21] / 2000;
				} else {
					z[21] = Math.floor(1000 * maxmainh / raschy);
					z[19] = Math.floor(width * 0.4) - raschx * z[21] / 2000;
				}

			<? } ?>

			mainw = raschx * z[21] / 1000;
			if (z[5] > 0) {
				wi = Math.floor(z[9] * z[21] / 1000);
				hi = Math.floor(z[10] * z[21] / 1000);
				w = Math.floor((z[9] + 2 * z[5]) * z[21] / 1000);
				h = Math.floor((z[10] + 2 * z[5]) * z[21] / 1000);
			} else {
				wi = Math.floor(z[9] * z[21] / 1000);
				hi = Math.floor(z[10] * z[21] / 1000);
				w = Math.floor((z[9] - 2 * z[2] + 2 * z[22] + 2) * z[21] / 1000);
				h = Math.floor((z[10] - 2 * z[2] + 2 * z[22] + 2) * z[21] / 1000);
			}
			wim = Math.floor((w - wi) / 2);
			him = Math.floor((h - hi) / 2);
			t = Math.floor((mainw - w) / 2);
			ht = h + t;
			wt = w + t;
			mainw = wt + t;
			mainh = ht + t;

			ws = (h + 2 * t) / 1.41421;


			bagcont.style.width = mainw + 'px';
			bagcont.style.height = mainh + 'px';
			bagcont.style.left = z[19] + 'px';
			bagcont.style.top = z[20] + 'px';

			let widthImageRope = mainw / 3.5;
			let marginLeft = z[19] + mainw / 2 - widthImageRope / 2

			document.getElementById('img-custom').style.left = marginLeft + 'px';
			document.getElementById('img-custom').style.top = z[20] - widthImageRope / 3 + 'px';
			document.getElementById('img-custom').style.width = mainw / 3.5 + 'px';

			bgtop.style.height = t + 'px';
			bgbot.style.height = t + 'px';
			bgrwrap.style.width = ws + 'px';
			bgrwrap.style.height = ws + 'px';
			bglwrap.style.width = ws + 'px';
			bglwrap.style.height = ws + 'px';
			bgright.style.height = t + 'px';
			bgleft.style.height = t + 'px';

			bgcenter.style.width = wi + 'px';
			bgcenter.style.height = hi + 'px';
			bgcenter.style.top = (him + t) + 'px';
			bgcenter.style.left = (wim + t) + 'px';

			<? if ($z[11] == 0) { ?>
				document.getElementById('sizex').innerHTML = '<span> ' + raschx + ' мм</span>';
				document.getElementById('sizey').innerHTML = '<span> ' + raschy + ' мм</span>';
			<? }; ?>


		}

		function isVisible(elem) {
			var box = elem.getBoundingClientRect();
			var height = document.body.clientHeight;
			var top = box.top;
			var scrollTop = window.pageYOffset;
			var topVisible = top > scrollTop && top < scrollTop + height + height;
			return topVisible;
		}

		function makeImgMas() {
			window.imgs = document.getElementsByClassName('bmenuimg');
			showVisible();
		}

		function scrollingBmenu() {
			clearTimeout(curTimerId);
			var timerId = setTimeout(showVisible, 500);
			curTimerId = timerId;
		}


		function showVisible() {
			for (var i = 0; i < imgs.length; i++) {
				var realsrc = imgs[i].getAttribute('realsrc');
				if (!realsrc) continue;
				if (isVisible(imgs[i])) {
					imgs[i].src = realsrc;
					imgs[i].setAttribute('realsrc', '');
				}
			}
		}

		function rePage(hsh) {
			pageid = z[0];
			for (i = 1; i <= 22; i++) {
				pageid += 'l';
				pageid += Math.floor(z[i]);
			}
			if (hsh) {
				document.location.href = "/baget_online?id=" + pageid + "#" + hsh;
			} else {
				document.location.href = "/baget_online?id=" + pageid;
			}
		}

		function goPage(wat) {
			pageid = z[0];
			for (i = 1; i <= 22; i++) {
				pageid += 'l';
				pageid += Math.floor(z[i]);
			}
			if (wat == "1") {
				document.location.href = "/baget_zakaz?id=" + pageid + "&pomokod=" + $('#promo_kod').val();
			}
			if (wat == "2") {
				document.location.href = "/baget_zakaz_addchek?id=" + pageid;
			}
		}

		function changePage() {
			pageid = z[0];
			for (i = 1; i <= 22; i++) {
				pageid += 'l';
				pageid += Math.floor(z[i]);
			}
			history.pushState(null, null, "/baget_online?id=" + pageid);
			<? if ($z[11] == 0) {
				echo "document.getElementById('fileform2').action = '/upload2.php?id='+pageid;";
			} ?>
			<? if ($z[8] == 0) {
				echo "document.getElementById('fileform').action = '/upload.php?id='+pageid;";
			} ?>
		}

		function bgswitch() {
			document.getElementById("sw6" + cursw6).className = 't2';
			cursw6 = z[6];
			document.getElementById("sw6" + cursw6).className = 't3';
			document.getElementById("sw7" + cursw7).className = 't2';
			cursw7 = z[7]
			document.getElementById("sw7" + cursw7).className = 't3';


			<?
			if ($master) {
			?>
				sw170.className = "t2";
				sw171.className = "t2";
				sw1711.className = "t2";
				sw172.className = "t2";
				sw173.className = "t2";
				sw174.className = "t2";
				sw175.className = "t2";
				sw176.className = "t2";
				sw177.className = "t2";
				sw178.className = "t2";
				sw179.className = "t2";
				sw1781.className = "t2";
				sw1782.className = "t2";
				sw17810.className = "t2";
				sw17811.className = "t2";
				sw17812.className = "t2";
				sw17813.className = "t2";
				sw17814.className = "t2";
				dostavk.style.display = "none";
				zerk.style.display = "none";

				if (z[17] == 7) {
					dostavk.style.display = "inline";
				}

				if (z[17] > 800) {
					zerk.style.display = "";
					var zs = String(z[17]);
					if (zs[0] == 8) {
						sw178.className = "t3";
					} else {
						sw179.className = "t3";
					}
					if (zs[1] == 1) {
						sw1781.className = "t3";
					} else {
						sw1782.className = "t3";
					}
					if (zs[2] == 0) {
						sw17810.className = "t3";
					} else if (zs[2] == 1) {
						sw17811.className = "t3";
					} else if (zs[2] == 2) {
						sw17812.className = "t3";
					} else if (zs[2] == 3) {
						sw17813.className = "t3";
					} else if (zs[2] == 4) {
						sw17814.className = "t3";
					}
				} else {
					document.getElementById("sw17" + z[17]).className = "t3";
				}
			<? } ?>
			countprice();
		}

		function countprice() {
			var s = (z[9] + z[5] + z[5]) * (z[10] + z[5] + z[5]) / 1000000;
			var p = (z[9] + z[10]) * 2;
			price1 = (z[9] + z[2] + z[2] + z[5] + z[5] + z[10] + z[2] + z[2] + z[5] + z[5]) * z[1] / 500;
			price1 = Math.floor(price1);
			price2 = s * z[4];
			if (price2 < 680) {
				price2 = 780;
			}
			if (z[5] < 1) {
				price2 = 0;
			}
			price2 = Math.floor(price2);
			price3 = 0;
			price4 = 0;
			price7 = 0;

			if (z[6] == 1) {
				price3 = s * 2000;
			}
			if (z[6] == 2) {
				price3 = s * 4500;
			}
			if (z[6] == 3) {
				price3 = s * 21250;
			}
			if (z[6] == 4) {
				price3 = s * 2200;
			}
			price3 = Math.floor(price3);

			if (z[7] == 1) {
				price4 = s * 875;
			}
			if (z[7] == 2) {
				price4 = s * 2571;
			}
			if (z[7] == 3) {
				price4 = (z[9] + z[10]) * 0.9;
			}
			if (z[7] == 4) {
				price4 = (z[9] + z[10]) * 1.1;
			}
			price4 = Math.floor(price4);


			if (z[7] != 0) {
				price4 = price4 < 100 ? 100 : price4;
			}

			if (z[6] != 0) {
				price3 = price3 < 100 ? 100 : price3;
			}

			price0 = price1 + price2 + price3 + price4;
			if (price0 < 2280) {
				price6 = 650;
			} else {
				price6 = price0 * 0.25;
			}
			price6 = Math.floor(price6) + 100;
			if (price1 < 1) {
				price6 = 0;
			}
			price0 = price0 + price6;

			if ($('#promo_kod').val() != '') {
				if ($('#promo_kod').data('type') != 'none') {

					if ($('#promo_kod').data('type') == 'procent') {
						price0 = price0 - (price0 * $('#promo_kod').data('procent')) / 100;
					}

					if ($('#promo_kod').data('type') == 'count') {
						price0 = price0 - $('#promo_kod').data('count');
					}
				}
			}

			s = (z[9]) * (z[10]) / 1000000;
			if (z[9] >= 1000 || z[10] >= 1000) {
				if (z[9] > z[10]) {
					lmax = Math.floor(z[9] / 10);
				} else {
					lmax = Math.floor(z[10] / 10);
				}
			} else {
				if (z[9] < z[10]) {
					lmax = Math.floor(z[9] / 10);
				} else {
					lmax = Math.floor(z[10] / 10);
				}
			}

			<?
			if ($master) { ?>
				z[18] = Number(document.forms["form3"]["deliv"].value);
				if (z[18] < 0) {
					z[18] = 0;
					document.getElementById("deliv").value = 0;
				}
				if (z[17] == 1) {
					price7 = s * 1600;
					price0 = price7;
				}
				if (z[17] == 11) {
					price7 = s * 2000;
					price0 = price7;
				}
				if (z[17] == 2) {
					price7 = p * 0.4;
					price0 = price7;
				}
				if (z[17] == 3) {
					price7 = s * 3600;
					price0 = price7;
				}
				if (z[17] == 4) {
					price7 = lmax * 8;
					price0 = price7;
				}
				if (z[17] == 5) {
					price7 = lmax * 13;
					price0 = price7;
				}
				if (z[17] == 6) {
					price7 = s * 400;
					price0 = price7;
				}
				if (z[17] == 7) {
					price7 = 600 + z[18] * 50;
					price0 = price7;
				}
				if (z[17] > 800) {
					var zs = String(z[17]);
					if (zs[0] == 8) {
						if (zs[1] == 1) {
							price7 = 1804 * s;
						} else {
							price7 = 2724 * s;
						}
					} else {
						if (zs[1] == 1) {
							price7 = 4584 * s;
						} else {
							price7 = 6600 * s;
						}
					}

					if (zs[2] == 1) {
						price7 += p * 0.332;
					} else if (zs[2] == 2) {
						price7 += p * 0.400;
					} else if (zs[2] == 3) {
						price7 += p * 0.532;
					} else if (zs[2] == 4) {
						price7 += p * 0.934;
					}
					price0 = price7;
				}
				document.getElementById("price7").innerHTML = Math.floor(price7);
			<? } ?>
			price0 = Math.floor(price0);
			document.getElementById('price1').innerHTML = price1;
			document.getElementById('price2').innerHTML = price2;
			document.getElementById('price3').innerHTML = price3;
			document.getElementById('price4').innerHTML = price4;
			document.getElementById('price6').innerHTML = price6;
			document.getElementById('price0').innerHTML = price0;
			z[13] = price0;
			changePage();
		}

		function setskidka() {
			var sk = skidka.value * 1;
			document.cookie = 'Skid=' + sk;
		}
	</script>
	<?
	if ($master) {
		echo '<style>.baganim {transition: none;}</style>';
	}
	?>

	<meta property="og:image" content="http://bagetnaya-masterskaya.com/img/bagetnaya_masterskaya.jpg">
</HEAD>
<?
if ($z[12] > 0) {
	echo "<BODY style=\"margin:0; position:absolute; width:100%; height:100%;\" onload=\"makeImgMas()\">";
	if ($z[12] == 4) {
		$paspmenu = true;
		$fname = 'base/' . $z[12] . '.txt';
	} else {
		$fname = 'base/' . $z[12] . $z[14] . '.txt';
	}
	echo '<a onclick="z[12]=0; rePage ();" class="bmbg"></a>';
	if ($paspmenu == false) {
		echo '	<div id="baget-type-menu">';
		if ($z[12] == 1) {
			echo '<div class="btm1">Пластиковый</div>';
		} else {
			echo '<div class="btm0" onclick="z[12]=1; rePage (' . $z[0] . ');">Пластиковый</div>';
		}
		if ($z[12] == 2) {
			echo '<div class="btm1">Деревянный</div>';
		} else {
			echo '<div class="btm0" onclick="z[12]=2; rePage (' . $z[0] . ');">Деревянный</div>';
		}
		if ($z[12] == 3) {
			echo '<div class="btm1">Алюминиевый</div>';
		} else {
			echo '<div class="btm0" onclick="z[12]=3; rePage (' . $z[0] . ');">Алюминиевый</div>';
		}
		echo '</div>';


		echo '<div id="bmenu-sort">';
		if ($z[14] == 1) {
			echo '		<a onclick="z[14]=2; rePage ();" class="sort1">Артикул</a>
									<a onclick="z[14]=3; rePage ();">Цена</a>
									<a onclick="z[14]=5; rePage ();">Размер</a>';
		} elseif ($z[14] == 2) {
			echo '	<a onclick="z[14]=1; rePage ();" class="sort2">Артикул</a>
									<a onclick="z[14]=3; rePage ();">Цена</a>
									<a onclick="z[14]=5; rePage ();">Размер</a>';
		} elseif ($z[14] == 3) {
			echo '	<a onclick="z[14]=1; rePage ();">Артикул</a>
									<a onclick="z[14]=4; rePage ();" class="sort1">Цена</a>
									<a onclick="z[14]=5; rePage ();">Размер</a>';
		} elseif ($z[14] == 4) {
			echo '	<a onclick="z[14]=1; rePage ();">Артикул</a>
									<a onclick="z[14]=3; rePage ();" class="sort2">Цена</a>
									<a onclick="z[14]=5; rePage ();">Размер</a>';
		} elseif ($z[14] == 5) {
			echo '	<a onclick="z[14]=1; rePage ();">Артикул</a>
									<a onclick="z[14]=3; rePage ();">Цена</a>
									<a onclick="z[14]=6; rePage ();" class="sort1">Размер</a>';
		} elseif ($z[14] == 6) {
			echo '	<a onclick="z[14]=1; rePage ();">Артикул</a>
									<a onclick="z[14]=3; rePage ();">Цена</a>
									<a onclick="z[14]=5; rePage ();" class="sort2">Размер</a>';
		}
		echo '</div>';
	} else {
		echo '<div id="paspartu-anounce"><strong>Обратите внимание</strong><br>Оттенок изображения паспарту на вашем мониторе может немного отличаться от действительного</div>';
	}

	echo '<div id="bmenu" onscroll="scrollingBmenu()">';


	$fa = file($fname);
	$cou = count($fa);
	for ($i = 0; $i < $cou; $i++) {
		$str = explode("\t", $fa[$i]);
		if ($paspmenu) {
			echo '	<a onclick="z[12]=0; z[3]=' . $str[0] . '; z[4]=' . $str[3] . '; rePage ();" name="' . $str[0] . '">
						<div><img src="/pi/' . $str[0] . '.jpg" align="left" class="bmenuimg"></div>';
			if ($master || $minimaster) {
				echo '<b>Арт. ' . $str[1] . '</b><br>';
			}
			echo 'Арт. ' . $str[0] . '<br>Цвет: ' . $str[2] . '<br><span style="font-size:125%;">' . $str[3] . '</span>р.</a>';
		} else {

			if ($str[4] < 1) {
				continue;
			}
			if ($str[5] < 3) {
				continue;
			}
			$nalichie = '<div class="nalich1">огранич. кол-во</div> ';
			if ($str[5] > 30) {
				$nalichie = '<div class="nalich2">есть в наличии</div> ';
			}

			echo '	<a onclick="z[12]=0; z[0]=' . $str[0] . '; z[1]=' . $str[4] . '; z[2]=' . $str[2] . '; z[22]=' . $str[3] . '; rePage ();" name="' . $str[0] . '" >
						<div><img src="/img/loading.gif" realsrc="/bi/' . $str[0] . '.jpg" align="left" class="bmenuimg"></div>';
			if ($master || $minimaster) {
				echo '<b>Арт. ' . $str[1] . '</b><br>';
			}
			echo 'Арт. ' . $str[0] . '<br>Ширина: ' . $str[2] . ' мм<br>Без четверти: ' . $str[3] . ' мм<br><span style="font-size:125%;">' . $str[4] . '</span>р.<br>' . $nalichie . '</a>';
		}
	}
	echo ' 	</div>';

	echo '
			<div onclick="z[12]=0; rePage ();" class="bmenuclose"></div>
			<div id="site" style="overflow:hidden; height:100%;"></div></body></HTML>';
} else {

	echo "<BODY style=\"margin:0; position:absolute; width:100%; height:100%;\" onresize=\"changesize ();\" onload=\"bgswitch();";
	if ($z[21] == "0") {
		echo "transformain();";
	}
	if ($z[11] == "0") {
		echo "changesize ();\" >";
	} else {
		echo "changesize ();\" onmousemove =\"mousemove(event)\" onmousedown=\"mousemove(event)\" onmouseup=\"mousemove(event)\" onselectstart=\"return false;\">
		<div style=\"position:absolute; width:80%; height:96%; margin:1% 0 0 2%; padding:0; background:url('pics/" . $z[11] . ".jpg')no-repeat center; background-size:contain;\">
		</div>";
	} ?>

	<? echo '<div id="site"><a rel="nofollow" href="/" id="logobaget" title="На главную" class="baganim">На сайт</a>';


	echo '<table width="250px" height="100%" cellpadding="0" cellspacing="0" style="position:absolute; right:20%; margin:20px -190px 20px 0px; z-index: 50;"><tr><td style="vertical-align:middle;"><div id="bagsidemenu">'; ?>
	<? if ($master || $minimaster) { ?>

		<span class="addbaget" style="color:#339; font-weight:700;text-align: left;margin: 10px 15px 0;display: block; cursor:pointer;">Добавление нового багета</span>

		<div class="form">
			<div class="formsection">
				Тип багета:<br>
				<select id="bagettype" name="bagettype">
					<option value="plast">Пластик</option>
					<option value="wood">Дерево</option>
					<option value="alum">Аллюминий</option>
				</select>
			</div>
			<div>
				Артикул поставщика<br>
				<input type="text" name="vendor" value="<?= $_COOKIE['vendor'] ?>">
			</div>
			<div class="formsection">
				<b>Картинка для рамы</b><br>

				<? if (!isset($_COOKIE['catalogfile']) || $_COOKIE['catalogfile'] == '' || $_COOKIE['calcfile'] == '') { ?>
					<input type="file" name="catalogfile" accept=".jpg, .jpeg, .png, .JPG">
				<? } else { ?>
					<b style="color: green">Файл выбран</b><br>
					Заменить: <input type="file" name="catalogfile" accept=".jpg, .jpeg, .png, .JPG" style="width: 47%;">
				<? } ?>
			</div>

			<div class="formsection">
				<b>Картинка для каталога</b><br>
				<? if (!isset($_COOKIE['calcfile']) || $_COOKIE['catalogfile'] == '' || $_COOKIE['calcfile'] == '') { ?>
					<input type="file" name="calcfile" accept=".jpg, .jpeg, .png, .JPG">
				<? } else { ?>
					<b style="color: green">Файл выбран</b><br>
					Заменить: <input type="file" name="calcfile" accept=".jpg, .jpeg, .png, .JPG" style="width: 47%;">
				<? } ?>
			</div>

			<div class="formsection" style="clear: both;">
				<div style=" position:relative; float:left; margin-bottom:10px;  width: calc(30% - 3px);margin-right: 7px;">
					Ширина<br>
					<input type="text" name="width" value="<?= $_COOKIE['width'] ?>">
				</div>

				<div style=" position:relative; float:left; margin-bottom:10px;width: calc(30% - 3px);margin-right: 7px;">
					Без четв.
					<input type="text" name="widthwithout" value="<?= $_COOKIE['widthwithout'] ?>">
				</div>
				<div style=" position:relative; float:left; margin-bottom:10px;width: calc(31%);">
					Цена закуп.
					<input type="text" name="pricenew" value="<?= $_COOKIE['pricenew'] ?>">
				</div>
			</div>
			<span class="upload_files">Примерить</span>
			<span class="addnewbaget" onclick="addnewbaget();">Добавить</span>
			<span class="reset" onclick="reset();">Сброс</span>
		</div>
		<div class="newbgt" style="display: none;">
			<div class="maskimg"><img src="/<?= $_COOKIE['calcfile'] ?>" align="left" class="bmenuimg"></div><b class="vendor">Арт. <span class="vendor"><?= $_COOKIE['vendor'] ?></span></b><br>Ширина: <span class="width"><?= $_COOKIE['width'] ?></span> мм<br>Без четверти: <span class="widthwithout"><?= $_COOKIE['widthwithout'] ?></span> мм<br><span class="pricenew" style="font-size:125%;"><?= $_COOKIE['pricenew'] ?></span>р.<br>
			<div class="nalich2">есть в наличии</div>
		</div>
	<? } ?>
	<?

	echo '	<form id="form" name="form" onsubmit="return false;">
			<hr>
			<span style="color:#339; font-weight:700;">Укажите размеры изображения:</span><br>
			<div style="width:50%; position:relative; float:left; margin-bottom:10px;">
				Ширина (мм)<br>
				<input type="text" id="fwid" name="fwid" onchange="changesize(9);countprice ();" value="' . $z[9] . '" autocomplete="off"><br>
				<input type="submit" value="Применить">
			</div>
			<div style="width:50%; position:relative; float:left; margin-bottom:10px;">
				Высота (мм)<br>
				<input type="text" id="fhig" name="fhig" onchange="changesize(10);countprice ();" value="' . $z[10] . '" autocomplete="off"><br>
				<input type="submit" value="Применить">
			</div>
		</form>';
	if ($z[8] != 0) {
		list($width, $height) = getimagesize($picname);
		echo '	<strong>Обратите внимание</strong><br>Размер изображения ' . $width . ' на ' . $height . ' точек, соотношение сторон картины зафиксировано соответственно. <br>Печать изображения не входит в стоимость заказа<br><a onclick="z[8]=0; rePage ();" class="t2">Убрать изображение картины</a>';
	} else {
		echo '	<form id="fileform" action="/upload.php?id=' . implode("l", $z) . '" method="post" enctype="multipart/form-data">
				<label>
					<input type="file" name="filename" onchange="javascript:this.form.submit();" style="display:none;">
					<div>Примерить картину к багету<br><span>нажмите чтобы загрузить ваше изображение или фотографию</span></div>
				</label>
			</form>';
	}
	?>
	<hr>
	<span style="color:#339; font-weight:700;">Выберите багет и паспарту:</span><br>
	<div style="width:50%; position:relative; float:left;">Багет: <b id="price1">0</b> р.<br>
		<span class="bmenu-type" onclick="getcatalog('plast');">Пластик</span>
		<span class="bmenu-type" onclick="getcatalog('wood');">Дерево</span>
		<span class="bmenu-type" onclick="getcatalog('alum');">Алюминий</span>

		<div class="pasp-block" id="blockarticul" style="display: none">
			<span style="color:black; font-weight:500;">Выбранный артикул:</span><br>
			<span id="articul" style=" font-weight:600; font-weight: bold;"></span>
		</div>

	</div>
	<div style="width:50%; position:relative; float:left; ">Паспарту: <b id="price2">0</b> р.<br>



		<a href="#" class="bmenu-type choice-pasp" onclick="getcatalog('pasp');">Выбрать</a><br><br>

		<div class="pasp-block" id="blockarticul2" <? if ($z[3] <> 0) { ?>style="display:block;" <? } ?>>
			<span style="color:black; font-weight:500;">Выбранный артикул:</span><br>
			<span id="articul2" style=" font-weight:600; font-weight: bold;">
				<? if ($z[3] <> 0) {
					echo ($z[3]);
				} ?></span>
		</div>
		<div class="pasp-block" <? if ($z[3] <> 0) { ?>style="display:block;" <? } ?>>
			<a onclick="z[3]=0; z[4]=0; z[5]=0; changesize(); countprice ();" class="t2 close-pasp-block">Убрать</a><br>Размер (мм)<br>
			<form id="form2" name="form2" onsubmit="return false;">
				<input type="text" id="fpasp" name="fpasp" onchange="changesize(); countprice ();" value="<?= $z[5] ?>" autocomplete="off"><br>
				<input type="submit" value="Применить">
			</form>
		</div>


		<?
		echo '		</div>
			<hr>
			<span style="color:#339; font-weight:700;">Выберите стекло и задник:</span><br>
			<div style="width:50%; position:relative; float:left;">Стекло: <b id="price3">0</b> р.<br>
				<a id="sw60" class="t3" onclick="z[6]=0; bgswitch();">Нет</a><br>
				<a id="sw61" class="t2" onclick="z[6]=1; bgswitch();">Обычное</a><br>
				<a id="sw62" class="t2" onclick="z[6]=2; bgswitch();">Матовое</a><br>
				<a id="sw63" class="t2" onclick="z[6]=3; bgswitch();">Антиблик</a><br>
				<a id="sw64" class="t2" onclick="z[6]=4; bgswitch();">Пластиковое</a><br>
			</div>
			<div style="width:50%; position:relative; float:left; ">Задник: <b id="price4">0</b> р.<br>
				<a id="sw70" class="t3" onclick="z[7]=0; bgswitch();">Нет</a><br>
				<a id="sw71" class="t2" onclick="z[7]=1; bgswitch();">Картон</a><br>
				<a id="sw72" class="t2" onclick="z[7]=2; bgswitch();">Пенокартон 5мм</a><br>
				<a id="sw73" class="t2" onclick="z[7]=3; bgswitch();">Натяжка вышивки</a><br>
				<a id="sw74" class="t2" onclick="z[7]=4; bgswitch();">Подрамник</a><br>
			</div>';

		if ($master) {
			echo '	<hr>
			<div style="width:250px; position:relative; float:left;">Отдельные услуги: <b id="price7">0</b> р.<br>
				<a id="sw170" class="t2" onclick="z[17]=0; bgswitch()">Нет</a><br>
				<a id="sw171" class="t2" onclick="z[17]=1; bgswitch()">П/К 5мм</a> |
				<a id="sw1711" class="t2" onclick="z[17]=11; bgswitch()">П/К 10мм</a> |
				<a id="sw172" class="t2" onclick="z[17]=2; bgswitch()">Натяжка</a><br>
				<a id="sw173" class="t2" onclick="z[17]=3; bgswitch()">Холст</a> |
				<a id="sw174" class="t2" onclick="z[17]=4; bgswitch()">Матовая</a> |
				<a id="sw175" class="t2" onclick="z[17]=5; bgswitch()">Глянец</a> |
				<a id="sw176" class="t2" onclick="z[17]=6; bgswitch()">Лак</a><br>
				<a id="sw178" class="t2" onclick="z[17]=810; bgswitch()">Обычное зеркало</a> |
				<a id="sw179" class="t2" onclick="z[17]=910; bgswitch()">Clear Vision</a><br>
				<span id="zerk" style="display:none;">
					<a id="sw1781" class="t2" onclick="var zs=String(z[17]); z[17]=zs.charAt(0)+1+zs.charAt(2); bgswitch()">4мм</a> |
					<a id="sw1782" class="t2" onclick="var zs=String(z[17]); z[17]=zs.charAt(0)+2+zs.charAt(2); bgswitch()">6мм</a> ||
					<a id="sw17810" class="t2" onclick="var zs=String(z[17]); z[17]=zs.charAt(0)+zs.charAt(1)+0; bgswitch()">нет</a> |
					<a id="sw17811" class="t2" onclick="var zs=String(z[17]); z[17]=zs.charAt(0)+zs.charAt(1)+1; bgswitch()">10</a> |
					<a id="sw17812" class="t2" onclick="var zs=String(z[17]); z[17]=zs.charAt(0)+zs.charAt(1)+2; bgswitch()">20</a> |
					<a id="sw17813" class="t2" onclick="var zs=String(z[17]); z[17]=zs.charAt(0)+zs.charAt(1)+3; bgswitch()">30</a> |
					<a id="sw17814" class="t2" onclick="var zs=String(z[17]); z[17]=zs.charAt(0)+zs.charAt(1)+4; bgswitch()">40</a><br>
				</span>

				<a id="sw177" class="t2" onclick="z[17]=7; bgswitch()">Доставка</a>
				<form id="form3" name="form3" onsubmit="return false;">
					<div id="dostavk" style="display:none;">
						<input type="text" id="deliv" name="deliv" onchange="countprice();" value="' . $z[18] . '" style="height:20px; width:50px;" autocomplete="off">км.
					</div>
				</form>
			</div>';
		}

		echo '		<hr>Сборка рамы: <b id="price6">0</b> р.<br>
			<hr>
				Промокод: <input id="promo_kod" type="text" class="form-control form-control-lg" placeholder="Промокод" data-type="none" data-count="none" data-procent="none"/>
				<button id="get-info-promo-kods">Применить</button><br>
				<span id="info-promokod"></span>
			<hr>
			Цена:<br><span style="font-size:200%;"><span id="price0">0</span> р</span><br>
			<hr>';


		if ($z[11] != 0) {
			echo '	<a onclick="z[11]=0; rePage ();" class="t2">Убрать изображение интерьера</a>';
		} else {
			echo '	<form id="fileform2" action="/upload2.php?id=' . implode("l", $z) . '" method="post" enctype="multipart/form-data">
				<label>
					<input type="file" name="filename" onchange="javascript:this.form.submit();" style="display:none;">
					<div>Примерить багет к интерьеру<br><span>нажмите чтобы загрузить фотографию вашего интерьера</span></div>
				</label>
			</form>';
		}

		echo '<br><a onclick="goPage(1)" class="bagzak" >Оформить заказ</a>';
		echo '</div></td></tr></table>';

		?>

		<style>
			.img-custom {
				position: absolute;
				left: 32%;
			}

			.test-custom {
				position: relative;
				/* добавили */
				background: black;
			}
		</style>

		<img src="/img/2.png" alt="" style='
			width:20%;
		' class='img-custom' id='img-custom'>

		<div id='bagcont' class='baganim'>
			<?
			$stmt = $dbh->prepare("SELECT listimg FROM catalog_baget WHERE publicvendor=?");
			$stmt->bindParam(1, $z[3]);
			$stmt->execute();
			$data = $stmt->fetchAll();
			?>
			<div id='bgpass' class='baganim' style="background: url('pi/<?= $data[0]['listimg'] ?>');"></div>
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
			<? if (isset($_COOKIE['catalogfile'])  && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $_COOKIE['catalogfile'])) { ?>
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
		"></div>
			</div>
			<div id='bglwrap' class='baganim'>
				<div id='bgleft' class='baganim' style="
		<? if (isset($_COOKIE['catalogfile'])  && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $_COOKIE['catalogfile'])) { ?>
			background:url('/<?= $_COOKIE['catalogfile'] ?>') repeat-x;
		<? } else { ?>
		background:url('/bi/<?= $z[0] ?>t.jpg') repeat-x;
		<? } ?>
		"></div>
			</div>
		<?
		if ($z[11] != 0) {
			echo "<div id=\"resizec\"></div><div id=\"resizerb\"></div><div id=\"resizelt\"></div><div id=\"resizelb\"></div><div id=\"resizert\"></div></div>
		";
		} else {
			echo "
			<div class='baganim' id='sizey'></div>
			<div class='baganim' id='sizex'></div>
		</div>
		";
		}
	}

		?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<script src="/js/jquery.cookie.js"></script>

		<script type="text/javascript">
			function deleteCookie(name) {
				document.cookie = name + "=''; max-age=0";
			}

			function delAllCookie() {
				deleteCookie('bagettype');
				deleteCookie('vendor');
				deleteCookie('pricenew');
				deleteCookie('widthwithout');
				deleteCookie('width');
				deleteCookie('catalogfile');
				deleteCookie('calcfile');
			}

			let reset = function() {
				deleteCookie('bagettype');
				deleteCookie('vendor');
				deleteCookie('pricenew');
				deleteCookie('widthwithout');
				deleteCookie('width');
				deleteCookie('catalogfile');
				deleteCookie('calcfile');
				rePage();
			};

			(function($) {

				$('#bagettype').val('<?= $_COOKIE["bagettype"] ?>');

				$('.addbaget').click(function() {
					$('.form').toggle(300);
					// $('.newbgt').slideDown(300);
					if ($(".newbgt").is(":hidden")) {
						$(".newbgt").slideDown(300);
					} else {
						$(".newbgt").slideUp();
					}
				})

				var files; // переменная. будет содержать данные файлов
				var calcfile;
				// заполняем переменную данными файлов, при изменении значения file поля
				$('input[name="catalogfile"]').on('change', function() {
					files = this.files;
				});
				$('input[name="calcfile"]').on('change', function() {
					calcfile = this.files;
				});

				// обработка и отправка AJAX запроса при клике на кнопку upload_files
				$('.upload_files').on('click', function(event) {
					event.stopPropagation(); // остановка всех текущих JS событий
					event.preventDefault(); // остановка дефолтного события для текущего элемента - клик для <a> тега

					var bagettype = $('select[name="bagettype"]').val();
					var vendor = $('input[name="vendor"]').val();
					var pricenew = $('input[name="pricenew"]').val();
					var widthwithout = $('input[name="widthwithout"]').val();
					var width = $('input[name="width"]').val();
					if (vendor == "") {
						alert("Артикул не заполнен");
						return;
					} else {
						$('.vendor').html(vendor);
					}
					if (pricenew == "") {
						alert("Цена не заполнена");
						return;
					} else {
						$('.pricenew').html(pricenew);
					}
					if (widthwithout == "") {
						alert("Ширина без четверти не заполнена");
						return;
					} else {
						$('.widthwithout').html(widthwithout);
					}
					if (width == "") {
						alert("Ширина не заполнена");
						return;
					} else {
						$('.width').html(width);
					}
					document.cookie = "bagettype=" + bagettype;
					document.cookie = "vendor=" + vendor;
					document.cookie = "pricenew=" + pricenew;
					document.cookie = "widthwithout=" + widthwithout;
					document.cookie = "width=" + width;
					// создадим данные файлов в подходящем для отправки формате
					var data = new FormData();

					$.each(files, function(key, value) {
						data.append('first', value);
					});
					$.each(calcfile, function(key, value) {
						data.append('second', value);
					});
					// добавим переменную идентификатор запроса
					data.append('my_file_upload', 1);

					// AJAX запрос
					$.ajax({
						url: '/base/submit.php',
						type: 'POST',
						data: data,
						cache: false,
						dataType: 'json',
						// отключаем обработку передаваемых данных, пусть передаются как есть
						processData: false,
						// отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
						contentType: false,
						// функция успешного ответа сервера
						success: function(respond, status, jqXHR) {
							if (typeof respond.error === 'undefined') {
								var files_path = respond.files;
								var html = '';
								z[2] = $('input[name="width"]').val();
								z[22] = $('input[name="widthwithout"]').val();
								$.each(files_path, function(key, val) {
									html += val;
								})
								console.log(respond.calcfile);

								// $('.ajax-reply').html( html );
								if (typeof(respond.calcfile) != "undefined" && respond.calcfile !== null && typeof(respond.catalogfile) != "undefined" && respond.catalogfile !== null && typeof(respond.catalogfile) != "" && respond.calcfile !== "") {
									document.cookie = "calcfile=" + respond.calcfile;
									document.cookie = "catalogfile=" + respond.catalogfile;
									$('#bgright').css('background-image', 'url(/' + respond.catalogfile + ')');
									$('#bgbot').css('background-image', 'url(/' + respond.catalogfile + ')');
									$('#bgleft').css('background-image', 'url(/' + respond.catalogfile + ')');
									$('#bgtop').css('background-image', 'url(/' + respond.catalogfile + ')');
									changesize();
									rePage();
								} else {
									alert('Если хотелось поменять картинку, то надо выбрать оба файла. Если поменялись любые другие параметры, например, размер или цена, то все ок!');
									changesize();
									rePage();
									return;
								}

								$('.newbgt .bmenuimg').attr('src', respond.calcfile);
							} else {
								console.log('ОШИБКА рамки: ' + respond.error);
							}

						},
						// функция ошибки ответа сервера
						error: function(jqXHR, status, errorThrown) {
							console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
						}

					});

				});

				$('.choice-pasp').click(function() {
					$('.pasp-block').slideDown(300);
				})

				$('.close-pasp-block').click(function() {
					$('.pasp-block').slideUp(300);
				})

			})(jQuery)

			let getitem = function(id) {
				var idgetitem = id;

				$.ajax({
					url: "/base/idgetitem.php",
					type: "post",
					data: {
						id: idgetitem,
					},
					dataType: "text",
					success: function(data) {
						item = JSON.parse(data);
						console.log(item);
						if (item[0].type == "pasp") {
							$('#bgpass').css('background-image', 'url(/pi/' + item[0].imgconst + ')');
							$('#articul2').text(idgetitem);
							$('#blockarticul2').css("display", "block");

						} else {
							$('#bgright').css('background-image', 'url(/bi/' + item[0].imgconst + ')');
							$('#bgbot').css('background-image', 'url(/bi/' + item[0].imgconst + ')');
							$('#bgleft').css('background-image', 'url(/bi/' + item[0].imgconst + ')');
							$('#bgtop').css('background-image', 'url(/bi/' + item[0].imgconst + ')');
							$('#articul').text(idgetitem);
							$('#blockarticul').css("display", "block");
						}
						changesize();
						$('#bmenu').fadeOut();
						$('.layer').fadeOut();
						$('body').removeClass('fixwindow');




					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);

						alert('ошибка загрузки багета');

					}
				});



			}

			let closeme = function() {
				$('.layer').fadeOut(500);
				$('#bmenu').fadeOut(500);
				$('body').removeClass('fixwindow');
			}

			let getcatalog = function(type) {
				selectedType = $('#sorter-catalog').attr("data-type");

				if (type != selectedType) {
					$('.baget-conteiner').html("")
					downloadCatalog(type);
				} else {
					$('.layer').fadeIn(500);
					$('#bmenu').fadeIn(500);
				}
			}

			function downloadCatalog(type) {
				if (typeof(type) != "undefined" && type !== null) {
					var type = type;
				} else {
					var type = $('#sorter-catalog').attr('data-type');
				}
				var sorter = $('#sorter-catalog').val();

				$('.layer').fadeIn(500);
				$('#bmenu').fadeIn(500);
				$('#sorter-catalog').attr("data-type", type);
				$.ajax({
					url: "/base/getcatalog.php",
					type: "post",
					data: {
						type: type,
						sorter: sorter,
					},
					dataType: "text",
					success: function(data) {

						$('.baget-conteiner').html(data);

						$('body').addClass('fixwindow');
						makeImgMas();


					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);

						alert('ошибка добавления =(');

					}
				});
			}

			let addnewbaget = function() {
				var bagettype = $('select[name="bagettype"]').val();
				var vendor = $('input[name="vendor"]').val();
				var pricenew = $('input[name="pricenew"]').val();
				var widthwithout = $('input[name="widthwithout"]').val();
				var width = $('input[name="width"]').val();
				$.ajax({
					url: "/base/addnewbaget.php",
					type: "post",
					data: {
						type: bagettype,
						vendor: vendor,
						price: pricenew,
						widthwithout: widthwithout,
						width: width,
						imgconst: "<?= $_COOKIE['catalogfile']; ?>",
						listimg: "<?= $_COOKIE['calcfile']; ?>",
					},
					dataType: "text",
					success: function(data) {
						delAllCookie();
						alert('Добавлено');
						rePage();


					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);

						alert('ошибка добавления =(');

					}
				});
			}

			let deleteBaget = function(rmid) {
				var rmid = rmid;
				$.ajax({
					url: "/base/delete-baget.php",
					type: "post",
					data: {
						rmid: rmid,
					},
					dataType: "text",
					success: function(data) {
						var blockrm = 'del' + data;
						// $(blockrm).fadeOut(1000);
						alert('Удалено');
						rePage();


					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus);

						alert('ошибка удаления =(');

					}
				});
			}

			/*$(document).on('change', '#promo_kod', function(){
				countprice();
			})	*/

			$(document).on('click', '#get-info-promo-kods', function() {
				$.ajax({
					url: '/admin/request/getInfoPromoKodForCatalog.php',
					method: 'post',
					dataType: "json",
					data: {
						kod: $('#promo_kod').val()
					},
					success: function(data) {
						if (data == false) {
							$('#info-promokod').text('* Промокод не найден ')
							$('#promo_kod').data('type', 'none')
						} else {
							if (data['sale_procent'] != null && data['sale_procent'] != '') {
								$('#promo_kod').data('type', 'procent')
								$('#promo_kod').data('procent', data['sale_procent'])
								$('#info-promokod').text('* Скидка: ' + data['sale_procent'] + '%')
							}

							if (data['sale_count'] != null && data['sale_count'] != '') {
								$('#promo_kod').data('type', 'count')
								$('#promo_kod').data('count', data['sale_count'])
								$('#info-promokod').text('* Скидка: ' + data['sale_count'] + ' р.')
							}
						}

						countprice();
					},
					error: function(jqXHR, exception) {
						if (jqXHR.status === 0) {
							alert('Not connect. Verify Network.');
						} else if (jqXHR.status == 404) {
							alert('Requested page not found (404).');
						} else if (jqXHR.status == 500) {
							alert('Internal Server Error (500).');
						} else if (exception === 'parsererror') {
							alert('Requested JSON parse failed.');
						} else if (exception === 'timeout') {
							alert('Time out error.');
						} else if (exception === 'abort') {
							alert('Ajax request aborted.');
						} else {
							alert('Uncaught Error. ' + jqXHR.responseText);
						}
					}
				});

			})
		</script>


		<!-- Yandex.Metrika counter -->
		<script type="text/javascript">
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
		</script>
		<noscript>
			<div><img src="https://mc.yandex.ru/watch/60934651" style="position:absolute; left:-9999px;" alt="" /></div>
		</noscript>
		<!-- /Yandex.Metrika counter -->

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

		<style type="text/css">
			.bmenu-type {
				cursor: pointer;
				text-decoration: underline;
				color: #0000cc;
			}

			.bmenu-type:hover {
				text-decoration: none;
			}

			#bmenu {
				z-index: 100;
			}

			.layer {
				display: none;
				width: 100%;
				height: 100%;
				position: fixed;
				top: 0;
				left: 0;
				z-index: 90;
				background: #000;
				opacity: .7;
			}

			.fixwindow {
				overflow: hidden;
			}

			.form {
				display: none;
			}

			.bmenuimg {
				width: auto !important;
			}

			div.maskimg {
				width: 150px;
				overflow: hidden;
			}
		</style>

		</body>

</HTML>