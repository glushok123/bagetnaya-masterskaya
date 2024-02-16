<div class="fixed block-button-fedback">
    <div class='text-center'>
        <div class='children-button test-1'>
            <? include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/svg/button-skidka.php' ?>
        </div>
        <div class='children-button mt-3'>
            <? include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/svg/button-fedback.php' ?>
        </div>
    </div>
</div>

<style>
.circle-skidka {
    cursor: pointer;
    -webkit-animation: spin 10s linear infinite;
    -moz-animation: spin 10s linear infinite;
    animation: spin 10s linear infinite;
}

@-moz-keyframes spin {
    100% {
        -moz-transform: rotate(360deg);
    }
}

@-webkit-keyframes spin {
    100% {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

@keyframes rotate-circle {
    to {
        transform: rotate(1turn);
    }
}

/*кнопка звонка*/

.callback-bt {
    border-radius: 50%;
    cursor: pointer;
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


</style>

<script>
    jQuery(document).ready(function($) {
        $(".phone-valid").mask("+7 (999) 999-99-99");
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


            $('#feedbackModal').modal('hide');
            $('#order-status-model').modal('show');

            $.ajax({
                url: '/admin/request/saveFeedBackRequest.php',
                method: 'post',
                dataType: "json",
                data: data,
                success: function(data) {
                    if (data.success == true) {
                        $('#exampleModal').modal('hide');
                        $('#order-id').text(data.order_id)
                        $('#order-status-model').modal('show');
                    }
                },
                error: function(jqXHR, exception) {
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

        $(document).on('click', '#send-order', function() {
            sendOrderRequest()
        });
});
</script>