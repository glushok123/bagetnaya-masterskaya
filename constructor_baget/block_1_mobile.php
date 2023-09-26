<div class="">
    <br><br>
    <div class='row text-center justify-content-center'>
        <div class="col-6 ms-auto">
            <h2 class='c1'>Примерить картину к багету</h2>
            <?
                    if ($z[8] != 0) {
                        [$width, $height] = getimagesize($picname);
                        echo '	<strong>Обратите внимание</strong><br>Размер изображения 
                        ' . $width . ' на ' . $height . '
                        точек, соотношение сторон картины 
                        зафиксировано соответственно. 
                        <br>Печать изображения не входит в стоимость заказа<br>
                        <a onclick="z[8]=0; rePage ();" class="t2 ">Убрать изображение картины</a>';
                    } else {
                        echo '
                        <form id="fileform" action="/upload.php?id=' . implode("l", $z) . '" method="post" enctype="multipart/form-data">
                            <label class="btn btn-secondary b1" style="height:auto !important;">
                                <input type="file" name="filename"  onchange="javascript:this.form.submit();" style="display:none; height:auto !important;">
                                Выберите файл
                            </label>
                        </form>';
                    }
                ?>
        </div>
        <div class="col-6 mx-auto">
            <button class="animated-button1">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Подбор багета с помощью ИИ
            </button>

        </div>
        <div class="col-6 mx-auto hidden">
            <h2 class='c1'>Просмотр в интерьере</h2>
            <?
                    if ($z[11] != 0) {
                        echo '	<a onclick="z[11]=0; rePage ();" class="t2">Убрать изображение интерьера</a>';
                    } else {
                        echo '	
                        <form id="fileform2" action="/upload2.php?id=' . implode("l", $z) . '" method="post" enctype="multipart/form-data">
                            <label class="btn btn-secondary b1">
                                <input type="file" name="filename" onchange="javascript:this.form.submit();" style="display:none;">
                                Выберите файл
                            </label>
                        </form>';
                    }
                ?>
        </div>
    </div>
    <br>

</div>