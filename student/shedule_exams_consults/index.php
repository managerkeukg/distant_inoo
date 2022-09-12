<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
?>
<h2 style="background-color:#023183; color:white; padding:2px 2px;">Расписания проведения консультационных занятий для всех групп</h2>
<DIV style="width:800px">
<?php
$query = "SELECT * FROM `"._TABLE_PREFIX_."consult_shedule_all` where `status`='1' ORDER BY `id`";
$object_consult_shedule_all = new TableQuery;
$object_consult_shedule_all -> order_by_field="id";
$array_consult_shedule_all = $object_consult_shedule_all->query ($query);
if (isset($array_consult_shedule_all) AND !empty($array_consult_shedule_all) AND is_array($array_consult_shedule_all))
{
	////echo "<pre> consult_shedule_all count "; print_r(count($array_consult_shedule_all)); echo "</pre>";
	////echo "<pre> consult_shedule_all "; print_r($array_consult_shedule_all); echo "</pre>";
	foreach ($array_consult_shedule_all as $value) {
		echo "<hr><h4>".$value['title']."</h4>";
		echo $value['text'];
	}
}
else {
	echo "Нет записей";
}

?>
<br><br><br>
<h2  style="background-color:#023183; color:white; padding:2px 2px;">Расписания проведения консультационных занятий для группы 
	<?php echo _USER_GROUP_NAME_;?>
</h2>
<?php

if (isset($student_group) AND !empty($student_group))
{
	$query = "SELECT * FROM `"._TABLE_PREFIX_."consult_shedule` where `status`='1' AND `group`=".$student_group." ORDER BY `id`;";
	$object_consult_shedule = new TableQuery;
	$object_consult_shedule -> order_by_field="id";
	$array_consult_shedule = $object_consult_shedule->query ($query);
	if (isset($array_consult_shedule) AND !empty($array_consult_shedule) AND is_array($array_consult_shedule))
	{
		////echo "<pre> consult_shedule count "; print_r(count($array_consult_shedule)); echo "</pre>";
		////echo "<pre> consult_shedule "; print_r($array_consult_shedule); echo "</pre>";
		foreach ($array_consult_shedule as $value) {
			echo "<hr>".$value['text'];
		}
	} else { 
		echo "Нет записей";
	}
} else { 
	echo "К сожалению Вас не добавили к группе. Просмотр невозможен. Обратитесь к администратору.";
}
?>
</DIV>
<?php

require_once _DATA_PATH_."bottom.php";
?>