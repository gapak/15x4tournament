<?php

$ships = [
	'TIT'=>512,
	'SUP'=>256,
	'CAP'=>128,
 // 'BS3'=>112,
	'BS2'=>96,
	'BSP'=>80,
	'BSN'=>72,
	'BS'=>64,
	'KR3'=>56,
	'BK2'=>48,
 // 'BKP'=>44,
	'BKN'=>40,
	'CRA'=>36,
	'BK'=>32,
	'BK3'=>28,
	'CR2'=>24,
	'CRP'=>20,
	'CRN'=>18,
	'CR'=>16,
	'DR3'=>15,
	'DR2'=>14,
 // 'DRP'=>13,
	'CRS'=>12,
	'FRA'=>11,
	'FR2'=>10,
	'FRP'=>9,
	'DR'=>8,
	'FRN'=>7,
	'IT'=>6,
	'IN'=>5,
	'FR'=>4,
	'FRS'=>3,
	'FRM'=>2,
	'RS'=>1,
];

$alpha_ships = [
	'CRP'=>20,
	'CRN'=>18,
	'CR'=>16,
 // 'DRP'=>13,
	'CRS'=>12,
	'FRP'=>9,
	'DR'=>8,
	'FRN'=>7,
	'IT'=>6,
	'IN'=>5,
	'FR'=>4,
	'FRS'=>3,
	'FRM'=>2,
	'RS'=>1,
];

$omega_ships = [
	'TIT'=>512,
	'SUP'=>256,
	'CAP'=>128,
 // 'BS3'=>112,
	'BS2'=>96,
	'BSP'=>80,
	'BSN'=>72,
	'BS'=>64,
	'KR3'=>56,
	'BK2'=>48,
 // 'BKP'=>44,
	'BKN'=>40,
	'CRA'=>36,
	'BK'=>32,
	'BK3'=>28,
	'CR2'=>24,
	'DR3'=>15,
	'DR2'=>14,
	'FRA'=>11,
	'FR2'=>10,
];

$output = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><style>p {overflow: hidden; white-space: nowrap;}</style></head><body>';
$output .= "<h1>All Fleets</h1>" . draw_fleets_table($ships);
$output .=  "<h1>Omega only Fleets</h1>" . draw_fleets_table($omega_ships);
$output .=  "<h1>Alpha only Fleets</h1>" . draw_fleets_table($alpha_ships);
$output .=  "</body></html>";

echo $output;

echo file_put_contents('fleets_builder_big_bang.php.html', $output); 

function draw_fleets_table($ships) {
	$fleets = [];
	$q_2 = $q_3 = $q_4 = 0;

	foreach ($ships as $key => $value) {
		$fleets[$value][] = $key;
		$ships_2 = array_slice($ships, $q_2++);
		$q_3 = $q_2 - 1;
		foreach ($ships_2 as $key_2 => $value_2) { 
			$fleets[$value + $value_2][] = $key . ' ' . $key_2;
			$ships_3 = array_slice($ships, $q_3++);
			$q_4 = $q_3 - 1;
			foreach ($ships_3 as $key_3 => $value_3) {
				$fleets[$value + $value_2 + $value_3][] = $key . ' ' . $key_2 . ' ' . $key_3;
				/*
				$ships_4 = array_slice($ships, $q_4++);
				foreach ($ships_4 as $key_4 => $value_4) {
					$fleets[$value + $value_2 + $value_3 + $value_4][] = $key . ' ' . $key_2 . ' ' . $key_3 . ' ' . $key_4;
				}
				*/
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



