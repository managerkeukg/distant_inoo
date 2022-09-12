<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 
require_once _FUNCTIONS_PATH_."f_points_convert.php"; 

user_access_module ("results");

echo "<h2>Результаты тестов</h2>";

$year=_CURRENT_EDU_YEAR_;

$object_groups= new TableQuery;
$object_groups->order_by_field="id";
$array_groups=$object_groups -> query ("SELECT * FROM `"._TABLE_PREFIX_."groups` ORDER BY `id` ASC;" );
if (isset($array_groups) AND !empty($array_groups))
{
	////echo count($array_groups)." записей";
	////echo "<pre>groups "; print_r($array_groups); echo "</pre>"; 
}

$object_modules_type= new TableQuery;
$object_modules_type->order_by_field="id";
$array_modules_type=$object_modules_type -> query ("SELECT * FROM `"._TABLE_PREFIX_."type_modules` WHERE `status`='1' ORDER BY `id` ASC;" );
if (isset($array_modules_type) AND !empty($array_modules_type))
{
	////echo count($array_modules_type)." записей";
	////echo "<pre>modules_type "; print_r($array_modules_type); echo "</pre>"; 
}

$object_disciplines= new TableQuery;
$object_disciplines->order_by_field="id";
$array_disciplines=$object_disciplines -> query ("SELECT * FROM `"._TABLE_PREFIX_."disciplines` WHERE `status`='1' ORDER BY `id` ASC;" );
if (isset($array_disciplines) AND !empty($array_disciplines))
{
	////echo count($array_disciplines)." записей";
	////echo "<pre>disciplines "; print_r($array_disciplines); echo "</pre>"; 
}

$object_tests= new TableQuery;
$object_tests->order_by_field="id";
$array_tests=$object_tests -> query ("SELECT * FROM `"._TABLE_PREFIX_."tests` ORDER BY `id` ASC;" );
if (isset($array_tests) AND !empty($array_tests))
{
	////echo count($array_tests)." записей";
	////echo "<pre>tests "; print_r($array_tests); echo "</pre>"; 
}

?>
<SCRIPT type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.js"> </SCRIPT> 
<SCRIPT type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/show.js"> </SCRIPT> 

<FORM method="post">
	Показать
		<TABLE style="text-align:center; width:100%;">
		<?php
			foreach ($array_modules_type as $key => $value) {
					echo "<TR><TD>".$value['name_ru']." </TD>";
					echo "<TD>
				<INPUT type=\"checkbox\" id=\"module_".$value['id']."\" name=\"module_".$value['id']."\""; 
	               if (isset($_POST['module_'.$value['id']]) AND $_POST['module_'.$value['id']]=='on' ) { echo "checked";}
		        echo "> </INPUT></TD></TR>";
			}
		?>
		<!--
		<TR><TD>Модули </TD>
			<TD>
				<INPUT type="checkbox" id="modules" name="modules" 
	              <?php //if (isset($_POST['modules']) AND $_POST['modules']=='on' ) {echo "checked";}?>
		        > </INPUT>
			</TD></TR>
		<TR><TD>Итоговый контроль</TD>
			<TD> 
				<INPUT type="checkbox" id="exam_points" name="exam_points"
	              <?php //if (isset($_POST['exam_points']) AND $_POST['exam_points']=='on' ) {echo "checked";}?>
		        > </INPUT>
			</TD></TR>
		<TR><TD>Доп. Баллы</TD>
			<TD><INPUT type="checkbox" id="add_points" name="add_points"
	              <?php //if (isset($_POST['add_points']) AND $_POST['add_points']=='on' ) {echo "checked";}?>
		          > </INPUT>
			</TD></TR>
		<TR><TD>Сумма Баллов</TD>
			<TD><INPUT type="checkbox" id="total_points" name="total_points"
	              <?php //if (isset($_POST['total_points']) AND $_POST['total_points']=='on' ) {echo "checked";}?>
		          > </INPUT>
			</TD></TR>
		<TR><TD>Оценка</TD>
			<TD><INPUT type="checkbox" id="grade" name="grade"
	              <?php //if (isset($_POST['grade']) AND $_POST['grade']=='on' ) {echo "checked";}?>
		          > </INPUT>
			</TD></TR>
		-->
		</TABLE>

<BR>
<?php
///echo "<pre> POST "; print_r($_POST); echo "</pre>";
if(isset($_POST)) { 
	//is_int_ ($_POST['spec']);
	if (isset($array_modules_type) AND !empty($array_modules_type)) 
	{
		$array_modules_selected = array ();
		foreach ($array_modules_type as $key => $value) {
			if (isset($_POST['module_'.$key])) {
				$array_modules_selected[$key]= $value;
			}
		}
		if (isset($array_modules_selected) AND !empty($array_modules_selected)) {
			///echo "<pre> Selected modules "; print_r($array_modules_selected); echo "</pre>";
			$array_modules_type=$array_modules_selected;
		}
		
	}	
}

require_once _FUNCTIONS_PATH_."choose_box.php";
?>
</FORM>
<?php
require_once _FUNCTIONS_PATH_."f_speciality_groups.php";
require_once _FUNCTIONS_PATH_."f_group_members.php";

require_once _FUNCTIONS_PATH_."f_iden_subject_test_status2.php"; // indentify 
require_once _FUNCTIONS_PATH_."f_test_name.php";
require_once _FUNCTIONS_PATH_."f_iden_student.php";
require_once _FUNCTIONS_PATH_."f_iden_group_of_student.php"; 
require_once _FUNCTIONS_PATH_."f_group_name.php"; 
require_once _FUNCTIONS_PATH_."f_groups.php"; 
require_once _FUNCTIONS_PATH_."function_identify_course.php"; 
require_once _FUNCTIONS_PATH_."f_iden_exam_value.php";
require_once _FUNCTIONS_PATH_."f_iden_additional_ball.php";

//// echo "<pre> POST "; print_r($_POST); echo "</pre>"; 

if(isset($_POST['spec'])) { 
	is_int_ ($_POST['spec']);
	$speciality = $_POST['spec'];
	echo "<br> speciality ".$_POST['spec'];
}
if(isset($_POST['subject']))
{
	is_int_ ($_POST['subject']);
	$discipline=$_POST['subject'];
	$discipline_name	= $array_disciplines[$discipline]['name_ru'];
	echo "<br> discipline ".$_POST['subject']." - ".$discipline_name;
	
	$where_subject=" WHERE ( `discipline` = '0' ";
	foreach ($array_modules_type as $key => $value)
	{
		$id_test="";
		$id_test=identify_course_test($discipline, $value['id'], $year);
		if (!empty($id_test)) { $where_subject=$where_subject." OR `discipline` = '".$id_test."' ";}  
		echo "<br>".$value['name_ru']." тест №  ".$id_test." - ".$array_tests[$id_test]['name'];
	}
	$where_subject=$where_subject." ) AND (`yes`<>'0') AND (`no`<>'0') ";
	echo "<br><br>".$where_subject;
	
		
	///*
	$object_test_users= new TableQuery;
	$object_test_users->order_by_field="id";
	$query = "SELECT `id`, `discipline`, `year`, `user_id`, `mod`, `yes`,  `no` FROM `"._TABLE_PREFIX_."test_users` ".$where_subject." ORDER BY `user_id` ASC;";
	//echo "<br>".$query;
	$array_test_users=$object_test_users -> query ($query);
			
	if (isset($array_test_users) AND !empty($array_test_users))
	{
		////echo "<br>".count($array_test_users)." записей";
		////echo "<pre>test_users "; print_r($array_test_users); echo "</pre>"; 
		$array_group_users= array ();
		$user_group = array();
		foreach ($array_test_users as $key => $value) {
			if (isset($user_group[$value['user_id']]) AND !empty($user_group[$value['user_id']]))
			{
				$array_group_users[$user_group[$value['user_id']]['group']][$value['user_id']][$value['mod']][]= $value;
			} else {
				$user_group[$value['user_id']]['group']=identify_group_of_student($value['user_id']);
				$array_group_users[$user_group[$value['user_id']]['group']][$value['user_id']][$value['mod']][]= $value;
			}
		}
		unset($user_group);
		//echo "<pre> group_users "; print_r($array_group_users); echo "</pre>"; 
		//echo "<br> group_users ".count($array_group_users); 
		
		$array_groups_members=array();
		foreach ($array_group_users as $group => $group_value) { 
			$group_members= array();
			$group_members=group_members($group);
			$array_groups_members[$group]=$group_members;
		}
		unset ($group_members);
		//echo "<pre> groups_members "; print_r($array_groups_members); echo "</pre>"; 
		
		$array_big_data= array();
		foreach ($array_groups_members as $group => $array_student) {
			foreach ($array_student as $student) {
				$array_big_data[$group][$student]=$array_group_users[$group][$student];
				if (isset($array_group_users[$group][$student]) AND !empty($array_group_users[$group][$student]))
				{
					
				}
				else {
					$array_group_users[$group][$student]=$array_group_users[$group][$student]; 
				}
			}
			
		}
		//echo "<br> 86 group has users - ".count($array_group_users[86]);
		
		foreach ($array_groups_members as $group => $student) { 
			//echo "<br>members of group ".$group." - ". count($array_groups_members[$group]); 
			//echo "<pre>members of group "; print_r($array_groups_members[$group]); echo "</pre>"; 
			$array_data_group=array();
			$array_data_gak = array();
			$grade_best=0; $grade_good=0; $grade_enough=0; $grade_bad=0; 
		
			$group_value=array();
			$group_value=$array_group_users[$group];
		//foreach ($array_group_users as $group => $group_value) { 
			$group_name="Неизвестно название группы";
			$group_name=$array_groups[$group]['name'];
			?>
			<hr>
			<TABLE style="text-align:center; width:100%;">
				<TR>
					<TD width="10%"><?php echo $group; ?></TD>
					<TD width="30%"><?php echo " Группа ".$group_name; ?></TD>
					<TD width="60%"><a id="<?php echo $group;?>_show" onclick="$('#<?php echo $group."_reply"?>').show('slow'); $('#<?php echo $group;?>_show').hide('slow');">Показать</a></TD>
				</TR>
			</TABLE>
			
			<DIV id="<?php echo $group."_reply";?>" >
			<a id="short_hide" onclick="$('#<?php echo $group."_reply";?>').hide('slow'); $('#<?php echo $group;?>_show').show('slow');">Скрыть</a>
				<table>
						<tr style="background-color:#023183; color:white; text-align:center; height:35px;">
							<td width="5px">No</td>
							<td width="5px">No Сту<br>ден<br>та</td>
							<td width="30%">ФИО студента</td>
						
				<?php
				foreach ($array_modules_type as $key => $value)
				{
					?>
							<td style="width:20%; text-align:center;"><?php echo $value['name_ru']; ?><br>баллы<hr>
							   <table style="border:0px solid black; width:100%;">
							   <tbody><tr style="color:white; text-align:center; height:35px;">
								  <td>1 <br>Поп.</td>
								  <td>2 <br>Поп.</td>
								  <td>Итого</td></tr>
							   </tbody></table>
							</td>
					<?php
				}
				?>
							<td>Группа</td>
						</tr>
				<?php
				if (isset($group_value) AND !empty($group_value))
				{
					$i=0;
					foreach ($group_value as $user => $value) {
						$i++;
						?>
						<tr style="text-align:center; height:20px; border:1px solid black;">
							<td><?php echo $i; ?> </td>
							<td><?php echo $user; ?></td>
							<td><?php echo $fio=identify_student($user); ?></td>
							
							<?php
							$points=array();
							foreach ($array_modules_type as $module => $value_module)
							{
								?>
								<TD style="text-align:center; border:1px solid black;">     <!--  1 module -->
									<TABLE>
									 <TR style="text-align:center;">
										<TD><?php $try_1="0"; if (isset($group_value[$user][$module][0]['yes'])) {echo $try_1=$group_value[$user][$module][0]['yes']*$array_modules_type[$module]['points']; } else {echo "0";} ?></TD>
										<TD><?php $try_2="0"; if (isset($group_value[$user][$module][1]['yes'])) {echo $try_2=$group_value[$user][$module][1]['yes']*$array_modules_type[$module]['points']; } else {echo "0";} ?></TD>
										<TD><?php if($try_1 > $try_2) {echo $points[$module]=$try_1;} else { echo $points[$module]=$try_2;}  ?></TD></TR>
									</TABLE>
								</TD>
								<?php
							}
							?>
							
							<td><?php 
								echo $group." <br> ".$group_name 
								?>
							</td>
								
						</tr>
						<?php
						$point_gak=""; 
						if ($points[7]<100) {$point_gak=" Отлично ";}
						if ($points[7]<85) {$point_gak=" Хорошо ";}
						if ($points[7]<70) {$point_gak=" Удовлетворительно ";}
						if ($points[7]<50) {$point_gak=" Неудовлетворительно ";}
						$array_data_gak[$fio] = array (
							$fio, 
							$points[7],
							$point_gak
						);
						$array_data_group[$fio] = array (
							$fio, 
							$points[1],  //$first_module_ball,
							$points[2],  //$second_module_ball,
							"",  //$exam_value,
							"",  //$add_ball_value,
							"",  //$total_balls,
							"",  //$grade,
							"" // lectors signature
						);
						unset ($points);
						unset ($point_gak);
					} // end foreach
				} else {
					echo "does not exist";
				}
				?>
				</table>
				<?php 
					ksort($array_data_group);
					$array_data_group['info']= array ("group"=> $group_name, "coursename"=>$discipline_name, "semestr" => "");
					$array_data_group['grades']= array ("best"=> $grade_best, "good"=>$grade_good, "enough" => $grade_enough, "bad" => $grade_bad );

					ksort($array_data_gak);
					$array_data_gak['info']= array ("group"=> $group_name, "coursename"=>$discipline_name, "semestr" => "");
					
					///echo "<pre>"; print_r($array_data_group) ; echo "</pre>";
				?>
			</div>
			<FORM action="pdf.php" method="post" target="_blank" style="margin: 0; padding: 0; display: inline;">
				<INPUT type="hidden" name="pdf_array" value='<?php echo serialize($array_data_group); ?>'></INPUT>
				<INPUT type="submit" value="PDF"></INPUT>
			</FORM>

			<FORM action="html.php" method="post" target="_blank" style="margin: 0; padding: 0; display: inline;">
				<INPUT type="hidden" name="html_array" value='<?php echo serialize($array_data_group); ?>'></INPUT>
				<INPUT type="submit" value="HTML"></INPUT>
			</FORM>

			<FORM action="excel.php" method="post" target="_blank" style="margin: 0; padding: 0; display: inline;">
				<INPUT type="hidden" name="excel_array" value='<?php echo serialize($array_data_group); ?>'></INPUT>
				<INPUT type="submit" value="Excel"></INPUT>
			</FORM>
			
			<FORM action="pdf_gak.php" method="post" target="_blank" style="margin: 0; padding: 0; display: inline;">
				<INPUT type="hidden" name="pdf_gak_array" value='<?php echo serialize($array_data_gak); ?>'></INPUT>
				<INPUT type="submit" value="PDF GAK"></INPUT>
			</FORM>

			<?php
		} // end foreach groups
		////echo "<pre>Members of  groups <br>"; print_r($array_groups_members); echo "</pre>";
	}
	//*/
} 

require_once _DATA_PATH_."bottom.php";
?>