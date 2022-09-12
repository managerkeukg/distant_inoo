<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("webinar");

echo "<h2>Вебинар</h2>";

$datagrid= new DataTable; 
$datagrid-> url="?";// not 
$datagrid-> id_user="1"; // not 
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."webinar"); 

$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("theme", "Тема");
$datagrid-> table_field_caption("text", "Текст");
$datagrid-> table_field_caption("type", "Тип");
$datagrid-> addcolumn ("webinar_files", "");
$datagrid-> table_field_caption("webinar_files", "Файлы");
$datagrid-> column_value("webinar_files", '<a href="webinar_files.php?web={{id}}" >=> </a>');

$datagrid-> user_module_permissions = user_access_module ("webinar");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>