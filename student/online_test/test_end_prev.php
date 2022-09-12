<?php
require_once "../settings.php";
require_once _DATA_PATH_."top.php";

require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php";
require_once _FUNCTIONS_PATH_."f_test_name.php";
require_once _COMMON_DATA_PATH_."functions/f_is_int.php";

is_int_obligatory ($_GET['id']);
is_int_obligatory ($_GET['mod']);
$id=$_GET['id'];
$mod=$_GET['mod'];

if (isset($_GET['session'])) {is_obligatory ($_GET['session']);} 
else { 
	exit("Недопустимый формат URL-запроса. Хакерство преследуется законом"); 
}
if (strlen(trim($_GET['session']))!=30) { 
	exit("Недопустимый формат URL-запроса. Хакерство преследуется законом");
}

$session=htmlspecialchars($_GET['session']);
if (isset($_POST['question'])) {$question=htmlspecialchars($_POST['question']);}

$object_type_modules= new TableQuery;
$object_type_modules->order_by_field="id";
$array_type_modules=$object_type_modules -> query ("SELECT * FROM `"._TABLE_PREFIX_."type_modules` WHERE `status`='1';" ); // 
////echo count($array_type_modules)." записей";
////echo "<pre>type_modules "; print_r($array_type_modules); echo "</pre>"; 
$test_questions_number=$array_type_modules[$mod]['n_questions']; 
echo $array_type_modules[$mod]['name_ru'];
$id_vopros=$id-1;

// gettins questions of the test
$is_test_ended="0";
$query="SELECT * FROM `"._TABLE_PREFIX_."test_users` where `session`='".$session."'";
$object_test_users = new TableQuery;
$object_test_users -> order_by_field="id";
$array_test_users = $object_test_users->query ($query);
if (isset($array_test_users) AND !empty($array_test_users) AND is_array($array_test_users))
{
	////echo "<pre> test_users count "; print_r(count($array_test_users)); echo "</pre>";
	////echo "<pre> test_users "; print_r($array_test_users); echo "</pre>";
	foreach ($array_test_users as $value) {
		$question_array_text = $value['questions'];
		$subject_id = $value['discipline'];
		$is_test_ended = $value['test_ended'];
	}
	
}

//end getting questions of the test
if ($is_test_ended==1) 
{
	echo "<h1>Тест уже закончился. Вы не сможете изменить данные.</h1>";
} else 
{ 
	//setting points of previous question
	if($id_vopros<1 or $id_vopros>($test_questions_number+1)) {}
	else {
		if (isset($question)){
			$query = "update `"._TABLE_PREFIX_."test_users` 
				SET 
					`o".$id_vopros."`='".$question."'
				WHERE `session`='".$session."';
			";
			if(mysql_query($query))
			{	} else {exit(mysql_error()); }
		} else {}
	}
	//end -- setting points of previous question
	?>
	<br><br>
	<p style="color:green;"><?php $testname=identify_test_name($subject_id); echo $testname; ?></p>
	<br><br>
	<?php
	$question_array = unserialize ($question_array_text);
	///echo "<pre>"; print_r($question_array); echo "</pre>";
	if ($id_vopros<$test_questions_number)
	{  
		$query="SELECT * FROM `"._TABLE_PREFIX_."test_questions` where `id`=".$question_array[$id-1]."    AND (`status`='1') ORDER BY `id` DESC;";
		$object_test_questions = new TableQuery;
		$object_test_questions -> order_by_field="id";
		$array_test_questions = $object_test_questions->query ($query);
		if (isset($array_test_questions) AND !empty($array_test_questions) AND is_array($array_test_questions))
		{
			////echo "<pre> test_questions count "; print_r(count($array_test_questions)); echo "</pre>";
			////echo "<pre> test_questions "; print_r($array_test_questions); echo "</pre>";
			require_once "test_end_help.php"; //displays test
		}
	}
	
	//test ending
	//getting array of true answers
	if ($id_vopros==$test_questions_number) {

		$query="SELECT * FROM `"._TABLE_PREFIX_."test_questions`";
		$object_test_questions = new TableQuery;
		$object_test_questions -> order_by_field="id";
		$array_test_questions = $object_test_questions -> query ($query);
		if (isset($array_test_questions) AND !empty($array_test_questions) AND is_array($array_test_questions))
		{
			////echo "<pre> test_questions count "; print_r(count($array_test_questions)); echo "</pre>";
			////echo "<pre> test_questions "; print_r($array_test_questions); echo "</pre>";
			$correct_array = array ();
			foreach ($array_test_questions as $value) {
				$correct_array[$value['id']]=$value['correct'];
			}
		}
		///echo "<pre> correct ";print_r($correct_array); echo "</pre>";
		//getting array of true answers

		$query = "SELECT * FROM `"._TABLE_PREFIX_."test_users` WHERE `session`='".$session."'";
		$object_test_users = new TableQuery;
		$object_test_users -> order_by_field = "id";
		$array_test_users = $object_test_users->query ($query);
		if (isset($array_test_users) AND !empty($array_test_users) AND is_array($array_test_users))
		{
			////echo "<pre> test_users count "; print_r(count($array_test_users)); echo "</pre>";
			////echo "<pre> test_users "; print_r($array_test_users); echo "</pre>";
			$answer_array = array ();
			foreach ($array_test_users as $value) {
				for ($i = 1; $i <= $test_questions_number; $i++) {
					$answer_array[$i]=$value['o'.$i];
				}
				$user=$_COOKIE['firstname']." ".$_COOKIE['lastname'];
			}
		}
		
		$value_text=""; $true="0"; $false="0"; 
		foreach ($answer_array as $key => $value) {
			if ($answer_array[$key]==$correct_array[trim($question_array[$key-1])]) 
			{ 
				$zn= "1"; $true++; 
			} else {
				$zn= "0"; $false++;
			}
			$value_text=$value_text." ".$zn.", " ;
		}

		$query = "update `"._TABLE_PREFIX_."test_users` SET 
			`time_end`=NOW(),
			`yes`='".$true."',
			`no`='".$false."',
			`test_ended`='1'
			WHERE `session`='".$session."' 
		";
		if(mysql_query($query))  {} 
		else { 
			//exit(mysql_error());
		}
	 
		?>
		<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/jquery.min.js"></script> 
		<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/chart_line.js"></script>
		<script src="<?php echo _ROOT_PATH_;?>js/highcharts.js"></script> 
		<script src="<?php echo _ROOT_PATH_;?>js/exporting.js"></script> 
	 
		<div id="container" style="min-width: 800px; height: 400px; margin: 0 auto" width="100%"></div> 
		1- Правильно            0- Неправильно  &nbsp;&nbsp;&nbsp;&nbsp; <?php echo "Правильных ответов   ".$true;  echo  "   Неправильных ответов  ".$false; ?>
		<hr>
		<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/chart_pie.js"></script>
		<div id="pie_chart" style="min-width: 800px; height: 400px; margin: 0 auto"></div> 
		<?php
	}     /// y: <?php echo "7";
} //test is ended

require_once _DATA_PATH_."bottom.php";
?>