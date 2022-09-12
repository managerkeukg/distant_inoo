<?php
class Record_Excel
{ 
  public function set ($array, $settings)
	{
	  $excel=new ExcelWriter($settings['file_path']);
	  if($excel==false) echo $excel->error;
	  /*
	  $head_text=array("", "Кыргызский Экономический Университет");  $excel->writeLine($head_text);
	  $vedomost_text=array("", "Ведомость №___");  $excel->writeLine($vedomost_text);
	  $myArr=array("№","Фамилия И.О.", "1 модуль", "2 модуль", "Текущий контроль", "Доп баллы", "Итого баллов");
	  $excel->writeLine($myArr);
      */
	  //$i="0";
	  foreach ($settings['data_array_before'] as $key => $value) 
	  {
	     $excel->writeRow();
         foreach ($value as $key1 => $value1)
	     {
	      $excel->writeCol($value1);
	     }
	  }
	  foreach ($array as $key => $value)
	  {
	   //$i++; 
       $excel->writeRow();
       foreach ($value as $key1 => $value1)
	   {
	    $excel->writeCol($value1);
	   }
	  }
	  $excel->close();
	}
}
?>