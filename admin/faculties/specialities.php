<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("departments");

is_int_obligatory ($_GET['dep']);
$dep=$_GET['dep'];

require_once _FUNCTIONS_PATH_."f_get_department.php";
$department_array = department_array($dep);

echo "<h4>Факультет:".$department_array['name']."</h4>";
echo "<h4>Специальности</h4>";
echo "<a href=\"index.php\">Назад</a>";
$datagrid= new DataTable;
$datagrid-> url="specialities.php?dep=".$dep ;// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."specialities", " AND (`department`=".$dep." ) "); // 
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name", "Специальность");
$datagrid-> table_field_caption("department", "Факультет");
$datagrid-> foreign_key ("department", _TABLE_PREFIX_."departments", "name", "id");
$datagrid-> table_field_caption("start", "Начало");
$datagrid-> foreign_key ("start", _TABLE_PREFIX_."type_years", "start", "id");
$datagrid-> table_field_caption("end", "Конец");
$datagrid-> foreign_key ("end", _TABLE_PREFIX_."type_years", "end", "id");

$datagrid-> addcolumn ("years", "");
$datagrid-> table_field_caption("years", "колво семестров");
$datagrid-> column_value("years", $department_array['semesters_count']);

$datagrid-> addcolumn ("create_semesters", "");
$datagrid-> table_field_caption("create_semesters", "создать семестры");
$datagrid-> column_value("create_semesters", '<a href="create_semesters.php?spec={{id}}&dep='.$dep.'" >=> </a>');

$datagrid-> addcolumn ("semesters", "");
$datagrid-> table_field_caption("semesters", "Семестры");
$datagrid-> column_value("semesters", '<a href="semesters.php?spec={{id}}&dep='.$dep.'" >=> </a>');

$datagrid-> addcolumn ("groups", "");
$datagrid-> table_field_caption("groups", "Группы");
$datagrid-> column_value("groups", '<a href="groups.php?spec={{id}}&dep='.$dep.'" >=> </a>');



$datagrid-> user_module_permissions =  user_access_module ("departments");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>