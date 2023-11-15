<!-- Modal обратная связь -->
<div class="modal fade" id="gameModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?

                if (isset($_COOKIE['skidkod'])) {
                    $skidkod = $_COOKIE['skidkod'];
                } else {
                    $skidkod = false;
                }

                    if ($skidkod) {
                        echo "
                        <div id='game15' class='game15end row text-center'><div>Ваш код: <b>" . $skidkod . "</b>
                        <br>Сообщите его менеджеру при оформлении заказа и получите скидку.
                        <br>Код действителен в течение суток.</div></div>
                    ";
                    } else {
                        echo "
                        <div id='game15' class='game15start row text-center' onselectstart='return false;'>
                        <div onmousedown='game15start(this);'>Сыграйте в \"пятнашки\"
                        <div>чтобы получить сегодня скидку 10%</div>на любой ваш заказ.
                        
                        <div><button class='button button-custom-index button-color-company-golden '>Нажмите чтобы начать</button></div>
                        </div></div>
                        ";
                    }

                if (!empty($disco)) {
                    echo "<a href='/#game15' id='discount' class='discou1' onclick='this.className=\"discou1\";'></a>";
                }
                ?>
            </div>
        </div>
    </div>
</div>


<script>
    function getXmlHttp() {
        var xmlhttp;
        try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (E) {
                xmlhttp = false;
            }
        }
        if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
            xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
    }
    function loadJS(whatFile, whereToPut) {
        var link = document.createElement("script");
        link.setAttribute("type", "text/javascript");
        link.setAttribute("src", whatFile);
        if (whereToPut) {
            whereToPut.appendChild(link);
            whereToPut.onclick = function() {
                return;
            }
        } else {
            document.getElementsByTagName("head")[0].appendChild(link);
        }
    }
    function game15start(id) {
        loadJS('game15.js?v<?=$v?>');
        id.onclick = function() {
            return;
        }
    }
</script>

