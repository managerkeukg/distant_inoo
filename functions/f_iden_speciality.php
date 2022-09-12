<?php
function identify_speciality($direction)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."directions`
        WHERE `id` = '".$direction."' AND `status`='1';";
    $object_directions = new TableQuery;
	$object_directions -> order_by_field="id";
	$array_directions = $object_directions -> query ($query);
	if (isset($array_directions) AND !empty($array_directions) AND is_array($array_directions))
	{
		////echo "<pre> Count directions - "; print_r(count($array_directions)); echo "</pre>";
		////echo "<pre>directions "; print_r($array_directions); echo "</pre>";
		$direction_fullname = "";
		foreach ($array_directions as $value) {
			$direction_fullname = trim($value['name_ru']);
		}
		return $direction_fullname;
	} else {
		return 0;
	}
}
?>