<?php

/* Iniciando la sesión*/
session_start();

/* Cambiar según la ubicación de tu directorio*/
require_once __DIR__ . '/vendor/facebook/graph-sdk/src/Facebook/autoload.php';

$fb = new Facebook\Facebook( array('app_id' => '1065487940245693', 'app_secret' => '1a934054901ddcecf5095a53172e0d07', 'default_graph_version' => 'v2.4', ));

$helper = $fb -> getRedirectLoginHelper();
try {
	$accessToken = $helper -> getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e -> getMessage();
	exit ;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e -> getMessage();
	exit ;
}

if (isset($accessToken)) {
	// Logged in!
	$_SESSION['facebook_access_token'] = (string)$accessToken;

	// Now you can redirect to another page and use the
	// access token from $_SESSION['facebook_access_token']
	
	header('Location: https://frontend.agoraus1.egc.duckdns.org');
}
?>