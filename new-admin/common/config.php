<?php
define('LOCALHOST', 'localhost' === $_SERVER['SERVER_NAME']);
// best to set paths with a trailing slash
if (LOCALHOST) {
    define('ADMIN_PATH', $_SERVER['DOCUMENT_ROOT'] . '/PHP_Movies/online-movie-booking-main/new-admin');
} else {
    define('ADMIN_PATH', $_SERVER['DOCUMENT_ROOT'] . '/new-admin');
}
echo ADMIN_PATH;
exit;