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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pin.css">
    <script src="pin.js" defer></script>
    <title>6-pin</title>
</head>
<body>
    <form method="POST" id="form">
        <div class="container">
            <input type="text" class="text" id="vnaam" name="name" placeholder="Voornaam" required>
            <input type="text" class="text" id="email" name="email" placeholder="Email" required> 
            <img src="<?= $url ?>">    
            <img src="./frame.png">      
            <div id="pincode" name="pin">
                <input type="text" class="num" maxlength="1" onkeypress="isInputNumber(event)" required>
                <input type="text" class="num" maxlength="1" onkeypress="isInputNumber(event)" required>
                <input type="text" class="num" maxlength="1" onkeypress="isInputNumber(event)" required>
                <div class="space"></div>
                <input type="text" class="num" maxlength="1" onkeypress="isInputNumber(event)" required>
                <input type="text" class="num" maxlength="1" onkeypress="isInputNumber(event)" required>
                <input type="text" class="num" maxlength="1" onkeypress="isInputNumber(event)" required>
            </div>
            <button class="btn" name="submit" value="registreren" onclick="btnSend()">Stuur code</button>
        </div>
    </form>    
</body>
</html>
   
