<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("shedule_consult");

echo "<h2>Расписания проведения консультационных занятий для всех групп</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."consult_shedule_all");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("title", "Заголовок");

$datagrid-> field_type("add", "text", "textarea");
$datagrid-> ckeditor_replace ("add", "text");
$datagrid-> field_type("edit", "text", "textarea");
$datagrid-> ckeditor_replace ("edit", "text");
$datagrid-> column_hide_table("text");
$datagrid-> table_field_caption("text", "Текст");

$datagrid-> user_module_permissions = user_access_module ("shedule_consult");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>