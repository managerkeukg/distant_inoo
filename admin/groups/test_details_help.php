<?php
$i++; 
foreach ($array_test_questions as $value) {
	?>
	<div class="cnsnt_info" style="padding-top: 5; width:900px;">
		<p color="blue" ><?php  ?></p>
		<div class="summary"></div>
		<p>Вопрос  <?php echo $i; ?> </p>
		<br>
		<?php echo $value['question']; ?>
		<table>
			<tr>
				<td></td>
				<td>
					<?php 
					if ($value['correct']=='1') { 
						echo  "<p class=\"test_true\">1) ".$value['answer1']."</p>";
					} else {
						echo  "1) ".$value['answer1'];
					}
								
					if ($array_answer[$i]==$value['correct'] AND $value['correct']=='1') {
						echo "   true";
					}
					?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<?php 
					if ($value['correct']=='2') { 
						echo  "<p class=\"test_true\">2) ".$value['answer2']."</p>";
					} else {
						echo  "2) ".$value['answer2'];
					}
								
					if ($array_answer[$i]==$value['correct'] AND $value['correct']=='2') {
						echo "   true";
					}
					?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<?php 
					if ($value['correct']=='3') { 
						echo  "<p class=\"test_true\">3) ".$value['answer3']."</p>";
					} else {
						echo  "3) ".$value['answer3'];
					}
								
					if ($array_answer[$i]==$value['correct'] AND $value['correct']=='3') {
						echo "   true";
					}
					?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<?php 
					if ($value['correct']=='4') { 
						echo  "<p class=\"test_true\">4) ".$value['answer4']."</p>";
					} else {
						echo  "4) ".$value['answer4'];
					}
								
					if ($array_answer[$i]==$value['correct'] AND $value['correct']=='4') {
						echo "   true";
					}
					?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<?php 
					if ($value['correct']=='5') { 
						echo  "<p class=\"test_true\">5) ".$value['answer5']."</p>";
					} else {
						echo  "5) ".$value['answer5'];
					}
								
					if ($array_answer[$i]==$value['correct'] AND $value['correct']=='5') {
						echo "   true";
					}
					?>
				</td>
			</tr>
			
			<tr><td></td><td>6) Не знаю</td></tr>

			<tr><td></td><td>Ответ студента
				<?php echo $array_answer[$i]; ?></td></tr>
		</table>
	</div>
		<?php
}
?>
<br><br>
<style>
.test_true {
	color: white;
	background-color: green;
}
</style>