<?php
function exist_user ($login) 
{
	$login=htmlspecialchars(trim($login));
	$query = "SELECT * FROM `"._TABLE_PREFIX_."students`
        WHERE `username` = '".$login."'";
    $object_students= new TableQuery;
	$object_students -> order_by_field="id";
	$array_students = $object_students -> query ($query);
	if (isset($array_students) AND !empty($array_students) AND is_array($array_students))
	{
		////echo "<pre> Count students - "; print_r(count($array_students)); echo "</pre>";
		////echo "<pre>students "; print_r($array_students); echo "</pre>";
		$student_id = array ();
		foreach ($array_students as $value) {
			$student_id = trim($value['id']);
		}
		return $student_id;
	} else {
		return 0;
	}
}
?>