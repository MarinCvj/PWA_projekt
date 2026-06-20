<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/data.php';

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function is_admin(): bool
{
    $user = current_user();
    return $user !== null && ($user['role'] ?? '') === 'admin';
}

function require_admin(): void
{
    if (!is_admin()) {
        header('Location: ../login.php');
        exit;
    }
}

function all_articles(bool $includeUnpublished = false): array
{
    $pdo = db();
    if ($pdo instanceof PDO) {
        $sql = 'SELECT * FROM articles';
        if (!$includeUnpublished) {
            $sql .= ' WHERE published = 1';
        }
        $sql .= ' ORDER BY category DESC, created_at DESC, id DESC';
        return $pdo->query($sql)->fetchAll();
    }

    return array_values(array_filter(fallback_articles(), static function (array $article) use ($includeUnpublished): bool {
        return $includeUnpublished || (int) $article['published'] === 1;
    }));
}

function articles_by_category(string $category): array
{
    return array_values(array_filter(all_articles(), static function (array $article) use ($category): bool {
        return strtolower($article['category']) === strtolower($category);
    }));
}

function find_article(string $slug): ?array
{
    $pdo = db();
    if ($pdo instanceof PDO) {
        $stmt = $pdo->prepare('SELECT * FROM articles WHERE slug = :slug AND published = 1 LIMIT 1');
        $stmt->execute(['slug' => $slug]);
        $article = $stmt->fetch();
        return $article ?: null;
    }

    foreach (fallback_articles() as $article) {
        if ($article['slug'] === $slug && (int) $article['published'] === 1) {
            return $article;
        }
    }

    return null;
}

function slugify(string $title): string
{
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $title);
    $slug = strtolower((string) $slug);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    return trim((string) $slug, '-') ?: 'clanak';
}

function save_article(array $data): bool
{
    $pdo = db();
    if (!$pdo instanceof PDO) {
        return false;
    }

    $stmt = $pdo->prepare(
        'INSERT INTO articles (title, slug, category, image, summary, content, author, published, created_at)
         VALUES (:title, :slug, :category, :image, :summary, :content, :author, :published, CURDATE())'
    );

    return $stmt->execute([
        'title' => $data['title'],
        'slug' => slugify($data['title']) . '-' . time(),
        'category' => $data['category'],
        'image' => $data['image'] ?: 'assets/img/sport-1.png',
        'summary' => $data['summary'],
        'content' => $data['content'],
        'author' => $data['author'],
        'published' => !empty($data['published']) ? 1 : 0,
    ]);
}

function login_user(string $username, string $password): bool
{
    $pdo = db();
    if ($pdo instanceof PDO) {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();
        $validPassword = $user && (
            password_verify($password, $user['password_hash']) ||
            hash_equals($user['password_hash'], hash('sha256', $password))
        );

        if ($validPassword) {
            $_SESSION['user'] = ['id' => $user['id'], 'username' => $user['username'], 'role' => $user['role']];
            return true;
        }
        return false;
    }

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['user'] = ['id' => 1, 'username' => 'admin', 'role' => 'admin'];
        return true;
    }

    return false;
}

function register_user(string $username, string $password): bool
{
    $pdo = db();
    if (!$pdo instanceof PDO) {
        return false;
    }

    $stmt = $pdo->prepare('INSERT INTO users (username, password_hash, role) VALUES (:username, :password_hash, :role)');
    return $stmt->execute([
        'username' => $username,
        'password_hash' => password_hash($password, PASSWORD_DEFAULT),
        'role' => 'user',
    ]);
}
