<?php
class TableClass
{
public function display ($data_array)
	{ ?>
	  <TABLE border="0" cellPadding="3" cellSpacing="0" width="100%" align="center"> 
	       <TBODY>
		        <TR bgcolor="#023183" align="center" style="color:white" height="35">
				<TD>Номер</TD>
		        <TD width="80%">Тема объявления</TD>
				<TD></TD> 
				<TD></TD>
               	<TD></TD> 
				<TD></TD>
               	</TR>
	  <?php
      $i=0;
	  foreach ($data_array as  $array) // while( $array = mysql_fetch_array($cat))
      { $i++; if($i % 2 == 0) {  $bgcolor="silver"; } else { $bgcolor="white"; }
	    ?> 
		<TR class="th" bgcolor="<?php echo $bgcolor; ?>" > 
			      <TD><?php echo $array['id_news']; ?></TD>
			      <td width="80%"><?php if (isset($array['textname']) AND !empty($array['textname'])) {echo $array['textname'];} else {echo "Без темы";}?></td>
				  <td width="80%"><a href="index.php?show=14&id=<?php echo $array['id_news'];?>">Просмотреть</a></td>
				  <td align="center"><a href="index.php?show=12&id=<?php echo $array['id_news'];?>"><img src="images/edit.gif" border="0" alt="Редактировать"></img></a></td>
<?php          
     if($array['active'] == 2)
		  {  $active_text="<img src=\"images\show.gif\" border=0 ></img>"; $active_link="17"; }
        else { 
              $active_text="<img src=\"images\hide.gif\" border=0 ></img>";  $active_link="16";
             } 
?>
				  <TD width="80%" ><a href="index.php?show=<?php echo $active_link; ?>&id=<?php echo $array['id_news']; ?>"><?php echo $active_text; ?></a></td>
				  <TD width="80%" ><a href="index.php?show=18&id=<?php echo $array['id_news']; ?>" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="images\delete.gif" border="0" ></img></a></td>
			 </TR>
		<?php
	  }
     echo "</TBODY></TABLE>";
    }

function use_method ()
	{echo "При помощи метода use_metod() можно вызвать метод method() <br>";
     $this->method(); 
	}   
} // end of class
?>