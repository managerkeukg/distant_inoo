<?php
function iden_additional_ball ($student, $course, $year, $semestr)
{ 
	$query = "SELECT * FROM `"._TABLE_PREFIX_."add_balls_values`
			WHERE `user` =".$student." AND (`status`=1)  AND (`year`=".$year.") AND (`course`=".$course.") AND (`semestr`=".$semestr.")";
    $object_add_balls= new TableQuery;
	$object_add_balls -> order_by_field="id";
	$array_add_balls = $object_add_balls -> query ($query);
	if (isset($array_add_balls) AND !empty($array_add_balls) AND is_array($array_add_balls))
	{
		////echo "<pre> Count add_balls - "; print_r(count($array_add_balls)); echo "</pre>";
		////echo "<pre>add_balls "; print_r($array_add_balls); echo "</pre>";
		$exam_value = "0";
		foreach ($array_add_balls as $value) {
			$exam_value = $value['value'];
		}
		return $exam_value;
	} else {
		return 0;
	}
}	
?>