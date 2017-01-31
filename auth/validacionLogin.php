<?php

	session_start();
	
	$formulario = $_SESSION["formularioLogin"];
	
	if (isset($formulario)) {
		$formulario["username"] = $_REQUEST["username"];
		$formulario["pass"] = $_REQUEST["pass"];
		$_SESSION["formularioLogin"] = $formulario;
	
		// el campo email mínimo tiene que tener 6 caracteres, por ejemplo a@u.es
		if (isset($formulario["username"]) && isset($formulario["pass"]) && strlen($formulario["username"]) > 3 && strlen($formulario["pass"]) >= 3) {
			Header("Location: exitoLogin.php");
		} else {
            Header("Location: login.php");
        }
		
	} else {
		Header("Location: index.php");
	}
	
?>
