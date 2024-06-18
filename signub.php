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
 
class signup extends Conexion{

    public function registro(){
        
        $data = json_decode(file_get_contents('php://input'));
 
        $correo = filter_var($data->correo, FILTER_SANITIZE_EMAIL);
        $password = filter_var($data->contraseña, FILTER_SANITIZE_STRING);
        $confirm_password = filter_var($data->confi_contra, FILTER_SANITIZE_STRING);
        session_start();
     $id_usuario = $_SESSION["id_usuario"];
        
        // Verificar si el correo ya está registrado
        $checkEmailQuery = $this->conn->prepare("SELECT id_usuario FROM registros WHERE usuario = ?"); 
        $checkEmailQuery->bind_param("s", $correo);
        $checkEmailQuery->execute();
        $result = $checkEmailQuery->get_result();

        if ($result->num_rows > 0) {
            // El correo ya está registrado
            $response = array("response" => false, "msg" => "El correo ya está registrado");
            echo json_encode($response);
        } else {
            // Insertar los datos
            $sql = $this->conn->prepare("INSERT INTO registros (usuario, contrasena, confirmar_contrasena) VALUES(?,?,?)");
            
            if ($sql === false) {
                die("Error en la preparación de la consulta: " .$this->conn->error);
            }

            $sql->bind_param("sss", $correo, $password, $confirm_password);
            
            if ($sql->execute()) {
                $response = array("response" => true, "msg" => "Los datos se insertaron con éxito");
                echo json_encode($response);
            } else {
                $response = array("response" => false, "msg" => "Error al insertar los datos: " . $this->conn->error);
                echo json_encode($response);
            }

            $sql->close();
        }

        $checkEmailQuery->close();
    }
}

$objeto = new signup();
$objeto->registro();

?>
