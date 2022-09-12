<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

user_access_module ("results_change");

is_int_obligatory ($_GET['id']);
$id = $_GET['id'];

$query = "DELETE from `"._TABLE_PREFIX_."test_users` WHERE `id`='".$id."'";
if(mysql_query($query))
{ 
	echo "Запись успешно удалена"; 
} else { 
}
?>