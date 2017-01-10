<?php

	session_start();
	
	$formulario = $_SESSION["formularioRandom"];
	
	if (isset($formulario)) {
		// el campo email mínimo tiene que tener 6 caracteres, por ejemplo a@u.es
		if (isset($formulario["codigo"]) && ($formulario["codigo"] == $_REQUEST["codigo"])) {
			Header("Location: welcome.php");
		}else {
		Header("Location: index.php");
		}
		
	} 
	
?>
