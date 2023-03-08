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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Google Fonts -->
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit:ital@0;1&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
  </style>

	<script src="pin.js" defer></script>

	<title>Login</title>
</head>

<body>	
	<header>
    <!-- place header here -->
    <div class="container-fluid nav-container">
        <nav class="navbar navbar-expand-lg py-2 mx-2 shift">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">BeerTastic</a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active hvr-grow-shadow" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link hvr-grow-shadow" href="#">Favoriete bier</a>
        </li>
        <li class="nav-item">
          <a class="nav-link hvr-grow-shadow" href="#">Alle bieren</a>
        </li>
        <li class="nav-item">
          <a class="nav-link hvr-grow-shadow" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link hvr-grow-shadow" href="register.php">Register</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Vul biersoort in.." aria-label="Search">
        <button class="btn" type="submit">Zoeken</button>
      </form>
    </div>
  </div>
</nav>
    </div>
  </header>
	<div class="container">
    <div class="row">
      
		<form method="post" class="form my-5 mx-auto text-center">
        <h1 class="form-title my-2">Login</h1>
        <div class="col-8 mx-auto">
      <input type="text" name="Fname" class="form-control my-3" placeholder="Naam">
			<input type="text" name="email" class="form-control my-3" placeholder="Email">
      
      </div>
			<label for="pincode" class="pincode">Pincode</label>
			<div id="pincode" name="pin" class="pin-layout my-2 mx-1">
                <input type="text" class="num" maxlength="1" onkeypress="isInputNumber(event)" required>
                <input type="text" class="num" maxlength="1" onkeypress="isInputNumber(event)" required>
                <input type="text" class="num" maxlength="1" onkeypress="isInputNumber(event)" required>
<br><br>
                <input type="text" class="num" maxlength="1" onkeypress="isInputNumber(event)" required>
                <input type="text" class="num" maxlength="1" onkeypress="isInputNumber(event)" required>
                <input type="text" class="num" maxlength="1" onkeypress="isInputNumber(event)" required>
            </div>

			<input type="submit" name="submit" class="btn form-btn my-5" value="Login">
		</form>
    </div>
	</div>
</body>
</html>

