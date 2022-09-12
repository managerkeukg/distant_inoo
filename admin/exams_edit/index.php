<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableHtml.php";

user_access_module ("exams_edit");

echo "<h2>Экзамены, Доп. баллы</h2>";
?>
<FORM method="post">
<?php
require_once _FUNCTIONS_PATH_."choose_box.php";

if(isset($_POST['spec']) AND isset($_POST['subject'])) 
{  
	is_int_obligatory ($_POST['spec']);
	$direction = $_POST['spec'];
	is_int_obligatory ($_POST['subject']);
	$discipline = $_POST['subject'];
	echo "<br>direction ".$direction."<br>";
	echo "<br>discipline ".$discipline."<br>";
	$query = "SELECT `id`, `name` FROM `"._TABLE_PREFIX_."groups` WHERE `direction`='".$direction."'; ";
	$object_direction_groups= new TableQuery;
	$object_direction_groups -> order_by_field="id";
	$array_direction_groups = $object_direction_groups -> query ($query);
	if (isset($array_direction_groups) AND !empty($array_direction_groups)) {
		////echo "<pre>"; print_r($array_direction_groups); echo "</pre>";
		$object_table=new TableHtml5;
		$object_table -> css_file = "css/html_table_blue.css";
		
		$headers= array("id"=>"No", "name"=>"Группы");
		$object_table -> set_th_array ($headers);
		//$object_table->column_value_array_foreign ("discipline", $array_files_gak , array("name_ru_detailed"));
		$object_table -> set_data($array_direction_groups);
		
		$object_table -> data_key_add ("exams", "Экзамены");
		$object_table -> data_key_value ("exams", "<a href=exam_form.php?group={{id}}&id_course=".$discipline." target=_blank>Экзамены</a>");
		
		$object_table -> data_key_add ("add_points", "Дополнительные баллы");
		$object_table -> data_key_value ("add_points", "<a href=additional_points.php?group={{id}}&id_course=".$discipline." target=_blank>Дополнительные баллы</a>");
		
		$object_table->display ();
	}
}

require_once _DATA_PATH_."bottom.php";
?>