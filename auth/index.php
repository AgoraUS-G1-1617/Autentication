<?php
/**
 * @file
 * \brief Inicio de la aplicación
 * \details Pantalla de inicio de la aplicación. Añade cabeceras, muestra
 * los mensajes de error de logAttempt.php y define la estructura del layout.
 * \author auth.agoraUS
 */

/* Iniciando la sesión*/
session_start();

/* Cambiar según la ubicación de tu directorio*/
require_once __DIR__ . '/vendor/facebook/graph-sdk/src/Facebook/autoload.php';

$fb = new Facebook\Facebook( array('app_id' => '1065487940245693', 'app_secret' => '1a934054901ddcecf5095a53172e0d07', 'default_graph_version' => 'v2.4', ));

$helper = $fb -> getRedirectLoginHelper();

$permissions = array('email');
// Permisos opcionales
$loginUrl = $helper -> getLoginUrl('https://beta.autha.agoraus1.egc.duckdns.org/fb-callback.php', $permissions);

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
<body style="background-color: #F5F5F5;font-family: Roboto">
	
	<div class="tituloInicio">
		<h1 style="font-size: 100px; font-family: Roboto">Bienvenidos a agor@us</h1>
	</div>
	<div class="row">
	  <?php if ($socialNet!==FALSE && $DNIe!==FALSE): ?>
		 <!-- <div class="ancho-botones">
				<input  onClick="location.href = 'loginGoogle.php' "
		                            id="loginGoogle+" 
		                            type="button"
		                            value ="Entrar con G+" 
		                    	class="btn btn-info"/>	
    </div>-->
       	<div class="col-md-3">
				<input  onClick="location.href = 'process.php' "
		                            id="loginTwiter" 
		                            type="button"
		                            value ="Entrar con Twiter" 
		                    	class="btn btn-info"/>	
       	</div>
       	<div class="col-md-3">
				<input  onClick="location.href = 'loginFacebook.php' "
		                            id="loginFacebook" 
		                            type="button"
		                            value ="Entrar con Facebook" 
		                    	class="btn btn-info"/>	
       	</div>
				<input  onClick="location.href = 'loginDNIe.php' "
		                            id="loginDNIe" 
		                            type="button"
		                            value ="Entrar con DNIe" 
		                           	class="btn btn-info"/>
		  </div>
       	  <div class="col-md-3">
				<input  onClick="location.href = 'loginNotDNIe.php' "
		                            id="loginNotDNIe" 
		                            type="button"
		                            value ="Entrar sin DNIe" 
		                           	class="btn btn-info"/>
		
		  </div>
	  <div class="col-md-3">
	  	<div class="register">
			<input  onClick="location.href = 'register.php' "
	                            id="register" 
	                            type="button"
	                            value ="Registrase" 
	                           	class="btn btn-info"/>
	   
	  </div>	  
	</div>
	<?php elseif ($socialNet!==FALSE && $DNIe===FALSE): ?>
		<!--  <div class="col-md-3">
				<input  onClick="signInClick() "
		                            id="loginGoogle+" 
		                            type="button"
		                            value ="Entrar con G+" 
		                    	class="btn btn-info"/>	
     </div>-->
     	<div class="col-md-3">
				<input  onClick="parent.location = '<?php echo htmlspecialchars($loginUrl); ?>' "
		                            id="loginFacebook" 
		                            type="button"
		                            value ="Entrar con Facebook" 
		                    	class="btn btn-info"/>	
       	</div>
       	<div class="col-md-3">
				<input  onClick="location.href = 'process.php' "
		                            id="loginTwiter" 
		                            type="button"
		                            value ="Entrar con Twiter" 
		                    	class="btn btn-info"/>	
       	</div>
       	<div class="col-md-3">
				<input  onClick="location.href = 'loginNotDNIe.php' "
		                            id="loginNotDNIe" 
		                            type="button"
		                            value ="Entrar sin DNIe" 
		                           	class="btn btn-info"/>
		
		  </div>
	  	<div class="col-md-3">
	  	<div class="register">
			<input  onClick="location.href = 'register.php' "
	                            id="register" 
	                            type="button"
	                            value ="Registrase" 
	                           	class="btn btn-info"/>
	   
	  </div>
	  </div>
	<?php elseif ($socialNet===FALSE && $DNIe!==FALSE): ?>
		<div class="col-md-4">
				<input  onClick="location.href = 'loginDNIe.php' "
		                            id="loginDNIe" 
		                            type="button"
		                            value ="Entrar con DNIe" 
		                           	class="btn btn-info"/>
		  </div>
		<div class="col-md-4">
				<input  onClick="location.href = 'loginNotDNIe.php' "
		                            id="loginNotDNIe" 
		                            type="button"
		                            value ="Entrar sin DNIe" 
		                           	class="btn btn-info"/>
		
		  </div>
	  	<div class="col-md-4">
	  	<div class="register">
			<input  onClick="location.href = 'register.php' "
	                            id="register" 
	                            type="button"
	                            value ="Registrase" 
	                           	class="btn btn-info"/>
	   
	  </div>
	  </div>
	<?php elseif ($socialNet===FALSE && $DNIe===FALSE): ?>
		<div class="col-md-6">
				<input  onClick="location.href = 'loginNotDNIe.php' "
		                            id="loginNotDNIe" 
		                            type="button"
		                            value ="Entrar sin DNIe" 
		                           	class="btn btn-info"/>
		
		  </div>
	  	<div class="col-md-6">
	  	<div class="register">
			<input  onClick="location.href = 'register.php' "
	                            id="register" 
	                            type="button"
	                            value ="Registrase" 
	                           	class="btn btn-info"/>
	   
	  </div>
	  </div>
	<?php endif; ?>
	</div>
	
</body>
</html>
