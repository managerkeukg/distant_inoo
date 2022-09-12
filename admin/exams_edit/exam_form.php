<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

user_access_module ("exams_edit");

is_int_obligatory ($_GET['id_course']);
is_int_obligatory ($_GET['group']);
$id_course=$_GET['id_course'];
$group=$_GET['group'];

echo "<h2>Экзамены</h2>";

require_once _FUNCTIONS_PATH_."f_group_members.php";
require_once _FUNCTIONS_PATH_."f_iden_student.php";
require_once _FUNCTIONS_PATH_."f_iden_group_of_student.php"; 
require_once _FUNCTIONS_PATH_."f_group_name.php"; 
require_once _FUNCTIONS_PATH_."function_identify_course.php"; 
require_once _FUNCTIONS_PATH_."f_iden_exam_value.php"; 

$year=_CURRENT_EDU_YEAR_; $semestr="2";
$group_members = group_members($group);
echo "<h4>".identify_group_name($group)."</h4>";
echo identify_course($id_course);
//echo "<pre>Members of  groups <br>"; print_r($group_members); echo "</pre>";
if (isset($group_members) AND !empty($group_members))
{
	?>
	<FORM action="exam_update.php" method="POST">
	<table class="table_default">
		<thead>
			<tr class="tr_head">
				<th>No</th><th>ФИО</th><th>ОЦЕНКА</th><th></th><th></th>
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
			<tr style="text-align:center; background-color:<?php echo $bgcolor; ?>">
				<TD><?php echo $i;?></TD>
				<TD><?php echo identify_student($id_user);?></TD>
				<TD><INPUT type="text" size="3" name="<?php echo $id_user;?>" 
					value="<?php echo iden_exam_value ($id_user, $id_course, $year, $semestr)?>"></INPUT>
				</TD>
				<TD></TD><TD></TD>
			</tr>
			<?php
		}
		?>
		</tbody>
	</TABLE>
	<INPUT type="hidden" name="edu_subject" value="<?php echo $id_course; ?>"></INPUT>
	<INPUT type="hidden" name="edu_year" value="<?php echo $year; ?>"></INPUT>
	<INPUT type="hidden" name="edu_semestr" value="<?php echo $semestr; ?>"></INPUT>
	<INPUT type="submit" value="Внести оценки">
	</FORM>
	<?php
} else {echo "there is no group members";}

require_once _DATA_PATH_."bottom.php";
?>