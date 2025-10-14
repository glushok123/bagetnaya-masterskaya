<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<style>
	* {
		box-sizing: content-box;
	}

	.castom-image {
		width: 250px !important;
		height: 250px !important;
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
		overflow-y: visible !important;
		overflow-x: hidden;
	}

	.price {
		font-weight: bold;
	}

	.test {
		box-sizing: border-box !important;
	}

	form input {
		/* width:90% !important; */
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

	@media screen and (max-width: 1200px) {
		.castom-image {
			width: 180px !important;
			height: 180px !important;
		}
	}

	@media screen and (max-width: 900px) {
		.castom-image {
			width: 170px !important;
			height: 170px !important;
		}
	}
</style>

<?php
$keyw = "Наши работы";
$titl = "Наши работы";
$desc = "Наши работы";

include "header.php";
require_once 'base/connect.php';

$categories = [];
$firstImages = [];

try {
        $stmt = $dbh->prepare('SELECT id, name, main_image FROM category_gallery_works WHERE is_hidden = 0 ORDER BY sort_order, id');
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $imagesStmt = $dbh->prepare('SELECT category, url_image FROM gallery_work_images ORDER BY id ASC');
        $imagesStmt->execute();
        foreach ($imagesStmt->fetchAll(PDO::FETCH_ASSOC) as $image) {
                if (!isset($firstImages[$image['category']])) {
                        $firstImages[$image['category']] = $image['url_image'];
                }
        }
} catch (PDOException $exception) {
        $categories = [];
}

$fallbackSvg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500"><rect fill="%23f2f2f2" width="500" height="500"/><text x="50%25" y="50%25" dominant-baseline="middle" text-anchor="middle" fill="%23999" font-size="32">Нет изображения</text></svg>';
$fallbackImage = 'data:image/svg+xml;charset=UTF-8,' . rawurlencode($fallbackSvg);
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<style>
	p {
		text-indent: 20px;
		/* Отступ первой строки в пикселах */
	}
</style>
<div id='crops'>
	<a href='/'>Главная</a> » <a href='/сatalog-of-finished-works.php'>Наши работы</a>
</div>

<hr>

<div class=''>
	<div class='row text-center'>
		<h3>Наши работы </h3>
		<hr>
	</div>

        <div class='row g-0 justify-content-center' style="margin-right:10px;">
                <?php if (!empty($categories)) : ?>
                        <?php foreach ($categories as $item) :
                                $imagePath = $item['main_image'] ?: ($firstImages[$item['id']] ?? '');
                                if (empty($imagePath)) {
                                        $imagePath = $fallbackImage;
                                }
                                $categoryId = (int) $item['id'];
                                $categoryName = htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8');
                                $imageSrc = htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8');
                        ?>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <div class="card text-center justify-content-center h-100" style="width:100%">
                                                <a href="/сatalog-of-finished-works-by-category.php?category=<?php echo $categoryId; ?>">
                                                        <img src="<?php echo $imageSrc; ?>" class="rounded mx-auto d-block castom-image " alt="<?php echo $categoryName; ?>">
                                                </a>

                                                <div class="card-body">
                                                        <a href="/сatalog-of-finished-works-by-category.php?category=<?php echo $categoryId; ?>">
                                                                <h5 class="card-title"><?php echo $categoryName; ?></h5>
                                                        </a>
                                                </div>
                                        </div>
                                </div>
                        <?php endforeach; ?>
                <?php else : ?>
                        <div class="col-12 text-center">
                                <p>Категории не найдены.</p>
                        </div>
                <?php endif; ?>
        </div>
	<br>
	<p>
		Ищете идеальную раму для картины? Посмотрите примеры оформления разных видов искусства в
		Багетной мастерской №1! Мы подготовили для Вас каталог с разнообразными вариантами работ.
	</p>
	<p>
		Багетная мастерская № 1 имеет большой опыт работы в сфере декоративного оформления.
		Здесь Вы можете увидеть примеры оформления вышивок, икон, гравюр, рамы для живописи и
		3d-оформление монет, медалей и спортивных атрибутов. Профессиональная команда дизайнеров и
		мастеров подберет для Вас индивидуальное оформление картины в раме, отвечающее именно Вашим запросам!
		Ознакомьтесь с различными вариантами художественного оформления Багетной мастерской № 1 и найдите вдохновение именно для Вашей картины!
	</p>
</div>

<br><br><br>

<script>

</script>

<style>

</style>