<?php
function get_user_status($user)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."students`
        WHERE `id` = '".$user."';";
    $object_students = new TableQuery;
	$object_students -> order_by_field="id";
	$array_students = $object_students -> query ($query);
	if (isset($array_students) AND !empty($array_students) AND is_array($array_students))
	{
		////echo "<pre> Count students - "; print_r(count($array_students)); echo "</pre>";
		////echo "<pre>students "; print_r($array_students); echo "</pre>";
		$user_status = "";
		foreach ($array_students as $value) {
			$user_status = trim($value['status']);
		}
		return $user_status;
	} else {
		return 0;
	}
}
?>