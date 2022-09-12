<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
?>
<br><br>
<p style="color:green;">Объявления группе</p>
<br><br>
<?php
if (isset($student_group) AND !empty($student_group))
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."group_messages` where `status`='1' AND `group`=".$student_group." ORDER BY `id`;";
	$object_group_messages = new TableQuery;
	$object_group_messages -> order_by_field="id";
	$array_group_messages = $object_group_messages->query ($query);
	if (isset($array_group_messages) AND !empty($array_group_messages) AND is_array($array_group_messages))
	{
		////echo "<pre> group_messages count "; print_r(count($array_group_messages)); echo "</pre>";
		////	echo "<pre> group_messages "; print_r($array_group_messages); echo "</pre>";
		foreach ($array_group_messages as $key => $value) {
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
	} else {
		echo "<BR>К сожалению пока нет Объявлений вашей группе<BR>";
	}
} else { 
	echo "К сожалению Вас не добавили к группе. Просмотр невозможен. Обратитесь к администратору.";
}

require_once _DATA_PATH_."bottom.php";
?>