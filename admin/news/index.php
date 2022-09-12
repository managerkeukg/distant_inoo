<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("news");

echo "<h2>Объявления</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> id_user="1"; // not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> user_field="id_user"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."news");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("title", "Заголовок");
$datagrid-> table_field_caption("short_title", "Краткий заголовок");
$datagrid-> table_field_caption("text", "Текст");
$datagrid-> column_hide_table("text");
$datagrid-> field_type("add", "text", "textarea"); 
$datagrid-> field_type("edit", "text", "textarea"); 
$datagrid-> ckeditor_replace ("add", "text"); 
$datagrid-> ckeditor_replace ("edit", "text");

$datagrid-> table_field_caption("image", "Рисунок");
$datagrid-> convertcolumn_toimage ("image", _UPLOADS_PATH_."images/news/", "50");

$datagrid-> table_field_caption("date", "Дата");

$datagrid-> user_module_permissions = user_access_module ("news");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>