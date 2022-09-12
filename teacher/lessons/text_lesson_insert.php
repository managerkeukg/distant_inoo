<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

is_int_obligatory ($_GET['id']);
is_int_obligatory ($_GET['id_l']);
$id=$_GET['id'];
$id_l=$_GET['id_l'];

$theme_name= htmlspecialchars(trim($_POST['theme_name']));
$theme_name=mysql_real_escape_string ($theme_name);

$lesson_text= htmlspecialchars(trim($_POST['lesson_text']));
$lesson_text=mysql_real_escape_string ($lesson_text);

$theme_name=$_POST['theme_name'];
if (empty($theme_name)) {$theme_name="Без названия";}
$query = "INSERT INTO `"._TABLE_PREFIX_."courses_text_lesson`
	VALUES(
		NULL,
		'".$id_l."',
		'".$theme_name."',
		'".$lesson_text."',
		'1'
)";
if(mysql_query($query))
{ 	
	//  $_SERVER[PHP_SELF]  index.php?option=com_content&view=article&id=4&Itemid=23
	echo "<HTML><HEAD>
		  <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?discipline=".$id."'>
		  </HEAD></HTML>";
} else exit("Error - ".mysql_error()); //.mysql_error()

require_once _DATA_PATH_."bottom.php";
?>