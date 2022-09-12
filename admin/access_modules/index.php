<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("access_modules");

echo "<h2>Модули</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";
$datagrid-> status_field="status";

$datagrid-> query(_TABLE_PREFIX_._USER_PREFIX_."_access_modules");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("order", "Порядок");
$datagrid-> table_field_caption("name", "Модуль");
$datagrid-> table_field_caption("blocks", "Блок");
$datagrid-> foreign_key ("blocks", _TABLE_PREFIX_."admin_blocks", "name", "id");

$datagrid-> addcolumn("sub_modules", "<a href=\"sub_modules.php\"> Подмодули модуля</a>");
$datagrid-> table_field_caption("sub_modules", " Подмодули модуля");
$datagrid-> column_value("sub_modules", '<a href="sub_modules.php?module={{id}}">=></a>');

$datagrid-> user_module_permissions = user_access_module ("access_modules");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>