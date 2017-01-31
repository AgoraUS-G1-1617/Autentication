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
            case 'token':
                if (!isset($_GET['id'])) {
                    badRequest(400, "Token not specified");
				}
				else if (!isset($_GET['id2'])){
					//$_SESSION['errorMessage'] = "User not specified";
					//badRequest();
                    checkToken($_GET['id']);
                } else {
                    checkTokenUser($_GET['id'], $_GET['id2']);
                }
                break;
            default:
                $param[0] = "method";
                $param[1] = $_GET['method'];
                $params[0] = $param;
                badRequest(400, "Method not recognised. Recognised methods: /USERS and /TOKEN", $params);
                break;
        }
    }

    /**
    * \brief Código 400. Método no existe.
    */
    function badRequest($code, $message, $params) {
        header('HTTP/1.1 400 Bad Request');
		header('Content-type: application/json');

        $error['code'] = $code;
        $error['message'] = $message;

        foreach($params as $param) {
            $error[$param[0]] = $param[1];
        }
        
        echo json_encode($error, JSON_UNESCAPED_SLASHES);
        return json_encode($error, JSON_UNESCAPED_SLASHES);
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

        if($user == null) {
            $param[0] = "user";
            $param[1] = $username;
            $params[0] = $param;
            return badRequest(400, "User not found", $params);
        }
        
        $result['username'] = $user[0];
        //$result['password'] = $user[1];
        $result['email'] = $user[2];
        $result['genre'] = $user[3];
        $result['autonomous_community'] = $user[4];
        $result['age'] = $user[5];

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
