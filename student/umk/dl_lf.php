<?php
require_once "../settings.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _COMMON_DATA_PATH_."functions/f_is_int.php";
require_once _COMMON_DATA_PATH_."config.php";

is_int_obligatory ($_GET['id']);
$id_file=$_GET['id']; 

$query = "SELECT * FROM `"._TABLE_PREFIX_."lesson_files`
	WHERE `id` ='".$id_file."' AND `status`='1';";
$object_lesson_files = new TableQuery;
$object_lesson_files -> order_by_field="id";
$array_lesson_files = $object_lesson_files->query ($query);
if (isset($array_lesson_files) AND !empty($array_lesson_files) AND is_array($array_lesson_files))
{
	////echo "<pre> lesson_files count "; print_r(count($array_lesson_files)); echo "</pre>";
	////echo "<pre> lesson_files "; print_r($array_lesson_files); echo "</pre>";
	foreach ($array_lesson_files as $key => $value) {
		if (file_exists(_UPLOADS_PATH_."lesson_files/".$id_file.".".$value['ext']) ) 
		{ 
			$filename=_UPLOADS_PATH_."lesson_files/".$id_file.".".$value['ext']; 
		}
		else {
			exit ("File does not exist in folder.");
		}
	}
}

// нужен для Internet Explorer, иначе Content-Disposition игнорируется
if(ini_get('zlib.output_compression'))
ini_set('zlib.output_compression', 'Off');
 
$file_extension = strtolower(substr(strrchr($filename,"."),1));
 
if( $filename == "" )
{
	echo "ОШИБКА: не указано имя файла.";
	exit;
} 
/*
elseif ( ! file_exists( $filename ) )
{
	echo "ОШИБКА: данного файла не существует.";
	exit;
}; 
*/
switch($file_extension)
{
	case "pdf": $ctype="application/pdf"; break;
	case "exe": $ctype="application/octet-stream"; break;
	case "zip": $ctype="application/zip"; break;
	case "doc": $ctype="application/msword"; break;
	case "docx": $ctype="application/vnd.openxmlformats-officedocument.wordprocessingml.document"; break;
	case "xls": $ctype="application/vnd.ms-excel"; break;
	// case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
	case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
	case "pptx": $ctype="application/vnd.openxmlformats-officedocument.presentationml.presentation"; break;
	case "mp3": $ctype="audio/mp3"; break;
	case "gif": $ctype="image/gif"; break;
	case "png": $ctype="image/png"; break;  
	case "jpeg":
	case "jpg": $ctype="image/jpg"; break;
	default: $ctype="application/force-download";
} // $ctype="application/force-download";
/* prev
	header("Pragma: "); 
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: "); // нужен для некоторых браузеров
	header("Content-Type: ".$ctype);
	header("Content-Disposition: attachment; filename=".basename($filename).";" );
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".filesize($filename)); // необходимо доделать подсчет размера файла по абсолютному пути
	ob_clean();
	flush();
*/
header('Content-Description: File Transfer');
header('Content-Type: application/force-download'); // octet-stream
header('Content-Disposition: attachment; filename='.basename($filename));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
//header('Content-Length: ' . filesize($filename));
ob_clean();
flush();
readfile($filename);

exit();
?>