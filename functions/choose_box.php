<?php
$query = "SELECT * FROM `"._TABLE_PREFIX_."base_edu` where `status`='1';";
$object_base_edu = new TableQuery;
$object_base_edu -> order_by_field="id";
$array_base_edu = $object_base_edu->query ($query);
if (isset($array_base_edu) AND !empty($array_base_edu) AND is_array($array_base_edu))
{
	////echo "<pre> base_edu count "; print_r(count($array_base_edu)); echo "</pre>";
	////echo "<pre> base_edu "; print_r($array_base_edu); echo "</pre>";
	echo "<select name=\"base_edu\" onchange='this.form.submit()'>";  //  onchange='this.form.submit()'
	echo "<option value=\"all\">Все</option>";
	foreach ($array_base_edu as $value) {
		if($_POST['base_edu'] == $value['id'])   {$selected = "selected";	}  else {$selected = ""; }
		echo "<option value=\"".$value['id']."\" ".$selected."> ".$value['name_ru']."</option>	"; // very important
	}
	echo "</select><br><br>";
}

if(isset($_POST['base_edu']))
{
	is_int_obligatory ($_POST['base_edu']);
	$base_edu=$_POST['base_edu']; //$base_edu="2";
	$query = "SELECT * FROM `"._TABLE_PREFIX_."directions`
		WHERE `base_edu` = ".$base_edu."";
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
			echo "<option value=\"".$value['id']."\" ".$selected.">".$value['name_ru']."</option>";
		}
		echo "</select><br><br>";
	}
}

if(isset($_POST['spec']))
{
	is_int_obligatory ($_POST['spec']);
	$spec=$_POST['spec'];
	$query = "SELECT * FROM `"._TABLE_PREFIX_."semester`
		WHERE `direction` = ".$spec."
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
			echo "<option value=\"".$value['id']."\" ".  $selected.">". $value['name_ru']."</option>";
		}
		echo "</select><br><br>";
	}
}

if(isset($_POST['semestr']))
{
	is_int_obligatory ($_POST['semestr']);
	$semestr=$_POST['semestr'];
	$query = "SELECT * FROM `"._TABLE_PREFIX_."disciplines`
		  WHERE `semester` = ".$semestr." AND `status`='1'
		  ";
	$object_disciplines = new TableQuery;
	$object_disciplines -> order_by_field="id";
	$array_disciplines = $object_disciplines->query ($query);
	if (isset($array_disciplines) AND !empty($array_disciplines) AND is_array($array_disciplines))
	{
		////echo "<pre> disciplines count "; print_r(count($array_disciplines)); echo "</pre>";
		////echo "<pre> disciplines "; print_r($array_disciplines); echo "</pre>";
		echo "<select name=\"subject\" onchange='this.form.submit()'>";
		echo "<option value=\"all\">Все</option>";
		foreach ($array_disciplines as $value) {
			if( $_POST['subject'] == $value['id'])   {$selected = "selected";	}  else {$selected = ""; }
			echo "<option value=\"".$value['id']."\" ".$selected.">".$value['name_ru']."</option>";
			$course_array[$value['id']]=$value['name_ru'];
		}
		echo "</select><br><br>";
		////      echo "<pre>"; print_r($course_array); echo "</pre>";
	}
}
?>