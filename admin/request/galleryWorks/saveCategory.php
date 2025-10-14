<?php
require_once '../../../base/connect.php';

$allowExtensions = ['jpg', 'jpeg', 'png'];
$uploadDirRelative = '/img/gallery-categories/';
$uploadDirAbsolute = $_SERVER['DOCUMENT_ROOT'] . $uploadDirRelative;

if (!is_dir($uploadDirAbsolute)) {
    mkdir($uploadDirAbsolute, 0777, true);
}

function slugifyCategory(string $text): string
{
    $text = trim($text);
    if ($text === '') {
        return '';
    }

    $transliterated = @iconv('UTF-8', 'ASCII//TRANSLIT', $text);
    if ($transliterated === false) {
        $transliterated = $text;
    }

    $transliterated = strtolower($transliterated);
    $transliterated = preg_replace('/[^a-z0-9]+/i', '-', $transliterated);
    $transliterated = trim($transliterated, '-');

    return $transliterated;
}

function ensureUniqueSlug(PDO $dbh, string $slug, ?int $excludeId = null): string
{
    $baseSlug = $slug !== '' ? $slug : 'category';
    $candidate = $baseSlug;
    $suffix = 1;

    while (true) {
        $query = 'SELECT id FROM category_gallery_works WHERE slug = :slug';
        $params = [':slug' => $candidate];

        if ($excludeId !== null) {
            $query .= ' AND id != :id';
            $params[':id'] = $excludeId;
        }

        $stmt = $dbh->prepare($query);
        $stmt->execute($params);

        if (!$stmt->fetchColumn()) {
            return $candidate;
        }

        $candidate = $baseSlug . '-' . $suffix;
        $suffix++;
    }
}

function jsonResponse(array $payload): void
{
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : null;
$name = isset($_POST['name']) ? trim((string)$_POST['name']) : '';
$isVisible = isset($_POST['is_visible']) && (string)$_POST['is_visible'] === '0' ? 0 : 1;

if ($name === '') {
    jsonResponse([
        'status' => 'error',
        'message' => 'Название категории не может быть пустым.',
    ]);
}

$currentCategory = null;

if ($id) {
    $stmt = $dbh->prepare('SELECT * FROM category_gallery_works WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $currentCategory = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$currentCategory) {
        jsonResponse([
            'status' => 'error',
            'message' => 'Категория не найдена.',
        ]);
    }
}

$slug = slugifyCategory($name);
$slug = ensureUniqueSlug($dbh, $slug, $id);

$currentImage = $currentCategory['main_image'] ?? null;

if (!empty($_FILES['main_image']['tmp_name'])) {
    $file = $_FILES['main_image'];

    if (!empty($file['error'])) {
        jsonResponse([
            'status' => 'error',
            'message' => 'Ошибка загрузки файла.',
        ]);
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowExtensions, true)) {
        jsonResponse([
            'status' => 'error',
            'message' => 'Недопустимый тип файла. Разрешены: jpg, jpeg, png.',
        ]);
    }

    $imageInfo = @getimagesize($file['tmp_name']);
    if (empty($imageInfo)) {
        jsonResponse([
            'status' => 'error',
            'message' => 'Не удалось определить тип изображения.',
        ]);
    }

    $fileName = time() . '-' . random_int(1, 9_999_999_999) . '.' . $ext;
    $targetPath = $uploadDirAbsolute . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        jsonResponse([
            'status' => 'error',
            'message' => 'Не удалось сохранить файл.',
        ]);
    }

    if (!empty($currentImage) && !preg_match('/^https?:/i', $currentImage)) {
        $oldPath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($currentImage, './');
        if (is_file($oldPath)) {
            @unlink($oldPath);
        }
    }

    $currentImage = $uploadDirRelative . $fileName;
}

try {
    if ($id) {
        $stmt = $dbh->prepare('UPDATE category_gallery_works SET name = :name, slug = :slug, main_image = :main_image, is_visible = :visible WHERE id = :id');
        $stmt->execute([
            ':name' => $name,
            ':slug' => $slug,
            ':main_image' => $currentImage,
            ':visible' => $isVisible,
            ':id' => $id,
        ]);
    } else {
        $positionStmt = $dbh->prepare('SELECT COALESCE(MAX(position), 0) + 1 AS next_position FROM category_gallery_works');
        $positionStmt->execute();
        $nextPosition = (int)$positionStmt->fetchColumn();

        $stmt = $dbh->prepare('INSERT INTO category_gallery_works (name, slug, main_image, is_visible, position) VALUES (:name, :slug, :main_image, :visible, :position)');
        $stmt->execute([
            ':name' => $name,
            ':slug' => $slug,
            ':main_image' => $currentImage,
            ':visible' => $isVisible,
            ':position' => $nextPosition,
        ]);
        $id = (int)$dbh->lastInsertId();
    }
} catch (Throwable $exception) {
    jsonResponse([
        'status' => 'error',
        'message' => 'Ошибка сохранения категории: ' . $exception->getMessage(),
    ]);
}

echo json_encode([
    'status' => 'success',
    'id' => $id,
], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
