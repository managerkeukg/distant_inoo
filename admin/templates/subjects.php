<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("templates");

is_int_obligatory ($_GET['sem']);
$semestr=$_GET['sem'];

echo "<h4>Предметы</h4>";

$datagrid= new DataTable;
$datagrid-> url="subjects.php?sem=".$semestr ;// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."subjects_template", " AND (`semester`=".$semestr." ) "); // 
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name", "Название предмета");
$datagrid-> table_field_caption("semester", "Семестр");
$datagrid-> table_field_caption("about", "Описание");
//$datagrid-> foreign_key ("department", _TABLE_PREFIX_."departments", "name", "id");

$datagrid-> user_module_permissions = user_access_module ("templates");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>