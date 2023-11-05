<?php

$files = [];
if ($gallery == "all" || $gallery == "bagetnaya_masterskaya") {
  $k_files = scandir($_SERVER['DOCUMENT_ROOT'] . "/gallemax/bagetnaya_masterskaya");
  for ($i = 2; $i < (is_countable($k_files) ? count($k_files) : 0); $i++) {
    array_push($files, "/bagetnaya_masterskaya/" . $k_files[$i]);
  }
}
if ($gallery == "all" || $gallery == "bagetnye_ramki" || $gallery == "ramki_dlya_kartin") {
  $k_files = scandir($_SERVER['DOCUMENT_ROOT'] . "/gallemax/bagetnye_ramki");
  for ($i = 2; $i < (is_countable($k_files) ? count($k_files) : 0); $i++) {
    array_push($files, "/bagetnye_ramki/" . $k_files[$i]);
  }
}
if ($gallery == "all" || $gallery == "bagety_dlya_kartin") {
  $k_files = scandir($_SERVER['DOCUMENT_ROOT'] . "/gallemax/bagety_dlya_kartin");
  for ($i = 2; $i < (is_countable($k_files) ? count($k_files) : 0); $i++) {
    array_push($files, "/bagety_dlya_kartin/" . $k_files[$i]);
  }
}

if ($gallery == "all" || $gallery == "ramki_dlya_ikon") {
  $k_files = scandir($_SERVER['DOCUMENT_ROOT'] . "/gallemax/ramki_dlya_ikon");
  for ($i = 2; $i < (is_countable($k_files) ? count($k_files) : 0); $i++) {
    array_push($files, "/ramki_dlya_ikon/" . $k_files[$i]);
  }
}
if ($gallery == "all" || $gallery == "ramki_dlya_kartin" || $gallery == "bagetnye_ramki") {
  $k_files = scandir($_SERVER['DOCUMENT_ROOT'] . "/gallemax/ramki_dlya_kartin");
  for ($i = 2; $i < (is_countable($k_files) ? count($k_files) : 0); $i++) {
    array_push($files, "/ramki_dlya_kartin/" . $k_files[$i]);
  }
}
if ($gallery == "all" || $gallery == "ramki_dlya_vyshivki" || $gallery == "bagetnye_ramki") {
  $v_files = scandir($_SERVER['DOCUMENT_ROOT'] . "/gallemax/bagetnye_ramki");
  for ($i = 2; $i < (is_countable($v_files) ? count($v_files) : 0); $i++) {
    array_push($files, "/bagetnye_ramki/" . $v_files[$i]);
  }
}
if ($gallery == "all" || $gallery == "pechat_na_holste") {
  $v_files = scandir($_SERVER['DOCUMENT_ROOT'] . "/gallemax/pechat_na_holste");
  for ($i = 2; $i < (is_countable($v_files) ? count($v_files) : 0); $i++) {
    array_push($files, "/pechat_na_holste/" . $v_files[$i]);
  }
}
if ($gallery == "all" || $gallery == "na_penokarton") {
  $v_files = scandir($_SERVER['DOCUMENT_ROOT'] . "/gallemax/na_penokarton");
  for ($i = 2; $i < (is_countable($v_files) ? count($v_files) : 0); $i++) {
    array_push($files, "/na_penokarton/" . $v_files[$i]);
  }
}
if ($gallery == "all" || $gallery == "holst_na_podramnike") {
  $v_files = scandir($_SERVER['DOCUMENT_ROOT'] . "/gallemax/holst_na_podramnike");
  for ($i = 2; $i < (is_countable($v_files) ? count($v_files) : 0); $i++) {
    array_push($files, "/holst_na_podramnike/" . $v_files[$i]);
  }
}
if ($gallery == "all" || $gallery == "zerkala_v_bagete") {
  $v_files = scandir($_SERVER['DOCUMENT_ROOT'] . "/zerkala_v_bagete");
  for ($i = 2; $i < (is_countable($v_files) ? count($v_files) : 0); $i++) {
    array_push($files, "/zerkala_v_bagete/" . $v_files[$i]);
  }
}
if ($gallery == "all" || $gallery == "oformlenie_detskih_risunkov") {
  $v_files = scandir($_SERVER['DOCUMENT_ROOT'] . "/gallemax/oformlenie_detskih_risunkov");
  for ($i = 2; $i < (is_countable($v_files) ? count($v_files) : 0); $i++) {
    array_push($files, "/oformlenie_detskih_risunkov/" . $v_files[$i]);
  }
}
if ($gallery == "all" || $gallery == "televizor_v_bagete") {
  $v_files = scandir($_SERVER['DOCUMENT_ROOT'] . "/gallemax/televizor_v_bagete");
  for ($i = 2; $i < (is_countable($v_files) ? count($v_files) : 0); $i++) {
    array_push($files, "/televizor_v_bagete/" . $v_files[$i]);
  }
}

($files);
($files);
$max = count($files);
?>



<div id="gc" class="gallery" onmouseover="prt=false;" onmouseout="prt=true;">
  <div class="gal-left" onclick="ttr=false; rt(true);" title="используйте кнопки влево/вправо на клавиатуре"></div>
  <div class="gal-right" onclick="ttr=true; rt(true);" title="используйте кнопки влево/вправо на клавиатуре"></div>
  <?

  echo "
      <div id='gid0' class='ge1' onclick='sp(0);' attr2='background:url(\"/gallemax" . $files[0] . "\") no-repeat center, url(\"/gallemin" . $files[0] . "\") no-repeat center; background-size: contain;' attr='' style='background:url(\"/gallemin" . $files[0] . "\") no-repeat center; background-size: contain;'></div>
      <div id='gid1' class='ge2' onclick='sp(1);' attr2='background:url(\"/gallemax" . $files[1] . "\") no-repeat center, url(\"/gallemin" . $files[1] . "\") no-repeat center; background-size: contain;' attr='' style='background:url(\"/gallemin" . $files[1] . "\") no-repeat center; background-size: contain;'></div>
      <div id='gid2' class='ge3' onclick='sp(2);' attr2='background:url(\"/gallemax" . $files[2] . "\") no-repeat center, url(\"/gallemin" . $files[2] . "\") no-repeat center; background-size: contain;' attr='' style='background:url(\"/gallemin" . $files[2] . "\") no-repeat center; background-size: contain;'></div>
      <div id='gid3' class='ge4' onclick='sp(3);' attr2='background:url(\"/gallemax" . $files[3] . "\") no-repeat center, url(\"/gallemin" . $files[3] . "\") no-repeat center; background-size: contain;' attr='' style='background:url(\"/gallemin" . $files[3] . "\") no-repeat center; background-size: contain;'></div>
      <div id='gid4' class='ge5' onclick='sp(4);' attr2='background:url(\"/gallemax" . $files[4] . "\") no-repeat center, url(\"/gallemin" . $files[4] . "\") no-repeat center; background-size: contain;' attr='' style='background:url(\"/gallemin" . $files[4] . "\") no-repeat center; background-size: contain;'></div>
      ";



  /*echo "
    <div id='gid0' class='ge1' onclick='sp(0);' attr2='background:url(\"/gallemax".$files[0]."\") no-repeat center, url(\"/gallemin".$files[0]."\") no-repeat center; background-size: contain;' attr='' style='background:url(\"/gallemin".$files[0]."\") no-repeat center; background-size: contain;'></div>
    <div id='gid1' class='ge2' onclick='sp(1);' attr2='background:url(\"/gallemax".$files[1]."\") no-repeat center, url(\"/gallemin".$files[1]."\") no-repeat center; background-size: contain;' attr='' style='background:url(\"/gallemin".$files[1]."\") no-repeat center; background-size: contain;'></div>
    <div id='gid2' class='ge3' onclick='sp(2);' attr2='background:url(\"/gallemax".$files[2]."\") no-repeat center, url(\"/gallemin".$files[2]."\") no-repeat center; background-size: contain;' attr='' style='background:url(\"/gallemin".$files[2]."\") no-repeat center; background-size: contain;'></div>
    <div id='gid3' class='ge4' onclick='sp(3);' attr2='background:url(\"/gallemax".$files[3]."\") no-repeat center, url(\"/gallemin".$files[3]."\") no-repeat center; background-size: contain;' attr='' style='background:url(\"/gallemin".$files[3]."\") no-repeat center; background-size: contain;'></div>
    <div id='gid4' class='ge5' onclick='sp(4);' attr2='background:url(\"/gallemax".$files[4]."\") no-repeat center, url(\"/gallemin".$files[4]."\") no-repeat center; background-size: contain;' attr='' style='background:url(\"/gallemin".$files[4]."\") no-repeat center; background-size: contain;'></div>
    ";*/
  ?>
</div>