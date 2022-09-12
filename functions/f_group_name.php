<?php
function identify_group_name($group)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."groups`
        WHERE `id` = ".$group."";
	$object_groups= new TableQuery;
	$object_groups -> order_by_field="id";
	$array_groups = $object_groups -> query ($query);
	if (isset($array_groups) AND !empty($array_groups) AND is_array($array_groups))
	{
		////echo "<pre> Count groups - "; print_r(count($array_groups)); echo "</pre>";
		////echo "<pre>groups "; print_r($array_groups); echo "</pre>";
		foreach ($array_groups as $value) {
			$group_name = trim($value['name']);
		}
		return $group_name;
	} else {
		return 0;
	}
}
?>