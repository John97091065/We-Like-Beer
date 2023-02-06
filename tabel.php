<?php

// een apart bestand om merge problemen te voorkomen

// variabelen doe ik in het engels om het universeel te houden
// $conn is je database connectie maak die even voor jezelf aan

declare(strict_types=1);

// zorgt er voor dat errors gelogd worden
error_reporting(E_ALL);

// hier word de variabel $conn opgehaald
require_once "conn.php";

try {
	if ($stmt = $conn->prepare("SELECT `id`, `name`, `like_count` FROM `beers`")) {
		$stmt->execute();
		$stmt->bind_result($id, $name, $likes);
		// je kan hier classes aan toevoegen eventueel "dylan"
		$html = "<table><tr><th>id</th><th>naam</th><th>+</th><th>-</th><th>likes</th>";
		while($stmt->fetch()) {
			$html .= "<tr><td>" . $id . "</td><td>" . $name . "</td><td>+</td><td>-</td><td>" . $likes . "</td>";
		}
		$html .= "</table>";
	}

	// sql statement voor top 3 liked: SELECT `id`, `name`, `like_count` FROM `beers` ORDER BY `like_count` DESC LIMIT 3;
} catch (Exception $e) {
	echo $e->getMessage();
}
?>

<?= $html ?>