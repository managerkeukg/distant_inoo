<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _FUNCTIONS_PATH_."ft_type_lesson.php";

if(isset($_GET['id'])) { is_int_obligatory ($_GET['id']); }  else {exit("Недопустимый формат URL-запроса");}  
if(isset($_GET['id_l'])) { is_int_obligatory ($_GET['id_l']); }  else {exit("Недопустимый формат URL-запроса");} 
$id=$_GET['id'];
$id_l=$_GET['id_l'];

$array_type_lesson = table_type_lesson();
if (isset($array_type_lesson) AND !empty($array_type_lesson) AND is_array($array_type_lesson))
{
	////echo "<pre> Count type_lesson - "; print_r(count($array_type_lesson)); echo "</pre>";
	////echo "<pre>type_lesson "; print_r($array_type_lesson); echo "</pre>";
}

if(!empty($_FILES))
{ 
	$filename= $_FILES['filename']['name'];
    $ext= pathinfo($filename, PATHINFO_EXTENSION);
	$lesson_type= htmlspecialchars(trim($_POST['lesson_type']));
	////$lesson_type=mysql_real_escape_string ($lesson_type);
	$name_file= htmlspecialchars(trim($_POST['name_file']));
	$name_file=mysql_real_escape_string ($name_file);
	if($ext == 'pdf' || $ext=='djvu' || $ext=='doc' || $ext=='docx'  ||  $ext=='ppt' || $ext=='pptx' || $ext=='rtf' 
		|| $ext=='txt' || $ext=='xls'  || $ext=='xlsx')
    { 
		if (isset($_POST['filename'])) { echo $_POST['filename'];}
		$content = file_get_contents($_FILES['filename']['tmp_name']);  
		unlink($_FILES['filename']['tmp_name']);
		echo "Название файла:    ".$filename;
		$time=date("d.m.y H\часов.i\мин.s\сек");
		if (file_put_contents(_UPLOADS_PATH_."lesson_files/temp/".$time.".".$ext, $content)) 
		{
			echo "<br>Файл успешно закачен"; 
		} 
		else {echo "Невозможно сохранить файл";}
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];} else {$ip=$_SERVER["REMOTE_ADDR"];}
		$query = "INSERT INTO `"._TABLE_PREFIX_."lesson_files`
		VALUES(
			NULL,
			'".$id_l."',
			'".$name_file."',
			'".$filename."',
			'".$lesson_type."',
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
	        $temp_file=_UPLOADS_PATH_."lesson_files/temp/".$time.".".$ext;
	        $new_file=_UPLOADS_PATH_."lesson_files/".$lastid.'.'.$ext;
	        if (copy($temp_file,$new_file)) 
			{
				echo "<HTML><HEAD>
                <META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?discipline=".$id."'>
                </HEAD></HTML>";
			} else {echo "Невозможно сохранить файл.";}
		} 
		else exit("Ошибка при добавлении данных - ".mysql_error()); //.mysql_error() 
		unlink($temp_file);
    }  else {
		echo "Недопустимый формат файла      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$filename;
	}
} 
?>
<br><br><a href="index.php?discipline=<?php echo $id; ?>">Вернуться назад к списку </a><br><br>
<br><br>

<FORM enctype='multipart/form-data' method="POST" action="lesson_file_add.php?id=<?php echo $id; ?>&id_l=<?php echo $id_l; ?>">
	<table>
		<TR><TD>Тип Урока</TD>
			<TD>
				<SELECT name="lesson_type" required>
					<OPTION value="">выбрать</OPTION>
					<?php 
					foreach ($array_type_lesson as $value) {
						echo "<OPTION value=\"".$value['id']."\">".$value['name_ru']."</OPTION>";
					}
					?>
				</SELECT>
			</TD>
		</TR>
		<TR><TD>Введите название файла урока</TD>
			<TD><input type="text" id="name_file" name="name_file" size="50" value="<?php if (isset($_POST['name_file'])) { echo $_POST['name_file']; } ?>"></input>
			</TD>
		</TR>
		<TR><TD></TD>
			<TD><input type="file" name="filename" ></input></TD>
		</TR>
		<TR><TD></TD>
			<TD><input type="submit" value="Добавить запись" onclick="if(document.getElementById('name_file').value==0) {alert('Поле название файла  пустое!'); return false; }"></input>
			</TD>
		</TR>
	</table>	
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


