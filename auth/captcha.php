<?php
require_once 'captcha/ReCaptcha.php';
require_once 'captcha/RequestMethod.php';
require_once 'captcha/RequestParameters.php';
require_once 'captcha/Response.php';
require_once 'captcha/RequestMethod/Post.php';
require_once 'captcha/RequestMethod/Socket.php';
require_once 'captcha/RequestMethod/SocketPost.php';
 
$clave_del_sitio = "6Ldx5RYTAAAAALAbT0AF2v0Aj9tNI6nfjinPOo9E";
$clave_secreta = "6Ldx5RYTAAAAAJbkX1dztvGGHNi9Yq5aCAxSkbni";
 
if($_POST['accion'] == 'enviar'){
    $recaptcha = new ReCaptcha($clave_secreta);
    $respuesta = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
    if($respuesta->isSuccess()){
        echo 'El formulario ha sido validado';
    }else{
        echo 'Se ha devuelto el siguiente error:';
        foreach ($respuesta->getErrorCodes() as $error_code) {
            echo '<tt>' . $error_code . '</tt> ';
        }
    }
}
?>

<html>
  <head>
    <title>Confirma que no eres un robot para continuar</title>
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <form action="verificar.php" method="post">
      <div class="g-recaptcha" data-sitekey="6Ldx5RYTAAAAALAbT0AF2v0Aj9tNI6nfjinPOo9E"></div>
      <br/>
      <input type="submit" value="Enviar">
      <input type="hidden" name="accion" value="enviar">
    </form>
  </body>
</html>