<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/functions.php';
$active = $active ?? '';
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$pathPrefix = strpos($scriptName, '/admin/') !== false ? '../' : '';
$basePath = BASE_URL !== '' ? BASE_URL : $pathPrefix;
?>
<!doctype html>
<html lang="hr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? APP_NAME) ?></title>
    <link rel="stylesheet" href="<?= e($basePath) ?>assets/css/style.css">
</head>
<body>
<header class="site-header">
    <a class="brand" href="<?= e($basePath) ?>index.php"><span>RP</span> ONLINE</a>
    <nav class="main-nav" aria-label="Glavna navigacija">
        <a class="<?= $active === 'home' ? 'active' : '' ?>" href="<?= e($basePath) ?>index.php">Home</a>
        <a class="<?= $active === 'sport' ? 'active' : '' ?>" href="<?= e($basePath) ?>category.php?name=Sport">Sport</a>
        <a class="<?= $active === 'politik' ? 'active' : '' ?>" href="<?= e($basePath) ?>category.php?name=Politik">Politik</a>
        <a class="<?= $active === 'admin' ? 'active' : '' ?>" href="<?= e($basePath) ?>admin/index.php">Administracija</a>
    </nav>
</header>
<main class="page-shell">
