<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("access_roles");

echo "<h2>Роли</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";
$datagrid-> id_user="1";
$datagrid-> status_field="status";
$datagrid-> user_field="id_user";

$datagrid-> query(_TABLE_PREFIX_._USER_PREFIX_."_access_roles");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("name", "Название роли");

$datagrid-> addcolumn("modules", "<a href=\"modules.php\">Модули</a>");
$datagrid-> table_field_caption("modules", "Модули");
$datagrid-> column_value("modules", '<a href="modules.php?id={{id}}">Модули</a>');

$datagrid-> user_module_permissions = user_access_module ("access_roles");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>