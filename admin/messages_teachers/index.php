<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("messages_teachers");
?>
<link rel="stylesheet" href="<?php echo _ROOT_PATH_;?>css/comment.css" type="text/css">
<h2>Сообщения преподавателям</h2>
<?php
$query = "SELECT * FROM `"._TABLE_PREFIX_."subject_messages` WHERE  `active`=1 ORDER BY date DESC ";
$object_subject_messages = new TableQuery;
$object_subject_messages -> order_by_field="id";
$array_subject_messages = $object_subject_messages->query ($query);
if (isset($array_subject_messages) AND !empty($array_subject_messages) AND is_array($array_subject_messages))
{
	////echo "<pre> subject_messages count "; print_r(count($array_subject_messages)); echo "</pre>";
	////echo "<pre> subject_messages "; print_r($array_subject_messages); echo "</pre>";
	require_once _FUNCTIONS_PATH_."f_iden_student.php";  
	require_once _FUNCTIONS_PATH_."f_iden_teacher.php";
	$i=0;
	foreach ($array_subject_messages as $value) {
		$i++;
		if($i % 2 == 0)
		{  
			$class="odd"; 
		} else { $class=""; }
			?>
		<li id="<?php echo $value['id'];?>"><img class="avatar" src="<?php echo _COMMON_DATA_PATH_."images/no_avt.jpg"; ?>">
			<div class="comment-content  <?php echo $class;?>">
				<div class="vcorner"></div>
				<small class="date"><?php echo $value['date'];?></small>
				<h6>  
					<?php  
					if ($value['from']=='2') 
					{
						echo "От (студент) ".identify_student($value['student']);
						echo "<br><br>Кому (преп.) ".identify_teacher($value['teacher']);
					} 
					elseif ($value['from']=='1') 
					{
						echo "От (преп.) ".identify_teacher($value['teacher']);
						echo "<br><br>Кому (студент) ".identify_student($value['student']);
					}?>  
				</h6>
				<h6> Тема :<?php echo $value['msg_theme']; ?>  </h6>
				<div class="p"><?php echo $value['msg'];?></div>
			</div>
		</li>
		<?php
	}
} else {}

require_once _DATA_PATH_."bottom.php";
?>