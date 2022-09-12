<?php
function user_access_submodule ($subModuleName) {
	//$array_subModules = get_submodules ();
	////echo "<pre>array_subModules - "; print_r($array_subModules); echo "</pre>";
	$ARRAY_USER_SUBMODULE_PERM = user_submodule_permissions(_ID_USER_);
	if (isset($ARRAY_USER_SUBMODULE_PERM[get_submodule_id ($subModuleName)])) {
		////echo "<pre>array_subModules - "; print_r($ARRAY_USER_SUBMODULE_PERM[get_submodule_id ($subModuleName)]); echo "</pre>";
		return $ARRAY_USER_SUBMODULE_PERM[get_submodule_id ($subModuleName)];
	} else {
		exit ("Access is restricted for you for this submodule.");
	}
}
?>