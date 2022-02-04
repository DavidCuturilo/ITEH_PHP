<?php 

class Izdavanje{
    public $id;
    public $naziv_knjige;
    public $pisac;
    public $datum_izdavanja;
    public $user_id;

    public function __construct($id=null,$naziv_knjige=null,$pisac=null,$datum =null, $user_id=null)
    {
        $this->id = $id;
        $this->naziv_knjige = $naziv_knjige;
        $this->pisac = $pisac;
        $this->datum_izdavanja = $datum;
        $this->user_id = $user_id;
    }


    public static function getAll(mysqli $conn){
        $query = "SELECT * FROM izdavanje";
        return $conn->query($query);
    }

    public static function getById($id, mysqli $conn){
        $query = "SELECT * FROM izdavanje WHERE id=$id";

        $obj = array();
        if($msqlObj = $conn->query($query)){
            while($red = $msqlObj->fetch_array()){
                $obj[] = $red;
            }
        }
        return $obj;
    }

    public function deleteById(mysqli $conn){
        $query = "DELETE FROM izdavanje WHERE id=$this->id";
        return $conn->query($query);
    }

    public static function update(Izdavanje $izdavanje,mysqli $conn){
        $query = "UPDATE izdavanje SET naziv_knjige = '$izdavanje->naziv_knjige', pisac = '$izdavanje->pisac', datum_izdavanja='$izdavanje->datum_izdavanja', user_id=$izdavanje->user_id WHERE id=$izdavanje->id";
        return $conn->query($query);
    }

    public static function add(Izdavanje $izdavanje, mysqli $conn){
        $query = "INSERT INTO izdavanje (naziv_knjige,pisac,datum_izdavanja,user_id) VALUES ('$izdavanje->naziv_knjige','$izdavanje->pisac','$izdavanje->datum_izdavanja','$izdavanje->user_id')";
        return $conn->query($query);
    }

    public static function sort(mysqli $conn){
        $query = "SELECT * FROM izdavanje ORDER BY datum_izdavanja DESC";
        return $conn->query($query);
    }

    public static function getByWriterName($pisac,mysqli $conn){
        $query = "SELECT * FROM izdavanje WHERE pisac='$pisac'";
        return $conn->query($query);
    }

}

?>