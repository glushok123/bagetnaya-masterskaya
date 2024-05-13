<html>

<head>
    <script>
        function modulprice(x, y, n) {
            return (0.003 * x * y(1 + 0.05 * n) + (x + y * n) * 800);
        }

        function formprice() {
            x = Number(document.forms["form"]["wid"].value);
            y = Number(document.forms["form"]["hei"].value);
            if (x >= 1000 || y >= 1000) {
                if (x > y) {
                    l = x / 10;
                } else {
                    l = y / 10;
                }
            } else {
                if (x < y) {
                    l = x / 10;
                } else {
                    l = y / 10;
                }
            }
            n = Number(document.forms["form"]["num"].value);
            price = 0.0026 * x * y * (1 + 0.05 * n) + (x + y * n) * 0.8;
            p1 = 0.0026 * x * y;
            p2 = (x + y * n) * 0.8;
            p3 = 0.0004 * x * y;
            if (document.forms["form"]["lak"].checked) {
                price += 0.0004 * x * y * (1 + 0.05 * n);
            }
            /*document.getElementById('price').innerHTML = Math.floor(price);*/
            document.getElementById('price').innerHTML = p1 + '-' + p2 + '-' + p3;
        }

        setTimeout(formprice, 200);
    </script>
</head>

<body>
<form name="form" onsubmit="return false;">
    Короткая сторона модулей: <input type="text" name="wid" onchange="formprice();" value="1000" autocomplete="off">
    мм<br>
    Длинная сторона модулей: <input type="text" name="hei" onchange="formprice();" value="1000" autocomplete="off">
    мм<br>
    Количество модулей: <input type="text" name="num" onchange="formprice();" value="1" autocomplete="off"> шт<br>
    Обработка лаком: <input type="checkbox" name="lak" onchange="formprice();">
</form>
Цена: <span id="price"></span>
</body>

</html>