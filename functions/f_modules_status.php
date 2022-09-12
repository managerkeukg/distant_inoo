<?php
function subject_modules_status($discipline)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."modules_status`
        WHERE `subject` = '".$discipline."';";
    $object_modules_status= new TableQuery;
	$object_modules_status -> order_by_field="id";
	$array_modules_status = $object_modules_status -> query ($query);
	if (isset($array_modules_status) AND !empty($array_modules_status) AND is_array($array_modules_status))
	{
		////echo "<pre> Count modules_status - "; print_r(count($array_modules_status)); echo "</pre>";
		////echo "<pre>modules_status "; print_r($array_modules_status); echo "</pre>";
		$module_data = array ();
		foreach ($array_modules_status as $value) {
			$module_data[1]=trim($value['mod1']);
			$module_data[2]=trim($value['mod2']);
		}
		return $module_data;
	} else {
		return 0;
	}
}
?>