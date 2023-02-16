<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Like Bear</title>
</head>
<body>
    
    <nav>
      <h1>We Like Beer</h1>  
  <ul>
    <li><a href="#home">Home</a></li>
    <li><a href="#about">About</a></li>
    <li><a href="#services">Services</a></li>
    <li><a href="#contact">Contact</a></li>
	<li></li>
  </ul>
</nav>

    <div id="divBeer">

    </div>
</body>
<script>
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
</script>
</html>