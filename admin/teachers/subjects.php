<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("teachers");

is_int_obligatory ($_GET['teacher']);
$teacher=$_GET['teacher'];

echo "<h2>Предметы преподавателя</h2>";
echo "<a href=\"index.php\">Назад</a>";
$datagrid= new DataTable;
$datagrid-> url="subjects.php?teacher=".$teacher."";// not
//$datagrid-> id_user="1"; // not
///
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."teacher_bind_discipline", " AND (`teacher`=".$teacher." ) ");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("subject", "Название дисциплины");
$datagrid-> foreign_key ("subject", _TABLE_PREFIX_."disciplines", "name_ru_detailed", "id"); //_TABLE_PREFIX_.
$datagrid-> table_field_caption("teacher", "Преподаватель");
$datagrid-> foreign_key ("teacher", _TABLE_PREFIX_."teachers", "surname", "id");
$datagrid-> bind_field_with_parameter("teacher", $teacher);

$datagrid-> user_module_permissions = user_access_module ("teachers");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>