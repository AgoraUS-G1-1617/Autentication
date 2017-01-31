<?php
    /**
    * @file
    * \brief API
    * \details Controlador de la API. Atiende las peticiones y devuelve los resultados
    * de los métodos o un error cuando proceda.
    * \author auth.agoraUS
    */

    header("Access-Control-Allow-Origin: *");
    include_once "../database.php";
    include_once "../auth.php";
    if (!isset($_GET['method']) || $_GET['method'] == "") {
    	$_SESSION['errorMessage'] = "No method specified";
        badRequest();
    } else {
        switch (strtolower($_GET['method'])) {
            case 'users':
                if (!isset($_GET['id'])) {
                	getUsers();
                } else {
                    getUserAPI($_GET['id']);
                }
                break;
 /**           case 'checktoken':
                if (!isset($_GET['token'])) {
                	$_SESSION['errorMessage'] = "Token not specified";
                    badRequest();
                } else {
                    checkToken($_GET['token']);
                }
                break;
**/			
            case 'checktoken':
                if (!isset($_GET['token'])) {
                	$_SESSION['errorMessage'] = "Token not specified";
                    badRequest();
				}
				else if (!isset($_GET['id'])){
					//$_SESSION['errorMessage'] = "User not specified";
					//badRequest();
                    checkToken($_GET['token']);
                } else {
                    checkTokenUser($_GET['token'], $_GET['user']);
                }
                break;
            default:
				$_SESSION['errorMessage'] = "Method not recognised. Recognised methods: /USERS/, /USERS/username, /checkToken/token, /checkToken/token/user";
                badRequest();
                break;
        }
    }

    /**
    * \brief Código 400. Método no existe.
    */
    function badRequest() {
        header('HTTP/1.1 400 Bad Request');
		
        echo "Bad Request.";
		if(isset($_SESSION['errorMessage'])) {
			echo " Error message: ";
			echo $_SESSION['errorMessage'];
		}
    }

    /**
    * \brief Obtener un usuario
    * \details Devuelve todos los datos de un usuario de la base de datos.
    * \return JSON
    */
    function getUserAPI($username) {
        header('HTTP/1.1 200 OK');
        header('Content-type: application/json');
        $user = getUser($username);
        $result['username'] = $user[0];
        //$result['password'] = $user[1];
        $result['email'] = $user[2];
        $result['genre'] = $user[3];
        $result['autonomous_community'] = $user[4];
        $result['age'] = $user[5];
		
		if($user == null) {
            $result = "User not found";
        }

        echo json_encode($result);
        return json_encode($result);
    }

    /**
    * \brief Obtener usuarios
    * \details Devuelve todos los usuarios de la base de datos.
    * \return JSON
    */
    function getUsers() {
        header('HTTP/1.1 200 OK');
        header('Content-type: application/json');
        $users=array();
        foreach (getAllUsers() as $user) {
            $addedUser['username'] = $user['USERNAME'];
            //$addedUser['password'] = $user['PASSWORD'];
            $addedUser['email'] = $user['EMAIL'];
            $addedUser['genre'] = $user['GENRE'];
            $addedUser['autonomous_community'] = $user['AUTONOMOUS_COMMUNITY'];
            $addedUser['age'] = $user['AGE'];
            $users[] = $addedUser;
        }
        echo json_encode($users);
    }

    /**
    * \brief Comprobar token
    * \return JSON
    */
    function checkToken($token) {
        header('HTTP/1.1 200 OK');
        //header('Content-type: application/json');
        $result['valid']=tokenIsCorrect($token);

        echo json_encode($result);
        return json_encode($result);
    }

    /**
    * \brief Comprobar usuario
    * \details Comprobar si un usuario dado está ya autenticado en el sistema,
    * comprobando un token.
    * \return JSON
    */
    function checkTokenUser($token, $user) {
        header('HTTP/1.1 200 OK');
        header('Content-type: application/json');
        $result['valid']=checkUserToken($token, $user);

        echo json_encode($result);
        return json_encode($result);
    }
?>
