<?php
require_once "../settings.php";
require_once _COMMON_DATA_PATH_."functions/f_is_int.php";
require_once _FUNCTIONS_PATH_."f_group_members.php";

$selected_disciplines=$_POST;
////echo "<pre>Selected disciplines "; print_r($selected_disciplines); echo "</pre>"; 

is_int_obligatory ($_GET['id_sem']);
$id_sem=$_GET['id_sem'];
is_int_obligatory ($_GET['group']);
$group=$_GET['group'];
?>
<a href="group_disciplines.php?id=<?php echo $group; ?>">Назад</a>
<?php

$query = "select * from `"._TABLE_PREFIX_."disciplines`  where `semester` = '".$id_sem."' and `status`='1'; ";
$object_disciplines = new TableQuery;
$object_disciplines -> order_by_field="id";
$array_disciplines=$object_disciplines -> query ($query);
if (isset($array_disciplines) AND !empty($array_disciplines)) {
	////echo count($array_disciplines)." записей";
	////echo "<pre>disciplines "; print_r($array_disciplines); echo "</pre>";
	$i="0";	
	foreach ($array_disciplines as $key => $value) {
		$i++;
		$array_disciplines_of_semester[$value['id']]='1';
	}
}

$array_group_students=group_members($group);
if (isset($array_group_students) AND !empty($array_group_students))
{  
	////echo "<pre>Group students "; print_r($array_group_students); echo "</pre>";
}

if (isset($array_disciplines_of_semester) AND !empty($array_disciplines_of_semester))
{
	//// echo "<pre>Available Disciplines of semester "; print_r($array_disciplines_of_semester); echo "</pre>";
	?>
	<table class="table_default">
		<thead>
			<tr class="tr_head">
				<th>student</th>
				<th>disciplines in semester</th>
				<th>discipline selected</th>
				<th>YET assigned</th>
				<th>prev status</th>
				<th> to be inserted</th>
				<th> to be updated</th>
			</tr>
		</thead>
		<tbody>
	<?php
	require_once _FUNCTIONS_PATH_."f_attach_student_to_discipline.php";
	foreach ($array_group_students as $key=>$student)
	{  
		//echo $student.", ";
		foreach ($array_disciplines_of_semester as $discipline => $value)
		{
			////
			f_attach_student_to_discipline ($student, $discipline, $selected_disciplines) ;
		} //end foreach
	}

	echo "</tbody></table>";
	//echo "<pre> yet"; print_r($yet_array); echo "</pre>";
	if (isset($error_update) && !empty($error_update)) 
	{ 
		echo "<pre>Error update array"; print_r($error_update); echo "</pre>"; 
	}
}
?>
<a href="group_disciplines.php?id=<?php echo $group; ?>">Назад</a>