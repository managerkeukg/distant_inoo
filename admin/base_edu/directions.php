<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php";

//module permission check
user_access_module ("base_edu");

//submodule permission check
$user_submodule_access = user_access_submodule ("directions");

is_int_obligatory ($_GET['base_edu']);
$base_edu=$_GET['base_edu'];

echo "<h2>Направления</h2>";
echo "<a href=\"index.php\">Назад</a>";

$object_base_edu= new TableQuery;
$object_base_edu -> order_by_field="id";
$array_base_edu = $object_base_edu -> query ("SELECT * FROM `"._TABLE_PREFIX_."base_edu` WHERE `status`='1'");
////echo "<pre>"; print_r($array_base_edu); echo "</pre>";
echo "<h5>База обучения - ".$array_base_edu[$base_edu]['name_ru']."</h5>";

$datagrid= new DataTable;
$datagrid-> url="directions.php?base_edu=".$base_edu;// not
$datagrid-> status_field="status"; //obligatory if 

$datagrid-> query(_TABLE_PREFIX_."directions", " AND (`base_edu`=".$base_edu." ) ");
$datagrid-> table_field_caption("id", "Номер");
$datagrid-> table_field_caption("base_edu", "База обучения");
$datagrid-> foreign_key ("base_edu", _TABLE_PREFIX_."base_edu", "name_ru", "id"); //
$datagrid-> bind_field_with_parameter("base_edu", $base_edu);

$datagrid-> table_field_caption("name_ru", "Название");

$datagrid-> addcolumn("groups", "");
$datagrid-> table_field_caption("groups", "Группы <br> Напр-я");
$datagrid-> column_value("groups", '<a href="../groups/directions.php?base_edu='.$base_edu.'&direction={{id}}" target="_blank">=></a>');

$datagrid-> addcolumn("semesters", "");
$datagrid-> table_field_caption("semesters", "Семестры <br> Напр-я");
$datagrid-> column_value("semesters", '<a href="semesters.php?base_edu='.$base_edu.'&direction={{id}}">=></a>');

////modules 
$datagrid-> user_module_permissions = user_access_module ("base_edu");

////submodules $datagrid-> user_module_permissions = $user_submodule_access;

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>