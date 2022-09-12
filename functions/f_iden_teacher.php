<?php
function identify_teacher($teacher)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."teachers`
        WHERE `id` = ".$teacher."";
    $object_teachers = new TableQuery;
	$object_teachers -> order_by_field="id";
	$array_teachers = $object_teachers -> query ($query);
	if (isset($array_teachers) AND !empty($array_teachers) AND is_array($array_teachers))
	{
		////echo "<pre> Count teachers - "; print_r(count($array_teachers)); echo "</pre>";
		////echo "<pre>teachers "; print_r($array_teachers); echo "</pre>";
		$teacher_fullname = "";
		foreach ($array_teachers as $value) {
			$teacher_fullname = trim($value['name'])." ".$value['father_name']." ".$value['surname'];
		}
		return $teacher_fullname;
	} else {
		return 0;
	}
}
?>