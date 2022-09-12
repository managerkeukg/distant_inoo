<?php
require_once "functions/f_is_int.php";
if (isset($_GET['id']) AND !empty($_GET['id']) ) 
{
	is_int_obligatory ($_GET['id']);
} 
else { 
	exit("error");
}
$student=$_GET['id'];

require_once "config.php";
require_once "common_data/classes/ClassTableQuery.php";

$query = "SELECT * FROM `inoo_students` where `id`='".$student."'; ";
$object_student = new TableQuery;
$object_student -> order_by_field="id";
$array_student = $object_student->query ($query);
if (isset($array_student) AND !empty($array_student) AND is_array($array_student))
{
	////echo "<pre> student count "; print_r(count($array_student)); echo "</pre>";
	////echo "<pre> student "; print_r($array_student); echo "</pre>";
	foreach ($array_student as  $value)
    {  
		///echo 
		?>
		<document>
			<id><?php echo $value['id']; ?></id>
			<name><?php echo $value['firstname']; ?></name>
			<surname><?php echo $value['lastname']; ?> </surname>
			<patronymic><?php echo $value['patronymic'] ?> </patronymic>
		</document>
		<?php
    }
}
?>