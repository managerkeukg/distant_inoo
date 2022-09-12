<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
is_int_obligatory ($_GET['id']);
$id=$_GET['id']; $id_l=$_GET['id_l'];
$query="SELECT * FROM `"._TABLE_PREFIX_."courses_text_lesson` WHERE `id`=".$id_l.";";
$object_text_lessons = new TableQuery;
$object_text_lessons -> order_by_field="id";
$array_text_lessons = $object_text_lessons->query ($query);
if (isset($array_text_lessons) AND !empty($array_text_lessons) AND is_array($array_text_lessons))
{
	////echo "<pre> text_lessons count "; print_r(count($array_text_lessons)); echo "</pre>";
	////			echo "<pre> text_lessons "; print_r($array_text_lessons); echo "</pre>";
	foreach ($array_text_lessons as $key => $value) {
		?>	
		<div style="padding-top: 15; ">
			<p style="color:blue;"><?php echo $value['theme']; ?></p>
			<br>
			<?php echo  $value['text']; ?>
		</div>
		<br><hr>
		<a href="index.php?id=<?php echo $id; ?>">Назад</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
	}
}
require_once _DATA_PATH_."bottom.php";
?>