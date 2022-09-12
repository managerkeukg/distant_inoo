<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _FUNCTIONS_PATH_."f_test_name.php";
require_once _COMMON_DATA_PATH_."functions/f_is_int.php";

is_int_obligatory ($_GET['mod']);
$mod = $_GET['mod'];

if (isset($_GET['session'])) {is_obligatory ($_GET['session']);} 
else { 
	exit("Недопустимый формат URL-запроса. Хакерство преследуется законом"); 
}
if (strlen(trim($_GET['session']))!=30) { 
	exit("Недопустимый формат URL-запроса. Хакерство преследуется законом");
}

$session=htmlspecialchars($_GET['session']);
if (isset($_POST['question'])) {$question=htmlspecialchars($_POST['question']);}

$object_type_modules = new TableQuery;
$object_type_modules -> order_by_field="id";
$array_type_modules = $object_type_modules -> query ("SELECT * FROM `"._TABLE_PREFIX_."type_modules` WHERE `status`='1';" ); // 
////echo count($array_type_modules)." записей";
////echo "<pre>type_modules "; print_r($array_type_modules); echo "</pre>"; 
$test_questions_number = $array_type_modules[$mod]['n_questions']; 
echo "Название теста - ".$array_type_modules[$mod]['name_ru'];

// gettins questions of the test
$is_test_ended="0";
$query="SELECT * FROM `"._TABLE_PREFIX_."test_users` where `session`='".$session."'";
$object_test_users = new TableQuery;
$object_test_users -> order_by_field="id";
$array_test_users = $object_test_users->query ($query);
if (isset($array_test_users) AND !empty($array_test_users) AND is_array($array_test_users))
{
	////echo "<pre> test_users count "; print_r(count($array_test_users)); echo "</pre>";
	////echo "<pre> test_users "; print_r($array_test_users); echo "</pre>";
	$array_questions_unserialized = array ();
	foreach ($array_test_users as $value) {
		$array_questions_unserialized = unserialize ($value['questions']);
		$discipline = $value['discipline'];
		$is_test_ended = $value['test_ended'];
	}
	////	echo "<pre> array_questions_unserialized "; print_r($array_questions_unserialized); echo "</pre>";
	
}

//end getting questions of the test
if ($is_test_ended==1) 
{
	echo "<h1>Тест уже закончился. Вы не сможете изменить данные.</h1>";
} else 
{ 
	?>
	<br><br>
	<p style="color:green;"><?php $testname=identify_test_name($discipline); echo $testname; ?></p>
	<br><br>
	<?php
	///echo "<pre>"; print_r($array_questions_unserialized); echo "</pre>";
	$array_test_questions = array ();
	foreach ($array_questions_unserialized as $question)
	{  
		$query = "SELECT * FROM `"._TABLE_PREFIX_."test_questions` where `id`=".$question."    AND (`status`='1') ORDER BY `id` DESC;";
		$object_test_questions = new TableQuery;
		$object_test_questions -> order_by_field="id";
		$array_test_questions[$question] = $object_test_questions->query ($query);
	}
	if (isset($array_test_questions) AND !empty($array_test_questions) AND is_array($array_test_questions))
	{
		////echo "<pre> test_questions count "; print_r(count($array_test_questions)); echo "</pre>";
		////echo "<pre> test_questions "; print_r($array_test_questions); echo "</pre>";
		////
		require_once "test_end_help.php"; //displays test
	}
} //test is ended

require_once _DATA_PATH_."bottom.php";
?>