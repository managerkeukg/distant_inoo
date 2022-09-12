<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("teachers");

echo "<h2>Преподаватели</h2>";

$datagrid= new DataTable; 
$datagrid-> url="?";// not 
$datagrid-> id_user="1"; // not 
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."teachers"); 

$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("login", "Логин");
$datagrid-> table_field_caption("password", "Пароль");
$datagrid-> table_field_caption("department", "Кафедра");
$datagrid-> foreign_key ("department", ""._TABLE_PREFIX_."departments", "name", "id");

$datagrid-> table_field_caption("name", "Имя");
$datagrid-> table_field_caption("father_name", "Отчество");
$datagrid-> table_field_caption("surname", "Фамилия");

$datagrid-> addcolumn ("subjects", ""); 
$datagrid-> table_field_caption("subjects", "Дисциплины"); 
$datagrid-> column_value("subjects", "<a href=\"subjects.php?teacher={{id}}\">=></a>" );

$datagrid-> addcolumn ("authorise", ""); 
$datagrid-> table_field_caption("authorise", "Войти"); 
$datagrid-> column_value("authorise", "<a href=\"authorise.php?log={{login}}&pass={{password}}\" target=\"blank\">=></a>" );

$datagrid-> user_module_permissions = user_access_module ("teachers");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>