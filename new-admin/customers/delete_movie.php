<?php
include_once '../common/session.php';
include_once '../common/dbConnection.php';
if(isset($_POST) && $_POST['customer_id']!='') {
    $strDeleteQuery = "DELETE FROM customers WHERE id = '".$_POST['customer_id']." '";
    $result = $conn->query($strDeleteQuery);
    if($result) {
        header("Location:list-movies.php");
        exit;
    }
}