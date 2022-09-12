<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("groups"); 

is_int_obligatory ($_GET['id']);
is_int_obligatory ($_GET['group']);

$id=$_GET['id'];
$group=$_GET['group'];

if(!empty($_FILES))
{ 
	$filename= $_FILES['filename']['name']; //echo "ok"; exit;
    $ext= pathinfo($filename, PATHINFO_EXTENSION); //echo $ext; exit;
	if($ext == 'pdf' || $ext == 'PDF' || $ext=='doc' || $ext=='DOC' || $ext=='docx' || $ext=='DOCX' )
    { 
		if (isset($_POST['filename'])) { echo $_POST['filename'];}
	    $content = file_get_contents($_FILES['filename']['tmp_name']);  
        unlink($_FILES['filename']['tmp_name']);
	  
        echo "Название файла:    ".$filename;
	  
	    if (file_put_contents(_UPLOADS_PATH_."files/gak/temp/".$id.".".$ext, $content)) 
		{echo "<br>Файл успешно закачен"; } 
	    else {echo "Невозможно сохранить файл";}
		$query="update `"._TABLE_PREFIX_."files/gak` SET
					`filename`='".$id.".".$ext."',
					`ext`='".$ext."'
				    WHERE `id`='".$id."'";
		if(mysql_query($query)) 
        { 
	        $temp_file=_UPLOADS_PATH_."files/gak/temp/".$id.".".$ext;
	        $new_file=_UPLOADS_PATH_."files/gak/".$id.'.'.$ext;
	        if (copy($temp_file,$new_file)) 
			{
				echo "<HTML><HEAD>
                <META HTTP-EQUIV='Refresh' CONTENT='0; URL=gak_files.php?id=".$group."'>
                </HEAD></HTML>";
			} else {echo "Невозможно сохранить файл.";}
		} 
	    else exit("<br>Ошибка при добавлении данных - ".mysql_error()); //.mysql_error() 
        unlink($temp_file);

    }  else {echo "<h3>Выберите Файл или Недопустимый формат файла   </h3>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$filename;}
} else {}


?>

<br><br><a href="gak_files.php?id=<?php echo $group; ?>">Вернуться назад к списку</a><br><br>
<br><br>
<H2>Максимальный размер файла 5 Мега Байт</H2>
<FORM enctype='multipart/form-data' method="POST" action="">
	<input type="file" name="filename" ></input><br><br>
	<input type="submit" value="Прикрепить файл"></input>
</FORM>

Допустимые форматы файлов<br>
<table style="background-color:aqua;">
	<tr><td>PDF, </td><td>.pdf</td></tr>
	<tr><td>MS WORD</td><td>.doc .docx </td></tr>
	<tr><td></td><td></td></tr>
	<tr><td></td><td></td></tr>
	<tr><td></td><td></td></tr>
	<tr><td></td><td></td></tr>
</table>


<?php
require_once _DATA_PATH_."bottom.php";
?>