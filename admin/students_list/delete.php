<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

user_access_module ("students_list");

echo "<h2>Удаление студента</h2>";

require_once _FUNCTIONS_PATH_."f_exist_student.php";

is_int_obligatory ($_GET['id']);
$id=$_GET['id'];

if (isset($id) AND ($id>8) ) 
{ 
	$query = "update `"._TABLE_PREFIX_."students` SET 
		`status`='0'
		WHERE `id`='".$id."'";
	$cat = mysql_query($query);
	if($cat) 
	{
		echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'></HEAD></HTML>";
	}
    else {exit(mysql_error());}
} else {
	echo "Ошибка удаления";
}

require_once _DATA_PATH_."bottom.php";
?>