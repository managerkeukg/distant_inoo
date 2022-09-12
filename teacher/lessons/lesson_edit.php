<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

is_int_obligatory ($_GET['id']);
is_int_obligatory ($_GET['id_l']);
$id=$_GET['id'];
$id_l=$_GET['id_l'];
?>
<link href="<?php echo _ROOT_PATH_;?>css/calendar.css" rel="stylesheet">	
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/ui.datepicker.js"></script>
<?php 
$query="SELECT * FROM `"._TABLE_PREFIX_."courses_lesson` where `course`='".$id."' AND `id`='".$id_l."';";
$object_courses_lesson= new TableQuery;
$object_courses_lesson -> order_by_field="id";
$array_courses_lesson = $object_courses_lesson -> query ($query);
if (isset($array_courses_lesson) AND !empty($array_courses_lesson) AND is_array($array_courses_lesson))
{
	////echo "<pre> Count courses_lesson - "; print_r(count($array_courses_lesson)); echo "</pre>";
	////echo "<pre>courses_lesson "; print_r($array_courses_lesson); echo "</pre>";
	foreach ($array_courses_lesson as $array) {
		?>
		<div style="width=100%; margin-left:35px;"> 
			<form action="<?php echo "lesson_update.php?id=".$id."&id_l=".$id_l."";?>" method="post">
				<table>
					<tr>
						<td>Название урока</td>
						<td><input type="text" name="lesson_name" size="100" value="<?php echo $array['name'];?>"></input></td>
					</tr>
					<tr><td></td><td><input type="submit" value="Изменить"></td></tr>
				</table>
			</form>
		</div>
		<?php
	}
}

require_once _DATA_PATH_."bottom.php";
?>



