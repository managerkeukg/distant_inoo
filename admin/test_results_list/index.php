<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("tests"); 

echo "<h2>Тесты</h2>";

include _FUNCTIONS_PATH_."f_test_isused.php"; 

$datagrid= new DataTable; 
$datagrid-> url="?";// not 
$datagrid-> id_user="1"; // not 
//$datagrid-> status_field="status"; //obligatory if 
//$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."test_users"); 
$datagrid-> table_field_caption("id", "Номер");

$datagrid-> user_module_permissions = user_access_module ("tests"); 

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>