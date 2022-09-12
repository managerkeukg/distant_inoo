<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("departments");

is_int_obligatory ($_GET['spec']);
is_int_obligatory ($_GET['dep']);
$spec=$_GET['spec'];
$dep=$_GET['dep'];

require_once _FUNCTIONS_PATH_."ft_specialities.php";
$speciality_array = get_speciality($spec);
echo "<h4>Специальность:".$speciality_array['name']."</h4>";
echo "<h4>Группы</h4>";
echo "<a href=\"specialities.php?dep=".$dep."\">Назад</a><br><br>";
$datagrid= new DataTable;
$datagrid-> url="groups.php?spec=".$spec."&dep=".$dep ;// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."groups", " AND (`spec`=".$spec." ) "); // 
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name", "Семестр");
$datagrid-> table_field_caption("spec", "Специальность");
$datagrid-> foreign_key ("spec", _TABLE_PREFIX_."specialities", "name", "id");

$datagrid-> table_field_caption("year", "Год образования <BR>группы");
$datagrid-> foreign_key ("year", _TABLE_PREFIX_."type_years", "start", "id");

$datagrid-> addcolumn ("students", "");
$datagrid-> table_field_caption("students", "Студенты группы");
$datagrid-> column_value("students", '<a href="students.php?group={{id}}&dep='.$dep.'&spec='.$spec.'" >=> </a>');


$datagrid-> user_module_permissions = user_access_module ("departments");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>