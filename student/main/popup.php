<?php
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
$query = "SELECT * FROM `"._TABLE_PREFIX_."student_info` where `student` = '"._ID_USER_."' " ;
$object_student_info = new TableQuery;
$object_student_info -> order_by_field="id";
$array_student_info = $object_student_info->query ($query);
if (isset($array_student_info) AND !empty($array_student_info) AND is_array($array_student_info))
{
	////echo "<pre> student_info count "; print_r(count($array_student_info)); echo "</pre>";
	////echo "<pre> student_info "; print_r($array_student_info); echo "</pre>";
} 
else {
	?>
	<div id="parent_popup">
		<div id="popup">
			<h1>Изменение личных данных</h1>
			<h2>Уважаемые студенты!</h2>
			Убедительно просим Вас <strong>заполнить</strong> свои  анкетные данные:
			  
			<p style="text-align: center;"><a class="button" href="student_info.php">Перейти »</a></p>   
			<a class="close" title="Закрыть" onclick="document.getElementById('parent_popup').style.display='none';">X</a>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>delay_popup.js"></script>
	<?php 
}
?>