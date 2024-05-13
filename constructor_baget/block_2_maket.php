<div class="position-relative custom-height-block-1" id='block-orient-width'>
    <div class='position-absolute' style="top:10px">

        <img src="/img/2.png" alt="" style='
							width:20%;
							display: none;
						' class='img-custom' id='img-custom'>

        <div id='bagcont'>

            <?
            $stmt = $dbh->prepare("SELECT listimg FROM catalog_baget WHERE publicvendor=?");
            $stmt->bindParam(1, $z[3]);
            $stmt->execute();
            $data = $stmt->fetchAll();
            ?>

            <div id='bgpass' class='baganim' style="background: url('pi/<?= $data[0]['listimg'] ?>');">
            </div>
            <div id='bgcenter' class='baganim' style="background:url('<?= $picname ?>');"></div>
            <div id='bgtop' class='baganim' style="
            <?
            if (isset($_COOKIE['catalogfile']) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $_COOKIE['catalogfile'])) {
                echo 'background:url(/' . $_COOKIE['catalogfile'] . ') repeat-x';
            } else {
                echo 'background:url(/bi/' . $z[0] . 't.jpg) repeat-x';
            }
            ?>
                    "></div>

            <div id='bgbot' class='baganim' style="
            <?
            if (isset($_COOKIE['catalogfile']) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $_COOKIE['catalogfile'])) {
                ?>
                    background:url('/<?= $_COOKIE['catalogfile'] ?>') repeat-x;
            <? } else { ?>
                    background:url('/bi/<?= $z[0] ?>t.jpg') repeat-x;
            <? } ?>
                    "></div>

            <div id='bgrwrap' class='baganim'>
                <div id='bgright' class='baganim' style="
                <? if (isset($_COOKIE['catalogfile']) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $_COOKIE['catalogfile'])) { ?>
                        background:url('/<?= $_COOKIE['catalogfile'] ?>') repeat-x;
                <? } else { ?>
                        background:url('/bi/<?= $z[0] ?>t.jpg') repeat-x;
                <? } ?>
                        ">
                </div>
            </div>

            <div id='bglwrap' class='baganim'>
                <div id='bgleft' class='baganim' style="
                <? if (isset($_COOKIE['catalogfile']) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $_COOKIE['catalogfile'])) { ?>
                        background:url('/<?= $_COOKIE['catalogfile'] ?>') repeat-x;
                <? } else { ?>
                        background:url('/bi/<?= $z[0] ?>t.jpg') repeat-x;
                <? } ?>
                        ">
                </div>
            </div>

            <?
            if ($z[11] != 0) {
                echo "
										<div id=\"resizec\"></div>
										<div id=\"resizerb\"></div>
										<div id=\"resizelt\"></div>
										<div id=\"resizelb\"></div>
										<div id=\"resizert\"></div>
									</div>
								";
            } else {
                echo "
											<div class='baganim sizey' id='sizey'></div>
											<div class='baganim sizex' id='sizex'></div>
										</div>
									";
            }
            ?>
        </div>


        <div class="layer"></div>
    </div>
