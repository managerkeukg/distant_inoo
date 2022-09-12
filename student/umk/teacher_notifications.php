<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _COMMON_DATA_PATH_."functions/f_is_int.php";
?>
<br><br>
<p style="color:green;">Объявления преподавателя группе</p>
<br><br>
<div style="text-align:left;"><a href="index.php">Назад</a></div>
<?php
if (isset($_GET['group']) AND !empty($_GET['group'])) {is_int_obligatory ($_GET['group']);} else {exit('access restricted');}
if (isset($_GET['course']) AND !empty($_GET['course'])) {is_int_obligatory ($_GET['course']);} else {exit('access restricted');}
$id = $_GET['group'];  $course = $_GET['course'];
$query = "SELECT * FROM `"._TABLE_PREFIX_."group_messages_teacher` where `status`='1' AND `group`="._USER_GROUP_."  AND `course`='".$course."'  ORDER BY `id`;";
$object_group_messages_teacher = new TableQuery;
$object_group_messages_teacher -> order_by_field="id";
$array_group_messages_teacher = $object_group_messages_teacher->query ($query);
if (isset($array_group_messages_teacher) AND !empty($array_group_messages_teacher) AND is_array($array_group_messages_teacher))
{
	////echo "<pre> group_messages_teacher count "; print_r(count($array_group_messages_teacher)); echo "</pre>";
	////	echo "<pre> group_messages_teacher "; print_r($array_group_messages_teacher); echo "</pre>";
	foreach ($array_group_messages_teacher as $key => $value) {
		?>	
		<div class="cnsnt_info" style="padding-top: 5; ">
			<p style="color:blue;"><?php echo  $value['title']; ?></p>
			<div class="summary"></div>
			<br>
			<?php echo  $value['message']; ?>
			<div style="text-align:right;">Дата:&nbsp;&nbsp;&nbsp; <?php echo  $value['date']; ?></div>
		</div>
		<br>
		<?php
	}
}
else {
	echo "<BR>К сожалению пока нет Объявлений вашей группе<BR>";
}
	  
require_once _DATA_PATH_."bottom.php";	  
?>
