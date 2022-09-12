<?php
function test_result ($table, $year, $test)
{
	$query = "SELECT * FROM `".$table."` WHERE (`discipline` = '".$test."' ) AND (`year`='".$year."')   AND (`yes`<>'0')   
		ORDER BY `user_id` ASC; ";
    $object_course_groups = new TableQuery;
	$object_course_groups -> order_by_field="id";
	$array_course_groups = $object_course_groups -> query ($query);
	if (isset($array_course_groups) AND !empty($array_course_groups) AND is_array($array_course_groups))
	{
		////echo "<pre> Count course_groups - "; print_r(count($array_course_groups)); echo "</pre>";
		////echo "<pre>course_groups "; print_r($array_course_groups); echo "</pre>";
		$return = array ();
		foreach ($array_course_groups as $value) {
			$return[]=$value;
		}
		return $return;
	} else {
		return 0;
	}
}
?>