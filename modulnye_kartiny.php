<?php
$fa = file('base/modulki.txt', FILE_IGNORE_NEW_LINES);
if (($_GET['id'] > 0) && ($_GET['id'] <= count($fa))) {
	$b = explode(';', $fa[$_GET['id'] - 1]);
	$mod = true;
} else {
	$mod = false;
}

$keyw = "модульные картины, купить модульные картины, магазин модульных картин, модульные картины интернет, модульные картины интернет магазин ";
$titl = "Магазин модульных картин на заказ";
$desc = "Ищете где купить модульные картины? Конечно в Багетной мастерской №1. Наш выбор модульных картин и производство на заказ помогут урасить Ваш итерьер.";
include "header.php";

if ($mod) {
	echo "

	<div id='crops'><a href='/''>Главная</a> » <a href='/modulnye_kartiny/'>Модульные картины</a> » Картина " . $b[1] . "</div>
	<h1>Картина " . $b[1] . " <span id='h1art'>(арт. " . $b[0] . ")</span>'</h1>
    <div id='main'>";

	$t1 = explode('|', $b[2]);
	$t2 = explode('|', $b[3]);
	$t3 = explode('|', $b[4]);
	echo "<img src=\"/modcatma/" . $b[0] . ".jpg\" class='picCard'><br>
		<table id='mtab'>
			<tr><td>Выберите размер:</td><td rowspan='4' id='mprice'>" . $t1[0] . "<span> р.</span></td><td rowspan='4'><a onclick=\"switchZakaz()\" id='mbuy'>Купить</a></td></tr>
			<tr><td><label><input type='radio' name='size' checked onchange='chprice(0);'>" . $t1[1] . " мм.</a></label></td></tr>
			<tr><td><label><input type='radio' name='size' onchange='chprice(1);'>" . $t2[1] . " мм.</a></label></td></tr>
			<tr><td><label><input type='radio' name='size' onchange='chprice(2);'>" . $t3[1] . " мм.</a></label></td></tr>
		</table>
		<div id='quickZakaz' class='blockHide'>
			<h5>Быстрый заказ</h5>
			<div class='closeButton' onclick='switchZakaz()''></div>
			<form>
				Контакное лицо:<textarea id='zakName' required onchange='areaChange(this);'></textarea><br>
				Телефон или E-mail:<textarea id='zakKont' required onchange='areaChange(this);'></textarea><br>
				Комментарий:<textarea id='zakKomm'></textarea><br>
				<div class='modButton'onclick='sendZakaz()''>Отправить</div>
			</form>
			<div id='zakSendInfo'></div>
		</div>
		<p>Если ни один из размеров Вам не подходит, наш менеджер рассчитает заказ в соответствии с вашими личными пожеланиями. Звоните!</p>
		<p>В стоимость картины входит:</p>
		<ul>
			<li>доработка изображения дизайнером по вашим личным параметрам;</li>
			<li>подрамник из сухой древесины;</li>
			<li>печать экологически чистыми пигментными красками;</li>
			<li>галерейная натяжка холста (без белых торцов);</li>
			<li>покрытие защитным лаком;</li>
			<li>комплект креплений;</li>
			<li>надежная упаковка и оперативная доставка в пределах МКАД;</li>
		</ul>
		<p>КАРТИНА ПОЛНОСТЬЮ ГОТОВА - ОСТАЕТСЯ ТОЛЬКО ПОВЕСИТЬ ЕЕ НА СТЕНУ!</p>
		<p>Мы создаем коллажи и модульные картины из Ваших фотографий!</p>
		<p><b>Наши модульные картины – это качество от Багетной Мастерской №1</b></p>
	</div>
    <div id='side'>
        <h3>Смотрите также</h3>
        <a href='/modulnye_kartiny/katalog_modulnyh_kartin/'' class='fast1' style='background:#a21213;'>Посмотреть каталог</a>
        <a href='/modulnye_kartiny/diptih_kartiny.html' class='fast1'>Диптих картины</a>
        <a href='/modulnye_kartiny/triptih_kartiny.html' class='fast1'>Триптих картины</a>
        <a href='/modulnye_kartiny/poliptih_kartiny.html' class='fast1'>Полиптих картины</a>
	";
} else {
	echo "
		<div id='crop'><a href='/''>Главная</a> » Модульные картины</div>
		<h1>Модульные картины от Багетной Мастерской №1</h1>
	    <div id='main'>";
	for ($i = count($fa) - 1; $i > -1; $i--) {
		$b = explode(';', $fa[$i]);
		$t1 = explode('|', $b[2]);
		echo "<a href=\"/modulnye_kartiny/?id=" . ($i + 1) . "\" class=\"catCard\">
							<div style=\"background:url('/modcatmi/" . $b[0] . ".jpg')no-repeat center;\"></div>
							<br>" . $b[1] . "<br>Цена: от <b>" . $t1[0] . "</b> р.</a>";
	}
	echo "

<p>Любая хорошая картина всегда являлась достойным украшением интерьера гостиной, спальни или даже кухни. Традиционные цельные картины на холстах украшали будуары много веков, а некоторое время назад на рынке появились также картины модульные (ещё их называют сегментированными), которые являются не цельными произведениями, а разделенными на части (модули), объединённые общей темой. Таких модулей может быть и два, и три, и более. Модули могут быть и одинакового размера, и различного. Они могут располагаться горизонтально и вертикально, лесенкой или панорамой.</p>
<h2>Вы можете заказать модульные картины со своим дизайном или де купить из уже имеющихся у нас в наличии.</h2>
<p>В модульной картине исконные традиции смешиваются с современными технологиями. Такое изделие не имеет рамы, а холст может быть как натуральным, так и искусственным. Изображения на натуральном холсте обычно более красочные и выразительные, поэтому рукописные картины на таком материале стоят значительно дороже. Однако всегда можно сделать репродукцию, обратившись в багетную мастерскую. Для Вас мы можем профессионально сегментировать желаемое изображение и качественно выполнить работы по натяжке холста на подрамник с плавным переходом изображения из одного в другое.</p>
<p>Если вы намерены купить моlульные картины для своего дома или офиса, смело обращайтесь в Багетную Мастерскую №1. Ее специалисты изготавливают всевозможные модульные картины, которые, наверняка, смогут подчеркнуть красоту вашего интерьера.</p>
<h2>Как подобрать модельную картину для своего интерьера?</h2>
Сегментированную картину можно повесить и в гостиной, и в спальной комнате, и на кухне. Для спальни уместной будет картина, где изображён какой-нибудь пейзаж или даже лирический портрет, а для кухни подойдёт изделие, на холсте которого красуются сочные фрукты, свежевыпеченный хлеб, кофейные зёрна или какие-либо овощи. Кроме картин, нарисованных масляными красками, в этой категории товаров существуют и вышитые модульные картины, созданные с использованием лент, бусин и бисера.
<h3>Крепление модульных картин</h3>
	<p>Прикрепить сегменты модульной картины на стену можно с помощью жидких гвоздей, двустороннего скотча, а ещё специальных крючков с калеными иглами. Лёгкие модули небольшой картины можно прикрепить даже обычными канцелярскими кнопками. Чтобы картина модульная длительный срок сохраняла презентабельный вид, её не следует размещать вблизи отопительной батареи или кондиционера, так как ей вредит и нагрев, и сырость.</p>


	    </div>
	    <div id='side'>
	        <h3>Смотрите также</h3>
	        <a href='/modulnye_kartiny/kupit_kartiny_dlya_interyera.html' class='fast1'>Картины для интерьера</a>
	        <a href='/modulnye_kartiny/diptih_kartiny.html' class='fast1'>Диптих картины</a>
	        <a href='/modulnye_kartiny/triptih_kartiny.html' class='fast1'>Триптих картины</a>
	        <a href='/modulnye_kartiny/poliptih_kartiny.html' class='fast1'>Полиптих картины</a>
    ";
}

include "b3.php";
?>

<script>
	<?
	echo 'var pric=[' . $t1[0] . ',' . $t2[0] . ',' . $t3[0] . '];';
	echo 'var ident=["' . $t1[2] . '","' . $t2[2] . '","' . $t3[2] . '"];';
	echo 'var curId=ident[0];';
	?>
	var curSize = 0;
	var curImg = <? echo $_GET['id']; ?>;

	function chprice(id) {
		mprice.innerHTML = pric[id] + "<span> р.</span>";
		curSize = id;
		curId = ident[id];
	}

	function switchZakaz() {
		(quickZakaz.className == "blockShow" || quickZakaz.className == "blockShow2") ? quickZakaz.className = "blockHide": quickZakaz.className = "blockShow";
	}

	function areaChange(id) {
		id.style.background = '#f3fff3';
		if (id.value == '') {
			id.style.background = '#fff3f3';
		}
	}

	function getXmlHttp() {
		var xmlhttp;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				xmlhttp = false;
			}
		}
		if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
	}

	function sendZakaz() {
		if (zakName.value != '' && zakKont.value != '') {
			var req = getXmlHttp();
			var url = '/qzakaz.php?img=' + curImg + '&size=' + curSize + '&name=' + zakName.value + '&kont=' + zakKont.value + '&komm=' + zakKomm.value;
			if (curId) {
				url = url + '&ident=' + curId;
			}
			zakSendInfo.innerHTML = 'Отправляем заказ...';
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					if (req.status == 200) {
						zakSendInfo.innerHTML = 'Вашему заказу присвоен номер:<br><strong>' + req.responseText + '</strong><br>Наши менеджеры в ближайшее время свяжутся с вами для подтверждения заказа.<br><div class="modButton" onclick="switchZakaz(event)">Ок</div>';
					} else {
						zakSendInfo.innerHTML = 'Вашему заказу присвоен номер:<br><strong style="color:#f00;">Ошибка</strong><br>Что-то поломалось:(<br>Свяжитесь пожалуйста с нами по телефону.<br><div class="modButton" onclick="switchZakaz(event)">Ок</div>';
					}
				}

			}
			req.open('GET', url, true);
			req.send(null);

			quickZakaz.className = 'blockShow2';
			zakName.style.background = '#fff3f3';
			zakKont.style.background = '#fff3f3';
			zakName.value = '';
			zakKont.value = '';
			zakKomm.value = '';
		} else {
			if (zakName.value == '') {
				zakName.style.background = '#ffe0e0';
			}
			if (zakKont.value == '') {
				zakKont.style.background = '#ffe0e0';
			}
		}
	}
</script>