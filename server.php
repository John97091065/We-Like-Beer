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

		require_once 'conn.php';

		if ($stmt = $conn->prepare("UPDATE `beers` SET `like_count` = `like_count` + ? WHERE `id` = ?")) {
			$stmt->bind_param('ii', $amount, $id);
			if ($stmt->execute()) {
				$return = new stdClass;
				$return->success = true;

				header('content-type: application/json');
				print(json_encode($return));
			}
		}
	} elseif ($fn === 'voteV2') {
		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
		$amount = filter_input(INPUT_GET, 'amount', FILTER_VALIDATE_INT);
		$amount = empty($amount)?1:$amount;
		
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

		if ($stmt = $conn->prepare("INSERT INTO `votes` (`beer_id`, `ip_adress`) VALUES (?, INET_ATON(?))")) {
			$stmt->bind_param('is', $id, $_SERVER['REMOTE_ADDR']);
			if ($stmt->execute()) {
				$stmt->close();
				$return = new stdClass;
				$return->success = true;

				header('content-type: application/json');
				print(json_encode($return));
			}
		}
	} elseif ($fn === 'getVotes') {
		require_once 'conn.php';

		if ($stmt = $conn->prepare("SELECT INET_NTOA(`ip_adress`) FROM `votes`")) {
			$stmt->execute();
			$stmt->bind_result($ip);
			while($stmt->fetch()) {
				echo $ip . "\n";
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