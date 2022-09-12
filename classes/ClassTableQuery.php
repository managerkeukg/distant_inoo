<?php
class TableQuery
{
	public $cat;    public $array; public $data_array;
	public function query ($query)
	{
		$cat = mysql_query($query);
		if($cat) 
		{
			if (mysql_num_rows($cat)> 0)
			{ 
				while( $array = mysql_fetch_array($cat)) 
				{ 
					$data_array[]=$array;
				}  
				return $data_array;
			} else {return "0";}
		}
		else {
			exit(mysql_error());
		}
	}
} // end of class
?>