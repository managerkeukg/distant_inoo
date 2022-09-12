<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("test_bind");

is_int_obligatory ($_GET['subject']);
$subject=$_GET['subject'];
is_int_obligatory ($_GET['mod']);
$mod=$_GET['mod'];

echo "<h1>Прикрепить тест к предмету</h1>";
?>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/remove_div.js"></script>
<?php
$datagrid= new DataTable;
$datagrid-> url="?subject=".$subject."&mod=".$mod."";// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."test");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name", "Название теста");
$datagrid-> table_field_caption("short_name", "Подробное описание");

$datagrid-> addcolumn ("select", ""); 
$datagrid-> table_field_caption("select", "Привязать"); 
$datagrid-> column_value("select", "<a href=\"bind_test.php?subject=".$subject."&mod=".$mod."&test={{id}}\">Привязать</a>" );

$datagrid-> user_module_permissions = user_access_module ("test_bind");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>