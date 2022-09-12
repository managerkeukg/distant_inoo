<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php";
 
user_access_module ("disciplines");

echo "<h2>Предметы</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> status_field="status"; //obligatory if

$datagrid-> query(_TABLE_PREFIX_."disciplines");
$datagrid-> table_field_caption("id", "Номер");
//$datagrid-> table_field_caption("name", "Название");
//$datagrid-> table_field_caption("description", "Описание");
//$datagrid-> table_field_caption("code", "Код/Шифр");

$datagrid-> user_module_permissions = user_access_module ("disciplines");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>