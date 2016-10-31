<?php

$ships = [
	'C'=>16,
	'D'=>8,
	'N'=>7,
	'T'=>5,
	'F'=>4,
	'M'=>2,
	'R'=>1,
];

$navy_ships = [
	'C'=>16,
	'D'=>8,
	'N'=>7,
	'F'=>4,
];

$civil_ships = [
	'T'=>5,
	'M'=>2,
	'R'=>1,
];

echo "<h1>All Fleets</h1>".draw_fleets_table($ships);
echo "<h1>Navy only Fleets</h1>".draw_fleets_table($navy_ships);
echo "<h1>Civil only Fleets</h1>".draw_fleets_table($civil_ships);

function draw_fleets_table($ships) {
	$fleets = [];
	$q_2 = $q_3 = $q_4 = 0;

	foreach ($ships as $key => $value) {
		$fleets[$value][] = $key;
		$ships_2 = array_slice($ships, $q_2++);
		$q_3 = $q_2 - 1;
		foreach ($ships_2 as $key_2 => $value_2) {
			$fleets[$value + $value_2][] = $key . $key_2;
			$ships_3 = array_slice($ships, $q_3++);
			$q_4 = $q_3 - 1;
			foreach ($ships_3 as $key_3 => $value_3) {
				$fleets[$value + $value_2 + $value_3][] = $key . $key_2 . $key_3;
				$ships_4 = array_slice($ships, $q_4++);
				foreach ($ships_4 as $key_4 => $value_4) {
					$fleets[$value + $value_2 + $value_3 + $value_4][] = $key . $key_2 . $key_3 . $key_4;
				}
			}
		}
	}

	ksort($fleets);

	$headers = array_keys($fleets);

	$fleets_block = [];
	foreach (array_values($fleets) as $fleet) {
		$fleets_block[] = "<p>" . implode('</p><p>', $fleet) . "</p>";
	}

	$output = "
	<table border='1'>
	<tr><th>" . implode('</th><th>', $headers) . "</th></th>
	<tr><td>" . implode('</td><td>', $fleets_block) . "</td></tr>
	</table>
	";

	return $output;
}



