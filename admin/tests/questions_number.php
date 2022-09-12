<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("tests"); 

is_int_obligatory ($_GET['test']);
$test=$_GET['test'];

echo "<h2>Количество вопросов в тесте</h2>";

$object_test_attached= new TableQuery;
$object_test_attached -> order_by_field="id";
$array_test_attached = $object_test_attached -> query ("SELECT * FROM `"._TABLE_PREFIX_."test_questions` WHERE `discipline` = '".$test."' AND `status`='1';"); 

if (isset($array_test_attached) AND !empty($array_test_attached))
{
	echo count ($array_test_attached)." вопросов в тесте";
	////echo "<pre>"; print_r($array_test_attached); echo "</pre>";
}

require_once _DATA_PATH_."bottom.php";
?>