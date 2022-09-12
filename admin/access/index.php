<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("access");

echo "<h2>Пользователи</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";
$datagrid-> status_field="status";

$datagrid-> query(_TABLE_PREFIX_._USER_PREFIX_);
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("role", "Роль");
$datagrid-> foreign_key ("role", _TABLE_PREFIX_._USER_PREFIX_."_access_roles", "name", "id");

$datagrid-> table_field_caption("name", "Имя");
$datagrid-> table_field_caption("surname", "Фамилия");
$datagrid-> table_field_caption("patronymic", "Отчество");
$datagrid-> table_field_caption("login", "Логин");
$datagrid-> table_field_caption("password", "Пароль");
$datagrid-> table_field_caption("edit", "");
$datagrid-> table_field_caption("delete", "");

$datagrid-> addcolumn("modules", "<a href=\"modules.php\">Модули</a>");
$datagrid-> table_field_caption("modules", "");
$datagrid-> column_value("modules", '<a href="modules.php?id={{id}}">Модули</a>');

$datagrid-> addcolumn("sub_modules", "<a href=\"sub_modules.php\">Под модули</a>");
$datagrid-> table_field_caption("sub_modules", "");
$datagrid-> column_value("sub_modules", '<a href="sub_modules.php?id={{id}}">Под модули</a>');

$datagrid-> user_module_permissions = user_access_module ("access");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>