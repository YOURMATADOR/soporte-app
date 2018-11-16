<?php
@session_start();
if ($_SESSION['activo'] != "SI") {


    header("location: index.html");
    exit();
}
$_SESSION['user'];

?>