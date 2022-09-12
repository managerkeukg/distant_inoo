<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableHtml.php"; 

user_access_module ("groups");; 

is_int_obligatory ($_GET['id']);
$id=$_GET['id'];
?>
<a href="index.php">Назад</a><br>
<h4>Результаты теста <?php ;?></h4>
<?php
$query = "SELECT * FROM `"._TABLE_PREFIX_."test_users` WHERE `id`=".$id." ORDER BY `id` DESC;";
$object_test_users = new TableQuery;
$object_test_users -> order_by_field="id";
$array_test_users = $object_test_users-> query ($query);
if (isset($array_test_users) AND !empty($array_test_users) AND is_array($array_test_users))
{
	////echo "<pre> test_users count "; print_r(count($array_test_users)); echo "</pre>";
	////echo "<pre> test_users "; print_r($array_test_users); echo "</pre>";
	$array_answer = array ();
	foreach ($array_test_users as $value) {
		$array_answer = unserialize ($value['answers']);
	}
	
}

$object_student_test= new TableQuery;
$object_student_test->order_by_field="id";
$array_student_test=$object_student_test-> query ("SELECT `id`, `discipline`, `year`, `user_id`, `mod`, `questions`, `yes`, `no`, `browser`, `time`, `time_end`, `ip`,  `test_ended` FROM `"._TABLE_PREFIX_."test_users` WHERE `id`=".$id." ORDER BY `id` DESC " );
echo count($array_student_test)." записей";
//// echo "<pre>"; print_r($array_student_test); echo "</pre>";


$object_disciplines= new TableQuery;
$object_disciplines->order_by_field="id";
$array_disciplines=$object_disciplines-> query ("SELECT `id`, `name_ru_detailed` FROM `"._TABLE_PREFIX_."disciplines`");

$object_tests= new TableQuery;
$object_tests->order_by_field="id";
$array_tests=$object_tests-> query ("SELECT `id`, `name` FROM `"._TABLE_PREFIX_."tests`");


$object_table=new TableHtml5;
$object_table -> css_file = "css/html_table_blue.css";
//
$headers= array("id"=>"Номер записи", "discipline"=>"Название теста", "year"=>"Год", "user_id"=>"Ф.И.О студента",  
	"mod"=>"№ модуля",  "questions"=>"Вопросы",  "yes"=>"Прав.",  "no"=>"Не прав.",  "browser"=>"Браузер",  "time"=>"Время	старта",  "time_end"=>"Время окон- чания",
	"ip"=>"IP",  "test_ended"=>"Тест закон- чился" );
$object_table -> set_th_array ($headers);

$object_table->column_value_array_foreign ("discipline", $array_tests , array("name"));
$object_table -> set_data($array_student_test);

$object_table->display ();

//// echo "<pre> questions as text "; print_r($array_student_test[$id]['questions']); echo "</pre>";
$array_questions = unserialize ($array_student_test[$id]['questions']);
////echo "<pre> questions "; print_r($array_questions); echo "</pre>";
$i="0";
foreach ($array_questions as $key => $question) 
{
	if (!empty($question))
	{	
		echo "<hr> Question id ".$question;
        $query = "SELECT * FROM `"._TABLE_PREFIX_."test_questions` where `id`=".$question."    AND (`status`='1') ORDER BY `id` DESC";
		$object_test_questions = new TableQuery;
		$object_test_questions -> order_by_field="id";
		$array_test_questions = $object_test_questions->query ($query);
		if (isset($array_test_questions) AND !empty($array_test_questions) AND is_array($array_test_questions))
		{
			////echo "<pre> test_questions count "; print_r(count($array_test_questions)); echo "</pre>";
			////echo "<pre> test_questions "; print_r($array_test_questions); echo "</pre>";
			require "test_details_help.php";
		}
        else {
			echo "no such a question";
		}
	 }
}
require_once _DATA_PATH_."bottom.php";
?>