<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("base_edu");

is_int_obligatory ($_GET['base_edu']);
is_int_obligatory ($_GET['direction']);
is_int_obligatory ($_GET['semester']);
$base_edu=$_GET['base_edu'];
$direction=$_GET['direction'];
$semester=$_GET['semester'];

echo "<h2>Удаление умк файлов семестра</h2>";
echo "<a href=\"semesters.php?base_edu=".$base_edu."&direction=".$direction."\">Назад</a>";

$object_base_edu= new TableQuery;
$object_base_edu -> order_by_field="id";
$array_base_edu = $object_base_edu -> query ("SELECT * FROM `"._TABLE_PREFIX_."base_edu` WHERE `status`='1'");
////echo "<pre>"; print_r($array_base_edu); echo "</pre>";
echo "<h5>База обучения - ".$array_base_edu[$base_edu]['name_ru']."</h5>";

$object_directions= new TableQuery;
$object_directions -> order_by_field="id";
$array_directions = $object_directions -> query ("SELECT * FROM `"._TABLE_PREFIX_."directions` WHERE `status`='1'");
////echo "<pre>"; print_r($array_directions); echo "</pre>";
echo "<h5>Направление - ".$array_directions[$direction]['name_ru']."</h5>";

$object_semesters= new TableQuery;
$object_semesters -> order_by_field="id";
$array_semesters = $object_semesters -> query ("SELECT * FROM `"._TABLE_PREFIX_."semester` WHERE `status`='1'");
////echo "<pre>"; print_r($array_semesters); echo "</pre>";
echo "<h5>Семестр - ".$array_semesters[$semester]['name_ru']."</h5>";

$path_lesson_files=_UPLOADS_PATH_."lesson_files_umk/";

$object_disciplines= new TableQuery;
$object_disciplines -> order_by_field="id";
$array_disciplines = $object_disciplines -> query ("SELECT * FROM `"._TABLE_PREFIX_."disciplines` WHERE  `semester`=".$semester." AND `status`='1'");
if (isset($array_disciplines) and !empty($array_disciplines)) {
	////echo "<pre>Semester disciplines - "; print_r($array_disciplines); echo "</pre>";
	foreach ($array_disciplines as $value) {
		$object_umk_files = new TableQuery;
		$object_umk_files -> order_by_field="id";
		$array_umk_files = $object_umk_files -> query ("SELECT * FROM `"._TABLE_PREFIX_."course_umk_files` WHERE  `course`=".$value['id']." AND `status`='1'");
		if (isset($array_umk_files) and !empty($array_umk_files)) {
			////echo "<pre>Discipline umk files - "; print_r($array_umk_files); echo "</pre>";
			foreach ($array_umk_files as $value2) {
				echo "<br>UPDATE `"._TABLE_PREFIX_."course_umk_files` SET `status`='0' WHERE `id`='".$value2['id']."' AND `course`='".$value['id']."'; ";
				if (file_exists($path_lesson_files.$value2['id'].".".$value2['ext'])) {
					//echo "<BR>Файл $value существует";
					//echo "<br> file exists".$path_lesson_files.$value2['id'].".".$value2['ext'];
					if (!unlink(''.$path_lesson_files.$value2['id'].".".$value2['ext'].'')) { echo "<br>Can not unlink a file";}
				} else {
					//echo "<BR>Файл $value не существует";
					//echo "<br> file does not exists ".$path_lesson_files.$value2['id'].".".$value2['ext'];
				}
			}
		}
		
	}
}



require_once _DATA_PATH_."bottom.php";
?>