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
                <span class='s1 align-self-center container relative razdel'>1. Укажите размеры изображения
                    <span class='img-active-block-mobile close-block <? if (!isMobile()) { echo 'hidden'; } ?>'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                            <path d="M10.6647 9.82289C10.9401 9.80288 11.1472 9.56339 11.1272 9.28797L10.8011 4.7998C10.7811 4.52439 10.5416 4.31734 10.2662 4.33735C9.99076 4.35736 9.78372 4.59685 9.80373 4.87226L10.0936 8.86175L6.10408 9.15159C5.82866 9.1716 5.62161 9.41109 5.64162 9.6865C5.66163 9.96192 5.90112 10.169 6.17654 10.149L10.6647 9.82289ZM0.672994 1.37824L10.3015 9.70245L10.9555 8.94596L1.32701 0.621758L0.672994 1.37824Z" fill="#474A51"/>
                        </svg>
                    </span>
                    <span class='img-active-block-mobile open-block hidden'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                            <path d="M10.6647 0.501328C10.9401 0.521338 11.1472 0.760828 11.1272 1.03624L10.8011 5.52442C10.7811 5.79983 10.5416 6.00688 10.2662 5.98687C9.99076 5.96686 9.78372 5.72737 9.80373 5.45196L10.0936 1.46247L6.10408 1.17263C5.82866 1.15262 5.62161 0.913132 5.64162 0.637716C5.66163 0.362299 5.90112 0.155251 6.17654 0.17526L10.6647 0.501328ZM0.672994 8.94598L10.3015 0.621772L10.9555 1.37826L1.32701 9.70246L0.672994 8.94598Z" fill="#474A51"/>
                        </svg>
                    </span>
                </span>
            </div>
        </div>
        <div class='container my-2 content <? if (isMobile()) { echo 'hidden'; } ?>'>
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
            <span class='s1 align-self-center container relative razdel'>2. Выберете багет и паспарту
                <span class='text-end img-active-block-mobile close-block <? if (!isMobile()) { echo 'hidden'; } ?>'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                        <path d="M10.6647 9.82289C10.9401 9.80288 11.1472 9.56339 11.1272 9.28797L10.8011 4.7998C10.7811 4.52439 10.5416 4.31734 10.2662 4.33735C9.99076 4.35736 9.78372 4.59685 9.80373 4.87226L10.0936 8.86175L6.10408 9.15159C5.82866 9.1716 5.62161 9.41109 5.64162 9.6865C5.66163 9.96192 5.90112 10.169 6.17654 10.149L10.6647 9.82289ZM0.672994 1.37824L10.3015 9.70245L10.9555 8.94596L1.32701 0.621758L0.672994 1.37824Z" fill="#474A51"/>
                    </svg>
                </span>
                <span class='img-active-block-mobile open-block hidden'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                        <path d="M10.6647 0.501328C10.9401 0.521338 11.1472 0.760828 11.1272 1.03624L10.8011 5.52442C10.7811 5.79983 10.5416 6.00688 10.2662 5.98687C9.99076 5.96686 9.78372 5.72737 9.80373 5.45196L10.0936 1.46247L6.10408 1.17263C5.82866 1.15262 5.62161 0.913132 5.64162 0.637716C5.66163 0.362299 5.90112 0.155251 6.17654 0.17526L10.6647 0.501328ZM0.672994 8.94598L10.3015 0.621772L10.9555 1.37826L1.32701 9.70246L0.672994 8.94598Z" fill="#474A51"/>
                    </svg>
                </span>
            </span>

        </div>
    </div>

    <div class='container my-2 content <? if (isMobile()) { echo 'hidden'; } ?>'>
        <div class='row  justify-contant-center'>
            <div class='col-3 col-md-2'>
                <div class="p2 my-2">
                    <span class='s2 my-2'>Багет</span>
                </div>
            </div>
            <div class='col-9 col-md-8'>
                <button type="button" class="bmenu-type btn b2 my-2" id='get-catalog-plast' onclick="getcatalog('plast');">Пластик</button>
                <button type="button" class="bmenu-type btn b2 my-2" id='get-catalog-wood' onclick="getcatalog('wood');">Дерево</button>
                <button type="button" class="bmenu-type btn b2 my-2" id='get-catalog-alum' onclick="getcatalog('alum');">Аллюминий</button>
            </div>
        </div>

        <div class='row my-2'>
            <div class="" id="blockarticul"  <? if ($z[0] <> 0 && $z[0] <> 7233) {?> style="display:block;" <? } else{ ?> style="display: none" <?} ?>>
            <div class='row'>
                <div class='col-6 col-md-4'>
                    <span class="s2">Выбранный артикул: </span><span id="articul" class="s3"><?= $z[0] ?></span>
                </div>
                <div class='col-6 col-md-4'>
                    <span class="s2">Стоимость: </span><span id="price1" class="s3"></span><span class='s3'> ₽</span>
                </div>
            </div>
            </div>
        </div>

        <div class='row justify-contant-center my-2'>
            <div class='col-3 col-md-2'>
                <div class="p2">
                    <span class='s2'>Паспарту</span>
                </div>
            </div>
            <div class='col-9 col-md-10'>
                <button type="button" class="bmenu-type choice-pasp btn btn-secondary b1 w120"  id='get-catalog-pasp' onclick="getcatalog('pasp');">Выбрать</button>
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
            <span class='s1 align-self-center container relative razdel'>3. Выберите стекло и задник
                <span class='img-active-block-mobile close-block <? if (!isMobile()) { echo 'hidden'; } ?>'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                        <path d="M10.6647 9.82289C10.9401 9.80288 11.1472 9.56339 11.1272 9.28797L10.8011 4.7998C10.7811 4.52439 10.5416 4.31734 10.2662 4.33735C9.99076 4.35736 9.78372 4.59685 9.80373 4.87226L10.0936 8.86175L6.10408 9.15159C5.82866 9.1716 5.62161 9.41109 5.64162 9.6865C5.66163 9.96192 5.90112 10.169 6.17654 10.149L10.6647 9.82289ZM0.672994 1.37824L10.3015 9.70245L10.9555 8.94596L1.32701 0.621758L0.672994 1.37824Z" fill="#474A51"/>
                    </svg>
                </span>
                <span class='img-active-block-mobile open-block hidden'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                        <path d="M10.6647 0.501328C10.9401 0.521338 11.1472 0.760828 11.1272 1.03624L10.8011 5.52442C10.7811 5.79983 10.5416 6.00688 10.2662 5.98687C9.99076 5.96686 9.78372 5.72737 9.80373 5.45196L10.0936 1.46247L6.10408 1.17263C5.82866 1.15262 5.62161 0.913132 5.64162 0.637716C5.66163 0.362299 5.90112 0.155251 6.17654 0.17526L10.6647 0.501328ZM0.672994 8.94598L10.3015 0.621772L10.9555 1.37826L1.32701 9.70246L0.672994 8.94598Z" fill="#474A51"/>
                    </svg>
                </span>
            </span>
        </div>
    </div>
    <div class='container my-2 content <? if (isMobile()) { echo 'hidden'; } ?>'>
        <div class='row  justify-contant-center'>
            <div class=' col-3 col-md-2'>
                <div class="p2 my-2">
                    <span class='s2 '>Стекло</span>
                </div>
            </div>
            <div class='col-9 col-md-8'>
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
            <div class=' col-3 col-md-2'>
                <div class="p2 my-2">
                    <span class='s2'>Задник</span>
                </div>
            </div>
            <div class='col-9 col-md-8'>
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
            <div class='col-3 col-md-4 '>
                <div class="p2 text-end">
                    <span class='s2'>Промокод:</span>
                </div>
            </div>
            <div class='col-5 col-md-3'>
                <input id="promo_kod" type="text" class="i-promo" />
            </div>
            <div class='col-3 col-md-4'>
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


<? if (isMobile()) {  ?>
    <script>
        $(document).on('click', '.razdel', function(){
            let blockClose = $(this).find('.close-block')
            let blockOpen = $(this).find('.open-block')
            let section = $(this).parent().parent().parent()
            let blockContent = section.find('.content')

            if (blockClose.hasClass('hidden')){
                blockClose.removeClass('hidden')
                blockOpen.addClass('hidden')
                blockContent.addClass('hidden')
            }else{
                blockClose.addClass('hidden')
                blockOpen.removeClass('hidden')
                blockContent.removeClass('hidden')
            }
        })
    </script>
<? } ?>