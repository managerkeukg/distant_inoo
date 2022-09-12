<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("modules_activate");

echo "<h4>Активировать/Деактировать модули</h4>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."module_start");
$datagrid-> table_field_caption("id", "Номер");

$datagrid-> user_module_permissions = user_access_module ("modules_activate");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>