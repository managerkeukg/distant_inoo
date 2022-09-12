<?php
function identify_course_test($course, $module, $year)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."courses_bind_test`
        WHERE `subject` = '".$course."' AND (`status`='1')  AND (`mod`='".$module."')  AND (`year`='".$year."')";
    $object_courses_bind_test = new TableQuery;
	$object_courses_bind_test -> order_by_field="id";
	$array_courses_bind_test = $object_courses_bind_test -> query ($query);
	if (isset($array_courses_bind_test) AND !empty($array_courses_bind_test) AND is_array($array_courses_bind_test))
	{
		////echo "<pre> Count courses_bind_test - "; print_r(count($array_courses_bind_test)); echo "</pre>";
		////echo "<pre>courses_bind_test "; print_r($array_courses_bind_test); echo "</pre>";
		$test = "";
		foreach ($array_courses_bind_test as $value) {
			$test=trim($value['test']);
		}
		return $test;
	} else {
		return 0;
	}
}
?>