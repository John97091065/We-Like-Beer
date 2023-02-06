<?php

// server van php, dit word in pricipe gebruikt als een verzameling van functies
// de functies worden aangeroepen met de javascript fetch api
// houd hier wel rekening met beveiliging javascript is namelijk wel client side

$fn = filter_input(INPUT_GET, 'fn');

try {
	if ($fn === 'vote') {
		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
		$amount = filter_input(INPUT_GET, 'amount', FILTER_VALIDATE_INT);

		$amount = empty($amount)?1:$amount;

		require_once "conn.php";

		if ($stmt = $conn->prepare("UPDATE `beers` SET `like_count` = `like_count` + ? WHERE `id` = ?")) {
			$stmt->bind_param("ii", $amount, $id);
			if ($stmt->execute()) {
				$return = new stdClass;
				$return->success = true;

				header('content-type: application/json');
				print(json_encode($return));
			}
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