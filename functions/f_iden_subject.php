<?php
function identify_course($course)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."disciplines`
        WHERE `id` = ".$course."";
    $object_disciplines = new TableQuery;
	$object_disciplines -> order_by_field="id";
	$array_disciplines = $object_disciplines -> query ($query);
	if (isset($array_disciplines) AND !empty($array_disciplines) AND is_array($array_disciplines))
	{
		////echo "<pre> Count disciplines - "; print_r(count($array_disciplines)); echo "</pre>";
		////echo "<pre>disciplines "; print_r($array_disciplines); echo "</pre>";
		$course_fullname = "";
		foreach ($array_disciplines as $value) {
			$course_fullname = trim($value['name_ru_detailed']);
		}
		return $course_fullname;
	} else {
		return 0;
	}
}
?>