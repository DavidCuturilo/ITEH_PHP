<?php 

require '../dbBroker.php';
require '../model/izdavanje.php';

session_start();
$_SESSION['sort'] = 1;
    $status = Izdavanje::sort($conn,$_SESSION['user_id']);
        if($status){
            echo "Success";
        } else {
            echo $status;
            echo "Failed";
        }

?>