<?php
class TableHtml
{ 
  public function display ($array, $settings)
	{
      echo "<TABLE>";
	  echo $settings;
	  $i="0";
	  foreach ($array as $key => $value)
	  {
	   $i++; if($i % 2 == 0) {  $bgcolor="silver"; }  else { $bgcolor="white"; }
       echo "<TR bgcolor=\"".$bgcolor."\" align=\"center\">";
       //echo "<TD>".$i."</TD>";
       foreach ($value as $key1 => $value1)
	   {
	   echo "<TD>".$value1."</TD>";
	   }
	   echo "<TR>";
	  }
	  echo "";
	  echo "</TABLE>";
	}
}
?>