var pos = -1,
    max = 5,
    prt = true,
    gsh = false,
    ttr = true,
    n = 0;
var isFocus = true;
window.addEventListener('keydown', handler, false);
window.onfocus = function () {
    isFocus = true;
}
window.onblur = function () {
    isFocus = false;
}

function rt(id) {
    if (ttr) {
        if ((prt && !gsh) || id) {
            pos = (pos >= max ? (pos - max + 1) : (pos + 1));
            for (i = 6; i >= 0; i--) {
                (pos + i) >= max ? n = (pos + i - max) : n = (pos + i);
                var galem = document.getElementById("gid" + n);
                var realsrc = galem.getAttribute('attr');
                if (realsrc) {
                    galem.setAttribute('style', realsrc);
                    galem.setAttribute('attr', '');
                }
                if (galem.className == "ge") {
                    galem.className = ("ge" + i);
                    (pos + i + 1) >= max ? n = (pos + i - max + 1) : n = (pos + i + 1);
                    galem = document.getElementById("gid" + n);
                    galem.className = ("ge");
                    realsrc = galem.getAttribute('attr2');
                    if (realsrc) {
                        galem.setAttribute('style', realsrc);
                        galem.setAttribute('attr2', '');
                    }
                } else {
                    galem.className = ("ge" + i);
                }
            }
        }
    } else {
        if ((prt && !gsh) || id) {
            pos = (pos < 1 ? (pos + max - 1) : (pos - 1));
            for (i = 0; i < 7; i++) {
                (pos + i) >= max ? n = (pos + i - max) : n = (pos + i);
                var galem = document.getElementById("gid" + n);
                var realsrc = galem.getAttribute('attr');
                if (realsrc) {
                    galem.setAttribute('style', realsrc);
                    galem.setAttribute('attr', '');
                }
                if (galem.className == "ge") {
                    galem.className = ("ge" + i);
                    (pos + i - 1) >= max ? n = (pos + i - max - 1) : n = (pos + i - 1);
                    galem = document.getElementById("gid" + n);
                    galem.className = ("ge");
                    realsrc = galem.getAttribute('attr2');
                    if (realsrc) {
                        galem.setAttribute('style', realsrc);
                        galem.setAttribute('attr2', '');
                    }
                } else {
                    galem.className = ("ge" + i);
                }
            }
        }
    }
}

function rotate() {
    if (isFocus) {
        rt();
    }
    setTimeout(function () {
        rotate();
    }, 4000);
}

function sp(id) {
    var galem = document.getElementById("gid" + id);
    if (!gsh) {
        gsh = galem.className;
        galem.className = ("ge");
        realsrc = galem.getAttribute('attr2');
        if (realsrc) {
            galem.setAttribute('style', realsrc);
            galem.setAttribute('attr2', '');
        }
    } else {
        galem.className = gsh;
        gsh = false;
        prt = true;
    }
}

function handler(event) {
    if (event.keyCode == 37) {
        ttr = false;
        rt(true);
    }
    if (event.keyCode == 39) {
        ttr = true;
        rt(true);
    }
}


setTimeout(function () {
    //document.getElementById("gc").innerHTML=document.getElementById("gc").innerHTML = ges;
    rotate();
}, 10);