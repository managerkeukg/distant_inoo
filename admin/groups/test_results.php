<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableHtml.php"; 

user_access_module ("groups");

is_int_obligatory ($_GET['student']);
$student=$_GET['student'];
?>
<a href="index.php">Назад</a><br>
<h4>Результаты теста(ов) студента <?php ;?></h4>
<?php
$object_student_test= new TableQuery;
$object_student_test->order_by_field="id";
$array_student_test=$object_student_test-> query ("SELECT `id`, `discipline`, `year`, `user_id`, `mod`, `yes`, `no`, `browser`, `time`, `time_end`, `ip`,  `test_ended` FROM `"._TABLE_PREFIX_."test_users` WHERE `user_id`=".$student." ORDER BY `id` DESC " );
echo count($array_student_test)." записей";
////echo "<pre>"; print_r($array_student_test); echo "</pre>";


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
	"mod"=>"№ модуля",  "yes"=>"Прав.",  "no"=>"Не прав.",  "browser"=>"Браузер",  "time"=>"Время	старта",  "time_end"=>"Время окон- чания",
	"ip"=>"IP",  "test_ended"=>"Тест закон- чился" );
$object_table -> set_th_array ($headers);

$object_table->column_value_array_foreign ("discipline", $array_tests , array("name"));
$object_table -> set_data($array_student_test);
$object_table -> data_key_add ("test_details", "Под- роб- нее");
$object_table -> data_key_value ("test_details", "<a href=\"test_details.php?id={{id}}\" target=\"_blank\">=></a>");

$object_table->display ();


require_once _DATA_PATH_."bottom.php";
?>