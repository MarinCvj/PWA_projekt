<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

function db(): ?PDO
{
    static $pdo = null;
    static $tried = false;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    if ($tried) {
        return null;
    }

    $tried = true;

    try {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return $pdo;
    } catch (PDOException $error) {
        return null;
    }
}
