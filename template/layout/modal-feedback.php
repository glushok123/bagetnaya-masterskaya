    <!-- Modal обратная связь -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div class="form-floating mb-3">
                                <input id="user-name" type="text" class="form-control text-center" placeholder="Фамилия Имя" style="max-width:500px;" required>
                                <label for="floatingInput" style='left:20px;'>Фамилия Имя</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input  id="phone" type="text" class="form-control text-center phone-valid" placeholder="+7 (999) 999-99-99" style="max-width:500px;" required>
                                <label for="floatingInput" style='left:20px;'>Телефон +7 (999) 999-99-99</label>
                            </div>

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
                    <button type="button" class="btn  button-color-company-red" id='send-order' style='color:white;'>Отправить заявку</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal статус заявки -->
    <div class="modal fade" id="order-status-model" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">СТАТУС ЗАЯВКИ № <span
                            id='order-id'></span></h5>
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