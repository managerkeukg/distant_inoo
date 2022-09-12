<?php
function semester_disciplines ($semester)
{
	$query = "SELECT `id`, `name_ru` FROM `"._TABLE_PREFIX_."disciplines`
        WHERE `semester` = '".$semester."' AND `status`='1';";
    $object_disciplines = new TableQuery;
	$object_disciplines -> order_by_field="id";
	$array_disciplines = $object_disciplines -> query ($query);
	if (isset($array_disciplines) AND !empty($array_disciplines) AND is_array($array_disciplines))
	{
		////echo "<pre> Count disciplines - "; print_r(count($array_disciplines)); echo "</pre>";
		////echo "<pre>disciplines "; print_r($array_disciplines); echo "</pre>";
		$disciplines = array ();
		foreach ($array_disciplines as $value) {
			$disciplines[$value['id']]=$value;
		}
		return $disciplines;
	} else {
		return 0;
	}
}
?>