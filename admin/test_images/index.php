<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("test_images"); 

echo "<h4>Рисунки теста</h4>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."test_images");
$datagrid-> table_field_caption("id", "Номер");

$datagrid-> table_field_caption("name", "Название рисунка");
$datagrid-> addcolumn("image_link", "");
$datagrid-> table_field_caption("image_link", "Ссылка на рисунок");
$datagrid-> column_value("image_link", 'http://distant.inoo.keu.kg/uploads/images/test/{{image}}');

$datagrid-> table_field_caption("image", "Рисунок");
$datagrid-> convertcolumn_toimage ("image", _UPLOADS_PATH_."images/test/", "50");


$datagrid-> user_module_permissions = user_access_module ("test_images"); 

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>