<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
?>
<link rel="stylesheet" href="<?php echo _ROOT_PATH_;?>css/comment.css" type="text/css">   
<link href="<?php echo _ROOT_PATH_;?>css/show.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.js"></script> 
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/show.js"></script> 

<h2>Мои сообщения</h2>

<a href="message_create.php">Написать сообщение сотрудникам ИНОО</a><br><br>
<?php
$query = "SELECT * FROM `"._TABLE_PREFIX_."staff`
    WHERE  `status`='1';";
$object_staff= new tableQuery;

$object_staff->order_by_field="id";
$array_staff=$object_staff -> query ($query);
if (isset($array_staff) AND !empty($array_staff)) {
	////echo count($array_staff)." записей";
	////echo "<pre>staff "; print_r($array_staff); echo "</pre>"; 
}

$query = "SELECT * FROM `"._TABLE_PREFIX_."messages_staff` WHERE (`to`='"._ID_USER_."') OR (`from`='"._ID_USER_."') AND (`active` = '1' OR `active` = '2')  ORDER BY date DESC;" ;

$object_messages_staff = new TableQuery;
$object_messages_staff -> order_by_field="id";
$array_messages_staff = $object_messages_staff->query ($query);
if (isset($array_messages_staff) AND !empty($array_messages_staff) AND is_array($array_messages_staff))
{
	////echo "<pre> messages_staff count "; print_r(count($array_messages_staff)); echo "</pre>";
	////	echo "<pre> messages_staff "; print_r($array_messages_staff); echo "</pre>";
	$new_array =array ();
	$new_array[]=0;
	$user_array =array ();
	foreach ($array_messages_staff as $value) {
		if (($value['active']==2) AND ($value['to']==_ID_USER_)) { $new_array[]=$value['from'];}
		if (($value['from']==_ID_USER_))  {$user_array[$value['to']]=$value['to'];} else {$user_array[$value['from']]=$value['from'];}
	}
}
else {
	echo "<br><br>У вас нету ни одного сообщения!<br>";
}

	
//echo "<pre>ARRAY new"; print_r($new_array); echo "</pre>";
//   echo "<pre>ARRAY new"; print_r(array_flip($new_array)); echo "</pre>";          
// echo "<pre> user_array "; print_r($user_array); echo "</pre>";

if (isset($user_array) AND !empty($user_array))
{
	foreach ($user_array as $id_staff => $value)
	{
		echo "<DIV  style=\"max-width:80%;\"  >";     
		$query = "SELECT * FROM `"._TABLE_PREFIX_."messages_staff` WHERE (`active` = '1' OR `active` = '2')   
			AND (`to`='"._ID_USER_."' AND `from`='".$id_staff."') OR (`from`='"._ID_USER_."' AND `to`='".$id_staff."') 
			ORDER BY date DESC; " ;
		$object_messages_staff = new TableQuery;
		$object_messages_staff -> order_by_field="id";
		$array_messages_staff = $object_messages_staff->query ($query);
		if (isset($array_messages_staff) AND !empty($array_messages_staff) AND is_array($array_messages_staff))
		{
			////echo "<pre> messages_staff count "; print_r(count($array_messages_staff)); echo "</pre>";
			////echo "<pre> messages_staff "; print_r($array_messages_staff); echo "</pre>";
			$messages_count = count($array_messages_staff);
			if (!empty($array_staff[$id_staff])) 
			{
				?>
				<div> 
					<img class="avatar" src="<?php echo _UPLOADS_PATH_."images/staff/".$array_staff[$id_staff]['photo']; ?>"> 
					<div class="comment-content  <?php echo $class;?>">
						<h6><?php  echo $array_staff[$id_staff]['duty']." ".$array_staff[$id_staff]['degree']." ".$array_staff[$id_staff]['surname']." ".$array_staff[$id_staff]['name']." ".$array_staff[$id_staff]['patronymic'];  ?></h6>
						<div class="p">
							<?php 
							if ($messages_count >100) {	echo (float)($messages_count/100); }
							else {
								if ($messages_count==1) {$text=" сообщение";}
								if ($messages_count==2) {$text=" сообщения";}
								if ($messages_count==3) {$text=" сообщения";}
								if ($messages_count==4) {$text=" сообщения";}
								if ($messages_count >=5) {$text=" сообщений";}
							}
							?>
							<br><a href="messages.php?id=<?php echo $id_staff;?>"><?php echo $messages_count.$text;?></a> |  
							<?php if(isset($new_array)) {$keys = array_keys($new_array, "".$id_staff.""); ?>
								<a href="messages.php?id=<?php echo $id_staff;?>">
							<?php
							echo "Новых <i class=portal-headline__link__balloon >".count($keys)."</i> | ";} else {} 
							?></a> 
							<a href="messages.php?id=<?php echo $id_staff;?>">написать</a>
						</div>
					</div>
				</div><br>
				<?php
			}
        }
		else {
			echo "<br><br>У вас нету ни одного сообщения!<br>";
		}
		echo "</DIV>";				  
	} //foreach
}

require_once _DATA_PATH_."bottom.php";
?>