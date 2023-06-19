<html>

<head>
  <title>Результат загрузки файла</title>
</head>

<body>
  <?php
  if ($_GET['id']) {
    $z = explode('l', $_GET['id']);

    if ($_FILES["filename"]["size"] > 26214400) {
      echo ("Размер файла превышает двадцать пять мегабайт");
      exit;
    }
    if ($_FILES["filename"]["type"] == "image/jpg" || $_FILES["filename"]["type"] == "image/jpeg" || $_FILES["filename"]["type"] == "image/png") {
    } else {
      echo "Ошибка формата файла";
      exit;
    }


    if (is_uploaded_file($_FILES["filename"]["tmp_name"])) {
      $z[11] = '1' . date("ymdHis") . rand(10, 99);
      $z[21] = round($z[21] / 3);
      move_uploaded_file($_FILES["filename"]["tmp_name"], "pics/" . $z[11] . ".jpg");
      list($width,  $height) = getimagesize('pics/' . $z[11] . ".jpg");
      if ($width > 0 && $height > 0) {
        exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online?id=' . implode("l", $z) . '">');
      } else {
        $z[11] = 0;
        exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online?id=' . implode("l", $z) . '">');
      }
    } else {
      echo ("Ошибка загрузки файла");
    }
  } else {
    exit('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
  }
  ?>
</body>

</html>