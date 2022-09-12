<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("departments");

echo "<h2>Кафедры:</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> status_field="status"; 

$datagrid-> query(_TABLE_PREFIX_."departments");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name", "Название");
$datagrid-> table_field_caption("head", "Заведующий кафедрой");
$datagrid-> table_field_caption("laborant", "Старший лаборант");
$datagrid-> table_field_caption("email", "email");
$datagrid-> table_field_caption("office", "Кабинет");
$datagrid-> table_field_caption("telephone", "Тел");

$datagrid-> user_module_permissions = user_access_module ("departments");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>