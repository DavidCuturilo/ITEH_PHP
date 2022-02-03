<?php

require "dbBroker.php";
require "model/user.php";

session_start();
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $korisnik = new User(1,$username,$password);

    $res = User::logInUser($korisnik,$conn);

    if($res->num_rows==1){
        print `<script> console.log("Uspesna prijava!"); </script>`;
        $_SESSION['user_id'] = $korisnik->id;
        header('Location: home.php');
        exit();
    } else {
        print "$res->num_rows";
        print `<script> console.log("Neuspesna prijava!"); </script>`;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Narodna biblioteka Srbija: Prijava</title>
    <link rel="icon" type="image/jpg" href="img/favicon.jpg"/>

</head>
<body>
    <div class="login-form">
        <div class="main-div">
            <form method="POST" action="#">
                <div class="container">
                    <input type="text" name="username" class="form-control" placeholder="Korisnicko ime" required>
                    <br>
                    <input type="password" name="password" placeholder="Lozinka" class="form-control" required>
                    <button type="submit" class="btn btn-primary" name="submit">Prijavi se</button>
                </div>

            </form>
        </div>

        
    </div>
</body>
</html>