<?php
$browser_data = browser();

$object_type_modules= new TableQuery;
$object_type_modules->order_by_field="id";
$array_type_modules=$object_type_modules -> query ("SELECT * FROM `"._TABLE_PREFIX_."type_modules` WHERE `status`='1';" ); 
if (isset($array_type_modules) AND !empty($array_type_modules))
{
	////echo count($array_type_modules)." записей";
	////echo "<pre>type_modules "; print_r($array_type_modules); echo "</pre>"; 
}
$test_questions_number = $array_type_modules[$mod]['n_questions']; 

$object_test_questions = new TableQuery;
$object_test_questions -> order_by_field="id";
$array_test_questions = $object_test_questions -> query ("SELECT `id` FROM `"._TABLE_PREFIX_."test_questions` WHERE `discipline`=".$id." AND (`status`='1');" ); 
if (isset($array_test_questions) AND !empty($array_test_questions))
{
	////echo count($array_test_questions)." записей";
	////echo "<pre>test_questions "; print_r($array_test_questions); echo "</pre>"; 
	if (count($array_test_questions) < $test_questions_number) {
		echo "<br>В данном тесте должно быть ".$test_questions_number." вопросов. "; 
		echo "<br>В данном тесте имеется только ".count($array_test_questions)." вопросов. Обратитесь к специалистам."; 
		exit;
	}
	shuffle($array_test_questions);
	////echo "<pre>test_questions "; print_r($array_test_questions); echo "</pre>"; 
	
	$array_questions = array ();
	$i="0";
	foreach ($array_test_questions as $key => $value) {
		$i++; 
		if ($i<($test_questions_number+1)) {
			$array_questions [] = $value['id'];
		}
	}
	////	echo "<br> array_questions ".$array_questions;  
} else {
	echo "<br>В данном тесте отсутствуют вопросы. Обратитесь к специалистам."; exit;
}

////echo "<h1>Уважаемые студенты! Ведутся технические работы. Сдача теста временно недоступна</h1>"; exit;

$session = generate_password(intval($session_lenght));
//echo "Session is ".$session; exit;
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];} else {$ip=$_SERVER["REMOTE_ADDR"];}
$query="INSERT INTO `"._TABLE_PREFIX_."test_users`
	SET
	`id`= NULL,
	`discipline`='".$id."',
	`year`='"._CURRENT_EDU_YEAR_."',
	`user_id`='". _ID_USER_ ."',
	`mod`='".$mod."',
	`questions`='".serialize($array_questions)."',
	`session`='".$session."',
	`browser`='".$browser_data['name']."',
	`time`=NOW(),
	`ip`='".$ip."'
";
$cat_start = mysql_query($query);
if($cat_start) 
{
	echo "<HTML><HEAD>
	<META HTTP-EQUIV='Refresh' CONTENT='0; URL=test_end.php?mod=".$mod."&session=".$session."'>
	</HEAD></HTML>";
}
else {
	exit(mysql_error());
}
//*/
?>