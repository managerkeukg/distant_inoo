<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

echo "<h3>Учебно методический комплекс дисциплины</h3>";

is_int_obligatory ($_GET['discipline']);
$discipline = $_GET['discipline'];

$query = "SELECT * FROM `"._TABLE_PREFIX_."disciplines` WHERE `id`='".$discipline."' AND `status`='1';";
$object_disciplines= new TableQuery;
$object_disciplines -> order_by_field="id";
$array_disciplines = $object_disciplines -> query ($query);
if (isset($array_disciplines) AND !empty($array_disciplines) AND is_array($array_disciplines))
{
	////echo "<pre> Count disciplines - "; print_r(count($array_disciplines)); echo "</pre>";
	////echo "<pre>array_disciplines "; print_r($array_disciplines); echo "</pre>";
}	

$query = "SELECT * FROM `"._TABLE_PREFIX_."course_umk_files` WHERE `course`='".$discipline."' AND `status`>='1' ORDER BY `time` DESC;";
$object_discipline_umk_files= new TableQuery;
$object_discipline_umk_files -> order_by_field="id";
$array_discipline_umk_files = $object_discipline_umk_files -> query ($query);
if (isset($array_discipline_umk_files) AND !empty($array_discipline_umk_files) AND is_array($array_discipline_umk_files))
{
	////echo "<pre> Count discipline_umk_files - "; print_r(count($array_discipline_umk_files)); echo "</pre>";
	////echo "<pre>array_discipline_umk_files "; print_r($array_discipline_umk_files); echo "</pre>";
}

echo "<h2>Обучение на базе</h2>";

$datagrid= new DataTable;
$datagrid-> url="?";// not
$datagrid-> url="index.php?discipline=".$discipline;// not
$datagrid-> status_field="status"; //obligatory if

$datagrid-> query(_TABLE_PREFIX_."course_umk_files", " AND `course`='".$discipline."' AND `status`>='1'");
//$datagrid-> table_field_caption("id", "Номер");
//$datagrid-> table_field_caption("name_ru", "Название");

//$datagrid-> addcolumn("directions", "");
//$datagrid-> table_field_caption("directions", "Направления");
//$datagrid-> column_value("directions", '<a href="directions.php?base_edu={{id}}">=></a>');

$datagrid-> display("table");

require_once _DATA_PATH_."bottom.php";
?>