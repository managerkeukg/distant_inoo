<?php
function user_module_permissions ($user)
{ 
	$query = "SELECT * FROM `"._TABLE_PREFIX_._USER_PREFIX_."_access_user_permissions`
        WHERE `user` = '".$user."'  AND `status`='1';";
    $object_user_module_permissions= new TableQuery;
	$object_user_module_permissions -> order_by_field="id";
	$array_user_module_permissions = $object_user_module_permissions -> query ($query);
	if (isset($array_user_module_permissions) AND !empty($array_user_module_permissions) AND is_array($array_user_module_permissions)) {
		////echo "<pre>array_user_module_permissions count - "; print_r(count($array_user_module_permissions)); echo "</pre>";
		////echo "<pre>array_user_module_permissions - "; print_r($array_user_module_permissions); echo "</pre>";
		$array_permissions = array ();
		foreach ($array_user_module_permissions as $value) {
			$array_permissions[$value['module']] [$value['permission']]=$value['permission'];
		}
		return $array_permissions;
	} else { 
		return 0;
	}
}
?>