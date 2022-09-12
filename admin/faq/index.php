<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("faq");

echo "<h2>Вопрос Ответ</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."questions");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("question", "Вопрос");
$datagrid-> table_field_caption("answer", "Ответ");

$datagrid-> user_module_permissions = user_access_module ("faq");;

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>