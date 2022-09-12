<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassShowDiv.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 
require_once _COMMON_DATA_PATH_."functions/f_show_tables.php"; 
require_once _COMMON_DATA_PATH_."functions/f_show_columns.php"; 

user_access_module ("migrate");

$dBase_tables = show_tables ("distant_inoo");
if (!empty($dBase_tables)) {
	////
	echo "<pre>dBase_tables "; print_r($dBase_tables); echo "</pre>"; 
	$array_fields = array ();
	foreach ($dBase_tables as $table) {
		$array_fields [$table] = show_columns ($table);
	}
	////
	echo "<pre>array_fields "; print_r($array_fields); echo "</pre>";
} else {
	echo "No tables in database";
}

require_once _DATA_PATH_."bottom.php";
?>