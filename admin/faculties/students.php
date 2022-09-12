<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 

user_access_module ("departments");

require_once _FUNCTIONS_PATH_."f_group_name.php";
require_once _FUNCTIONS_PATH_."f_group_members.php";

is_int_obligatory ($_GET['spec']);
is_int_obligatory ($_GET['dep']);
is_int_obligatory ($_GET['group']);
$group=$_GET['group'];
$spec=$_GET['spec'];
$dep=$_GET['dep'];
$group_name=identify_group_name($group);
$user_array=group_members($group);
?>
<a href="<?php echo "groups.php?spec=".$spec."&dep=".$dep; ?>">Назад</a><br>
<h4>Группа <?php echo $group_name;?></h4>
Студенты  группы
<?php
if (isset($user_array))
{
	?>
	<table class="table_default">
		<thead>
			<tr class="tr_head">
				<th>No</th><th>№ студента</th><th>Логин</th><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Группа</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i="0";	 
			foreach ($user_array as $id_user)
			{
				$query = "SELECT * FROM `"._TABLE_PREFIX_."students`  where `id`='".$id_user."'; ";
				$object_students = new TableQuery;
				$object_students -> order_by_field="id";
				$array_students = $object_students->query ($query);
				if (isset($array_students) AND !empty($array_students) AND is_array($array_students))
				{
					////echo "<pre> students count "; print_r(count($array_students)); echo "</pre>";
					////echo "<pre> students "; print_r($array_students); echo "</pre>";
					foreach ($array_students as $value) {
						$group_number=""; $i++;  if($i % 2 == 0) { $bgcolor="silver"; } else {  $bgcolor="white";}
						?>
						<tr style="text-align:center; background-color:<?php echo $bgcolor;?>">
							<TD><?php echo $i;?></TD>
							<TD><?php echo $value['id'];?></TD>
							<TD><?php echo $value['login'];?></TD>
							<TD><?php echo $value['surname'];?></TD>
							<TD><?php echo $value['name'];?></TD>
							<TD><?php  echo $value['patronymic']; ?></TD>
							<TD><?php echo $group_name; ?></TD>
						</tr>
						<?php
					}
				}
			} // for foreach
			?>
		</tbody>
	</TABLE>
	<?php
} else {echo "Не найдено ни одной записи";}
?>