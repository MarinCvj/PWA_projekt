<?php
require_once __DIR__ . '/includes/functions.php';
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (strlen($username) < 3 || strlen($password) < 6) {
        $error = 'Korisnicko ime mora imati barem 3 znaka, a lozinka barem 6 znakova.';
    } elseif (register_user($username, $password)) {
        $message = 'Registracija je uspjesna. Sada se mozete prijaviti.';
    } else {
        $error = 'Registracija trazi aktivnu MySQL bazu.';
    }
}

$title = 'Registracija';
require_once __DIR__ . '/includes/header.php';
?>

<section class="form-panel">
    <h1>Registracija</h1>
    <?php if ($message): ?><p class="notice success"><?= e($message) ?></p><?php endif; ?>
    <?php if ($error): ?><p class="notice error"><?= e($error) ?></p><?php endif; ?>
    <form method="post">
        <label>Korisnicko ime
            <input type="text" name="username" required minlength="3">
        </label>
        <label>Lozinka
            <input type="password" name="password" required minlength="6">
        </label>
        <button type="submit">Registriraj se</button>
    </form>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
