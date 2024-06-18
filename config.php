<?php 

include_once ('inport.json');

$servidor = json_decode(file_get_contents('inport.json'))[0]; // Accede al primer elemento del array
defined('host') ? NULL : define('host', $servidor->host);
defined('username') ? NULL : define('username', $servidor->user);
defined('password') ? NULL : define('password', $servidor->contra);
defined('database') ? NULL : define('database', $servidor->database);

$GLOBALS['conn'] = new mysqli(host, username, password, database); // Utiliza las constantes correctamente
// Verificar si hay errores en la conexión
if ($servidor->connect_error) {
    die("Error en la conexión: " . $servidor->connect_error);
}

// $rutas = array(
//     "indexJs" => "src/js/index.js",
//     "regisjs" => "src/js/regis.js"
// );
?>



