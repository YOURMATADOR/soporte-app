<?php


?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="shortcut icon" href="sonriente.png" type="image/png">
	<title>Contactanos</title>

<style>
div.col h1{
		
		color:#445FF1;
	}
	div.col h2{
		
		color:#445FF1;
	}
	label,a 
	{
		font-family : Arial, Helvetica, sans-serif;
		font-size : 12px; 
	
	}

</style>	
<!-- script con validadores de campos -->
<script language="JavaScript" src="scripts/gen_validatorv31.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>

<!-- Latest compiled and minified Locales -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/locale/bootstrap-table-zh-CN.min.js"></script>
</head>	

<body class="container bg-light">
<ul class="nav justify-content-center navbar-fixed-top mb-5" style="background-color:#445FF1; border-radius:10px;">
	<li class="nav-item">
		<a class="" href="http://localhost:3000/docs/doc1.html" style="color:white;"><h3>Volver</h3></a>
	</li>
	
</ul>

<div class="col text-center">
	
<h1>Contactanos! Usuario</h1>
	<h2>Explícanos tu problema:</h2>

	<form method="POST" name="formularioDeContacto" action="htdocs/llenar_DB.php"> 
<div class="form-group">


	<p>
		<label for='tipoIncidente'>Tipo de Incidente:</label> <br>
		<select name="tipoIncidente" class="form-control">
			<option value = 1 >Error de Loggeo</option>
			<option value = 2 >Falla al cargar formularios</option>
			<option value = 3 >Mi reporte no es atendido</option>
			<option value = 4 >Me llegan correos ajenos</option>
			<option value = 5 >Otro...</option>
		</select>
	</p>

	<p>
		<label for='textoDescripcion'>Descripción del Incidente:</label> <br>
		<textarea name="textoDescripcion" class="form-control"></textarea>
	</p>

	<input type="submit" value="Enviar" class="btn btn-block btn-outline-success"><br>
</div>
</form>

<script language="JavaScript">

	var frmvalidator  = new Validator("formularioDeContacto");
	frmvalidator.addValidation("name","req","Por favor, ingresa tu nombre"); 
	frmvalidator.addValidation("email","req","Por favor, ingresa tu email"); 
	frmvalidator.addValidation("email","email","Por favor, ingresa una dirección de email válida"); 

</script>
<script src="https://cdn.jsdelivr.net/npm/@widgetbot/crate@3" async defer>
  const button = new Crate({
    server: '434086966460547082',
    channel: '434086966460547085'
  });
    button.notify('Bienvenido a la pagina de soporte');
</script>
</div>
</body>
</html>