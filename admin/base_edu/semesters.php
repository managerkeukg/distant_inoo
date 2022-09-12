<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php";

user_access_module ("base_edu");

//submodule permission check
$user_submodule_access = user_access_submodule ("direction_semesters");

is_int_obligatory ($_GET['base_edu']);
is_int_obligatory ($_GET['direction']);
$base_edu=$_GET['base_edu'];
$direction=$_GET['direction'];

echo "<h2>Семестры направления</h2>";
echo "<a href=\"directions.php?base_edu=".$base_edu."&direction=".$direction."\">Назад</a>";

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


$datagrid= new DataTable;
$datagrid-> url="semesters.php?base_edu=".$base_edu."&direction=".$direction;// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."semester", " AND (`direction`=".$direction." ) ");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("direction", "Направление");
$datagrid-> foreign_key ("direction", _TABLE_PREFIX_."directions", "name_ru", "id"); //
$datagrid-> bind_field_with_parameter("direction", $direction);

$datagrid-> table_field_caption("name_ru", "Название  <br> семестра");

$datagrid-> addcolumn("disciplines", "");
$datagrid-> table_field_caption("disciplines", "Дисциплины   <br> семестра");
$datagrid-> column_value("disciplines", '<a href="disciplines.php?base_edu='.$base_edu.'&direction='.$direction.'&semester={{id}}">=></a>');

//$datagrid-> user_module_permissions = user_access_module ("base_edu");
////submodules 
$datagrid-> user_module_permissions = $user_submodule_access;

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>