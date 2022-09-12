<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _FUNCTIONS_PATH_."ft_type_file_umk.php"; 

echo "<h3>Учебно методический комплекс дисциплины</h3>";

is_int_obligatory ($_GET['discipline']);
$discipline = $_GET['discipline'];

$array_type_file_umk = table_type_file_umk();
if (isset($array_type_file_umk) AND !empty($array_type_file_umk) AND is_array($array_type_file_umk))
{
	////echo "<pre> Count type_file_umk - "; print_r(count($array_type_file_umk)); echo "</pre>";
	////		echo "<pre>type_file_umk "; print_r($array_type_file_umk); echo "</pre>";
}

$query="SELECT * FROM `"._TABLE_PREFIX_."course_umk_files` WHERE `course`='".$discipline."' AND `status`>='1' ORDER BY `time` DESC;";
$object_course_umk_files= new TableQuery;
$object_course_umk_files -> order_by_field="id";
$array_course_umk_files = $object_course_umk_files -> query ($query);
if (isset($array_course_umk_files) AND !empty($array_course_umk_files) AND is_array($array_course_umk_files))
{
	////echo "<pre> Count course_umk_files - "; print_r(count($array_course_umk_files)); echo "</pre>";
	////echo "<pre>course_umk_files "; print_r($array_course_umk_files); echo "</pre>";
	?>
	<table class="table_default">
		<thead>
			<tr class="tr_head">
				<th>Номер</th>
				<th>Название файла</th>
				<th>Тип Умк</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i=0;
			foreach ($array_course_umk_files as $array) {
				$i++;  if($i % 2 == 0){  $bgcolor="silver"; } else {  $bgcolor="white";}
				require "index_help.php";
			}
			?>
		</tbody>
	</table>
	<?php
}	
?>
<br>
<br>
<a href="add.php?id=<?php echo $discipline;?>">Добавить новый файл?</a>
<br>
<?php

require_once _DATA_PATH_."bottom.php";
?>