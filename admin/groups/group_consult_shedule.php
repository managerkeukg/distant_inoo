<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("groups");

is_int_obligatory ($_GET['id']);
$group=$_GET['id'];

echo "<h2>Расписания проведения консультационных занятий для Группы</h2>";
echo "<a href=\"index.php\">Назад</a>";
$datagrid= new DataTable;
$datagrid-> url="group_consult_shedule.php?id=".$group;// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."consult_shedule", " AND (`group`=".$group." ) ");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("group", "Группа");
$datagrid-> foreign_key ("group", _TABLE_PREFIX_."groups", "name", "id"); //
$datagrid-> bind_field_with_parameter("group", $group);

$datagrid-> table_field_caption("text", "Текст");
$datagrid-> column_hide_table("text");
$datagrid-> field_type("add", "text", "textarea");
$datagrid-> field_type("edit", "text", "textarea");
$datagrid-> ckeditor_replace ("add", "text");
$datagrid-> ckeditor_replace ("edit", "text");

$datagrid-> user_module_permissions = user_access_module ("groups");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>