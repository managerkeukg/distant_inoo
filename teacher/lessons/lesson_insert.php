<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

is_int_obligatory ($_GET['id']);
$id=$_GET['id'];

//if(isset($_POST)) {echo "<pre>"; print_r($_POST); echo "</pre>";}

$lesson_name= htmlspecialchars(trim($_POST['lesson_name']));
$lesson_name= mysql_real_escape_string ($lesson_name);
$query = "INSERT INTO `"._TABLE_PREFIX_."courses_lesson`
	VALUES(
		NULL,
		'".$id."',
		'".$lesson_name."',
		'1'
	)";
if(mysql_query($query))
{ 
	echo "<HTML><HEAD>
	<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?discipline=".$id."'>
	</HEAD></HTML>";
} else exit("Error - ".mysql_error()); //.mysql_error()

require_once _DATA_PATH_."bottom.php";
?>