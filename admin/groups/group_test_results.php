<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("groups");; 

require_once _FUNCTIONS_PATH_."f_group_name.php";
require_once _FUNCTIONS_PATH_."f_group_members.php";
require_once _FUNCTIONS_PATH_."f_iden_speciality.php";
require_once _FUNCTIONS_PATH_."f_group_speciality.php";
?>
<a href="index.php">Назад</a><br>
<?php
is_int_obligatory ($_GET['id']);
$group=$_GET['id'];
$group_name=identify_group_name($group);
$array_group_members = group_members($group);
echo "<h2>Результаты тестов Группы    ".$group_name."</h2>";
////echo "<pre>group members "; print_r($array_group_members); echo "</pre>";
echo "выбор семестра, дисциплины, в конце показать результаты тестов";

require_once _DATA_PATH_."bottom.php";
?> 