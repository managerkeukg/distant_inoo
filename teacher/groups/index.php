<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableHtml.php"; 
require_once _FUNCTIONS_PATH_."f_course_groups.php";
require_once _FUNCTIONS_PATH_."f_iden_group_of_student.php";
require_once _FUNCTIONS_PATH_."f_group_name.php";

is_int_obligatory ($_GET['discipline']);
$discipline=$_GET['discipline'];

$query = "SELECT `id`, `semester`, `name_ru`, `name_ru_detailed`  FROM `"._TABLE_PREFIX_."disciplines` WHERE `id`='".$discipline."';";
$object_disciplines= new TableQuery;
$object_disciplines -> order_by_field="id";
$array_disciplines = $object_disciplines -> query ($query);
if (isset($array_disciplines) AND !empty($array_disciplines) AND is_array($array_disciplines))
{
	////echo "<pre> Count disciplines - "; print_r(count($array_disciplines)); echo "</pre>";
	////echo "<pre>array_disciplines "; print_r($array_disciplines); echo "</pre>";
}
echo "<h1>Дисциплина - ".$array_disciplines[$discipline]['name_ru_detailed']."</h1>";


$array_course_groups = get_course_groups ($discipline); 
if (isset($array_course_groups) AND !empty($array_course_groups))
{
	//echo "<pre>array_course_groups "; print_r($array_course_groups); echo "</pre>";
	$array_discipline_groups = array ();
	foreach ($array_course_groups as $group => $value)
	{
		$array_discipline_groups [$group] = array (
			"discipline" => $discipline,
			"group" => $group,
			"group_name" => identify_group_name($group)
			);
		//echo "<br><br><a href=\"230.php?group=".$group."&course=".$discipline."\">". identify_group_name($group)."</a>";
	}
	////echo "<pre>array_discipline_groups "; print_r($array_discipline_groups); echo "</pre>";
	$object_table=new TableHtml5;
	$object_table -> css_file = "css/html_table_blue.css";
	
	$headers= array("discipline"=>"Название дисциплины", "group"=>"Номер группы", "group_name"=>"Название группы");
	$object_table -> set_th_array ($headers);

	$object_table->column_value_array_foreign ("discipline", $array_disciplines , array("name_ru_detailed"));
	$object_table -> set_data($array_discipline_groups);
	
	$object_table -> data_key_add ("group_announcement", "Объяв <br> ления  <br> группе");
	$object_table -> data_key_value ("group_announcement", "<a href=\"../group_announcement/index.php?group=5&discipline={{discipline}}\" target=\"_blank\">=></a>");
	
	$object_table -> data_key_add ("practice1", "Практика 1");
	$object_table -> data_key_value ("practice1", "<a href=\"practice.php?group=5&discipline={{discipline}}&practice=1\" target=\"_blank\">=></a>");
	
	$object_table -> data_key_add ("practice2", "Практика 2");
	$object_table -> data_key_value ("practice2", "<a href=\"practice.php?group=5&discipline={{discipline}}&practice=1\" target=\"_blank\">=></a>");
	
	$object_table -> data_key_add ("modules", "Модули");
	$object_table -> data_key_value ("modules", "<a href=\"modules.php?group=5&discipline={{discipline}}\" target=\"_blank\">=></a>");
	
	$object_table -> data_key_add ("exam", "Итоговый  <br> контроль");
	$object_table -> data_key_value ("exam", "<a href=\"exam.php?group=5&discipline={{discipline}}\" target=\"_blank\">=></a>");
	
	$object_table->display ();
} else {
	echo "<br>Нет групп прикреплённых к данной дисциплине";
}


require_once _DATA_PATH_."bottom.php";
?>