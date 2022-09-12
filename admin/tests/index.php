<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("tests"); 

echo "<h2>Тесты</h2>";

include _FUNCTIONS_PATH_."f_test_isused.php"; 

$datagrid= new DataTable; 
$datagrid-> url="?";// not 
$datagrid-> id_user="1"; // not 
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."tests"); 

$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name", "Название");
$datagrid-> table_field_caption("short_name", "Короткое название");

$datagrid-> addcolumn ("attached", ""); 
$datagrid-> table_field_caption("attached", "При<BR>креп<BR>лены"); 
$datagrid-> column_value("attached", "<a href=\"test_attached.php?test={{id}}\" target=\"blank\">=></a>" );

$datagrid-> addcolumn ("count", ""); 
$datagrid-> table_field_caption("count", "Кол-во вопросов"); 
$datagrid-> column_value("count", "<a href=\"questions_number.php?test={{id}}\" target=\"blank\">=></a>" );

$datagrid-> addcolumn ("errors", ""); 
$datagrid-> table_field_caption("errors", "Ошибки"); 
$datagrid-> column_value("errors", "<a href=\"errors.php?test={{id}}\" target=\"blank\">=></a>" );

$datagrid-> addcolumn ("questions", ""); 
$datagrid-> table_field_caption("questions", "Вопросы"); 
$datagrid-> column_value("questions", "<a href=\"questions.php?test={{id}}\" target=\"blank\">=></a>" );

//$datagrid-> column_value_function("attached", "test_isused({{id}})" );

$datagrid-> user_module_permissions = user_access_module ("tests");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>