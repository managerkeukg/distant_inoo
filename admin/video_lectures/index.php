<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("video_lectures");

echo "<h2>Видеолекции</h2>";

$datagrid= new DataTable; 
$datagrid-> url="?";// not 
$datagrid-> id_user="1"; // not 
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."video_lectures"); 

$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name", "Название");
$datagrid-> table_field_caption("youtube", "Идентификатор ютюб");

$datagrid-> user_module_permissions = user_access_module ("video_lectures");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>