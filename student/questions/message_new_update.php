<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

is_int_obligatory ($_POST['id_staff']);
$id_staff=$_POST['id_staff'];

if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];} else {$ip=$_SERVER["REMOTE_ADDR"];}
$msg_theme=htmlspecialchars ( trim($_POST['msg_theme']));
$msg=htmlspecialchars (trim($_POST['msg']));
$query = "INSERT INTO `"._TABLE_PREFIX_."messages_staff` 
	VALUES (
		NULL,
		'',
		'"._ID_USER_."',
		'".$id_staff."',
		'".$msg_theme."',
		'".$msg."',
		'2',
		'".$ip."',
		NOW()
	)";
if(mysql_query($query)) 
{ 
	echo "<HTML><HEAD>
	<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'>
	</HEAD></HTML>";
} 
else exit("Ошибка при добавлении данных - ".mysql_error()); //.mysql_error()

require_once _DATA_PATH_."bottom.php";
?>