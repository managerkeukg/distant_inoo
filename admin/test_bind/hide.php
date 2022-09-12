<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

user_access_module ("test_bind");

is_int_obligatory ($_GET['subject']);
is_int_obligatory ($_GET['mod']);

if (isset($_GET['subject']) AND isset($_GET['mod'])) 
{ 
	$id=$_GET['subject'];
	$mod=$_GET['mod'];
	$mod_field="mod".$mod;
	$query="update `"._TABLE_PREFIX_."modules_status` SET 
				   `".$mod_field."`='2'
				   WHERE `subject`='".$id."' AND `year`='"._CURRENT_EDU_YEAR_."'";
	$cat = mysql_query($query);
	if($cat) 
	{
		echo "<HTML><HEAD>
		<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'>
		</HEAD></HTML>";
	}
    else {
		exit(mysql_error());
	}
} else {};
?>