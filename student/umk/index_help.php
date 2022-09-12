<?php
////echo "<pre>"; print_r(array_unique($category_array)); echo "</pre>";
if (isset($_POST['id_semestr'])) {$id_semestr=$_POST['id_semestr'];}
?>
<table class="table_default">
	<thead>
		<tr class="tr_head">
			<th width="5px">Семестр</th>
			<!-- <th width=5px>No</th> -->
			<th width="15%">Дисциплина</th>
			<th width="5%">Сообщения преподавателя </th>
			<th width="5%">Объявления преподавателя группе </th>
			<th width="10%">Автор курса</th>
			<th width="10%">Силлабус</th>
			<!-- <th>Умк</th> -->
			<th>Лекции</th>
			<th width="10%">Глоссарий</th>
			<!-- <th>Видео уроки</th> -->
			<!-- <th width="30%">Контрольно-модульная<br> работа 1 <br> (1 модуль)</th>
			<th width="30%">Контрольно-модульная<br> работа 2 <br> (2 модуль)</th>
			 -->
			<th>Курсовая работа</th>
		 </tr>
	</thead>
	<tbody>
<?php
$i=0; //echo "<pre>"; print_r($name_array); echo "</pre>";
foreach ($name_array as $course_id=>$course_name )
{  
	$i++; if($i % 2 == 0)  {  $bgcolor="#F2F2F2"; } else { $bgcolor="white"; }
	?>
	<tr style="text-align:center; vertical-align:center; background-color:<?php echo $bgcolor;?>;"> 
		<td><?php 
			$semestr="";  $catalog="";  //$semestr="";  $semestr="";
			$query = "SELECT * FROM `"._TABLE_PREFIX_."semester` WHERE  `id`='".$category_array[$course_id]."';" ;
			$object_semester= new tableQuery;
			$object_semester->order_by_field="id";
			$array_semester=$object_semester -> query ($query);
			if (isset($array_semester) AND !empty($array_semester)) {
				////echo count($array_semester)." записей";
				////echo "<pre>semester "; print_r($array_semester); echo "</pre>"; 
				foreach ($array_semester as $key => $value) {
					$semester = $value['name_ru'];
				}
				echo $semester;
			}
			?>
		</td>
		<td  style="text-align:center;">
			<?php echo "<b>".$course_name."</b>";
			?>
		</td>
		<td>
			<?php require "module_message.php"; ?>
		</td>
		<td><a href="teacher_notifications.php?group=<?php echo _USER_GROUP_;?>&course=<?php echo $course_id;?>">=></a>
		</td>
		<td><?php 
			$query = "SELECT * FROM `"._TABLE_PREFIX_."course_umk_files`
				WHERE `course` ='".$course_id."' AND `status`='1' AND `umk_type`='1';";
			$object_files_course_author= new tableQuery;
			$object_files_course_author->order_by_field="id";
			$array_files_course_author=$object_files_course_author -> query ($query);
			if (isset($array_files_course_author) AND !empty($array_files_course_author)) {
				////echo count($array_files_course_author)." записей";
				////echo "<pre>files_course_author "; print_r($array_files_course_author); echo "</pre>"; 
				foreach ($array_files_course_author as $key => $value) {
					?>
					<a href="dl_umk_file.php?id=<?php echo $value['id']; ?>">
					<!-- <button type="button" name="" value="" class="css3button">Скачать</button> -->
					<img src="<?php echo _DATA_PATH_."images/download.jpg"; ?>"></a>
					<?php
				}
			}
	    ?>
		</td>
		<td><?php 
			$query = "SELECT * FROM `"._TABLE_PREFIX_."course_umk_files`
				WHERE `course` ='".$course_id."' AND `status`='1' AND `umk_type`='2';";
			$object_files_syllabus= new tableQuery;
			$object_files_syllabus->order_by_field="id";
			$array_files_syllabus=$object_files_syllabus -> query ($query);
			if (isset($array_files_syllabus) AND !empty($array_files_syllabus)) {
				////echo count($array_files_syllabus)." записей";
				////echo "<pre>files_syllabus "; print_r($array_files_syllabus); echo "</pre>"; 
				foreach ($array_files_syllabus as $key => $value) {
					?>
					<a href="dl_umk_file.php?id=<?php echo $value['id']; ?>">
					<!-- <button type="button" name="" value="" class="css3button">Скачать</button> -->
					<img src="<?php echo _DATA_PATH_."images/download.jpg"; ?>"></a>
					<?php
				}
			}
	    ?>
		</td>
		
		<td><a href="discipline_lectures.php?id=<?php echo $course_id; ?>" target="_blank">
			<button type="button" name="" value="" class="css3button">Далее...</button></a>
		</td>
		<td><?php 
			$query = "SELECT * FROM `"._TABLE_PREFIX_."course_umk_files`
				WHERE `course` ='".$course_id."' AND `status`='1' AND `umk_type`='3';";
			$object_files_glossary= new tableQuery;
			$object_files_glossary->order_by_field="id";
			$array_files_glossary=$object_files_glossary -> query ($query);
			if (isset($array_files_glossary) AND !empty($array_files_glossary)) {
				////echo count($array_files_glossary)." записей";
				////echo "<pre>files_glossary "; print_r($array_files_glossary); echo "</pre>"; 
				foreach ($array_files_glossary as $key => $value) {
					?>
					<a href="dl_umk_file.php?id=<?php echo $value['id']; ?>">
					<!-- <button type="button" name="" value="" class="css3button">Скачать</button> -->
					<img src="<?php echo _DATA_PATH_."images/download.jpg"; ?>"></a>
					<?php
				}
			}
			?>
		</td>	
		<td>
		<?php 
			$query = "SELECT * FROM `"._TABLE_PREFIX_."course_umk_files`
				WHERE `course` ='".$course_id."' AND `status`='1' AND `umk_type`='4';";
			$object_files_course_job= new tableQuery;
			$object_files_course_job->order_by_field="id";
			$array_files_course_job=$object_files_course_job -> query ($query);
			if (isset($array_files_course_job) AND !empty($array_files_course_job)) {
				////echo count($array_files_course_job)." записей";
				////echo "<pre>files_course_job "; print_r($array_files_course_job); echo "</pre>"; 
				foreach ($array_files_course_job as $key => $value) {
					?>
					<a href="dl_umk_file.php?id=<?php echo $value['id']; ?>">
					<!-- <button type="button" name="" value="" class="css3button">Скачать</button> -->
					<img src="<?php echo _DATA_PATH_."images/download.jpg"; ?>"></a>
					<?php
				}
			}
	    ?>
		</td>
	</tr>
		<?php
}  //foreach
?>
	</tbody>
</table>