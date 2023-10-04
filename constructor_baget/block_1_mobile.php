<div class="">
    <br><br>
    <div class='row text-center justify-content-center'>
        <div class="col-6 ms-auto" style="padding:5px; padding-left: 10px;">

            <?
                    if ($z[8] != 0) {
                        [$width, $height] = getimagesize($picname);
                        echo '	<div><strong style="font-size: 14px;">Обратите внимание</strong></div>
                        <div><span style="font-size: 12px;">Печать изображения не входит в стоимость заказа</span></div>
                        <a onclick="z[8]=0; rePage ();" class="t2 " style="font-size: 12px; color: #ad1f2d">Убрать изображение картины</a>';
                    } else {
                        echo '
                        <form id="fileform" action="/upload.php?id=' . implode("l", $z) . '" method="post" enctype="multipart/form-data">
                        <h2 class="c1">Примерить картину к багету</h2>
                            <label class="btn btn-secondary b1" style="height:auto !important;">
                                <input type="file" name="filename"  onchange="javascript:this.form.submit();" style="display:none; height:auto !important;">
                                Выберите файл
                            </label>
                        </form>';
                    }
                ?>
        </div>
        <div class="col-6 mx-auto" style="padding: 5px !important;">
            <button class="animated-button1" style="font-size: 8px; padding: 5px; margin: 0px; margin-right: 10px">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Подбираем  багетную рамку с
                Искусственным интеллектом
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