<?php
function  test_isused($test)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."courses_bind_test`
        WHERE `test` = '".$test."' AND `status`='1';";
    $object_courses_test = new TableQuery;
	$object_courses_test -> order_by_field="id";
	$array_courses_test = $object_courses_test -> query ($query);
	if (isset($array_courses_test) AND !empty($array_courses_test) AND is_array($array_courses_test))
	{
		////echo "<pre> Count courses_test - "; print_r(count($array_courses_test)); echo "</pre>";
		////echo "<pre>courses_test "; print_r($array_courses_test); echo "</pre>";
		return count($array_courses_test);
	} else {
		return 0;
	}
}
?>