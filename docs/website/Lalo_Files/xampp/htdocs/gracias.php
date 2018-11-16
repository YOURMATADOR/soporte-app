<?php

include("../sesionActiva.php");

?>


<!DOCTYPE HTML> 
<html>
<head>
	<title>Gracias!</title>
<script language="JavaScript" src="scripts/gen_validatorv31.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>

<!-- Latest compiled and minified Locales -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-CN.min.js"></script>
</head>	
<style>
	h1
	{
		font-family : Arial, Helvetica, sans-serif;
		font-size : 40px;
    	font-weight : bold;
	}

label,a,body
	{
		font-family : Arial, Helvetica, sans-serif;
		font-size : 12px; 
	}
img.col-3:hover{
	padding:10px;
	width:300;
	height:300;
	transition: all .5s;
}
img.col-3{
	transition: all .5s;
}
</style>	

</head>

<body class="jumbotron">
	<div class="col text-center">
	<h1>Gracias! <?php echo $_SESSION['user']; ?></h1>
<img src="sonriente.png" alt="" class="col-3">
	<h4><kbd>Te hemos enviado un correo de confirmacion a tu direccion de e-Mail registrada, revisa tu bandeja de entrada!</kbd></h4>
	</div>

	<script>
	function name() {
		
	
setTimeout(() => {
  window.location.href="http://localhost:3000/docs/doc1.html"
}, 3000);
}
name();
	</script>


</body>
</html>