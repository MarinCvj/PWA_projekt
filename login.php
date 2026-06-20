<?php
require_once __DIR__ . '/includes/functions.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (login_user($username, $password)) {
        header('Location: admin/index.php');
        exit;
    }

    $error = 'Neispravno korisnicko ime ili lozinka.';
}

$title = 'Prijava';
$active = 'admin';
require_once __DIR__ . '/includes/header.php';
?>

<section class="form-panel">
    <h1>Prijava</h1>
    <?php if ($error): ?><p class="notice error"><?= e($error) ?></p><?php endif; ?>
    <form method="post">
        <label>Korisnicko ime
            <input type="text" name="username" required>
        </label>
        <label>Lozinka
            <input type="password" name="password" required>
        </label>
        <button type="submit">Prijavi se</button>
    </form>
    <p class="hint">Bez baze radi demo prijava: admin / admin123.</p>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
