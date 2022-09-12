<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("type_module");

echo "<h2>Модули</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."type_modules");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("title_ru", "Заголовок");
$datagrid-> table_field_caption("name_ru", "Модуль");
$datagrid-> table_field_caption("n_questions", "Количество вопросов");
$datagrid-> table_field_caption("points", "Балл(ов)");

$datagrid-> user_module_permissions = user_access_module ("type_module");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>