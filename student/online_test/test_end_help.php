<?php
if (isset($_POST) AND !empty($_POST)) {
	////echo "<pre> POST ";print_r($_POST); echo "</pre>";
	$array_answer = array ();
	foreach ($_POST as $value) {
		$array_answer[] = $value;
	}
	////	echo "<pre> array_answer ";print_r($array_answer); echo "</pre>";
	
	$array_correct = array ();
	foreach ($array_test_questions as $array_value) {
		foreach ($array_value as $value) {
			$array_correct [] = $value['correct'];
		}
	}
	////echo "<pre> correct ";print_r($array_correct); echo "</pre>";
	$user=$_COOKIE['name']." ".$_COOKIE['surname'];
	$true="0"; $false="0";
	foreach ($array_answer as $key => $value) {
		if ($array_answer[$key]==$array_correct[$key]) 
		{ 
			$true++; 
		} else {
			$false++;
		}
	}
	$query = "update `"._TABLE_PREFIX_."test_users` SET 
		`answers`='".serialize($array_answer)."',
		`time_end`=NOW(),
		`yes`='".$true."',
		`no`='".$false."',
		`test_ended`='1'
		WHERE `session`='".$session."' 
	";
	if(mysql_query($query))  {
		echo "<h2>Данные теста успешно внесены в базу данных. </h2>";
		echo $true." - правильных и ".$false." - неправильных ответов";
	} 
	else { 
		//exit(mysql_error());
	}
		
		////include"charts.php";
} else {
	?>
	<div style="clear:both;">
		<div style="float:left;"> Осталось &nbsp&nbsp&nbsp</div>
		<div id="dsec"  style="float:left; text-align:center; padding: 5 5 5 5; background:black; font-size:20; color:white; width:100px">
		</div>
		<div style="float:left; width:100px;">  &nbsp&nbsp&nbsp секунд</div>
	</div> 

	<div style="clear:both;"></div>
	<script type="text/javascript" src="<?php echo _ROOT_PATH_;?>js/timer.js"></script>
	<form id="id_form_test" method="POST" action="<?php echo "test_end.php?mod=".$mod."&session=".$session; ?>" >
	<?php
	$j=0;
	foreach ($array_test_questions as $array_value) {
		$j++;
		foreach ($array_value as $value) {
			if ($j<=$test_questions_number) { 
				
			} else {
				
			}
				if ($j==1) {$display_type="block";} else {$display_type="none";}
				?>
				<div id="question_<?php echo $j;?>" class="cnsnt_info" style="width:900px; margin:0px auto; min-height:600px; display:<?php echo $display_type; ?>; padding-top: 5; ">
					<p>Вопрос  <?php echo $j; ?> </p>
					<h2><?php echo $value['question']; ?></h2>
					<table>
						<tr>
							<td></td>
							<td>
								<input type="radio" name="choice_<?php echo $j;?>" value="1"></input>1)&nbsp;&nbsp;
								<?php echo  $value['answer1']; ?>
							</td>
						</tr>

						<tr>
							<td></td>
							<td>
								<input type="radio" name="choice_<?php echo $j;?>" value="2"></input>2)&nbsp;&nbsp;
								<?php echo  $value['answer2']; ?>
							</td>
						</tr>

						<tr>
							<td></td>
							<td>
								<input type="radio" name="choice_<?php echo $j;?>" value="3"></input>3)&nbsp;&nbsp;
								<?php echo  $value['answer3'];  ?>
							</td>
						</tr>
							<?php
							if (!empty($value['answer4'])) {
								?>
						<tr>
							<td></td>
							<td>
								<input type="radio" name="choice_<?php echo $j;?>" value="4"></input>4)&nbsp;&nbsp;
								<?php if (!empty($value['answer4'])) { echo  $value['answer4']; } ?>
							</td>
						</tr>
								<?php                          
							}
							
							if (!empty($value['answer5'])) {
								?>
						<tr><td></td>
							<td>
								<input type="radio" name="choice_<?php echo $j;?>" value="5"></input>5)&nbsp;&nbsp;
								<?php if (!empty($value['answer5'])) { echo  $value['answer5'];	} ?>
							</td>
						</tr>
								<?php                          
							}
							?>
						<tr>
							<td></td>
							<td>
								<input type="radio" name="choice_<?php echo $j;?>" value="6" checked></input>
								Не знаю
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="button" id="button_next_<?php echo $j;?>" name="button_next" value="Следующий вопрос" onclick="div_hide('question_', '<?php echo $j;?>'); div_show('question_', '<?php echo $j+1;?>');"></input>
								
							</td>
						</tr>
					</table>
				</div>
			<?php
			if ($j==1) {
				?>
				<script type="text/javascript">
				var current_question = <?php echo $j;?> ;
				</script>
				<?php
			}
			
		} // end foreach
	}
	?>
		<div id="button_submit" style="display:none;">
			<input type="submit" value="Ответить и закончить тест" onclick="this.form.submit()"></input>
		</div>
	</form>
	<br><br><br><br>
<?php
}
?>
<script type="text/javascript">
check_timer();
function div_show(id, no) {
	//alert (no);
	current_question = no;
	
	var div = document.getElementById(id + no);
	div.style.display="block";
	if (no==20) {
		//alert ("last one");
		document.getElementById("button_next_"+no).style.display="none";
		document.getElementById("button_submit").style.display="block";
	}
}

function div_hide(id, no) {
	//alert (id);
	var div = document.getElementById(id + no);
	div.style.display="none";
}
</script>