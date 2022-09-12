<?php
function show_columns ($table) {
	$object_table_columns= new TableQuery;
	$array_table_columns=$object_table_columns -> query ("SHOW COLUMNS FROM `".$table."`;" );
	if (isset($array_table_columns) AND !empty($array_table_columns))
	{
		////echo count($array_table_columns)." записей";
		////echo "<pre>table_columns "; print_r($array_table_columns); echo "</pre>"; 
		return $array_table_columns;
	} else {
		return 0;
	}
}
?>