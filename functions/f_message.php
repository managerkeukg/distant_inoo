<?php   
function show_messages($student, $teacher, $msg_array) 
{
	function  show_front($array, $class) {
		?>
		<div id="<?php echo $array['id_msg'];?>_div"> <img class="avatar" src="<?php echo $array['photo'];?>"> 
		<div class="comment-content  <?php echo $class;?>">
		<!--<small class="date"><?php echo $array['date'];?></small>-->
		<h6><?php echo $array['fio']; ?></h6>
		<?php
	}
  
	function  show_text($array, $student) {
		if (isset($array['msg_theme']) AND !empty($array['msg_theme'])) {   } ?>
		<small class="date"><?php echo $array['date'];?></small>
		<div style="text-align:left;">
			<?php if ($array['from']<> $student AND ($array['active']==2)) {echo "<img src=\""._ROOT_PATH_."images/envelope.gif\">";} ?>   
				&nbsp;&nbsp;&nbsp;
				<?php echo $array['msg']; 
			?>
		</div>
		<?php
	} 
  
	function show_end () {
		echo "</div></div><br>";
	}
	$i="0";
	echo "<DIV  style=\"width:100%;\"  >"; 
	foreach ($msg_array as $array) 
	{
		//echo "<pre>"; print_r($array); echo "</pre>";
		$i++;
		if($student==$array['from']) {  $class="odd"; }  else { $class=""; }
		if ($i==1) {
			$user=$array['from']; 
			show_front($array, $class);
			show_text($array, $student);
		} //end if
		else 
		{ 
			if ($previous==$array['from']) { 
				echo "<hr>";
				show_text($array, $student);
			}
			else {
				show_end ();
				show_front($array, $class);
				show_text($array, $student);
			} //end else
		} // end else
		$previous=$array['from'];
	} //end foreach
	show_end (); 
	?>
	</DIV>
	<?php 
} // end function
?>	