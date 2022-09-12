<?php 
require_once "../settings.php";
require_once _DATA_PATH_."top.php";
require_once _COMMON_DATA_PATH_."classes/ClassDataTable.php"; 
require_once _COMMON_DATA_PATH_."classes/ClassTableQuery.php"; 

user_access_module ("migrate");

?>
<FORM action="" method="POST">
	From table<INPUT type="text" name="table_source" value="<?php if (isset($_POST['table_source'])) {echo $_POST['table_source'];} else {echo "inoo_base_edu"; }?>"></INPUT>
	To table<INPUT type="text" name="table" value="<?php if (isset($_POST['table'])) {echo $_POST['table'];}  else {echo "inoo_base_edu2"; }?>"></INPUT>
	<BR><?php 
    if (isset($_POST['table_source'])) { 
		$table_source=$_POST['table_source'];
		$cat = mysql_query("SHOW COLUMNS FROM  `".$table_source."`");
		if($cat) 
		{
			if (mysql_num_rows($cat) > 0) {
				while ($row = mysql_fetch_assoc($cat))
				{
					$array[]=$row['Field']; 
				} 
				//
				echo "<pre>From table"; print_r($array); echo "</pre>";	   
			}	
		}	
	}
   
	if (isset($_POST['table'])) { 
		$table=$_POST['table'];
		$cat = mysql_query("SHOW COLUMNS FROM  `".$table."`");
		if($cat) 
		{
			if (mysql_num_rows($cat) > 0) {
				while ($row = mysql_fetch_assoc($cat))
				{
					$array_to[]=$row['Field']; 
				} 
				echo "<pre>To table "; print_r($array_to); echo "</pre>";	   
			}	
		}	
	}
	echo "Order by"; $order_by=$_POST['order_by'];
	echo "<SELECT name=\"order_by\">";
	foreach ($array as $value) {
		echo "<OPTION value=\"".$value."\" "; if ($_POST['order_by']==$value) {echo " selected ";}  echo ">".$value."</OPTION>";
	}
	echo "</SELECT><BR>"; 
	echo "Limit ";
	echo "<SELECT name=\"limit\">";
	echo "<OPTION value=\"0\" "; if ($_POST['limit']=='0') {echo " selected ";}  echo ">0</OPTION>";
	echo "<OPTION value=\"30\" "; if ($_POST['limit']=='30') {echo " selected ";}  echo ">30</OPTION>";
	echo "</SELECT><BR>";
	echo "<BR>Add status field<INPUT name=\"field_status\"  type=\"checkbox\" "; if ($_POST['field_status']=="on") {echo " checked ";} echo "></INPUT>";
	echo "<BR>Add id_user field<INPUT name=\"field_user\"  type=\"checkbox\" "; if ($_POST['field_user']=="on") {echo " checked ";} echo "></INPUT>";
	echo "<BR>Insert new table<INPUT name=\"insert\"  type=\"checkbox\" "; if ($_POST['insert']=="on") {echo " checked ";}  echo "></INPUT>";

	foreach ($array as $value) {
		echo "<BR>".$value;
		echo "<SELECT name=".$value." class=\"list1\" >";
		echo "<OPTION value=\"0\" >choose</OPTION>";
		foreach ($array_to as $value_to) {
			echo "<OPTION value=\"".$value_to."\" class=\"option2\" "; if ($_POST[$value]==$value_to) {echo " selected ";}  echo "  >".$value_to."</OPTION>";
		}
		echo "</SELECT>";
	}
	?>
	<INPUT type="submit"></INPUT>
</FORM>
<?php
if ($_POST['limit']=='30') {$limit="LIMIT 0, 30";} else {$limit="";}
  
$choosed_array=$_POST;
unset ($choosed_array['table_source']);
unset ($choosed_array['table']);
unset ($choosed_array['order_by']);
unset ($choosed_array['limit']);
unset ($choosed_array['field_status']);
unset ($choosed_array['field_user']);
unset ($choosed_array['insert']);
foreach ($choosed_array as $key => $value) {
	if (empty($value)) {} else {$new_array[$key]=$value;}
}
//echo "<pre>POST  "; print_r ($choosed_array); echo "</pre>";
if (isset($new_array) AND !empty($new_array))
{
	echo "<pre>new  "; print_r ($new_array); echo "</pre>";
	$query="SELECT ";
	$count_field=count($new_array); $i=0; $fields_text="";
	foreach ($new_array as $key => $value)
	{ 
		$i++; if ($i==$count_field) {$query=$query."`".$key."` "; $fields_text=$fields_text." `".$value."` ";} 
		else {$query=$query."`".$key."`, "; $fields_text=$fields_text."`".$value."`, ";}
	}
	$query=$query."FROM  `".$table_source."` ORDER BY `".$order_by."` ".$limit;
	echo $query;
	$cat = mysql_query($query);
    if($cat) 
	{
		if (mysql_num_rows($cat)> 0)
		{  
			while( $array = mysql_fetch_assoc($cat)) { $data_array[]=$array;}
		} else {return "0";}
	}
    else {exit(mysql_error());}
	//echo "<pre>All selected array  "; print_r ($data_array); echo "</pre>";
	$rows_number=count($data_array);
	echo "<BR><BR>Number of rows".$rows_number."<BR>";
	$values=""; $i=0;
	foreach ($data_array as $key => $value) {
		$i++;
		///$values=$values."<br>";
		$values=$values."(";
		$j=0;
		foreach ($value as $value2) //fields
		{  
			$j++; 
			if ($j==$count_field) { $values=$values."'".$value2."'"; } 
            else { $values=$values."'".$value2."', ";}
          
	    }
		if ($_POST['field_user']=="on") { $values=$values.", '1'";}
		if ($_POST['field_status']=="on") { $values=$values.", '1'";}
		if ($i==$rows_number) { $values=$values.");"; } 
		else { $values=$values."),";}
	
	} // end foreach
   
	if ($_POST['field_user']=="on") {$fields_text=$fields_text.", `id_user`"; $values=$values."";}
	if ($_POST['field_status']=="on") {$fields_text=$fields_text.", `status`"; $values=$values."";}
	$insert_query="INSERT INTO `".$table."` (".$fields_text.")
	    VALUES ".$values."";
	///
	echo "<BR>".$insert_query."<BR>";
	if ($_POST['insert']=="on")
	{
		//
		/*
		$insert = mysql_query($insert_query);
		if($insert) 
		{
			// echo "<HTML><HEAD><META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$this->url."'></HEAD></HTML>";
			echo "Data is succesfully inserted to table ".$table;
		} else {exit(mysql_error());}
		//*/
	}
}
require_once _DATA_PATH_."bottom.php";
?>