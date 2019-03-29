<?php
$servidor = 'localhost';
$usuario = 'yourmatador';
$contrasenia = 'mansanita';
$db = 'proyecto_santo';
$conn = mysqli_connect($servidor, $usuario, $contrasenia, $db);

if ($conn->connect_error) {

    die("Conexion fallida");
}
?>
