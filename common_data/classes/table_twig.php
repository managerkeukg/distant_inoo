<?php
class TableTwig
{
	public function view($header, $data)
   {
	?>
	<DIV style="max-width:900px;">
	<?php
		///echo  "<pre>"; print_r($header); echo "</pre>";
	    ///echo  "<pre>"; print_r($data); echo "</pre>";
		$i="0";
        foreach ($data as $row)
	    {
		 foreach ($row as $key=>$values)
		   {
			 $new_array[$i][$key]=$values;
			 $new_array[$i][]=$values;
		 }
		 $i++;
		}
		$min_height= (count($header)-1)*20;
       /// echo  "<pre>"; print_r($new_array); echo "</pre>";
        foreach ($new_array as $row)
	   {
         ?>   <DIV style="min-height:<?php echo $min_height;?>px; padding:5px 5px; background-color:gray; border: 1px solid black; margin-top:3px; color:white;">
		 <?php
		     foreach ($header as $key=>$value)
		     {
		     echo "<DIV style=\"width:100px; clear:both; float:left; \">".$header[$key]."</DIV> <DIV style=\"float:left; width:300px; \"> ".$row[$key]."</DIV>";
             //echo "<DIV style=\"width:100%; float:left;\">".$header['1']." ".$row['login']."</DIV>";
             //echo "<DIV>  ".$header['2']." ".$row['password']."</DIV>";
             }	 
		 echo "</DIV>";
	   }
	?>
	</DIV>
	<?php
      
   }
}
?>
    
<DIV>

</DIV>