<?php
/** 
* @file
* \brief Inicio de la aplicación
* \details Pantalla de inicio de la aplicación. Añade cabeceras, muestra 
* los mensajes de error de logAttempt.php y define la estructura del layout.
* \author auth.agoraUS
*/

include_once 'variables.php';

?>
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
	
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.mi.js"></script>
	<script type="text/javascript" src="bootstrap/js/npm.js"></script>
	<script type="text/javascript" src="bootstrap/js/index.js"></script>
	<script type="text/javascript" src="scripts/index.js"></script>
	
	<link rel="stylesheet" href="style/style.css" type="text/css">

	
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css">
	<link rel="stylesheet" href="styles/bootstrap/css/bootstrap-theme.css" type="text/css">
	<link rel="stylesheet" href="styles/bootstrap/css/bootstrap-theme.css.map" type="text/css">
	<link rel="stylesheet" href="styles/bootstrap/css/bootstrap.css.map" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
	

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title><?php echo TITLE?></title>
</head>
<body style="background-color: #F5F5F5;font-family: Roboto;">
	
	<div class="tituloInicio">
		<h1 style="font-size: 100px; font-family: Roboto">¡Bienvenidos a agor@us!</h1>
	</div>
	
	<div class="row">
  <div class="col-md-4">
  	<div class="loginDNIe">
		<h1 style="font-size: 40px;">Entrar con G+</h1>
		<input  onClick="location.href = 'loginGoogle.php' "
                            id="loginDNIe" 
                            type="button"
                            value ="Entra" 
                           	class="btn btn-info"/>
	</div>
  </div>
  <div class="col-md-4">
  	<div class="loginNotDNIe">
		<h1 style="font-size: 40px;">Entrar sin DNIe</h1>
		<input  onClick="location.href = 'loginNotDNIe.php' "
                            id="loginNotDNIe" 
                            type="button"
                            value ="Entra" 
                           	class="btn btn-info"/>
	</div>
  </div>
  
  <div class="col-md-4">
  	<div class="register">
		<h1 style="font-size: 40px;">¿Aún no te has registrado? ALE</h1>
		<input  onClick="location.href = 'register.php' "
                            id="register" 
                            type="button"
                            value ="Registrate" 
                           	class="btn btn-info"/>
	</div>
  </div>
</div>
	
	
</body>
</html>
