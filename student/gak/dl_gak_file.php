<?php
require_once "../security.php";
require_once "../settings.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _COMMON_DATA_PATH_."functions/f_is_int.php";

is_int_obligatory ($_GET['id']);
$id_file=$_GET['id']; 
$query = "SELECT * FROM `"._TABLE_PREFIX_."files_gak`
    WHERE id ='".$id_file."' AND `status`=1";
		  
$object_files_gak = new TableQuery;
$object_files_gak -> order_by_field="id";
$array_files_gak = $object_files_gak->query ($query);
if (isset($array_files_gak) AND !empty($array_files_gak) AND is_array($array_files_gak))
{
	////echo "<pre> files_gak count "; print_r(count($array_files_gak)); echo "</pre>";
	////echo "<pre> files_gak "; print_r($array_files_gak); echo "</pre>";
	foreach ($array_files_gak as $key => $value) {
		if (file_exists(_UPLOADS_PATH_."files/gak/".$id_file.".".$value['ext']) ) 
		{ 
			$filename=_UPLOADS_PATH_."files/gak/".$id_file.".".$value['ext']; 
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
} /* elseif ( ! file_exists( $filename ) ) // проверяем существует ли указанный файл
{
          echo "ОШИБКА: данного файла не существует.";
          exit;
} */
switch( $file_extension )
{
          case "pdf": $ctype="application/pdf"; break;
          case "exe": $ctype="application/octet-stream"; break;
          case "zip": $ctype="application/zip"; break;
          case "doc": $ctype="application/msword"; break;
          case "xls": $ctype="application/vnd.ms-excel"; break;
          case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
          case "mp3": $ctype="audio/mp3"; break;
          case "gif": $ctype="image/gif"; break;
          case "png": $ctype="image/png"; break;  
          case "jpeg":
          case "jpg": $ctype="image/jpg"; break;
          default: $ctype="application/force-download";
}
header("Pragma: "); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: "); // нужен для некоторых браузеров
header("Content-Type: ".$ctype);
header("Content-Disposition: attachment; filename=".basename($filename).";" );
header("Content-Transfer-Encoding: binary");
//header("Content-Length: ".filesize($filename));
readfile($filename);
exit();
?>