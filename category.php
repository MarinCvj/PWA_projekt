<?php
require_once __DIR__ . '/includes/functions.php';
$category = $_GET['name'] ?? 'Sport';
$articles = articles_by_category($category);
$title = 'RP ONLINE - ' . $category;
$active = strtolower($category) === 'sport' ? 'sport' : 'politik';
require_once __DIR__ . '/includes/header.php';
?>

<section class="news-section">
    <h1><?= e($category) ?></h1>
    <?php if (!$articles): ?>
        <p class="empty-state">Nema objavljenih clanaka u ovoj kategoriji.</p>
    <?php endif; ?>
    <?php foreach ($articles as $article): ?>
        <?php include __DIR__ . '/includes/article-card.php'; ?>
    <?php endforeach; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
