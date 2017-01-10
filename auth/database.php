<?php
/** 
* @file
* \brief Métodos de operaciones en base de datos
* \author auth.agoraUS
*/
include_once "variables.php";
class database {

	//TODO Actualizar
	//Configuración
	protected $mysqli;
	const LOCALHOST = '127.0.0.1';
	const USER = 'root';
	const PASSWORD = '';
	const DATABASE = 'test';

/**
* \brief Conexión BD
* \details Método de conexión a la base de datos.
* \return PDO
*/
function connect() {
    $con = new PDO(DB_HOST, DB_USER, DB_PASS);
    $con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $con;
}

/**
 *  Constructor
 */
 public function __construct() {
 	try{
 		//Conectar a la base de datos
 		$this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE);
 	}catch (mysqli_sql_exception $e) {
 		//Fallo al conectar
 		http_response_code(500);
		exit;
 	}
 }

/**
* \brief Crear BD
* \details Montar la base de datos con la tabla de usuarios vacía.
*/
function setUp() {
    $con = connect();
    $stmt = $con->query('
        DROP TABLE IF EXISTS USERS;
        CREATE TABLE USERS (
        U_ID INT AUTO_INCREMENT,
        USERNAME VARCHAR(40) UNIQUE,
        PASSWORD VARCHAR(40),
        EMAIL VARCHAR(100) UNIQUE,
        GENRE ENUM("Femenino","Masculino") NOT NULL,
        AUTONOMOUS_COMMUNITY ENUM(  "Andalucia",
                                    "Murcia",
                                    "Extremadura",
                                    "Castilla la Mancha",
                                    "Comunidad Valenciana",
                                    "Madrid",
                                    "Castilla y Leon",
                                    "Aragon",
                                    "Cataluña",
                                    "La Rioja",
                                    "Galicia",
                                    "Asturias",
                                    "Cantabria",
                                    "Pais Vasco",
                                    "Navarra") NOT NULL,
        AGE TINYINT NOT NULL,
        PRIMARY KEY(U_ID)
        );
        ');
}

/**
* \brief Consultar usuario
* \details Consultar toda la información de un usuario en la base de
* datos buscando por su nombre de usuario.
* \param $user Nombre de usuario
* \return Usuario consultado.
*/
function getUser($username) {
    $con = connect();
    $stmt = $con->prepare("SELECT   USERNAME, 
                                    EMAIL, 
                                    GENRE, 
                                    AUTONOMOUS_COMMUNITY, 
                                    AGE 
                                    FROM USERS WHERE USERNAME=:username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->fetch();
}

/**
* \brief Consultar email
*/
function getEmail($email) {
    $con = connect();
    $stmt = $con->prepare("SELECT EMAIL FROM USERS WHERE EMAIL=:email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch();
}

/**
* \brief Consultar todos los usuarios
* \details Consultar todos los usuario de la base de datos
* \return Todos los usuarios
*/
function getUsers() {
    $con = connect();
    //$stmt = $con->prepare("SELECT USERNAME, PASSWORD, EMAIL, GENRE, AUTONOMOUS_COMMUNITY, AGE FROM USERS");
    $stmt = $con->prepare("SELECT USERNAME, EMAIL, GENRE, AUTONOMOUS_COMMUNITY, AGE FROM USERS");
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
* \brief Crear usuario
* \details Crear un usuario con todos sus campos e insertarlo en la base de datos.
* \param $username Nombre de usuario
* \param $password Contraseña
* \param $email Dirección de email
* \param $genre Género
* \param $age Edad
* \param $autonomous_community Comunidad autónoma
*/
function createUser($username, $password, $email, $genre, $age, $autonomousCommunity) {
    $con = connect();
    $stmt = $con->prepare("INSERT INTO USERS VALUES(null, 
                                                    :username, 
                                                    :password, 
                                                    :email, 
                                                    :genre, 
                                                    :autonomousCommunity, 
                                                    :age)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':autonomousCommunity', $autonomousCommunity);
    $stmt->bindParam(':age', $age);
    $stmt->execute();
}

function disconnect($conexion) {
	$conexion = null;
}

}
?>