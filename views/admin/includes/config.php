<?php 

class database extends stdClass {

    public $conn='';

    public function __construct() {
         $this->conn=mysqli_connect('localhost','root','','products');
        return $conn=$this->conn;
    }

    public function execute($query){

        return mysqli_query($this->conn,$query);

    }

}

$dbConn=new database();

?>