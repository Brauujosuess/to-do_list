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
 

class InsertTa extends Conexion {  
    // Método para insertar una tarea en la base de datos
    public function insertar() {
        session_start();
        $id = $_SESSION['id_usuario'];
        $data = json_decode(file_get_contents("php://input"));
        $tarea = $data->tarea;

        // Preparar la consulta SQL para insertar la tarea
        $sql = $this->conn->prepare("INSERT INTO tareas (tarea,id_usuario) VALUES (?,?)");
        // Verificar si la consulta se preparó correctamente
        if (!$sql) {
            die("Error al preparar la consulta: " . $this->conn->error);
        }
        // Vincular los parámetros de la consulta con los valores proporcionados
        $sql->bind_param('si', $tarea,$id);
       $json= json_encode($sql);
        // Ejecutar la consulta
        if ($sql->execute()) {
            
            $response = array("response" => true, "msg" => "Los datos se insertaron con éxito");
            echo json_encode($response);
        } else {
            $response = array("response" => false, "msg" => "Error al insertar los datos: " . $this->conn->error);
            echo json_encode($response);
        }
    }
}

// Crear una instancia de la clase InsertTa y llamar al método insertar
$objeto = new InsertTa();
$objeto->insertar();
?>
