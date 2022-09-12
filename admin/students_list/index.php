<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _FUNCTIONS_PATH_."f_iden_group_of_student.php";
require_once _FUNCTIONS_PATH_."f_group_name.php";

user_access_module ("students_list");

echo "<h2>Студенты</h2>";

echo "<a href=\"add_form.php\" target=\"_blank\">Добавить нового студента</a>";

$query="SELECT * FROM `"._TABLE_PREFIX_."students` WHERE `status`>'0' ORDER BY `id` DESC;";
$object_students = new TableQuery;
$object_students -> order_by_field="id";
$array_students = $object_students -> query ($query);
if (isset($array_students) AND !empty($array_students) AND is_array($array_students))
{
	////echo "<pre> students count "; print_r(count($array_students)); echo "</pre>";
	////echo "<pre> students "; print_r($array_students); echo "</pre>";
	require_once "index_help.php";
}
else {
	echo "<BR>К сожалению пока нет ни одного студента <BR>";
} 

require_once _DATA_PATH_."bottom.php";
?>