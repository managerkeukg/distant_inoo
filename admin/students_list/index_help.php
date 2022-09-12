<table class="table_default">
	<thead>
		<tr class="tr_head">
			<th>№</th>
			<th>Номер</th>
			<th>Логин</th>
			<th>ФИО</th> 
			<th>email</th>
			<th>Группа</th> 
			<th></th> 
			<th></th> 
			<th></th> 
		</tr>
	</thead>
	<tbody>
	<?php
	$i=0;
	foreach ($array_students as $value) {
		$i++;  if($i % 2 == 0){  $bgcolor="silver"; } else { $bgcolor="white"; }
		?>      
	    <TR style="text-align:center; border:20px; background-color:<?php echo $bgcolor; ?>"
			onmouseover="this.style.background='<?php echo $tr_hover_color; ?>'; var $row_height=this.offsetHeight; this.style.height=$row_height*1.5; this.style.border='10'; this.style.borderColor='red'; " 
			onmouseout="this.style.background='<?php echo $bgcolor; ?>'; var $row_height=this.offsetHeight/1.5; this.style.height=$row_height; this.style.border='1'; this.style.borderColor='';"> 
			<TD><?php echo $i; ?>
			</TD>
			<TD><a name="<?php echo $value['id']; ?>"></a><?php echo $value['id']; ?>
			</TD>
			<td><?php echo $value['username'] ?><br><a href="<?php echo _ROOT_PATH_;?>student/enter.php?id=<?php echo $value['id']; ?>" target="_blank">Войти</a>
			</td>
			<td><?php echo $value['firstname']." ".$value['lastname']; ?></td>
			<td><?php echo $value['email']; ?></td>
			<TD><?php 
				$student_group=identify_group_of_student($value['id']); 
				if (!empty($student_group)) {
					echo identify_group_name(identify_group_of_student($value['id']));
					echo "<br><a href=group_change_form.php?&id=".$value['id'].">Сменить группу</a>";
				}
				else {echo  "<a href=group_add_form.php?id=".$value['id'].">Добавить к группе</a>";}
				?>
			</TD> 
			<TD><?php echo date('d.m.Y H:i:s', $value['timemodified']); ?></TD>
			<TD><a href="edit.php?id=<?php echo $value['id']; ?>"><img src="<?php echo _COMMON_DATA_PATH_."images/edit.gif"; ?>" alt="Редактировать"></a></TD>
			<TD>
				<a href="delete.php?id=<?php echo $value['id']; ?>" onclick="return confirm('Вы уверены, что хотите удалить?');">
					<img src="<?php echo _COMMON_DATA_PATH_."images/delete.gif"; ?>">
				</a>
			</TD>
		</TR>		  
		<?php          
    } // end foreach
	?>
	</tbody>
</table> 