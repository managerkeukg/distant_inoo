<?php
$i++; 
if($i % 2 == 0)  {  $bgcolor="silver"; } else { $bgcolor="white";}
?>        
<tr style="background-color:<?php echo $bgcolor; ?>; text-align:center;"> 
	<TD>
		<a href="lesson_edit.php?id=<?php echo $array['course'];?>&id_l=<?php echo $array['id'];?>">
			<img src="<?php echo _COMMON_DATA_PATH_;?>images/edit.gif" alt="Edit">
		</a>  <?php echo $array['name']; ?>
	</TD> 
	<TD>
		<?php 
		require "text_lessons.php"; 
		?>
		<a href="text_lesson_add.php?id=<?php echo $array['course'];?>&id_l=<?php echo $array['id'];?>">
			Добавить текстовой урок
		</a>
	</TD>  
	<TD><!-- <a href="">Добавить видео урок</a> --></TD>
	<TD>
		<?php 
		$query = "SELECT * FROM `"._TABLE_PREFIX_."lesson_files`  WHERE ( `id` = '".$array['id']."' )  AND (`status` = '1');";
		$object_lessons_files= new TableQuery;
		$object_lessons_files -> order_by_field="id";
		$array_lessons_files = $object_lessons_files -> query ($query);
		if (isset($array_lessons_files) AND !empty($array_lessons_files)) {
			////echo "<pre>"; print_r($array_lessons_files); echo "</pre>";
			echo "<table>";
			$ext="";
			foreach ($array_lessons_files as $value_lessons_files) {
				require "lesson_files.php";
			}
			echo "</table>";
		}
		?>
		<a href="lesson_file_add.php?id=<?php echo $array['course'];?>&id_l=<?php echo $array['id'];?>">
			Добавить файл
		</a>
	</TD>
	<TD>
		<?php 
		if (isset($array_lessons_files) AND !empty($array_lessons_files)) {
			////echo "<pre>"; print_r($array_lessons_files); echo "</pre>";
			foreach ($array_lessons_files as $value_lessons_files) {
				echo $array_type_lesson[$value_lessons_files['lesson_type']]['name_ru'];
				echo "<br>";
			}
		}
		?>
	</TD>
</tr>