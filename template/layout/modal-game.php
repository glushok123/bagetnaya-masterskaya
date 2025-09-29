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
                        <div id='game15' class='game15end row text-center'>
                        <div class='game-head-1'>Скидка 10% Ваша!</div>
                        <div class='promo mt-2'>Промокод: <b>" . $skidkod . "</b></div>
                        <div class='text-promo mt-2'>Воспользуйтесь им в течении 24 часов, сделав заказ в конструкторе багета или сообщите менеджеру салона!</div>
                        <div class='flex-but mt-3'>
                                            <a href='/baget_online'>
                        <button
                                class='button button-custom-index button-color-company-red color-white'>
                            Конструктор багета <b>online</b></button>
                    </a>
                         <button class='button button-custom-index button-color-company-red color-white' data-bs-toggle='modal' data-bs-target='#feedbackModal'>Заявка на обратную связь</button>
                        </div>
                        </div>
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
            whereToPut.onclick = function () {
                return;
            }
        } else {
            document.getElementsByTagName("head")[0].appendChild(link);
        }
    }

    function game15start(id) {
        loadJS('game15.js?v<?=$v?>');
        id.onclick = function () {
            return;
        }
    }
</script>

<style>
    .game-head-1 {
        font-weight: bold;
        font-size: 24px;
        text-align: center;
    }

    .promo {
        font-weight: bold;
        font-size: 20px;
        text-align: center;
    }

    .text-promo {
        font-size: 16px;
        text-align: center;
    }

    .flex-but {
        display: grid;
        grid-template-columns: 1fr 1fr;
        width: 100%;
        gap: 15px;
    }
    .flex-but button{
        font-size: 14px !important;
        width: 100%;
    }
    .modal-dialog{
        max-width: 650px;
    }
</style>

