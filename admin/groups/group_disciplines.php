<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("groups"); 

require_once _FUNCTIONS_PATH_."f_group_name.php";
require_once _FUNCTIONS_PATH_."f_group_members.php";
require_once _FUNCTIONS_PATH_."f_iden_speciality.php";
require_once _FUNCTIONS_PATH_."f_group_speciality.php";

?>
<a href="index.php">Назад</a><br>
<?php
is_int_obligatory ($_GET['id']);
$group=$_GET['id'];
$group_name=identify_group_name($group);
$user_array=group_members($group);
echo "<h2>Дисциплины Группы    ".$group_name."</h2>";

$direction=identify_group_speciality($group); //echo $direction;
if (isset($direction) AND !empty($direction))  {echo "<h3>".identify_speciality($direction)."</h3>";}

require_once _FUNCTIONS_PATH_."f_form_semesters_by_spec.php";
if(isset($_POST['semestr']))
{
	is_int_obligatory ($_POST['semestr']);
	$semestr=$_POST['semestr']; echo $semestr;
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
		<FORM action="group_disciplines_update.php?id_sem=<?php echo $semestr; ?>&group=<?php echo $group; ?>" method="POST">
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
			<?php 
			$i="0";
			foreach ($array_disciplines as $value) {
				$i++;
				// if( $_POST['subject'] == $value['id'])   {$selected = "selected";	}  else {$selected = ""; }
				?>
				<tr>
					<TD><?php echo $i; ?></TD><TD><?php echo $value['id']; ?></TD>
					<TD><?php echo $value['name_ru']; ?></TD>
					<TD>
					<INPUT type="checkbox"  id="<?php echo "id_discipline_".$value['id']; ?>" name="<?php echo $value['id']; ?>" onchange="enable()" 
					></INPUT>
					</TD>
				</tr>
				<?php
			}
			?>
				</tbody>
			</table>
			<div style="text-align:right;">
				<input type="button" id="btn_UnCheckAll" value="Сбросить Все" name="btn_UnCheckAll" onclick="UncheckAll()"></input>
				<input type="button" id="btn_choose_all" value="Выбрать все" name="btn_choose_all" onclick="checkAll()"></input>
			</div>
			<INPUT type="SUBMIT" id="bt_submit" VALUE="Изменить">
		</FORM>
		<?php
	}
} // for if isset
?>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/checkbox_check.js"></script>
<?php
require_once _DATA_PATH_."bottom.php";
?> 