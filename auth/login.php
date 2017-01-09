<?php
	/** 
	* @file
	* \brief Inicio de la aplicación
	* \details Pantalla de inicio de la aplicación. Añade cabeceras, muestra 
	* los mensajes de error de logAttempt.php y define la estructura del layout.
	* \author auth.agoraUS
	*/
	
	include_once 'variables.php';
	
	session_start();
	
	// Inicializamos o recuperamos la sesión
	$formularioLogin = $_SESSION["formularioLogin"];
	
	// Asignamos valor por defecto a los elementos
	if (!isset($formularioLogin)) {
		$formularioLogin["username"] = "";
		$formularioLogin["pass"] = "";
	}
	
	$_SESSION["formularioLogin"] = $formularioLogin;

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
    
    <script>
 	
    </script>
    
</head>
<body style="background-color: #F5F5F5;font-family: Roboto;">
	
	<div class="tituloInicio">
		<h1 style="font-size: 100px; font-family: Roboto">¡Bienvenidos a agor@us!</h1>
	</div>
	
	<div class="row">
   		<form method="post" action="validacionLogin.php">
   			
				<label id="label_username" for="usernameLogin"> <h3>Username</h3> </label>
				<input type="username" required="required" value="" id="username" name="username" class="input_reg" style="height: 25px; background: #C0C0C0;">
			
				<label id="label_pass" for="passLogin"> <h3>Contraseña</h3> </label>
				<input type="password" required="required" value="" id="pass" name="pass" style="height: 25px; background: #C0C0C0;">
			
			<div>
				<input id="login" type="submit" value ="Sing In" class="btn btn-info"/>
			</div>
			
		</form>
	</div>
   	
   <!-- $d=mt_rand(1000000,999999);
   echo $d;		 -->
	
	
	
	
  </body>
</html>
