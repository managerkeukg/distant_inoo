<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

?>
<h2>Текущий модульный контроль</h2>
<?php
if (_ID_USER_ =='9')
{
	echo "<br><a href=reset.php>Сбросить данные</a> ";
}

require_once _FUNCTIONS_PATH_."f_iden_subject_test.php";
require_once _FUNCTIONS_PATH_."f_table_query.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 
////echo _ID_USER_;

$object_modules_type= new TableQuery;
$object_modules_type->order_by_field="id";
$array_modules_type=$object_modules_type -> query ("SELECT * FROM `"._TABLE_PREFIX_."type_modules` WHERE `status`='1' ORDER BY `id` ASC;" );
if (isset($array_modules_type) AND !empty($array_modules_type))
{
	////echo count($array_modules_type)." записей";
	////echo "<pre>modules_type "; print_r($array_modules_type); echo "</pre>"; 
}

$object_student_assignments = new TableQuery;
$object_student_assignments -> order_by_field="id";
$array_student_assignments = $object_student_assignments -> query ("SELECT `id`, `discipline` FROM `"._TABLE_PREFIX_."discipline_assignments` WHERE `userid`="._ID_USER_." and status='1';" );
////echo count($array_student_assignments)." записей";
////echo "<pre>student assignments "; print_r($array_student_assignments); echo "</pre>"; 

if (isset($array_student_assignments) AND !empty($array_student_assignments))
{
	$array_simple_disciplines = array ();
	$category_array = array ();
	foreach ($array_student_assignments as $key=>$value )
	{
		$query = "SELECT * FROM `"._TABLE_PREFIX_."disciplines` WHERE  `id`='".$value['discipline']."' and `status`=1;" ;
		$object_disciplines = new TableQuery;
		$object_disciplines -> order_by_field="id";
		$array_disciplines = $object_disciplines->query ($query);
		if (isset($array_disciplines) AND !empty($array_disciplines) AND is_array($array_disciplines))
		{
			////echo "<pre> disciplines count "; print_r(count($array_disciplines)); echo "</pre>";
			////			echo "<pre> disciplines "; print_r($array_disciplines); echo "</pre>";
			foreach ($array_disciplines as $value_disciplines) {
				$array_simple_disciplines[$value['discipline']]=$value_disciplines['name_ru'];
				$category_array[$value['discipline']]=$value_disciplines['semester'];
			}
		}
	}
	////	echo "<pre> array_simple_disciplines "; print_r($array_simple_disciplines); echo "</pre>";
	////	echo "<pre> Students semester "; print_r($category_array); echo "</pre>";
	require_once "index_help.php";
}

require_once _DATA_PATH_."bottom.php";
?>