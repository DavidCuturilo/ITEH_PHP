<?php 

require '../dbBroker.php';
require '../model/izdavanje.php';

if(isset($_POST['id'])){
    $dummy = new Izdavanje($_POST['id']);
    $status = $dummy->deleteById($conn);

    if($status){
        echo "Success";
    }else {
        echo "Failed";
    }
}


?>