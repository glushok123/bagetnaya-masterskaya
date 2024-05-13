<html>

<head>
    <title>Результат загрузки файла</title>
</head>

<body>
<?php
if ($_GET['id']) {
    $z = explode('l', (string)$_GET['id']);
    if ($_FILES["filename"]["size"] > 26_214_400) {
        echo("Размер файла превышает двадцать пять мегабайт");
        exit;
    }
    if ($_FILES["filename"]["type"] == "image/jpg" || $_FILES["filename"]["type"] == "image/jpeg" || $_FILES["filename"]["type"] == "image/png") {
    } else {
        echo "Ошибка формата файла";
        exit;
    }
    if (is_uploaded_file($_FILES["filename"]["tmp_name"])) {
        $z[8] = '1' . date("ymdHis") . random_int(10, 99);
        move_uploaded_file($_FILES["filename"]["tmp_name"], "pics/" . $z[8] . ".jpg");
        [$width, $height] = getimagesize('pics/' . $z[8] . ".jpg");
        $info = getimagesize('pics/' . $z[8] . ".jpg");
        $width = $info[0];
        $height = $info[1];


        if ($width > 0 && $height > 0) {
            $sizes = getimagesize('pics/' . $z[8] . ".jpg");
            $exif = exif_read_data('pics/' . $z[8] . ".jpg");
            if (isset($exif["Orientation"])) {
                if ($exif["Orientation"] == 6) {

                    $width = $sizes[1];
                    $height = $sizes[0];
                }
            }
            $z[10] = round($height * $z[9] / $width);
            if ($z[10] > 3000) {
                $z[10] = 3000;
            }
            if ($z[10] < 50) {
                $z[10] = 50;
            }
            $z[9] = round($width * $z[10] / $height);
            exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online?id=' . implode("l", $z) . '">');
        } else {
            $z[9] = 300;
            $z[10] = 200;
            $z[8] = 0;
            exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online?id=' . implode("l", $z) . '">');
        }
    } else {
        echo("Ошибка загрузки файла");
    }
} else {
    exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
}
?>
</body>

</html>