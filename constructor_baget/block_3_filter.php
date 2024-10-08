<section>
    <?
    if (isMobile()) {
        include('./constructor_baget/block_1_mobile.php');
    }
    ?>
</section>


<? if ($master || $minimaster) { ?>
    <section class='screen '>
        <div class='row justify-contant-center'>
            <div class='bg-custom-gold w1 h1 d-flex'>
            <span class='addbaget s1 align-self-center container relative razdel '
                  style="cursor:pointer;">Добавление нового багета
            </span>
            </div>
        </div>

        <div class="">
            <?
            $vendor = '';
            $width = '';
            $widthwithout = '';
            $pricenew = '';


            if (!empty($_COOKIE)) {
                if (array_key_exists('vendor', $_COOKIE) && !empty($_COOKIE['vendor'])) {
                    $vendor = $_COOKIE['vendor'];
                }
                if (array_key_exists('width', $_COOKIE) && !empty($_COOKIE['width'])) {
                    $width = $_COOKIE['width'];
                }
                if (array_key_exists('widthwithout', $_COOKIE) && !empty($_COOKIE['widthwithout'])) {
                    $widthwithout = $_COOKIE['widthwithout'];
                }
                if (array_key_exists('pricenew', $_COOKIE) && !empty($_COOKIE['pricenew'])) {
                    $pricenew = $_COOKIE['pricenew'];
                }
            }

            ?>

            <div class="form mb-50" <? if (!empty($_COOKIE['vendor'])) {
                echo "style='display:block;'";
            } ?>>
                <div class="formsection">
                    Тип багета:<br>
                    <select id="bagettype" name="bagettype">
                        <option value="plast">Пластик</option>
                        <option value="wood">Дерево</option>
                        <option value="alum">Алюминий</option>
                    </select>
                </div>
                <div>
                    Артикул поставщика<br>
                    <input type="text" name="vendor"
                           value="<?= $vendor ?>">
                </div>
                <div class="formsection">
                    <b>Картинка для рамы</b><br>

                    <? if (!isset($_COOKIE['catalogfile']) || $_COOKIE['catalogfile'] == '' || $_COOKIE['calcfile'] == '') { ?>

                        <input type="file" id='img-first' name="catalogfile" accept=".jpg, .jpeg, .png, .JPG">

                    <? } else { ?>
                        <b style="color: green">Файл выбран</b><br>
                        Заменить: <input type="file" id='img-first' name="catalogfile" accept=".jpg, .jpeg, .png, .JPG"
                                         style="width: 47%;">
                    <? } ?>
                </div>

                <div class="formsection">
                    <b>Картинка для каталога</b><br>
                    <? if (!isset($_COOKIE['calcfile']) || $_COOKIE['catalogfile'] == '' || $_COOKIE['calcfile'] == '') { ?>
                        <input type="file" name="calcfile" id='img-second' accept=".jpg, .jpeg, .png, .JPG">
                    <? } else { ?>
                        <b style="color: green">Файл выбран</b><br>
                        Заменить: <input type="file" id='img-second' name="calcfile" accept=".jpg, .jpeg, .png, .JPG"
                                         style="width: 47%;">
                    <? } ?>
                </div>

                <div class="formsection">
                    <div
                            style=" position:relative; float:left; margin-bottom:10px;  width: calc(30% - 3px);margin-right: 7px;">
                        Ширина<br>
                        <input type="text" name="width"
                               value="<?= $width ?>">
                    </div>

                    <div
                            style=" position:relative; float:left; margin-bottom:10px;width: calc(30% - 3px);margin-right: 7px;">
                        Без четв.
                        <input type="text" name="widthwithout"
                               value="<?= $widthwithout ?>">
                    </div>
                    <div style=" position:relative; float:left; margin-bottom:10px;width: calc(31%);">
                        Цена закуп.
                        <input type="text" name="pricenew"
                               value="<?= $pricenew ?>">
                    </div>
                </div>
                <span class="upload_files">Примерить</span>
                <span class="addnewbaget" onclick="addnewbaget();">Добавить</span>
                <span class="reset" onclick="reset();">Сброс</span>
            </div>
            <div class="newbgt" style="display: none;">
                <div class="maskimg">
                    <img src="<?= $_COOKIE['calcfile'] ?>" align="left" class="bmenuimg">
                </div>
                <b class="vendor">
                    Арт. <span class="vendor"><?= $vendor ?></span></b><br>
                Ширина: <span class="width"><?= $width ?></span> мм<br>
                Без четверти: <span class="widthwithout"><?= $widthwithout ?></span> мм<br>
                <span class="pricenew" style="font-size:125%;"><?= $pricenew ?></span>р.<br>
                <div class="nalich2">есть в наличии</div>
            </div>

        </div>
    </section>
<? } ?>


<section class='screen size-img'>
    <form id="form" name="form" onsubmit="return false;">
        <div class='row justify-contant-center'>
            <div class='bg-custom-gold w1 h1 d-flex'>
                <span class='s1 align-self-center container relative razdel element-animation'>1. Укажите размеры изображения
                    <span class='img-active-block-mobile close-block <? if (!isMobile()) {
                        echo ' hidden';
                    } ?>'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                            <path
                                    d="M10.6647 9.82289C10.9401 9.80288 11.1472 9.56339 11.1272 9.28797L10.8011 4.7998C10.7811 4.52439 10.5416 4.31734 10.2662 4.33735C9.99076 4.35736 9.78372 4.59685 9.80373 4.87226L10.0936 8.86175L6.10408 9.15159C5.82866 9.1716 5.62161 9.41109 5.64162 9.6865C5.66163 9.96192 5.90112 10.169 6.17654 10.149L10.6647 9.82289ZM0.672994 1.37824L10.3015 9.70245L10.9555 8.94596L1.32701 0.621758L0.672994 1.37824Z"
                                    fill="#474A51"/>
                        </svg>
                    </span>

                    <span class='img-active-block-mobile open-block hidden'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                            <path
                                    d="M10.6647 0.501328C10.9401 0.521338 11.1472 0.760828 11.1272 1.03624L10.8011 5.52442C10.7811 5.79983 10.5416 6.00688 10.2662 5.98687C9.99076 5.96686 9.78372 5.72737 9.80373 5.45196L10.0936 1.46247L6.10408 1.17263C5.82866 1.15262 5.62161 0.913132 5.64162 0.637716C5.66163 0.362299 5.90112 0.155251 6.17654 0.17526L10.6647 0.501328ZM0.672994 8.94598L10.3015 0.621772L10.9555 1.37826L1.32701 9.70246L0.672994 8.94598Z"
                                    fill="#474A51"/>
                        </svg>
                    </span>
                </span>
            </div>
        </div>
        <div class='container my-2 content <? if (isMobile()) {
            echo ' hidden';
        } ?>'>
            <div class='row  justify-contant-center '>
                <!--div class='col-4 col-lg-3 col-xxl-2'>
                    <div class="p2">
                        <span class='s2 text-nowrap'>Ширина (мм)</span>
                    </div>
                </div-->
                <div class='col-3 col-md-3 col-xxl-3'>
                    <div class="mb-3 mx-auto">
                        <input type="number" class="i1 form-control" id="fwid" name="fwid" aria-describedby="emailHelp"
                               value="<?= $z[9] ?>" onchange="changesize(9);countprice ();">
                        <div id="emailHelp" class="form-text">Ширина (мм)</div>
                    </div>
                </div>
                <div class='col-1 col-md-1 col-xxl-1 '>
                    <div class="mb-3 ">
                        <img alt="Refresh Cw Alt 4 SVG Vector Icon" fetchpriority="high" width="30" height="30"
                             decoding="async" data-nimg="1" src="/constructor_baget/refresh-cw-alt-4-svgrepo-com.svg"
                             style="color: transparent; cursor: pointer" class="mx-auto" id="refresh-size">
                    </div>
                </div>

                <div class='col-3 col-md-3 col-xxl-3'>
                    <div class="mb-3">
                        <input type="number" class="i1 form-control" id="fhig" name="fhig" aria-describedby="emailHelp"
                               value="<?= $z[10] ?>" onchange="changesize(10);countprice ();">
                        <div id="emailHelp" class="form-text">Высота (мм)</div>
                    </div>
                </div>
                <div class='col-4 col-md-4 col-xxl-3'>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-secondary b1">Применить</button>

                    </div>
                </div>
            </div>


        </div>
    </form>
</section>

<section class='screen baget-and-paspartu'>
    <div class='row justify-contant-center'>
        <div class='bg-custom-gold w1 h1 d-flex'>
            <span class='s1 align-self-center container relative razdel element-animation'>2. Выберете багет и паспарту
                <span class='text-end img-active-block-mobile close-block <? if (!isMobile()) {
                    echo ' hidden';
                } ?>'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                        <path
                                d="M10.6647 9.82289C10.9401 9.80288 11.1472 9.56339 11.1272 9.28797L10.8011 4.7998C10.7811 4.52439 10.5416 4.31734 10.2662 4.33735C9.99076 4.35736 9.78372 4.59685 9.80373 4.87226L10.0936 8.86175L6.10408 9.15159C5.82866 9.1716 5.62161 9.41109 5.64162 9.6865C5.66163 9.96192 5.90112 10.169 6.17654 10.149L10.6647 9.82289ZM0.672994 1.37824L10.3015 9.70245L10.9555 8.94596L1.32701 0.621758L0.672994 1.37824Z"
                                fill="#474A51"/>
                    </svg>
                </span>
                <span class='img-active-block-mobile open-block hidden'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                        <path
                                d="M10.6647 0.501328C10.9401 0.521338 11.1472 0.760828 11.1272 1.03624L10.8011 5.52442C10.7811 5.79983 10.5416 6.00688 10.2662 5.98687C9.99076 5.96686 9.78372 5.72737 9.80373 5.45196L10.0936 1.46247L6.10408 1.17263C5.82866 1.15262 5.62161 0.913132 5.64162 0.637716C5.66163 0.362299 5.90112 0.155251 6.17654 0.17526L10.6647 0.501328ZM0.672994 8.94598L10.3015 0.621772L10.9555 1.37826L1.32701 9.70246L0.672994 8.94598Z"
                                fill="#474A51"/>
                    </svg>
                </span>
            </span>

        </div>
    </div>

    <div class='container my-2 content <? if (isMobile()) {
        echo ' hidden';
    } ?>'>
        <div class='row  justify-contant-center'>
            <div class='col-3 col-md-2'>
                <div class="p2 my-2">
                    <span class='s2 my-2'>Багет</span>
                </div>
            </div>
            <div class='col-9 col-md-8'>
                <button type="button" class="bmenu-type btn b2 my-2 clear-baget-conteiner" id='get-catalog-plast'
                        onclick="getcatalog('plast');">Пластик
                </button>
                <button type="button" class="bmenu-type btn b2 my-2 clear-baget-conteiner" id='get-catalog-wood'
                        onclick="getcatalog('wood');">Дерево
                </button>
                <button type="button" class="bmenu-type btn b2 my-2 clear-baget-conteiner" id='get-catalog-alum'
                        onclick="getcatalog('alum');">Алюминий
                </button>
            </div>
        </div>

        <div class='row my-2'>
            <div class="" id="blockarticul" <? if ($z[0] <> 0 && $z[0] <> 7233) { ?> style="display:block;"
            <? } else { ?> style="display: none"
            <? } ?>>
                <div class='row py-2'>
                    <div class='col-6 col-md-4'>
                        <span class="s2">Выбранный артикул: </span><span id="articul" class="s3"><?= $z[0] ?></span>
                    </div>
                    <div class='col-6 col-md-4'>
                        <span class="s2">Стоимость: </span><span id="price1" class="s3"></span><span class='s3'>
                                ₽</span>
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
                <button type="button" class="bmenu-type choice-pasp btn btn-secondary b1 w120" id='get-catalog-pasp'
                        onclick="getcatalog('pasp');" style='color:white;'>Выбрать
                </button>
                <button type="button" class="t2 close-pasp-block btn btn-secondary b1 w120"
                        onclick="z[3]=0; z[4]=0; z[5]=0; changesize(); countprice ();">убрать
                </button>
            </div>
        </div>

        <div class='row'>
            <div class="pasp-block my-1" id="blockarticul2" <? if ($z[3] <> 0) { ?>style="display:block;"
                <? } ?>>
                <div class='row'>
                    <div class='col-4'>
                        <span class="s2">Выбранный артикул: </span><span id="articul2" class="s3"><?= $z[3] ?></span>
                    </div>
                    <div class='col-4'>
                        <span class="s2">Стоимость: </span><span id="price2" class="s3"></span><span class='s3'>
                            ₽</span>
                    </div>
                </div>
            </div>

            <div class="pasp-block my-2" <? if ($z[3] != 0) { ?> style="display:block;"
            <? } ?>>
                <form id="form2" name="form2" onsubmit="return false;">
                    <span class="s2">Ширина поля (мм): </span>

                    <input type="number" id="fpasp" name="fpasp" onchange="changesize(); countprice ();"
                           value="<?= $z[5] ?>" autocomplete="off">

                    <button type="button" class="t2 btn btn-secondary b1 w120">Применить</button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class='screen steclo-and-zad'>
    <div class='row justify-contant-center'>
        <div class='bg-custom-gold w1 h1 d-flex'>
            <span class='s1 align-self-center container relative razdel element-animation'>3. Выберите стекло и задник
                <span class='img-active-block-mobile close-block <? if (!isMobile()) {
                    echo ' hidden';
                } ?>'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                        <path
                                d="M10.6647 9.82289C10.9401 9.80288 11.1472 9.56339 11.1272 9.28797L10.8011 4.7998C10.7811 4.52439 10.5416 4.31734 10.2662 4.33735C9.99076 4.35736 9.78372 4.59685 9.80373 4.87226L10.0936 8.86175L6.10408 9.15159C5.82866 9.1716 5.62161 9.41109 5.64162 9.6865C5.66163 9.96192 5.90112 10.169 6.17654 10.149L10.6647 9.82289ZM0.672994 1.37824L10.3015 9.70245L10.9555 8.94596L1.32701 0.621758L0.672994 1.37824Z"
                                fill="#474A51"/>
                    </svg>
                </span>
                <span class='img-active-block-mobile open-block hidden'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
                        <path
                                d="M10.6647 0.501328C10.9401 0.521338 11.1472 0.760828 11.1272 1.03624L10.8011 5.52442C10.7811 5.79983 10.5416 6.00688 10.2662 5.98687C9.99076 5.96686 9.78372 5.72737 9.80373 5.45196L10.0936 1.46247L6.10408 1.17263C5.82866 1.15262 5.62161 0.913132 5.64162 0.637716C5.66163 0.362299 5.90112 0.155251 6.17654 0.17526L10.6647 0.501328ZM0.672994 8.94598L10.3015 0.621772L10.9555 1.37826L1.32701 9.70246L0.672994 8.94598Z"
                                fill="#474A51"/>
                    </svg>
                </span>
            </span>
        </div>
    </div>
    <style>
        .custom-selected-border {
            border: 2px solid red !important;
        }
    </style>
    <div class='container my-2 content <? if (isMobile()) {
        echo ' hidden';
    } ?>'>
        <div class='row  justify-contant-center'>
            <div class=' col-3 col-md-2'>
                <div class="p2 my-2">
                    <span class='s2 '>Стекло</span>
                </div>
            </div>
            <div class='col-9 col-md-8 custom-selected'>
                <button type="button" class="btn b2 my-2 <? if ($z[6] == 1) {
                    echo 'custom-selected-border';
                } ?>" onclick="z[6]=1; bgswitch();">Обычное
                </button>
                <button type="button" class="btn b2 my-2 <? if ($z[6] == 2) {
                    echo 'custom-selected-border';
                } ?>" onclick="z[6]=2; bgswitch();">Матовое
                </button>
                <button type="button" class="btn b2 my-2 <? if ($z[6] == 3) {
                    echo 'custom-selected-border';
                } ?>" onclick="z[6]=3; bgswitch();">Антиблик
                </button>
                <button type="button" class="btn b2 my-2 <? if ($z[6] == 4) {
                    echo 'custom-selected-border';
                } ?>" onclick="z[6]=4; bgswitch();">Пластиковое
                </button>
                <button type="button" class="btn btn-secondary b1 w120  custom-selected-clear"
                        onclick="z[6]=0; bgswitch();">убрать
                </button>
            </div>
        </div>

        <div class='row'>
            <span class="s2">Стоимость: <span id="price3" class="s3">0</span></span>
        </div>

        <div class='row justify-contant-center my-2 pt-4'>
            <div class=' col-3 col-md-2'>
                <div class="p2 my-2">
                    <span class='s2'>Задник</span>
                </div>
            </div>
            <div class='col-9 col-md-8 custom-selected'>
                <button type="button" class="btn b2 my-2 <? if ($z[7] == 1) {
                    echo 'custom-selected-border';
                } ?>" onclick="z[7]=1; bgswitch();">Картон
                </button>
                <button type="button" class="btn b2 my-2 w176 <? if ($z[7] == 2) {
                    echo 'custom-selected-border';
                } ?>" onclick="z[7]=2; bgswitch();">Пенокартон 5 мм
                </button>
                <button type="button" class="btn b2 my-2 w176 <? if ($z[7] == 3) {
                    echo 'custom-selected-border';
                } ?>" onclick="z[7]=3; bgswitch();">Натяжка вышивки
                </button>
                <button type="button" class="btn b2 my-2 <? if ($z[7] == 4) {
                    echo 'custom-selected-border';
                } ?>" onclick="z[7]=4; bgswitch();">Подрамник
                </button>
                <button type="button" class="btn btn-secondary b1 w120 custom-selected-clear"
                        onclick="z[7]=0; bgswitch();">убрать
                </button>
            </div>
        </div>

        <div class='row'>
            <span class="s2">Стоимость: <span id="price4" class="s3">0</span></span>
        </div>
    </div>
</section>

<section class='screen itogo bg-custom-gold-itogo'>
    <div class='container my-2'>
        <div class='row text-center justify-contant-center block-itogo'>
            <span class='s-itogo'>Итоговая стоимость: <span class='s-itogo-price' id="price0">0</span><span
                        class='s-itogo-price'> ₽</span></span>
        </div>

        <? if ($master && false == true) {
            echo '	<hr>
			<div style="width:250px; position:relative; float:left;">Отдельные услуги: <b id="price7">0</b> р.<br>
				<a id="sw170" class="t2" onclick="z[17]=0; bgswitch()">Нет</a><br>
				<a id="sw171" class="t2" onclick="z[17]=1; bgswitch()">П/К 5мм</a> |
				<a id="sw1711" class="t2" onclick="z[17]=11; bgswitch()">П/К 10мм</a> |
				<a id="sw172" class="t2" onclick="z[17]=2; bgswitch()">Натяжка</a><br>
				<a id="sw173" class="t2" onclick="z[17]=3; bgswitch()">Холст</a> |
				<a id="sw174" class="t2" onclick="z[17]=4; bgswitch()">Матовая</a> |
				<a id="sw175" class="t2" onclick="z[17]=5; bgswitch()">Глянец</a> |
				<a id="sw176" class="t2" onclick="z[17]=6; bgswitch()">Лак</a><br>
				<a id="sw178" class="t2" onclick="z[17]=810; bgswitch()">Обычное зеркало</a> |
				<a id="sw179" class="t2" onclick="z[17]=910; bgswitch()">Clear Vision</a><br>
				<span id="zerk" style="display:none;">
					<a id="sw1781" class="t2" onclick="var zs=String(z[17]); z[17]=zs.charAt(0)+1+zs.charAt(2); bgswitch()">4мм</a> |
					<a id="sw1782" class="t2" onclick="var zs=String(z[17]); z[17]=zs.charAt(0)+2+zs.charAt(2); bgswitch()">6мм</a> ||
					<a id="sw17810" class="t2" onclick="var zs=String(z[17]); z[17]=zs.charAt(0)+zs.charAt(1)+0; bgswitch()">нет</a> |
					<a id="sw17811" class="t2" onclick="var zs=String(z[17]); z[17]=zs.charAt(0)+zs.charAt(1)+1; bgswitch()">10</a> |
					<a id="sw17812" class="t2" onclick="var zs=String(z[17]); z[17]=zs.charAt(0)+zs.charAt(1)+2; bgswitch()">20</a> |
					<a id="sw17813" class="t2" onclick="var zs=String(z[17]); z[17]=zs.charAt(0)+zs.charAt(1)+3; bgswitch()">30</a> |
					<a id="sw17814" class="t2" onclick="var zs=String(z[17]); z[17]=zs.charAt(0)+zs.charAt(1)+4; bgswitch()">40</a><br>
				</span>

				<a id="sw177" class="t2" onclick="z[17]=7; bgswitch()">Доставка</a>
				<form id="form3" name="form3" onsubmit="return false;">
					<div id="dostavk" style="display:none;">
						<input type="text" id="deliv" name="deliv" onchange="countprice();" value="' . $z[18] . '" style="height:20px; width:50px;" autocomplete="off">км.
					</div>
				</form>
			</div>';
        }
        ?>
        <div class='row text-center my-3'>
            <span class='s1'>Сборка рамы: <span id="price6" class='s3'></span></span>
        </div>

        <div class='row  my-3 d-flex align-self-center'>
            <div class='col-3 col-md-4 '>
                <div class="p2 text-end">
                    <span class='s2'>Промокод:</span>
                </div>
            </div>
            <div class='col-4 col-md-3'>
                <input id="promo_kod" type="text" class="i-promo"/>
            </div>
            <div class='col-5 col-md-4'>
                <button type="button" class="btn btn-secondary b1 w120" id="get-info-promo-kods">Применить</button>
            </div>
        </div>

        <div class="row text-center">
            <span id="info-promokod" class="s3"></span>
        </div>

        <br>

        <div class='row justify-contant-center text-center mx-auto element-animation'>
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

<script>
    $(document).ready(function () {
        $(document).on('click', '.custom-selected .b2', function () {
            console.log(123);
            let parent = $(this).parent();
            let butSelected = parent.find('.custom-selected-border');
            butSelected.removeClass('custom-selected-border');
            $(this).addClass('custom-selected-border')
        })

        $(document).on('click', '.custom-selected .custom-selected-clear', function () {
            let parent = $(this).parent();
            let butSelected = parent.find('.custom-selected-border');
            butSelected.removeClass('custom-selected-border');
        })
        $(document).on('click', '#refresh-size', function () {
            let width = $('#fwid').val()
            let hight = $('#fhig').val()

            $('#fwid').val(hight);
            $('#fhig').val(width);

            changesize();
            rePage();
        })
    })
</script>
<? if (isMobile()) { ?>
    <script>
        $(document).on('click', '.razdel', function () {
            let blockClose = $(this).find('.close-block')
            let blockOpen = $(this).find('.open-block')
            let section = $(this).parent().parent().parent()
            let blockContent = section.find('.content')

            if (blockClose.hasClass('hidden')) {
                blockClose.removeClass('hidden')
                blockOpen.addClass('hidden')
                blockContent.addClass('hidden')
            } else {
                blockClose.addClass('hidden')
                blockOpen.removeClass('hidden')
                blockContent.removeClass('hidden')
            }
        })

    </script>
<? } ?>