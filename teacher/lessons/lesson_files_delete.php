<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

is_int_obligatory ($_GET['id']);
is_int_obligatory ($_GET['id_s']);
$id=$_GET['id'];
$id_s=$_GET['id_s'];

if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];} else {$ip=$_SERVER["REMOTE_ADDR"];}
$query = "update `"._TABLE_PREFIX_."lesson_files` 
	SET 
	`status`='0',
	`ip_deleted`='".$ip."',
	`time_deleted`=now()
	WHERE `id`='".$id."'   
	AND `status`='1' 
	;
";
if(mysql_query($query)) 
{ 
	echo "<HTML><HEAD>
	<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?discipline=".$id_s."'>
	</HEAD></HTML>";
}   else { }

require_once _DATA_PATH_."bottom.php";
?>