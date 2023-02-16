<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
	ini_set("session.gc_maxlifetime", 45 * 60);  // 45 min
	if (session_status() === PHP_SESSION_DISABLED) {
		throw new Exception("Sessions disabled!");
	} else {
		// session_id() om het juiste id op te halen 
		if (isset($_COOKIE[ucfirst(str_replace(".", "_", $_SERVER['SERVER_NAME']))])) {
			session_id($_COOKIE[ucfirst(str_replace(".", "_", $_SERVER['SERVER_NAME']))]);
		} else {
			session_name(ucfirst($_SERVER['SERVER_NAME']));
			session_set_cookie_params(0, "/", $_SERVER['SERVER_NAME'], true);
		}
		session_start();
	}
}

require_once "../lib/gauth.class";
require_once "../conn.php";

$secret = isset($_SESSION["secret"])?$_SESSION["secret"]:null;
$auth = new PHPGangsta_GoogleAuthenticator($secret);

error_reporting(E_ALL);

$_SESSION["secret"] = $auth->secret;
$url = $auth->getQRCodeGoogleUrl("beer_casus");

if (isset($_POST["submit"])) {
	if (filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS)) {
		if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
			if ($auth->verifyCode(filter_input(INPUT_POST, 'pin', FILTER_VALIDATE_INT), 4)) {
				// registreer user
			}
		}
	}
}

?>

<form method="POST">
	<input type="text" name="name">
	<input type="email" name="email">
	<img src="<?= $url ?>">
	<input type="text" name="pin">
	<input type="submit" name="submit" value="registreren">
</form>