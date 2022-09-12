<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

$user_module_access = user_access_module ("base_edu");

echo "<h2>Обучение на базе</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> status_field="status"; //obligatory if

$datagrid-> query(_TABLE_PREFIX_."base_edu");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name_ru", "Название");

$datagrid-> addcolumn("directions", "");
$datagrid-> table_field_caption("directions", "Направления");
$datagrid-> column_value("directions", '<a href="directions.php?base_edu={{id}}">=></a>');

$datagrid-> user_module_permissions = user_access_module ("base_edu");

$datagrid-> display("table");
require_once _DATA_PATH_."bottom.php";
?>