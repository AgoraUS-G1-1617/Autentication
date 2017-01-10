<?php
session_start();
$excepcionPDO = $_SESSION['excepcionPDO'];
$_SESSION['excepcionPDO'] = null;
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Agor@us </title>
		<meta name="description" content="Plataforma de voto online" />
		<meta name="keywords" content=""/>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<link rel="stylesheet" type="text/css" href="./style/style.css" />
	</head>
	<body>
		<div style="margin-top: 250px;">
			<div id="div_errorInternoTitulo">
				<h1> ¡HA OCURRIDO UN ERROR INESPERADO! </h1>
			</div>

			<div id="div_errorInternoTexto">
				Ha ocurrido un error interno en la aplicación. <br/>
				Si el error persiste póngase en contacto con el administrador del sistema.
			</div>

			<div>
				<a href="./index.php"> Volver </a>
			</div>
		</div>

	</body>
</html>