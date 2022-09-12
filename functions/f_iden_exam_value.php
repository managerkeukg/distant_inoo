<?php
function iden_exam_value ($student, $discipline, $year, $semestr)
{ 
	$query = "SELECT * FROM `"._TABLE_PREFIX_."exam_values`
        WHERE `user` =".$student." AND (`status`=1)  AND (`year`=".$year.") AND (`course`=".$discipline.") AND (`semestr`=".$semestr.")";
    $object_exam_values = new TableQuery;
	$object_exam_values -> order_by_field="id";
	$array_exam_values = $object_exam_values -> query ($query);
	if (isset($array_exam_values) AND !empty($array_exam_values) AND is_array($array_exam_values))
	{
		////echo "<pre> Count exam_values - "; print_r(count($array_exam_values)); echo "</pre>";
		////echo "<pre>exam_values "; print_r($array_exam_values); echo "</pre>";
		$exam_value="0";
		foreach ($array_exam_values as $value) {
			$exam_value=$value['value'];
		}
		return $exam_value;
	} else {
		return 0;
	}	
}	
?>