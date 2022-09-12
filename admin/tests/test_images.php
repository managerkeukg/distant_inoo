<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("tests");

is_int_obligatory ($_GET['question']);
$question=$_GET['question'];

echo "<h2>Рисунки теста</h2>";

$datagrid= new DataTable;
$datagrid-> url="test_images.php?question=".$question;// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."test_images", " AND (`key`=".$question." ) ");
$datagrid-> table_field_caption("id", "Номер записи");

$datagrid-> table_field_caption("key", "Вопрос теста");
//$datagrid-> foreign_key ("key", _TABLE_PREFIX_."test_questions", "question", "id"); //

//$datagrid-> table_field_caption("id_user", "Фамилия");
//$datagrid-> foreign_key ("id_user", _TABLE_PREFIX_."questions", "lastname", "id"); //
//$datagrid-> bind_field_with_parameter("id_user", $question);

$datagrid-> user_module_permissions = user_access_module ("tests");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>