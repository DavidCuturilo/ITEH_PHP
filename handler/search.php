<?php 

require '../dbBroker.php';
require  '../model/izdavanje.php';

session_start();
if($_POST['searchName']){
    $status = Izdavanje::getByWriterName($_POST['searchName'],$conn);
    if($status){
        $_SESSION['search']=$_POST['searchName'];
        echo "Success";
    }else {
        echo "Failed with status: ".$status;
    }
} else echo "Search id not set"
?>