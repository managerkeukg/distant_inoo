<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("type_points");

echo "<h2>Итоговая оценка</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."type_points");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("from", "Оценка от");
$datagrid-> table_field_caption("till", "Оценка до");
$datagrid-> table_field_caption("name_ru", "Название");
$datagrid-> table_field_caption("name_ru_short", "Краткое название ");

$datagrid-> user_module_permissions = user_access_module ("type_points");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>