var lastserv = "1";
var lastsize = "4";

function makeprice(id) {
    // console.log(id);
    alert(id);
    finalprice = 0;
    if (id == "0") {
        id = lastserv;
    }
    document.getElementById('serv' + lastserv).className = 'calcservs';
    lastserv = id;
    document.getElementById('serv' + lastserv).className = 'calcservsel';
    x = Number(document.forms["form"]["wid"].value);
    y = Number(document.forms["form"]["hei"].value);
    n = Number(document.forms["form"]["num"].value);
    if (x > 1000 || y > 1000) {
        if (x >= y) {
            z = x;
        } else {
            z = y;
        }
    } else {
        if (x >= y) {
            z = y;
        } else {
            z = x;
        }
    }

    if (id == "1") {
        finalprice = z * 2.6;
    }
    if (id == "2") {
        finalprice = z;
    }
    if (id == "3") {
        finalprice = z * 1.2;
    }
    if (id == "4") {
        finalprice = x * y * 0.0016;
    }
    if (id == "5") {
        finalprice = x * y * 0.002;
    }
    if (id == "6") {
        finalprice = y * 0.8 + x * 0.8;
    }

    finalprice = n * finalprice;
    finalprice = finalprice.toFixed(0);
    document.getElementById('price').innerHTML = finalprice;
    return;
}

function setsize(id) {
    alert(id);
    document.getElementById('calcsize' + lastsize).className = 'calcsize';
    lastsize = id;
    document.getElementById('calcsize' + lastsize).className = 'calcsizesel';
    if (id == "0") {
        x = 841;
        y = 1189;
    }
    if (id == "1") {
        x = 594;
        y = 841;
    }
    if (id == "2") {
        x = 420;
        y = 594;
    }
    if (id == "3") {
        x = 297;
        y = 420;
    }
    if (id == "4") {
        x = 210;
        y = 297;
    }
    document.getElementById('widinp').value = x;
    document.getElementById('heiinp').value = y;
    makeprice(0);
}