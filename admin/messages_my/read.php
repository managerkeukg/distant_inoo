<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("messages_my");

is_int_obligatory ($_GET['id']);
$id_student=$_GET['id'];

$query = "SELECT * FROM `"._TABLE_PREFIX_."staff`
    WHERE  `status`='1';";
$object_staff= new tableQuery;
$object_staff->order_by_field="id";
$array_staff=$object_staff -> query ($query);
if (isset($array_staff) AND !empty($array_staff)) {
	////echo count($array_staff)." записей";
	////echo "<pre>staff "; print_r($array_staff); echo "</pre>"; 
}
$usertype=_ID_USER_;
if(_ID_USER_=="1") {$usertype="2";}
$id_staff = $usertype;
$fio_text= $array_staff[$id_staff]['duty']." ".$array_staff[$id_staff]['degree']." ".$array_staff[$id_staff]['surname']." ".$array_staff[$id_staff]['name']." ".$array_staff[$id_staff]['patronymic'];

?>
<link rel="stylesheet" href="<?php echo _ROOT_PATH_;?>css/comment.css" type="text/css">
<SCRIPT type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.js"> </SCRIPT>
<?php 
require_once _FUNCTIONS_PATH_."f_iden_student.php";
?>
<h2><a href="index.php">Сообщения с другими студентами</a></h2><hr>
<h2>Написать письмо <span color="blue"><?php echo identify_student($id_student);?></span></h2>
<FORM   method="POST" action="add.php">
	<div style="text-align:center;">
	   <textarea cols="100%" rows="10"  name="letter" id="letter"></textarea>
	</div>
   <br><input type="submit" style="text-align:right;" value="Отправить"></input>&nbsp;&nbsp;
   <INPUT type="hidden" name="id_student" value="<?php echo $id_student;?>"></INPUT>
   <input type="button" style="text-align:right;" value="Очистить текст" onclick="$('#letter').val('');"></input>
	<br>
</FORM>
<br><br>
<h3>Архив сообщений  <span color="blue"><?php ?></span></h3><br>
<?php //id_user usertype    id_staff $id_student

$query = "SELECT * FROM `"._TABLE_PREFIX_."messages_staff` WHERE (`active` = '1' OR `active` = '2' )  AND (`to`='".$usertype."' OR `to`='".$id_student."') AND (`from`='".$id_student."' OR `from`='".$usertype."') ORDER BY date DESC;" ;
$object_messages_staff = new TableQuery;
$object_messages_staff -> order_by_field="id";
$array_messages_staff = $object_messages_staff->query ($query);
if (isset($array_messages_staff) AND !empty($array_messages_staff) AND is_array($array_messages_staff))
{
	////echo "<pre> messages_staff count "; print_r(count($array_messages_staff)); echo "</pre>";
	////echo "<pre> messages_staff "; print_r($array_messages_staff); echo "</pre>";
	$msg_array = array ();
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

	$query = "update `"._TABLE_PREFIX_."messages_staff` SET 
		active='1'
		WHERE  (active='2') AND (`to`='".$usertype."') AND (`from`='".$id_student."');";
	$cat = mysql_query($query);
	if($cat)  { }  else {echo "bad";}
} // end if no rows
else {
	echo "<br><br>У вас нету ни одного сообщения!<br>";
}

if (isset($msg_array) AND !empty($msg_array) )
{  
	//echo "<pre>"; print_r($msg_array); echo "</pre>";
	require_once _FUNCTIONS_PATH_."f_message.php";
	show_messages ($usertype, $id_student, $msg_array);
}

require_once _DATA_PATH_."bottom.php";
?>