<?php
function identify_group_of_student($student)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."group_members`
            WHERE `id_user` = '".$student."'";
    $object_group_members= new TableQuery;
	$object_group_members -> order_by_field="id";
	$array_group_members = $object_group_members -> query ($query);
	if (isset($array_group_members) AND !empty($array_group_members) AND is_array($array_group_members))
	{
		////echo "<pre> Count group_members - "; print_r(count($array_group_members)); echo "</pre>";
		////echo "<pre>group_members "; print_r($array_group_members); echo "</pre>";
		$student_group = "";
		foreach ($array_group_members as $value) {
			$student_group=trim($value['group']);
		}
		return $student_group;
	} else {
		return 0;
	}
}
?>