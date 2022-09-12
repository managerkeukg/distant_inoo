<?php
function identify_teacher_course($course)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."teacher_bind_discipline`
        WHERE `subject` = ".$course."";
    $object_teachers_discipline= new TableQuery;
	$object_teachers_discipline -> order_by_field="id";
	$array_teachers_discipline = $object_teachers_discipline -> query ($query);
	if (isset($array_teachers_discipline) AND !empty($array_teachers_discipline) AND is_array($array_teachers_discipline))
	{
		////echo "<pre> Count teachers_discipline - "; print_r(count($array_teachers_discipline)); echo "</pre>";
		////echo "<pre>teachers_discipline "; print_r($array_teachers_discipline); echo "</pre>";
		$teacher = "";
		foreach ($array_teachers_discipline as $value) {
			$teacher = trim($value['teacher']);
		}
		return $teacher;
	} else {
		return 0;
	}
}
?>