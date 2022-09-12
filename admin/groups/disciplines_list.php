<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableHtml.php"; 

user_access_module ("groups");

is_int_obligatory ($_GET['student']);
$student=$_GET['student'];
echo "<h2>Дисциплины студента</h2>";
?>
<a href="index.php">Назад</a><br>
<?php
$object_student_discipline= new TableQuery;
$object_student_discipline->order_by_field="id";
$array_student_discipline=$object_student_discipline-> query ("SELECT `id`, `discipline` FROM `"._TABLE_PREFIX_."discipline_assignments` WHERE `userid`=".$student." ORDER BY `id` DESC " );
echo count($array_student_discipline)." записей";
////echo "<pre>"; print_r($array_student_discipline); echo "</pre>"; 

$object_disciplines= new TableQuery;
$object_disciplines->order_by_field="id";
$array_disciplines=$object_disciplines-> query ("SELECT `id`, `name_ru_detailed` FROM `"._TABLE_PREFIX_."disciplines`");
////echo "<pre>"; print_r($array_disciplines); echo "</pre>"; 

$object_table=new TableHtml5;
$object_table -> css_file = "css/html_table_blue.css";
$headers= array("id"=>"No записи", "discipline"=>"Дисциплина" );
$object_table -> set_th_array ($headers);
//
$object_table->column_value_array_foreign ("discipline", $array_disciplines , array("name_ru_detailed"));
$object_table -> set_data($array_student_discipline);
$object_table->display ();


require_once _DATA_PATH_."bottom.php";
?>