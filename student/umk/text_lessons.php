<?php
$lesson=$array['lesson'];
$query="SELECT * FROM `"._TABLE_PREFIX_."courses_text_lesson` where `lesson`='".$lesson."'";
$object_text_lessons = new TableQuery;
$object_text_lessons -> order_by_field="id";
$array_text_lessons = $object_text_lessons->query ($query);
if (isset($array_text_lessons) AND !empty($array_text_lessons) AND is_array($array_text_lessons))
{
	////echo "<pre> text_lessons count "; print_r(count($array_text_lessons)); echo "</pre>";
	////	echo "<pre> text_lessons "; print_r($array_text_lessons); echo "</pre>";
	foreach ($array_text_lessons as $key => $value) {
		echo "<div style=\"padding-top:5\"><a href=\"text_lesson.php?id=".$id."&id_l=".$value['id']."\">".$value['theme']."</a></div><br>";	
	}
}
else {
	echo "No text lessons existed";
}
?>