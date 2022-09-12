<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("years");

echo "<h2>Учебные года</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."type_years");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name", "Название учебного года");
$datagrid-> table_field_caption("start", "Начало");
$datagrid-> table_field_caption("end", "Конец");

$datagrid-> user_module_permissions = user_access_module ("years");

$datagrid-> display("table");
require_once _DATA_PATH_."bottom.php";
?>