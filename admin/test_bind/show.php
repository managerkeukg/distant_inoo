<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

user_access_module ("test_bind");

is_int_obligatory ($_GET['subject']);
is_int_obligatory ($_GET['mod']);

if (isset($_GET['subject']) AND isset($_GET['mod']) ) 
{ 
	$discipline=$_GET['subject'];
    $mod=$_GET['mod'];
	$mod_field="mod".$mod;
	$query="SELECT * FROM `"._TABLE_PREFIX_."modules_status` WHERE `subject`='".$discipline."'  AND `year`='"._CURRENT_EDU_YEAR_."'";
	$cat_select = mysql_query($query);
	if($cat_select) 
    {
		if (mysql_num_rows($cat_select)> 0)
		{  
			//echo "you must update ";
			$query="update `"._TABLE_PREFIX_."modules_status` SET 
				`".$mod_field."`='1'
				WHERE `subject`='".$discipline."' AND `year`='"._CURRENT_EDU_YEAR_."'";
			$cat = mysql_query($query);
			if($cat) 
			{ 
				echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'></HEAD></HTML>";
			}
			else {exit(mysql_error());}
		} 
		else { 
			//echo "you must insert";
			$query = "INSERT INTO `"._TABLE_PREFIX_."modules_status`
			VALUES(NULL,
			'',
			'".$discipline."',
			'1',
			'1',
			'"._CURRENT_EDU_YEAR_."')";
			if(mysql_query($query)) 
			{  
				echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'></HEAD></HTML>";
			}   else exit("Ошибка при добавлении данных - ".mysql_error());
		}
  	} else {}
} else {};
?>