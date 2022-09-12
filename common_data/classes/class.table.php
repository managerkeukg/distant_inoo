<?php 
header('Content-Type: text/html; charset=utf-8');
class MySQL_table_data
{
// buffer
public $name; public $query;
//function __construct($query) {      $this->query = $query;}
function table_view ($query) {
  $this->query = $query;
  $cat = mysql_query($query);
  if($cat) 
         {
            if (mysql_num_rows($cat)> 0)
		    {   //echo "<pre>"; print_r(mysql_fetch_array($cat)); echo "</pre>";
			   while($row_array = mysql_fetch_row($cat)) {$array[]=$row_array;}
			   return $array;
			} else { }
  		 }
      else {exit(mysql_error());}
}
} //end class
include "../config.php";
$object=new MySQL_table_data;
$arr = $object->table_view("SELECT * FROM `news` where `active`='1'  ORDER BY `id_news` DESC limit 20");
//echo "<pre>"; print_r($arr); echo "</pre>";

$array[]= array ("1", "2", "3");
$array[]= array ("4", "5", "6");
echo "<pre>"; print_r($array); echo "</pre>";

class Table
{
  public function TableView ($data)
	{
	  ?><TABLE border="0" cellPadding="3" cellSpacing="0" width="100%" align="center" >

	  <?php
	  foreach ($data as $row)
		{
		  //echo "<pre>"; print_r($row); echo "</pre>"; 
		  ?><TR bgcolor="#023183" align="center" style="color:white" height="35">
		  <?php
		  foreach ($row as $columns)
			{echo "<TD>$columns</TD>";}
		  echo "</TR>";
		}
	  echo "</TABLE>";
    }
}
$obj= new Table;
$obj->TableView($arr);
?>