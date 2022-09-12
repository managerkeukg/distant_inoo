<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("staff");

echo "<h2>Кадры</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."staff");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("duty", "Должность");
$datagrid-> table_field_caption("degree", "Учёная степень");
$datagrid-> table_field_caption("name", "Имя");
$datagrid-> table_field_caption("surname", "Фамилия");
$datagrid-> table_field_caption("patronymic", "Отчество");

$datagrid-> table_field_caption("photo", "Рисунок");
$datagrid-> convertcolumn_toimage ("photo", _UPLOADS_PATH_."images/staff/", "50");

$datagrid-> user_module_permissions = user_access_module ("staff");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>