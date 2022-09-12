<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

is_int_obligatory ($_GET['id']);
is_int_obligatory ($_GET['course']);
$id=$_GET['id'];
$course=$_GET['course'];

$query="update `"._TABLE_PREFIX_."course_umk_files` 
	SET 
	`status`='0'
	WHERE `id`='".$id."'
	;
";
$cat = mysql_query($query);
if($cat) 
{
	echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?discipline=".$course."'></HEAD></HTML>";
}
else {exit(mysql_error());}

require_once _DATA_PATH_."bottom.php";
?>