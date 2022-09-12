<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("base_edu");

is_int_obligatory ($_GET['disc']);
$discipline=$_GET['disc'];

echo "<h2>Тесты Дисциплины</h2>";

echo "<br>Год обучения должен всегда стоять 2012";
echo "<br><img src=\""._COMMON_DATA_PATH_."images/hide.gif\"> - Тест доступен студентам";
echo "<br><img src=\""._COMMON_DATA_PATH_."images/show.gif\"> - Тест недоступен студентам";
echo "<br><br><a href=\"index.php\">Назад</a>";
$datagrid= new DataTable;
$datagrid-> url="discipline_test.php?disc=".$discipline;// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."courses_bind_test", " AND (`subject`=".$discipline." ) ");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("subject", "Дисциплина");
$datagrid-> foreign_key ("subject", _TABLE_PREFIX_."disciplines", "name_ru_detailed", "id"); //
$datagrid-> bind_field_with_parameter("subject", $discipline);

$datagrid-> table_field_caption("test", "Название теста");
$datagrid-> foreign_key ("test", _TABLE_PREFIX_."tests", "name", "id"); //
// not successfull $datagrid-> bind_field_with_parameter("test", 67);

$datagrid-> table_field_caption("mod", "Модуль");
$datagrid-> foreign_key ("mod", _TABLE_PREFIX_."type_modules", "name_ru", "id"); //

$datagrid-> table_field_caption("year", "Год");
$datagrid-> foreign_key ("year", _TABLE_PREFIX_."type_years", "start", "id"); //
$datagrid-> bind_field_with_parameter("year", _CURRENT_YEAR_);

$datagrid-> user_module_permissions = user_access_module ("base_edu");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>