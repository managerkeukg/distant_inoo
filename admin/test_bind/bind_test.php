<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("test_bind");

is_int_obligatory ($_GET['subject']);
$subject=$_GET['subject'];
is_int_obligatory ($_GET['mod']);
$mod=$_GET['mod'];
is_int_obligatory ($_GET['test']);
$test=$_GET['test'];
$table=""._TABLE_PREFIX_."subject_bind_test";
function update_table($query)
{
	$cat_query=mysql_query($query);
	if($cat_query) {
		echo "<HTML><HEAD>
		<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'>
		</HEAD></HTML>"; 
	} else {
		exit(mysql_error());
	}
}

function insert_table ($query)
{
	if(mysql_query($query)) { 
		echo "<HTML><HEAD> <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'> </HEAD></HTML>";
	}  else {
		exit("Ошибка при добавлении данных - ".mysql_error());
	}
}
$query = "SELECT * FROM `".$table."` WHERE `subject`='".$subject."' AND (`status`='1') AND (`year`='"._CURRENT_EDU_YEAR_."') AND (`mod`='".$mod."')";
///echo $query;
$cat_select = mysql_query($query);
if($cat_select) 
{
	if (mysql_num_rows($cat_select)> 0)
	{  
		echo "you must update "; //exit;
		update_table("update `".$table."` SET `test`='".$test."'  WHERE `subject`='".$subject."' AND `mod`='".$mod."' AND `status`='1' AND `year`='"._CURRENT_EDU_YEAR_."'
		");
	} else { echo "you must insert"; //exit;
		$query=$query = "INSERT INTO `".$table."`
		VALUES(NULL,
		'',
		'".$subject."',
		'".$test."',
		'".$mod."',
		'"._CURRENT_EDU_YEAR_."',
		'1',
		'1'
		)";
		insert_table ($query);
	}
} else {}

//insert block
//end insert block

require_once _DATA_PATH_."bottom.php";
?>