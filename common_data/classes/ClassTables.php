<?php
class Tables 
{  private $colons="4"; private $number_row; private $i="0";
   public function ShowTables($array)
   {   if (isset($array) AND !empty($array)) {
       //echo "<pre>"; print_r ($array['data']); echo "</pre>";
         if (isset($array['settings']['table']['style']) AND !empty($array['settings']['table']['style'])) 
	     { ?><TABLE border="0" style="<?php echo $array['settings']['table']['style']; ?>"><TR> <?php }
		 else { ?><TABLE  cellpadding="3px" cellspacing="3px" border="0" style="width:850px; margin:0px auto; text-align:center;"><TR> <?php }
	     if (isset($array['settings']['colons']) AND !empty($array['settings']['colons'])) 
		 {$this->colons=$array['settings']['colons'];} else {}
		 foreach($array['data'] as $key=>$value)
		  {   $this->i++;
		      $this->number_row = (int)($this->i/$this->colons); 
			  ///echo "<br>".$this->number_row." "; echo (float)($i/$this->colons) - $this->number_row;
			  if((float)($this->i/$this->colons) - $this->number_row != 0) 
				   {$row_end="";} else {$row_end="</TR><TR>";}
			 ?>
			 <TD <?php if (isset($array['settings']['td']['style']) AND !empty($array['settings']['td']['style'])) 
		               {echo "style=\"".$array['settings']['td']['style']." \" ";} else {} ?> >
			   <?php echo $value; ?>
			 </TD><?php echo $row_end; ?>
			 <?php 
		   } //end foreach
		   echo "</TR></TABLE>";
	   } else {return"0";}   
   }
}
?>