<?php
function identify_course($discipline)
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."disciplines`
        WHERE `id` = '".$discipline."'";
    $object_disciplines = new TableQuery;
	$object_disciplines -> order_by_field="id";
	$array_disciplines = $object_disciplines -> query ($query);
	if (isset($array_disciplines) AND !empty($array_disciplines) AND is_array($array_disciplines))
	{
		////echo "<pre> Count disciplines - "; print_r(count($array_disciplines)); echo "</pre>";
		////echo "<pre>disciplines "; print_r($array_disciplines); echo "</pre>";
		$discipline_fullname = "";
		foreach ($array_disciplines as $value) {
			$discipline_fullname = trim($value['fullname']);
		}
		return $discipline_fullname;
	} else {
		return 0;
	}
}
?>