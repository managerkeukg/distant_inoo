<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("students");

echo "<h2>Студенты</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> status_field="status"; //obligatory if 
$datagrid-> records_per_page_name = "rpp";

$datagrid-> query(_TABLE_PREFIX_."students");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("username", "Логин");
$datagrid-> table_field_caption("password", "Пароль");
$datagrid-> table_field_caption("firstname", "Имя");
$datagrid-> table_field_caption("lastname", "Фамилия");
$datagrid-> table_field_caption("patronymic", "Отчество");
$datagrid-> table_field_caption("birthdate", "Дата рождения");
$datagrid-> table_field_caption("birthplace", "Место рождения");
$datagrid-> table_field_caption("maritalstatus", "Семейное положение");
$datagrid-> foreign_key ("maritalstatus", _TABLE_PREFIX_."type_marital_status", "name", "id");
$datagrid-> table_field_caption("jobplace", "Место работы");
$datagrid-> table_field_caption("email", "email");
$datagrid-> table_field_caption("inn", "ИНН");
$datagrid-> table_field_caption("address", "Адрес");
$datagrid-> table_field_caption("mobile", "Мобильный");
$datagrid-> table_field_caption("passport", "Паспортные данные");
$datagrid-> table_field_caption("image", "Фото");
$datagrid-> convertcolumn_toimage ("image", _UPLOADS_PATH_."students/photos/", "50");

$datagrid-> field_type("add", "address", "textarea");
//$datagrid-> ckeditor_replace ("add", "address");
$datagrid-> field_type("edit", "address", "textarea");
//$datagrid-> ckeditor_replace ("edit", "address");

$datagrid-> field_type("add", "passport", "textarea");
$datagrid-> field_type("edit", "passport", "textarea");

$datagrid-> field_type("edit", "requirements", "textarea");
$datagrid-> ckeditor_replace ("edit", "requirements");

$datagrid-> addcolumn("group", "");
$datagrid-> table_field_caption("group", "Группа");
$datagrid-> column_value("group", '<a href="student_group.php?student={{id}}" target="_blank">=></a> ');

/*
$datagrid-> addcolumn("group_add", "");
$datagrid-> table_field_caption("group_add", "Группа");
$datagrid-> column_value("group_add", '<a href="student_group_history.php">История</a> ');
*/

$datagrid-> user_module_permissions = user_access_module ("students");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>