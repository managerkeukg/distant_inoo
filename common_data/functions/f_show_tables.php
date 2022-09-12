<?php
function show_tables ($DBase) {
	$object_dBase_tables= new TableQuery;
	//$object_dBase_tables->order_by_field="id";
	$array_dBase_tables=$object_dBase_tables -> query ("SHOW TABLES FROM ".$DBase.";" );
	if (isset($array_dBase_tables) AND !empty($array_dBase_tables))
	{
		////echo count($array_dBase_tables)." записей";
		////echo "<pre>dBase_tables "; print_r($array_dBase_tables); echo "</pre>"; 
		$array = array ();
		foreach ($array_dBase_tables as $value)
		{
			$array[] = $value['Tables_in_'.$DBase.''];
		}
		return $array;
	} else {
		return 0;
	}
}
?>