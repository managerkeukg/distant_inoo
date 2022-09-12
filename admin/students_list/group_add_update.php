<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

user_access_module ("students_list");

is_int_obligatory ($_GET['id_s']);
is_int_obligatory ($_GET['group']);
 
$group=$_GET['group'];
$id_s=$_GET['id_s'];

$query="INSERT INTO `"._TABLE_PREFIX_."group_members`
	VALUES (
		NULL,
		'".$group."',
		'".$id_s."',
		'1'
		)";
$cat = mysql_query($query);
if($cat) 
{
	echo "<HTML><HEAD>
		   <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?#".$id_s."'>
		   </HEAD></HTML>";
}  // 
else { 
	echo "Невозможно ввести данные ".mysql_error();
}

require_once _DATA_PATH_."bottom.php";
?>