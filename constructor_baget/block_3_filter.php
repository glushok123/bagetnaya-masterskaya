<section>
    <? 
        if (isMobile()) {
            include('./constructor_baget/block_1_mobile.php');
        } 
    ?>
</section>

<section class='screen size-img'>
    <form id="form" name="form" onsubmit="return false;">
        <div class='row justify-contant-center' >
            <div class='bg-custom-gold w1 h1 d-flex'>
                <span class='s1 align-self-center container'>1. Укажите размеры изображения</span>
            </div>
        </div>
        
        <div class='container my-2'>
            <div class='row  justify-contant-center'>
                <div class='col-4 col-lg-3 col-xxl-2'>
                    <div class="p2">
                        <span class='s2 text-nowrap'>Ширина (мм)</span>
                    </div>
                </div>
                <div class='col-4 col-lg-3 col-xxl-3'>
                        <input 
                            type="number" 
                            class='i1' 
                            id="fwid" 
                            name="fwid" 
                            onchange="changesize(9);countprice ();"
                            value="<?= $z[9] ?>" 
                            autocomplete="off"
                        >
                </div>
                <div class='col-4 col-lg-3 col-xxl-3'>
                        <button type="submit" class="btn btn-secondary b1">Применить</button>
                </div>
            </div>

            <div class='row justify-contant-center my-3'>
                <div class='col-4 col-lg-3 col-xxl-2'>
                    <div class="p2">
                        <span class='s2 text-nowrap'>Высота (мм)</span>
                    </div>
                </div>
                <div class='col-4 col-lg-3 col-xxl-3'>
                        <input 
                            type="number" 
                            class='i1' 
                            id="fhig" 
                            name="fhig"
                            onchange="changesize(10);countprice ();" 
                            value="<?= $z[10] ?>"
                            autocomplete="off"
                        >
                </div>
                <div class='col-4 col-lg-3 col-xxl-3'>
                        <button type="submit" class="btn btn-secondary b1">Применить</button>
                </div>
            </div>
        </div>
    </form>
</section>

<section class='screen baget-and-paspartu'>
    <div class='row justify-contant-center' >
        <div class='bg-custom-gold w1 h1 d-flex'>
            <span class='s1 align-self-center container'>2. Выберете багет и паспарту</span>
        </div>
    </div>

    <div class='container my-2'>
        <div class='row  justify-contant-center'>
            <div class='col-2'>
                <div class="p2">
                    <span class='s2 '>Багет</span>
                </div>
            </div>
            <div class='col-8'>
                <button type="button" class="bmenu-type btn b2" onclick="getcatalog('plast');">Пластик</button>
                <button type="button" class="bmenu-type btn b2" onclick="getcatalog('wood');">Дерево</button>
                <button type="button" class="bmenu-type btn b2" onclick="getcatalog('alum');">Аллюминий</button>
            </div>
        </div>

        <div class='row my-2'>
            <div class="" id="blockarticul"  <? if ($z[0] <> 0 && $z[0] <> 7233) {?> style="display:block;" <? } else{ ?> style="display: none" <?} ?>>
            <div class='row'>
                <div class='col-4'>
                    <span class="s2">Выбранный артикул: </span><span id="articul" class="s3"><?= $z[0] ?></span>
                </div>
                <div class='col-4'>
                    <span class="s2">Стоимость: </span><span id="price1" class="s3"></span><span class='s3'> ₽</span>
                </div>
            </div>
            </div>
        </div>

        <div class='row justify-contant-center my-3'>
            <div class='col-2'>
                <div class="p2">
                    <span class='s2'>Паспарту</span>
                </div>
            </div>
            <div class='col-10'>
                <button type="button" class="bmenu-type choice-pasp btn btn-secondary b1 w120" onclick="getcatalog('pasp');">Выбрать</button>
                <button type="button" class="t2 close-pasp-block btn btn-secondary b1 w120" onclick="z[3]=0; z[4]=0; z[5]=0; changesize(); countprice ();">Удалить</button>
            </div>
        </div>

        <div class='row'>
            <div class="pasp-block my-1" id="blockarticul2" 
                <? if ($z[3] <> 0) { ?>style="display:block;" <? } ?>>
                <div class='row'>
                    <div class='col-4'>
                        <span class="s2">Выбранный артикул: </span><span id="articul2" class="s3" ><?= $z[3] ?></span>
                    </div>
                    <div class='col-4'>
                        <span class="s2">Стоимость: </span><span id="price2" class="s3"></span><span class='s3'> ₽</span>
                    </div>
                </div>
            </div>

            <div class="pasp-block my-2" <? if ($z[3] != 0) { ?> style="display:block;" <? } ?>>
                <form id="form2" name="form2" onsubmit="return false;">
                    <span class="s2">Размер (мм): </span>

                    <input 
                        type="number" 
                        id="fpasp" 
                        name="fpasp"
                        onchange="changesize(); countprice ();" value="<?= $z[5] ?>"
                        autocomplete="off"
                    >

                    <button type="button" class="t2 btn btn-secondary b1 w120">Применить</button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class='screen steclo-and-zad'>
    <div class='row justify-contant-center' >
        <div class='bg-custom-gold w1 h1 d-flex'>
            <span class='s1 align-self-center container'>3. Выберите стекло и задник</span>
        </div>
    </div>
    <div class='container my-2'>
        <div class='row  justify-contant-center'>
            <div class='col-2'>
                <div class="p2 my-2">
                    <span class='s2 '>Стекло</span>
                </div>
            </div>
            <div class='col-8'>
                <button type="button" class="btn b2 my-2" onclick="z[6]=1; bgswitch();">Обычное</button>
                <button type="button" class="btn b2 my-2" onclick="z[6]=2; bgswitch();">Матовое</button>
                <button type="button" class="btn b2 my-2" onclick="z[6]=3; bgswitch();">Антиблик</button>
                <button type="button" class="btn b2 my-2" onclick="z[6]=4; bgswitch();">Пластиковое</button>
                <button type="button" class="btn btn-secondary b1 w120"  onclick="z[6]=0; bgswitch();">Удалить</button>
            </div>
        </div>
        
        <div class='row'>
            <span class="s2">Стоимость:  <span id="price3" class="s3" >0</span></span>
        </div>

        <div class='row justify-contant-center my-2'>
            <div class='col-2'>
                <div class="p2 my-2">
                    <span class='s2'>Задник</span>
                </div>
            </div>
            <div class='col-8'>
                <button type="button" class="btn b2 my-2" onclick="z[7]=1; bgswitch();">Картон</button>
                <button type="button" class="btn b2 my-2 w176" onclick="z[7]=2; bgswitch();">Пенокартон 5 мм</button>
                <button type="button" class="btn b2 my-2 w176" onclick="z[7]=3; bgswitch();">Натяжка вышивки</button>
                <button type="button" class="btn b2 my-2" onclick="z[7]=4; bgswitch();">Подрамник</button>
                <button type="button" class="btn btn-secondary b1 w120" onclick="z[7]=0; bgswitch();">Удалить</button>
            </div>
        </div>

        <div class='row'>
            <span class="s2">Стоимость:  <span id="price4" class="s3" >0</span></span>
        </div>
    </div>
</section>

<section class='screen itogo bg-custom-gold-itogo'>
    <div class='container my-2'>
        <div class='row text-center justify-contant-center block-itogo'>
            <span class='s-itogo'>Итоговая стоимость: <span class='s-itogo-price' id="price0">0</span><span class='s-itogo-price'> ₽</span></span>
        </div>

        <div class='row text-center my-3'>
            <span class='s1'>Сборка рамы:  <span id="price6" class='s3'></span></span>
        </div>

        <div class='row  my-3 d-flex align-self-center'>
            <div class='col-4 '>
                <div class="p2 text-end">
                    <span class='s2'>Промокод:</span>
                </div>
            </div>
            <div class='col-3'>
                <input id="promo_kod" type="text" class="i-promo" />
            </div>
            <div class='col-4'>
                <button type="button" class="btn btn-secondary b1 w120" id="get-info-promo-kods">Применить</button>
            </div>
        </div>

        <div class="row text-center">
            <span id="info-promokod" class="s3"></span>
        </div>

        <br>

        <div class='row justify-contant-center text-center mx-auto'>
            <button class='butn b3 mx-auto' onclick="goPage(1)">Оформить заказ</button>
        </div>
    </div>
</section>

<!-- НЕ УДАЛЯТЬ -->
<table cellpadding="0" cellspacing="0" style=" display:none;" class="mx-auto">
    <tr>
        <td style="vertical-align:middle;">
            <div id="bagsidemenu">

                <div style="width:50%; position:relative; float:left; ">
                    <a id="sw60" class="t3" onclick="z[6]=0; bgswitch();">Нет</a><br>
                    <a id="sw61" class="t2" onclick="z[6]=1; bgswitch();">Обычное</a><br>
                    <a id="sw62" class="t2" onclick="z[6]=2; bgswitch();">Матовое</a><br>
                    <a id="sw63" class="t2" onclick="z[6]=3; bgswitch();">Антиблик</a><br>
                    <a id="sw64" class="t2" onclick="z[6]=4; bgswitch();">Пластиковое</a><br>
                </div>

                <div style="width:50%; position:relative; float:left; display:none;">
                    <a id="sw70" class="t3" onclick="z[7]=0; bgswitch();">Нет</a><br>
                    <a id="sw71" class="t2" onclick="z[7]=1; bgswitch();">Картон</a><br>
                    <a id="sw72" class="t2" onclick="z[7]=2; bgswitch();">Пенокартон 5мм</a><br>
                    <a id="sw73" class="t2" onclick="z[7]=3; bgswitch();">Натяжка вышивки</a><br>
                    <a id="sw74" class="t2" onclick="z[7]=4; bgswitch();">Подрамник</a><br>
                </div>
            </div>
        </td>
    </tr>
</table>