<?php 

require '../dbBroker.php';
require '../model/izdavanje.php';

session_start();
if(isset($_POST['naziv_knjige']) && isset($_POST['pisac']) && isset($_POST['datum_izdavanja']) && isset($_POST['id'])){
    $izdavanje = new Izdavanje($_POST['id'],$_POST['naziv_knjige'],$_POST['pisac'],$_POST['datum_izdavanja'], $_SESSION['user_id']);
    $status = Izdavanje::update($izdavanje,$conn);

    if($status){
        echo "Success";
    }else {
        echo "Failed with status: ".$status;
    }
}

?>