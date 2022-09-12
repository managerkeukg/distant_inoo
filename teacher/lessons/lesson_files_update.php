<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

is_int_obligatory ($_GET['id']);
is_int_obligatory ($_GET['id_course']);
$id=$_GET['id'];
$id_course=$_GET['id_course'];

$name_file=htmlspecialchars(trim($_POST['name_file']));
$name_file=mysql_real_escape_string ($name_file);
	
$lesson_type= htmlspecialchars(trim($_POST['lesson_type']));
$lesson_type=mysql_real_escape_string ($lesson_type);
$query="update `"._TABLE_PREFIX_."lesson_files` 
	SET 
	`name`='".$name_file."',
	`lesson_type`='".$lesson_type."'
	WHERE `id`='".$id."'
";
$cat = mysql_query($query);
if($cat) 
{
	echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?discipline=".$id_course."'></HEAD></HTML>";
}
else {exit(mysql_error());}

require_once _DATA_PATH_."bottom.php";
?>