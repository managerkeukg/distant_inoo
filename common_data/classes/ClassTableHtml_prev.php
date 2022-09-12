<style>
.TableHtml table {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	border-collapse: collapse;
	width: 100%;
}

.TableHtml  td, .TableHtml th {
	border: 1px solid #ddd;
	padding: 8px;
}

.TableHtml th {
	padding-top: 12px;
	padding-bottom: 12px;
	text-align: left;
	background-color: green;
	color: white;
}

#id_TableHtml tr:nth-child(even){background-color: blue;}

#id_TableHtml tr:hover {background-color: black; color: white;}
</style>
<?php
class TableHtml5
{ 
	public $caption;
	public $array_th = array();
	public $array_column_values = array();
	public $array_foreign = array();
	
	public function set_th_array ($array_th)
	{
		$this->array_th=$array_th;
	}
	
	public function column_value ($column_name, $column_value)
	{
		$this->array_column_values[$column_name]=$column_value;
	}
	
	public function column_value_array_foreign ($column_name, $array, $array_fields_to_show)
	{
		$this->array_foreign[$column_name]['array']=$array;
		$this->array_foreign[$column_name]['fields']=$array_fields_to_show;
		////echo "<pre>"; print_r($this->array_foreign); echo "</pre>";
	}
	
	public function display ($array)
	{
		echo "<div style=\"overflow-x:auto;\">";
		echo "<table id=\"id_TableHtml\" class=\"TableHtml\" >";  // \"cellpadding=\"3px\" cellspacing=\"0px\"
	    if (isset($this->caption) AND !empty($this->caption)) {echo "<caption>".$this->caption."</caption>";} 
	    echo "<thead>";
		if(isset($this->array_th) AND is_array($this->array_th)) { 
			////echo "<pre>"; print_r($this->array_th); echo "</pre>";
			echo "<tr>";
			foreach ($this->array_th as $value)
			{
				echo "<th>"; echo $value; echo "</th>";
			}
			echo "</tr>";
		} else {}
		echo "</thead>";
		echo "<tbody>";
		$i="0";
		foreach ($array as $key => $value)
		{
		   //$i++; if($i % 2 == 0) {  $bgcolor="silver"; }  else { $bgcolor="white"; }
		   //echo "<TR bgcolor=\"".$bgcolor."\" align=\"center\">";
		   echo "<tr>";
		   //echo "<TD>".$i."</TD>";
		   foreach ($value as $key1 => $value1)
		   {
				/*
				if (isset($this->array_column_values[$key1]))
				{
					echo "<td>".$this->array_column_values[$key1]."</td>";
				}
				else 
				{
					echo "<td>".$value1."</td>";
				}
				*/
				if (isset($this->array_foreign[$key1]['array']))
				{
					//echo "<td>".$this->array_foreign[$key1]['array']."</td>";
					echo "<td>".$this->array_foreign[$key1]['array'][$value1][$this->array_foreign[$key1]['fields']['0']]."</td>";
					////echo "<td>".$this->array_foreign[$key1]['fields']['0']."</td>";
				}
				else 
				{
					echo "<td>".$value1."</td>";
				}
				
		   }
		   echo "<tr>";
		}
		echo "</tbody>";
		echo "</table></div>";
	}
}
?>