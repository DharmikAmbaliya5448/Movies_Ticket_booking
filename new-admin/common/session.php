<?php
error_reporting(0);
session_start();
$protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';

define('LOCALHOST', 'localhost' === $_SERVER['SERVER_NAME'] || '127.0.0.1' === $_SERVER['SERVER_NAME']);
// best to set paths with a trailing slash
if (LOCALHOST) {
    define('ADMIN_BASE_URL', $protocol . "://" . $_SERVER['HTTP_HOST'] . '/PHP_Movies/online-movie-booking-main/new-admin');
} else {
    define('ADMIN_BASE_URL', $protocol . "://" . $_SERVER['HTTP_HOST'] . '/new-admin');
}

if ($_SESSION['admin'] === null) {
    $strLogin = ADMIN_BASE_URL . "/login/login.php";
    header("Location:" . $strLogin);
    exit;
}