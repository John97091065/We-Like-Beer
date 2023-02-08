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
	$html = '<table id="T1">';
	$html .= '<tr><th colspan="3">top 3 beste soorten bier</th></tr>';
	$html .= '<tr><th>id</th><th>naam</th><th>likes</th></tr>';

	if ($stmt = $conn->prepare("SELECT `id`, `name`, `like_count` FROM `beers` ORDER BY `like_count` DESC LIMIT 3")) {
		$stmt->execute();
		$stmt->bind_result($id, $name, $likes);

		while($stmt->fetch()) {
			$html .= '<tr><td>' . $id . '</td><td>' . $name . '</td><td>' . $likes . '</td>';
			
		}
		$stmt->close();
	$html .= '</table>';
	echo $html;
	}

	$html = '<table id="T2">';
	if ($stmt = $conn->prepare("SELECT `id`, `name`, `like_count` FROM `beers`")) {
		$stmt->execute();
		$stmt->bind_result($id, $name, $likes);
		
		// je kan hier classes aan toevoegen eventueel "dylan"
		
		$html .= '<tr><th colspan="5">Alle soorten bier op een rij</th></tr>';
		$html .= '<tr><th>id</th><th>naam</th><th>+</th><th>-</th><th>likes</th>';

		while($stmt->fetch()) {
			// assets komen vanaf google fonts daar kan je ook de grote veranderen
			
			$html .= '<tr><td>' . $id . '</td><td>' . $name . '</td><td><svg onclick="vote(' . $id . ', 1)" xmlns="http://www.w3.org/2000/svg" height="40" width="40"><path d="M29.875 35H11.458V13.542L23.042 1.667l1.791 1.541q.25.25.396.667.146.417.146.917v.5l-1.833 8.25h11.875q1.125 0 1.958.833t.833 1.958v4q0 .334-.083.625l-5.167 11.959q-.375.875-1.25 1.479-.875.604-1.833.604Zm-15.667-2.792H30.25l5.167-12.166v-3.709H20.042l2.25-9.958-8.084 8.333Zm0-17.5v17.5Zm-2.75-1.166v2.791H6.083v15.875h5.375V35H3.292V13.542Z"/></svg></td><td><svg onclick="vote(' . $id . ', -1)" xmlns="http://www.w3.org/2000/svg" height="40" width="40"><path d="M10.042 5H28.5v21.458L16.875 38.333l-1.75-1.541q-.292-.25-.437-.667-.146-.417-.146-.917v-.5l1.875-8.25H4.542q-1.125 0-1.959-.833-.833-.833-.833-1.958v-3.375q0-.292-.021-.625-.021-.334.104-.625L7 7.083q.375-.875 1.25-1.479Q9.125 5 10.042 5Zm15.666 2.792h-16L4.542 19.958v3.709h15.333l-2.208 9.958 8.041-8.333Zm0 17.5v-17.5Zm2.792 1.166v-2.791h5.375V7.792H28.5V5h8.125v21.458Z"/></svg></td><td>' . $likes . '</td>';
		}
		$stmt->close();

		$html .= '</table>';
		echo $html;
	}

	// sql statement voor top 3 liked: SELECT `id`, `name`, `like_count` FROM `beers` ORDER BY `like_count` DESC LIMIT 3;
} catch (Exception $e) {
	echo $e->getMessage();
}
?>

<script>
	// javascript voor het voting systeem
	// controle kan op backend gedaan worden met behulp van ip-adress
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

		if (response.success) {
			// true zorgt ervoor dat er geen cache word geladen
			location.reload(true);
		} else {
			alert(response.error);
		}
	}
</script> 