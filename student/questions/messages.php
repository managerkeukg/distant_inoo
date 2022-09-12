<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _FUNCTIONS_PATH_."f_iden_student.php";
require_once _FUNCTIONS_PATH_."f_message.php";
	
is_int_obligatory ($_GET['id']);
$id_staff=$_GET['id'];

if ($_GET['id']<12) 
{} else {
	echo "Недопустимый формат URL-запроса";  exit;
}
?>
<link href="<?php echo _ROOT_PATH_;?>css/comment.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.js"></script> 
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
$fio_text= $array_staff[$id_staff]['duty']." ".$array_staff[$id_staff]['degree']." ".$array_staff[$id_staff]['surname']." ".$array_staff[$id_staff]['name']." ".$array_staff[$id_staff]['patronymic'];
require_once "f_iden_student.php";
?>
<h2><a href="index.php">Сообщения с другими сотрудниками ИНОО</a></h2><hr>
<h3><p style="color:blue;"><?php echo $fio_text; ?></p></h3>

<form   method="POST" action="message_update.php">
	<div style="text-align:center;">
		<textarea cols="80%" rows="10"  name="letter" id="letter"></textarea>
		<img class="avatar" src="<?php echo _UPLOADS_PATH_."images/staff/".$array_staff[$id_staff]['photo'];?>"> 
	</div>
		<br>
		<input type="submit" style="text-align:right;" value="Отправить"></input>&nbsp;&nbsp;
		<input type="hidden" name="id_staff" value="<?php echo $id_staff;?>"></input>
		<input type="button" style="text-align:right;" value="Очистить текст" onclick="$('#letter').val('');"></input>
	<br>
</form>
<br><br>
<h3>Архив сообщений с 
	<p style="color:blue;">
		<?php 
			echo $fio_text;
		?>
	</p>
</h3><br>
<?php
$query = "SELECT * FROM `"._TABLE_PREFIX_."messages_staff` WHERE (`active` = '1' OR `active` = '2' )  AND ((`to`='"._ID_USER_."' 
	AND `from`='".$id_staff."') 
	OR (`from`='"._ID_USER_."' AND `to`='".$id_staff."')) ORDER BY `date` DESC;" ;
$object_messages_staff = new TableQuery;
$object_messages_staff -> order_by_field="id";
$array_messages_staff = $object_messages_staff->query ($query);
if (isset($array_messages_staff) AND !empty($array_messages_staff) AND is_array($array_messages_staff))
{
	////echo "<pre> messages_staff count "; print_r(count($array_messages_staff)); echo "</pre>";
	////	echo "<pre> messages_staff "; print_r($array_messages_staff); echo "</pre>";
	$msg_array = array ();
	foreach ($array_messages_staff as $value) {
		if ($value['from']<7)
		{ 
			$value['fio'] = $fio_text;
			$value['photo']=_UPLOADS_PATH_."images/staff/".$array_staff[$id_staff]['photo'];
		} else {
			$value['fio']=trim(identify_student($value['from']));
			$value['photo']=""._ROOT_PATH_."images/no_avt.jpg";
		}
		$msg_array[]=$value;
	}
	$query="update `"._TABLE_PREFIX_."messages_staff` SET 
		`active`='1'
		WHERE  (`active`='2') AND (`to`='"._ID_USER_."') AND (`from`='".$id_staff."')";
   
	$cat = mysql_query($query);
	if($cat)  { }  else {}
}
else {
	echo "<br><br>У вас нету ни одного сообщения!<br>";
}

 
if (isset($msg_array) AND !empty($msg_array) )
{  
	//echo "<pre>"; print_r($msg_array); echo "</pre>";
	show_messages (_ID_USER_, $id_staff, $msg_array);
}
 
require_once _DATA_PATH_."bottom.php";
?>
