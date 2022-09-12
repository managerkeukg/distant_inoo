<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _FUNCTIONS_PATH_."f_iden_student.php";
?>
<FORM method="post">
<?php
$query = "SELECT * FROM `"._TABLE_PREFIX_."base_edu` where `status`='1';";
$object_base_edu = new TableQuery;
$object_base_edu -> order_by_field="id";
$array_base_edu = $object_base_edu->query ($query);
if (isset($array_base_edu) AND !empty($array_base_edu) AND is_array($array_base_edu))
{
	////echo "<pre> base_edu count "; print_r(count($array_base_edu)); echo "</pre>";
	////echo "<pre> base_edu "; print_r($array_base_edu); echo "</pre>";
	echo "<select name=\"combobox\" onchange='this.form.submit()'>";  //  onchange='this.form.submit()'
	echo "<option value=\"all\">Все</option>";
	foreach ($array_base_edu as $value) {
		if( $_POST['combobox'] == $value['id'])   {$selected = "selected";	}  else {$selected = ""; }
		echo "<option value='".$value['id']."' ".$selected."> ".$value['name_ru']."</option>	"; // very important
	}
	echo "</select><br><br>";
}

if(isset($_POST['combobox'])){
	is_int_obligatory ($_POST['combobox']);
	$combobox=$_POST['combobox'];
    $query = "SELECT * FROM `"._TABLE_PREFIX_."directions`
              WHERE `base_edu` = '".$combobox."';
              ";
    $object_directions = new TableQuery;
	$object_directions -> order_by_field="id";
	$array_directions = $object_directions->query ($query);
	if (isset($array_directions) AND !empty($array_directions) AND is_array($array_directions))
	{
		////echo "<pre> directions count "; print_r(count($array_directions)); echo "</pre>";
		////echo "<pre> directions "; print_r($array_directions); echo "</pre>";
		echo "<select name=\"spec\" onchange='this.form.submit()'>";
		echo "<option value=\"all\">Все</option>";
		foreach ($array_directions as $value) {
			if( $_POST['spec'] == $value['id'])   {$selected = "selected";	}  else {$selected = ""; }
			echo "<option value=\"".$value['id']."\"  ".$selected.">".$value['name_ru']."</option>";
		}
		echo "</select><br><br>";
    }
}


if(isset($_POST['spec'])){
	is_int_obligatory ($_POST['spec']);
	$spec=$_POST['spec'];
	$query = "SELECT * FROM `"._TABLE_PREFIX_."semester`
			  WHERE	`direction` = '".$spec."';
			  ";
	$object_semester = new TableQuery;
	$object_semester -> order_by_field="id";
	$array_semester = $object_semester->query ($query);
	if (isset($array_semester) AND !empty($array_semester) AND is_array($array_semester))
	{
		////echo "<pre> semester count "; print_r(count($array_semester)); echo "</pre>";
		////echo "<pre> semester "; print_r($array_semester); echo "</pre>";
		echo "<select name=\"semestr\" onchange='this.form.submit()'>";
		echo "<option value=\"all\">Все</option>";
		foreach ($array_semester as $value) {
			if( $_POST['semestr'] == $value['id'])   {$selected = "selected";	}  else {$selected = ""; }
			echo "<option value=\"".$value['id']."\" ".$selected.">". $value['name_ru']."</option>";
		}
		echo "</select><br><br>";
	}
}

if(isset($_POST['semestr'])){
	is_int_obligatory ($_POST['semestr']);
	$semestr=$_POST['semestr'];
	$query = "SELECT * FROM `"._TABLE_PREFIX_."disciplines`  WHERE `semester` = '".$semestr."' AND `status`='1';";
	$object_disciplines = new TableQuery;
	$object_disciplines -> order_by_field="id";
	$array_disciplines = $object_disciplines->query ($query);
	if (isset($array_disciplines) AND !empty($array_disciplines) AND is_array($array_disciplines))
	{
		////echo "<pre> disciplines count "; print_r(count($array_disciplines)); echo "</pre>";
		////echo "<pre> disciplines "; print_r($array_disciplines); echo "</pre>";
		echo "<select name=\"subject\" onchange='this.form.submit()'>";
		echo "<option value=\"all\">Все</option>";
		$course_array = array ();
		foreach ($array_disciplines as $value) {
			if( $_POST['subject'] == $value['id'])   {$selected = "selected";	}  else {$selected = ""; }
			echo "<option value=\"".$value['id']."\" ".$selected.">". $value['name_ru']."</option>";
			$course_array[$value['id']]=$value['name_ru'];
		}
		echo "</select><br><br>";
	}
}
?>
<link rel="stylesheet" href="<?php echo _ROOT_PATH_;?>css/comment.css" type="text/css">   
<?php
if(isset($_POST['subject'])){
	is_int_obligatory ($_POST['subject']);
	$id_course=$_POST['subject'];
	$query = "SELECT * FROM `"._TABLE_PREFIX_."subject_messages` WHERE `subject` = '".$id_course."'  AND (`active`=1) ORDER BY date DESC;";
    $object_subject_messages = new TableQuery;
	$object_subject_messages -> order_by_field="id";
	$array_subject_messages = $object_subject_messages->query ($query);
	if (isset($array_subject_messages) AND !empty($array_subject_messages) AND is_array($array_subject_messages))
	{
		////echo "<pre> subject_messages count "; print_r(count($array_subject_messages)); echo "</pre>";
		////echo "<pre> subject_messages "; print_r($array_subject_messages); echo "</pre>";
		$i=0;
		foreach ($array_subject_messages as $value) {
			$i++;
	        if($i % 2 == 0)
		    {  $class="odd"; }
            else { $class=""; }
			?>
			<li id="<?php echo $value['id_msg'];?>"><img class="avatar" src="<?php echo _ROOT_PATH_;?>images/no_avt.jpg">
				<div class="comment-content  <?php echo $class;?>">
					<div class="vcorner"></div>
					<small class="date"><?php echo $value['date'];?></small>
					<h6>  <?php echo identify_student($value['student']);?>  </h6>
					<h6> Тема :<?php echo $value['msg_theme']; ?>  </h6>
					<div class="p"><?php echo $value['msg'];?></div>
				</div>
			</li>
						<?php
		}
    } else {}
}
?>
</FORM>
<?php

require_once _DATA_PATH_."bottom.php";
?>