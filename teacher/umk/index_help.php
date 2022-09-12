	<tr style="text-align:center; background-color:<?php echo $bgcolor;?>;"> 
		<td><?php echo $array['id']; ?></td>
		<td><?php echo $array['name']; ?></td>
		<td><?php 
			if (isset($array['umk_type']) AND !empty($array['umk_type'])) {
				echo $array_type_file_umk[$array['umk_type']]['name_ru'];
			}
		?>
		</td>
		<td style="text-align:right;"><a href="dl_umk_file.php?id=<?php echo $array['id']; ?>">Скачать</a></td>
		<td width="12">
			<a href="edit.php?id=<?php echo $array['id'];?>&course=<?php echo $discipline; ?>">
				<img src="<?php echo _COMMON_DATA_PATH_;?>images/edit.gif" alt="Редактировать">
			</a>
		</td>
		<?php          
		if($array['status'] == 2)
		{  
			$active_text="<img src=\""._COMMON_DATA_PATH_."images/show.gif\">"; $active_link="show.php"; 
		}
        else { 
            $active_text="<img src=\""._COMMON_DATA_PATH_."images/hide.gif\">";  $active_link="hide.php";
        } 
		?>
		<td width="12">
			<a href="<?php echo $active_link; ?>?id=<?php echo $array['id']; ?>&course=<?php echo $discipline; ?>">
				<?php echo $active_text; ?>
			</a>
		</td>
		<td width="12">
			<a href="delete.php?id=<?php echo $array['id']; ?>&course=<?php echo $discipline; ?>" onclick="return confirm('Вы уверены, что хотите удалить?');">
				<img src="<?php echo _COMMON_DATA_PATH_;?>images/delete.gif">
			</a>
		</td>
	</tr>