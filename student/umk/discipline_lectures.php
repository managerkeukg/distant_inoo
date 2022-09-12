<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableHtml.php";
require_once _COMMON_DATA_PATH_."classes/ClassArrayManage.php";
require_once _FUNCTIONS_PATH_."function_identify_course.php";
is_int_obligatory ($_GET['id']);
$id=$_GET['id'];

echo "<h2>".identify_course($id)."</h2>";

$query = "SELECT * FROM `"._TABLE_PREFIX_."lesson_files`
		WHERE `status`='1' AND `lesson_type`='1';";
$object_lectures = new TableQuery;
$object_lectures -> order_by_field="id";
$array_lectures = $object_lectures->query ($query);
if (isset($array_lectures) AND !empty($array_lectures) AND is_array($array_lectures))
{
	////echo "<pre> lectures count "; print_r(count($array_lectures)); echo "</pre>";
	////echo "<pre> lectures "; print_r($array_lectures); echo "</pre>";
}

$query = "SELECT * FROM `"._TABLE_PREFIX_."lesson_files`
				WHERE `status`='1' AND `lesson_type`='2';";
$object_srs = new TableQuery;
$object_srs -> order_by_field="id";
$array_srs = $object_srs->query ($query);
if (isset($array_srs) AND !empty($array_srs) AND is_array($array_srs))
{
	////echo "<pre> srs count "; print_r(count($array_srs)); echo "</pre>";
	////	echo "<pre> srs "; print_r($array_srs); echo "</pre>";
}

$query = "SELECT * FROM `"._TABLE_PREFIX_."lesson_files`
				WHERE `status`=1 AND lesson_type='3';";
$object_presentations = new TableQuery;
$object_presentations -> order_by_field="id";
$array_presentations = $object_presentations->query ($query);
if (isset($array_presentations) AND !empty($array_presentations) AND is_array($array_presentations))
{
	////echo "<pre> presentations count "; print_r(count($array_presentations)); echo "</pre>";
	////echo "<pre> presentations "; print_r($array_presentations); echo "</pre>";
}
			
$query="SELECT * FROM `"._TABLE_PREFIX_."courses_lesson` where `course`='".$id."'";
$object_courses_lessons = new TableQuery;
$object_courses_lessons -> order_by_field="id";
$array_courses_lessons = $object_courses_lessons->query ($query);
if (isset($array_courses_lessons) AND !empty($array_courses_lessons) AND is_array($array_courses_lessons))
{
	////echo "<pre> courses_lessons count "; print_r(count($array_courses_lessons)); echo "</pre>";
	////echo "<pre> courses_lessons "; print_r($array_courses_lessons); echo "</pre>";
	
	$object_array = new ArrayManage;
	$object_array -> ArrayMain = $array_courses_lessons;
	$object_array -> ArrayMain_KeyField = "id";
	$object_array -> ArrayMain_ParentField =  "id";
	$object_array -> ArrayMain_JoinedField = "lectures";
	
	$object_array -> ArrayDependent = $array_lectures;
	$object_array -> ArrayDependent_KeyField = "id";
	$object_array -> ArrayDependent_DependentField = "lesson";
	$object_array -> ArrayDependent_JoinedFields = array ("id", "lesson", "name");
	$array_new = $object_array -> merge_arrays ($array_courses_lessons, $array_lectures);
	if (isset($array_new) AND !empty($array_new) AND is_array($array_new)) {
		//echo "<pre> array_new "; print_r($array_new); echo "</pre>";
		$array_new2= array ();
		foreach ($array_new as $key => $value) {
			if (is_array($value)) {
				foreach ($value as $key2 => $value2) {
					if (is_array($value2)) {
						$array_new2[$key][$key2] = $value2['name']."<br>"."<a href=\"dl_lf.php?id=".$value2['id']."\"> Скачать </a>";
					} else {
						$array_new2[$key][$key2] = $value2;	
					}
				}
			} else {
				
			}
		}
		//echo "<pre> array_new2 "; print_r($array_new2); echo "</pre>";
	}
	$array_courses_lessons = $array_new2;
	
	$object_array = new ArrayManage;
	$object_array -> ArrayMain = $array_courses_lessons;
	$object_array -> ArrayMain_KeyField = "id";
	$object_array -> ArrayMain_ParentField =  "id";
	$object_array -> ArrayMain_JoinedField = "srs";
	
	$object_array -> ArrayDependent = $array_srs;
	$object_array -> ArrayDependent_KeyField = "id";
	$object_array -> ArrayDependent_DependentField = "lesson";
	$object_array -> ArrayDependent_JoinedFields = array ("id", "lesson", "name");
	$array_new = $object_array -> merge_arrays ($array_courses_lessons, $array_srs);
	if (isset($array_new) AND !empty($array_new) AND is_array($array_new)) {
		//echo "<pre> array_new "; print_r($array_new); echo "</pre>";
		$array_new3= array ();
		foreach ($array_new as $key => $value) {
			if (is_array($value)) {
				foreach ($value as $key3 => $value3) {
					if (is_array($value3)) {
						$array_new3[$key][$key3] = $value3['name']."<br>"."<a href=\"dl_lf.php?id=".$value3['id']."\"> Скачать </a>";
					} else {
						$array_new3[$key][$key3] = $value3;	
					}
				}
			} else {
				
			}
		}
		//echo "<pre> array_new3 "; print_r($array_new3); echo "</pre>";
	}
	$array_courses_lessons = $array_new3;
	
	$object_array = new ArrayManage;
	$object_array -> ArrayMain = $array_courses_lessons;
	$object_array -> ArrayMain_KeyField = "id";
	$object_array -> ArrayMain_ParentField =  "id";
	$object_array -> ArrayMain_JoinedField = "presentation";
	
	$object_array -> ArrayDependent = $array_presentations;
	$object_array -> ArrayDependent_KeyField = "id";
	$object_array -> ArrayDependent_DependentField = "lesson";
	$object_array -> ArrayDependent_JoinedFields = array ("id", "lesson", "name");
	$array_new = $object_array -> merge_arrays ($array_courses_lessons, $array_presentations);
	if (isset($array_new) AND !empty($array_new) AND is_array($array_new)) {
		//echo "<pre> array_new "; print_r($array_new); echo "</pre>";
		$array_new4= array ();
		foreach ($array_new as $key => $value) {
			if (is_array($value)) {
				foreach ($value as $key4 => $value4) {
					if (is_array($value4)) {
						$array_new4[$key][$key4] = $value4['name']."<br>"."<a href=\"dl_lf.php?id=".$value4['id']."\"> Скачать </a>";
					} else {
						$array_new4[$key][$key4] = $value4;	
					}
				}
			} else {
				
			}
		}
		//echo "<pre> array_new4 "; print_r($array_new4); echo "</pre>";
	}
	$array_courses_lessons = $array_new4;
	
	
	$object_table=new TableHtml5;
	$object_table -> css_file = "css/html_table_blue.css";
	
	$headers= array("id"=>"No", "name"=>"Название урока", "lectures" => "Лекции", 
		"srs" => "СРС <br>(Самостоятельная работа студента)",
		"presentation" => "Презентации"
		
		);
	$object_table -> set_th_array ($headers);
	//echo "<pre> array_headers "; print_r($object_table -> array_th ); echo "</pre>";
	$object_table -> set_data($array_courses_lessons);
	$object_table -> data_key_delete ("course");
	$object_table -> data_key_delete ("status");
	
	//$object_table -> data_key_add ("srs", "СРС <br>(Самостоятельная работа студента)");
	//$object_table -> data_key_add ("presentation", "Презентации");
	$object_table -> data_key_add ("video_lectures", "Видео уроки");
	//$object_table -> data_key_value ("gak_files", "<a href=\"dl_gak_file.php?id={{lesson}}\" target=\"_blank\">Скачать</a>");
	//echo "<pre> array_data "; print_r($object_table -> array_data ); echo "</pre>";
	
	$object_table->display ();
}
else {
	echo "<BR>К сожалению пока нет ни одного урока <BR>";
}
?>
<br>
<a href="index.php">Назад</a>
<?php
require_once _DATA_PATH_."bottom.php";
?>