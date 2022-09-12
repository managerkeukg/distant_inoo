<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("groups");

is_int_obligatory ($_GET['direction']);
$direction=$_GET['direction'];

echo "<h2>Группы Направления (Специальности)</h2>";

$datagrid= new DataTable;
$datagrid-> url="directions.php?direction=".$direction;// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."groups", " AND (`direction`=".$direction." ) ");
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
$datagrid-> column_value("group_messages", '<a href="group_messages.php?id={{id}}" target=\"_blank\">Объявления</a>');

$datagrid-> addcolumn("group_consult_shedule", "");
$datagrid-> table_field_caption("group_consult_shedule", "");
$datagrid-> column_value("group_consult_shedule", '<a href="group_consult_shedule.php?id={{id}}" target=\"_blank\">Расп <br>
консулт. <br> занятий </a>');

$datagrid-> addcolumn("gak_files", "");
$datagrid-> table_field_caption("gak_files", "");
$datagrid-> column_value("gak_files", '<a href="gak_files.php?id={{id}}" target=\"_blank\">ГАК</a>');


$datagrid-> addcolumn("members", "<a href=\"members.php\"></a>");
$datagrid-> table_field_caption("members", "");
$datagrid-> column_value("members", '<a href="members.php?id={{id}}" target=\"_blank\">Студенты</a>');

$datagrid-> addcolumn("group_disciplines", "<a href=\"group_disciplines.php\" target=\"_blank\"></a>");
$datagrid-> table_field_caption("group_disciplines", "");
$datagrid-> column_value("group_disciplines", '<a href="group_disciplines.php?id={{id}}" target=\"_blank\">Дис<br>цип<br>лины <br>при<br>крепить</a>');

$datagrid-> addcolumn("group_test_results", "<a href=\"group_disciplines.php\" target=\"_blank\"></a>");
$datagrid-> table_field_caption("group_test_results", "");
$datagrid-> column_value("group_test_results", '<a href="group_test_results.php?id={{id}}" target=\"_blank\">Результаты <br> тестов</a>');


$datagrid-> user_module_permissions = user_access_module ("groups");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>