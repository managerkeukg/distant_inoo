<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("admin_blocks");

echo "<h4>Блоки</h4>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> status_field="status"; //obligatory if

$datagrid-> query(_TABLE_PREFIX_."admin_blocks");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("order", "Порядок");
$datagrid-> table_field_caption("name", "Название");

$datagrid-> user_module_permissions = user_access_module ("admin_blocks");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>