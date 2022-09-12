<?php
function  test_user_try_count($student, $test, $mod, $year)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."test_users` WHERE  `user_id`='".$student."' AND (`discipline`='".$test."') 
		AND (`year`='".$year."') AND (`mod`='".$mod."'); ";
    $object_test_users = new TableQuery;
	$object_test_users -> order_by_field="id";
	$array_test_users = $object_test_users -> query ($query);
	if (isset($array_test_users) AND !empty($array_test_users) AND is_array($array_test_users))
	{
		////echo "<pre> Count test_users - "; print_r(count($array_test_users)); echo "</pre>";
		////echo "<pre>test_users "; print_r($array_test_users); echo "</pre>";
		$count = "0";
		foreach ($array_test_users as $value) {
			if ($value['yes']=='0' AND $value['no']=='0'){}
			else {$count++;}
		}
		return $count;
	} else {
		return 0;
	}
}
?>