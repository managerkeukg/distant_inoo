<?php
function identify_test_name($test)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."tests`
        WHERE `id` = ".$test.";";
    $object_tests = new TableQuery;
	$object_tests -> order_by_field="id";
	$array_tests = $object_tests -> query ($query);
	if (isset($array_tests) AND !empty($array_tests) AND is_array($array_tests))
	{
		////echo "<pre> Count tests - "; print_r(count($array_tests)); echo "</pre>";
		////echo "<pre>tests "; print_r($array_tests); echo "</pre>";
		$test_name = "";
		foreach ($array_tests as $value) {
			$test_name = trim($value['name']);
		}
		return $test_name;
	} else {
		return 0;
	}
}
?>