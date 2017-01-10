<?php
session_start();
require_once ("./database.php");
$form = $_SESSION['formularioLogin'];

$conexion = connect();
?>

<html>
	<head>
		<title>Resultado del registro</title>
	</head>
	<body>
		<?php
		$exito = false;
		$stmt = getAllUsers($conexion);
		foreach ($stmt as $p) {
			if ($p["PASSWORD"] == md5($form["pass"]) && $p["USERNAME"] == $form["username"]) {
				$exito = true;
				break;
			}
		}

		if ($exito == true) {
			Header("Location: loginRandom.php");
			
		} else {
			Header("Location: index.php");
		}
		?>
	</body>
	<?php disconnect($conexion); ?>
</html>