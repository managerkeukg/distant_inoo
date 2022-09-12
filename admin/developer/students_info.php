<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

$query = new TableQuery;
$array = $query -> query ("SELECT * FROM `"._TABLE_PREFIX_."student_info`"); // limit 10, 10

//echo "<pre>"; print_r ($array); echo "</pre>";

foreach ($array as $key => $value)
{
	//echo "<br>".$value['id'];
	$query="update `"._TABLE_PREFIX_."students` 
		SET 
			`birthdate`='".$value['birthdate']."',
			`mobile`='".$value['mobile']."',
			`maritalstatus`='".$value['maritalstatus']."',
			`jobplace`='".$value['workplace']."',
			`address`='".$value['address']."',
			`email`='".$value['email']."'
		WHERE `id`='".$value['student']."'";
	$cat = mysql_query($query);
	if($cat) 
    { 
		//echo "<br>Student's info is successfully updated";
	}
    else {
		$error_update[]=$key;
	}
}
if (isset($error_update) AND !empty($error_update)) {
	echo "<pre>error update "; print_r ($error_update); echo "</pre>";
}
echo "Данные успешно изменены";

require_once _DATA_PATH_."bottom.php";
?>