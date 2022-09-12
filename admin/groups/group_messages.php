<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("groups");

is_int_obligatory ($_GET['id']);
$group=$_GET['id'];

echo "<h2>Объявления группе</h2>";
echo "<a href=\"index.php\">Назад</a>";
$datagrid= new DataTable;
$datagrid-> url="group_messages.php?id=".$group;// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."group_messages", " AND (`group`=".$group." ) ");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("group", "Группа");
$datagrid-> foreign_key ("group", _TABLE_PREFIX_."groups", "name", "id"); //
$datagrid-> bind_field_with_parameter("group", $group);

$datagrid-> table_field_caption("title", "Заголовок");
$datagrid-> table_field_caption("message", "Текст объявления");
$datagrid-> column_hide_table("message");
$datagrid-> field_type("add", "message", "textarea"); 
$datagrid-> field_type("edit", "message", "textarea"); 
$datagrid-> ckeditor_replace ("add", "message"); 
$datagrid-> ckeditor_replace ("edit", "message");

$datagrid-> table_field_caption("date", "Дата");

$datagrid-> user_module_permissions = user_access_module ("groups");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>