<?php
function f_table_query($query, $order_by)
{	
	$object= new TableQuery;
	$object -> order_by_field=$order_by;
	$array=$object->query ($query);
	return $array;
}
?>