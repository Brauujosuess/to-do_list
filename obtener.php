<?php 
class Conexion {
    private $SERVER = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'registro';
    public $conn;
    
    public function __construct(){
        $this->conn = new mysqli($this->SERVER, $this->username, $this->password, $this->database);
        
        if ($this->conn->connect_error) {
            die("Error en la conexión: " . $this->conn->connect_error);
        }
    }
 }
 

class ObtenerTareas extends Conexion {
        function obtenerTareas() {
            session_start();
            $id=$_SESSION['id_usuario'];
            $sql = "SELECT*FROM tareas WHERE id_usuario = $id";  
                    
            $result = $this->conn->query($sql);            
            if ($result) {
                if ($result->num_rows > 0) {
                    $tareas = array();                 
                    while ($row = $result->fetch_assoc()) {
                        $tareas[] = $row['tarea'];
                    }                    
                    $response = ['status' => 200, 'msg' => 'Datos correctos', 'tareas' => $tareas];
                } else {
                    $response = ['status' => 0, 'msg' => 'No se encontraron tareas'];
                }
            } else {
                $response = ['status' => 500, 'msg' => 'Error al ejecutar la consulta: ' . $this->conn->error];
            }            
            echo json_encode($response);
        }
    }
    


$objet= new ObtenerTareas();
$objet->obtenerTareas();
?>