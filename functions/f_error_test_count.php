<?php
function subject_test_error_counts($discipline)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."test_questions`
        WHERE `discipline` = '".$discipline."' AND `status`='1' AND `correct`='0';";
    $object_test_questions= new TableQuery;
	$object_test_questions -> order_by_field="id";
	$array_test_questions = $object_test_questions -> query ($query);
	if (isset($array_test_questions) AND !empty($array_test_questions) AND is_array($array_test_questions))
	{
		////echo "<pre> Count test_questions - "; print_r(count($array_test_questions)); echo "</pre>";
		////echo "<pre>test_questions "; print_r($array_test_questions); echo "</pre>";
		$error_count = count($array_test_questions);
		return $error_count;
	} else {
		return 0;
	}
}
?>