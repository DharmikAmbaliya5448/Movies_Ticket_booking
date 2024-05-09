<?php
include_once '../common/session.php';
include_once '../common/dbConnection.php';
if(isset($_POST) && $_POST['feedback_id']!='') {
    $strDeleteQuery = "DELETE FROM feedback WHERE id = '".$_POST['feedback_id']." '";
    $result = $conn->query($strDeleteQuery);
    if($result) {
        header("Location:list-movies.php");
        exit;
    }
}