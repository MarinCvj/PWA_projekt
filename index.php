<?php
$title = 'RP ONLINE - Naslovnica';
$active = 'home';
require_once __DIR__ . '/includes/header.php';
$sportArticles = articles_by_category('Sport');
$politicsArticles = articles_by_category('Politik');
?>

<section class="news-section">
    <h1>Sport</h1>
    <?php foreach ($sportArticles as $article): ?>
        <?php include __DIR__ . '/includes/article-card.php'; ?>
    <?php endforeach; ?>
</section>

<section class="news-section">
    <h1>Politik</h1>
    <?php foreach ($politicsArticles as $article): ?>
        <?php include __DIR__ . '/includes/article-card.php'; ?>
    <?php endforeach; ?>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
