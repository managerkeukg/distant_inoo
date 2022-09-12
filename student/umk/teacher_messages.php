<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _FUNCTIONS_PATH_."function_identify_course.php";
require_once _FUNCTIONS_PATH_."f_message_teacher.php";
		
is_int_obligatory ($_GET['id']);
$id_course=$_GET['id'];
?>
<script type="text/javascript" src="<?php echo _COMMON_DATA_PATH_;?>ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo _ROOT_PATH_;?>css/comment.css" type="text/css"> 
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.js"></script>
<?php
require_once _FUNCTIONS_PATH_."f_iden_student.php";
require_once _FUNCTIONS_PATH_."f_iden_teacher.php";
require_once _FUNCTIONS_PATH_."f_iden_course_teacher.php";
require_once _FUNCTIONS_PATH_."function_identify_course.php";

echo identify_course($id_course);

$student_name = identify_student (_ID_USER_);
if(empty($student_name)) {exit("Такого студента не существует");}
//$teacher_name=identify_teacher($id_user);
$teacher_name="Преподаватель";
$id_teacher=identify_teacher_course($id_course); 
if (isset($id_teacher)) {} else {exit("<br><p style=\"color:red;\">Переписка  невозможна, потому что преподаватель еще не прикреплен к предмету, обратитесь к методисту.</p>
	<br><br><a href=\"index.php\">Назад</a>");}
?>
<h2><a href="index.php">Сообщения с другими преподавателями</a></h2><hr>
<h2>Написать сообщение преподавателю 
	<p style="color:blue;"><?php 
		if (isset($id_teacher) AND !empty($id_teacher)) 
		{ 
			$teacher_name= identify_teacher($id_teacher);
			echo $teacher_name;
		} ?>
	</p>
</h2>
<form method="POST" action="teacher_messages_update.php">
	<div style="text-align:center;">
		<textarea cols="100%" rows="10"  name="letter" id="letter"></textarea>
	</div>
	<script type="text/javascript">
		CKEDITOR.replace( 'letter' );
	</script>
	<br><input type="submit" style="text-align:right;" value="Отправить"></input>&nbsp;&nbsp;
	<input type="hidden" name="id_teacher" value="<?php echo $id_teacher;?>"></input>
	<input type="hidden" name="id_course" value="<?php echo $id_course;?>"></input>
	<input type="button" style="text-align:right;" value="Очистить текст" onclick="$('#letter').val('');"></input>
	<br>
</form>
<h3>Архив сообщений</h3><br>
<?php
$query = "SELECT * FROM `"._TABLE_PREFIX_."subject_messages` WHERE (`active` = '1' OR `active` = '2' )  AND ( `subject`='".$id_course."' AND `student`='"._ID_USER_."') ORDER BY date DESC;" ;
$object_subject_messages = new TableQuery;
$object_subject_messages -> order_by_field="id";
$array_subject_messages = $object_subject_messages->query ($query);
if (isset($array_subject_messages) AND !empty($array_subject_messages) AND is_array($array_subject_messages))
{
	////echo "<pre> subject_messages count "; print_r(count($array_subject_messages)); echo "</pre>";
	////echo "<pre> subject_messages "; print_r($array_subject_messages); echo "</pre>";
	foreach ($array_subject_messages as $key => $value) {
		if ($value['from']==1) // if from teacher
		{ 
			$value['fio']=$teacher_name;
			$value['photo']=""._ROOT_PATH_."images/no_avt.jpg";
		} else {
			$value['fio']="Я";
			$value['photo']=""._ROOT_PATH_."images/no_avt.jpg";
		}
		$msg_array[]=$value;
	}
	
	$query="update `"._TABLE_PREFIX_."subject_messages` SET 
		active='1'
		WHERE  (active='2') AND (`from`='1') AND (`id_student`='"._ID_USER_."')  AND (`discipline`='".$id_course."') AND (`id_teacher`='".$id_teacher."')"; 
	$cat = mysql_query($query);
	if($cat)  { }  else {}
	if (isset($msg_array) AND !empty($msg_array) )
	{  
		//echo "<pre> msg_array "; print_r($msg_array); echo "</pre>";
		show_messages (_ID_USER_, $id_teacher, $msg_array);
	}
}
else {
	echo "<br><br>У вас нету ни одного сообщения!<br>";
}
?>