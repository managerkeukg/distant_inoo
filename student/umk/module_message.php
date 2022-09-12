<DIV style="text-align:center; padding-top:10px">
	<TABLE>
		<TR>
			<TD><a href="index.php"><img src="<?php echo _DATA_PATH_."images/teacher.jpg"?>" title="Информация о преподавателе"></a></TD>
			<TD>
				<p style="color:blue;"><a href="teacher_messages.php?id=<?php echo $course_id; ?>">
					<?php 
					$message_number="";
					require "count_subject_messages.php";
					if (isset($message_number) AND (!empty($message_number))) {} else {$message_number="0";}
					echo $message_number;
					if(isset($new_array) AND !empty($new_array)) {
						echo "|  Новых <i class=portal-headline__link__balloon >".$new_array."</i>";
					} else {} 
					$new_array="0";
					?>
					сообщений
					</a>  &nbsp;&nbsp;&nbsp;
				</p>
			</TD>
		</TR>
	</TABLE>
</DIV>