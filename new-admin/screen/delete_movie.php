<?php
include_once '../common/session.php';
include_once '../common/dbConnection.php';
if(isset($_POST) && $_POST['screen_id']!='') {
    $strDeleteQuery = "DELETE FROM theater_show WHERE id = '".$_POST['screen_id']." '";
    $result = $conn->query($strDeleteQuery);
    if($result) {
        header("Location:list-movies.php");
        exit;
    }
}