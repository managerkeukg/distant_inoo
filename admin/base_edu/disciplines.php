<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("base_edu");

is_int_obligatory ($_GET['base_edu']);
is_int_obligatory ($_GET['direction']);
is_int_obligatory ($_GET['semester']);
$base_edu=$_GET['base_edu'];
$direction=$_GET['direction'];
$semester=$_GET['semester'];

echo "<h2>Дисциплины семестра</h2>";
echo "<a href=\"semesters.php?base_edu=".$base_edu."&direction=".$direction."\">Назад</a>";

$object_base_edu= new TableQuery;
$object_base_edu -> order_by_field="id";
$array_base_edu = $object_base_edu -> query ("SELECT * FROM `"._TABLE_PREFIX_."base_edu` WHERE `status`='1'");
////echo "<pre>"; print_r($array_base_edu); echo "</pre>";
echo "<h5>База обучения - ".$array_base_edu[$base_edu]['name_ru']."</h5>";

$object_directions= new TableQuery;
$object_directions -> order_by_field="id";
$array_directions = $object_directions -> query ("SELECT * FROM `"._TABLE_PREFIX_."directions` WHERE `status`='1'");
////echo "<pre>"; print_r($array_directions); echo "</pre>";
echo "<h5>Направление - ".$array_directions[$direction]['name_ru']."</h5>";

$object_semesters= new TableQuery;
$object_semesters -> order_by_field="id";
$array_semesters = $object_semesters -> query ("SELECT * FROM `"._TABLE_PREFIX_."semester` WHERE `status`='1'");
////echo "<pre>"; print_r($array_semesters); echo "</pre>";
echo "<h5>Семестр - ".$array_semesters[$semester]['name_ru']."</h5>";

$datagrid= new DataTable;
$datagrid-> url="disciplines.php?base_edu=".$base_edu."&direction=".$direction."&semester=".$semester;// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."disciplines", " AND (`semester`=".$semester." ) ");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("semester", "Семестер");
$datagrid-> foreign_key ("semester", _TABLE_PREFIX_."semester", "name_ru", "id"); //
$datagrid-> bind_field_with_parameter("semester", $semester);

$datagrid-> table_field_caption("name_ru", "Название <br> дисциплины");
$datagrid-> table_field_caption("name_ru_detailed", "Подробное Название  <br> дисциплины");

$datagrid-> addcolumn ("discipline_test", ""); 
$datagrid-> table_field_caption("discipline_test", "Тесты  <br> дисциплины"); 
$datagrid-> column_value("discipline_test", "<a href=\"discipline_test.php?disc={{id}}\" target=\"blank\">=></a>" );


$datagrid-> user_module_permissions = user_access_module ("base_edu");

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>