<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

//echo "<pre>"; print_r($_POST); echo "</pre>";  //exit;
$from= htmlspecialchars(trim(_ID_USER_));
if ($from==1) {$from=2;}
is_int_obligatory ($_POST['id_student']);
$to = htmlspecialchars(trim($_POST['id_student']));
if(isset($to) AND !empty($to)) 
{
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];} else {$ip=$_SERVER["REMOTE_ADDR"];}
	$msg=htmlspecialchars (trim($_POST['letter']));
	$query = "INSERT INTO `"._TABLE_PREFIX_."messages_staff` 
		VALUES (NULL,
		'',
		'".$from."',
		'".$to."',
		'',
		'".$msg."',
		'2',
		'".$ip."',
		NOW())";
    if(mysql_query($query)) 
	{ 
		echo "<HTML><HEAD>
		<META HTTP-EQUIV='Refresh' CONTENT='0; URL=read.php?id=".$to."'>
		</HEAD></HTML>";
	} 
	else exit("Ошибка при добавлении данных - ".mysql_error()); //.mysql_error()
}

require_once _DATA_PATH_."bottom.php";
?>