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
          <a class="nav-link hvr-grow-shadow" href="#">Alle bieren</a>
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







  <script>
	window.onload = getBeers;
	async function getBeers() {
		req = await fetch("server.php?fn=getAllBeers", {
			method: 'GET',
			headers: {
				'Content-Type': 'application/json'
			}
		});
		rep = await req.json();
		console.log(rep);
	}

	/**
	 * @param {int} id - the beer id
	 * @param {int} amount - 1 or -1 for direction
	 */
	async function vote(id, amount) {
		req = await fetch("server.php?fn=vote&id=" + id + "&amount=" . amount, {
			method: 'GET',
			headers: {
				
			}
		})
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