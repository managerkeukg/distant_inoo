<?php
$lesson=$array['lesson'];

$query="SELECT * FROM `"._TABLE_PREFIX_."lesson_files` where `lesson`=".$lesson." AND `status`='1';";
$object_lesson_files = new TableQuery;
$object_lesson_files -> order_by_field="id";
$array_lesson_files = $object_lesson_files->query ($query);
if (isset($array_lesson_files) AND !empty($array_lesson_files) AND is_array($array_lesson_files))
{
	////echo "<pre> lesson_files count "; print_r(count($array_lesson_files)); echo "</pre>";
	////			echo "<pre> lesson_files "; print_r($array_lesson_files); echo "</pre>";
	foreach ($array_lesson_files as $key => $value) {
		$file_url="dl_lf.php?id=".$value['id']; 
		echo "<div style=\"text-align:left; padding-top:5;\"> Скачать <a href=\"".$file_url."\">".$value['filename']."</a></div><br>"; 
	}
}
else { echo "no lesson files";}
?>