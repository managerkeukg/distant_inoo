<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _FUNCTIONS_PATH_."f_convert_date_sql_to_rus.php";

$query = "SELECT * FROM `"._TABLE_PREFIX_."student_info` where `student` = '"._ID_USER_."' " ;
$object_student_info = new TableQuery;
$object_student_info -> order_by_field="id";
$array_student_info = $object_student_info->query ($query);
if (isset($array_student_info) AND !empty($array_student_info) AND is_array($array_student_info))
{
	////echo "<pre> student_info count "; print_r(count($array_student_info)); echo "</pre>";
	////echo "<pre> student_info "; print_r($array_student_info); echo "</pre>";
	foreach ($array_student_info as $key => $value) 
	{
		?>
		<table class="table_default">
			<thead>
				<tr class="tr_head">
					<th>Имя</th>
					<th><?php  echo USER_FIRST_NAME; ?></th>
				</tr>
			</thead>
			<tbody>
		<TR height="25">
			<TD>Фамилия</TD>
			<TD><?php  echo USER_LAST_NAME; ?></TD>
		</TR>
		<TR height="25">
			<TD>Отчество
		</TD>
			<TD><?php echo $value['father_name']; ?></TD>
		</TR>
		<TR height="25">
			<TD>Дата рождения </TD>
			<TD><?php 
				if (isset($value['birthdate'])) 
				{ 
					$birthdate_array=convert_date_sql_to_rus($value['birthdate']);
					echo $birthdate_array['2'].".".$birthdate_array['1'].".".$birthdate_array['0'];
				}
				?>
			</TD>
		</TR>
		<!-- <TR height="25">
			<TD>Место рождения </TD>
			<TD><?php echo $value['birthplace']; ?></TD>
		</TR>
		 -->
		 <TR height="25">
			<TD>Семейное положение</TD>
			<TD><?php 
					//echo $value['maritalstatus']; 
					$maritalstatus="";
					$maritalstatus[]="Не указано";
					$maritalstatus[]="Холост / Не замужем";
					$maritalstatus[]="Женат / Замужем";
					echo  $maritalstatus[$value['maritalstatus']];
				?>
			</TD>
		</TR>
		<TR height="25">
			<TD>Место работы</TD>
			<TD><?php echo $value['workplace']; ?></TD>
		</TR>
		<TR height="25">
			<TD>Адрес проживания </TD>
			<TD><?php echo $value['address']; ?></TD>
		</TR>
		<TR height="25">
			<TD>Адрес электронной почты </TD>
			<TD><?php echo $value['email']; ?></TD>
		</TR>
		<TR height="25">
			<TD>Номер мобильного телефона </TD>
			<TD><?php echo $value['mobile']; ?></TD>
		</TR>
		<!-- <TR height="25">
			<TD>Номер домашнего телефона</TD>
			<TD><?php echo $value['home_telephone']; ?></TD>
		</TR>
		<TR height="25">
			<TD>Номер служебного (рабочего) телефона</TD>
			<TD><?php echo $value['job_telephone']; ?></TD>
		</TR> -->
		<TR height="25">
			<TD></TD>
			<TD><?php //echo $catalog[]; ?></TD>
		</TR>
		</tbody>
		</TABLE>
		<br><br><br><a href="student_info_edit.php">Редактировать Блок</a>
		<?php
	} // end foreach
} 
else 
{
	echo "<br><br><br><a href=\"student_info_edit.php\">Ввести свои данные</a>";
}
	 
require_once _DATA_PATH_."bottom.php";
?>