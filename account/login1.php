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

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    
    <link href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit:ital@0;1&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
  </style>

    <script src="pin.js" defer></script>

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
          <a class="nav-link hvr-grow-shadow" href="account/login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link hvr-grow-shadow" href="account/register.php">Register</a>
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
  <main>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>