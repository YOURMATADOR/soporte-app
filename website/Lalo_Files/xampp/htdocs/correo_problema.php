<?php
set_time_limit(90);
//incluir los archivos PHP para enviar correo
require("../../PHPMailer-master/src/PHPMailer.php");
require("../../PHPMailer-master/src/SMTP.php");

//declarar variables
$servername = "localhost";
$username = "yourmatador";
$password = "mansanita";
$dbname = "proyecto_santo";

// Crear la conexion a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// revisar conexion
if ($conn->connect_error) 
{
    die("Error al conectar a la Base de Datos: " . $conn->connect_error);
}

//correr el query
$sql = "SELECT 
    id_problema,
    (SELECT nombre_usuario FROM usuario, problemas WHERE nombre_usuario = 
        (SELECT usuario FROM problemas WHERE id_problema = (select max(id_problema) from problemas)) LIMIT 1) as usuario, 
    email, 
    (select descripcion_prioridad from tipo_prioridad where id_prioridad = 
        (SELECT prioridad FROM problemas WHERE id_problema = (select max(id_problema) from problemas))) as prioridad, 
    tiempo_respuesta 
    FROM problemas WHERE id_problema = (select max(id_problema) from problemas);";


$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {   
        $numeroProblema  = $row["id_problema"];
        $nombreUsuario   = $row["usuario"];
        $correoUsuario   = $row["email"];
        $prioridad       = $row["prioridad"];
        $tiempoRespuesta = $row["tiempo_respuesta"];
    }
} 
else 
{
    echo "<br><br><br>No se encontraron resultados.<br><br><br>";
}

//cerrar la conexion
$conn->close();

//enviar correo
    $image = "<center> <img src=\"http://tonala.gob.mx/portal/wp-content/uploads/2015/10/200x135.png \" alt = \"Ayuntamiento de Tonalá\"> </center>";
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "tonala.te.escucha@gmail.com";
    $mail->Password = "I_kunnen001";
    $mail->SetFrom("tonala.te.escucha@gmail.com");    
    $mail->Subject = "Problema # $numeroProblema recibido";
    $mail->Body = "
                    Hola <b><i>$nombreUsuario</i></b>, <br><br>
                    
                    Hemos recibido tu reporte y estaremos trabajando para solucionarlo lo antes posible ya que entendemos que es la segunda vez que nos lo reportas, por lo que la prioridad que le daremos para resolverlo es: <b><i>$prioridad</i></b>, 
                    por lo tanto el tiempo de resolucion sera en un lapso de <b><i>$tiempoRespuesta</i>
                    </b><br><br>

                    Gracias por ponerte en contacto de nuevo con nosotros.<br><br>

                    Atte. Equipo de TonalApp.<br><br>

                    $image";

    $mail->AddAddress("$correoUsuario");

     if(!$mail->Send()) 
     {
        echo "Se produjo un Error: " . $mail->ErrorInfo;
     } 
     else 
     {        
        header('Location: gracias.php');

     }     
?>