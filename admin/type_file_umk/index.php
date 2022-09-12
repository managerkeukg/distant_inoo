<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("type_file_umk"); 

echo "<h2>Тип файлов УМК</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."type_file_umk");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name_ru", "Название");

$datagrid-> user_module_permissions = user_access_module ("type_file_umk");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>