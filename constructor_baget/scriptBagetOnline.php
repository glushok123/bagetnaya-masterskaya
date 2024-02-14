<script>
    <? echo 'var z=[' . $z[0] . ',' . $z[1] . ',' . $z[2] . ',' . $z[3] . ',' . $z[4] . ',' . $z[5] . ',' . $z[6] . ',' . $z[7] . ',' . $z[8] . ',' . $z[9] . ',' . $z[10] . ',' . $z[11] . ',' . $z[12] . ',' . $z[13] . ',' . $z[14] . ',' . $z[15] . ',' . $z[16] . ',' . $z[17] . ',' . $z[18] . ',' . $z[19] . ',' . $z[20] . ',' . $z[21] . ',' . $z[22] . '], mainw=' . $mainw . ', mainh=' . $mainh; ?>

    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
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
        height = document.body.clientHeight * 0.8;

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
        const windowInnerWidth = window.innerWidth
        const windowInnerHeight = window.innerHeight

        <? if ($z[8] != 0) {
        [$width, $height] = getimagesize($picname); ?>
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
        width = document.body.clientWidth * 0.65;
        height = document.body.clientHeight * 0.55;


       // width = $('#block-orient-width').width();
        //height = $('#block-orient-width').height();

       // console.log(width, height)
        if (height == 0) {
            height = 250
        }

        maxmainw = width * 0.95;
        maxmainh = height * 0.88;

        if (window.innerWidth < 800) {
            maxmainw = width * 0.9;
            maxmainh = height * 1;
        }

        z[19] = Math.floor(width * 0.1);
        z[20] = Math.floor(height * 0.1);

        raschk = raschx / raschy;
        if (maxmainw / maxmainh < raschk) {
            z[21] = Math.floor(1000 * maxmainw / raschx);
            z[20] = Math.floor(height * 0.5) - raschy * z[21] / 2000;
        } else {
            z[21] = Math.floor(1000 * maxmainh / raschy);
            z[19] = Math.floor(width * 0.28) - raschx * z[21] / 2000;
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


        z[20] = 20

        if (z[19] < 40) {

        }

        if (window.innerWidth < 800) {
            z[20] = -10
            z[19] = (window.innerWidth - mainw) / 2
        } else {
            let widthBlock2 = document.getElementById('block2').offsetWidth;
            z[19] = (window.innerWidth - widthBlock2 - mainw) / 2
        }


        //console.log('left:' + z[19] )
        myModal.hide();
        bagcont.style.width = mainw + 'px';
        bagcont.style.height = mainh + 'px';
        bagcont.style.left = z[19] + 'px';
        bagcont.style.right = z[20] + 'px';
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
        if ($master && false == true) {
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
        if ($master && false == true) { ?>
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

    let reset = function () {
        deleteCookie('bagettype');
        deleteCookie('vendor');
        deleteCookie('pricenew');
        deleteCookie('widthwithout');
        deleteCookie('width');
        deleteCookie('catalogfile');
        deleteCookie('calcfile');
        rePage();
    };

    (function ($) {

        $('#bagettype').val(
            <?
            if (!empty($_COOKIE["bagettype"])) {
                echo '"' . $_COOKIE["bagettype"] . '"';
            } else {
                echo '';
            }
            ?>
        );

        $('.addbaget').click(function () {
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
        $('input[name="catalogfile"]').on('change', function () {
            files = this.files;
        });
        $('input[name="calcfile"]').on('change', function () {
            calcfile = this.files;
        });

        // обработка и отправка AJAX запроса при клике на кнопку upload_files
        $('.upload_files').on('click', function (event) {
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

            data.append("first", $('#img-first')[0].files[0]);
            data.append("second", $('#img-second')[0].files[0]);

            /*$.each(files, function(key, value) {
                data.append('first', value);
            });

            $.each(calcfile, function(key, value) {
                data.append('second', value);
            });
            */
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
                success: function (respond, status, jqXHR) {
                    if (typeof respond.error === 'undefined') {
                        var files_path = respond.files;
                        var html = '';
                        z[2] = $('input[name="width"]').val();
                        z[22] = $('input[name="widthwithout"]').val();
                        $.each(files_path, function (key, val) {
                            html += val;
                        })

                        // $('.ajax-reply').html( html );
                        if (typeof (respond.calcfile) != "undefined" && respond.calcfile !== null && typeof (respond.catalogfile) != "undefined" && respond.catalogfile !== null && typeof (respond.catalogfile) != "" && respond.calcfile !== "") {
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
                error: function (jqXHR, status, errorThrown) {
                    z[2] = $('input[name="width"]').val();
                    z[22] = $('input[name="widthwithout"]').val();
                    changesize();
                    rePage();
                    console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
                }

            });

        });

        $('.choice-pasp').click(function () {
            $('.pasp-block').slideDown(300);
        })

        $('.close-pasp-block').click(function () {
            $('.pasp-block').slideUp(300);
        })

    })(jQuery)

    let getitem = function (id) {
        var idgetitem = id;

        $.ajax({
            url: "/base/idgetitem.php",
            type: "post",
            data: {
                id: idgetitem,
            },
            dataType: "text",
            success: function (data) {
                item = JSON.parse(data);
                //console.log(item);
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
            error: function (jqXHR, textStatus, errorThrown) {
                //console.log(textStatus);

                alert('ошибка загрузки багета');

            }
        });


    }

    let closeme = function () {
        $('.layer').fadeOut(500);
        $('#bmenu').fadeOut(500);
        $('body').removeClass('fixwindow');
    }

    function choiseCatalog(type) {
        $('#catalog-plast').removeClass('active-button-catalog')
        $('#catalog-wood').removeClass('active-button-catalog')
        $('#catalog-alum').removeClass('active-button-catalog')
        $('#catalog-pasp').removeClass('active-button-catalog')

        $('#get-catalog-plast').removeClass('active-button-get-catalog')
        $('#get-catalog-wood').removeClass('active-button-get-catalog')
        $('#get-catalog-alum').removeClass('active-button-get-catalog')
        $('#get-catalog-pasp').removeClass('active-button-get-catalog')

        $('#catalog-' + type).addClass('active-button-catalog')
        $('#get-catalog-' + type).addClass('active-button-get-catalog')
    }

    let getcatalog = function (type, page = 1, search = false) {
        console.log($('#search-article').val());

        selectedType = $('#sorter-catalog').attr("data-type");

        if (search == false) {
            if (type != selectedType) {
                $('.baget-conteiner .row').html("")
                curentPage = 1;
                downloadCatalog(type, page, search);
            } else {
                if (page == 1) {
                    $('.baget-conteiner .row').html("");
                }
                downloadCatalog(type, page, search);
                $('.layer').fadeIn(500);
                $('#bmenu').fadeIn(500);
            }
            choiseCatalog(type)
        }

        if (search == true) {
            $('.baget-conteiner .row').html("")
            curentPage = 1;
            downloadCatalog(type, page, search);
        }
    }

    function downloadCatalog(type, page = 1, search) {
        if (typeof (type) != "undefined" && type !== null) {
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
                page: page,
                search: search,
                query: $('#search-article').val(),
            },
            dataType: "text",
            success: function (data) {
                if (data !== '') {
                    document.getElementById('addBagetBlock').innerHTML += data
                    $('body').addClass('fixwindow');
                    makeImgMas();
                    processDownload = false;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //console.log(textStatus);

                alert('ошибка добавления =(');

            }
        });

    }

    let addnewbaget = function () {
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
                imgconst: "<?
                    if (!empty($_COOKIE["catalogfile"])) {
                        echo $_COOKIE["catalogfile"];
                    } else {
                        echo '';
                    }
                    ?>",
                listimg: "<?
                    if (!empty($_COOKIE["calcfile"])) {
                        echo $_COOKIE["calcfile"];
                    } else {
                        echo '';
                    }
                    ?>",
            },
            dataType: "text",
            success: function (data) {
                delAllCookie();
                alert('Добавлено');
                rePage();


            },
            error: function (jqXHR, textStatus, errorThrown) {
                //console.log(textStatus);

                alert('ошибка добавления =(');

            }
        });
    }

    let deleteBaget = function (rmid) {
        var rmid = rmid;
        $.ajax({
            url: "/base/delete-baget.php",
            type: "post",
            data: {
                rmid: rmid,
            },
            dataType: "text",
            success: function (data) {
                var blockrm = 'del' + data;
                // $(blockrm).fadeOut(1000);
                alert('Удалено');
                rePage();


            },
            error: function (jqXHR, textStatus, errorThrown) {
                //console.log(textStatus);

                alert('ошибка удаления =(');

            }
        });
    }

    /*$(document).on('change', '#promo_kod', function(){
        countprice();
    })	*/

    $(document).on('click', '#get-info-promo-kods', function () {
        $.ajax({
            url: '/admin/request/getInfoPromoKodForCatalog.php',
            method: 'post',
            dataType: "json",
            data: {
                kod: $('#promo_kod').val()
            },
            success: function (data) {
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
            error: function (jqXHR, exception) {
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
    //console.log(z[12])


    var bgColors = [
        "linear-gradient(to right, #00b09b, #96c93d)",
        "linear-gradient(to right, #ff5f6d, #ffc371)",
    ]

    $(document).on('click', '.animated-button1', function () {
        if (z[8] == 0) {
            Toastify({
                text: 'Сначала выберите изображение !',
                close: true,
                className: "info",
                style: {
                    background: "#ff5f6d",
                }
            }).showToast();

            return;
        }

        $('.block-sk-circle').removeClass('hidden')

        $.ajax({
            url: '/analiz_colors_img/controller/searchBagetByColor.php',
            method: 'post',
            data: {
                image: z[8],
            },
            success: function (data) {
                $('#test-r').html(data)
                $('.block-sk-circle').addClass('hidden')
                myModal.show()
            },
            error: function (jqXHR, exception) {
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

        //$('.block-sk-circle').addClass('hidden')
    })

    $(document).on('click', '.btn-close-custom', function () {
        myModal.hide();
    })
</script>