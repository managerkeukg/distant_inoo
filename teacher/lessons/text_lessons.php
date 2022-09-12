<?php
$lesson=$array['id'];
$query="SELECT * FROM `"._TABLE_PREFIX_."courses_text_lesson` where `lesson`='".$lesson."' AND `status`='1'";
$object_courses_text_lesson= new TableQuery;
$object_courses_text_lesson -> order_by_field="id";
$array_courses_text_lesson = $object_courses_text_lesson -> query ($query);
if (isset($array_courses_text_lesson) AND !empty($array_courses_text_lesson) AND is_array($array_courses_text_lesson))
{
	////echo "<pre> Count courses_text_lesson - "; print_r(count($array_courses_text_lesson)); echo "</pre>";
	////echo "<pre>courses_text_lesson "; print_r($array_courses_text_lesson); echo "</pre>";
	echo "<table class=\"table\" >";
	foreach ($array_courses_text_lesson as $value) {
		if(empty($value['theme'])) {$theme_name="Без названия";} else {$theme_name=$value['theme'];}
		echo "
		<tr>
			<td>
				<a href=\"text_lesson_view.php?id=".$discipline."&id_l=".$value['id']."\">".$theme_name."</a>
			</td>"; 
		?> 
			<td>
				<a href="text_lessons_delete.php?id=<?php echo $value['id'];?>&id_s=<?php echo $array['course'];?>"  
					onmouseover="increaseSizeImage('<?php //echo $id_text_lesson;?>');"
					onmouseout="decreaseSizeImage('<?php echo $value['id'];?>');"   
					title="Удалить урок"
					onclick="return confirm('Вы уверены, что хотите удалить урок?');">
					<img src="<?php echo _COMMON_DATA_PATH_;?>images/delete.gif" id="<?php echo $value['id'];?>">
				</a>
			</td>
		</tr>
		<?php
	}
	echo "</table>";
}
?>