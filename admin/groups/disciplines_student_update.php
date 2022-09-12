<?php
require_once "../settings.php";
require_once _COMMON_DATA_PATH_."functions/f_is_int.php";

$selected_disciplines=$_POST;
////echo "<pre>Selected disciplines "; print_r($selected_disciplines); echo "</pre>";  // exit;

is_int_obligatory ($_GET['id']);
$student=$_GET['id'];
is_int_obligatory ($_GET['id_sem']);
$id_sem=$_GET['id_sem'];
is_int_obligatory ($_GET['direction']);
$direction=$_GET['direction'];
is_int_obligatory ($_GET['group']);
$group=$_GET['group'];

$query = "select * from `"._TABLE_PREFIX_."disciplines`  where `semester` = '".$id_sem."' and `status`='1'; ";
$object_disciplines = new TableQuery;
$object_disciplines -> order_by_field="id";
$array_disciplines = $object_disciplines->query ($query);
if (isset($array_disciplines) AND !empty($array_disciplines) AND is_array($array_disciplines))
{
	////echo "<pre> disciplines count "; print_r(count($array_disciplines)); echo "</pre>";
	////echo "<pre> disciplines "; print_r($array_disciplines); echo "</pre>";
	$i="0";
	$array_disciplines_of_semester = array ();
	foreach ($array_disciplines as $value) {
		$i++;
		$array_disciplines_of_semester[$value['id']]='1';
	}
}
 
if (isset($array_disciplines_of_semester) AND !empty($array_disciplines_of_semester))
{
	////echo "<pre> Available Disciplines of semester "; print_r($array_disciplines_of_semester); echo "</pre>";
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
	<?php////
	require_once _FUNCTIONS_PATH_."f_attach_student_to_discipline.php";
	foreach ($array_disciplines_of_semester as $discipline => $value)
	{
		//// 
		f_attach_student_to_discipline ($student, $discipline, $selected_disciplines) ;   
		
	} //end foreach
	echo "</table>";
	//echo "<pre> yet"; print_r($yet_array); echo "</pre>";
	if (isset($error_update) && !empty($error_update)) 
	{ 
		echo "<pre>Error update array"; print_r($error_update); echo "</pre>"; 
	}
}
?>
<a href="disciplines.php?group=<?php echo $group; ?>&student=<?php echo $student; ?>">Назад</a>