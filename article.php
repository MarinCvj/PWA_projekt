<?php
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
$article = find_article($slug);

if (!$article) {
    http_response_code(404);
    $title = 'Clanak nije pronaden';
    require_once __DIR__ . '/includes/header.php';
    echo '<section class="article-full"><h1>Clanak nije pronaden</h1><p>Vratite se na naslovnicu i odaberite postojeci clanak.</p></section>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$title = $article['title'];
$active = strtolower($article['category']) === 'sport' ? 'sport' : 'politik';
require_once __DIR__ . '/includes/header.php';
$paragraphs = preg_split('/\n\s*\n/', $article['content']);
?>

<article class="article-full">
    <div class="section-label"><?= e($article['category']) ?></div>
    <h1><?= e($article['title']) ?></h1>
    <time datetime="<?= e($article['created_at']) ?>"><?= e(date('d. m. Y.', strtotime($article['created_at']))) ?></time>
    <img class="hero-image" src="<?= e($article['image']) ?>" alt="<?= e($article['title']) ?>">
    <p class="lead"><?= e($article['summary']) ?></p>
    <?php foreach ($paragraphs as $paragraph): ?>
        <p><?= e(trim($paragraph)) ?></p>
    <?php endforeach; ?>
</article>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
