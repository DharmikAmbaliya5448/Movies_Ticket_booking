<?php
include_once '../common/session.php';
include_once '../common/dbConnection.php';
if(isset($_POST) && $_POST['user_id']!='') {
    $strDeleteQuery = "DELETE FROM user WHERE id = '".$_POST['user_id']." '";
    $result = $conn->query($strDeleteQuery);
    if($result) {
        header("Location:list-movies.php");
        exit;
    }
}