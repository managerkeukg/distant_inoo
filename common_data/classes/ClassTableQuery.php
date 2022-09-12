<?php
class TableQuery
{
  private $cat;    private $array; private $data_array; private $ordered_data_array = array ();
  public $order_by_field="";
  public function query ($query)
  {
    $this->cat = mysql_query($query);
    if($this->cat) 
         {
           if (mysql_num_rows($this->cat)> 0)
		    {  while( $this->array = mysql_fetch_assoc($this->cat)) { $this->data_array[]=$this->array;} 
				if (empty($this->order_by_field)) { return $this->data_array; } 
				else { 
					foreach ($this->data_array as $key => $value)
					{
						$this->ordered_data_array[$value[$this->order_by_field]]=$value;
					}
					return $this->ordered_data_array;
				}
 			   
			} else {return "0";}
  		 }
      else {exit(mysql_error());}
  }
} // end of class
?>