<?php
declare(strict_types=1);

define('APP_NAME', 'RP ONLINE');
define('BASE_URL', '');

define('DB_HOST', 'localhost');
define('DB_NAME', 'rp_online');
define('DB_USER', 'root');
define('DB_PASS', '');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
