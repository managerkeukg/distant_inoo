<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

is_int_obligatory ($_GET['id']);
is_int_obligatory ($_GET['id_l']);
$id=$_GET['id'];
$id_l=$_GET['id_l'];

$query="SELECT * FROM `"._TABLE_PREFIX_."courses_text_lesson` WHERE `id`='".$id_l."' AND `status`='1'";
$object_courses_text_lesson= new TableQuery;
$object_courses_text_lesson -> order_by_field="id";
$array_courses_text_lesson = $object_courses_text_lesson -> query ($query);
if (isset($array_courses_text_lesson) AND !empty($array_courses_text_lesson) AND is_array($array_courses_text_lesson))
{
	////echo "<pre> Count courses_text_lesson - "; print_r(count($array_courses_text_lesson)); echo "</pre>";
	////echo "<pre>courses_text_lesson "; print_r($array_courses_text_lesson); echo "</pre>";
	foreach ($array_courses_text_lesson as $value) {
		?>	
		<div style="padding-top: 15; ">
			<p style="color:blue;"><?php echo $value['theme']; ?></p>
			<br>
			<?php echo  $value['text']; ?>
		</div>
		<br><hr>
		<a href="index.php?discipline=<?php echo $id; ?>">Назад</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
		echo "<a href=\"text_lesson_edit.php?id=".$id."&id_l=".$id_l."\">Редактировать урок</a>";
	}
}
  
		
	

require_once _DATA_PATH_."bottom.php";
?>