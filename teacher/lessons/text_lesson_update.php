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
$query="update `"._TABLE_PREFIX_."courses_text_lesson` 
	SET 
		`theme`='".$theme_name."',
		`text`='".$lesson_text."'
		WHERE `id`='".$id_l."' 
";
$cat = mysql_query($query);
if($cat) 
{
	echo "<HTML><HEAD>
	<META HTTP-EQUIV='Refresh' CONTENT='0; URL=text_lesson_view.php?id=".$id."&id_l=".$id_l."'>
	</HEAD></HTML>";
}
else {exit(mysql_error());}

require_once _DATA_PATH_."bottom.php";
?>