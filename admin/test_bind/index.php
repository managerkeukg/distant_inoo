<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 
require_once _FUNCTIONS_PATH_."f_modules_status.php"; 

user_access_module ("test_bind");

echo "<h1>Прикрепить тесты к предмету</h1>";
?>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/remove_div.js"></script>
<FORM method="post">
<?php
//require_once _ROOT_PATH_."js/choose_box.php";
require_once _COMMON_DATA_PATH_."classes/TableSelectBox.php";
if (isset($semesters_array) AND !empty($semesters_array))
{
	// echo "<pre>"; print_r($semesters_array); echo "</pre>";
	$i=0;
	foreach ($semesters_array as $value)
	{ 
		$i++;
		$table_array[]= array ($i, $value['name'], "<a href=\"subjects.php?sem=".$value['id']."\" target=\"_blank\">=></a>");
	}

	$settings='
		<table class="table_default">
			<thead>
				<tr class="tr_head">
					<th>No</th>
					<th>Семестр</th>
					<th>Предметы</th>
				</TR>
			</thead>
	';
	require_once (_COMMON_DATA_PATH_."classes/ClassTable.php");
	$table= new TableHtml;
	unset($array['info']);
	$table->display ($table_array, $settings);
}
?>
</FORM>
<?php
require_once "choose_box_class.php";

function get_test_of_subject($discipline) {
	$object = new TableQuery;
	$array_subject_test = $object -> query ("SELECT * FROM `"._TABLE_PREFIX_."subject_bind_test` WHERE `subject`='".$discipline."' AND `status` >0;");
    return $array_subject_test;
}

function get_test($id_test) {
	$object = new TableQuery;
	$array_subject_test=$object -> query ("SELECT * FROM `"._TABLE_PREFIX_."test` WHERE `id`='".$id_test."' AND `status`='1';");
    return $array_subject_test;
}

function array_set_keys ($array, $field)
{   $new_array = array();
	foreach ( $array as $key => $value)
	{
	   $new_array[$value[$field]]=$value;
	}
	return $new_array;
}

if (isset($_POST['subject_choose']) AND !empty($_POST['subject_choose']))
{  
	$subject=$_POST['subject_choose'];
	//echo "<DIV id=\"sdf\" > <a href=\"subjects.php?sem=".$_POST['semester_choose']."\" target=\"_blank\">Редактировать предметы семестра</a> </DIV> ";
	?>
	<table class="table_default">
		<thead>
			<tr class="tr_head">
				<th>1 мод</th><th>2 мод</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="width:300px;"><?php $test_array=get_test_of_subject($subject);
				$bind_text_link="";
				if (isset($test_array) AND !empty($test_array)) {
					$test_array=  array_set_keys ($test_array, "mod");
					///echo "<pre>Tests  "; print_r ($test_array); echo "</pre>"; //exit;
					if (isset($test_array['1']['test']) AND !empty($test_array['1']['test']))
					{
						echo "<BR>".$test_array['1']['test'];
						$test_info= get_test($test_array['1']['test']);
						echo " ".$test_info[0]['name'];
						$bind_text_link="Изменить";
						?>
						<br>
						<?php 
						$module_data=subject_modules_status($subject);
						//echo $module_data['1'];
						if($module_data[1] == 0 OR $module_data[1] == 2)
						{  
							$active_text="<img src=\""._COMMON_DATA_PATH_."images\show.gif\">"; $active_link="show.php"; 
						}
						else { 
							$active_text="<img src=\""._COMMON_DATA_PATH_."images\hide.gif\">";  $active_link="hide.php";
						} 
						echo"<a href=\"".$active_link."?subject=".$subject."&mod=1\" target=_blank>".$active_text."</a>";

					} else {
						$bind_text_link="Привязать  предмет к тесту";
					}
				} else {$bind_text_link="Привязать предмет к тесту";}
				?>
				<BR><BR><a href="select_test.php?subject=<?php echo $subject;?>&mod=1" target="_blank"><?php echo $bind_text_link;?></a>
				</TD>
				<TD  style="width:300px;">
				<?php //$test_array=get_test_of_subject($subject);
				$bind_text_link="";
				if (isset($test_array) AND !empty($test_array)) {
					//$test_array=  array_set_keys ($test_array, "mod");
					if (isset($test_array['2']['test']) AND !empty($test_array['2']['test']))
					{
						echo "<BR>".$test_array['2']['test'];
						$test_info= get_test($test_array['2']['test']);
						echo " ".$test_info[0]['name'];
						$bind_text_link="Изменить";
						?>
						<br>
						<?php 
						$module_data=subject_modules_status($subject);
						//echo $module_data['1'];
						if($module_data[2] == 0 OR $module_data[2] == 2)
						{  
							$active_text="<img src=\""._COMMON_DATA_PATH_."images\show.gif\">"; $active_link="show.php"; 
						}
						else { 
							$active_text="<img src=\""._COMMON_DATA_PATH_."images\hide.gif\">";  $active_link="hide.php";
						} 
						echo"<a href=\"".$active_link."?subject=".$subject."&mod=2\" target=_blank>".$active_text."</a>";
					} else {$bind_text_link="Привязать  предмет к тесту";}
				} else {
					$bind_text_link="Привязать  предмет к тесту";
				}	 
				?><BR><BR><a href="select_test.php?subject=<?php echo $subject;?>&mod=2" target="_blank"><?php echo $bind_text_link;?></a>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
}

require_once _DATA_PATH_."bottom.php";
?>