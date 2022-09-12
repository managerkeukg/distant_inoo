<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("delete_files");

echo "<h2>Удалить delete lesson_files</h2>";

$path_lesson_files=_UPLOADS_PATH_."lesson_files/";

$query = "SELECT * FROM `"._TABLE_PREFIX_."lesson_files` WHERE `status`='0' " ;
$object_lesson_files= new TableQuery;
$object_lesson_files -> order_by_field="id";
$array_lesson_files = $object_lesson_files -> query ($query);
if (isset($array_lesson_files) AND !empty($array_lesson_files) AND is_array($array_lesson_files))
{
	////echo "<pre> Count lesson_files - "; print_r(count($array_lesson_files)); echo "</pre>";
	////echo "<pre>lesson_files "; print_r($array_lesson_files); echo "</pre>";
	$array_to_delete = array ();
	foreach ($array_lesson_files as $value) {
		$array_to_delete[$value['id']]=$value['id'].".".$value['ext'];
	}
}
else {
	echo "<br><br>Нет ни одного удаленного файла!<br>";
}

if (isset($array_to_delete) AND !empty($array_to_delete))
{
	echo count($array_to_delete);
	echo "<pre>Array to delete "; print_r($array_to_delete); echo "</pre>";
	foreach ($array_to_delete as $value)
	{
		if (file_exists($path_lesson_files.$value)) {
			//echo "<BR>Файл $value существует";
			$array_files_to_delete[]=$path_lesson_files.$value;
		} else  {
			//echo "<BR>Файл $value не существует";
		}
	}
}

if (isset($array_files_to_delete) AND !empty($array_files_to_delete))

{       
	echo count($array_files_to_delete);
	echo "<pre> Files to delete that exists "; print_r($array_files_to_delete); echo "</pre>";
	foreach ($array_files_to_delete as $value)
	{
		unlink(''.$value.'');
	}
}

require_once _DATA_PATH_."bottom.php";
?>