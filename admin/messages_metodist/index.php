<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
?>
<link rel="stylesheet" href="<?php echo _ROOT_PATH_;?>css/comment.css" type="text/css"> 
<SCRIPT type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.js"> </SCRIPT> 
<h2>Сообщения методистам</h2>
<?php
require_once _FUNCTIONS_PATH_."f_iden_student.php";
require_once _FUNCTIONS_PATH_."f_iden_group_of_student.php";
require_once _FUNCTIONS_PATH_."f_group_name.php";
$usertype="1";
$query = "SELECT * FROM `"._TABLE_PREFIX_."messages_staff` WHERE (`active` = '1' OR `active` = '2' )  AND (`to`='".$usertype."')  ORDER BY `date` DESC;" ;
$object_messages_staff = new TableQuery;
$object_messages_staff -> order_by_field="id";
$array_messages_staff = $object_messages_staff->query ($query);
if (isset($array_messages_staff) AND !empty($array_messages_staff) AND is_array($array_messages_staff))
{
	////echo "<pre> messages_staff count "; print_r(count($array_messages_staff)); echo "</pre>";
	////echo "<pre> messages_staff "; print_r($array_messages_staff); echo "</pre>";
	$i="0";
	$user_array = array ();
	$new_array = array ();
	foreach ($array_messages_staff as $value) {
		$i++; if($i % 2 == 0)  {  $class="odd"; }  else { $class=""; }  $class="odd";
		if (($value['active']==2) AND ($value['to']==$usertype)) { 
			$new_array[]=$value['from'];
		}
		$user_array[$value['from']]=$value['msg_theme'];
	} // for while
}
else {
	echo "<br><br>У вас нету ни одного сообщения!<br>";
}

//echo "<pre>ARRAY new"; print_r($new_array); echo "</pre>";

if (isset($user_array) AND !empty($user_array))
{
	foreach ($user_array as $id_student => $value)
	{
     	$query = "SELECT COUNT(*) FROM `"._TABLE_PREFIX_."messages_staff` WHERE (`active` = '1' OR `active` = '2')  AND (`to`='".$usertype."' AND `from`='".$id_student."') OR (`from`='".$usertype."' AND `to`='".$id_student."') ORDER BY date DESC;" ;
		$rez_2 = mysql_query($query);
		if(!$rez_2) exit(mysql_error());
		$messages_count = mysql_result($rez_2,0); 	//echo "<br>total ".$messages_count;
		if(mysql_num_rows($rez_2) > 0)
		{
			?>
			<div> <img class="avatar" src="<?php echo _COMMON_DATA_PATH_."images/no_avt.jpg"; ?>"> 
			<div class="comment-content  <?php echo $class;?>">
				<h6>  <?php echo identify_student($id_student);?>  </h6>
				<?php
				$student_group="";
				$student_group=identify_group_of_student($id_student);
				if (!empty($student_group)) {echo identify_group_name($student_group);} else {echo "Без группы";}
				?>
				<div class="p">
				<?php echo $value['msg'];
				if ($messages_count >100) {	echo (float)($messages_count/100); }
				else {
					if ($messages_count==1) {$text=" сообщение";}
					if ($messages_count==2) {$text=" сообщения";}
					if ($messages_count==3) {$text=" сообщения";}
					if ($messages_count==4) {$text=" сообщения";}
					if ($messages_count >=5) {$text=" сообщений";}
				}
				?>

				<br><a href="read.php?id=<?php echo $id_student;?>"><?php echo $messages_count.$text;?></a>
				<?php if(isset($new_array)) {$keys = array_keys($new_array, "".$id_student.""); ?>
					<a href="read.php?id=<?php echo $id_student;?>">
					<?php
					   echo "|  Новых <i class=portal-headline__link__balloon >".count($keys)."</i>";} else {} 
					?></a>
				</div>
			</div>
			</div><br>
			<?php
        }
		else {echo "<br><br>У вас нету ни одного сообщения!<br>";}
	} //foreach
}

require_once _DATA_PATH_."bottom.php";
?>