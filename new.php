<!doctype html>
<html lang="en">

<head>
  <title>We like Beer</title>
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
          <a class="nav-link hvr-grow-shadow" href="new.php">Alle bieren</a>
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
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="text-center my-2">Welkom bij BeerTastic</h1>
          <p class="text-center my-2">Hier vind je alle informatie over bier</p>
        </div>
      </div>    
    </div>

      <div class="col-md-12">

    <table id="table" class="table-hover">
      <thead>
        <tr>
          <!-- <th data-field="id">id</th> -->
          <th data-field="name" class="table-text">Naam</th>
          <th data-field="price" class="table-text">Prijs</th>
          <th data-field="upvote" class="table-text text-center">+</th>
          <th data-field="downvote" class="table-text text-center">-</th>
          <th data-field="votes" class="table-text">Votes</th>
        </tr>
      </thead>
    </table>
    </div>
  </main>

<script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>


<script>
var $table = $('#table');

  $(async function() {
  
  // do an ajax call here to get the response. your response should be like responseData
  var responseData = await getBeers();
    console.log(responseData);
  var data = [];

  Object.keys(responseData).forEach(function(key){ 
  
  var value = responseData[key]; 

  console.log(value);
  value["upvote"] = "<button type='button' class='upvote' onclick='vote(" + value["id"] + ", 1)' value='+1'><i class='bi bi-hand-thumbs-up-fill'></i></button>"
  value["downvote"] = "<button type='button' class='downvote' onclick='vote(" + value["id"] + ", -1)' value='-1'><i class='bi bi-hand-thumbs-down-fill'></i></button>"

  data.push(value);
  })  
  
  $table.bootstrapTable({data: data});
  });

  async function getBeers() {
		req = await fetch("server.php?fn=getAllBeers", {
			method: 'GET',
			headers: {
				'Content-Type': 'application/json'
			}
		});
		rep = await req.json();
    
    return rep;
	}
  
  async function vote(id, amount) {
		req = await fetch("server.php?fn=vote&id=" + id + "&amount=" + amount, {
			method: 'GET',
			headers: {
				'Content-Type': 'application/json'
			}
		})
    rep = await req.json();
    console.log(rep.success);
    if (rep.success) {
      window.location.href = window.location.href;
    }
	}
  </script>

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