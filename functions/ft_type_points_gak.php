<?php
function table_type_points_gak()
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."type_points_gak` WHERE `status`='1' ORDER BY `id` DESC;";
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