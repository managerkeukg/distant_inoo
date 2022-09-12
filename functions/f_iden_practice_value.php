<?php
function iden_practice_value ($student, $practice, $course, $year, $semestr)
{ 
	$query = "SELECT * FROM `"._TABLE_PREFIX_."practice_values`
        WHERE `user` =".$student." AND (`status`=1) AND (`practice`=".$practice.")  AND (`year`=".$year.") AND (`course`=".$course.") 
		AND (`semestr`=".$semestr.")";
    $object_practice_values = new TableQuery;
	$object_practice_values -> order_by_field="id";
	$array_practice_values = $object_practice_values -> query ($query);
	if (isset($array_practice_values) AND !empty($array_practice_values) AND is_array($array_practice_values))
	{
		////echo "<pre> Count practice_values - "; print_r(count($array_practice_values)); echo "</pre>";
		////echo "<pre>practice_values "; print_r($array_practice_values); echo "</pre>";
		$practice_value = "0";
		foreach ($array_practice_values as $value) {
			$practice_value = $value['value'];
		}
		return $practice_value;
	} else {
		return 0;
	}	
}	
?>