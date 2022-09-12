<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _COMMON_DATA_PATH_."classes/ClassSelectHtml.php";

is_int_obligatory ($_GET['id']);
$id=$_GET['id'];

require_once _FUNCTIONS_PATH_."ft_type_file_umk.php"; 
$array_type_file_umk = table_type_file_umk();
if (isset($array_type_file_umk) AND !empty($array_type_file_umk) AND is_array($array_type_file_umk))
{
	////echo "<pre> Count type_file_umk - "; print_r(count($array_type_file_umk)); echo "</pre>";
	////	echo "<pre>type_file_umk "; print_r($array_type_file_umk); echo "</pre>";
}

if(!empty($_FILES))
{ 
	$name_file= htmlspecialchars(trim($_POST['name_file']));
	$name_file= mysql_real_escape_string ($name_file);
	$umk_type= htmlspecialchars(trim($_POST['umk_type']));
	$umk_type= mysql_real_escape_string ($umk_type);
	
	$filename= $_FILES['filename']['name'];
    $ext= pathinfo($filename, PATHINFO_EXTENSION);
	if($ext == 'pdf' || $ext=='djvu' || $ext=='doc' || $ext=='docx'  ||  $ext=='ppt' || $ext=='pptx' || $ext=='rtf' 
		|| $ext=='txt' || $ext=='xls'  || $ext=='xlsx')
    { 
		if (isset($_POST['filename'])) { echo $_POST['filename'];}
		$content = file_get_contents($_FILES['filename']['tmp_name']);  
		unlink($_FILES['filename']['tmp_name']);
		echo "Название файла:    ".$filename;
		$time=date("d.m.y H\часов.i\мин.s\сек");
		if (file_put_contents(_UPLOADS_PATH_."lesson_files_umk/temp/".$time.".".$ext, $content)) 
		{
			echo "<br>Файл успешно закачен"; 
		} 
		else {echo "Невозможно сохранить файл";}

		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];} else {$ip=$_SERVER["REMOTE_ADDR"];}
		$query = "INSERT INTO `"._TABLE_PREFIX_."course_umk_files`
			VALUES(
				NULL,
				'".$id."',
				'".$name_file."',
				'".$filename."',
				'".$umk_type."',
				'".$ext."',
				'".$ip."',
				now(),
				'',
				'',
				'1'
			)
		";
		if(mysql_query($query)) 
		{ 
			$lastid=mysql_insert_id(); 
			$temp_file=_UPLOADS_PATH_."lesson_files_umk/temp/".$time.".".$ext;
			$new_file=_UPLOADS_PATH_."lesson_files_umk/".$lastid.'.'.$ext;
			if (copy($temp_file,$new_file)) 
			{
				echo "<HTML><HEAD>
				<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?discipline=".$id."'>
				</HEAD></HTML>";
			} else {echo "Невозможно сохранить файл.";}
		} 
		else exit("Ошибка при добавлении данных - ".mysql_error()); //.mysql_error() 
		unlink($temp_file);
    }  else {echo "<h3>Недопустимый формат файла   </h3>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$filename;}
} 
?>
<br><br><a href="index.php?discipline=<?php echo $id; ?>">Вернуться назад к списку </a><br><br>
<br><br>

<FORM enctype='multipart/form-data' method="POST" action="add.php?id=<?php echo $id; ?>">
	Тип УМК
	
	<?php
	$object_select_groups = new SelectHtml5;
	$object_select_groups -> id = "umk_type";
	$object_select_groups -> name = "umk_type";
	//$object_select_groups -> form = "form_id";
	$object_select_groups -> autofocus = "autofocus";
	//$object_select_groups -> multiple = "multiple";
	$object_select_groups -> required = "required";
	$object_select_groups -> size = "1";

	$object_select_groups -> array_options_table = $array_type_file_umk;
	$object_select_groups -> array_options_table_value = "id";
	$object_select_groups -> array_options_table_label = "name_ru";

	$object_select_groups -> option_default=" выбрать ";
	//$object_select_groups -> selected_value = "1";
	echo $object_select_groups -> display ();
	?>
	<br>
	Введите название файла умк  
	<input type="text" id="name_file" name="name_file" size="50" value="<?php if (isset($_POST['name_file'])) { echo $_POST['name_file']; } ?>"></input><br>
	<input type="file" name="filename" ></input><br><br>
	<input type="submit" value="Прикрепить файл" onclick="if(document.getElementById('name_file').value==0) {alert('Поле название файла умк пустое!'); return false; }">
	</input>
</FORM>

Допустимые форматы книг<br>
<table style="background-color:aqua;">
	<tr><td>.pdf</td><td>Adobe PDF</td></tr>
	<tr><td>.djvu</td><td></td></tr>
	<tr><td>.doc</td><td>Microsoft Word 2003</td></tr>
	<tr><td>.docx</td><td>Microsoft Word 2007-2010</td></tr>
	<tr><td>.ppt</td><td>Microsoft PowerPoint 2003</td></tr>
	 <tr><td>.pptx</td><td>Microsoft PowerPoint 2007-2010</td></tr>
	<tr><td>.rtf</td><td>Microsoft Word RTF</td></tr>
	<tr><td>.txt</td><td>Блокнот</td></tr>
	<tr><td>.xls</td><td>Microsoft Excel 2003</td></tr>
	<tr><td>.xlsx</td><td>Microsoft Excel 2007-2010</td></tr> 
	<tr><td></td><td></td></tr>
	<tr><td></td><td></td></tr>
	<tr><td></td><td></td></tr>
	<tr><td></td><td></td></tr>
</table>
<?php

require_once _DATA_PATH_."bottom.php";
?>

