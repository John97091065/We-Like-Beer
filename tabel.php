<?php

// een apart bestand om merge problemen te voorkomen

// variabelen doe ik in het engels om het universeel te houden
// $conn is je database connectie maak die even voor jezelf aan

declare(strict_types=1);

// zorgt er voor dat errors gelogd worden
error_reporting(E_ALL);

// hier word de variabel $conn opgehaald
require_once 'conn.php';

try {
	if ($stmt = $conn->prepare("SELECT `id`, `name`, `like_count` FROM `beers` ORDER BY `like_count` DESC LIMIT 3")) {
		$stmt->execute();
		$stmt->bind_result($id, $name, $likes);

		while($stmt->fetch()) {

		}
		$stmt->close();
	}

	if ($stmt = $conn->prepare("SELECT `id`, `name`, `like_count` FROM `beers`")) {
		$stmt->execute();
		$stmt->bind_result($id, $name, $likes);	

		while($stmt->fetch()) {
			// assets komen vanaf google fonts daar kan je ook de grote veranderen
			$html = new stdClass;
			$html->id = $id;
			$html->name = $name;
			$html->like_count = $like_count;
		}
		$stmt->close();
	}

	// sql statement voor top 3 liked: SELECT `id`, `name`, `like_count` FROM `beers` ORDER BY `like_count` DESC LIMIT 3;
} catch (Exception $e) {
	echo $e->getMessage();
}
?>

<?= $html ?>

<script>
	// javascript voor het voting systeem
	// controle kan op backend gedaan worden met behulp van ip-adress
	// 
	async function vote(id, amount) {
		// ?fn staat voor de functie die geroepen word en &id, &amount zijn parameters van een functie in server.php
		request = await fetch("server.php?fn=vote&id=" + id + "&amount=" + amount, {
			method: 'GET',
			cache: 'no-cache',
			headers: {
				'content-type': 'application/json'
			},
			referrer: 'same-origin',
			redirect: 'error'
		});
		response = await request.json();

		// new XMLHttpRequest;
		if (response.success) {
			// true zorgt ervoor dat er geen cache word geladen
			location.reload(true);
		} else {
			alert(response.error);
		}
	}
</script> 