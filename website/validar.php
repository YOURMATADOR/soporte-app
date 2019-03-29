<?php
session_start();
require 'conexion.php';

$usuario = $_POST['usuario'];
$contra = $_POST['contra'];


$sql = "SELECT * FROM usuario WHERE nombre_usuario='$usuario'";

$resultado = mysqli_query($conn, $sql);
while ($renglon = mysqli_fetch_assoc($resultado)) {

    $usr = $renglon['nombre_usuario'];
    $contrasenia = $renglon['contrasenia'];
    $nomb = $renglon[3] . " " . $renglon[4];

}

if ($usuario == $usr) {
    if ($contra == $contrasenia) {

        $_SESSION['user'] = $usuario;
        $_SESSION['nombre'] = $nomb;
        $_SESSION['activo'] = "SI";
        if (isset($_SESSION['user'])) {
            ?>
<script type="text/javascript">

let usuario  = '<?php echo $usr; ?>';

		location="http://localhost:3000/docs/doc1.html";

</script>


<?php

}

}//contrasenia correcta
else {
    ?>
<script type="text/javascript">
    alert("Contraseña invalida");
    		location="index.html";

</script>
<?php

}
} else {
    ?>
<script type="text/javascript">
    alert("Usuario invalido");
    		location="index.html";

</script>
<?php

}
?>