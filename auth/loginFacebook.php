<?php
 
/* Iniciando la sesión*/
session_start();
 
/* Cambiar según la ubicación de tu directorio*/
require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
 
$fb = new Facebook\Facebook(array(
  'app_id' => '1321152037907359',
  'app_secret' => '1321152037907359',
  'default_graph_version' => 'v2.4',
));
  
$helper = $fb->getRedirectLoginHelper();
  
$permissions = array('email'); // Permisos opcionales
$loginUrl = $helper->getLoginUrl('http://localhost/webs/ejemplos/facebook/fb-callback.php', $permissions);
  
/* Link a la página de login*/
echo '<a href="' . htmlspecialchars($loginUrl) . '">Login con Facebook!</a>';
 
?>