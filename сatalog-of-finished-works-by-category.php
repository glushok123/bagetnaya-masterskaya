<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';

$rawCategoryParam = isset($_GET['category']) ? trim((string)$_GET['category']) : '';

$categoriesStmt = $dbh->prepare("SELECT id, name, slug, is_visible FROM category_gallery_works ORDER BY position ASC, id ASC");
$categoriesStmt->execute();
$allCategories = $categoriesStmt->fetchAll(PDO::FETCH_ASSOC);

$visibleCategories = array_values(array_filter($allCategories, static function (array $category) {
    return (int)$category['is_visible'] === 1;
}));

$categoryBySlug = [];
$categoryById = [];
$categoryByName = [];

foreach ($visibleCategories as $category) {
    $categoryBySlug[$category['slug']] = $category;
    $categoryById[(string)$category['id']] = $category;
    $categoryByName[mb_strtolower($category['name'])] = $category;
}

$selectedCategory = null;

if ($rawCategoryParam !== '') {
    if (isset($categoryBySlug[$rawCategoryParam])) {
        $selectedCategory = $categoryBySlug[$rawCategoryParam];
    } elseif (isset($categoryById[$rawCategoryParam])) {
        $selectedCategory = $categoryById[$rawCategoryParam];
    } else {
        $normalizedParam = mb_strtolower($rawCategoryParam);
        if (isset($categoryByName[$normalizedParam])) {
            $selectedCategory = $categoryByName[$normalizedParam];
        }
    }
}

if ($selectedCategory === null && $rawCategoryParam === '' && !empty($visibleCategories)) {
    $selectedCategory = $visibleCategories[0];
    $rawCategoryParam = $selectedCategory['slug'];
}

if ($selectedCategory === null && $rawCategoryParam !== '') {
    http_response_code(404);
}

$keywords = $selectedCategory ? $selectedCategory['name'] . ", работы, багет, паспарту" : "работы, багет, паспарту";
$title = $selectedCategory['name'] ?? "Готовые работы";
$description = $selectedCategory['name'] ?? "Наши работы";

require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';

$works = [];

if ($selectedCategory !== null) {
    $worksStmt = $dbh->prepare("SELECT id, url_image, description FROM gallery_work_images WHERE category = :category ORDER BY id DESC");
    $worksStmt->bindValue(':category', $selectedCategory['id'], PDO::PARAM_INT);
    $worksStmt->execute();
    $works = $worksStmt->fetchAll(PDO::FETCH_ASSOC);
}

function normalizeGalleryImagePath(?string $path): string
{
    if (empty($path)) {
        return '/assets/img/gallery-category-placeholder.svg';
    }

    if (preg_match('/^https?:/i', $path)) {
        return $path;
    }

    return '/' . ltrim($path, './');
}
?>

    <style>
        .castom-image {
            width: 350px;
            height: 350px;
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
            /*width:90% !important;*/
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
                width: 350px !important;
                height: 350px !important;
            }
        }

        @media screen and (max-width: 900px) {
            .castom-image {
                width: 170px !important;
                height: 170px !important;
            }
        }

        .tekst_sverhu_kartinki {
            position: relative;
        }

        .tekst_sverhu_kartinki_tekst {
            position: absolute;
            bottom: 5%;
            text-transform: uppercase;
            color: white !important;
            width: 93%;
            background: #1c1515dc;
            padding: 10px;
            text-align: center;
            display: none;
            font-size: 15px;
        }

        .fancybox-caption {
            background: #1c1515dc !important;
            bottom: 10% !important;
            padding-top: 15px !important;
        }

        html,
        body {
            max-width: 100%;
        }

        body {
            max-width: 100%;
            overflow-x: hidden;
        }
    </style>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"
            integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"
          integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <hr>

<?php if ($selectedCategory === null): ?>
    <div class="container py-5">
        <div class="alert alert-warning text-center" role="alert">
            Запрошенная категория не найдена. <a href="/сatalog-of-finished-works.php" class="alert-link">Вернуться к каталогу работ</a>.
        </div>
    </div>
<?php else: ?>
    <div class='container'>
        <div class='row text-center'>
            <div class="block-h1 text-center my-4 fade-in">
                <h1 class='color-main'>Наши работы раздела "<?= htmlspecialchars($selectedCategory['name']) ?>"</h1>
            </div>
            <hr>
            <div class="row text-center justify-content-center">
                <a href="/baget_online">
                    <button
                            class='button button-custom-index button-color-company-red fix-width-425 mob-fix-width-340 mb-3 color-white'>
                        Рассчитать
                        стоимость багета
                    </button>
                </a>
                <a href="/сatalog-of-finished-works.php">
                    Вернуться к разделам
                </a>

            </div>
        </div>
        <div class='row g-0'>
            <?php if (empty($works)): ?>
                <div class="col-12 text-center py-4">
                    В этой категории пока нет опубликованных работ. Загляните позже!
                </div>
            <?php else: ?>
                <?php foreach ($works as $item): ?>
                    <?php
                    $imageSrc = normalizeGalleryImagePath($item['url_image'] ?? '');
                    $workDescription = trim((string)($item['description'] ?? ''));
                    ?>
                    <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 p-1">
                        <div class="card text-center justify-content-center h-100 pt-2" style="width:100%" href="/">
                            <a data-fancybox="images" data-caption="<?= htmlspecialchars($workDescription) ?>"
                               href="<?= $imageSrc ?>" style="text-decoration: none;" class="tekst_sverhu_kartinki"
                               onmouseover="show($(this))" onmouseout="hide($(this))">
                                <img src="<?= $imageSrc ?>" class="rounded mx-auto d-block castom-image "
                                     alt="<?= htmlspecialchars($selectedCategory['name']) ?>">
                                <?php if ($workDescription !== ''): ?>
                                    <h5 style="color:black;" class="tekst_sverhu_kartinki_tekst"><?= htmlspecialchars($workDescription) ?></h5>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

    <br><br><br>

    <style>
        .card {
            padding-bottom: 10px;
            border-radius: 6px;
            border: 1px solid var(--beige, #6a1a21);
        }

        .card:hover {
            background: #E0D2BB;
        }
    </style>

    <script>
        function show(el) {
            el.find('.tekst_sverhu_kartinki_tekst').css('display', 'block')
        }

        function hide(el) {
            el.find('.tekst_sverhu_kartinki_tekst').css('display', 'none')
        }
    </script>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/vk.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/sm.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>
