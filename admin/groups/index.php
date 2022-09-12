<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("groups");

echo "<h2>Группы</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."groups");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name", "Название");
///$datagrid-> table_field_caption("spec", "Специальность");
///$datagrid-> foreign_key ("spec", _TABLE_PREFIX_."specialities", "name", "id");

$datagrid-> table_field_caption("direction", "Специальность");
$datagrid-> foreign_key ("direction", _TABLE_PREFIX_."directions", "name_ru", "id");

$datagrid-> table_field_caption("year", "Год <BR> создания");
$datagrid-> foreign_key ("year", _TABLE_PREFIX_."type_years", "start", "id");

$datagrid-> addcolumn("group_messages", "");
$datagrid-> table_field_caption("group_messages", "");
$datagrid-> column_value("group_messages", '<a href="group_messages.php?id={{id}}">Объявления</a>');

$datagrid-> addcolumn("group_consult_shedule", "");
$datagrid-> table_field_caption("group_consult_shedule", "");
$datagrid-> column_value("group_consult_shedule", '<a href="group_consult_shedule.php?id={{id}}">Расп <br>
консулт. <br> занятий </a>');

$datagrid-> addcolumn("gak_files", "");
$datagrid-> table_field_caption("gak_files", "");
$datagrid-> column_value("gak_files", '<a href="gak_files.php?id={{id}}">ГАК</a>');


$datagrid-> addcolumn("members", "<a href=\"members.php\"></a>");
$datagrid-> table_field_caption("members", "");
$datagrid-> column_value("members", '<a href="members.php?id={{id}}">Студенты</a>');

$datagrid-> addcolumn("group_disciplines", "<a href=\"group_disciplines.php\"></a>");
$datagrid-> table_field_caption("group_disciplines", "");
$datagrid-> column_value("group_disciplines", '<a href="group_disciplines.php?id={{id}}">Дисциплины прикрепить</a>');


$datagrid-> user_module_permissions = user_access_module ("groups");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>