<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("results_list");

echo "<h2>Результаты Список</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not

$datagrid-> query(_TABLE_PREFIX_."test_users");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("discipline", "Дисциплина");
$datagrid-> foreign_key ("discipline", _TABLE_PREFIX_."disciplines", "name_ru", "id");

$datagrid-> table_field_caption("year", "Учебный год");
$datagrid-> foreign_key ("year", _TABLE_PREFIX_."type_years", "name", "id");

$datagrid-> table_field_caption("user_id", "Ф.И.О студента");
$datagrid-> column_value("user_id", '<a href="students_test.php?id={{user_id}}" target=\"_blank\">=></a>');
//$datagrid-> foreign_key ("user_id", _TABLE_PREFIX_."students", "lastname", "id");

$datagrid-> table_field_caption("mod", "Модуль");
$datagrid-> table_field_caption("questions", "Вопросы теста");
$datagrid-> table_field_caption("yes", "Прав. ответов");
$datagrid-> table_field_caption("no", "Неправ. ответов");
$datagrid-> table_field_caption("session", "Сессия");
$datagrid-> table_field_caption("browser", "Браузер");
$datagrid-> table_field_caption("time", "Время старта");
$datagrid-> table_field_caption("time_end", "Время окончания");
$datagrid-> table_field_caption("ip", "Ай пи");
$datagrid-> column_value("ip", '<a href="ip.php?id={{id}}">{{ip}}</a>');

$datagrid-> table_field_caption("test_ended", "Тест окончен");
///$datagrid-> table_field_caption("spec", "Специальность");
///$datagrid-> foreign_key ("spec", _TABLE_PREFIX_."specialities", "name", "id");

$datagrid-> user_module_permissions = array ("2" => "2"); // 1=all 2 = view 3=hide/show 4=add 5=edit 6=delete

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>