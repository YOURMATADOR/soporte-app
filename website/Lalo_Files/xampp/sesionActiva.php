<?php
@session_start();
if ($_SESSION['activo'] != "SI") {


    header("location:http://localhost/website/");
    exit();
}
$_SESSION['user'];

?>