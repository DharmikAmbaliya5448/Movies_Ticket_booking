<?php
include_once 'common/session.php';
if(!empty($_SESSION['admin'])) {
    $strMovies = ADMIN_BASE_URL . "/movies/list-movies.php";
    header("Location:".$strMovies);
    exit;
}