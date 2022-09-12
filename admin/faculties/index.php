<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("departments");

echo "<h2>Факультеты:</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."departments");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name", "Название факультета");
$datagrid-> table_field_caption("institute", "Институт");
$datagrid-> foreign_key ("institute", _TABLE_PREFIX_."institutes", "name", "id");
$datagrid-> table_field_caption("semesters_count", "Кол-во <br> семестров");

$datagrid-> addcolumn ("specialities", "");
$datagrid-> table_field_caption("specialities", "Специальности");
$datagrid-> column_value("specialities", '<a href="specialities.php?dep={{id}}" >=> </a>');
$datagrid-> table_field_caption("start", "Начало");
$datagrid-> foreign_key ("start", _TABLE_PREFIX_."type_years", "start", "id");
$datagrid-> table_field_caption("end", "Конец");
$datagrid-> foreign_key ("end", _TABLE_PREFIX_."type_years", "end", "id");

$datagrid-> user_module_permissions = user_access_module ("departments");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>