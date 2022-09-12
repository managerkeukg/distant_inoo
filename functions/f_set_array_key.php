<?php
function set_array_key ($array, $field, $value_field)
{   
	///*
    $new_array=array();
	foreach ($array as $key=>$value) {
		if (!empty($value_field))
		{
			$new_array[$value[$field]]=$value[$value_field];
		}
		else {
			$new_array[$value[$field]]=$value;
		}
	}
	 return $new_array;
	 //*/
}

function set_array_keys ($array, $field, $value_field)
{   
	///*
    $new_array=array();
	foreach ($array as $key=>$value) {
		if (!empty($value_field))
		{
			$new_array[$value[$field]][]=$value[$value_field];
		}
		else {
			$new_array[$value[$field]][]=$value;
		}
	}
	 return $new_array;
	 //*/
}
?>