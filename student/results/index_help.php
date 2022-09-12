<?php
if (isset($_GET['dev']) AND !empty($_GET['dev'])) 
{   is_int_ ($_GET['dev']); 
	if ($_GET['dev']=='1') {$dev_status=1;} else {$dev_status=0;}
} else {$dev_status=0;}

require_once _FUNCTIONS_PATH_."f_iden_exam_value.php"; 
require_once _FUNCTIONS_PATH_."f_iden_practice_value.php"; 
require_once _FUNCTIONS_PATH_."f_iden_additional_ball.php";

$query="SELECT * FROM `"._TABLE_PREFIX_."module_start` where `id`='1'";
$object_modules_status = new TableQuery;
$object_modules_status -> order_by_field="id";
$array_modules_status = $object_modules_status->query ($query);
if (isset($array_modules_status) AND !empty($array_modules_status) AND is_array($array_modules_status))
{
	////echo "<pre> modules_status count "; print_r(count($array_modules_status)); echo "</pre>";
	////	echo "<pre> modules_status "; print_r($array_modules_status); echo "</pre>";
}
?>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/confirm_take_test.js"></script>

<table class="table_default">
	<thead>
		<tr class="tr_head">
			<th width="5px">Семестр</th>
			<!-- <TD width=5px>No</TD> -->
			<th width="30%">Дисциплина</th>
			<th width="15%">Контрольно-модульная<br> работа 1 <br> (1 модуль)
				<hr>
				<table class="table_default">
					<thead>
						<tr class="tr_head">
							<th>1'я попытка Баллов </th>
							<th>2'я попытка Баллов</th>
							<th>Итого</th>
						</tr>
					</thead>
				</table>
			</th>
			<th width="5%">Прак - <br> тика 1</th>
			<th width="15%">Контрольно-модульная<br> работа 2 <br> (2 модуль)
			<hr>
				<table class="table_default">
					<thead>
						<tr class="tr_head">
							<th>1'я попытка Баллов </th>
							<th>2'я попытка Баллов</th>
							<th>Итого</th>
						</tr>
					</thead>
				</table>
			</th>
			<th width="5%">Прак - <br> тика 2</th>
			<th width="7%">Итоговый <br> контроль</th>
			<th width="7%">Итоговый <br> контроль (тест)</th>
			<th width="7%">Дополни<br>тельные <br> Баллы</th>
			<th width="7%">Итого <br> Баллов</th>
			<th width="19%">Итоговая <br> оценка</th>
		</tr>
	</thead>
	<tbody>
<?php
$i=0;
foreach ($user_disciplines as $course_id=>$course_name )
{  
	$i++; 
	if($i % 2 == 0)  {  $bgcolor="#F2F2F2"; }
	else { $bgcolor="white"; }
	?>
	<TR style="text-align:center; vertical-align:center; background-color:<?php echo $bgcolor;?>"> 
		<TD><?php 
			echo $array_semesters[$semester]['name_ru'];
			?></TD>
	<!-- <TD><?php echo $course_id; ?></TD> -->
	<TD width="30%" style="padding-left:5px; text-align:left;">
		<?php  if ($dev_status==1) {echo "course_id- ".$course_id."<BR>";} //echo  $course_id; 
		echo $course_name; 
		?>
	</TD>
	<TD ><?php 
		   ?>
			<TABLE style="width:100%; border:0px solid black;">
			<TR style="text-align:center;">
			<?php
			$id_test=""; $year=_CURRENT_EDU_YEAR_; $module_no="1";
			$id_test=identify_course_test($course_id, $module_no, $year);
			$try_number="0"; $mod_result="";
			if (isset($id_test) AND !empty($id_test))
			{ 
				if ($dev_status==1) {echo "id_test- ".$id_test."<BR>";}
				$query = "SELECT * FROM `"._TABLE_PREFIX_."test_users` WHERE  `user_id`='". _ID_USER_ ."' AND `discipline`='".$id_test."' AND `mod`='".$module_no."'" ;
				$object_test_users = new TableQuery;
				$object_test_users -> order_by_field="id";
				$array_test_users = $object_test_users->query ($query);
				if (isset($array_test_users) AND !empty($array_test_users) AND is_array($array_test_users))
				{
					////echo "<pre> test_users count "; print_r(count($array_test_users)); echo "</pre>";
					////echo "<pre> test_users "; print_r($array_test_users); echo "</pre>";
					$try_number="0";
					foreach ($array_test_users as $value) {
						if ($value['yes']=='0' AND $value['no']=='0') { } else {$try_number++;  
						$mod_result[$try_number]=$value['yes']*$array_modules_type[$module_no]['points'];}
						if ($dev_status==1) {
							//echo "<PRE>"; print_r ($value); echo "</PRE>"; 
							echo $value['yes']."<BR>";
							echo "<PRE>"; print_r ($mod_result); echo "</PRE>"; 
						}
					}
					//echo "<PRE>"; print_r ($mod_result); echo "</PRE>";
				}
				
				if (empty($mod_result[1])) {$mod_result[1]="0";}
				if (empty($mod_result[2])) {$mod_result[2]="0";}
				echo "<TD>".$mod_result[1]; echo "</TD>";
				echo "<TD>".$mod_result[2]; echo "</TD>";
			}  else { echo "Тест недоступен"; }
				?>
	        <TD><?php 
			$module1_ball="";
			if ($mod_result[2]>=$mod_result[1] ) {$module1_ball= $mod_result[2]; } else {$module1_ball= $mod_result[1]; }
			echo "<p style=\"color:red;\">".$module1_ball."</p>";
			?></TD>
			</TR>
			</TABLE>
	</TD>
	<TD><?php $practice_value_1=""; $practice_value_1=iden_practice_value (_ID_USER_, "1", $course_id, $year, "2"); echo $practice_value_1;?></TD>
	<TD>
		<TABLE style="width:100%; border:0px solid black;">
			<TR style="text-align:center;">
				<?php
				$id_test=""; $year=_CURRENT_EDU_YEAR_; $module_no="2";
				$id_test=identify_course_test($course_id, $module_no, $year);
				$try_number="0";  $mod_result=array();
				if (isset($id_test) AND !empty($id_test))
				{
					$query = "SELECT * FROM `"._TABLE_PREFIX_."test_users` WHERE  `user_id`='". _ID_USER_ ."' AND `discipline`='".$id_test."' AND `mod`='".$module_no."'" ;
					$object_test_users = new TableQuery;
					$object_test_users -> order_by_field="id";
					$array_test_users = $object_test_users->query ($query);
					if (isset($array_test_users) AND !empty($array_test_users) AND is_array($array_test_users))
					{
						////echo "<pre> test_users count "; print_r(count($array_test_users)); echo "</pre>";
						////echo "<pre> test_users "; print_r($array_test_users); echo "</pre>";
						$try_number="0";
						foreach ($array_test_users as $value) {
							if ($value['yes']=='0' AND $value['no']=='0') { } 
							else {
								$try_number++;  
								$mod_result[$try_number]=$value['yes']*$array_modules_type[$module_no]['points'];
							}
							if ($dev_status==1) {
								//echo "<PRE>"; print_r ($value); echo "</PRE>"; 
								echo $value['yes']."<BR>";
								echo "<PRE>"; print_r ($mod_result); echo "</PRE>"; 
							}
						}
						//echo "<PRE>"; print_r ($mod_result); echo "</PRE>";
					}
					
					if (empty($mod_result[1])) {$mod_result[1]="0";}
					if (empty($mod_result[2])) {$mod_result[2]="0";}
					echo "<TD>".$mod_result[1]; echo "</TD>";
					echo "<TD>".$mod_result[2]; echo "</TD>";
				}  else { echo "Тест недоступен"; }
				?>
	       <TD><?php 
		   $module2_ball="";
	       if ($mod_result[2]>=$mod_result[1] ) {$module2_ball= $mod_result[2]; } else {$module2_ball= $mod_result[1]; }
	       echo "<p style=\"color:red;\">".$module2_ball."</p>";
		   ?></TD>
		   </TR>
		   </TABLE>
	
	</TD>
	<TD><?php $practice_value_2=""; $practice_value_2=iden_practice_value (_ID_USER_, "2", $course_id, $year, "2"); echo $practice_value_2;?></TD>
	<TD><?php $exam_value=""; $exam_value=iden_exam_value (_ID_USER_, $course_id, $year, "2"); echo $exam_value;?></TD>
	<TD><?php //$exam_value_test="";  echo $exam_value_test;?>
		<TABLE style="width:100%; border:0px solid black;">
			<TR style="text-align:center;">
			<?php
			$id_test=""; $year=_CURRENT_EDU_YEAR_; $module_no="6";
			$id_test=identify_course_test($course_id, $module_no, $year);
			$try_number="0";  $mod_result=array();
				if (isset($id_test) AND !empty($id_test))
				{
					$query = "SELECT * FROM `"._TABLE_PREFIX_."test_users` WHERE  `user_id`='". _ID_USER_ ."' AND `discipline`='".$id_test."' AND `mod`='".$module_no."'" ;
					$object_test_users = new TableQuery;
					$object_test_users -> order_by_field="id";
					$array_test_users = $object_test_users->query ($query);
					if (isset($array_test_users) AND !empty($array_test_users) AND is_array($array_test_users))
					{
						////echo "<pre> test_users count "; print_r(count($array_test_users)); echo "</pre>";
						////echo "<pre> test_users "; print_r($array_test_users); echo "</pre>";
						$try_number="0";
						foreach ($array_test_users as $value) {
							if ($value['yes']=='0' AND $value['no']=='0') { } 
							else {
								$try_number++;  
								$mod_result[$try_number]=$value['yes']*$array_modules_type[$module_no]['points'];
							}
							if ($dev_status==1) {
								//echo "<PRE>"; print_r ($value); echo "</PRE>"; 
								echo $value['yes']."<BR>";
								echo "<PRE>"; print_r ($mod_result); echo "</PRE>"; 
							}
						}
						//echo "<PRE>"; print_r ($mod_result); echo "</PRE>";
					}
					
					if (empty($mod_result[1])) {$mod_result[1]="0";}
					if (empty($mod_result[2])) {$mod_result[2]="0";}
					echo "<TD>".$mod_result[1]; echo "</TD>";
					echo "<TD>".$mod_result[2]; echo "</TD>";
				}  else { echo "Тест недоступен"; }
			?>
			<TD><?php 
			$module6_ball="";
			if ($mod_result[2]>=$mod_result[1] ) {$module6_ball= $mod_result[2]; } else {$module6_ball= $mod_result[1]; }
			echo "<p style=\"color:red;\">".$module6_ball."</p>";
			?></TD>
			</TR>
		</TABLE>
	</TD>
	<TD><?php $add_ball_value=""; $add_ball_value=iden_additional_ball(_ID_USER_, $course_id, $year, "2"); echo $add_ball_value;?></TD>
	<TD><?php $total_ball=($module1_ball)+($module2_ball)+ $practice_value_1 + $practice_value_2 + $exam_value +($module6_ball)+ +$add_ball_value ;
	          echo $total_ball;
	    ?></TD>
	<TD><?php
		   if ($total_ball==0) {echo "Неявка";} 
		   if ($total_ball>1 and $total_ball<61 ) {echo "Неуд";}
		   if ($total_ball>=61 and $total_ball<74 ) {echo "Удовл";}
		   if ($total_ball>=74 and $total_ball<87 ) {echo "Хорошо";}
		   if ($total_ball>=87 and $total_ball<101 ) {echo "Отлично";}
		?>
	</TD>
<?php    
}  //foreach
?>
</tr>
       </tbody>
	   </table>
<br>
<br>
<table class="table_default">
	<thead>
		<tr class="tr_head">
			<th>Баллы</th><th> Оценка </th>
		</tr>
	</thead>
	<tbody>
		<tr><TD>87-100</TD><TD> Отлично </TD></tr>
		<tr><TD>74-86</TD><TD> Хорошо </TD></tr>
		<tr><TD>61-73</TD><TD> Удовлетворительно </TD></tr>
		<tr><TD>1-60</TD><TD> Неудовлетворительно </TD></tr>
		<tr><TD>0</TD><TD> Неявка </TD></tr>
	</tbody>
</table>