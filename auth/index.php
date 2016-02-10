<?php
/** 
* @file
* \brief Inicio de la aplicación
* \details Pantalla de inicio de la aplicación. Añade cabeceras, muestra 
* los mensajes de error de logAttempt.php y define la estructura del layout.
* \author auth.agoraUS
*/

include_once 'variables.php';

?>
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
	
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.mi.js"></script>
	<script type="text/javascript" src="bootstrap/js/npm.js"></script>
	<script type="text/javascript" src="bootstrap/js/index.js"></script>
	<script type="text/javascript" src="scripts/index.js"></script>
	
	<link rel="stylesheet" href="style/style.css" type="text/css">

	
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css">
	<link rel="stylesheet" href="styles/bootstrap/css/bootstrap-theme.css" type="text/css">
	<link rel="stylesheet" href="styles/bootstrap/css/bootstrap-theme.css.map" type="text/css">
	<link rel="stylesheet" href="styles/bootstrap/css/bootstrap.css.map" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
	
	<script type="text/javascript">
 	var auth2 = auth2 || {};

  	(function() {
    var po = document.createElement('script');
    po.type = 'text/javascript'; po.async = true;
    po.src = 'https://plus.google.com/js/client:plusone.js?onload=startApp';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(po, s);
  })();
  </script>
  <!-- JavaScript specific to this application that is not related to API
     calls -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" ></script>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title><?php echo TITLE?></title>
</head>
<body style="background-color: #F5F5F5;font-family: Roboto;">
	
	<div class="tituloInicio">
		<h1 style="font-size: 100px; font-family: Roboto">¡Bienvenidos a agor@us!</h1>
	</div>
	
	<div class="row">
  <div class="col-md-4">
  	<div class="loginDNIe">
		<h1 style="font-size: 40px;">Entrar con G+</h1>
		<input  onClick="signInClick()"
                            id="loginDNIe" 
                            type="button"
                            value ="Entra" 
                           	class="btn btn-info"/>
	</div>
  </div>
  <div class="col-md-4">
  	<div class="loginNotDNIe">
		<h1 style="font-size: 40px;">Entrar sin DNIe</h1>
		<input  onClick="location.href = 'loginNotDNIe.php' "
                            id="loginNotDNIe" 
                            type="button"
                            value ="Entra" 
                           	class="btn btn-info"/>
	</div>
  </div>
  
  <div class="col-md-4">
  	<div class="register">
		<h1 style="font-size: 40px;">¿Aún no te has registrado?</h1>
		<input  onClick="location.href = 'register.php' "
                            id="register" 
                            type="button"
                            value ="Registrate" 
                           	class="btn btn-info"/>
	</div>
  </div>
</div>
	
	
</body>
<script type="text/javascript">
var helper = (function() {
  var authResult = undefined;

  return {
    /**
     * Hides the sign-in button and connects the server-side app after
     * the user successfully signs in.
     *
     * @param {Object} authResult An Object which contains the access token and
     *   other authentication information.
     */
    onSignInCallback: function(authResult) {
      $('#authResult').html('Auth Result:<br/>');
      for (var field in authResult) {
        $('#authResult').append(' ' + field + ': ' + authResult[field] + '<br/>');
      }
      if (authResult['access_token']) {
        // The user is signed in
        this.authResult = authResult;

        // After we load the Google+ API, render the profile data from Google+.
        gapi.client.load('plus','v1',this.renderProfile);

        // After we load the profile, retrieve the list of people visible to
        // this app, server-side.
        helper.people();
      } else if (authResult['error']) {
        // There was an error, which means the user is not signed in.
        // As an example, you can troubleshoot by writing to the console:
        console.log('There was an error: ' + authResult['error']);
        $('#authResult').append('Logged out');
        $('#authOps').hide('slow');
        $('#gConnect').show();
      }
      console.log('authResult', authResult);
    },
    /**
     * Retrieves and renders the authenticated user's Google+ profile.
     */
    renderProfile: function() {
      var request = gapi.client.plus.people.get( {'userId' : 'me'} );
      request.execute(function(profile) {
          $('#profile').empty();
          if (profile.error) {
            $('#profile').append(profile.error);
            return;
          }
          $('#profile').append(
              $('<p><img src=\"' + profile.image.url + '\"></p>'));
          $('#profile').append(
              $('<p>Hello ' + profile.displayName + '!<br />Tagline: ' +
              profile.tagline + '<br />About: ' + profile.aboutMe + '</p>'));
          if (profile.cover && profile.coverPhoto) {
            $('#profile').append(
                $('<p><img src=\"' + profile.cover.coverPhoto.url + '\"></p>'));
          }
        });
      $('#authOps').show('slow');
      $('#gConnect').hide();
    },
    /**
     * Calls the server endpoint to disconnect the app for the user.
     */
    disconnectServer: function() {
      // Revoke the server tokens
      $.ajax({
        type: 'POST',
        url: window.location.href + '/disconnect',
        async: false,
        success: function(result) {
          console.log('revoke response: ' + result);
          $('#authOps').hide();
          $('#profile').empty();
          $('#visiblePeople').empty();
          $('#authResult').empty();
          $('#gConnect').show();
        },
        error: function(e) {
          console.log(e);
        }
      });
    },
    /**
     * Calls the server endpoint to connect the app for the user. The client
     * sends the one-time authorization code to the server and the server
     * exchanges the code for its own tokens to use for offline API access.
     * For more information, see:
     *   https://developers.google.com/+/web/signin/server-side-flow
     */
    connectServer: function(code) {
      console.log(code);
      $.ajax({
        type: 'POST',
        url: window.location.href + '/connect?state={{ STATE }}',
        contentType: 'application/octet-stream; charset=utf-8',
        success: function(result) {
          console.log(result);
          helper.people();
          onSignInCallback(auth2.currentUser.get().getAuthResponse());
        },
        processData: false,
        data: code
      });
    },
    /**
     * Calls the server endpoint to get the list of people visible to this app.
     * @param success Callback called on success.
     * @param failure Callback called on error.
     */
    people: function(success, failure) {
      success = success || function(result) { helper.appendCircled(result); };
      $.ajax({
        type: 'GET',
        url: window.location.href + '/people',
        contentType: 'application/octet-stream; charset=utf-8',
        success: success,
        error: failure,
        processData: false
      });
    },
    /**
     * Displays visible People retrieved from server.
     *
     * @param {Object} people A list of Google+ Person resources.
     */
    appendCircled: function(people) {
      $('#visiblePeople').empty();

      $('#visiblePeople').append('Number of people visible to this app: ' +
          people.totalItems + '<br/>');
      for (var personIndex in people.items) {
        person = people.items[personIndex];
        $('#visiblePeople').append('<img src="' + person.image.url + '">');
      }
    },
  };
})();

/**
 * Perform jQuery initialization and check to ensure that you updated your
 * client ID.
 */
$(document).ready(function() {
  $('#disconnect').click(helper.disconnectServer);
  if ($('[data-clientid="YOUR_CLIENT_ID"]').length > 0) {
    alert('This sample requires your OAuth credentials (client ID) ' +
        'from the Google APIs console:\n' +
        '    https://code.google.com/apis/console/#:access\n\n' +
        'Find and replace YOUR_CLIENT_ID with your client ID and ' +
        'YOUR_CLIENT_SECRET with your client secret in the project sources.'
    );
  }
});

/**
 * Called after the Google client library has loaded.
 */
function startApp() {
  gapi.load('auth2', function(){

    // Retrieve the singleton for the GoogleAuth library and setup the client.
    gapi.auth2.init({
        client_id: '1015695576947-hi4fj34upricgq1mqq2jmadtle55rcsr.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        fetch_basic_profile: false,
        scope: 'https://www.googleapis.com/auth/plus.login'
      }).then(function (){
            console.log('init');
            auth2 = gapi.auth2.getAuthInstance();
            auth2.then(function() {
                var isAuthedCallback = function () {
                  onSignInCallback(auth2.currentUser.get().getAuthResponse())
                }
                helper.people(isAuthedCallback);
              });
          });
  });
}

/**
 * Either signs the user in or authorizes the back-end.
 */
function signInClick() {
  var signIn = function(result) {
      auth2.signIn().then(
        function(googleUser) {
          onSignInCallback(googleUser.getAuthResponse());
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
    };

  var reauthorize = function() {
      auth2.grantOfflineAccess().then(
        function(result){
          helper.connectServer(result.code);
        });
    };

  helper.people(signIn, reauthorize);
}

/**
 * Calls the helper method that handles the authentication flow.
 *
 * @param {Object} authResult An Object which contains the access token and
 *   other authentication information.
 */
function onSignInCallback(authResult) {
  helper.onSignInCallback(authResult);
}
</script>
</html>
