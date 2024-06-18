<?php 
session_start();
error_reporting(0);

$validar = $_SESSION['id_usuario'];

print_r($validar);
if ($validar == null || $validar == '') {
    echo "Usuario no validado";
     die();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body> 
    <div class="tareas">
    <input type="text" class="clase" id="tarea" placeholder="ingresa alguna tarea" name="tareas">
    <button class="estilo" id="btn1" onclick="agregar_tarea()" >agregar</button>

    </div>
   <ul  id="lista_tareas">
     
   </ul>     

</body>
<script src="src/js/index.js"> </script> 
</html>