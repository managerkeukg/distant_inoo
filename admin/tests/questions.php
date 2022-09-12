<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("tests"); 

is_int_obligatory ($_GET['test']);
$test=$_GET['test'];

echo "<h2>Вопросы теста</h2>";
echo "<a href=\"index.php\">Назад</a>";
$datagrid= new DataTable;
$datagrid-> url="questions.php?test=$test";// not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."test_questions", " AND (`discipline`=".$test." ) ");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("discipline", "Название теста");
$datagrid-> foreign_key ("discipline", _TABLE_PREFIX_."tests", "name", "id");
$datagrid-> bind_field_with_parameter("discipline", $test);

$datagrid-> table_field_caption("question", "Вопрос");
$datagrid-> column_hide_table("question");
$datagrid-> field_type("add", "question", "textarea");
$datagrid-> field_type("edit", "question", "textarea");
$datagrid-> ckeditor_replace ("add", "question");
$datagrid-> ckeditor_replace ("edit", "question");

$datagrid-> table_field_caption("answer1", "Ответ 1");
$datagrid-> column_hide_table("answer1");
$datagrid-> field_type("add", "answer1", "textarea");
$datagrid-> field_type("edit", "answer1", "textarea");
$datagrid-> ckeditor_replace ("add", "answer1");
$datagrid-> ckeditor_replace ("edit", "answer1");

$datagrid-> table_field_caption("answer2", "Ответ 2");
$datagrid-> column_hide_table("answer2");
$datagrid-> field_type("add", "answer2", "textarea");
$datagrid-> field_type("edit", "answer2", "textarea");
$datagrid-> ckeditor_replace ("add", "answer2");
$datagrid-> ckeditor_replace ("edit", "answer2");

$datagrid-> table_field_caption("answer3", "Ответ 3");
$datagrid-> column_hide_table("answer3");
$datagrid-> field_type("add", "answer3", "textarea");
$datagrid-> field_type("edit", "answer3", "textarea");
$datagrid-> ckeditor_replace ("add", "answer3");
$datagrid-> ckeditor_replace ("edit", "answer3");

$datagrid-> table_field_caption("answer4", "Ответ 4");
$datagrid-> column_hide_table("answer4");
$datagrid-> field_type("add", "answer4", "textarea");
$datagrid-> field_type("edit", "answer4", "textarea");
$datagrid-> ckeditor_replace ("add", "answer4");
$datagrid-> ckeditor_replace ("edit", "answer4");

$datagrid-> table_field_caption("answer5", "Ответ 5");
$datagrid-> column_hide_table("answer5");
$datagrid-> field_type("add", "answer5", "textarea");
$datagrid-> field_type("edit", "answer5", "textarea");
$datagrid-> ckeditor_replace ("add", "answer5");
$datagrid-> ckeditor_replace ("edit", "answer5");

$datagrid-> table_field_caption("correct", "Правильный ответ");
$datagrid-> foreign_key ("correct", _TABLE_PREFIX_."test_type_answers", "name_ru", "id");

$datagrid-> user_module_permissions = user_access_module ("tests"); 

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>