<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

//echo "<pre>"; print_r($_POST); echo "</pre>";  //exit;
$id_teacher= htmlspecialchars(trim($_POST['id_teacher']));
$id_course= htmlspecialchars(trim($_POST['id_course']));
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) 
{
	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
} else {$ip=$_SERVER["REMOTE_ADDR"];}
$msg=trim($_POST['letter']);
$query = "INSERT INTO `"._TABLE_PREFIX_."subject_messages` 
	VALUES (
		NULL,
		'".$id_course."',
		'"._ID_USER_."',
		'".$id_teacher."',
		'2',
		'',
		'".$msg."',
		'2',
		'".$ip."',
		NOW()
	);";
if(mysql_query($query)) 
{ 
	echo "<HTML><HEAD>
	   <META HTTP-EQUIV='Refresh' CONTENT='0; URL=teacher_messages.php?id=".$id_course."'>
	   </HEAD></HTML>";
} 
else exit("Ошибка при добавлении данных - ".mysql_error()); //.mysql_error()

require_once _DATA_PATH_."bottom.php";    
?>