<?php
    include_once "auth.php";
	session_start();
	
	$formulario = $_SESSION["formularioRandom"];

    $usuario = $_SESSION["formularioLogin"];
	
	if (isset($formulario)) {
		// el campo email mínimo tiene que tener 6 caracteres, por ejemplo a@u.es
		if (isset($formulario["codigo"]) && ($formulario["codigo"] == $_REQUEST["codigo"])) {
            setAuthCookie($usuario["username"], $usuario["password"]);
            unset($_SESSION["formularioLogin"]);
            unset($_SESSION["formularioRandom"]);
            Header("Location: https://frontend.agoraus1.egc.duckdns.org/");
		}else {
            $_SESSION['error'] = "Código introducido incorrecto";
			Header("Location: login.php");
		}
		
	} 
	
?>
