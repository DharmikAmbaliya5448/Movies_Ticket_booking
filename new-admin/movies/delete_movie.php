<?php
include_once '../common/session.php';
include_once '../common/dbConnection.php';
if(isset($_POST) && $_POST['movie_id']!='') {
    $strDeleteQuery = "DELETE FROM add_movie WHERE id = '".$_POST['movie_id']." '";
    $result = $conn->query($strDeleteQuery);
    if($result) {
        header("Location:list-movies.php");
        exit;
    }
}