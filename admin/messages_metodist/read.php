<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";

is_int_obligatory ($_GET['id']);
$id_student=$_GET['id'];
?>
<link rel="stylesheet" href="<?php echo _ROOT_PATH_;?>css/comment.css" type="text/css"> 
<SCRIPT type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.js"> </SCRIPT> 
<?php
require_once _FUNCTIONS_PATH_."f_iden_student.php";
?>
<h2><a href="index.php">Сообщения с другими студентами</a></h2><hr>
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

$usertype="1";
$id_staff = $usertype;
$fio_text= $array_staff[$id_staff]['duty']." ".$array_staff[$id_staff]['degree']." ".$array_staff[$id_staff]['surname']." ".$array_staff[$id_staff]['name']." ".$array_staff[$id_staff]['patronymic'];

$query = "SELECT * FROM `"._TABLE_PREFIX_."messages_staff` WHERE (`active` = '1' OR `active` = '2' )  AND (`to`='".$usertype."' OR `to`='".$id_student."') AND (`from`='".$id_student."' OR `from`='".$usertype."') ORDER BY `date` DESC;" ;
$object_messages_staff = new TableQuery;
$object_messages_staff -> order_by_field="id";
$array_messages_staff = $object_messages_staff -> query ($query);
if (isset($array_messages_staff) AND !empty($array_messages_staff) AND is_array($array_messages_staff))
{
	////echo "<pre> messages_staff count "; print_r(count($array_messages_staff)); echo "</pre>";
	////echo "<pre> messages_staff "; print_r($array_messages_staff); echo "</pre>";
	foreach ($array_messages_staff as $value) {
		if ($value['from']<7)
		{ 
			$value['fio']=$fio_text;
			$value['photo']=_UPLOADS_PATH_."images/staff/".$array_staff[$id_staff]['photo'];
		} else {
			$value['fio']=trim(identify_student($value['from']));
			$value['photo']=_COMMON_DATA_PATH_."images/no_avt.jpg";
		}
		$msg_array[]=$value;
	} // for while
} // end if no rows
else {echo "<br><br>У вас нету ни одного сообщения!<br>";}
 
if (isset($msg_array) AND !empty($msg_array) )
{  
	//echo "<pre>"; print_r($msg_array); echo "</pre>";
	require_once _FUNCTIONS_PATH_."f_message.php";
	show_messages ($usertype, $id_student, $msg_array);
}

require_once _DATA_PATH_."bottom.php";
?>