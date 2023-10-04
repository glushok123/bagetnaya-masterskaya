var shufle = true;

game15.innerHTML = '';
var style = document.createElement('style');
style.innerHTML = ".game15proc div {background:url('/img/i" + Math.floor(Math.random() * 6 + 1) + ".jpg');}"
style.innerHTML += '.game15proc {height:320px;}.game15proc div {background-size:320px 320px;position:absolute;font:normal 40px/80px Calibri;color:#fff;text-shadow:0 0 6px #000;text-align:center;transition:all 0.5s ease;cursor:pointer;width:24.5%;height:24.5%;box-shadow:inset 0 0 6px 2px #000;border-radius:6px;} .p1,.p2,.p3,.p4 {top:0;}.p5,.p6,.p7,.p8 {top:25%;}.p9,.p10,.p11,.p12 {top:50%;}.p13,.p14,.p15,.p16 {top:75%;}.p1,.p5,.p9,.p13 {left:0;}.p2,.p6,.p10,.p14 {left:25%;}.p3,.p7,.p11,.p15 {left:50%;}.p4,.p8,.p12,.p16 {left:75%;}#p1 {background-position:0 0 !important;}#p2 {background-position:-100% 0 !important;}#p3 {background-position:-200% 0 !important;}#p4 {background-position:-300% 0 !important;}#p5 {background-position:0 -100% !important;}#p6 {background-position:-100% -100% !important;}#p7 {background-position:-200% -100% !important;}#p8 {background-position:-300% -100% !important;}#p9 {background-position:0 -200% !important;}#p10 {background-position:-100% -200% !important;}#p11 {background-position:-200% -200% !important;}#p12 {background-position:-300% -200% !important;}#p13 {background-position:0 -300% !important;}#p14 {background-position:-100% -300% !important;}#p15 {background-position:-200% -300% !important;}#p16 {background:none !important;box-shadow:none !important;}';
document.head.appendChild(style);
game15.innerHTML = "<div id='p1' onmousedown='move(this);' class='p1'><span>1</span></div><div id='p2' onmousedown='move(this);' class='p2'><span>2</span></div><div id='p3' onmousedown='move(this);' class='p3'><span>3</span></div><div id='p4' onmousedown='move(this);' class='p4'><span>4</span></div><div id='p5' onmousedown='move(this);' class='p5'><span>5</span></div><div id='p6' onmousedown='move(this);' class='p6'><span>6</span></div><div id='p7' onmousedown='move(this);' class='p7'><span>7</span></div><div id='p8' onmousedown='move(this);' class='p8'><span>8</span></div><div id='p9' onmousedown='move(this);' class='p9'><span>9</span></div><div id='p10' onmousedown='move(this);' class='p10'><span>10</span></div><div id='p11' onmousedown='move(this);' class='p11'><span>11</span></div><div id='p12' onmousedown='move(this);' class='p12'><span>12</span></div><div id='p13' onmousedown='move(this);' class='p13'><span>13</span></div><div id='p14' onmousedown='move(this);' class='p14'><span>14</span></div><div id='p15' onmousedown='move(this);' class='p15'><span>15</span></div><div id='p16' onmousedown='move(this);' class='p16'></div>";
game15.className = 'game15proc';
shuf();


function move(target) {
	if (shufle) {
		return;
	}
	var i1 = target.className.substr(1, 2);
	var blank = document.getElementById('p16');
	var i2 = blank.className.substr(1, 2);
	if ((Math.abs(i1 - i2) == 4) || (i1 - i2 == 1 && i1 != 1 && i1 != 5 && i1 != 9 && i1 != 13) || (i2 - i1 == 1 && i1 != 4 && i1 != 8 && i1 != 12 && i1 != 16)) {
		blank.className = 'p' + i1;
		target.className = 'p' + i2;
	}
	if (!check()) {
		winwin();
	}
}

function check() {
	for (var i = 1; i < 17; i++) {
		if (document.getElementById('p' + i).className != 'p' + i) {
			return false;
		}
	};
	return true;
}

function shuf() {
	var arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
	var h = 0;
	var flag = true;
	var chet = 0;
	while (flag || h < 50) {
		h++;
		var a = Math.floor(Math.random() * 15);
		var b = Math.floor(Math.random() * 15);
		var c = arr[a];
		arr[a] = arr[b];
		arr[b] = c;
		setTimeout("document.getElementById('p" + (a + 1) + "').className='p" + arr[a] + "';", h * 50);
		setTimeout("document.getElementById('p" + (b + 1) + "').className='p" + arr[b] + "';", h * 50);
		chet = 0;
		flag = true;
		for (var i = 0; i < 15; i++) {
			for (var j = i; j < 15; j++) {
				if (arr[i] > arr[j]) {
					chet++;
				}
			}
		}
		if (Math.round(chet / 2) == chet / 2) {
			flag = false;
		}
	}
	setTimeout("shufle=false", 2500);
}

function winwin() {
	var req = getXmlHttp();
	var url = '/game15.php';
	req.onreadystatechange = function () {
		if (req.readyState == 4) {
			if (req.status == 200) {
				game15.className = 'game15end';
				game15.innerHTML = "<div>Промокод: <b>" + req.responseText + "</b><br>Действителен 48 часов.<br>Для активизации сообщите промокод менеджеру или используйте в конструкторе багета.</div>";
				var date = new Date;
				date.setDate(date.getDate() + 1);
				document.cookie = "skidkod=" + req.responseText + "; path=/; expires=" + date.toUTCString();
			} else {
				game15.className = 'game15end';
				game15.innerHTML = "<div>Ошибка</div>";
			}
		}
	}
	req.open('GET', url, true);
	req.send(null);
}