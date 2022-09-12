<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 
require_once _FUNCTIONS_PATH_."ft_type_lesson.php"; 

is_int_obligatory ($_GET['id']);
is_int_obligatory ($_GET['id_s']);
$id=$_GET['id'];
$id_course=$_GET['id_s'];

$array_type_lesson = table_type_lesson();
if (isset($array_type_lesson) AND !empty($array_type_lesson) AND is_array($array_type_lesson))
{
	////echo "<pre> Count type_lesson - "; print_r(count($array_type_lesson)); echo "</pre>";
	////	echo "<pre>type_lesson "; print_r($array_type_lesson); echo "</pre>";
}

$query="SELECT * FROM `"._TABLE_PREFIX_."lesson_files` where `id`=".$id." AND (`status` = '1');";
$object_lesson_files= new TableQuery;
$object_lesson_files -> order_by_field="id";
$array_lesson_files = $object_lesson_files -> query ($query);
if (isset($array_lesson_files) AND !empty($array_lesson_files) AND is_array($array_lesson_files))
{
	////echo "<pre> Count lesson_files - "; print_r(count($array_lesson_files)); echo "</pre>";
	////echo "<pre>lesson_files "; print_r($array_lesson_files); echo "</pre>";
	foreach ($array_lesson_files as $value) {
		?>
		<DIV style="width:100%; margin-left:35px;"> 
			<FORM enctype='multipart/form-data' method="POST" action="<?php echo "lesson_files_update.php?id=".$id."&id_course=".$id_course."";?>">
				<TABLE>
					<TR>
						<TD>Тип урока</TD>
						<TD>
							<SELECT name="lesson_type">
								<OPTION value="" <?php if($value['lesson_type']=='0') { echo "selected";} ?> >выбрать</OPTION>
								<?php 
								foreach ($array_type_lesson as $value_type_lesson) {
									echo "<OPTION value=\"".$value_type_lesson['id']."\"";
									if($value['lesson_type']==$value_type_lesson['id']) { echo "selected";}
									echo ">"; 
									echo $value_type_lesson['name_ru']."</OPTION>";
								}
								?>
							</SELECT>
						</TD>
					</TR>
					<TR>
						<TD>Введите название файла урока</TD>
						<TD><input type="text" id="name_file" name="name_file" size="50" value="<?php if (empty($value['name'])) {echo $value['filename'];} else {echo $value['name'];} ?>"></input>
						</TD>
					</TR>
					<TR>
						<TD></TD>
						<TD><input type="submit" value="Изменить" onclick="if(document.getElementById('name_file').value==0) {alert('Поле название файла умк пустое!'); return false; }"></input>
						</TD>
					</TR>
				</TABLE>
			</FORM>
		</DIV>
		<?php
	}
}else {
	echo "<BR>К сожалению  нет записей <BR>";
}
	
require_once _DATA_PATH_."bottom.php";
?>