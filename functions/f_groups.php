<?php
function groups_data ()
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."groups`";
	$object_groups = new TableQuery;
	$object_groups -> order_by_field = "id";
	$array_groups = $object_groups -> query ($query);
	if (isset($array_groups) AND !empty($array_groups) AND is_array($array_groups))
	{
		////echo "<pre> Count groups - "; print_r(count($array_groups)); echo "</pre>";
		////echo "<pre>groups "; print_r($array_groups); echo "</pre>";
		$array = array ();
		foreach ($array_groups as $value) {
			$array[$value['id']]['name']=$value['name']; //trim($value['group_name']);
			$array[$value['id']]['year']=$value['year'];
			$array[$value['id']]['spec']=$value['direction'];
		}
		return $array;
	} else {
		return 0;
	}
}
?>