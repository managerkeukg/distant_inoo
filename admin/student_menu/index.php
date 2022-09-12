<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("student_menu");

echo "<h2>Меню студента</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."student_menu");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("order", "Порядок");
$datagrid-> table_field_caption("link", "Ссылка");
$datagrid-> table_field_caption("link_outer", "Внешняя ссылка");
$datagrid-> table_field_caption("name_ru", "Текст");
$datagrid-> table_field_caption("name_kg", "Кыргызча текст");

$datagrid-> table_field_caption("image", "Рисунок");
$datagrid-> convertcolumn_toimage ("image", _UPLOADS_PATH_."images/student_menu/", "50");

$datagrid-> user_module_permissions = user_access_module ("student_menu");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>