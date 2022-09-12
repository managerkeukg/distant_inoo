<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("access_modules");

is_int_obligatory ($_GET['module']);
$module=$_GET['module'];

echo "<h2>Подмодули модуля</h2>";

$datagrid= new DataTable;
$datagrid-> url="sub_modules.php?module=".$module;// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_._USER_PREFIX_."_access_modules_sub", " AND (`module`=".$module." ) ");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("module", "Дата аукциона");
$datagrid-> foreign_key ("module", _TABLE_PREFIX_._USER_PREFIX_."_access_modules", "name", "id"); //
$datagrid-> bind_field_with_parameter("module", $module);

$datagrid-> table_field_caption("name", "Название подмодуля");

$datagrid-> user_module_permissions = user_access_module ("access_modules");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>