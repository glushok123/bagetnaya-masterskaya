<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/config/config.php';
$token = bin2hex(openssl_random_pseudo_bytes(16));

require_once 'auth/authProv.php';
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Вход</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>

<body class="bg-theme bg-theme1">
<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                     class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input id='login_login' type="text" id="form3Example3" class="form-control form-control-lg"
                               placeholder="Логин"/>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <input id='login_passwd' type="password" id="form3Example4" class="form-control form-control-lg"
                               placeholder="Пароль"/>
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="button" class="btn btn-primary btn-lg auth"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Вход
                        </button>
                        <hr>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-center py-4 px-4 px-xl-5 bg-primary">
        <div class='row text-center'>
            <div class="text-white">
                Админка Багетной мастерской
            </div>
        </div>
    </div>
</section>
</body>

<script type="text/javascript">
    $(document).ready(function () {
        $(".auth").on('click', function (event) {
            auth()
        });

    });

    function auth() {
        var prov = true;
        if ($("#login_login").val() == "") {
            alert("Необходимо ввести логин!");

            return;
        }

        if ($("#login_passwd").val() == "") {
            alert("Необходимо ввести пароль!");

            return;
        }

        var datalog = {
            "login": $("#login_login").val(),
            "passwd": $("#login_passwd").val()
        };

        $.post("auth/login.php", datalog, function (datar) {
            var obj = JSON.parse(datar);

            if (obj.status == "error") {
                alert(obj.mes);
            }

            if (obj.status == "success") {
                window.location.href = 'index.php';
            }
        });
    }
</script>

</html>