<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("type_marital");

echo "<h2>Семейное положение</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."type_marital_status");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name", "Тип семейного положения");

$datagrid-> user_module_permissions = user_access_module ("type_marital");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>