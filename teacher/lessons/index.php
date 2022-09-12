<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _FUNCTIONS_PATH_."ft_type_lesson.php"; 

echo "<h3>Лекции дисциплины</h3>";

is_int_obligatory ($_GET['discipline']);
$discipline = $_GET['discipline'];

$array_type_lesson = table_type_lesson();
if (isset($array_type_lesson) AND !empty($array_type_lesson) AND is_array($array_type_lesson))
{
	////echo "<pre> Count type_lesson - "; print_r(count($array_type_lesson)); echo "</pre>";
	////echo "<pre>type_lesson "; print_r($array_type_lesson); echo "</pre>";
}

$query="SELECT * FROM `"._TABLE_PREFIX_."courses_lesson` where `course`='".$discipline."' AND `status`='1';";

$object_lessons= new TableQuery;
$object_lessons -> order_by_field="id";
$array_lessons = $object_lessons -> query ($query);
if (isset($array_lessons) AND !empty($array_lessons)) {
	////echo "<pre>"; print_r($array_lessons); echo "</pre>";
	?>
	<table class="table_default">
		<thead>
			<tr class="tr_head">
				<th width="15%">Название урока</th>
				<th>Текстовые уроки</th> 
				<th>Видео уроки</th>
				<th>Файлы</th>
				<th>Тип Файла</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i=0;
		foreach ($array_lessons as $array) {
			require "index_help.php";
		}
		?>
		</tbody>
	</table> 
	<?php
} else {
	echo "<BR>К сожалению пока нет ни одного урока<BR>";
}
?>
<br>
<br>
<a href="lesson_add.php?id=<?php echo $discipline;?>">Добавить новый урок?</a>
<br>
<?php

require_once _DATA_PATH_."bottom.php";
?>