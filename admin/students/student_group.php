<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("students");

is_int_obligatory ($_GET['student']);
$student=$_GET['student'];

echo "<h2>Группа Студента</h2>";

$datagrid= new DataTable;
$datagrid-> url="student_group.php?student=".$student;// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."group_members", " AND (`id_user`=".$student." ) ");
$datagrid-> table_field_caption("id", "Номер записи");

$datagrid-> table_field_caption("group", "Группа");
$datagrid-> foreign_key ("group", _TABLE_PREFIX_."groups", "name", "id"); //

$datagrid-> table_field_caption("id_user", "Фамилия");
$datagrid-> foreign_key ("id_user", _TABLE_PREFIX_."students", "lastname", "id"); //
$datagrid-> bind_field_with_parameter("id_user", $student);

$datagrid-> user_module_permissions = user_access_module ("students");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>