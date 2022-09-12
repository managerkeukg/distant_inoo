<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

is_int_obligatory ($_GET['id']);
is_int_obligatory ($_GET['id_l']);
$id=$_GET['id'];
$id_l=$_GET['id_l'];

$lesson_name= htmlspecialchars(trim($_POST['lesson_name']));
$lesson_name= mysql_real_escape_string ($lesson_name);
    
$query="update `"._TABLE_PREFIX_."courses_lesson` 
	SET 
		name='".$lesson_name."'
		WHERE `course`='".$id."' AND `id`='".$id_l."'
	;
";
$cat = mysql_query($query);
if($cat) 
{
	echo "<HTML><HEAD>
	<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?discipline=".$id."'>
	</HEAD></HTML>";
}
else {exit(mysql_error());}

require_once _DATA_PATH_."bottom.php";
?>