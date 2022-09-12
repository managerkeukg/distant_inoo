<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";

error_reporting(E_ALL ^ E_DEPRECATED);
require_once _FUNCTIONS_PATH_."f_convert_date_sql_to_rus.php";
?>
<link href="<?php echo _ROOT_PATH_;?>css/calendar.css" rel="stylesheet">	
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/calendar.js"></script>
<script type="text/javascript" src="<?php echo _COMMON_DATA_PATH_;?>ckeditor/ckeditor.js"></script>

<DIV style="width=100%; margin-left:35px;">
	<FORM action="student_info_set.php" method="post" id="form1">
		<TABLE>
		<?php
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
				$array = $value;
			}
		}
		?>
		<script type="text/javascript">
		$(document).ready(function(){
			$('#birth_date').attachDatepicker();  
		});
		</script>
		<TR>
			<TD>Дата рождения </TD>
			<TD>
				<INPUT TYPE="text" id="birth_date" name="birth_date" VALUE="<?php 
				if (isset($array['birthdate'])) 
				{ 
					$birthdate_array=convert_date_sql_to_rus($array['birthdate']);
					echo $birthdate_array['2'].".".$birthdate_array['1'].".".$birthdate_array['0'];
					//echo $array['birthdate'];
				} ?>">
				</INPUT>
			</TD>
		</TR>
		<TR>
			<TD>Семейное положение</TD>
			<TD>
				<SELECT  name="maritalstatus" >
					<OPTION VALUE="0">--- Выбрать --- </OPTION>
					<OPTION VALUE="1" <?php if (isset($array['maritalstatus']) AND $array['maritalstatus']==1) { echo "selected";} ?>> Холост / Не замужем </OPTION>
					<OPTION VALUE="2" <?php if (isset($array['maritalstatus']) AND $array['maritalstatus']==2) { echo "selected";} ?>> Женат / Замужем </OPTION>
				</SELECT></TD>
		</TR>
		<TR>
			<TD>Место работы</TD>
			<TD><TEXTAREA name="workplace" rows="10" cols="50"><?php if (isset($array['workplace'])) { echo  $array['workplace'];} ?>
				</TEXTAREA>
			</TD>
		</TR>
		<TR>
			<TD>Адрес проживания</TD>
			<TD><TEXTAREA name="address" rows="10" cols="50"><?php if (isset($array['address'])) { echo  $array['address'];} ?></TEXTAREA>
			</TD>
		</TR>
		<!-- 
		<TR>
			<TD>Адрес проживания </TD>
			<TD><INPUT TYPE="text" name="address" size="50" VALUE="<?php if (isset($array['address'])) { echo $array['address'];} ?>"></INPUT>
			</TD>
		</TR>
		 -->
		<TR>
			<TD>Адрес электронной почты </TD>
			<TD><INPUT TYPE="text" name="email" size="50" VALUE="<?php if (isset($array['email'])) { echo $array['email'];} ?>"></INPUT>
			</TD>
		</TR>
		<TR>
			<TD>Номер мобильного телефона </TD>
			<TD><INPUT TYPE="text" name="mobile" size="50" VALUE="<?php if (isset($array['mobile'])) { echo $array['mobile'];} ?>"></INPUT>
			</TD>
		</TR>
		<!-- 
		<TR>
			<TD>Номер домашнего телефона</TD>
			<TD><INPUT TYPE="text" name="lastname" size="50" VALUE="<?php //echo $array['lastname'];?>"></INPUT>
			</TD>
		</TR>

		 <TR>
			<TD>Номер служебного <br>(рабочего) телефона</TD>
			<TD><INPUT TYPE="text" name="lastname" size="50" VALUE="<?php //echo $array['lastname'];?>"></INPUT>
			</TD>
		</TR>
		-->
		<TR>
			<TD></TD>
			<TD><INPUT TYPE="submit" value="Сохранить"></INPUT></TD>
		</TR>
		</TABLE>
	</FORM>
</DIV>
<?php
require_once _DATA_PATH_."bottom.php";
?>


