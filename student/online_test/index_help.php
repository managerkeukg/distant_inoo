<?php
////echo "<pre>"; print_r(array_unique($category_array)); echo "</pre>";
if (isset($_POST['id_semestr'])) {
	$id_semestr=$_POST['id_semestr'];
}

$query="SELECT * FROM `"._TABLE_PREFIX_."module_start` where `id`='1';";
$object_modules_status = new TableQuery;
$object_modules_status -> order_by_field="id";
$array_modules_status = $object_modules_status->query ($query);
if (isset($array_modules_status) AND !empty($array_modules_status) AND is_array($array_modules_status))
{
	////echo "<pre> modules_status count "; print_r(count($array_modules_status)); echo "</pre>";
	////echo "<pre> modules_status "; print_r($array_modules_status); echo "</pre>";
}
?>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/confirm_take_test.js"></script>
<div style="margin:0px auto;">
<table class="table_default">
	<thead>
		<tr class="tr_head">
			<th>Семестр</th>
			<th>Дисциплина</th>
			<th>Контрольно-модульная<br> работа 1 <br> (1 модуль)</th>
			<th>Контрольно-модульная<br> работа 2 <br> (2 модуль)</th>
			<th>Итоговый <br> контроль</th>
			<th>ГАК</th>
		</TR>
	</thead>
	<tbody>
<?php
$i=0;
foreach ($array_simple_disciplines as $course_id => $course_name )
{  
	$i++; 
	if($i % 2 == 0)  {  $bgcolor="#F2F2F2"; }
	else { $bgcolor="white"; }
	?>
	<TR style="text-align:center; vertical-align:center; background-color:<?php echo $bgcolor;?>"> 
		<TD><?php 
	        $query = "SELECT * FROM `"._TABLE_PREFIX_."semester` WHERE  `id`=".$category_array[$course_id] ;
			$object_semester = new TableQuery;
			$object_semester -> order_by_field="id";
			$array_semester = $object_semester->query ($query);
			if (isset($array_semester) AND !empty($array_semester) AND is_array($array_semester))
			{
				////echo "<pre> semester count "; print_r(count($array_semester)); echo "</pre>";
				////echo "<pre> semester "; print_r($array_semester); echo "</pre>";
				foreach ($array_semester as $value) {
					echo $value['name_ru'];
				}
			}
			?>
		</TD>
		<!-- <TD><?php echo $course_id; ?></TD> -->
		<TD style="text-align:left;">
			<?php
			echo $course_name; 
			?>
		</TD>
		<TD><?php 
			$id_test="";  $module_no="1";
			$id_test=identify_course_test($course_id, $module_no, _CURRENT_EDU_YEAR_);
			$try_number="0";
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
						if ($value['yes']=='0' AND $value['no']=='0') { } else {$try_number++;} 
						echo "<br>".$try_number." 'я Попытка - <br>&nbsp;&nbsp;&nbsp;&nbsp;".$value['yes']." Правильных ответов";
						echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;Баллов ".$value['yes']*$array_modules_type[$module_no]['points'];
					}
					//echo "<PRE>"; print_r ($mod_result); echo "</PRE>";
				}
				
				if (isset($try_number) AND ($try_number<2)) 
				{ 
					echo "<br><a href=\"test_start.php?id=".$id_test."&mod=1\" onclick=\"return confirm_take_test()\">Сдать тест</a>";
				}
				else { 
					echo "<br>Тест окончен или недоступен"; 
				}
			}  	
			else { 
				echo "Тест не прикреплён к дисциплине"; 
			}
		?>
		</TD>
		<TD><?php 
			$id_test="";  $module_no="2";
			$id_test=identify_course_test($course_id, $module_no, _CURRENT_EDU_YEAR_);
			$try_number="0";
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
						if ($value['yes']=='0' AND $value['no']=='0') { } else {$try_number++;} 
						echo "<br>".$try_number." 'я Попытка - <br>&nbsp;&nbsp;&nbsp;&nbsp;".$value['yes']." Правильных ответов";
						echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;Баллов ".$value['yes']*$array_modules_type[$module_no]['points'];
					}
					//echo "<PRE>"; print_r ($mod_result); echo "</PRE>";
				}
				
				if (isset($try_number) AND ($try_number<2)) 
				{ 
					echo "<br><a href=\"test_start.php?id=".$id_test."&mod=2\" onclick=\"return confirm_take_test()\">Сдать тест</a>";
				}
				else { 
					echo "<br>Тест окончен или недоступен"; 
				}
			}  else { echo "Тест не прикреплён к дисциплине"; }
		?>	
		</TD>
		<TD style="text-align:center;">
			<?php  
			$id_test="";  $module_no="6";
			$id_test = identify_course_test($course_id, $module_no, _CURRENT_EDU_YEAR_);
			$try_number="0";
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
						if ($value['yes']=='0' AND $value['no']=='0') { } else {$try_number++;} 
						echo "<br>".$try_number." 'я Попытка - <br>&nbsp;&nbsp;&nbsp;&nbsp;".$value['yes']." Правильных ответов";
						echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;Баллов ".$value['yes']*$array_modules_type[$module_no]['points'];
					}
					//echo "<PRE>"; print_r ($mod_result); echo "</PRE>";
				}
				
				if (isset($try_number) AND ($try_number<2)) 
				{ 
					echo "<br><a href=\"test_start.php?id=".$id_test."&mod=6\" onclick=\"return confirm_take_test()\">Сдать тест</a>";
				} 
				else { 
					echo "<br>Тест окончен или недоступен"; 
				}
			}  else { echo "Тест не прикреплён к дисциплине"; }
			?>
		</TD>
		<TD class="text_left">
			<?php  
			$id_test="";  $module_no="7"; $max_try=2;
			
			$query = "SELECT * FROM `"._TABLE_PREFIX_."courses_bind_test`
              WHERE `subject` = '".$course_id."' AND (`status`='1' OR `status`='2')  AND (`mod`='".$module_no."')  AND (`year`='"._CURRENT_EDU_YEAR_."')";
			$array_test=f_table_query($query, "");
			if (isset($array_test) AND !empty($array_test))
			{
				$id_test=$array_test[0]['test'];
				////echo "<pre>test  "; print_r($array_test); echo "</pre>"; 
				$try_number="0";
				if ($array_test[0]['status']==1 OR $array_test[0]['status']==2)
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
							if ($value['yes']=='0' AND $value['no']=='0') { } else {$try_number++;} 
							echo "<br>".$try_number." 'я Попытка - <br>&nbsp;&nbsp;&nbsp;&nbsp;".$value['yes']." Правильных ответов";
							echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;Баллов ".$value['yes']*$array_modules_type[$module_no]['points'];
						}
						//echo "<PRE>"; print_r ($mod_result); echo "</PRE>";
					}
					
					if (isset($try_number) AND ($try_number<$max_try) AND $array_test[0]['status']==1) 
					{ 
						echo "<br><a href=\"test_start.php?id=".$id_test."&mod=".$module_no."\" onclick=\"return confirm_take_test()\">Сдать тест</a>";
					} else { 
						echo "<br>Тест окончен или недоступен"; 
					}
				}  else { echo "<br>Тест не прикреплён к дисциплине"; }
			}
			?>
		</TD>
	<?php    
}  //foreach
?>
		</tr>
	</tbody>
</table>
</div>