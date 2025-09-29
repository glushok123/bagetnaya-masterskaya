/***********************
 * 1) МАССИВ КАРТИНОК  *
 ***********************/
const GAME15_IMAGES = [
    { src: '/img/puzzles/А.А. Дейнека - раздолье.jpg',                desc: 'А.А. Дейнека — «Раздолье»' },
    { src: '/img/puzzles/А.И. Куинджи - Радуга.jpg',                   desc: 'А.И. Куинджи — «Радуга»' },
    { src: '/img/puzzles/Б.М. Кустодиев - масленица.jpg',              desc: 'Б.М. Кустодиев — «Масленица»' },
    { src: '/img/puzzles/И.И. Левитан - тихая обитель.jpg',            desc: 'И.И. Левитан — «Тихая обитель»' },
    { src: '/img/puzzles/Кацусика Хокусай - пейзаж.jpg',               desc: 'Кацусика Хокусай — «Пейзаж»' },
    { src: '/img/puzzles/Н.К. Рерих - помни.jpg',                       desc: 'Н.К. Рерих — «Помни»' },
    { src: '/img/puzzles/п. гоген - что нового.jpg',                   desc: 'П. Гоген — «Что нового»' },
    { src: '/img/puzzles/Р. Магрит - голконда.jpg',                    desc: 'Р. Магрит — «Голконда»' },
    { src: '/img/puzzles/С. Дали - Искушение святого Антония.jpg',     desc: 'С. Дали — «Искушение святого Антония»' },
    { src: '/img/puzzles/Фернандо Ботеро - Пикник, 1998.jpg',          desc: 'Фернандо Ботеро — «Пикник», 1998' },
    { src: '/img/puzzles/эдвард Мунк - плодородие.jpg',                 desc: 'Эдвард Мунк — «Плодородие»' },
    { src: '/img/puzzles/Ян Вермеер - стакан вина.jpg',                 desc: 'Ян Вермеер — «Стакан вина»' },
];

// Фолбэк, если массив пуст/битый
const FALLBACK_IMAGE = { src: '/img/i1.jpg', desc: 'Изображение' };

// Безопасный вывод текста (на случай, если в desc попадёт HTML)
function esc(s){ return String(s).replace(/[&<>"']/g, m=>({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' }[m])); }

/*********************************
 * 2) ВЫБОР КАРТИНКИ И ПОДПИСИ  *
 *********************************/
const chosen = (Array.isArray(GAME15_IMAGES) && GAME15_IMAGES.length)
    ? GAME15_IMAGES[Math.floor(Math.random()*GAME15_IMAGES.length)]
    : FALLBACK_IMAGE;

var shufle = true;

// Очищаем контейнер
game15.innerHTML = '';

/************************
 * 3) СТИЛИ И РАЗМЕРЫ   *
 ************************/
var style = document.createElement('style');
// адаптивный размер — можно править 520px/медиа-правила по желанию
style.innerHTML =
    ".game15proc{--size:min(90vw,520px);height:var(--size);position:relative}" +
    ".game15proc div{background:url('" + esc(chosen.src) + "');" +
    "background-size:var(--size) var(--size);position:absolute;font:normal 48px/calc(var(--size)/4) Calibri;" +
    "color:#fff;text-shadow:0 0 6px #000;text-align:center;transition:all .5s ease;cursor:pointer;" +
    "width:24.5%;height:24.5%;box-shadow:inset 0 0 6px 2px #000;border-radius:6px}" +
    ".game15-caption{margin:.6rem 0 0;font:14px/1.5 system-ui, -apple-system, Segoe UI, Roboto, Arial;color:#666;text-align:center}";
style.innerHTML += ".p1,.p2,.p3,.p4{top:0}.p5,.p6,.p7,.p8{top:25%}.p9,.p10,.p11,.p12{top:50%}.p13,.p14,.p15,.p16{top:75%}" +
    ".p1,.p5,.p9,.p13{left:0}.p2,.p6,.p10,.p14{left:25%}.p3,.p7,.p11,.p15{left:50%}.p4,.p8,.p12,.p16{left:75%}" +
    "#p1{background-position:0 0!important}#p2{background-position:-100% 0!important}#p3{background-position:-200% 0!important}#p4{background-position:-300% 0!important}" +
    "#p5{background-position:0 -100%!important}#p6{background-position:-100% -100%!important}#p7{background-position:-200% -100%!important}#p8{background-position:-300% -100%!important}" +
    "#p9{background-position:0 -200%!important}#p10{background-position:-100% -200%!important}#p11{background-position:-200% -200%!important}#p12{background-position:-300% -200%!important}" +
    "#p13{background-position:0 -300%!important}#p14{background-position:-100% -300%!important}#p15{background-position:-200% -300%!important}#p16{background:none!important;box-shadow:none!important}";
document.head.appendChild(style);

/*********************************
 * 4) СЕТКА ТАЙЛОВ И ПОДПИСЬ     *
 *********************************/
game15.className = 'game15proc';
game15.setAttribute('role','group');
game15.setAttribute('aria-label', 'Пятнашки: ' + chosen.desc);

game15.innerHTML =
    "<div id='p1' onpointerdown='move(this);' class='p1'><span>1</span></div>" +
    "<div id='p2' onpointerdown='move(this);' class='p2'><span>2</span></div>" +
    "<div id='p3' onpointerdown='move(this);' class='p3'><span>3</span></div>" +
    "<div id='p4' onpointerdown='move(this);' class='p4'><span>4</span></div>" +
    "<div id='p5' onpointerdown='move(this);' class='p5'><span>5</span></div>" +
    "<div id='p6' onpointerdown='move(this);' class='p6'><span>6</span></div>" +
    "<div id='p7' onpointerdown='move(this);' class='p7'><span>7</span></div>" +
    "<div id='p8' onpointerdown='move(this);' class='p8'><span>8</span></div>" +
    "<div id='p9' onpointerdown='move(this);' class='p9'><span>9</span></div>" +
    "<div id='p10' onpointerdown='move(this);' class='p10'><span>10</span></div>" +
    "<div id='p11' onpointerdown='move(this);' class='p11'><span>11</span></div>" +
    "<div id='p12' onpointerdown='move(this);' class='p12'><span>12</span></div>" +
    "<div id='p13' onpointerdown='move(this);' class='p13'><span>13</span></div>" +
    "<div id='p14' onpointerdown='move(this);' class='p14'><span>14</span></div>" +
    "<div id='p15' onpointerdown='move(this);' class='p15'><span>15</span></div>" +
    "<div id='p16' onpointerdown='move(this);' class='p16'></div>";

// Подпись ниже поля (если была старая — удалим)
if (game15.nextElementSibling && game15.nextElementSibling.classList.contains('game15-caption')) {
    game15.nextElementSibling.remove();
}
var cap = document.createElement('div');
cap.className = 'game15-caption';
cap.textContent = chosen.desc || '';
game15.insertAdjacentElement('afterend', cap);

/*****************
 * 5) Перемешка  *
 *****************/
shuf();

/* дальше ваш существующий код функций move(), check(), shuf(), winwin() —
   они не завязаны на картинку и могут остаться без изменений */

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
    }
    ;
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
    // если есть подпись под пазлом — уберём, чтобы не мешала промоблоку
    if (game15.nextElementSibling && game15.nextElementSibling.classList.contains('game15-caption')) {
        game15.nextElementSibling.remove();
    }

    $.ajax({
        url: '/game15.php',
        method: 'post',
        success: function (data) {
            // cookie на 24 часа
            document.cookie = "skidkod=" + encodeURIComponent(data) + "; path=/; max-age=" + (24 * 60 * 60);

            // разметка как в модалке с PHP (динамический промокод внутри)
            var html =
                "<div class='game-head-1'>Скидка 10% Ваша!</div>" +
                "<div class='promo mt-2'>Промокод: <b>" + data + "</b></div>" +
                "<div class='text-promo mt-2'>Воспользуйтесь им в течении 24 часов, сделав заказ в конструкторе багета или сообщите менеджеру салона!</div>" +
                "<div class='flex-but mt-3'>" +
                "<a href='/baget_online'>" +
                "<button class='button button-custom-index button-color-company-red color-white'>Конструктор багета <b>online</b></button>" +
                "</a>" +
                "<button class='button button-custom-index button-color-company-red color-white' data-bs-toggle='modal' data-bs-target='#feedbackModal'>Заявка на обратную связь</button>" +
                "</div>";

            // оформляем «экран победы»
            game15.className = 'game15end row text-center';
            game15.innerHTML = html;
        },
        error: function () {
            game15.className = 'game15end row text-center';
            game15.innerHTML = "<div class='text-promo'>Ошибка при получении промокода. Попробуйте ещё раз.</div>";
        }
    });
}
