<?php 

$host = "localhost";
$db = "biblioteka";
$user = "root";
$pass = ""; 

$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_errno){
    exit("Neuspesna konekcija sa bazom! Greska: ".$conn->connect_error." status kod: ".$conn->connect_err);
}

?>