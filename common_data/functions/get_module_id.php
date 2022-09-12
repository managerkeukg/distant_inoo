<?php
function get_module_id ($moduleName) 
{ 
	$array_modules = get_modules ();
	////echo "<pre>array_modules - "; print_r($array_modules); echo "</pre>";
	if (is_array($array_modules)) {
		foreach ($array_modules as $value) {
			if ($value['path']==$moduleName) {
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