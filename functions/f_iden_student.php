<?php
function identify_student($student)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."students`
        WHERE `id` = ".$student."";
    $object_students = new TableQuery;
	$object_students -> order_by_field="id";
	$array_students = $object_students -> query ($query);
	if (isset($array_students) AND !empty($array_students) AND is_array($array_students))
	{
		////echo "<pre> Count students - "; print_r(count($array_students)); echo "</pre>";
		////echo "<pre>students "; print_r($array_students); echo "</pre>";
		$student_fullname = "";
		foreach ($array_students as $value) {
			$student_fullname = trim($value['lastname'])." ".trim($value['firstname'])." ".trim($value['patronymic']);
		}
		return $student_fullname;
	} else {
		return 0;
	}
}
?>