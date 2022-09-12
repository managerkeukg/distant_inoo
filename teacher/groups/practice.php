<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

is_int_obligatory ($_GET['practice']);
is_int_obligatory ($_GET['group']);
is_int_obligatory ($_GET['discipline']);
$practice=$_GET['practice'];
$discipline=$_GET['discipline'];
$group=$_GET['group'];

echo "<h2>Практика ".$practice."</h2>";

require_once _FUNCTIONS_PATH_."f_iden_student.php";
require_once _FUNCTIONS_PATH_."f_iden_group_of_student.php"; 
require_once _FUNCTIONS_PATH_."f_group_name.php"; 
require_once _FUNCTIONS_PATH_."f_group_members.php";
require_once _FUNCTIONS_PATH_."function_identify_course.php"; 
require_once _FUNCTIONS_PATH_."f_iden_practice_value.php"; 

$year = _CURRENT_EDU_YEAR_; $semestr="2";
$group_members=group_members($group);
echo "<h3>Практические занятия  по дисциплине - ".identify_course($discipline)."</h3>";
echo "<h4>Группа - ".identify_group_name($group)."</h4>";
//echo "<pre>Members of  groups <br>"; print_r($group_members); echo "</pre>";
if (isset($group_members) AND !empty($group_members))
{
	?>
	<form action="practice_save.php" method="POST">
		<table class="table_default">
		<thead>
			<tr class="tr_head">
				<th>No</th>
				<th>ФИО</th>
				<th>1 модуль</th>
				<th>2 модуль</th>
				<th>ОЦЕНКА <br> max 10</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i="0"; 
			foreach ($group_members as $id_user)
			{ 
				$i++;  if($i % 2 == 0)  {  $bgcolor="silver"; }  else { $bgcolor="white"; }
				//echo "<br>".identify_student($id_user);
				?>
				<tr style="text-align:center; background-color:<?php echo $bgcolor; ?>;">
					<td><?php echo $i;?></td>
					<td><?php echo identify_student($id_user);?></td>
					<td></td><td></td>
					<td>
						<input type="text" size="3" name="<?php echo $id_user;?>" 
							value="<?php echo iden_practice_value ($id_user, $practice, $discipline, $year, $semestr)?>"></input>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>	
		</table>
		<input type="hidden" name="practice" value="<?php echo $practice; ?>"></input>
		<input type="hidden" name="discipline" value="<?php echo $discipline; ?>"></input>
		<input type="hidden" name="edu_year" value="<?php echo $year; ?>"></input>
		<input type="hidden" name="edu_semestr" value="<?php echo $semestr; ?>"></input>
		<input type="submit" value="Внести оценки">
	</form>
	<?php
} else {
	echo "there is no group members";
}

require_once _DATA_PATH_."bottom.php";
?>