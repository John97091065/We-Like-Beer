<?php

// server van php, dit word in pricipe gebruikt als een api / verzameling van functies
// de functies worden aangeroepen met de javascript fetch api
// houd hier wel rekening met beveiliging javascript is namelijk wel client side

declare(strict_types=1);
$fn = filter_input(INPUT_GET, 'fn');

try {

	if ($fn === 'vote') {
		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
		$amount = filter_input(INPUT_GET, 'amount', FILTER_VALIDATE_INT);
		$amount = empty($amount) ? 1 : $amount;

		require_once 'conn.php';

		if ($stmt = $conn->prepare("SELECT `id` FROM `votes` WHERE `ip_adress` = INET_ATON(?)")) {
			$stmt->bind_param("s", $_SERVER["REMOTE_ADDR"]);
			$stmt->execute();
			$stmt->bind_result($id);

			if ($stmt->fetch()) {
				$stmt->close();

				if ($amount === -1) {
					if ($stmt = $conn->prepare("DELETE FROM `votes` WHERE `id` = ?")) {
						$stmt->bind_param("i", $id);
						$stmt->execute();
					}
					$stmt->close();
				}

				$return = new stdClass;
				$return->success = true;

				header('content-type: application/json');
				print(json_encode($return));
			} else {
				$stmt->close();
			}
		}

		if ($stmt = $conn->prepare("INSERT INTO `votes` (`beer_id`, `ip_adress`) VALUES (?, INET_ATON(192.168))")) {
			$stmt->bind_param('i', $id);
			if ($stmt->execute()) {
				$stmt->close();
				$return = new stdClass;
				$return->success = true;

				header('content-type: application/json');
				print(json_encode($return));
			}
		}
	} elseif ($fn === "getAllBeers") {
		require_once "conn.php";

		// alle bieren
		// left join statement haalt niet alle biertjes op
		if ($stmt = $conn->prepare('SELECT beers.id, beers.name, beers.purchase_price, COUNT(votes.beer_id) FROM `beers` LEFT JOIN `votes` ON votes.beer_id = beers.id GROUP BY beers.id')) {
			$stmt->execute();
			$stmt->bind_result($id, $name, $price, $votes);

			$html = [];
			while ($stmt->fetch()) {
				$tmp = new stdClass;
				$tmp->id = $id;
				$tmp->name = $name;
				$tmp->price = $price;
				$tmp->votes = $votes;
				$html[] = $tmp;
				// $html->like_count = $like_count;
			}
			header('content-type: application/json');
			print(json_encode($html));
			$stmt->close();
		}
	} elseif ($fn === 'getBeer') {
		$beer_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

		require_once 'conn.php';

		if ($stmt = $conn->prepare("SELECT beers.name, beers.brewer, beers.type, beers.yeast, beers.perc, beers.purchase_price, rating.comment, rating.amount FROM `beers` LEFT JOIN `rating` ON   rating.beer_id = beers.id where beers.id = ?")) {
			$stmt->bind_param("i", $beer_id);
			$stmt->execute();
			$stmt->bind_result($name, $brewer, $type, $yeast, $perc, $purchse_price, $comment, $amount);

			$html = new stdClass;

			if ($stmt->fetch()) {
				$stmt->close();
				$html->name = $name;
				$html->brewer = $brewer;
				$html->type = $type;
				$html->yeast = $yeast;
				$html->perc = $perc;
				$html->purchase_price = $purchse_price;
				$html->comment = $comment;
				$html->amount = $amount;
			}
			header('content-type: application/json');
			print(json_encode($html));
			
		}
	}
} catch (Exception $e) {
	$return = new stdClass;
	$return->success = false;
	$return->error = $e->getMessage();

	header('content-type: application/json');
	print(json_encode($return));
	exit();
}
