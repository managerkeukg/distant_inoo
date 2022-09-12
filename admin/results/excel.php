<?php
//phpinfo ();
if (isset($_POST['excel_array']) AND !empty($_POST['excel_array']))
{
	$array=unserialize($_POST['excel_array']);
	//echo "<pre>"; print_r($array) ; echo "</pre>"; exit;
	require_once ("../../excel/excelwriter.inc.php");
	$coursename=$array['info']['coursename'];
	$group=$array['info']['group'];
	$now= date("d.m.y H.i.s");
	$now= "33_".$now;
		  
	$settings=array (
		"file_path"=>"reports/".$now.".xls",
		"data_array_before"=> array ( 
			array ("", "Кыргызский Экономический Университет") ,
			array ("", "ИНОО"),
			array ("", "Ведомость №___"),
			array ("", "Курс"),
			array ("", "Семестр", $array['info']['semestr']),
			array ("", "Группа", $array['info']['group']),
			array ("", "Дата"),
			array ("", "Дисциплина", $array['info']['coursename']),
			array ("", "Преподаватель"),
			array ("", "Подпись преподавателя"),
			array ("№","Фамилия И.О.",  "1 модуль", "2 модуль", "Итоговый контроль", "Доп баллы", "Сумма баллов", "Оценка", "Подпись преподавателя")
			),
		"data_array_after"=>""
		); //"Зачётная книжка",
	//echo "<pre>"; print_r($settings) ; echo "</pre>"; exit;
	require_once ("../../common_data/classes/ClassExcel.php");
	$table= new Record_Excel;
	unset($array['info']);
	unset($array['grades']);
	$table->set ($array, $settings);
	//*/
	echo "<br><br>Excel файл успешно создан.";
	?>
	<a href="reports/<?php echo $now.".xls"; ?>">Скачать</a><br>
	<?php
} // if isset
?>