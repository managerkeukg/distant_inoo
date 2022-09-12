<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
//require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 
//require_once _COMMON_DATA_PATH_."classes/ClassTableHtml.php"; 

user_access_module ("groups"); 

require_once _FUNCTIONS_PATH_."f_group_name.php";
require_once _FUNCTIONS_PATH_."f_table_query.php";


is_int_obligatory ($_GET['student']);
is_int_obligatory ($_GET['group']);
$student=$_GET['student'];
$group=$_GET['group'];
$group_name=identify_group_name($group); //echo $group_name;

?>
<a href="members.php?id=<?php echo $group;?>">Назад</a><br>
<h4>Группа <?php echo $group_name;?></h4>
<?php

$array_student= f_table_query("SELECT `id`, `firstname`, `lastname`, `patronymic`  FROM `"._TABLE_PREFIX_."students` WHERE `id` = $student  AND (`status`='1')", "id");
////echo "<pre>student's "; print_r($array_student); echo "</pre>"; ///exit;
echo "<h2>Дисциплины студента - "; 
	if (!empty($array_student)) { echo $array_student[$student]['lastname']." ".$array_student[$student]['firstname']; }
echo "</h2>";

$array_group_speciality= f_table_query("SELECT `id`, `direction` FROM `"._TABLE_PREFIX_."groups` WHERE `id` = ".$group."  AND (`status`='1')", "id");
////echo "<pre>group's speciality "; print_r($array_group_speciality); echo "</pre>"; ///exit;

$direction = $array_group_speciality[$group]['direction'];
$array_group_speciality_name= f_table_query("SELECT `id`, `name_ru` FROM `"._TABLE_PREFIX_."directions` WHERE `id` = ".$direction."  AND (`status`='1')", "id");
////echo "<pre>group's speciality name"; print_r($array_group_speciality_name); echo "</pre>"; ///exit;

//$array_speciality_semesters= f_table_query("SELECT `id`, `firstname`, `lastname`, `patronymic`  FROM `"._TABLE_PREFIX_."students` WHERE `id` = $student  AND (`status`='1')", "id");
echo "<h4>Семестры</h4>";
require_once _FUNCTIONS_PATH_."f_form_semesters_by_spec.php";

$object_student_assignments= new TableQuery;
$object_student_assignments -> order_by_field="discipline";
$array_student_assignments=$object_student_assignments-> query ("SELECT `discipline` FROM `"._TABLE_PREFIX_."discipline_assignments`
				  WHERE `userid` = '".$student."' AND (`status`='1')
" );
////echo count($array_student_assignments)." записей";
////echo "<pre>student's all discipline assignments "; print_r($array_student_assignments); echo "</pre>"; ///exit;

if(isset($_POST['semestr']))
{	
	is_int_obligatory ($_POST['semestr']);
	$semestr=$_POST['semestr']; echo " Semester ".$semestr;
	$query = "SELECT * FROM `"._TABLE_PREFIX_."disciplines`
		WHERE `semester` = '".$semestr."' AND `status`='1';
	";
	$object_disciplines = new TableQuery;
	$object_disciplines -> order_by_field="id";
	$array_disciplines = $object_disciplines->query ($query);
	if (isset($array_disciplines) AND !empty($array_disciplines) AND is_array($array_disciplines))
	{
		////echo "<pre> disciplines count "; print_r(count($array_disciplines)); echo "</pre>";
		////echo "<pre> disciplines "; print_r($array_disciplines); echo "</pre>";
		?>
		<FORM action="disciplines_student_update.php?id=<?php echo $student; ?>&id_sem=<?php echo $semestr; ?>&direction=<?php echo $direction; ?>&group=<?php echo $group; ?>" method="POST">
			<table class="table_default">
				<thead>
					<tr class="tr_head">
						<th>№</th>
						<th>№ курса</th>
						<th>Предмет</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php $i="0";
				foreach ($array_disciplines as $value) {
					$i++;
					?>
					<TR>
						<TD><?php echo $i; ?></TD><TD><?php echo $value['id']; ?></TD>
						<TD><?php echo $value['name_ru']; ?></TD>
						<TD>
							<INPUT type="checkbox" 
								id="<?php echo "id_discipline_".$value['id']; ?>" name="<?php echo $value['id']; ?>" onchange="enable()" 
							<?php
							if(isset($array_student_assignments[$value['id']]) AND !empty($array_student_assignments[$value['id']]))
							{echo "checked";} 
							else {} 
							?> >
							</INPUT>
						</TD>
					</TR>
					<?php
				}
				?> 
				</tbody>
			</table>
			<div>
				<input type="button" id="btn_UnCheckAll" value="Сбросить Все" name="btn_UnCheckAll" onclick="UncheckAll()"></input>
				<input type="button" id="btn_choose_all" value="Выбрать все" name="btn_choose_all" onclick="checkAll()"></input>
			</div>
			<INPUT type="SUBMIT" id="bt_submit" VALUE="Изменить">
		</FORM>
		<?php
	}
} // end if isset
?> 
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/checkbox_check.js"></script> 
<?php
require_once _DATA_PATH_."bottom.php";
?>