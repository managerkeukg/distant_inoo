<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("webinar");

is_int_obligatory ($_GET['web']);
$web=$_GET['web'];

echo "<h2>Файлы вебинара</h2>";
echo "<DIV><a href=\"index.php\">Назад</a></DIV>";

$datagrid= new DataTable; 
$datagrid-> url="webinar_files.php?web=".$web; // not 
$datagrid-> id_user="1"; // not 
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."webinar_files", " AND (`webinar`=".$web." ) "); 

$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("webinar", "Вебинар номер");
$datagrid-> foreign_key ("webinar", _TABLE_PREFIX_."webinar", "theme", "id");
$datagrid-> table_field_caption("ext", "Расширение файла");
$datagrid-> table_field_caption("part", "Часть");

$datagrid-> user_module_permissions = user_access_module ("webinar");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>