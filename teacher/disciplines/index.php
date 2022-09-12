<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableHtml.php"; 

echo "<h1>Дисциплины</h1>";

$object_teacher_disciplines= new TableQuery;
$object_teacher_disciplines -> order_by_field="id";
$array_teacher_disciplines = $object_teacher_disciplines -> query ("SELECT * FROM `"._TABLE_PREFIX_."teacher_bind_discipline` 
	WHERE `teacher`="._ID_USER_." AND `status`='1'");
if (isset($array_teacher_disciplines) AND !empty($array_teacher_disciplines) AND is_array($array_teacher_disciplines))
{
	////echo "<pre> Count teacher_disciplines - "; print_r(count($array_teacher_disciplines)); echo "</pre>";
	////echo "<pre>teacher_disciplines "; print_r($array_teacher_disciplines); echo "</pre>";
	
	$where_disciplines = "SELECT `id`, `semester`, `name_ru`, `name_ru_detailed`  FROM `"._TABLE_PREFIX_."disciplines` WHERE (";
	$i=0;
	foreach ($array_teacher_disciplines as $key => $value) {
		$i++; if ($i==1) {
			$where_disciplines = $where_disciplines." `id`='".$value['subject']."'  ";
		} else {
			$where_disciplines = $where_disciplines." OR (`id`='".$value['subject']."') ";
		}
	}
	$where_disciplines = $where_disciplines.") AND `status`='1'; ";
	
	$array_disciplines = array ();
	
	$object_disciplines= new TableQuery;
	$object_disciplines -> order_by_field="id";
	$array_disciplines = $object_disciplines -> query ($where_disciplines);
	if (isset($array_disciplines) AND !empty($array_disciplines) AND is_array($array_disciplines))
	{
		////echo "<pre> Count disciplines - "; print_r(count($array_disciplines)); echo "</pre>";
		////echo "<pre>array_disciplines "; print_r($array_disciplines); echo "</pre>";
	}	
	
	$object_semesters= new TableQuery;
	$object_semesters -> order_by_field="id";
	$array_semesters = $object_semesters -> query ("SELECT * FROM `"._TABLE_PREFIX_."semester` 
		WHERE `status`='1' ORDER BY `id`;");
	if (isset($array_semesters) AND !empty($array_semesters) AND is_array($array_semesters))
	{
		////echo "<pre> Count semesters - "; print_r(count($array_semesters)); echo "</pre>";
		////echo "<pre>semesters "; print_r($array_semesters); echo "</pre>";
	}
	
	$object_table=new TableHtml5;
	$object_table -> css_file = "css/html_table_blue.css";
	
	$headers= array("id"=>"Номер записи", "semester"=>"Семестр", "name_ru"=>"Название дисциплины", "name_ru_detailed"=>"Подробнее");
	$object_table -> set_th_array ($headers);

	$object_table->column_value_array_foreign ("semester", $array_semesters , array("name_ru"));
	$object_table -> set_data($array_disciplines);
	
	$object_table -> data_key_add ("lessons", "УРОКИ");
	$object_table -> data_key_value ("lessons", "<a href=\"../lessons/index.php?discipline={{id}}\" >=></a>");
	
	$object_table -> data_key_add ("umk", "УМК");
	$object_table -> data_key_value ("umk", "<a href=\"../umk/index.php?discipline={{id}}\" >=></a>");
	
	$object_table -> data_key_add ("groups", "Группы");
	$object_table -> data_key_value ("groups", "<a href=\"../groups/index.php?discipline={{id}}\" >=></a>");
	
	$object_table->display ();
}

require_once _DATA_PATH_."bottom.php";
?>