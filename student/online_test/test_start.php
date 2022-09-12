<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _FUNCTIONS_PATH_."f_test_user_try_count.php";
require_once _FUNCTIONS_PATH_."f_generate_password.php";
require_once _FUNCTIONS_PATH_."f_browser.php";

is_int_obligatory ($_GET['id']);
is_int_obligatory ($_GET['mod']);

$id = $_GET['id']; // discipline
$mod = $_GET['mod'];

$year =_CURRENT_EDU_YEAR_;
$session_lenght = "30";

//------ checking test tries
if (test_user_try_count( _ID_USER_ , $id, $mod, $year)>=2) 
{ 
	echo "<p style=\"color:red;\">Уважаемый студент Вы уже сдавали тест по этому предмету более 2'х раз</p>";
} 
else
{
	require_once "test_session.php";
}

require_once _DATA_PATH_."bottom.php";		   
?>