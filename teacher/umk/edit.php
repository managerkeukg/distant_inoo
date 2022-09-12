<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _COMMON_DATA_PATH_."classes/ClassSelectHtml.php";

is_int_obligatory ($_GET['id']);
is_int_obligatory ($_GET['course']);
$id=$_GET['id'];
$course=$_GET['course'];

require_once _FUNCTIONS_PATH_."ft_type_file_umk.php"; 
$array_type_file_umk = table_type_file_umk();
if (isset($array_type_file_umk) AND !empty($array_type_file_umk) AND is_array($array_type_file_umk))
{
	////echo "<pre> Count type_file_umk - "; print_r(count($array_type_file_umk)); echo "</pre>";
	////	echo "<pre>type_file_umk "; print_r($array_type_file_umk); echo "</pre>";
}

$query="SELECT * FROM `"._TABLE_PREFIX_."course_umk_files` where `id`='".$id."';";
$object_courses_text_lesson= new TableQuery;
$object_courses_text_lesson -> order_by_field="id";
$array_courses_text_lesson = $object_courses_text_lesson -> query ($query);
if (isset($array_courses_text_lesson) AND !empty($array_courses_text_lesson) AND is_array($array_courses_text_lesson))
{
	////echo "<pre> Count courses_text_lesson - "; print_r(count($array_courses_text_lesson)); echo "</pre>";
	////echo "<pre>courses_text_lesson "; print_r($array_courses_text_lesson); echo "</pre>";
	foreach ($array_courses_text_lesson as $array) {
		?>
		<DIV style="width=100%; margin-left:35px;"> 
			<FORM enctype='multipart/form-data' method="POST" action="<?php echo "update.php?id=".$id."&course=".$course."";?>">
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
				$object_select_groups -> selected_value = $array['umk_type'];
				echo $object_select_groups -> display ();
				?>
				<br>
				Введите название файла умк  
				<input type="text" id="name_file" name="name_file" size="50" value="<?php echo $array['name'];?>"></input><br>
				<!-- <input type="file" name="filename" ></input><br><br> -->
				<input type="submit" value="Изменить" onclick="if(document.getElementById('name_file').value==0) {alert('Поле название файла умк пустое!'); return false; }"></input>
			</FORM>
		</DIV>
		<!-- <input type="text" name="category_name" size="50" value="<?php echo $array['category_name'];?>" ></input> -->
		<?php
	}
}

require_once _DATA_PATH_."bottom.php";
?>