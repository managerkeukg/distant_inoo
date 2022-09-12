<?php
function get_submodule_id ($subModuleName) {
	$array_subModules = get_submodules ();
	////echo "<pre>array_subModules - "; print_r($array_subModules); echo "</pre>";
	if (is_array($array_subModules)) {
		foreach ($array_subModules as $value) {
			if ($value['name']==$subModuleName) {
				return $value['id'];
			} else {
				
			}
		}
		return 0;
	} else {
		return 0;
	}
}
?>