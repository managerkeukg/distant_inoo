<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("edu_plans");

echo "<h2>Учебные планы</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."edu_plans");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name", "Название");
$datagrid-> table_field_caption("year", "Учебный Год");
$datagrid-> foreign_key ("year", _TABLE_PREFIX_."type_years", "name", "id");

$datagrid-> table_field_caption("department", "Факультет");
$datagrid-> foreign_key ("department", _TABLE_PREFIX_."departments", "name", "id");

$datagrid-> table_field_caption("discipline", "Предмет");
$datagrid-> table_field_caption("semestr", "Семестр");

$datagrid-> user_module_permissions = user_access_module ("edu_plans");

$datagrid-> display("table");
require_once _DATA_PATH_."bottom.php";
?>