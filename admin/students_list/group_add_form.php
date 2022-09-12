<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";

user_access_module ("students_list");

is_int_obligatory ($_GET['id']);
$id=$_GET['id'];

echo "<h2>Добавить студента к группе</h2>";

$query = "SELECT * FROM `"._TABLE_PREFIX_."groups` ORDER BY `id` DESC ";
$object_groups = new TableQuery;
$object_groups -> order_by_field="id";
$array_groups = $object_groups->query ($query);
if (isset($array_groups) AND !empty($array_groups) AND is_array($array_groups))
{
	////echo "<pre> groups count "; print_r(count($array_groups)); echo "</pre>";
	////echo "<pre> groups "; print_r($array_groups); echo "</pre>";
	?>
	<table class="table_default">
		<thead>
			<tr class="tr_head">
				<th></th><th></th><th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i="0";
			foreach ($array_groups as $value) {
				$i++;  if($i % 2 == 0){  $bgcolor="silver"; } else {$bgcolor="white";}
				echo "<tr style=\"background-color:".$bgcolor."\"><td>".$value['id']."</td><td>".$value['name']."</td>";
				echo "<td><a href=\"group_add_update.php?id_s=".$id."&group=".$value['id']."\">Привязать</a></td></tr>  ";
			}
			?>
		</tbody>
	</table>
			<?php
}

require_once _DATA_PATH_."bottom.php";
?>