<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("subjects_year");

is_int_obligatory ($_GET['sem']);
$semestr=$_GET['sem'];
is_int_obligatory ($_GET['year']);
$year=$_GET['year'];

echo "<h4>Предметы</h4>";

$datagrid= new DataTable;
$datagrid-> url="subjects.php?sem=".$semestr."&year=".$year;// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."disciplines", " AND (`semester`=".$semestr." )  "); // AND (`year`=".$year." )
$datagrid-> table_field_caption("id", "N");
//$datagrid-> table_field_caption("year", "Год обуч.");
//$datagrid-> foreign_key ("year", _TABLE_PREFIX_."type_years", "start", "id");
$datagrid-> table_field_caption("name_ru", "Название предмета");
$datagrid-> table_field_caption("name_ru_detailed", "Подробное название предмета");
$datagrid-> table_field_caption("semester", "Семестр");
$datagrid-> foreign_key ("semester", _TABLE_PREFIX_."semesters", "name", "id");
$datagrid-> bind_field_with_parameter("semester", $semestr);
//$datagrid-> table_field_caption("about", "Описание");
//$datagrid-> foreign_key ("department", _TABLE_PREFIX_."departments", "name", "id");

$datagrid-> user_module_permissions = user_access_module ("subjects_year");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>