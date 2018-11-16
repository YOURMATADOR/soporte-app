<?php

include("../sesionActiva.php");

?>
<?php
set_time_limit(90);
//mostrar mensaje de espera
echo "Enviando datos al Servidor...<br><br>Por favor espere unos momentos...<br><br>";
ob_end_flush();    
flush();

//declarar variables
$servername = "localhost";
$username   = "yourmatador";
$password   = "mansanita";
$dbname     = "proyecto_santo";

$yaExisteMismoIncidente = FALSE;

//asignar los datos segun el usuario y su opcion elegida
$id = $_SESSION['user'];
$idDelUsuario      ="'$id'";
$idTipoDeIncidente = $_POST['tipoIncidente'];
$desc              = $_POST['textoDescripcion'];
$descripcion = "'$desc'";

/*
echo "<br><br>ID usuario:    $idDelUsuario<br><br>";
echo "<br><br>Incidente:     $idTipoDeIncidente<br><br>";
echo "<br><br>Descripcion:   $descripcion<br><br>";
*/

/*
$idDelUsuario = 1;
$idTipoDeIncidente = 2;
$descripcion = "'al dar click para llenar mi reporte la pagina no me muestra nada'";
*/

switch ($idTipoDeIncidente) 
{
	case '1':
		$idTipoDePrioridad = 1;
		break;
	case '2':
		$idTipoDePrioridad = 2;
		break;
	case '3':
		$idTipoDePrioridad = 3;
		break;
	case '4':
		$idTipoDePrioridad = 4;
		break;	
	case '5':
		$idTipoDePrioridad = 5;
		break;	
	default:
		# code...
		break;
}

// Crear la conexion a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// revisar conexion
if ($conn->connect_error) 
{
    die("Error al conectar a la Base de Datos: " . $conn->connect_error);
}

//revisar si ya existe el mismo incidente reportado por la misma persona
$sql = "SELECT tipo FROM incidentes WHERE usuario = $idDelUsuario";

$result = $conn->query($sql);

if ($result->num_rows > 0) 
{    
    while($rowRegistrado = $result->fetch_assoc()) 
    {        
        $tipoRegistrado      = $rowRegistrado["tipo"];

        if ($tipoRegistrado == $idTipoDeIncidente)
        {
        	$yaExisteMismoIncidente = TRUE;
        }        
    }    
}

$conn->close();

//echo "<br><br>yaExisteMismoIncidente = $yaExisteMismoIncidente<br><br>";

if ($yaExisteMismoIncidente)
{
	registrarDatosEnProblemas($servername, $username, $password, $dbname, $idDelUsuario,$idTipoDeIncidente, $descripcion, $idTipoDePrioridad);	
}
else
{
	registrarDatosEnIncidentes($servername, $username, $password, $dbname, $idDelUsuario,$idTipoDeIncidente, $descripcion, $idTipoDePrioridad);	
}

function registrarDatosEnIncidentes($servername, $username, $password, $dbname, $idDelUsuario,$idTipoDeIncidente, $descripcion, $idTipoDePrioridad)
{
	// Crear la conexion a la base de datos
	$conn = new mysqli($servername, $username, $password, $dbname);

	// revisar conexion
	if ($conn->connect_error) 
	{
    	die("Error al conectar a la Base de Datos: " . $conn->connect_error);
	}

	$sql = "INSERT INTO incidentes (id_incidente, tipo, usuario, email, descripcion, prioridad, tiempo_respuesta) SELECT MAX(id_incidente)+1, (SELECT id_tipo_incidente FROM tipo_incidente WHERE id_tipo_incidente = $idTipoDeIncidente), (SELECT nombre_usuario FROM usuario WHERE nombre_usuario = $idDelUsuario), (SELECT correo FROM usuario WHERE nombre_usuario = $idDelUsuario), $descripcion, (SELECT id_prioridad FROM tipo_prioridad WHERE id_prioridad = $idTipoDePrioridad), (SELECT tiempo_resolucion FROM tipo_prioridad WHERE id_prioridad = $idTipoDePrioridad) FROM incidentes, tipo_incidente, tipo_prioridad, usuario;";

	//echo"<br><br>QUERY: $sql<br><br>";
	//$result = $conn->query($sql);
	if ($conn->query($sql) === TRUE) 
	{   
    	echo "Se han registrado los datos exitosamente!<br><br>Enviando correo de confirmación...<br><br>";

    	echo "<script>window.location.href='correo_incidente.php';</script>";
    	/*$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1/mail_thruPHPMailer3.php");
    	curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	$output = curl_exec($ch);
    	curl_close($ch);
    
    	echo "<pre>$output</pre>";*/
	} 
	else 
	{    
	    echo "Error: " . $sql . "<br>" . $conn->error;    
	}

	$conn->close();
}

function registrarDatosEnProblemas($servername, $username, $password, $dbname, $idDelUsuario,$idTipoDeIncidente, $descripcion, $idTipoDePrioridad)
{
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
    	die("Error al conectar a la Base de Datos: " . $conn->connect_error);
	}

	$sql = "INSERT INTO problemas (id_problema, tipo, usuario, email, descripcion, prioridad, tiempo_respuesta) SELECT MAX(id_problema)+1, (SELECT id_tipo_incidente FROM tipo_incidente WHERE id_tipo_incidente = $idTipoDeIncidente), (SELECT nombre_usuario FROM usuario WHERE nombre_usuario = $idDelUsuario), (SELECT correo FROM usuario WHERE nombre_usuario = $idDelUsuario), $descripcion, (SELECT id_prioridad FROM tipo_prioridad WHERE id_prioridad = $idTipoDePrioridad), (SELECT tiempo_resolucion FROM tipo_prioridad WHERE id_prioridad = $idTipoDePrioridad) FROM problemas, tipo_incidente, tipo_prioridad, usuario;";
	
	//echo"<br><br>QUERY: $sql<br><br>";
	if ($conn->query($sql) === TRUE) 
	{   
    	echo "Hemos detectado que ya nos habias reportado este Incidente, por lo que le daremos mas prioridad a este reporte el cual se ha registrado ya como un Problema.<br><br>Enviando correo de confirmación...<br><br>";

    	echo "<script>window.location.href='correo_problema.php';</script>";
	} 
	else 
	{    
	    echo "Error: " . $sql . "<br>" . $conn->error;    
	}

	$conn->close();
}
     
?>