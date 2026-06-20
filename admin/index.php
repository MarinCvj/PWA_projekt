<?php
require_once __DIR__ . '/../includes/functions.php';
require_admin();
$title = 'Administracija';
$active = 'admin';
require_once __DIR__ . '/../includes/header.php';
$articles = all_articles(true);
?>

<section class="admin-panel">
    <div class="admin-head">
        <h1>Administracija</h1>
        <a class="button" href="new_article.php">Dodaj clanak</a>
    </div>
    <p>Prijavljeni ste kao <?= e(current_user()['username']) ?>. <a href="../logout.php">Odjava</a></p>
    <table>
        <thead>
            <tr>
                <th>Naslov</th>
                <th>Kategorija</th>
                <th>Autor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= e($article['title']) ?></td>
                    <td><?= e($article['category']) ?></td>
                    <td><?= e($article['author']) ?></td>
                    <td><?= (int) $article['published'] === 1 ? 'Objavljeno' : 'Skriveno' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
