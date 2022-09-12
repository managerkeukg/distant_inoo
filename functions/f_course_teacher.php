<?php
function courses_teacher($course)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."teacher_bind_discipline`
        WHERE `subject` = ".$course."  AND `status`='1'";
	$object_teacher_disciplines= new TableQuery;
	$object_teacher_disciplines -> order_by_field="id";
	$array_teacher_disciplines = $object_teacher_disciplines -> query ($query);
	if (isset($array_teacher_disciplines) AND !empty($array_teacher_disciplines) AND is_array($array_teacher_disciplines))
	{
		////echo "<pre> Count teacher_disciplines - "; print_r(count($array_teacher_disciplines)); echo "</pre>";
		////echo "<pre>teacher_disciplines "; print_r($array_teacher_disciplines); echo "</pre>";
		$course_teachers = "";
		foreach ($array_teacher_disciplines as $value){
			$course_teachers = trim($value['teacher']);
		}
		return $course_teachers;
	}
	else {
		return 0;
	}
}
?>