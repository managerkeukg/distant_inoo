<?php
function convert_points ($points, $array_points)
{
	$point = "";
	foreach ($array_points as $value) {
		if ($points >= $value['from'] AND ($points <= $value['till'])) {
			$point = $value['name_ru'];
		}
	}
	return $point;
}
?>