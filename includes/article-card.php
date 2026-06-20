<article class="article-card">
    <a class="article-image" href="article.php?slug=<?= e($article['slug']) ?>">
        <img src="<?= e($article['image']) ?>" alt="<?= e($article['title']) ?>">
    </a>
    <div class="article-preview">
        <h2><a href="article.php?slug=<?= e($article['slug']) ?>"><?= e($article['title']) ?></a></h2>
        <p><?= e($article['summary']) ?> <span>VON <?= e(strtoupper($article['author'])) ?></span></p>
    </div>
</article>
