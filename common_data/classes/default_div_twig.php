<?php
class TableTwig
{
	public function view($array)
   {
	?>
	<DIV style="max-width:900px;">
	<?php
		///echo  "<pre>"; print_r($array['header']); echo "</pre>";
	    ///echo  "<pre>"; print_r($array['data']); echo "</pre>";
		$i="0";
        foreach ($array['data'] as $row)
	    {
		 foreach ($row as $key=>$values)
		   {
			 $new_array[$i][$key]=$values;
			 $new_array[$i][]=$values;
		 }
		 $i++;
		}
		$min_height= (count($array['header'])-1)*20;
       ///echo  "<pre>"; print_r($new_array); echo "</pre>";
        foreach ($new_array as $row)
	   {
         ?>   <DIV style="min-height:<?php echo $min_height;?>px; padding:5px 5px; background-color:gray; border: 1px solid black; margin-top:3px; color:white;">
		 <?php
		     foreach ($array['header'] as $key=>$value)
		     {
		     echo "<DIV style=\"width:100px; clear:both; float:left; \">".$array['header'][$key]."</DIV> <DIV style=\"float:left; width:300px; \"> ".$row[$key]."</DIV>";
              ?>
			    <!-- <DIV align="right" width="23">
					 <a href="?<?php echo $this->action_name."=".$this->action_view."&".$this->id_parameter."=".$row[$this->auto_increment]; ?>"><img width="11" src="<?php echo $this->data_path."images/next.png";?>" alt="Подробнее" ></a>
					 <a href="?<?php echo $this->action_name."=".$this->action_edit."&".$this->id_parameter."=".$row[$this->auto_increment]; ?>"><img src="<?php echo $this->data_path."images/edit.gif";?>" border="0" alt="Редактировать"></a>
					 <a href="?<?php echo $this->action_name."=".$this->action_delete."&".$this->id_parameter."=".$row[$this->auto_increment]; ?>" onclick="return confirm('Вы уверены, что хотите удалить?');"><img src="<?php echo $this->data_path."images/delete.gif";?>" border="0" ></a>
				 </DIV> -->
			  <?php
             }
			    ?>
				<DIV style="clear:both; text-align:left; align:right; width:70px">

				   <?php echo "<a href=\"".$array['links']['view'].$row['id']."\"><img width=\"11\" src=\"".$array['links']['data_path']."images/next.png\" alt=\"Подробнее\" ></a>";?>
				   <?php echo "&nbsp;&nbsp;&nbsp;<a href=\"".$array['links']['edit'].$row['id']."\"><img width=\"11\" src=\"".$array['links']['data_path']."images/edit.gif\" alt=\"Редактировать\" ></a>";?>
				   <?php echo "&nbsp;&nbsp;&nbsp;<a href=\"".$array['links']['delete'].$row['id']."\"><img width=\"11\" src=\"".$array['links']['data_path']."images/delete.gif\" alt=\"Удалить\" 
				   onclick=\"return confirm('Вы уверены, что хотите удалить?');\"
				   ></a>";?>
                </DIV>
             </DIV>
			  <?php  
		 echo "";
	   }
	?>
	</DIV>
	<?php
      
   }
}
?>
    
<DIV>

</DIV>