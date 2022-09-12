<?php
function  get_course_groups ($course)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."discipline_assignments`
            WHERE `status` = '1' AND `discipline`=".$course.";
              "; // category
	$object_discipline_assignments = new TableQuery;
	$object_discipline_assignments -> order_by_field="id";
	$array_discipline_assignments = $object_discipline_assignments -> query ($query);
	if (isset($array_discipline_assignments) AND !empty($array_discipline_assignments) AND is_array($array_discipline_assignments))
	{
		////echo "<pre> Count discipline_assignments - "; print_r(count($array_discipline_assignments)); echo "</pre>";
		////echo "<pre>discipline_assignments "; print_r($array_discipline_assignments); echo "</pre>";
		$student_array = array ();
		foreach ($array_discipline_assignments as $value) {
			$student_array[identify_group_of_student($value['userid'])] = $value['userid'];
		}
		return $student_array;
	} else {
		return 0;
	}
}
?>