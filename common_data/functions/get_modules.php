<?php
function get_modules () {
	$query = "SELECT * FROM `"._TABLE_PREFIX_._USER_PREFIX_."_access_modules` WHERE `status`='1';";
	$object_modules= new TableQuery;
	$object_modules -> order_by_field="id";
	$array_modules = $object_modules -> query ($query);
	if (isset($array_modules) AND !empty($array_modules) AND is_array($array_modules)) {
		////echo "<pre>array_modules - "; print_r($array_modules); echo "</pre>";
		return $array_modules;
	} else {
		return 0;
	}
}
?>