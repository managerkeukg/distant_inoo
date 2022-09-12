<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableHtml.php";	
require_once _FUNCTIONS_PATH_."ft_type_points.php";	
require_once _FUNCTIONS_PATH_."ft_type_points_gak.php";	

////echo "<pre>Points "; print_r(table_type_points()) ; echo "</pre>"; 
////echo "<pre>Points gak "; print_r(table_type_points_gak()) ; echo "</pre>"; 
	
//phpinfo ();
if (isset($_POST['html_array']) AND !empty($_POST['html_array']))
{
	$array=unserialize($_POST['html_array']);
	echo "<h2>Дисциплина  ".$array['info']['coursename']."</h2><h2>Группа ".$array['info']['group']."</h2>";
	unset($array['info']);
	unset($array['grades']);
	//
	echo "<br>Number of students - ".count($array);
	//echo "<pre>"; print_r($array) ; echo "</pre>"; 
	
	$array_prepared = array ();
	foreach ($array as $key => $value) 
	{
		$array_prepared[] = array (
			"fio" => $value['0'],
			"1" => $value['1'],
			"2" => $value['2'],
			"3" => $value['3'],
			"4" => $value['4'],
			"5" => $value['5'],
			"6" => $value['6'],
			"7" => $value['7']
			);
	}
	//echo "<pre>"; print_r($array_prepared) ; echo "</pre>"; 
	
	$object_table=new TableHtml5;
	$object_table -> css_file = "css/html_table_blue.css";
	
	$headers= array("fio"=>"ФИО студента", "1"=>"1 модуль", "2"=>"2 модуль", "3"=>"3 модуль", "4"=>"4 модуль", "5"=>"5 модуль", 
		"6"=>"Итоговый контроль", "7"=>"Гак");
		//Дополнительные <br> Баллы
		//Сумма <br> Баллов
		//Оценка
	$object_table -> set_th_array ($headers);
	//$object_table->column_value_array_foreign ("discipline", $array_files_gak , array("name_ru_detailed"));
	$object_table -> set_data($array_prepared);
	
	
	//$object_table -> data_key_add ("gak_files", "Гак файлы");
	//$object_table -> data_key_value ("gak_files", "<a href=\"dl_gak_file.php?id={{id}}\" target=\"_blank\">Скачать</a>");
	
	$object_table->display ();
}

require_once _DATA_PATH_."bottom.php";
?>