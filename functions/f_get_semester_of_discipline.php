<?php
function get_semester_of_discipline($course)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."disciplines`
              WHERE `id` = '".$course."'";
    $object_disciplines = new TableQuery;
	$object_disciplines -> order_by_field="id";
	$array_disciplines = $object_disciplines -> query ($query);
	if (isset($array_disciplines) AND !empty($array_disciplines) AND is_array($array_disciplines))
	{
		////echo "<pre> Count disciplines - "; print_r(count($array_disciplines)); echo "</pre>";
		////echo "<pre>disciplines "; print_r($array_disciplines); echo "</pre>";
		$course_semester = "";
		foreach ($array_disciplines as $value) {
			$course_semester = trim($value['semester']);
		}
	} else {
		return 0;
	}
	
	if (isset($course_semester) AND !empty($course_semester))
	{
		$query = "SELECT * FROM `"._TABLE_PREFIX_."semester`
			WHERE `id` = '".$course_semester."'";
		$object_course_groups = new TableQuery;
		$object_course_groups -> order_by_field="id";
		$array_course_groups = $object_course_groups -> query ($query);
		if (isset($array_course_groups) AND !empty($array_course_groups) AND is_array($array_course_groups))
		{
			////echo "<pre> Count course_groups - "; print_r(count($array_course_groups)); echo "</pre>";
			////echo "<pre>course_groups "; print_r($array_course_groups); echo "</pre>";
			$course_semestr = "";
			foreach ($array_course_groups as $value) {
				$course_semestr=trim($value['name_ru']);
			}
			return $course_semestr;
		} else {
			return 0;
		}
	}
}
?>