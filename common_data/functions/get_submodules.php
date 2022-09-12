<?php
function get_submodules () {
	$query = "SELECT * FROM `"._TABLE_PREFIX_._USER_PREFIX_."_access_modules_sub` WHERE `status`='1';";
	$object_subModules= new TableQuery;
	$object_subModules -> order_by_field="id";
	$array_subModules = $object_subModules -> query ($query);
	if (isset($array_subModules) AND !empty($array_subModules) AND is_array($array_subModules)) {
		////echo "<pre>array_subModules - "; print_r($array_subModules); echo "</pre>";
		return $array_subModules;
	} else {
		return 0;
	}
}
?>