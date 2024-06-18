<?php

class Conexion {
     private $SERVER = 'localhost';
    private $username = 'root';
    private $password = '';
     private $database = 'registro';
    public $conn;
    $this->conn = new mysqli($SERVER, $username, $password, $database);
    
    if ($this->conn->connect_error) {
        die("Error en la conexión: " . $this->conn->connect_error);
    } 
}
class actualizar extends Conexion{
public function update(){
    $data = json_decode(file_get_contents('php://input'));
    

}



}
// class Conexion {
//     private $server = 'localhost';
//     private $username = 'a_20206962';
//     private $password = 'yz9xaPdA2gr';
//     private $database = 'a_20206962';
//     protected $conn;
//    public function __construct(){
//     $this->conect_bd();
   
//    }
    
//     public function conect_bd(){
    
//         $this->conn =  mysqli_connect($this->server, $this->username, $this->password, $this->database);
    
//         if (mysqli_connect_error()) {
//            die("Error en la conexión: " . mysqli_connect_error() . mysqli_connect_errno());
//   }
//  }   
// }



?> 