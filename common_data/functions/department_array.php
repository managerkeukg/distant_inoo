<?php
function department_array($department)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."departments`
        WHERE `id` = `".$department."`;";
    $object_departments = new TableQuery;
	$object_departments -> order_by_field="id";
	$array_departments = $object_departments->query ($query);
	if (isset($array_departments) AND !empty($array_departments) AND is_array($array_departments))
	{
		////echo "<pre> departments count "; print_r(count($array_departments)); echo "</pre>";
		////echo "<pre> departments "; print_r($array_departments); echo "</pre>";
		$dep_array = array ();
		foreach ($array_departments as $value)
		{
			$dep_array=$value;
		}
		return $dep_array;
	} else {
		return 0;
	}
}
?>