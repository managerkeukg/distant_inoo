<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 
////echo _ID_USER_;

$object_student_assignments= new TableQuery;
$object_student_assignments->order_by_field="id";
$array_student_assignments=$object_student_assignments -> query ("SELECT `id`, `discipline` FROM `"._TABLE_PREFIX_."discipline_assignments` WHERE `userid`="._ID_USER_." and `status`='1';" );
////echo count($array_student_assignments)." записей";
////echo "<pre>student assignments "; print_r($array_student_assignments); echo "</pre>"; 

if (isset($array_student_assignments) AND !empty($array_student_assignments))
{
	$name_array = array ();
	$category_array = array ();
	foreach ($array_student_assignments as $key=>$value )
	{
		$query = "SELECT * FROM `"._TABLE_PREFIX_."disciplines` WHERE  `id`='".$value['discipline']."' and `status`=1" ;
		$object_disciplines= new TableQuery;
		$object_disciplines->order_by_field="id";
		$array_disciplines=$object_disciplines -> query ($query);
		if (isset($array_disciplines) AND !empty($array_disciplines)) {
			////echo count($array_disciplines)." записей";
			////echo "<pre>disciplines "; print_r($array_disciplines); echo "</pre>"; 
			foreach ($array_disciplines as $key => $catalog_3) {
				$name_array[$value['discipline']]=$catalog_3['name_ru'];
				$category_array[$value['discipline']]=$catalog_3['semester'];
			}
		}
	}
	if (isset($name_array) AND !empty($name_array)) {
		////		echo "<pre> Students discipline "; print_r($name_array); echo "</pre>";
		////		echo "<pre> Students semester "; print_r($category_array); echo "</pre>";
		require_once "index_help.php";
	}
	else {
		echo "У вас нет прикрепленных дисциплин";
	}
}

require_once _DATA_PATH_."bottom.php";
?>