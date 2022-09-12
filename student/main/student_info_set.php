<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _FUNCTIONS_PATH_."f_convert_date_rus_to_sql.php";

//echo "<pre>"; print_r($_POST); echo "</pre>";

$birthdate = mysql_real_escape_string($_POST['birth_date']);
$maritalstatus = mysql_real_escape_string($_POST['maritalstatus']);
$workplace = mysql_real_escape_string($_POST['workplace']);
$address = mysql_real_escape_string($_POST['address']);
$email = mysql_real_escape_string($_POST['email']);
$mobile = mysql_real_escape_string($_POST['mobile']);


// foreach ($_POST as $field => $value)   {echo field.",";}
$birthdate_array=convert_date_rus_to_sql($birthdate);
$birthdate= $birthdate_array['2']."-".$birthdate_array['1']."-".$birthdate_array['0'];
//echo $birthdate; exit;
$query="SELECT * FROM `"._TABLE_PREFIX_."student_info` where `student`='"._ID_USER_."'; ";
$cat = mysql_query($query);
if($cat) 
{
	if (mysql_num_rows($cat)> 0)
	{ 
		$action_do="update";
	} else {  
		$action_do="insert";
	}
	echo $action_do;
}
else {exit(mysql_error());}

if($action_do=="insert")
{
	$query = "INSERT INTO `"._TABLE_PREFIX_."student_info`
        VALUES(NULL,
			'"._ID_USER_."',
			'".$birthdate."',
			'".$sex."',
			'".$citizenship."',
			'".$passport_data."',
			'".$mobile."',
			'".$maritalstatus."',
			'".$workplace."',
			'".$address."',
			'".$email."',
			'1',
			'1'
		)";
	if(mysql_query($query))
	{ 
		echo "<HTML><HEAD>
			<META HTTP-EQUIV='Refresh' CONTENT='0; URL=student_info.php'>
			</HEAD></HTML>";
	} else exit("Ошибка при добавлении данных - ".mysql_error()); //.mysql_error()

}
elseif ($action_do=="update") {
	$query = "update `"._TABLE_PREFIX_."student_info` SET 
		`birthdate`='".$birthdate."',
		`maritalstatus`='".$maritalstatus."',
		`workplace`='".$workplace."',
		`address`='".$address."',
		`email`='".$email."',
		`mobile`='".$mobile."'
		WHERE `student`='"._ID_USER_."' 
		";
	if(mysql_query($query))
	{
		echo "<HTML><HEAD>
			<META HTTP-EQUIV='Refresh' CONTENT='0; URL=student_info.php'>
			</HEAD></HTML>";
	} else {
		exit(mysql_error());
	}
}

require_once _DATA_PATH_."bottom.php";
?>
