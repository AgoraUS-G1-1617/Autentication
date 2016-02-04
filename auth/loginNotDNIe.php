<?php
/** 
* @file
* \brief Inicio de la aplicación
* \details Pantalla de inicio de la aplicación. Añade cabeceras, muestra 
* los mensajes de error de logAttempt.php y define la estructura del layout.
* \author auth.agoraUS
*/

include_once 'variables.php';

if (isset($_REQUEST['logout'])) {
    setcookie("token", NULL, time()-3600);
    setcookie("user", NULL, time()-3600);
} else if (isset($_SESSION['user'])) {
    header('Location: ./?cont=home');
}

if (isset($_REQUEST['error'])) {
    $errorMsgs = array(
        "shortPass"=>"La constraseña es demasiado corta como para ser válida.",
        "shortUser"=>"El usuario es demasiado corto como para ser válido.",
        "wrongPass"=>"La contraseña no corresponde con el usuario, porfavor, introduzaca de nuevo la contraseña",
        "connectionFailed"=>"Ha ocurrido un error con la base de datos."
        );
    $errorMsg = $errorMsgs[$_REQUEST['error']];
} else {
    $errorMsg = "";
}
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
	
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title><?php echo TITLE?></title>
</head>
<body>
	
	<div class="container-fluid">
		<div class="logo">
		<h4>Bienvenidos a Agor@us<img alt="Agora@us" src="img/agoraUsImage.jpg" width="100px" height="100px"></h4>
	</div>
<div id="loginWr">
    <div id="login" >
        <form action="logAttempt.php" method="post" class="login-form">
<div class="content">
                    <label for="user"><img src="img/userSnapshot.png" alt="Nombre de usuario"></label>
                    <input  type="text" 
                            id="user" 
                            name="user" 
                            style="font-size: 18px"
                            title="Su nombre de usuario" 
                            placeholder="Nombre de usuario" />
                            <br/>


                    
 
                    <label for="pass"><img src="img/passSnapshot.png" alt="Contraseña" ></label>
                    <input  type="password" 
                            id="pass" 
                            name="pass" 
                            title="Su contraseña" 
                            placeholder="Contraseña" 
                            style="font-size: 18px"/>
                        </div>
                            <br />
                            
<div class="footer">
					<input type="submit" class="btn btn-primary" value="Entrar">
					<input  onClick="location.href = 'register.php' "
                            id="register" 
                            type="button"
                            value ="Registrate" 
                           	class="btn btn-info"/>
                           	</div>
        </form>
    <div id="error"><?php echo $errorMsg?></div>
    </div>
</div>
</div>
</body>
</html>
