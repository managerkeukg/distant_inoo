<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

echo "<h2>Итоговый контроль</h2>";

is_int_obligatory ($_GET['group']);
is_int_obligatory ($_GET['discipline']);
$discipline=$_GET['discipline'];
$group=$_GET['group'];

require_once _FUNCTIONS_PATH_."f_iden_student.php";
require_once _FUNCTIONS_PATH_."f_iden_group_of_student.php"; 
require_once _FUNCTIONS_PATH_."f_group_name.php"; 
require_once _FUNCTIONS_PATH_."f_group_members.php";
require_once _FUNCTIONS_PATH_."function_identify_course.php"; 
require_once _FUNCTIONS_PATH_."f_iden_exam_value.php"; 

$year=_CURRENT_EDU_YEAR_; $semestr="2";
$group_members=group_members($group);
//echo "<pre>Members of  groups <br>"; print_r($group_members); echo "</pre>";

echo "<h4>Группа - ".identify_group_name($group)."</h4>";
echo "<h4> Дисциплина - ".identify_course($discipline)."</h4>";

if (isset($group_members) AND !empty($group_members))
{
	?>
	<form action="exam_save.php" method="POST">
		<table class="table_default">
			<thead>
				<tr class="tr_head">
					<th>No</th>
					<th>ФИО</th>
					<th>Оценка <br> Экзамена</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i="0"; 
				foreach ($group_members as $id_user)
				{
					$i++;  if($i % 2 == 0)  {  $bgcolor="silver"; }  else { $bgcolor="white"; }
					?>
					<tr class="table_tr" style="background-color:<?php echo $bgcolor; ?>;">
						<td><?php echo $i;?></td>
						<td><?php echo identify_student($id_user);?></td>
						<td>
							<input type="text" size="3" name="<?php echo $id_user;?>" 
								value="<?php echo iden_exam_value ($id_user, $discipline, $year, $semestr)?>">
							</input>
						</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<input type="hidden" name="discipline" value="<?php echo $discipline; ?>"></input>
		<input type="hidden" name="year" value="<?php echo $year; ?>"></input>
		<input type="hidden" name="semestr" value="<?php echo $semestr; ?>"></input>
		<input type="submit" value="Внести оценки">
	</form>
	<?php
} else {
	echo "there is no group members";
}

require_once _DATA_PATH_."bottom.php";
?>