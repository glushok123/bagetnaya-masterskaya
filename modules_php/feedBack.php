<div class="callback-bt" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <div class="text-call">
        <span>Заказать<br>звонок</span>
    </div>
</div>

<!-- Modal обратная связь -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Форма обратной связи</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" style="padding:15px;">
                    <div class="row text-center justify-content-center">
                        <h5>Заполните данные для обратной связи</h5>
                        <input id="user-name" type="text" class="form-control text-center " style="max-width:500px;"
                               placeholder="Фамилия Имя" required/>
                        <input id="phone" type="text" class="form-control text-center " style="max-width:500px;"
                               placeholder="+7 (999) 999-99-99" required/>
                        <!--input id="email" type="text" class="form-control text-center "  style="max-width:500px;" placeholder="example@user.com" required/-->
                        <br>
                        <hr>

                        <div class="form-check text-start">
                            <input class="form-check-input" type="radio" name="email" id="exampleRadios1"
                                   value="Позвоните мне" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Позвоните мне
                            </label>
                        </div>

                        <div class="form-check text-start">
                            <input class="form-check-input text-start" type="radio" name="email" id="exampleRadios2"
                                   value="Напишите мне в whatsapp">
                            <label class="form-check-label text-start" for="exampleRadios2">
                                Напишите мне в whatsapp
                            </label>
                        </div>

                        <hr>

                        <label for="comment" class="form-label" style='margin-top:10px'>Сообщение:</label>
                        <textarea class="form-control" id="comment" rows="3"></textarea>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id='send-order'>Отправить заявку</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal статус заявки -->
<div class="modal fade" id="order-status-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">СТАТУС ЗАЯВКИ № <span id='order-id'></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" name="myForm" onsubmit="return validateForm()">
                    <div class="text-center">
                        <h4>ВАША ЗАЯВКА ЗАРЕГИСТРИРОВАНА! </h4><br>
                        <h4>С вами свяжутся в течении 10 минут!</h4>
                    </div>
                    <!-- end row -->
                </form>
                <!-- end form -->
            </div>
        </div>
    </div>
</div>


<style>
    /*кнопка звонка*/

    .callback-bt {
        background: #a21213;
        border-radius: 50%;
        box-shadow: 0 8px 10px rgba(56, 163, 253, 0.3);
        cursor: pointer;
        border: 2px solid transparent;
        display: block;
        height: 50px;
        width: 50px;
        text-align: center;
        position: fixed;
        right: 8%;
        bottom: 18%;
        z-index: 999;
        transition: 1s ease-in-out;
        -webkit-animation: hoverWave linear 4s infinite;
        animation: hoverWave linear 4s infinite;
    }

    .callback-bt:hover {
        background: #fff;
        border: 2px solid #a21213;
    }

    .callback-bt .text-call {
        height: 50px;
        width: 50px;
        border-radius: 50%;
        position: relative;
    }

    .callback-bt .text-call:after {
        content: "\f095";
        display: block;
        font-family: fontawesome;
        color: #fff;
        font-size: 20px;
        line-height: 50px;
        height: 50px;
        width: 50px;
        opacity: 1;
        transition: .3s ease-in-out;
        /*animation: 2200ms ease 3s normal none 1 running shake;

        animation-iteration-count: infinite;*/
    }

    .callback-bt .text-call:hover:after {
        opacity: 0;
    }

    .callback-bt .text-call span {
        color: #a21213;
        display: block;
        left: 50%;
        top: 50%;
        position: absolute;
        transform: translate(-50%, -50%);
        opacity: 0;
        font-size: 7px;
        line-height: 12px;
        font-weight: 600;
        text-transform: uppercase;
        transition: .3s ease-in-out;
        font-family: 'montserrat', Arial, Helvetica, sans-serif;
    }

    .callback-bt .text-call:hover span {
        opacity: 1;
    }

    @keyframes hoverWave {
        0% {
            box-shadow: 0 8px 10px rgba(162, 18, 19, 0.3), 0 0 0 0 rgba(162, 18, 19, 0.2), 0 0 0 0 rgba(162, 18, 19, 0.2)
        }

        40% {
            box-shadow: 0 8px 10px rgba(162, 18, 19, 0.3), 0 0 0 15px rgba(162, 18, 19, 0.2), 0 0 0 0 rgba(162, 18, 19, 0.2)
        }

        80% {
            box-shadow: 0 8px 10px rgba(162, 18, 19, 0.3), 0 0 0 30px rgba(162, 18, 19, 0), 0 0 0 26.7px rgba(162, 18, 19, 0.067)
        }

        100% {
            box-shadow: 0 8px 10px rgba(56, 163, 253, 0.3), 0 0 0 30px rgba(56, 163, 253, 0), 0 0 0 40px rgba(56, 163, 253, 0.0)
        }
    }

    /* animations icon */

    @keyframes shake {
        0% {
            transform: rotateZ(0deg);
            -ms-transform: rotateZ(0deg);
            -webkit-transform: rotateZ(0deg);
        }

        10% {
            transform: rotateZ(-30deg);
            -ms-transform: rotateZ(-30deg);
            -webkit-transform: rotateZ(-30deg);
        }

        20% {
            transform: rotateZ(15deg);
            -ms-transform: rotateZ(15deg);
            -webkit-transform: rotateZ(15deg);
        }

        30% {
            transform: rotateZ(-10deg);
            -ms-transform: rotateZ(-10deg);
            -webkit-transform: rotateZ(-10deg);
        }

        40% {
            transform: rotateZ(7.5deg);
            -ms-transform: rotateZ(7.5deg);
            -webkit-transform: rotateZ(7.5deg);
        }

        50% {
            transform: rotateZ(-6deg);
            -ms-transform: rotateZ(-6deg);
            -webkit-transform: rotateZ(-6deg);
        }

        60% {
            transform: rotateZ(5deg);
            -ms-transform: rotateZ(5deg);
            -webkit-transform: rotateZ(5deg);
        }

        70% {
            transform: rotateZ(-4.28571deg);
            -ms-transform: rotateZ(-4.28571deg);
            -webkit-transform: rotateZ(-4.28571deg);
        }

        80% {
            transform: rotateZ(3.75deg);
            -ms-transform: rotateZ(3.75deg);
            -webkit-transform: rotateZ(3.75deg);
        }

        90% {
            transform: rotateZ(-3.33333deg);
            -ms-transform: rotateZ(-3.33333deg);
            -webkit-transform: rotateZ(-3.33333deg);
        }

        100% {
            transform: rotateZ(0deg);
            -ms-transform: rotateZ(0deg);
            -webkit-transform: rotateZ(0deg);
        }
    }

    /* конец кнопки звонка */
</style>

<script>
    $("#phone").mask("+7 (999) 999-99-99");
    toastr.options.timeOut = 5000; // 5s

    //валидация данных заказа
    function validation() {
        $("#user-name").removeClass('is-invalid');
        $("#phone").removeClass('is-invalid');
        //$("#email").removeClass('is-invalid');

        if (!$("#user-name").val()) {
            $("#user-name").addClass('is-invalid');
            toastr.error('Необходимо заполнить ваше имя !');
            return false;
        }

        if (!$("#phone").val()) {
            $("#phone").addClass('is-invalid');
            toastr.error('Необходимо заполнить номер телефона !');
            return false;
        }

        /*if (! $("#email").val()) {
            $("#email").addClass('is-invalid');
            toastr.error('Необходимо заполнить email !');
            return false;
        }*/
    }

    //Отправить запрос обратной связи
    function sendOrderRequest() {
        if (validation() == false) {
            return;
        }

        data = {
            user_name: $("#user-name").val(),
            phone: $("#phone").val(),
            email: $('input[name="email"]:checked').val(), //$("#email").val(),
            comment: $("#comment").val(),
        };

        $('#exampleModal').modal('hide');
        $('#order-status-model').modal('show');

        $.ajax({
            url: '/admin/request/saveFeedBackRequest.php',
            method: 'post',
            dataType: "json",
            data: data,
            success: function (data) {
                if (data.success == true) {
                    $('#order-id').text(data.order_id)
                }
            },
            error: function (jqXHR, exception) {
                if (jqXHR.status === 0) {
                    alert('Not connect. Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found (404).');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error (500).');
                } else if (exception === 'parsererror') {
                    alert('Requested JSON parse failed.');
                } else if (exception === 'timeout') {
                    alert('Time out error.');
                } else if (exception === 'abort') {
                    alert('Ajax request aborted.');
                } else {
                    alert('Uncaught Error. ' + jqXHR.responseText);
                }
            }
        });
    }

    $(document).on('click', '#send-order', function () {
        sendOrderRequest()
    });
</script>