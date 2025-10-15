<?php

declare(strict_types=1);

if (!function_exists('loadGalleryCategories')) {
    /**
     * Получает список категорий галереи работ из базы данных.
     */
    function loadGalleryCategories(PDO $dbh): array
    {
        static $cachedCategories = null;

        if ($cachedCategories !== null) {
            return $cachedCategories;
        }

        try {
            $stmt = $dbh->prepare(
                'SELECT name, slug FROM category_gallery_works WHERE is_visible = 1 ORDER BY position ASC, id ASC'
            );
            $stmt->execute();
            $cachedCategories = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $exception) {
            $cachedCategories = [];
        }

        return $cachedCategories;
    }
}

if (!function_exists('prepareGalleryCategoryLink')) {
    /**
     * Формирует ссылку на страницу категории галереи работ.
     */
    function prepareGalleryCategoryLink(array $category): string
    {
        $slug = isset($category['slug']) ? (string)$category['slug'] : '';
        return '/сatalog-of-finished-works-by-category.php?category=' . rawurlencode($slug);
    }
}

if (!function_exists('escapeGalleryCategoryName')) {
    function escapeGalleryCategoryName(array $category): string
    {
        $name = isset($category['name']) ? (string)$category['name'] : '';
        return htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
