<?php
require_once __DIR__ . '/../includes/functions.php';
require_admin();
$error = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'title' => trim($_POST['title'] ?? ''),
        'category' => $_POST['category'] ?? 'Sport',
        'image' => trim($_POST['image'] ?? ''),
        'summary' => trim($_POST['summary'] ?? ''),
        'content' => trim($_POST['content'] ?? ''),
        'author' => trim($_POST['author'] ?? current_user()['username']),
        'published' => isset($_POST['published']),
    ];

    if ($data['title'] === '' || $data['summary'] === '' || $data['content'] === '') {
        $error = 'Naslov, kratki sadrzaj i tekst clanka su obavezni.';
    } elseif (save_article($data)) {
        $message = 'Clanak je spremljen.';
    } else {
        $error = 'Spremanje trazi aktivnu MySQL bazu. Uvezite database/rp_online.sql u phpMyAdmin.';
    }
}

$title = 'Novi clanak';
$active = 'admin';
require_once __DIR__ . '/../includes/header.php';
?>

<section class="form-panel wide">
    <h1>Novi clanak</h1>
    <?php if ($message): ?><p class="notice success"><?= e($message) ?></p><?php endif; ?>
    <?php if ($error): ?><p class="notice error"><?= e($error) ?></p><?php endif; ?>
    <form method="post">
        <label>Naslov
            <input type="text" name="title" required>
        </label>
        <label>Kategorija
            <select name="category">
                <option>Sport</option>
                <option>Politik</option>
            </select>
        </label>
        <label>Putanja slike
            <input type="text" name="image" value="assets/img/sport-1.png">
        </label>
        <label>Autor
            <input type="text" name="author" value="<?= e(current_user()['username']) ?>">
        </label>
        <label>Kratki sadrzaj
            <textarea name="summary" rows="3" required></textarea>
        </label>
        <label>Tekst clanka
            <textarea name="content" rows="10" required></textarea>
        </label>
        <label class="checkbox">
            <input type="checkbox" name="published" checked>
            Objavi clanak
        </label>
        <button type="submit">Spremi</button>
    </form>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
