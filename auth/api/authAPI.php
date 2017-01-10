<?php
	require_once ("../database.php");
	include_once "../auth.php";
	
	
	class authAPI {
		
		
		/*
		 * Control de métodos
		 */
		//TODO Control de login (comprobar token)
		public function API() {
			$db =  new database();
			header('Content-Type: application/JSON');
			$method = $_SERVER['REQUEST_METHOD'];
			switch($method) {
			case 'GET'://Consulta
				print_r(explode('/', $_SERVER['REQUEST_URI']));
				print_r($_GET);
				echo 'pozi';
				$this -> getUsers();
				break;
			case 'POST'://inserta
				//TODO
				echo 'hola';
				break;
			case 'PUT'://Actualiza
				//TODO
				echo 'PUT';
				break;
			case 'DELETE'://Elimina
				//TODO
				echo 'DELETE';
				break;
			default://Método no soportado
				echo 'Método no soportado';
				break;
			}
		}
		
		/**
		 * Respuesta al cliente
		 * @param int $code Codigo de respuesta HTTP
		 * @param String $status Indica el estado de la respuesta, puede ser "success" o "error"
		 * @param String $message Mensaje obtenido
		 */
		function response($code=200, $status="", $message="") {
			http_response_code($code);
			if( !empty($status) && !empty($message) ) {
				$response = array("status" => $status, "message" => $message);
				echo json_encode($response, JSON_PRETTY_PRINT);
			}
		}
		
		// Métodos soportados
		
		/*
		 * Devuelve users (sin contraseña) dependiendo del parámetro username:
		 *  - Sin username: devuelve todos los users
		 *  - Con username: devuelve el user con dicho username
		 */
		function getUsers() {
			$db = new database();
			$met = explode('/', $_SERVER['REQUEST_URI']);
			if($met[5] == 'users') { //Se pide el método "users"
				if( isset($_GET['username']) ) { //Se pide un usuario concreto por su username
					$response = $db->getUser($_GET['username']);
				}else { //No se ha pedido un usuario concreto
					$response = $db->getAllUsers();
				}
				echo json_encode($response, JSON_PRETTY_PRINT);
			} else { //No es el método que pedimos
				print_r($_GET);
			}
		}
	}
?>