<?php
function identify_department($department)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."departments`
        WHERE `id` = '".$department."'";
    $object_departments= new TableQuery;
	$object_departments -> order_by_field="id";
	$array_departments = $object_departments -> query ($query);
	if (isset($array_departments) AND !empty($array_departments) AND is_array($array_departments))
	{
		////echo "<pre> Count departments - "; print_r(count($array_departments)); echo "</pre>";
		////echo "<pre>departments "; print_r($array_departments); echo "</pre>";
		$department_fullname = "";
		foreach ($array_departments as $value) {
			$department_fullname = trim($value['name']);
		}
		return $department_fullname;
	} else {
		return 0;
	}
}
?>