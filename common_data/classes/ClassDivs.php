<?php
class Divs 
{  private $show_by="4"; private $number_row; private $style_before; private $i="0";
   public function ShowDivs($array)
   {   if (isset($array) AND !empty($array)) {
       //echo "<pre>"; print_r ($array['data']); echo "</pre>";
         if (isset($array['settings']['main_div']['style']) AND !empty($array['settings']['main_div']['style'])) 
	     { echo "<DIV style=\"".$array['settings']['main_div']['style']."\">";} else { echo "<DIV>";}
	     if (isset($array['settings']['show_by']) AND !empty($array['settings']['show_by'])) 
		 {$this->show_by=$array['settings']['show_by'];} else {}
		 foreach($array['data'] as $key=>$value)
		  {   
		       $this->number_row = (int)($this->i/$this->show_by); ///echo "<br>".$this->number_row." "; echo (float)($i/$this->show_by) - $this->number_row;
			   if((float)($this->i/$this->show_by) - $this->number_row != 0) 
				   {$this->style_before="float:left; ";} else {$this->style_before="clear:both; float:left; ";}
			 ?>
			 <DIV class="<?php if (isset($array['settings']['class']) AND !empty($array['settings']['class'])) {echo $array['settings']['class'];} ?>" 
			      style="<?php echo $this->style_before; if (isset($array['settings']['style']) AND !empty($array['settings']['style'])) {echo $array['settings']['style'];} ?>"
			   >
			   <?php echo $value; ?>
			 </DIV>
			 <?php $this->i++;
		   } //end foreach
		   echo "</DIV>";
	   } else {return"0";}   
   }
}
?>