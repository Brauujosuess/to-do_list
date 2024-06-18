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
 

class login extends Conexion {

    public function logeo(){
        $data = json_decode(file_get_contents("php://input"));
        $correo = $this->conn->real_escape_string($data->correo);
        $password = $this->conn->real_escape_string($data->password);

        $sql = $this->conn->prepare("SELECT id_usuario FROM registros WHERE usuario = ? AND contrasena = ?");
        
        $sql->bind_param("ss", $correo, $password);
        $sql->execute();
        $result = $sql->get_result();
       
        $data = $result->fetch_assoc();

        session_start();
        $_SESSION["id_usuario"] = $data["id_usuario"];
        
        if ($data) {
            $response = array("response" => true, "msg" => "este usuario");
            echo json_encode($response);
        } else {
            $response = array("response" => false, "msg" => "este usuario no existe " . $this->conn->error);
            echo json_encode($response);
        }

    }
}

$objet = new login();
$objet->logeo();

?>
