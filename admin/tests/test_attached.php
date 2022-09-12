<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("tests"); 

is_int_obligatory ($_GET['test']);
$test=$_GET['test'];

echo "<h2>Тесты прикреплённые к дисциплинам</h2>";

$object_disciplines = new TableQuery;
$object_disciplines -> order_by_field="id";
$array_disciplines = $object_disciplines -> query ("SELECT * FROM `"._TABLE_PREFIX_."disciplines` " ); 
//echo "<pre>"; print_r($array_disciplines); echo "</pre>";

$object_test_attached= new TableQuery;
$object_test_attached -> order_by_field="id";
$array_test_attached = $object_test_attached -> query ("SELECT * FROM `"._TABLE_PREFIX_."courses_bind_test` WHERE `test` = '".$test."' AND `status`='1'"); 

if (isset($array_test_attached) AND !empty($array_test_attached))
{
	echo count ($array_test_attached);
	////echo "<pre>"; print_r($array_test_attached); echo "</pre>";
	foreach ($array_test_attached as $key => $value) 
	{
		echo "<br><br>".$value['subject']."  ".$array_disciplines[$value['subject']]['name_ru'];
		echo "<br>    ".$array_disciplines[$value['subject']]['name_ru_detailed'];
	}
}

require_once _DATA_PATH_."bottom.php";
?>