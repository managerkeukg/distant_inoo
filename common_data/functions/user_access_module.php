<?php
function user_access_module ($moduleName) {
	//$array_modules = get_modules ();
	////echo "<pre>array_modules - "; print_r($array_modules); echo "</pre>";
	$ARRAY_USER_MODULE_PERM = user_module_permissions(_ID_USER_);
	////echo "<pre>ARRAY_USER_MODULE_PERM - "; print_r($ARRAY_USER_MODULE_PERM); echo "</pre>";
	if (isset($ARRAY_USER_MODULE_PERM[get_module_id ($moduleName)])) {
		////echo "<pre>array_modules - "; print_r($ARRAY_USER_MODULE_PERM[get_module_id ($moduleName)]); echo "</pre>";
		return $ARRAY_USER_MODULE_PERM[get_module_id ($moduleName)];
	} else {
		exit ("Access is restricted for you for this module.");
	}
}
?>