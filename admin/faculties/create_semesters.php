<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("departments");

is_int_obligatory ($_GET['spec']);
is_int_obligatory ($_GET['dep']);
$spec=$_GET['spec'];
$dep=$_GET['dep'];

require_once _FUNCTIONS_PATH_."f_get_department.php";
$department_array=department_array($dep);
echo "<BR>Кол-во семестров  ".$department_array['semesters_count'];
echo "<BR>Специальность      ".$department_array['name'];

echo "<h4>Семестры</h4>";
echo "<a href=\"specialities.php?dep=".$dep."\">Назад</a><br><br>";

$query = "SELECT * FROM `"._TABLE_PREFIX_."semesters`
    WHERE `speciality` = '".$spec."';";
$object_semesters = new TableQuery;
$object_semesters -> order_by_field="id";
$array_semesters = $object_semesters->query ($query);
if (isset($array_semesters) AND !empty($array_semesters) AND is_array($array_semesters))
{
	////echo "<pre> semesters count "; print_r(count($array_semesters)); echo "</pre>";
	////echo "<pre> semesters "; print_r($array_semesters); echo "</pre>";
	$dep_array = array ();
	foreach ($array_semesters as $value) {
		$dep_array[]=$value;
	}
} else {
	$dep_array="";
	$insert_text="INSERT INTO `"._TABLE_PREFIX_."semesters` (`name`, `speciality`, `id_user`, `status`) VALUES";
	for ($i=1; $i <= $department_array['semesters_count']; $i++) {
		if($i==$department_array['semesters_count']) {
			$insert_text=$insert_text."('".$i." семестр', ".$spec.", 1, 1); ";
		} else {
			$insert_text=$insert_text."('".$i." семестр', ".$spec.", 1, 1),  ";
		}
	}
	//echo $insert_text;

	///*		
	$query = $insert_text;
	if(mysql_query($query))
	{ 
		echo "<BR>семестры успешно добавлены";
	} else {
		exit("Ошибка при добавлении данных - ".mysql_error()); 
	}
	// */
}
if (isset($dep_array) and !empty($dep_array))
{ 
	echo "<BR>семестры уже созданы ранее";
}
//echo "<pre>"; print_r ($dep_array); echo "</pre>";


require_once _DATA_PATH_."bottom.php";
?>