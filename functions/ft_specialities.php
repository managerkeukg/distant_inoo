<?php
function table_specialities()
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."specialities` WHERE `status`='1' ORDER BY `id` ASC;";
	$object = new TableQuery;
	$object -> order_by_field = "id";
	$array = $object -> query ($query);
	if (isset($array) AND !empty($array) AND is_array($array))
	{
		////echo "<pre> Count - "; print_r(count($array)); echo "</pre>";
		////echo "<pre> "; print_r($array); echo "</pre>";
		return $array;
	}
	else {
		return 0;
	}
}

function get_speciality ($direction) {
	$query = "SELECT * FROM `"._TABLE_PREFIX_."specialities` WHERE `id` = '".$direction."';";
	$object = new TableQuery;
	$object -> order_by_field = "id";
	$array = $object -> query ($query);
	if (isset($array) AND !empty($array) AND is_array($array))
	{
		////echo "<pre> Count - "; print_r(count($array)); echo "</pre>";
		////echo "<pre> "; print_r($array); echo "</pre>";
		return $array;
	}
	else {
		return 0;
	}
}
?>