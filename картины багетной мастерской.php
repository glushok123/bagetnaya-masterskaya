<style>
	.castom-image {
		min-width: 100%;
		min-width: 80%;
		height: 250px;
		object-fit: cover;
	}
	.carousel-item {
		text-align: center !important;
	}
	.d-block {
		display: inline-block !important;
	}
	html,
	body {
		max-width: 100%;
	}
	body {
		max-width: 100%;
		overflow-x: hidden;
	}
	.price {
		font-weight: bold;
	}
	form {
		box-sizing: border-box !important;
	}
	form input {
		width: 90% !important;
	}
	form select {
		width: 85% !important;
	}
	form textarea {
		width: 90% !important;
	}
	.hidden {
		display: none;
	}
	p {
		text-indent: 20px;
		/* Отступ первой строки в пикселах */
	}
</style>

<?php
$keyw = "Купить картину, картина для дома, интерьерная картина";
$titl = "Купить картину художника в Багетной мастерской №1 для дома или офиса";
$desc = "Ищете место, где можно купить картину? Багетная мастерская №1 предлагает Вам ознакомиться с оригинальными картинами современных художников!";

include "header.php";
require_once 'base/connect.php';
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<div id='crops'>
	<a href='/'>Главная</a> » <a href='/modulnye_kartiny_new.php'>Готовые картины</a>
</div>

<hr>

<div class='container'>
	<p>
		<b>Ищете место, где можно купить картину художника?</b> Багетная мастерская №1
		сотрудничает с молодыми и талантливыми художниками и предлагает
		Вам ознакомиться с их оригинальными интерьерными картинами!
	</p>
	<p>
		<b>Что такое интерьерная картина?</b> Это изображение, которое дополняет Вашу домашнюю или рабочую среду.
		Она может помочь создать нужное настроение и атмосферу в комнате, подчеркнуть цветовую гамму, стиль
		и концепцию дизайна интерьера. Картина для дома или офиса – это простой и недорогой вариант разнообразить интерьер.
		Также купить картину можно в подарок для близких или использоваться в качестве элементов декора на
		рабочих местах, в кафе, салонах красоты и других местах.
	</p>
	<p>
		<b>Купить картину очень легко:</b> просто оформите заказ через сайт,
		после чего с Вами свяжется менеджер Багетной мастерской №1 и
		уточнит подробности заказа, адрес доставки и другие детали.
	</p>
	<div class='row g-0' products-block style='margin-right: 25px!important'>

		<?
		$stm = $dbh->prepare("SELECT * FROM paintings where active=1");
		$stm->execute();
		$data = $stm->fetchAll();

		foreach ($data as $item) {
			$stm = $dbh->prepare("SELECT * FROM paintings_images where paintings_id = '" . $item['id'] . "'");
			$stm->execute();
			$images = $stm->fetchAll();

			$countImage = 0;
			$textImageHeader = '';
			$textImageBody = '';
			$textImageFooter = '';
			$textPrice = $item['price_one'];

			if ($item['price_common'] != null) {
				$textPrice = 'от ' . $item['price_one'];
			}

			foreach ($images as $image) {
				if ($countImage == 0) {
					$textImageHeader = $textImageHeader . '<button type="button" data-bs-target="#carousel' . $item['id'] . '" data-bs-slide-to="' . $countImage . '" class="active" aria-current="true" aria-label="Slide ' . $countImage . '"></button>';
					$textImageBody = $textImageBody . '
						<div class="carousel-item active">
							<a data-fancybox="images" href="фото_картин/' . $image['image'] . '"><img src="фото_картин/' . $image['image'] . '" class="d-block w-95 castom-image rounded" alt="..." ></a>
						</div>
					';
				} else {
					$textImageHeader = $textImageHeader . '<button type="button" data-bs-target="#carousel' . $item['id'] . '" data-bs-slide-to="' . $countImage . '" aria-label="Slide ' . $countImage . '"></button>';
					$textImageBody = $textImageBody . '
						<div class="carousel-item">
							<a data-fancybox="images" href="фото_картин/' . $image['image'] . '"><img src="фото_картин/' . $image['image'] . '" class="d-block w-95 castom-image rounded" alt="..." ></a>
							
						</div>
					';
				}

				$countImage = $countImage + 1;
			}

			$textImage = '
					<div id="carousel' . $item['id'] . '" class="carousel slide carousel-fade" data-bs-ride="carousel">
						<div class="carousel-indicators">
							' . $textImageHeader . '
						</div>
						<div class="carousel-inner ">
							' . $textImageBody . '
						</div>
						<button class="carousel-control-prev" type="button" data-bs-target="#carousel' . $item['id'] . '"  data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Предыдущий</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#carousel' . $item['id'] . '"  data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Следующий</span>
						</button>
					</div>
				';

			echo ('
					<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 d-flex align-items-stretch">
						<div class="card text-center h-100" style="width:100%" href="/">
							' . $textImage . '
							<div class="card-body">
								<h5 class="card-title name">' . $item['name'] . '</h5>
								<hr>
								<h5 class="card-text avtor">Автор: ' . $item['avtor'] . '</h5>
								<h5 class="card-text size">' . $item['sizes'] . ' мм</h5>
								<h5 class="card-text price">' . $textPrice . ' ₽</h5>
								<button class="btn btn-primary add-in-cart"
									data-painting-id="' . $item['id'] . '"
									data-painting-name="' . $item['name'] . '"
									data-painting-avtor="' . $item['avtor'] . '"
									data-painting-size="' . $item['sizes'] . '"
									data-painting-price="' . $item['price_one'] . '"
								>Купить</button>
							</div>
						</div>
					</div>
				
				');
		}
		?>
	</div>
</div>

<br><br><br>
<!-- Modal оформление заказа -->
<div class="modal fade" id="add-in-cart" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered ">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Оформление заказа</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p style='display:none;'>
					<span>ID: </span>
					<span id='cart-id' class='fs-5 fw-bold'></span>
				</p>
				<p>
					<span>Название: </span>
					<span id='cart-name' class='fs-5 fw-bold'></span>
				</p>
				<p>
					<span>Автор: </span>
					<span id='cart-avtor' class='fs-5 fw-bold'></span>
				</p>
				<p>
					<span>Размер: </span>
					<span id='cart-size' class='fs-5 fw-bold'></span>
				</p>
				<p>
					<span>Цена: </span>
					<span id='cart-price' class='fs-5 fw-bold'></span>
				</p>

				<form action="">
					<hr>
					<div class="row text-center justify-content-center">
						<h5>Заполните данные для обратной связи</h5>
						<input id="user-name" type="text" class="form-control text-center " style="max-width:500px;" placeholder="Фамилия Имя" required />
						<input id="phone" type="text" class="form-control text-center " style="max-width:500px;" placeholder="(999) 999-99-99" required />
						<input id="email" type="text" class="form-control text-center " style="max-width:500px;" placeholder="example@user.com" required />

						<select id="typeDostavky" class="form-select " aria-label=".form-select-lg example">
							<option selected value="Самовывоз из м.Арбатская">Самовывоз из м.Арбатская</option>
							<option value="Самовывоз из м.Новокузнецкая">Самовывоз из м.Новокузнецкая</option>
							<option value="Доставка">Доставка</option>
						</select>
						<input type="text" placeholder="Адрес доставки" class='hidden form-control text-center' id='address'>

						<label for="comment" class="form-label" style='margin-top:10px'>Комментарий к заказу:</label>
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
				<h5 class="modal-title text-center" id="exampleModalLabel">СТАТУС ЗАЯВКИ № <span id='order-id'></span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" name="myForm" onsubmit="return validateForm()">
					<div class="text-center">
						<h4>ВАША ЗАЯВКА ЗАРЕГИСТРИРОВАНА! </h4><br>
						<h4>С вами свяжутся в течени 10 минут!</h4>
					</div>
					<!-- end row -->
				</form>
				<!-- end form -->
			</div>
		</div>
	</div>
</div>

<script>
	$("#phone").mask("(999) 999-99-99");
	toastr.options.timeOut = 5000; // 5s

	//Показать модальное окно для оформления заказа
	function showModalAddInCart(painting) {
		$('#cart-id').text(painting.data('painting-id'))
		$('#cart-name').text(painting.data('painting-name'))
		$('#cart-avtor').text(painting.data('painting-avtor'))
		$('#cart-size').text(painting.data('painting-size'))
		$('#cart-price').text(painting.data('painting-price'))

		$('#add-in-cart').modal('show');
	}

	//Показать или скрыть адрес в зависимости от типа заказа
	function initAddress() {
		if ($('#typeDostavky').val() == 'Доставка') {
			$('#address').removeClass('hidden')
		} else {
			$('#address').addClass('hidden')
		}
	}

	//валидация данных заказа
	function validation() {
		$("#user-name").removeClass('is-invalid');
		$("#phone").removeClass('is-invalid');
		$("#email").removeClass('is-invalid');

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

		if (!$("#email").val()) {
			$("#email").addClass('is-invalid');
			toastr.error('Необходимо заполнить email !');
			return false;
		}
	}

	//Отправить запрос сохранения заказа
	function sendOrderRequest() {
		if (validation() == false) {
			return;
		}

		data = {
			painting_id: $('#cart-id').text(),
			user_name: $("#user-name").val(),
			phone: $("#phone").val(),
			email: $("#email").val(),
			type_dostavky: $("#typeDostavky").val(),
			address: $("#address").val(),
			comment: $("#comment").val(),
		};

		$.ajax({
			url: '/admin/request/saveOrderPainting.php',
			method: 'post',
			dataType: "json",
			data: data,
			success: function(data) {
				if (data.success == true) {
					$('#add-in-cart').modal('hide');
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

	$(document).on('click', '.add-in-cart', function() {
		showModalAddInCart($(this))
	});
	$(document).on('change', '#typeDostavky', function() {
		initAddress()
	});
	$(document).on('click', '#send-order', function() {
		sendOrderRequest()
	});
</script>