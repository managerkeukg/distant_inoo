<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _FUNCTIONS_PATH_."f_semester_disciplines.php";
require_once _FUNCTIONS_PATH_."f_iden_subject_test_status2.php";

if (isset($_GET['semester']) AND !empty($_GET['semester']))
{
	is_int_obligatory ($_GET['semester']);
	$semester = $_GET['semester'];
}
else {
	$semester=0;
}
////echo _ID_USER_;

$object_modules_type= new TableQuery;
$object_modules_type->order_by_field="id";
$array_modules_type=$object_modules_type -> query ("SELECT * FROM `"._TABLE_PREFIX_."type_modules` WHERE `status`='1' ORDER BY `id` ASC;" );
if (isset($array_modules_type) AND !empty($array_modules_type))
{
	////echo count($array_modules_type)." записей";
	////echo "<pre>modules_type "; print_r($array_modules_type); echo "</pre>"; 
}
?>
<h3>Результаты текущего контроля</h3>
<?php
$object_directions= new TableQuery;
$object_directions->order_by_field="id";
$array_directions=$object_directions -> query ("SELECT * FROM `"._TABLE_PREFIX_."directions` WHERE  status='1';" ); // `userid`="._ID_USER_." and
////echo "<pre>directions "; print_r($array_directions); echo "</pre>"; 

$object_groups= new TableQuery;
$object_groups->order_by_field="id";
$array_groups=$object_groups -> query ("SELECT * FROM `"._TABLE_PREFIX_."groups` WHERE `id`="._USER_GROUP_." and status='1';" ); // 
////echo count($array_groups)." записей";
echo _USER_GROUP_;
////echo "<pre>groups "; print_r($array_groups); echo "</pre>"; 
$user_direction = $array_groups[_USER_GROUP_]['direction'];

$object_semesters= new TableQuery;
$object_semesters->order_by_field="id";
$array_semesters=$object_semesters -> query ("SELECT * FROM `"._TABLE_PREFIX_."semester` WHERE `direction`=".$user_direction." and status='1';" ); // 
////echo count($array_semesters)." записей";
////echo "<pre>semesters "; print_r($array_semesters); echo "</pre>";

echo "Специальность (направление) группы № - ".$user_direction;
echo "<br>Группа № - "._USER_GROUP_NAME_;
echo "<br>Выберите семестр нажатием ";
echo "<br>";

if (isset($array_semesters) AND !empty($array_semesters)) {
	$semester_disciplines=array();
	foreach ($array_semesters as $key => $value) {
		if ($semester==$value['id']) { $bgcolor="green";} else {$bgcolor="#023183";}
		echo "<a href=\"index.php?semester=".$value['id']."\">
		<div style=\"float:left; padding:10px 10px; margin: 5px 5px; border-right:1px white dotted; background-color:".$bgcolor."; color:white;\">".$value['name_ru']."
		
		</div></a>";
		////echo "<pre>disciplines "; print_r(semester_disciplines($value['id'])); echo "</pre>";
		$semester_disciplines[$key]= semester_disciplines($value['id']);
	}
	echo "<div style=\"clear:both;\"></div>";
	////echo "<pre>disciplines of semesters "; print_r($semester_disciplines); echo "</pre>";
}

if (isset($semester_disciplines[$semester]) AND !empty($semester_disciplines[$semester])) {
	$user_disciplines = array ();
	foreach ($semester_disciplines[$semester] as $key => $value) {
		$user_disciplines[$value['id']]=$value['name_ru'];
		///echo "<br>".$value['id']." - ".$value['name_ru'];
	}
	////echo "<pre>semester disciplines "; print_r($semester_disciplines[$semester]); echo "</pre>";
}

if (isset($semester) AND !empty($semester) AND !empty($user_disciplines))
{
	////	echo "<pre> Students discipline "; print_r($user_disciplines); echo "</pre>";
	require_once "index_help.php";
} else {
	echo "Нет привязанных дисциплин студента к этому семестру. Обратитесь к менеджеру курса.";
}

require_once _DATA_PATH_."bottom.php";
?>