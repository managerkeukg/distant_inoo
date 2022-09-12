<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

is_int_obligatory ($_GET['group']);
is_int_obligatory ($_GET['discipline']);
$discipline=$_GET['discipline'];
$group=$_GET['group'];

$query="SELECT * FROM `"._TABLE_PREFIX_."type_modules` where `status`='1';";
$object_type_modules = new TableQuery;
$object_type_modules -> order_by_field="id";
$array_type_modules = $object_type_modules -> query ($query);
if (isset($array_type_modules) AND !empty($array_type_modules) AND is_array($array_type_modules))
{
	////echo "<pre> type_modules count "; print_r(count($array_type_modules)); echo "</pre>";
	////echo "<pre> type_modules "; print_r($array_type_modules); echo "</pre>";
}

require_once _FUNCTIONS_PATH_."f_iden_subject_test.php"; // indentify 
require_once _FUNCTIONS_PATH_."f_test_name.php";
require_once _FUNCTIONS_PATH_."f_iden_student.php";
require_once _FUNCTIONS_PATH_."f_iden_group_of_student.php"; 
require_once _FUNCTIONS_PATH_."f_group_name.php"; 
require_once _FUNCTIONS_PATH_."f_group_members.php";
require_once _FUNCTIONS_PATH_."function_identify_course.php"; 

require_once _FUNCTIONS_PATH_."f_test_result.php"; 
require_once _FUNCTIONS_PATH_."f_iden_exam_value.php";
require_once _FUNCTIONS_PATH_."f_iden_additional_ball.php";
?>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.js"> </script> 
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/show.js"> </script> 
<?php
$group_members=group_members($group);  ///echo "<pre>"; print_r ($group_members); echo "</pre>";

echo "<h3>Результаты модулей</h3>";
echo "<h4>Группа - ".identify_group_name($group)."</h4>";
$coursename=identify_course($discipline); echo "<h4> Дисциплина - ".$coursename."</h4>";
?>
<hr>
Список студентов группы  <?php echo identify_group_name($group); ?><br>
<a id="short_show" onclick="$('#short_reply').show('slow'); $('#short_show').hide('slow');">Показать</a>
<div id="short_reply">
    <a id="short_hide" onclick="$('#short_reply').hide('slow'); $('#short_show').show('slow');">Скрыть</a>
	<table class="table_default">
		<thead>
			<tr class="tr_head">
				<th width="5px">No</th>
				<th width="5px">No Сту<br>ден<br>та</th>
				<th width="30%">ФИО студента</th>
				<th style="text-align:center;">1 модуль<br>баллы<hr>
					<table class="table_default">
						<thead>
							<tr class="tr_head">
								<th>1 <BR>Поп.</th>
								<th>2 <BR>Поп.</th>
								<th>Итого</th>
							</tr>
						</thead>
					</table>
				</th>
				<th width="20%">
					2 модуль<br>баллы<hr>
					<table class="table_default">
						<thead>
							<tr class="tr_head">
								<th>1 <BR>Поп.</th>
								<th>2 <BR>Поп.</th>
								<th>Итого</th>
							</tr>
						</thead>
					</table>
				</th>
				<th >Текущий <br> контроль</th>
				<th >Дополни<br>тельные <br> Баллы</th>
				<th >Итого <br> Баллов</th>
				<th >Итоговая оценка</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if (isset($group_members) AND !empty($group_members))
		{  
			$i="";
			$id_test_1= identify_course_test($discipline, 1, _CURRENT_EDU_YEAR_);
			$id_test_2= identify_course_test($discipline, 2, _CURRENT_EDU_YEAR_);
			$test_result_1=test_result (""._TABLE_PREFIX_."test_users", _CURRENT_EDU_YEAR_, $id_test_1);
			$test_result_2=test_result (""._TABLE_PREFIX_."test_users", _CURRENT_EDU_YEAR_, $id_test_2);  ///echo "<pre>"; print_r($test_result_2['0']); echo "</pre>";
			foreach ($test_result_1 as $value)
			{
				$data[$value['user_id']] []=$value['yes'];
			}
			foreach ($test_result_2 as $value)
			{
				$data_2[$value['user_id']] []=$value['yes'];
			}
			////echo "<pre>"; print_r($data); echo "</pre>"; // exit;
			foreach ($group_members as $user) 
			{ 
				$i++;
				?>
                <tr  class="table_tr"> 
					<td width=5px><?php echo $i;?></td>
					<td><?php echo $user; ?></td>
					<td><?php echo identify_student($user) ?></td>
					<td>     <!--  1 module -->
						<table style="width:100%; border:0px solid black; text-align:center;">
							<tr>
								<td>
									<?php $_mod_1_try_1="0";
									if (isset($data[$user][0]) AND ! empty($data[$user][0])) 
									{ 
										$_mod_1_try_1= $data[$user][0]*$array_type_modules['1']['points']; 
									} 
									else {$_mod_1_try_1 = "0";} 
									echo $_mod_1_try_1;
									?>
								</td>
								<td>
									<?php $_mod_1_try_2="0";
									if (isset($data[$user][1]) AND ! empty($data[$user][1])) 
									{ 
										$_mod_1_try_2= $data[$user][1]*$array_type_modules['1']['points'];
									} 
									else {$_mod_1_try_2 = "0"; } 
									echo $_mod_1_try_2;
									?>
								</td>
								<td>
									<?php $itogo=""; 
									if ($_mod_1_try_1 > $_mod_1_try_2) {$itogo=$_mod_1_try_1 ; }	
									else {$itogo=$_mod_1_try_2;}
									$first_module_ball=$itogo; echo $first_module_ball; ?>
								</td>
							</tr>
						</table>
					</td>
					<td>     <!--  2 module -->
						<table style="width:100%; border:0px solid black;">
							<td>
								<?php $_mod_2_try_1="0";
								if (isset($data_2[$user][0]) AND ! empty($data_2[$user][0])) 
								{ $_mod_2_try_1= $data_2[$user][0]*$array_type_modules['2']['points'];} 
								else {$_mod_2_try_1 = "0"; } 
								echo $_mod_2_try_1;
								?>
							</td>
							<td>
								<?php $_mod_2_try_2="0";
								if (isset($data_2[$user][1]) AND ! empty($data_2[$user][1])) 
								{ $_mod_2_try_2= $data_2[$user][1]*$array_type_modules['2']['points']; } 
								else {$_mod_2_try_2 = "0";} 
								echo $_mod_2_try_2;
								?>
							</td>
							<td>
								<?php $itogo=""; if ($_mod_2_try_1 > $_mod_2_try_2) 
								{$itogo=$_mod_2_try_1; }	else {$itogo=$_mod_2_try_2; }
								$second_module_ball=$itogo; echo $second_module_ball; ?></td>
						</table>
					</td>
					<td> <!--  exam -->
						<?php
						$exam_value="0"; $exam_value = iden_exam_value ($user, $discipline, _CURRENT_EDU_YEAR_, "2"); // 2 is semestr
						echo $exam_value;
						//$add_ball_value=""; $add_ball_value=iden_additional_ball($user, $discipline, _CURRENT_EDU_YEAR_, "2");
						?>
					</td>
					<td > <!--  additional_ball -->
						<?php
						$add_ball_value=""; $add_ball_value = iden_additional_ball($user, $discipline, _CURRENT_EDU_YEAR_, "2"); 
						echo $add_ball_value;
						?>
					</td>
					<td> <!--  total_points -->
						<?php
						echo $first_module_ball+$second_module_ball+ $exam_value+$add_ball_value;
						?>
					</td>
					<td> <!--  total_grade -->
					</td>
				</tr>
		         <?php 
		    } // foreach
}
?>
	</tbody>
	</table>
</div>
<?php
require_once _DATA_PATH_."bottom.php";
?>