<?php
$extension="";  $id_file=""; $file_url="";
$extension=$value_lessons_files['ext'];
$id_file=$value_lessons_files['id'];
$file_url="dl_save.php?id=".$id_file; 
////echo "<pre>"; print_r($value_lessons_files); echo "</pre>";
if (empty($value_lessons_files['filename'])) {$filename="1 файл";} else {$filename=$value_lessons_files['filename'];}
echo "<TR>
<td width=\"100\"><p style=\"text-align:left\">".$filename."</p></td>
<td><p style=\"text-align:right\"><a href=".$file_url." target=\"_blank\">скачать</a></p></td>";
?>
<td style="width:15px; text-align:center;">
	<table>
		<tr>
			<td>
				<a href="lesson_files_edit.php?id=<?php echo $id_file;?>&id_s=<?php echo $array['course'];?>">
					<img src="<?php echo _COMMON_DATA_PATH_;?>images/edit.gif" alt="Редактировать">
				</a>
			</td>
			<td>
				<a href="lesson_files_delete.php?id=<?php echo $id_file;?>&id_s=<?php echo $array['course'];?>"  
					onmouseover="increaseSizeImage('<?php echo $id_file;?>');" 
					onmouseout="decreaseSizeImage('<?php echo $id_file;?>');"   
					title="Удалить файл" 
					onclick="return confirm('Вы уверены, что хотите удалить файл?');">
					<img src="<?php echo _COMMON_DATA_PATH_;?>images/delete.gif" id="<?php echo $id_file;?>" >	
				</a>
			</td>
		</tr>
	</table>
</td>
</tr>