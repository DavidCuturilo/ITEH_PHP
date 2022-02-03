<?php 

require "dbBroker.php";
require "model/izdavanje.php";

session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: index.php');
    exit();
}

if(isset($_GET['sort'])) {
    echo "SORTIRANJE";
    $podaci = Izdavanje::sort($conn);
}else $podaci = Izdavanje::getAll($conn);

if(!$podaci){
    echo "Nastala je greska prilikom preuzimanja podataka iz tabele iznajmljivanje";
    die();
}

if($podaci->num_rows==0){
    echo "Ne postoji nijedno aktivno iznajmljivanje.";
    die();
}

else {

?>



<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link rel="shortcut icon" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <title>Narodna biblioteka</title>
    <link rel="icon" type="image/jpg" href="img/favicon.jpg"/>

</head>

<body>


<div class="jumbotron" style="color: black;"><h1>Narodna biblioteka Srbije</h1></div> 

<div class="row header-buttons" style="background-color: rgba(225, 225, 208, 0.5);">
    <!-- <div class="col-md-4">
        <button id="btn" class="btn btn-info btn-block" 
        style="background-color: teal !important; border: 1px solid white; ">Prikazi izdavanja knjiga</button>
    </div> -->
    <div class="col-md-4">
        <button id="btn-dodaj" type="button" class="btn btn-success btn-block btn-header" data-toggle="modal" data-target="#myModal"> Iznajmi knjigu</button>

    </div>
    <div class="col-md-4">
        <button id="btn-pretraga" class="btn btn-warning btn-block btn-header"> Pretrazi izdavanja knjiga</button>
        <input type="text" id="myInput" onkeyup="funkcijaZaPretragu()" placeholder="Pretrazi kolokvijume po predmetu" hidden>
    </div>
</div>

<div id="pregled" class="panel panel-success" style="margin-top: 1%;">
    
    <div class="panel-body">
        <table id="myTable" class="table table-hover table-striped" style="color: black;" >
            <thead class ="thead">
            <tr >
                <th scope="col">Knjiga</th>
                <th scope="col">Pisac</th>    
                <th scope="col">Datum</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody class="tbody">
            <?php
            while ($red = $podaci->fetch_array()): 
                ?>
                <tr>
                    <td><?php echo $red["naziv_knjige"] ?></td>
                    <td><?php echo $red["pisac"] ?></td>
                    <td><?php echo $red["datum_izdavanja"] ?></td>
                    <td>
                        <label class="custom-radio-btn">
                            <input type="radio" name="checked-donut" value=<?php echo $red["id"] ?>>
                            <span class="checkmark"></span>
                        </label>
                    </td>

                </tr>
                <?php
                endwhile; 
            }             
            ?>
            </tbody>
        </table>
        <div class="row" >
            
            
            <div class="col-md-12" style="text-align: right;">
                <div class="col-md-1" style="text-align: left">
                    <button id="btn-izmeni" class="btn btn-warning" data-toggle="modal" data-target="#izmeniModal">Izmeni</button>
                </div>
                <div class="col-md-2" style="text-align: left;">
                    <button id="btn-sortiraj" name="sort" class="btn btn-normal">Sortiraj</button>
                </div>
                    <button id="btn-obrisi" class="btn btn-danger" style="background-color: red; border: 1px solid white;">Obrisi</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog">

        <!--Sadrzaj modala-->
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container prijava-form">
                    <form action="#" method="post" id="dodajForm">
                        <h3 style="color: black; text-align: center" >Iznajmi knjigu</h3>
                        <div class="row">
                            <div class="col-md-11 ">
                                <div class="form-group">
                                    <label for="">Knjiga</label>
                                    <input type="text" style="border: 1px solid black" name="naziv_knjige" class="form-control"/>
                                </div>
                                <div class="form-group">
                                <label for="">Pisac</label>
                                    <input type="text" style="border: 1px solid black" name="pisac" class="form-control"/>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Datum</label>
                                    <input type="date"  style="border: 1px solid black" name="datum_izdavanja" class="form-control"/>
                                </div>
                                </div>
                                <div class="form-group">
                                    <button id="btnDodaj" type="submit" class="btn btn-success btn-block"
                                    style="background-color: orange; border: 1px solid black;">Zakazi</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>



 </div>
<!-- Modal -->
<div class="modal fade" id="izmeniModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal sadrzaj-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container prijava-form">
                    <form action="#" method="post" id="izmeniForm">
                        <h3 style="color: black">Izmeni iznajmljivanje</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="id" type="text" name="id" class="form-control"
                                           placeholder="Id *" value="" readonly />
                                </div>
                                <div class="form-group">
                                    <input id="knjiga" type="text" name="naziv_knjige" class="form-control"
                                           placeholder="Knjiga*" value=""/>
                                </div>
                                <div class="form-group">
                                    <input id="pisac" type="text" name="pisac" class="form-control"
                                           placeholder="Pisac *" value=""/>
                                </div>
                                <div class="form-group">
                                    <input id="datum" type="date" name="datum_izdavanja" class="form-control"
                                           placeholder="Datum *" value=""/>
                                </div>
                                <div class="form-group">
                                    <button id="btnIzmeni" type="submit" class="btn btn-success btn-block"
                                            style="color: white; background-color: orange; border: 1px solid white"> Izmeni
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
            </div>
        </div>



</div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>



</body>
</html>
